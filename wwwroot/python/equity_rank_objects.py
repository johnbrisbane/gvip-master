"""
Created on Thu Sep 30 10:11:52 2021

@author: Galen Lytle galen@cg-la.com
Title: equity_rank_objects.py
Description:
    Contains the scoring classes for each U.S. project. Every project to be scored
    is assigned a rank object. Upon instantiation of the class, the rank will be
    calculated.
    
    The "equity_rank" class (not simplified) is currently unsupported as the data
    to calculate the score is not easily attainable.
    
    Non-U.S. projects are currently unsupported.
    
    Some parameters will need to be updated as time goes on:
        Global variable "US_median_household_income" will need to be updated.
        Global variable "tracts_df" will need to be updated from U.S. census data.
        Global variable "proj_budgets_df" will need to be updated periodically from
            GViP database.
"""

import geopandas as gpd
import pandas as pd
from haversine import haversine, Unit
from sqlalchemy import create_engine
import os
import json

data_path = os.path.join(os.path.dirname(__file__),"Data")

tracts_df = pd.read_pickle(os.path.join(data_path,"census_tract_data.pkl"))
proj_budgets_df = pd.read_pickle(os.path.join(data_path,"proj_budgets_df.pkl"))
US_median_household_income = 67521

class simplified_equity_rank:
    """Simplified equity ranking algorithm for projects. Only uses a raw
    subsector value to determine the regional equity of a project.
    
    Parameters
    -----------
    loc : 2-tuple float
        (Latitude, Longitude)
    sector : string
        GViP sector.
    subsector : string
        GViP subsector.
    impact : int
        Scored from -50 to 50. Does not include potential jobs. Considers 
        potential for demolitions, pollution, and other endogenous health or 
        quality-of-life concerns.
    impact_dist : float
        The average range in miles that the most extreme direct impact will reach.
    budget : int
        Total budget of the project.
    
    Attributes
    -----------
    tract_distances_ : pandas.Series int
        A list of the tract distances (indexed by Tract Code) from the project.
    impact_tracts_ : pandas.DataFrame
        A dataframe of the tracts relevant to the project impact (defined by
        the impact_dist parameter).
    size_multiplier_ : float
        Score from 1 to 2. Uses the project budget as a percentage of other 
        project budgets in the sector to determine how much the impact should be 
        scaled by.
    modified_impact_ : int
        Impact multiplied by the size_multiplier_
    income_ : int
        Lowest median household income of any affected tract.
    relative_income_ : float
        Income as a percentage of the median household income in the country
    population_ : float
        From 1 to 10. Total population in all impacted tracts divided by 100,000.
        If lower than 1 or greater than 10, it is set to 1 or 10, respectively.
    equity_score_ : float
        Final equity score.
    scored_ : bool
        Tracks whether the object has an equity score.
    """
    
    def __init__(self,loc,sector,subsector,budget):
        global data_path
        self.loc = loc
        self.sector = sector
        self.subsector = subsector
        self.budget = budget
        self.impact = json.load(open(os.path.join(data_path,"simplified_impact.json")))[self.sector][self.subsector]
        self.impact_dist = json.load(open(os.path.join(data_path,"simplified_impact_distance.json")))[self.sector][self.subsector]
        print("\tJSONs loaded.")
        self.get_size_multiplier()
        print("\tSize multiplier retrieved.")
        self.modified_impact_ = self.impact * self.size_multiplier_
        self.get_tracts()
        self.get_equity_rank()
        
    def __str__(self):
        return str(self.equity_score_)
        
    def get_size_multiplier(self):
        global proj_budgets_df
        median_budget = proj_budgets_df.loc[proj_budgets_df["sector"]==self.sector,"totalbudget"].median()
        self.size_multiplier_ = 1 + abs(self.budget - median_budget)/median_budget
        return self
    
    def get_tracts(self):
        global tracts_df
        lat = self.loc[0]
        lng = self.loc[1]
        print("\tFinding tracts for income data...")
        self.tract_distances_ = tracts_df.centroids.apply(
            lambda centroid: haversine((lat,lng),(centroid.y,centroid.x),unit=Unit.MILES)
            )
        self.impact_tracts_ = tracts_df.loc[self.tract_distances_ < self.impact_dist,:]
        if self.impact_tracts_.empty:
            i = 1
            while i < 6:
                print("\tEnlarging distance by {} mile(s)".format(i))
                self.impact_dist += 1
                self.impact_tracts_ = tracts_df.loc[self.tract_distances_ < self.impact_dist,:]
                i+=1
                if not self.impact_tracts_.empty:
                    i = 6
            if self.impact_tracts_.empty:
                print("\tNo census tracts found for location.")
            else:
                print("\tCensus tracts for income found.")
        return self
    
    def get_equity_rank(self):
        global US_median_household_income
        if not self.impact_tracts_.empty:
            self.income_ = self.impact_tracts_.Income.min()
            self.relative_income_ = abs(self.income_ - US_median_household_income)/US_median_household_income
            self.population_ = self.impact_tracts_.Population.sum()/100000
            if self.population_ < 1:
                self.population_ = 1
            elif self.population_ > 10:
                self.population_ = 10
            self.equity_score_ = self.population_ * self.modified_impact_/self.relative_income_
        else:
            print("No census tracts found for location, so no score was generated.")
            self.equity_score_ = None
        self.scored_ = True
        return self
        
