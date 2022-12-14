<div class="centercontent">

		<div class="pageheader notab">
						<h1 class="pagetitle"><?php echo $title; ?></h1>
						<a class="right goback" style="margin-right:20px;" href="/admin.php/projects/view_all_projects"><span>Back</span></a>
						<div class="pagetitle2"><?php echo $project["projectname"];?></div>
						<span class="pagedesc">&nbsp;</span>
				<div class="navoptions">
						<?php
							$leftnavlist = array(
								'<a href="/admin.php/projects/edit/'.$slug.'">Project Information</a>',
								'<a href="/admin.php/projects/edit_fundamentals/'.$slug.'">Fundamentals</a>',
								'<a href="/admin.php/projects/edit_financial/'.$slug.'">Financial</a>',
								'<a href="/admin.php/projects/edit_regulatory/'.$slug.'">Regulatory</a>',
								'<a href="/admin.php/projects/edit_participants/'.$slug.'">Participants</a>',
								'<a href="/admin.php/projects/edit_procurement/'.$slug.'">Procurement</a>',
								'<a href="/admin.php/projects/edit_files/'.$slug.'">Files</a>'
							);

					$leftnavattrib = array(
					'id' => 'profile_nav'
				);
				if(!isset($vtab_position))
				{
					$vtab_position = 0;
				}
				for($i=0;$i<count($leftnavlist);$i++)
				{
					if($i == $vtab_position)
					{
						$listattributes[]='class="here"';
					}
					else
					{
						$listattributes[]='';
					}
				}
				echo ul_custom($leftnavlist,$leftnavattrib,$listattributes);
				?>
				</div>

				</div><!--pageheader-->


				<div id="contentwrapper" class="contentwrapper">
												 <div class="widgetcontent">


			<div id="content" class="clearfix">


					<?php
					if($project["eststart"] == "1111-11-11" && $project["eststart"] != "") { $eststart = DateFormat($project["eststart"],DATEFORMAT,FALSE); } else { $eststart = ""; }
					if($project["estcompletion"] != "1111-11-11" && $project["eststart"] != "") { $estcompletion = DateFormat($project["estcompletion"],DATEFORMAT,FALSE); } else { $estcompletion = ""; }

                    //Set extended categories to empty strings if array is null
                    if(count_if_set($project["energy"]) <= 0) {
                        $project["energy"] = array("generation"=>"","storage"=>"","trans_dist"=>"","trans_cap"=>"","reduced_water"=>"","hydrogen_tons"=>"");
                    }
                    if(count_if_set($project["water"]) <= 0) {
                        $project["water"] = array("total_capacity"=>"");
                    }
                    if(count_if_set($project["transport"]) <= 0) {
                        $project["transport"] = array("miles"=>"","add_riders"=>"","add_goods"=>"","vmt"=>"","avg_ridership"=>"","capacity_added"=>"");
                    }
                    if(count_if_set($project["IT"]) <= 0) {
                        $project["IT"] = array("mb_per_sec"=>"");
                    }

						$opt["project_form"] = array(
								'title'	=> array(
												'id'	=> 'title_input',
												'value' => $project["projectname"],
												'name'	=> 'title_input'
										),
										'lbl_photo_privacy' => array(
											'class' => 'above_label'
										),
										'privacy_options' => array(
									'Private'	=> 'Private',
									'Specific'	=> 'Specific',
									'Similar Project Owners'	=> 'Similar Project Owners'
								),
								'lbl_photo_description' => array(
									'class' => 'above_label'
								),
								'project_photo' => array(
									'name' 	=> 'project_photo',
									'id'	=> 'project_photo',
								),
								'photo_submit' => array(
									'name'	=> 'photo_submit',
									'value' => 'Upload',
									'class'	=> 'photo_submit light_green floatleft'
								),
								'project_submit' => array(
									'name'	=> 'project_submit',
									'value' => 'Update',
									'class'	=> 'project_submit light_green floatleft'
								),
								'lbl_project_meta_permissions' => array(
									'class'	=> 'above_label'
								),
								'lbl_project_overview' => array(
									'class'	=> 'left_label'
								),
								'project_overview' => array(
									'name'	=> 'project_overview',
									'style'	=> 'width:300px;float:left;',
									'value'	=> $project["description"],
									'id'	=> 'project_overview'
								),
								'lbl_project_keywords' => array(
									'class'	=> 'left_label'
								),
								'project_keywords' => array(
									'id'	=> 'project_keywords',
									'name'	=> 'project_keywords',
									'value'	=> $project["keywords"]
								),
								'lbl_project_country' => array(
									'class'	=> 'left_label'
								),
								'lbl_project_location' => array(
									'class'	=> 'left_label'
								),
								'project_location' => array(
									'id'	=> 'project_location',
									'name'	=> 'project_location',
									'value'	=> $project["location"]
								),
								'lbl_project_sector_main' => array(
									'class'	=> 'left_label'
								),
								'lbl_project_sector_sub' => array(
									'class'	=> 'left_label'
								),
								'lbl_project_sector_sub_other' => array(
									'class'	=> 'left_label'
								),
								'project_sector_sub_other' => array(
									'id'	=> 'project_sector_sub_other',
									'name'	=> 'project_sector_sub_other',
									'disabled' => 'disabled',
									'value'	=> $project["subsector_other"]
								),
								'lbl_project_budget_max' => array(
									'class'	=> 'left_label'
								),
								'project_budget_max' => array(
									'id'	=> 'project_budget_max',
									'name'	=> 'project_budget_max',
									'value'	=> $project["totalbudget"]
								),
								'lbl_project_financial' => array(
									'class'	=> 'left_label'
								),
								'lbl_project_fs_other' => array(
									'class'	=> 'left_label'
								),
								'project_fs_other' => array(
									'id'	=> 'project_fs_other',
									'name'	=> 'project_fs_other',
									'disabled' => 'disabled',
									'value'	=> $project["financialstructure_other"]
								),
								'lbl_stage_date' => array(
									'class'	=> 'left_label'
								),
								'lbl_stage_budget' => array(
									'class'	=> 'left_label'
								),
								'lbl_stage_comments' => array(
									'class'	=> 'left_label'
								),
								'lbl_project_eststart' => array(
									'class' => 'left_label'
								),
								'project_eststart' => array(
									'id'	=> 'project_estsrart_picker',
									'name'	=> 'project_estsrart',
									'value'	=> $eststart,
									'class' => 'sm_left datepicker_month_year',
									'style' => 'width:120px'
								),
								'lbl_project_estcompletion' => array(
									'class' => 'left_label'
								),
								'project_estcompletion' => array(
									'id'	=> 'project_estcompletion_picker',
									'name'	=> 'project_estcompletion',
									'value'	=> $estcompletion,
									'class' => 'sm_left datepicker_month_year',
									'style' => 'width:120px'
								),
								'lbl_project_sponsor' => array(
									'class'	=> 'left_label'
								),
								'project_sponsor' => array(
									'id'	=> 'project_sponsor',
									'name'	=> 'project_sponsor',
									'value'	=> $project["sponsor"]
								),
								'lbl_project_developer' => array(
									'class'	=> 'left_label'
								),
								'project_developer' => array(
									'id'	=> 'project_developer',
									'name'	=> 'project_developer',
									'value'	=> $project["developer"]
								),
								'lbl_project_owner' => array(
									'class'	=> 'left_label'
								),
								'project_owner' => array(
									'id'	=> 'project_owner',
									'name'	=> 'project_owner',
									'value' => $project["uid"],
									'select'=> $members
								),
                                'lbl_people_served' => array(
                                    'class'	=> 'left_label'
                                ),
                                'people_served' => array(
                                    'id'	=> 'people_served',
                                    'name'	=> 'people_served',
                                    'value' => $project["people_served"],
                                ),
                                'lbl_property_val' => array(
                                    'class'	=> 'left_label'
                                ),
                                'property_val' => array(
                                    'id'	=> 'property_val',
                                    'name'	=> 'property_val',
                                    'value' => $project["property_val"],
                                ),
                                'lbl_marg_peopleserved' => array(
                                    'class'	=> 'left_label'
                                ),
                                'marg_peopleserved' => array(
                                    'id'	=> 'marg_peopleserved',
                                    'name'	=> 'marg_peopleserved',
                                    'value' => $project["marg_peopleserved"],
                                ),
                                'lbl_co2_saved' => array(
                                    'class'	=> 'left_label'
                                ),
                                'co2_saved' => array(
                                    'id'	=> 'co2_saved',
                                    'name'	=> 'co2_saved',
                                    'value' => $project["co2_saved"],
                                ),
                                'lbl_econ_benefits' => array(
                                    'class'	=> 'left_label'
                                ),
                                'econ_benefits' => array(
                                    'id'	=> 'econ_benefits',
                                    'name'	=> 'econ_benefits',
                                    'value' => $project["econ_impact"],
                                ),
                                'lbl_oil_eliminated' => array(
                                    'class'	=> 'left_label'
                                ),
                                'oil_eliminated' => array(
                                    'id'	=> 'oil_eliminated',
                                    'name'	=> 'oil_eliminated',
                                    'value' => $project["oil_eliminated"],
                                ),
                                'lbl_econ_impact' => array(
                                    'class'	=> 'left_label'
                                ),
                                'econ_impact' => array(
                                    'id'	=> 'econ_impact',
                                    'name'	=> 'econ_impact',
                                    'value' => $project["econ_impact"],
                                ),

                                //Energy
                                'lbl_generation' => array(
                                    'class'	=> 'left_label'
                                ),
                                'generation' => array(
                                    'id'	=> 'generation',
                                    'name'	=> 'generation',
                                    'value' => $project["energy"]["generation"],
                                ),
                                'lbl_storage' => array(
                                    'class'	=> 'left_label'
                                ),
                                'storage' => array(
                                    'id'	=> 'storage',
                                    'name'	=> 'storage',
                                    'value' => $project["energy"]["storage"],
                                ),

                                //Transmission
                                'lbl_trans_dist' => array(
                                    'class'	=> 'left_label'
                                ),
                                'trans_dist' => array(
                                    'id'	=> 'trans_dist',
                                    'name'	=> 'trans_dist',
                                    'value' => $project["energy"]["trans_dist"],
                                ),
                                'lbl_trans_cap' => array(
                                    'class'	=> 'left_label'
                                ),
                                'trans_cap' => array(
                                    'id'	=> 'trans_cap',
                                    'name'	=> 'trans_cap',
                                    'value' => $project["energy"]["trans_cap"],
                                ),
                                'lbl_reduced_water' => array(
                                    'class'	=> 'left_label'
                                ),
                                'reduced_water' => array(
                                    'id'	=> 'reduced_water',
                                    'name'	=> 'reduced_water',
                                    'value' => $project["energy"]["reduced_water"],
                                ),

                                //Hydrogen
                                'lbl_hydrogen_tons' => array(
                                    'class'	=> 'left_label'
                                ),
                                'hydrogen_tons' => array(
                                    'id'	=> 'hydrogen_tons',
                                    'name'	=> 'hydrogen_tons',
                                    'value' => $project["energy"]["hydrogen_tons"],
                                ),

                                //Internet
                                'lbl_mb_per_sec' => array(
                                    'class'	=> 'left_label'
                                ),
                                'mb_per_sec' => array(
                                    'id'	=> 'mb_per_sec',
                                    'name'	=> 'mb_per_sec',
                                    'value' => $project["IT"]["mb_per_sec"],
                                ),

                                //Transport
                                'lbl_miles' => array(
                                    'class'	=> 'left_label'
                                ),
                                'miles' => array(
                                    'id'	=> 'miles',
                                    'name'	=> 'miles',
                                    'value' => $project["transport"]["miles"],
                                ),
                                'lbl_add_riders' => array(
                                    'class'	=> 'left_label'
                                ),
                                'add_riders' => array(
                                    'id'	=> 'add_riders',
                                    'name'	=> 'add_riders',
                                    'value' => $project["transport"]["add_riders"],
                                ),
                                'lbl_add_goods' => array(
                                    'class'	=> 'left_label'
                                ),
                                'add_goods' => array(
                                    'id'	=> 'add_goods',
                                    'name'	=> 'add_goods',
                                    'value' => $project["transport"]["add_goods"],
                                ),

                                //Transit
                                'lbl_vmt' => array(
                                    'class'	=> 'left_label'
                                ),
                                'vmt' => array(
                                    'id'	=> 'vmt',
                                    'name'	=> 'vmt',
                                    'value' => $project["transport"]["vmt"],
                                ),
                                'lbl_avg_ridership' => array(
                                    'class'	=> 'left_label'
                                ),
                                'avg_ridership' => array(
                                    'id'	=> 'avg_ridership',
                                    'name'	=> 'avg_ridership',
                                    'value' => $project["transport"]["avg_ridership"],
                                ),

                                //Ports
                                'lbl_capacity_added' => array(
                                    'class'	=> 'left_label'
                                ),
                                'capacity_added' => array(
                                    'id'	=> 'capacity_added',
                                    'name'	=> 'capacity_added',
                                    'value' => $project["transport"]["capacity_added"],
                                ),

                                //Water
                                'lbl_total_capacity' => array(
                                    'class'	=> 'left_label'
                                ),
                                'total_capacity' => array(
                                    'id'	=> 'total_capacity',
                                    'name'	=> 'total_capacity',
                                    'value' => $project["water"]["total_capacity"],
                                ),
							 );
					?>


					<div id="col5">

					<div id="tabContainer">
						<div id="profile_tabs">

							<?php
								$tablist = array(
									'<a href="#tabs-1">General</a>',
									'<a href="#tabs-2">Project Executives</a>',
									'<a href="#tabs-3">Project Organizations</a>',
									'<a href="#tabs-4">CG/LA Assessment</a>'
								);

								echo ul($tablist);
							?>

							<div id="tabs-1" class="col5_tab">
									<div class="clearfix ">

									<div id="project_info_tab" style="display:table; width:100%;">
									
									<div class="floatleft clearfix" id="div_project_photo_form" style="position:relative;width:44%;">
										<div class="contenttitle2">
														<h3>Project Photo</h3>
												</div>
												<br/>
												<?php echo form_open_multipart("projects/upload_projectphoto/".$slug."",array("id"=>"project_form_upload","name"=>"project_form_upload","class"=>"ajax_add_form")); ?>

											<div class="clearfix ">
													<div class="image_placeholder" style="width:35%;float:left; min-height:185px; margin-right:10px;">
													<?php //project_image($img = '', $size = false, $options = array()
														$img = project_image($project["projectphoto"], 150, array('rounded_corners'=>false) );
													?>
													<img src="<?php echo $img;?>" class="uploaded_img" alt="project image"/>
													</div>
													<div class="permissions_block field">
														<div class="arrow"></div>
														<?php echo form_label("Privacy:","project_photos_permissions",$opt["project_form"]["lbl_photo_privacy"]); ?>
														<?php echo form_dropdown('project_photos_permissions', $opt["project_form"]["privacy_options"],$project["project_photos_permissions"]); ?>
													</div>

													<div style="float:left;">
														<?php echo form_label("Select an Image from your compute (5MB max):","",$opt["project_form"]["lbl_photo_description"]); ?>
														<div class="fld">
															<?php echo form_upload($opt["project_form"]["project_photo"]); ?>
															<div class="errormsg" id="err_project_photo"><?php echo $photoerror; ?></div>
														<?php echo form_hidden("project_phot_hidden",$project["projectphoto"]); ?>
														<span class="comment">Compatible file types: JPEG, GIF, PNG</span>
														</div>
													</div>
													<?php echo form_submit($opt["project_form"]["photo_submit"]);  ?>

											</div>
										<?php echo form_close();?>
									</div><!-- end #div_project_photo_form -->

								<div class="floatleft" id="div_project_info_form" style="position:relative;width:48%">

								<div class="notibar_add" style="display:none">
													<a class="close"></a>
													<p></p>
											</div>

								<div class="contenttitle2">
												<h3>Project Information:</h3>
										</div>
										<br/>

								<div class="clearfix ">

									<?php echo form_open_multipart("projects/edit/".$slug."",array("id"=>"project_form_main","class"=>"project_form ajax_add_form")); ?>

									<div class="field">
										Project Title:
										<?php echo form_input($opt["project_form"]["title"]); ?>
										<div class="errormsg" id="err_title_input"><?php echo form_error("title_input"); ?></div>
									</div>

									<div class="hiddenFields">
										<?php echo form_hidden("return","projects/edit/".$slug); ?>
										<?php echo form_hidden_custom("select_stage",$project["stage"],FALSE,"id='select_stage'"); ?>
										<?php echo form_hidden_custom("title_input_hidden",$project["projectname"],FALSE,"id='title_input_hidden'"); ?>
									</div>

									Project Owner:
									<div class="fld">
										<?php echo form_dropdown(
											$opt["project_form"]["project_owner"]['name'], 
											$opt["project_form"]['project_owner']['select'],
											$opt["project_form"]['project_owner']["value"],
											'class="chzn-select"'); 
										?>
										<div class="errormsg" id="err_project_owner"><?php echo form_error("project_owner"); ?></div>
									</div>
									<br>

									<div class="field" style="display:table;width:100%;">

										<?php echo form_label("Description:","project_overview",$opt["project_form"]["lbl_project_overview"]); ?>
										<div class="fld">
											<?php echo form_textarea($opt["project_form"]["project_overview"]); ?>
											<div class="errormsg" id="err_project_overview"><?php echo form_error("project_overview"); ?></div>
										</div>

										<div class="permissions_block" style="margin-left:10px;">
											<div class="arrow"></div>
											<?php echo form_label("Privacy:","project_meta_permissions",$opt["project_form"]["lbl_project_meta_permissions"]); ?>
											<?php echo form_dropdown('project_meta_permissions', $opt["project_form"]["privacy_options"], $project["project_meta_permissions"]); ?>
										</div>

									</div>

									<?php echo form_label("Keywords:","project_keywords",$opt["project_form"]["lbl_project_keywords"]); ?>
									<div class="fld">
										<?php echo form_input($opt["project_form"]["project_keywords"]); ?>
										<div class="errormsg" id="err_project_keywords"><?php echo form_error("project_keywords"); ?></div>
										<span class="example">Separate each keyword with commas (ex: bridge, toll, construction)</span>
									</div>
									<br>

									<?php echo form_label("Country:","project_country",$opt["project_form"]["lbl_project_country"]); ?>
									<div class="fld">
										<?php
											$project_country_attr = 'id="project_country"';
											$project_country_options = country_dropdown();
											echo form_dropdown('project_country', $project_country_options,$project["country"],$project_country_attr);
										?>
										<div class="errormsg" id="err_project_country"><?php echo form_error("project_country"); ?></div>
									</div>
									<br>

									<?php echo form_label("Location:","project_location",$opt["project_form"]["lbl_project_location"]); ?>
									<div class="fld">
										<?php echo form_input($opt["project_form"]["project_location"]); ?>
										<div class="errormsg" id="err_project_location"><?php echo form_error("project_location"); ?></div>
									</div>
									<br>

									<div>
														<?php echo form_label("Sector:","project_sector_main",$opt["project_form"]["lbl_project_sector_main"]); ?>
													<div class="fld">
															<?php
																$project_sector_main_attr	= 'id="project_sector_main" onchange="sectorbind_proj('.$users.');"';
																$sector_option = array();
																$sector_opt =array();
																foreach(sectors() as $key=>$value)
																{
																	$sector_options[$value] = $value;
																	$sector_opt[$value] 	= 'class="sector_main_'.$key.'"';
																}
																$sector_first			= array('class'=>'hardcode','text'=>'- Select A Sector -','value'=>'');
																$sector_last			= array();

																echo form_custom_dropdown('project_sector_main', $sector_options,$project["sector"],$project_sector_main_attr,$sector_opt,$sector_first,$sector_last);
															?>
															<div class="fld errormsg" style="clear:both;"><?php echo form_error('member_sector');?></div>
														</div>
													</div>
													<br/>
													<div class="fld">
														<?php echo form_label('Sub-Sector:', 'project_sector_sub', $opt['project_form']['lbl_project_sector_sub']);?>
														<div  id="dynamicSubsector"  class="fld">

														<?php
															$selected_sector	= getsectorid("'".$project['subsector']."'",1);
															$project_sector_sub_attr 		= 'id="project_sector_sub" class="project_sub"';
															$subsector_options 	= array();
															$subsector_opt		= array();

															foreach(subsectors() as $key=>$value)
															{
																foreach($value as $key2=>$value2)
																{
																	if($key != $selected_sector)
																	{
																		continue;
																	}
																	$subsector_options[$value2] 	= $value2;
																	$subsector_opt[$value2] 		= 'class="project_sector_sub_'.$key.'"';
																}
															}
															$subsector_first			= array('class'=>'hardcode','text'=>'- Select A Sub-Sector -','value'=>'');
															$subsector_last				= array('class'=>'hardcode','value'=>'Other','text'=>'Other');
															echo form_custom_dropdown('project_sector_sub', $subsector_options,$project['subsector'],$project_sector_sub_attr,$subsector_opt,$subsector_first,$subsector_last);
														?>
														<div class="fld errormsg" style="clear:both;"></div>
														</div>
														<div style="display:none">

															<?php echo form_label('Sub-Sector Other:', 'project_sector_sub_other', $opt['project_form']['lbl_sub_sector_other']);?>
															<div class="fld" >
																<?php echo form_input($opt['project_form']['project_sub_sector_other']);?>
															</div>
														</div>
													</div>
									<br>

									<div style="display:none">
										<?php echo form_label("Other:","project_sector_sub_other",$opt["project_form"]["lbl_project_sector_sub_other"]); ?>
										<?php echo form_input($opt["project_form"]["project_sector_sub_other"]); ?>
										<div class="errormsg" id="err_project_subsector_other"></div>
									</div>


                                    <div id="energyfields" <?php if($project['sector'] != 'Energy'){ ?>style="display: none" <?php } ?>>
                                        <br>
                                        Energy Specific Fields
                                        <br>
                                        <?php echo form_label("Generation (MegaWatts):","generation",$opt["project_form"]["lbl_generation"]); ?>
                                        <div class="fld">
                                            <?php
                                            echo form_input($opt["project_form"]["generation"]);
                                            ?>
                                            <div class="errormsg" id="err_generation"></div>
                                        </div>

                                        <br>
                                        <?php echo form_label("Storage (MegaWatts Hours):","storage",$opt["project_form"]["lbl_storage"]); ?>
                                        <div class="fld">
                                            <?php
                                            echo form_input($opt["project_form"]["storage"]);
                                            ?>
                                            <div class="errormsg" id="err_storage"></div>
                                        </div>
                                        <br>
                                        <?php echo form_label("Reduced Water Use (Millions of Gallons):","reduced_water",$opt["project_form"]["lbl_reduced_water"]); ?>
                                        <div class="fld">
                                            <?php
                                            echo form_input($opt["project_form"]["reduced_water"]);
                                            ?>
                                            <div class="errormsg" id="err_reduced_water"></div>
                                        </div>
                                    </div>

                                    <div id="transmissionfields" <?php if($project['subsector'] != 'Transmission'){ ?>style="display: none" <?php }?>>
                                        <br>
                                        Energy Transmission Specific Fields
                                        <br>
                                        <?php echo form_label("Transmission Distance (Miles):","trans_dist",$opt["project_form"]["lbl_trans_dist"]); ?>
                                        <div class="fld">
                                            <?php
                                            echo form_input($opt["project_form"]["trans_dist"]);
                                            ?>
                                            <div class="errormsg" id="err_trans_dist"></div>
                                        </div>

                                        <br>
                                        <?php echo form_label("Transmission Delivery Capacity (MegaWatts):","trans_cap",$opt["project_form"]["lbl_trans_cap"]); ?>
                                        <div class="fld">
                                            <?php
                                            echo form_input($opt["project_form"]["trans_cap"]);
                                            ?>
                                            <div class="errormsg" id="err_hydrogen_prod"></div>
                                        </div>
                                    </div>

                                    <div id="hydrogenfields" <?php if($project['subsector'] != 'Hydrogen'){ ?>style="display: none" <?php }?>>
                                        <br>
                                        Hydrogen Specific Fields
                                        <br>
                                        <?php echo form_label("Hydrogen Produced (Metric Tons / Day):","hydrogen_tons",$opt["project_form"]["lbl_hydrogen_tons"]); ?>
                                        <div class="fld">
                                            <?php
                                            echo form_input($opt["project_form"]["hydrogen_tons"]);
                                            ?>
                                            <div class="errormsg" id="err_hydrogen_tons"></div>
                                        </div>
                                    </div>

                                    <div id="transportfields" <?php if($project['sector'] != 'Transport'){ ?>style="display: none" <?php }?>>
                                        <br>
                                        Transport Specific Fields
                                        <br>
                                        <?php echo form_label("Distance (miles):","miles",$opt["project_form"]["lbl_miles"]); ?>
                                        <div class="fld">
                                            <?php
                                            echo form_input($opt["project_form"]["miles"]);
                                            ?>
                                            <div class="errormsg" id="err_miles"></div>
                                        </div>

                                        <br>
                                        <?php echo form_label("Additional Daily Riders:","add_riders",$opt["project_form"]["lbl_add_riders"]); ?>
                                        <div class="fld">
                                            <?php
                                            echo form_input($opt["project_form"]["add_riders"]);
                                            ?>
                                            <div class="errormsg" id="err_add_riders"></div>
                                        </div>
                                        <br>
                                        <?php echo form_label("Additional Daily Goods (Metric Tons / Day):","add_goods",$opt["project_form"]["lbl_add_goods"]); ?>
                                        <div class="fld">
                                            <?php
                                            echo form_input($opt["project_form"]["add_goods"]);
                                            ?>
                                            <div class="errormsg" id="err_add_goods"></div>
                                        </div>
                                    </div>

                                    <div id="transitfields" <?php if($project['subsector'] != 'Transit'){ ?>style="display: none" <?php }?>>
                                        <br>
                                        Transit Specific Fields
                                        <br>
                                        <?php echo form_label("Automobile Vehicle Miles Traveled:","vmt",$opt["project_form"]["lbl_vmt"]); ?>
                                        <div class="fld">
                                            <?php
                                            echo form_input($opt["project_form"]["vmt"]);
                                            ?>
                                            <div class="errormsg" id="err_vmt"></div>
                                        </div>

                                        <br>
                                        <?php echo form_label("Average Weekday Ridership:","avg_ridership",$opt["project_form"]["lbl_avg_ridership"]); ?>
                                        <div class="fld">
                                            <?php
                                            echo form_input($opt["project_form"]["avg_ridership"]);
                                            ?>
                                            <div class="errormsg" id="err_avg_ridership"></div>
                                        </div>
                                    </div>

                                    <div id="portsfields" <?php if($project['subsector'] != 'Ports & Logistics'){ ?>style="display: none" <?php }?>>
                                        <br>
                                        Ports Specific Fields
                                        <br>
                                        <?php echo form_label("Capacity Added (TEU's):","capacity_added",$opt["project_form"]["lbl_capacity_added"]); ?>
                                        <div class="fld">
                                            <?php
                                            echo form_input($opt["project_form"]["capacity_added"]);
                                            ?>
                                            <div class="errormsg" id="err_capacity_added"></div>
                                        </div>
                                    </div>

                                    <div id="ITfields" <?php if($project['sector'] != 'Information & Communication Technologies'){ ?>style="display: none" <?php }?>>
                                        <br>
                                        IT Specific Fields
                                        <br>
                                        <?php echo form_label("Megabytes Per Second:","mb_per_sec",$opt["project_form"]["lbl_mb_per_sec"]); ?>
                                        <div class="fld">
                                            <?php
                                            echo form_input($opt["project_form"]["mb_per_sec"]);
                                            ?>
                                            <div class="errormsg" id="err_mb_per_sec"></div>
                                        </div>
                                    </div>

                                    <div id="waterfields" <?php if($project['sector'] != 'Water'){ ?>style="display: none" <?php }?>>
                                        <br>
                                        Water Specific Fields
                                        <br>
                                        <?php echo form_label("Total Capacity (Millions of Gallons / Day):","total_capacity",$opt["project_form"]["lbl_total_capacity"]); ?>
                                        <div class="fld">
                                            <?php
                                            echo form_input($opt["project_form"]["total_capacity"]);
                                            ?>
                                            <div class="errormsg" id="err_total_capacity"></div>
                                        </div>
                                    </div>


									<?php echo form_label("Est. Start:","project_eststart",$opt["project_form"]["lbl_project_eststart"]); ?>
									<div class="fld">
										<?php echo form_input($opt["project_form"]["project_eststart"]); ?>
										<div class="errormsg" id="err_project_eststart"><?php echo form_error("project_eststart"); ?></div>
									</div>
									<br>

									<?php echo form_label("Est. Completion:","project_estcompletion",$opt["project_form"]["lbl_project_estcompletion"]); ?>
									<div class="fld">
										<?php echo form_input($opt["project_form"]["project_estcompletion"]); ?>
										<div class="errormsg" id="err_project_estcompletion"><?php echo form_error("project_estcompletion"); ?></div>
									</div>
									<br>

									<?php echo form_label("Developer:","project_developer",$opt["project_form"]["lbl_project_developer"]); ?>
									<div class="fld">
										<?php echo form_input($opt["project_form"]["project_developer"]); ?>
										<div class="errormsg" id="err_project_developer"><?php echo form_error("project_developer"); ?></div>
									</div>
									<br>

									<?php echo form_label("Sponsor:","project_sponsor",$opt["project_form"]["lbl_project_sponsor"]); ?>
									<div class="fld">
										<?php echo form_input($opt["project_form"]["project_sponsor"]); ?>
										<div class="errormsg" id="err_project_sponsor"><?php echo form_error("project_sponsor"); ?></div>
									</div>
									<br>

                                    <?php echo form_label('Website:', 'website', array('class' => 'left_label')) ?>
                                    <div class="fld">
                                        <?php echo form_input('website', set_value('website', $project['website'])) ?>
                                        <div class="errormsg" id="err_project_sponsor"><?php echo form_error('website') ?></div>
                                    </div>
                                    <br>

                                    <?php echo form_label('People Served:',"people_served",$opt["project_form"]["lbl_people_served"]); ?>
                                    <div class="fld">
                                        <?php echo form_input($opt["project_form"]["people_served"]); ?>
                                        <div class="errormsg" id="err_people_served"><?php echo form_error("people_served"); ?></div>
                                    </div>
                                    <br>

                                    <?php echo form_label('Increased Property Value ($MM):',"property_val",$opt["project_form"]["lbl_property_val"]); ?>
                                    <div class="fld">
                                        <?php echo form_input($opt["project_form"]["property_val"]); ?>
                                        <div class="errormsg" id="err_property_val"><?php echo form_error("property_val"); ?></div>
                                    </div>
                                    <br>

                                    <?php echo form_label('Marginal People Served',"marg_peopleserved",$opt["project_form"]["lbl_marg_peopleserved"]); ?>
                                    <div class="fld">
                                        <?php echo form_input($opt["project_form"]["marg_peopleserved"]); ?>
                                        <div class="errormsg" id="err_marg_peopleserved"><?php echo form_error("marg_peopleserved"); ?></div>
                                    </div>
                                    <br>

                                    <?php echo form_label('Carbon Emissions Saved (Metric Tons / Year):',"co2_saved",$opt["project_form"]["lbl_co2_saved"]); ?>
                                    <div class="fld">
                                        <?php echo form_input($opt["project_form"]["co2_saved"]); ?>
                                        <div class="errormsg" id="err_co2_saved"><?php echo form_error("co2_saved"); ?></div>
                                    </div>
                                    <br>

                                    <?php echo form_label('Economic Impact ($MM / Year):',"econ_impact",$opt["project_form"]["lbl_econ_impact"]); ?>
                                    <div class="fld">
                                        <?php echo form_input($opt["project_form"]["econ_impact"]); ?>
                                        <div class="errormsg" id="err_econ_impact"><?php echo form_error("econ_impact"); ?></div>
                                    </div>
                                    <br>

                                    <?php echo form_label('Fossil Fuels Eliminated (Metric Tons / Year):',"oil_eliminated",$opt["project_form"]["lbl_oil_eliminated"]); ?>
                                    <div class="fld">
                                        <?php echo form_input($opt["project_form"]["oil_eliminated"]); ?>
                                        <div class="errormsg" id="err_oil_eliminated"><?php echo form_error("oil_eliminated"); ?></div>
                                    </div>
                                    <br>

                                    <?php echo form_label('Fossil Fuels Eliminated (Metric Tons / Year):',"oil_eliminated",$opt["project_form"]["lbl_oil_eliminated"]); ?>
                                    <div class="fld">
                                        <?php echo form_input($opt["project_form"]["oil_eliminated"]); ?>
                                        <div class="errormsg" id="err_oil_eliminated"><?php echo form_error("oil_eliminated"); ?></div>
                                    </div>
                                    <br>

                                    <?php echo form_label('Total Budget ($MM):',"project_budget_max",$opt["project_form"]["lbl_project_budget_max"]); ?>
                                    <div class="fld">
                                        <?php echo form_input($opt["project_form"]["project_budget_max"]); ?>
                                        <div class="errormsg" id="err_project_budget_max"><?php echo form_error("project_budget_max"); ?></div>
                                        <span class="example">Empty or 0 (zero) value means the budget is to be determined (TBD)</span>
                                    </div>
                                    <br>

									<?php echo form_label("Financial Structure:","project_financial",$opt["project_form"]["lbl_project_financial"]); ?>
									<div class="fld">
										<?php
											$project_financial_attr = 'id="project_financial"';
											$project_financial_options = array(
												''			=> '- Select One -',
												'Public'	=> 'Public',
												'Private'	=> 'Private',
												'PPP'		=> 'PPP',
												'Concession'=> 'Concession',
												'Design, Build' => 'Design, Build',
												'Other'		=> 'Other'
											);
											echo form_dropdown('project_financial', $project_financial_options,$project["financialstructure"],$project_financial_attr);
										?>
										<div class="errormsg" id="err_project_financial"><?php echo form_error("project_financial"); ?></div>
									</div>
									<br>

									<div style="display:none">
										<?php echo form_label("Other:","project_fs_other",$opt["project_form"]["lbl_project_fs_other"]); ?>
										<?php echo form_input($opt["project_form"]["project_fs_other"]); ?>
										<div class="errormsg" id="err_project_fs_other"></div>
									</div>


									<?php echo form_label("Stage:","project_stage",array("class"=>"left_label")); ?>
									<div class="fld">
										<?php
											$project_stage_attr = 'id="project_stage"';
											$project_stage_options = array(
												''			=> '- Select A Stage -',
												'conceptual'	=> 'Conceptual',
												'feasibility'	=> 'Feasibility',
												'planning'		=> 'Planning',
												'procurement'	=> 'Procurement',
												'construction'=> 'Construction',
												'om' => 'Operation & Maintenance',
											);
											echo form_dropdown('project_stage', $project_stage_options,$project["stage"],$project_stage_attr);
										?>
										<div class="errormsg" id="err_project_stage"></div>
									</div>

									<br>

									<?php /*<div>
										<?php

											if(isset($project['isforum'])&&$project['isforum']=='1')
											{
												$isforumCheck = TRUE;
											}
											else
											{
												$isforumCheck = FALSE;
											}

											$is_forum_data = array(
													'name'        => 'project_isforum',
													'id'          => 'project_isforum',
													'value'       => '1',
													'checked'     => $isforumCheck,
											);
											echo form_checkbox($is_forum_data);?>
										<?php echo form_label('Forum Attending ', 'project_isforum');?>
									</div>
									<?php */ ?>

									<?php echo form_submit('project_submit', 'Update Project','class = "light_green no_margin_left"');?>

								<?php echo form_close(); ?>
								</div>

							</div>
							</div>
							</div>
							</div>



							<div id="tabs-2" class="col5_tab project_form">

							<div id="tab_innerarea_list">
								<div class="view_list clearfix">
								<div class="contenttitle2">
												<h3>Executive List</h3>
										</div>

										<div class="notibar" style="display:none">
												<a class="close"></a>
												<p></p>
										</div>

								 <div class="tableoptions">
															<button class="deletebutton radius3" title="Delete Selected" name="dyntable_executive" id="#/admin.php/projects/delete_executive">Delete Executive</button> &nbsp;
															</div><!--tableoptions-->
														<table cellpadding="0" cellspacing="0" border="0" class="stdtable" id="dyntable_executive">
																<colgroup>
																		<col class="con0" style="width: 4%" />
																		<col class="con1" />
																		<col class="con0" />
																		<col class="con1" />
																		<col class="con0" />
																		<col class="con1" />
																		<col class="con0" />
																</colgroup>
																<thead>
																		<tr>
																			<th class="head0 nosort" align="center"><?php echo form_checkbox(array("id"=>"select_all_header","name"=>"select_all_header","class"=>"checkall")); ?></th>
																				<th class="head1">ID</th>
																				<th class="head0">Name</th>
																				<th class="head1">Company</th>
																				<th class="head0">Role</th>
																				<th class="head1">Email</th>
																				<th class="head0 nosort">Action</th>
																		</tr>
																</thead>
																<tfoot>
																		<tr>
																			<th class="head0" align="center"><span class="center"><?php echo form_checkbox(array("id"=>"select_all_footer","name"=>"select_all_footer","class"=>"checkall")); ?></span></th>
																				<th class="head1">ID</th>
																				<th class="head0">Name</th>
																				<th class="head1">Company</th>
																				<th class="head0">Role</th>
																				<th class="head1">Email</th>
																				<th class="head0 nosort">Action</th>
																		</tr>
																</tfoot>
																<tbody>
																	<?php
																	if(count($project['executive']) > 0)
												{
													foreach($project["executive"] as $key=>$val)
													{
												?>
												<tr>
														<td align="center"><span class="center"><?php echo form_checkbox(array("id"=>"select_".$val['id']."","name"=>"select_".$val['id']."","value"=>$val['id'])); ?></span></td>
																				<td><?php echo $val['id']; ?></td>
																				<td><?php echo $val['executivename']; ?></td>
																				<td><?php echo $val['company'];?></td>
																				<td><?php echo $val['role'];?></td>
																				<td><?php echo $val['email'];?></td>
																				<td><a href="javascript:void(0);" onclick="load_project_edit_from('<?php echo $slug;?>',<?php echo $val['id'];?>,'project_executives','add_project_executive')">Edit</a></td>
																		</tr>

												<?php

													}
												}
												?>
																</tbody>
														</table>
								</div>

								<div class="add_form" id="add_project_executive">
									<div class="notibar_add" style="display:none">
													<a class="close"></a>
													<p></p>
											</div>
									<div class="contenttitle2">
											<h3>Add Executive:</h3>
									</div>

									<?php echo form_open_multipart("projects/add_executive/".$slug."",array("id"=>"executive_form","class"=>"ajax_add_form")); ?>
									<?php echo form_hidden("project_executives_row_","0",FALSE,"class='project_new_row' disabled='disabled'"); ?>

									<?php echo form_label("Name:","",array("class"=>"left_label")); ?>
									<div class="fld">
										<?php echo form_input(array("name"=>"project_executives_name","id"=>"project_executives_name")); ?>
										<div class="errormsg" id="err_project_executives_name"></div>
									</div>
									<br>

									<?php echo form_label("Company:","",array("class"=>"left_label")); ?>
									<div class="fld">
										<?php echo form_input(array("name"=>"project_executives_company","id"=>"project_executives_company")); ?>
										<div class="errormsg" id="err_project_executives_company"></div>
									</div>
									<br>

									<?php echo form_label("Role:","",array("class"=>"left_label")); ?>
									<div class="fld">
										<?php
											$project_executives_role_attr = "id='project_executives_role'";
											$project_executives_role_options = array(
												"Role 1"	=> "Role 1",
												"Role 2"	=> "Role 2"
											);
											echo form_dropdown("project_executives_role",$project_executives_role_options,'',$project_executives_role_attr);
										?>
										<div class="errormsg" id="err_project_executives_role"></div>
									</div>
									<br>

									<?php echo form_label("Email:","",array("class"=>"left_label")); ?>
									<div class="fld">
										<?php echo form_input(array("name"=>"project_executives_email","id"=>"project_executives_email")); ?>
										<div class="errormsg" id="err_project_executives_email"></div>
									</div>
									<br>

									<?php echo form_submit(array("name"=>"Add New","class"=>"light_green btn_lml","value"=>"Add New")); ?>
									<?php echo form_close(); ?>
								</div>
							</div>

							</div>


							<div id="tabs-3" class="col5_tab project_form">

								<div id="tab_innerarea_list">
											<div class="view_list clearfix">
												<div class="contenttitle2">
																<h3>Organization List</h3>
														</div>
														<div class="notibar" style="display:none">
																<a class="close"></a>
																<p></p>
														</div>

												 <div class="tableoptions">
																			<button class="deletebutton radius3" title="Delete Selected" name="dyntable_organization" id="#/admin.php/projects/delete_organization">Delete Organization</button> &nbsp;
																			</div><!--tableoptions-->
																		<table cellpadding="0" cellspacing="0" border="0" class="stdtable" id="dyntable_organization">
																				<colgroup>
																						<col class="con0" style="width: 4%" />
																						<col class="con1" />
																						<col class="con0" />
																						<col class="con1" />
																						<col class="con0" />
																						<col class="con1" />
																						<col class="con0" />
																				</colgroup>
																				<thead>
																						<tr>
																							<th class="head0 nosort" align="center"><?php echo form_checkbox(array("id"=>"select_all_header","name"=>"select_all_header","class"=>"checkall")); ?></th>
																								<th class="head1">ID</th>
																								<th class="head0">Company</th>
																								<th class="head1">Role</th>
																								<th class="head0">Contact</th>
																								<th class="head1">Email</th>
																								<th class="head0 nosort">Action</th>
																						</tr>
																				</thead>
																				<tfoot>
																						<tr>
																							<th class="head0" align="center"><span class="center"><?php echo form_checkbox(array("id"=>"select_all_footer","name"=>"select_all_footer","class"=>"checkall")); ?></span></th>
																								<th class="head1">ID</th>
																								<th class="head0">Company</th>
																								<th class="head1">Role</th>
																								<th class="head0">Contact</th>
																								<th class="head1">Email</th>
																								<th class="head0 nosort">Action</th>
																						</tr>
																				</tfoot>
																				<tbody>
																					<?php

																					if(count($project["organization"]) > 0)
																{
																	foreach($project["organization"] as $key=>$val)
																	{
																?>
																<tr>
																		<td align="center"><span class="center"><?php echo form_checkbox(array("id"=>"select_".$val['id']."","name"=>"select_".$val['id']."","value"=>$val['id'])); ?></span></td>
																								<td><?php echo $val['id']; ?></td>
																								<td><?php echo $val['company'];?></td>
																								<td><?php echo $val['role'];?></td>
																								<td><?php echo $val['contact'];?></td>
																								<td><?php echo $val['email'];?></td>
																								<td><a href="javascript:void(0);" onclick="load_project_edit_from('<?php echo $slug;?>',<?php echo $val['id'];?>,'project_organization','add_project_organization')">Edit</a></td>
																						</tr>

																<?php

																	}
																}
																?>
																				</tbody>
																		</table>
												</div>

											<div class="add_form" id="add_project_organization">

												<div class="contenttitle2">
														<h3>Add Organization:</h3>
												</div>


												<?php echo form_open_multipart("projects/add_organization/".$slug."",array("id"=>"organization_form","class"=>"ajax_add_form")); ?>
												<?php echo form_hidden("hdn_project_organizations_id","0",FALSE,"class='project_new_row' disabled='disabled'"); ?>

												<?php echo form_label("Company Name:","",array("class"=>"left_label")); ?>

												<div class="fld">
													<?php echo form_input(array("name"=>"project_organizations_company","id"=>"project_organizations_company")); ?>
													<div class="errormsg"></div>
												</div>
												<br>

												<?php echo form_label("Role:","",array("class"=>"left_label")); ?>
												<div class="fld">
													<?php
														$project_organizations_role_attr = "";
														$project_organizations_role_options = array(
															"Sponser"	=> "Sponsor",
															"Overseer"	=> "Overseer"
														);
														echo form_dropdown("project_organizations_role",$project_organizations_role_options,'',$project_organizations_role_attr);
													?>
													<div class="errormsg"></div>
												</div>
												<br>

												<?php echo form_label("Contact:","",array("class"=>"left_label")); ?>
												<div class="fld">
													<?php echo form_input(array("name"=>"project_organizations_contact","id"=>"project_organizations_contact")); ?>
													<div class="errormsg"></div>
												</div>
												<br>

												<?php echo form_label("Email:","",array("class"=>"left_label")); ?>
												<div class="fld">
													<?php echo form_input(array("name"=>"project_organizations_email","id"=>"project_organizations_email")); ?>
													<div class="errormsg"></div>
												</div>
												<br>

												<?php echo form_submit(array("name"=>"Add New","class"=>"light_green btn_lml","value"=>"Add New")); ?>
												<?php echo form_close(); ?>
											</div>
										 </div>

							</div>





							<div id="tabs-4" class="col5_tab project_form">

								<div id="">
									<div class="view_list clearfix">
										<div class="contenttitle2">
											<h3>CG/LA ASSESSMENT</h3>
										</div>
										<div class="notibar" style="display:none">
											<a class="close"></a>
											<p></p>
										</div>


										<div class="add_form" id="add_project_assessment">

										<?php echo form_open_multipart("projects/add_assessment/".$slug."",array("id"=>"assessment_form","class"=>"ajax_add_form")); ?>


										<?php echo form_hidden("project_assessment_row_","0",FALSE,"class='project_new_row' disabled='disabled'"); ?>

										<?php echo form_label("Competitors:","",array("class"=>"left_label")); ?>
										<div class="fld">
											<?php echo form_textarea(array("name"=>"project_assessment_competitors","id"=>"project_assessment_competitors","rows"=>10,"cols"=>30, "value"=>isset($assessment['competitors']) ?$assessment['competitors'] : '' )); ?>
											<div class="errormsg" id="err_project_assessment_competitors"></div>
										</div>
										<br>

										<?php echo form_label("Drivers:","",array("class"=>"left_label")); ?>
										<div class="fld">
											<?php echo form_textarea(array("name"=>"project_assessment_drivers","id"=>"project_assessment_drivers","rows"=>10,"cols"=>30, "value"=> isset($assessment['drivers']) ?$assessment['drivers'] : '' )); ?>
											<div class="errormsg" id="err_project_assessment_drivers"></div>
										</div>
										<br>

										<?php echo form_label("SWOT Analysis:","",array("class"=>"left_label")); ?>
										<div class="fld">
											<?php echo form_textarea(array("name"=>"project_assessment_analysis","id"=>"project_assessment_analysis","rows"=>10,"cols"=>30, "value"=>isset($assessment['analysis']) ?$assessment['analysis'] : '' )); ?>
											<div class="errormsg" id="err_project_assessment_analysis"></div>
										</div>
										<br>


										<?php echo form_submit(array("name"=>"Add Assessment","class"=>"light_green btn_lml","value"=>"Save")); ?>
										<?php echo form_close(); ?>

										</div>
									</div>
								</div>
							</div>


						</div></div><!-- end #tabs -->

					</div><!-- end #col5 -->

				</div>

	</div>
