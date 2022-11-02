"""
Created on Thu Sep 30 10:11:52 2021

@author: Galen Lytle galen@cg-la.com
Title: equity_functions.py
Description:
    Functional wrappers for the classes found in "equity_rank_objects.py"
"""

from .equity_rank_objects import simplified_equity_rank
from .equity_rank_objects import equity_rank

def simplified_score_project(proj_lat,proj_lng,proj_sector,proj_subsector,proj_cost):
    obj = simplified_equity_rank(loc=(proj_lat,proj_lng),sector=proj_sector,subsector=proj_subsector,budget=proj_cost)
    return obj.equity_score_

def score_top_100(simplified=True, PW = input("Please input database password.")):
    # take in dataframe containing
        # lat
        # lng
        # sector
        # subsector
        # cost
    query_ = '''SELECT pid,
                projectname,
                description,
                lat,
                lng,
                totalbudget,
                sector,
                subsector,
                (estcompletion - CURRENT_DATE) as days
                FROM exp_projects
                WHERE pid in (399, 430, 494, 1772, 1773, 2085, 2110, 2120, 2122, 2125, 2151, 2216, 2223, 2511, 2515, 2528, 2607, 2890, 2891, 3011, 3065, 3068, 3274, 3341, 3357, 3398, 3456, 3548, 3563, 3595, 3639, 3657, 3685, 3706, 4517, 4544, 4561, 4565, 4577, 4618, 4653, 4712, 4762, 4767, 4783, 4801, 4837, 4841, 4843, 4848, 4854, 4865, 4992, 5142, 5145, 5147, 5148, 5149, 5150, 5151, 5152, 5153, 5154, 5155, 5156, 5157, 5158, 5159, 5161, 5162, 5163, 5164, 5165, 5172, 5173, 5175, 5178, 5179, 5180)
                AND eststart>CURRENT_DATE
                AND totalbudget>0
                AND lat is not null
                AND lng is not null
                AND country='United States'
                '''
    dbase = 'gvipprod'
    dbaddy='postgresql+psycopg2://gvip:{}'\
        '@gvip-instance.cihrkmeawihg.us-east-1.rds.amazonaws.com:'\
        '5432/{}'.format(PW,dbase)
    engine = create_engine(dbaddy)
    df = pd.read_sql_query(sql=query_,con=engine)
    rank_dict = {}
    print("Projects downloaded.\n")
    
    if simplified==True:
        for row in df.iterrows():
            project = row[1]
            print("Beginning to rank {}".format(project["projectname"]))
            rank_dict[project["pid"]] = simplified_equity_rank(loc=(project["lat"],project["lng"]),
                                                               sector=project["sector"],
                                                               subsector=project["subsector"],
                                                               budget=project["totalbudget"])
            if rank_dict[project["pid"]].equity_score_ is not None:
                print("\tRanked.")
        array = []
        df.set_index("pid",inplace=True)
        print("\nNow organizing ranks into dataframe.")
        for pid,rankobj in rank_dict.items():
            if rankobj.scored_:
                df_row = [pid,df.loc[pid,"projectname"],df.loc[pid,"description"],
                          rankobj.equity_score_]
                array.append(df_row)
            else:
                df_row = [pid,df.loc[pid,"projectname"],df.loc[pid,"description"],
                          pd.NA]
        rankdf = pd.DataFrame(data=array,columns=["pid","project_name","description","score"])
    
    elif simplified == False:
        for row in df.iterrows():
            project = row[1]
            rank_dict[project["pid"]] = equity_rank(loc=(project["lat"],project["lng"]),
                                                 sector=project["sector"],
                                                 subsector=project["subsector"])
        array = []
        df.set_index("pid",inplace=True)
        for pid,rankobj in rank_dict.items():
            if rankobj.scored_:
                df_row = [pid,df.loc[pid,"projectname"],df.loc[pid,"description"],
                          rankobj.demolition_equity_, rankobj.pollution_equity_,
                          rankobj.benefit_equity_,rankobj.equity_score_]
                array.append(df_row)
            else:
                df_row = [pid,df.loc[pid,"projectname"],df.loc[pid,"description"],
                          pd.NA,pd.NA,pd.NA,pd.NA]
        rankdf = pd.DataFrame(data=array,columns=["pid","project_name","description",
                                       "demolition","pollution","benefit","score"])
    return rankdf,rank_dict


    simplified_score_project(sys.argv[1],sys.argv[2],sys.argv[3],sys.argv[4],sys.argv[5])