class equity_rank:
    """General equity ranking algorithm for projects.
    
    Parameters
    -----------
    loc : 2-tuple float
        (Latitude, Longitude)
    sector : string
        GViP sector.
    subsector : string
        GViP subsector.
    demolition : int
        Number of homes and businesses expected to be demolished.
    benefit : int
        Each subsector has a different singular benefit.
    benefit_dist : float
        Distance in miles that the project will provide benefits for.
    regpol : int
        Score from 1 to 100. Measure of regional pollution.
        Higher scores imply more damaging pollution.
    regpol_dist : float
        Measure of the extent of pollution in miles.
    
    Attributes
    -----------
    tract_distances_ : pandas.Series int
        A list of the tract distances (indexed by Tract Code) from the project.
    benefit_tracts_ : pandas.DataFrame
        A dataframe of the tracts relevant to the project benefit (defined by
        the benefit_dist parameter).
    pollution_tracts_ : pandas.DataFrame
        A dataframe of the tracts relevant to the project pollution (defined by
        the regpol_dist parameter).
    demolition_tract_ : pandas.DataFrame
        A dataframe of the tract relevant to the project demolitions (defined by
        the tract the project is located in).
    equity_score_ : float
        Score from 1 to 100. Final equity score that is output.
    demolition_equity_ : float
        The final demolition equity score. One term of the final equity score
        sum.
    pollution_equity_ : float
        The final pollution equity score. One term of the final equity score 
        sum.
    benefit_equity_ : float
        The final benefit equity score. One term of the final equity score
        sum.
    scored_ : bool
        Tracks whether the object has an equity score.
    """
    
    def __init__(self, loc, sector, subsector, demolition=None, 
                 benefit=None, regional_benefit_distance=None,  
                 regional_pollution=None, regional_pollution_distance=None):
        self.loc = loc
        self.sector = sector
        self.subsector = subsector
        self.demolition = demolition
        self.benefit = benefit
        self.benefit_dist = regional_benefit_distance
        self.regpol = regional_pollution
        self.regpol_dist = regional_pollution_distance
        self.scored_ = False
        
        if demolition is None:
            self.demolition = 0
        if benefit is None:
            with open("./Data/benefit.json") as file:
                benefit_dict = json.load(file)[self.sector][self.subsector]
                self.benefit = benefit_dict['Benefit'] * benefit_dict['Weight']
        if regional_benefit_distance is None:
            with open("./Data/benefit_distance.json") as file:
                self.benefit_dist = json.load(file)[self.sector][self.subsector]
        if regional_pollution_distance is None:
            with open("./Data/pollution_distance.json") as file:
                self.regpol_dist = json.load(file)[self.sector][self.subsector]
        if regional_pollution is None:
            with open("./Data/pollution.json") as file:
                self.regpol = json.load(file)[self.sector][self.subsector]
                
        self.get_tracts()
        if self.demolition_tract_.empty:
            print("No tract found for demolition. Make sure lat/lng are correct and within United States.")
        elif self.pollution_tracts_.empty:
            print("No tracts found for pollution. Make sure lat/lng are correct and within United States.")
        elif self.benefit_tracts_.empty:
            print("No tracts found for benefits. Make sure lat/lng are correct and within United States.")
        else:
            if simplified == False:
                self.get_demolition_equity()
                self.get_pollution_equity()
                self.get_benefit_equity()
                self.get_equity_score()
                self.scored_ = True
            elif simplified == True:
                self.get_simplified_equity_score()
                self.scored_ = True
    
    def get_tracts(self):
        global tracts_df
        lat = self.loc[0]
        lng = self.loc[1]
        self.tract_distances_ = tracts_df.centroids.apply(
            lambda centroid: haversine((lat,lng),(centroid.y,centroid.x),unit=Unit.MILES)
            )
        self.benefit_tracts_ = tracts_df.loc[self.tract_distances_ < self.benefit_dist,:]
        self.pollution_tracts_ = tracts_df.loc[self.tract_distances_ < self.regpol_dist,:]
        self.demolition_tract_ = tracts_df.loc[self.tract_distances_==self.tract_distances_.min(),:]
        return self
    
    def get_demolition_equity(self):
        income = self.demolition_tract_.Income.min()
        self.demolition_equity_ = 100 - 3000*self.demolition/income
        return self
    def get_pollution_equity(self):
        income = self.pollution_tracts_.Income.median()
        population = self.pollution_tracts_.Population.sum()
        self.pollution_equity_ = 100 - self.regpol*population/(income*4)
        return self
    def get_benefit_equity(self):
        income = self.benefit_tracts_.Income.median()
        population = self.benefit_tracts_.Population.sum()
        self.benefit_equity_ = self.benefit*(100-income*population/4000000000)
        return self
    def get_equity_score(self):
        self.get_demolition_equity()
        self.get_pollution_equity()
        self.get_benefit_equity()
        self.equity_score_ = self.demolition_equity_ + self.pollution_equity_ + self.benefit_equity_
        #if self.equity_score_ > 100:
            #print(f"Equity score is {self.equity_score_}. Setting to maximum of 100.")
            #self.equity_score_ = 100
        #if self.equity_score_ < 0:
            #print(f"Equity score is {self.equity_score_}. Setting to minimum of 0.")
            #self.equity_score_ = 0
        print(f"Equity score is {self.equity_score_} = {self.demolition_equity_} + {self.pollution_equity_} + {self.benefit_equity_}")
        return self