</div>
</div>

<script>
    $('#project_sector_main').on('change', function() {
        if ( this.value == 'Energy')
        {
            $("#energyfields").show();
        }
        else
        {
            $("#energyfields").hide();
        }
    });

    $('#project_sector_sub').on('change', function() {
        if ( this.value == 'Transmission')
        {
            $("#transmissionfields").show();
        }
        else
        {
            $("#transmissionfields").hide();
        }
    });

    $('#project_sector_sub').on('change', function() {
        if ( this.value == 'Hydrogen')
        {
            $("#hydrogenfields").show();
        }
        else
        {
            $("#hydrogenfields").hide();
        }
    });

    $('#project_sector_main').on('change', function() {
        if ( this.value == 'Transport')
        {
            $("#transportfields").show();
        }
        else
        {
            $("#transportfields").hide();
        }
    });

    $('#project_sector_sub').on('change', function() {
        if ( this.value == 'Transit')
        {
            $("#transitfields").show();
        }
        else
        {
            $("#transitfields").hide();
        }
    });

    $('#project_sector_sub').on('change', function() {
        if ( this.value == 'Ports & Logistics')
        {
            $("#portsfields").show();
        }
        else
        {
            $("#portsfields").hide();
        }
    });

    $('#project_sector_main').on('change', function() {
        if ( this.value == 'Information & Communication Technologies')
        {
            $("#ITfields").show();
        }
        else
        {
            $("#ITfields").hide();
        }
    });

    $('#project_sector_main').on('change', function() {
        if ( this.value == 'Water')
        {
            $("#waterfields").show();
        }
        else
        {
            $("#waterfields").hide();
        }
    });
</script>
