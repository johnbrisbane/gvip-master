<div id="content" class="clearfix">
        <?php

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
                    'title' => array(
                        'id'    => 'title_input',
                        'value' => $project["projectname"],
                        'name'  => 'title_input'
                    ),
                    'lbl_photo_privacy' => array(
                        'class' => 'above_label'
                    ),
                    'privacy_options' => array(
                        'Private'   => lang('Private'),
                        'Specific'  => lang('Specific'),
                        'Similar Project Owners'    => lang('SimilarProjectOwners')
                    ),
                    'lbl_photo_description' => array(
                        'class' => 'above_label'
                    ),
                    'project_photo' => array(
                        'name'  => 'project_photo',
                        'id'    => 'project_photo',
                    ),
                    'photo_submit' => array(
                        'name'  => 'photo_submit',
                        'value' => lang('Upload'),
                        'class' => 'photo_submit light_green',
                        'id'    => 'btn_upload_project_image'
                    ),
                    'lbl_project_meta_permissions' => array(
                        'class' => 'above_label'
                    ),
                    'lbl_project_overview' => array(
                        'class' => 'left_label'
                    ),
                    'project_overview' => array(
                    'name'	=> 'project_overview',
                    'value'	=> $project["description"],
                    'id'	=> 'project_overview'
                    ),
                    'lbl_project_keywords' => array(
                        'class' => 'left_label'
                    ),
                    'project_keywords' => array(
                        'id'    => 'project_keywords',
                        'name'  => 'project_keywords',
                        'value' => set_value('project_keywords', $project["keywords"])
                    ),
                    'lbl_project_country' => array(
                        'class' => 'left_label'
                    ),
                    'lbl_project_location' => array(
                        'class' => 'left_label'
                    ),
                    'project_location' => array(
                        'id'    => 'project_location',
                        'name'  => 'project_location',
                        'value' => set_value('project_location', $project["location"])
                    ),
                    'lbl_project_sector_main' => array(
                        'class' => 'left_label'
                    ),
                    'lbl_project_sector_sub' => array(
                        'class' => 'left_label'
                    ),
                    'lbl_project_sector_sub_other' => array(
                        'class' => 'left_label' 
                    ),
                    'project_sector_sub_other' => array(
                        'id'    => 'project_sector_sub_other',
                        'name'  => 'project_sector_sub_other',
                        'disabled' => 'disabled',
                        'value' => set_value('project_sector_sub_other', $project["subsector_other"])
                    ),
                    'lbl_project_budget_max' => array(
                        'class' => 'left_label' 
                    ),
                    'project_budget_max' => array(
                        'id'    => 'project_budget_max',
                        'name'  => 'project_budget_max',
//                      'value' => CURRENCY.$project["totalbudget"]
                        'value' => set_value(
                            'project_budget_max', 
                            format_budget_for_edit($project["totalbudget"], empty($project['description']))
                            )
                    ),
                    'lbl_project_financial' => array(
                        'class' => 'left_label'
                    ),
                    'lbl_project_fs_other' => array(
                        'class' => 'left_label' 
                    ),
                    'project_fs_other' => array(
                        'id'    => 'project_fs_other',
                        'name'  => 'project_fs_other',
                        'disabled' => 'disabled',
                        'value' => set_value('project_fs_other', $project["financialstructure_other"])
                    ),
                    'lbl_stage_date' => array(
                        'class' => 'left_label' 
                    ),
                    'lbl_stage_budget' => array(
                        'class' => 'left_label' 
                    ),
                    'lbl_stage_comments' => array(
                        'class' => 'left_label' 
                    ),
                    'lbl_project_eststart' => array(
                        'class' => 'left_label'
                    ),
                    'project_eststart' => array(
                        'id'          => 'project_eststart_picker',
                        'name'        => 'project_eststart',
                        'value'       => set_value('project_eststart', $project["eststart"]),
                        'class'       => 'sm_left',
                        'style'       => 'width:120px',
                        'placeholder' => lang('mY'),
                        'pattern'     => '\d{2}/\d{4}',
                        'title'       => lang('valid_monthyear_format')
                    ),
                    'lbl_project_estcompletion' => array(
                        'class' => 'left_label'
                    ),
                    'project_estcompletion' => array(
                        'id'          => 'project_estcompletion_picker',
                        'name'        => 'project_estcompletion',
                        'value'       => set_value('project_estcompletion', $project["estcompletion"]),
                        'class'       => 'sm_left',
                        'style'       => 'width:120px',
                        'placeholder' => lang('mY'),
                        'pattern'     => '\d{2}/\d{4}',
                        'title'       => lang('valid_monthyear_format')
                    ),

                'lbl_project_conceptual' => array(
                    'class' => 'left_label'
                ),
                'project_conceptual' => array(
                    'id'          => 'project_conceptual_picker',
                    'name'        => 'project_conceptual',
                    'value'       => set_value('project_conceptual', $project["conceptual_date_from"]),
                    'class'       => 'sm_left',
                    'style'       => 'width:120px',
                    'placeholder' => lang('mY'),
                    'pattern'     => '\d{2}/\d{4}',
                    'title'       => lang('valid_monthyear_format')
                ),
                'lbl_project_feasibility' => array(
                    'class' => 'left_label'
                ),
                'project_feasibility' => array(
                    'id'          => 'project_feasibility_picker',
                    'name'        => 'project_feasibility',
                    'value'       => set_value('project_feasibility', $project["feasibility_date_from"]),
                    'class'       => 'sm_left',
                    'style'       => 'width:120px',
                    'placeholder' => lang('mY'),
                    'pattern'     => '\d{2}/\d{4}',
                    'title'       => lang('valid_monthyear_format')
                ),

                'lbl_project_planning' => array(
                    'class' => 'left_label'
                ),
                'project_planning' => array(
                    'id'          => 'project_planning_picker',
                    'name'        => 'project_planning',
                    'value'       => set_value('project_planning', $project["planning_date_from"]),
                    'class'       => 'sm_left',
                    'style'       => 'width:120px',
                    'placeholder' => lang('mY'),
                    'pattern'     => '\d{2}/\d{4}',
                    'title'       => lang('valid_monthyear_format')
                ),
                'lbl_project_conceptual_to' => array(
                    'class' => 'left_label'
                ),
                'project_conceptual_to' => array(
                    'id'          => 'project_conceptual_to_picker',
                    'name'        => 'project_conceptual_to',
                    'value'       => set_value('project_conceptual_to', $project["conceptual_date_to"]),
                    'class'       => 'sm_left',
                    'style'       => 'width:120px',
                    'placeholder' => lang('mY'),
                    'pattern'     => '\d{2}/\d{4}',
                    'title'       => lang('valid_monthyear_format')
                ),
                'lbl_project_feasibility_to' => array(
                    'class' => 'left_label'
                ),
                'project_feasibility_to' => array(
                    'id'          => 'project_feasibility_to_picker',
                    'name'        => 'project_feasibility_to',
                    'value'       => set_value('project_feasibility_to', $project["feasibility_date_to"]),
                    'class'       => 'sm_left',
                    'style'       => 'width:120px',
                    'placeholder' => lang('mY'),
                    'pattern'     => '\d{2}/\d{4}',
                    'title'       => lang('valid_monthyear_format')
                ),

                'lbl_project_planning_to' => array(
                    'class' => 'left_label'
                ),
                'project_planning_to' => array(
                    'id'          => 'project_planning_to_picker',
                    'name'        => 'project_planning_to',
                    'value'       => set_value('project_planning_to', $project["planning_date_to"]),
                    'class'       => 'sm_left',
                    'style'       => 'width:120px',
                    'placeholder' => lang('mY'),
                    'pattern'     => '\d{2}/\d{4}',
                    'title'       => lang('valid_monthyear_format')
                ),

                    'lbl_project_developer' => array(
                        'class' => 'left_label' 
                    ),
                    'project_developer' => array(
                        'id'    => 'project_developer',
                        'name'  => 'project_developer',
                        'value' => set_value('project_developer', $project["developer"])
                    ),
                    'lbl_project_sponsor' => array(
                        'class' => 'left_label' 
                    ),
                    'project_sponsor' => array(
                        'id'    => 'project_sponsor',
                        'name'  => 'project_sponsor',
                        'value' => set_value('project_sponsor', $project["sponsor"])
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

        <div id="col4">
            <?php
                $leftnavlist = array(
                    '<a href="/projects/edit/'.$slug.'">'.lang("ProjectInformation").'</a>',
                    '<a href="/projects/edit_fundamentals/'.$slug.'">'.lang("Fundamentals").'</a>',
                    '<a href="/projects/edit_financial/'.$slug.'">'.lang("Financial").'</a>',
                    '<a href="/projects/edit_regulatory/'.$slug.'">'.lang("Regulatory").'</a>',
                    '<a href="/projects/edit_participants/'.$slug.'">'.lang("Participants").'</a>',
                    '<a href="/projects/edit_procurement/'.$slug.'">'.lang("Procurement").'</a>',
                    '<a href="/projects/edit_files/'.$slug.'">'.lang("Files").'</a>',

                );
                
                /*
                // For AJAX dynamic Left Tabs
                $leftnavlist = array(
                    '<a onclick="tabload(\'/projects/edit/'.$slug.'\');" href="javascript:void(0);">Project Information</a>',
                    '<a onclick="tabload(\'/projects/load_tab/'.$slug.'\');" href="javascript:void(0);">Fundamentals</a>',
                    '<a onclick="tabload(\'/projects/edit_financial/'.$slug.'\');" href="javascript:void(0);">Financial</a>',
                    '<a onclick="tabload(\'/projects/edit_regulatory/'.$slug.'\');" href="javascript:void(0);">Regulatory</a>',
                    '<a onclick="tabload(\'/projects/edit_participants/'.$slug.'\');" href="javascript:void(0);">Participants</a>',
                    '<a onclick="tabload(\'/projects/edit_procurement/'.$slug.'\');" href="javascript:void(0);">Procurement</a>',
                    '<a onclick="tabload(\'/projects/edit_files/'.$slug.'\');" href="javascript:void(0);">Files</a>'
                );*/

                $leftnavattrib = array(
                    'id' => 'profile_nav'
                );
                $listattributes = array(
                    'class="here"'
                );
                echo ul_custom($leftnavlist,$leftnavattrib,$listattributes);
            ?>
            <span class="light_green" data-toggle="modal" data-target="#modal1">Project Entry Tutorial</span>
        </div><!-- end #col4 -->

        <div id="col5">
            <?php echo form_open_multipart("projects/updatename/".$slug."",array("id"=>"project_name_form","class"=>"ajax_form")); ?>
            <?php echo heading(lang("ProjectName").": ".form_input($opt["project_form"]["title"])."<label class='errormsg' id='err_title_input'></label>",1,"class='col_top gradient'"); ?>
            <?php echo form_close(); ?>
        <div class="profile_links">

            <div id="form_submit">
                <a href="/projects/<?php echo $slug ?>" target="_blank"><?php echo lang('ViewMyProject');?></a>
                <a href="#" class="light_green update_project"><?php echo lang('UpdateProject');?></a>
            </div>
        
        </div>
        <div id="tabContainer">
            <div id="profile_tabs">
            
                <?php
                    $tablist = array(
                        '<a href="#tabs-1">'.lang("General").'</a>',
                        // '<a href="#tabs-2">'.lang("ProjectExecutives").'</a>',
                        // '<a href="#tabs-3">'.lang("ProjectOrganizations").'</a>',
                        //'<a href="#tabs-4">'.lang("CG/LA Assessment").'</a>'
                        '<a href="#tabs-5">'.lang('Maps').'</a>'
                    );
                    
                    echo ul($tablist);
                ?>
        
                <div id="tabs-1" class="col5_tab">

                    <div style="display: flex; flex-direction: column;"><?php /* Put contents of this tab into a flexbox so that content from two separate forms can intermingle on the screen but not in the HTML */ ?>
                    
                        <div class="clearfix" style="order: 2">
                            
                            <?php echo form_label(lang('ProjectPhoto') . ':', 'projectphoto', array('class' => 'left_label')) ?>
                            
                            <?php echo form_open_multipart("projects/upload_projectphoto/".$slug."",array("id"=>"project_form_upload","name"=>"project_form_upload","class"=>"ajax_form")); ?>
                            
                            <div class="permissions_block" style="display:none">
                                <div class="arrow"></div>
                                <?php echo form_label(lang("Privacy").":","project_photos_permissions",$opt["project_form"]["lbl_photo_privacy"]); ?>
                                <?php echo form_dropdown('project_photos_permissions', $opt["project_form"]["privacy_options"],$project["project_photos_permissions"]); ?>
                            </div>

                            <div class="clearfix">
                                    
                                    <?php echo form_label(lang("SelectanImage").':<a title="'.lang('PhotoExplanation').'" class="tooltip"></a>',"",$opt["project_form"]["lbl_photo_description"]); ?>
                                    <div class="fld">
                                        <?php echo form_upload($opt["project_form"]["project_photo"]); ?>
                                        <div class="errormsg" id="err_project_photo"><?php echo $photoerror; ?></div>
                                    <?php echo form_hidden("project_phot_hidden",$project["projectphoto"]); ?>
                                    <span class="note"><?php echo lang('Compatiblefiletypes');?>: JPEG, GIF, PNG</span>
                                        
                                    </div>

                                    <div style="clear: both">
                                        <div class="image_placeholder">
                                            <img src="<?php echo project_image($project['projectphoto'], 150) ?>" alt="Project's photo" class="uploaded_img">
                                        </div>
                                        <?php echo form_submit($opt["project_form"]["photo_submit"]);  ?>
                                    </div>
                            </div>
                            <?php echo form_close();?>

                        </div>
                        <br>

                        <div class="clearfix" style="order: 1">
                            <?php echo form_open_multipart("projects/edit/".$slug."",array("id"=>"project_form_main","class"=>"project_form topupdate")); ?>
                            <div class="hiddenFields">
                                <?php echo form_hidden("return","projects/edit/".$slug); ?>
                                <?php echo form_hidden_custom("select_stage",$project["stage"],FALSE,"id='select_stage'"); ?>
                                <?php echo form_hidden_custom("title_input_hidden",$project["projectname"],FALSE,"id='title_input_hidden'"); ?>
                            </div>
                            <?php echo form_label(lang("Sponsor").':<a title="'.lang('SponsorExplanation').'" class="tooltip"></a>',"project_sponsor",$opt["project_form"]["lbl_project_sponsor"]); ?>
                            <div class="fld">
                                <?php echo form_input($opt["project_form"]["project_sponsor"]); ?>
                                <div class="errormsg" id="err_project_sponsor"><?php echo form_error("project_sponsor"); ?></div>
                            </div>
                            <br>
                            
                            <?php echo form_label(lang("Developer").':<a title="'.lang('DeveloperExplanation').'" class="tooltip"></a>',"project_developer",$opt["project_form"]["lbl_project_developer"]); ?>
                            <div class="fld">
                                <?php echo form_input($opt["project_form"]["project_developer"]); ?>
                                <div class="errormsg" id="err_project_developer"><?php echo form_error("project_developer"); ?></div>
                            </div>
                            <br>

                            <?php echo form_label(lang('Website') . ':', 'website', array('class' => 'left_label')) ?>
                            <div class="fld">
                                <?php echo form_input('website', set_value('website', $project['website'])) ?>
                                <div class="errormsg" id="err_website"><?php echo form_error('website') ?></div>
                            </div>
                            <br>
                        </div>

                        <div class="clearfix" style="order: 3">
                            <div class="permissions_block" style="display:none">
                                <div class="arrow"></div>
                                <?php echo form_label(lang("Privacy").":","project_meta_permissions",$opt["project_form"]["lbl_project_meta_permissions"]); ?>
                                <?php echo form_dropdown('project_meta_permissions', $opt["project_form"]["privacy_options"], $project["project_meta_permissions"]); ?>
                            </div>

                            <?php echo form_label(lang("Description").'*:<a title="'.lang('DetailExplanation').'" class="tooltip"></a>',"project_overview",$opt["project_form"]["lbl_project_overview"]); ?>
                            <div class="fld">
                                <?php echo form_textarea($opt["project_form"]["project_overview"]); ?>
                                <div class="errormsg" id="err_project_overview"><?php echo form_error("project_overview"); ?></div>
                                <?php /*
                                <div id="count_char" style="position:absolute; margin-top:-55px; right:13px; width:200px; color:#535760"><?php echo lang('Limit200');?></div> */ ?>
                            </div>
                            <br>
                            
                            <?php echo form_label(lang("Keywords").'*:<a title="'.lang('SeparateMessage').'" class="tooltip"></a>',"project_keywords",$opt["project_form"]["lbl_project_keywords"]); ?>
                            <div class="fld">
                                <?php echo form_input($opt["project_form"]["project_keywords"]); ?>
                                <div class="errormsg" id="err_project_keywords"><?php echo form_error("project_keywords"); ?></div>
                            </div>
                            <br>

                            <?php echo form_label(lang("Country").'*:<a title="'.lang('CountryExplanation').'" class="tooltip"></a>',"project_country",$opt["project_form"]["lbl_project_country"]); ?>
                            <div class="fld">
                                <?php  
                                    $project_country_attr = 'id="project_country"';
                                    $project_country_options = country_dropdown();
                                    echo form_dropdown('project_country', $project_country_options, set_value('project_country', $project["country"]), $project_country_attr);
                                ?>
                                <div class="errormsg" id="err_project_country"><?php echo form_error("project_country"); ?></div>
                            </div>
                            <br>

                            <?php echo form_label(lang("Location").'*:<a title="'.lang('LocationExplanation').'" class="tooltip"></a>',"project_location",$opt["project_form"]["lbl_project_location"]); ?>
                            <div class="fld">
                                <?php echo form_input($opt["project_form"]["project_location"]); ?>
                                <div class="errormsg" id="err_project_location"><?php echo form_error("project_location"); ?></div>
                            </div>
                            <br>
                            
                            <?php echo form_label(lang("Sector")."*:","project_sector_main",$opt["project_form"]["lbl_project_sector_main"]); ?>
                            <div class="fld">
                                <?php 
                                    $project_sector_main_attr   = 'id="project_sector_main"';
                                    $sector_options = array();
                                    $sector_opt = array();
                                    foreach(sectors() as $key=>$value)
                                    {
                                        $sector_options[$value] = $value;
                                        $sector_opt[$value]     = 'class="sector_main_'.$key.'"';
                                    }
                                    $sector_first           = array('class'=>'hardcode','text'=>lang('SelectASector'),'value'=>'');
                                    //$sector_last          = array();
                                    $sector_last            = array('class'=>'hardcode','text'=>'Other','value'=>'Other');
                                    
                                    // var_dump($sector_options); echo "\n"; var_dump(set_value('project_sector_main', $project["sector"])); die;
                                    echo form_custom_dropdown('project_sector_main', $sector_options, set_value('project_sector_main', $project["sector"]),$project_sector_main_attr,$sector_opt,$sector_first,$sector_last);
                                ?>
                                <div class="errormsg" id="err_project_sector"><?php echo form_error("project_sector_main"); ?></div>
                            </div>
                            <br>


                            <?php echo form_label(lang("Sub-Sector")."*:","project_sector_sub",$opt["project_form"]["lbl_project_sector_sub"]); ?>

                            <div class="fld">
                                <?php 
                                    $project_sector_sub_attr    = 'id="project_sector_sub"';
                                    $subsector_options = array();
                                    $subsector_opt = array();
                                    foreach(subsectors() as $parentSectorId=>$subsectors)
                                    {
                                        foreach($subsectors as $subsectorName)
                                        {
                                            $subsector_options[$subsectorName]     = $subsectorName;
                                            $subsector_opt[$subsectorName][]       = "project_sector_sub_{$parentSectorId}";
                                        }
                                    }

                                    $subsector_opt = array_map(function(Array $classnames) {
                                        $classnamesList = implode(' ', $classnames);
                                        return 'class="'.$classnamesList.'"';
                                    }, $subsector_opt);

                                    $subsector_first            = array('class'=>'hardcode','text'=>lang('SelectASub-Sector'),'value'=>'');
                                    $subsector_last             = array('class'=>'hardcode other','value'=>'Other','text'=>'Other');
                                    echo form_custom_dropdown('project_sector_sub', $subsector_options, set_value('project_sector_sub', $project["subsector"]),$project_sector_sub_attr,$subsector_opt,$subsector_first,$subsector_last);


                                ?>
                                <div class="errormsg" id="err_project_subsector"><?php echo form_error("project_sector_sub"); ?></div>
                            </div>

                            <div  style="display:none">
                                <br>
                                <?php echo form_label(lang("Other").":","project_sector_sub_other",$opt["project_form"]["lbl_project_sector_sub_other"]); ?>
                                <?php echo form_input($opt["project_form"]["project_sector_sub_other"]); ?>
                                <div class="errormsg" id="err_project_subsector_other"></div>
                                <span id="selected_sub_sector" style="display:none"><?php echo $project["subsector"];?></span>
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



                            <br>
                            <?php echo form_label('Conceptual Start Date' . ':', 'project_conceptual', array('class' => 'left_label')) ?>
                            <div class="fld">
                                <?php echo form_input($opt['project_form']['project_conceptual']); ?>

                                <div class="errormsg" id="err_project_eststart"><?php echo form_error('project_conceptual') ?></div>
                            </div>
                            <?php echo form_label('Conceptual End Date' . ':', 'project_conceptual_to', array('class' => 'left_label')) ?>
                            <div class="fld">
                                <?php echo form_input($opt['project_form']['project_conceptual_to']); ?>

                                <div class="errormsg" id="err_project_estcompletion"><?php echo form_error('project_conceptual_to') ?></div>
                            </div>
                            <br>

                            <?php echo form_label('Feasibility Start Date' . ':', 'project_feasibility', array('class' => 'left_label')) ?>
                            <div class="fld">
                                <?php echo form_input($opt['project_form']['project_feasibility']); ?>

                                <div class="errormsg" id="err_project_eststart"><?php echo form_error('project_feasibility') ?></div>
                            </div>
                            <?php echo form_label('Feasibility End Date' . ':', 'project_feasibility_to', array('class' => 'left_label')) ?>
                            <div class="fld">
                                <?php echo form_input($opt['project_form']['project_feasibility_to']); ?>

                                <div class="errormsg" id="err_project_estcompletion"><?php echo form_error('project_feasibility_to') ?></div>
                            </div>
                            <br>

                            <?php echo form_label('Planning Start Date' . ':', 'project_planning', array('class' => 'left_label')) ?>
                            <div class="fld">
                                <?php echo form_input($opt['project_form']['project_planning']); ?>

                                <div class="errormsg" id="err_project_eststart"><?php echo form_error('project_planning') ?></div>
                            </div>
                            <?php echo form_label('Planning End Date' . ':', 'project_planning_to', array('class' => 'left_label')) ?>
                            <div class="fld">
                                <?php echo form_input($opt['project_form']['project_planning_to']); ?>

                                <div class="errormsg" id="err_project_estcompletion"><?php echo form_error('project_planning_to') ?></div>
                            </div>
                            <br>

                            <?php echo form_label('Construction Start Date' . ':', 'project_eststart', array('class' => 'left_label')) ?>
                            <div class="fld">
                                <?php echo form_input($opt['project_form']['project_eststart']) ?>
                                <div class="errormsg" id="err_project_eststart"><?php echo form_error('project_eststart') ?></div>
                            </div>

                            <?php echo form_label('Operations & Maintenance Start Date' . ':', 'project_estcompletion', array('class' => 'left_label')) ?>
                            <div class="fld">
                                <?php echo form_input($opt['project_form']['project_estcompletion']); ?>

                                <div class="errormsg" id="err_project_estcompletion"><?php echo form_error('project_estcompletion') ?></div>
                            </div>
                            <br>

                            <?php echo form_label(lang("Stage")."*:","project_stage",array("class"=>"left_label")); ?>
                            <div class="fld">
                                <?php 
                                    $project_stage_attr = 'id="project_stage"';
                                    $project_stage_options = array(
                                        ''             => lang('SelectAStage'),
                                        'conceptual'   => lang('conceptual'),
                                        'feasibility'  => lang('feasibility'),
                                        'planning'     => lang('planning'),
                                        'procurement'  => lang('procurement'),
                                        'construction' => lang('construction'),
                                        'om'           => lang('om'),
                                    );
                                    $project_stage_options = array_map("ucfirst", $project_stage_options);
                                    echo form_dropdown('project_stage', $project_stage_options, set_value('project_stage', $project["stage"]), $project_stage_attr);
                                ?>
                                <div class="errormsg" id="err_project_stage"><?php echo form_error('project_stage') ?></div>
                            </div>
                            <br>

                            <?php echo form_label(lang("StageElaboration").":","project_stage_elaboration",array("class"=>"left_label")); ?>
                            <div class="fld">
                                <?php 
                                    $project_stage_elaboration_attr = 'id="project_stage_elaboration"';
                                    echo form_input('project_stage_elaboration', set_value('project_stage_elaboration', $project["stage_elaboration"]), $project_stage_elaboration_attr);
                                ?>
                                <div class="errormsg" id="err_project_stage_elaboration"></div>
                            </div>
                            <br>

                            <?php echo form_label(lang("TotalBudget") . ' (US$ MM)'.'*:<a title="'.lang('ProjectEditBudgetHelpMessage').'" class="tooltip"></a>',"project_budget_max",$opt["project_form"]["lbl_project_budget_max"]); ?>
                            <div class="fld">
                                <?php echo form_input($opt["project_form"]["project_budget_max"]); ?>
                                <div class="errormsg" id="err_project_budget_max"><?php echo form_error("project_budget_max"); ?></div>
                            </div>
                            <br>

                            <?php echo form_label(lang("FinancialStructure").":","project_financial",$opt["project_form"]["lbl_project_financial"]); ?> 
                            <div class="fld">
                                <?php
                                    $project_financial_attr = 'id="project_financial"';
                                    $project_financial_options = array(
                                        ''             => lang('SelectOne'),
                                        'Public'       => lang('Public'),
                                        'Private'      => lang('Private'),
                                        'PPP'          => lang('PPP'),
                                        'Concession'   => lang('Concession'),
                                        'Design–Build' => lang('Designb'),
                                        'Other'        => lang('Other')
                                    );
                                    echo form_dropdown('project_financial', $project_financial_options, set_value('project_financial', $project["financialstructure"]), $project_financial_attr);
                                ?>
                                <div class="errormsg" id="err_project_financial"><?php echo form_error("project_financial"); ?></div>
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
                            
                            <div style="display:none">
                                <?php echo form_label(lang("Other").":","project_fs_other",$opt["project_form"]["lbl_project_fs_other"]); ?>
                                <?php echo form_input($opt["project_form"]["project_fs_other"]); ?>
                                <div class="errormsg" id="err_project_fs_other"></div>
                            </div>
                        </div>
                        <br>

                        <div class="clearfix" id="form_submit" style="order: 4">
                            <a href="#" class="update_project light_green btn_lml"><?php echo lang("UpdateProject") ?></a>
                        </div>

                        <?php echo form_close(); ?>
                    </div>
                </div>


                <div class="col5_tab ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide" id="tabs-5" style="">
                        <div class="map_box clearfix">
                            <style type="text/css">
                                #project-map{
                                    width: 745px;
                                    height: 456px;
                                }
                            </style>
            
                            <div id="project-map" style="height: 456px; width: 745px;"></div>
            
                            <div class="clearfix">
                                <p class="left coord"><span class="geo"></span>
                                    <strong>Project location:</strong> 
                                    <span class="address">
                                        <?php
                                        if($project['location']!= ''){
                                        ?>
                                        <?php
                                            echo $project['location'];
            
                                        } else {
                                            echo "N/A";
                                        }
                                        echo "</span>";
            
                                        if ($project['location']!= '') {
                                        ?>
                                            <a class="edit_location toggleEdit">Edit location</a>
                                            <a class="save_location" style="display: none;">Save</a>
                                            <a class="cancel_location toggleEdit" style="display: none;">Cancel</a>
                                        <?php
                                        }
                                        ?>
                                </p>
                            </div>
                        </div>
            
            
                </div>              

        
                <div id="tabs-2" class="col5_tab project_form" style="display:none">
                    <div class="clearfix matrix_dropdown project_executives">
                        <ul id="load_executive_form">
                            <?php
                            
                            foreach($project["executive"] as $key=>$val)
                            {
                            ?>
                            <li class="" id="row_id_<?php echo $val["id"]; ?>">
                                <div class="view clearfix">
                                    
                                    <span class="left"><?php echo $val["company"]; ?></span>

                                    <span class="left middle">
                                        <strong><?php echo $val["executivename"]; ?></strong>
                                        <br>
                                        <?php echo $val["role"].", ".$val["email"]; ?>
                                    </span>

                                    <a class="right delete" href="#projects/delete_executive"><?php echo lang('Delete');?></a>

                                    <a class="right edit" id="edit_executive_<?php echo $val["id"]; ?>" href="javascript:void(0);"  onclick="rowtoggle(this.id);"><?php echo lang('Edit');?></a>

                                </div>

                                <div class="edit">
                                    <?php echo form_open_multipart("projects/update_executive/".$slug."",array("id"=>"update_executive_form_".$val["id"], "name"=>"update_executive_form_".$val["id"],"class"=>"ajax_form")); ?>
                                    <?php echo form_hidden("hdn_project_executives_id",$val["id"]); ?>

                                    <?php echo form_label(lang("Name").":","",array("class"=>"left_label")); ?>
                                    <div class="fld">
                                        <?php echo form_input(array("name"=>"project_executives_name","id"=>"project_executives_name","value"=>$val["executivename"])); ?>
                                        <div class="errormsg"></div>
                                    </div>
                                    <br>
                                    
                                    <?php echo form_label(lang("Company").":","",array("class"=>"left_label")); ?>
                                    <div class="fld">
                                        <?php echo form_input(array("name"=>"project_executives_company","id"=>"project_executives_company","value"=>$val["company"])); ?>
                                        <div class="errormsg"></div>
                                    </div>
                                    <br>
                                    
                                    <?php echo form_label(lang("Role").":","",array("class"=>"left_label")); ?>
                                    <div class="fld">
                                        <?php 
                                            $project_executives_role_attr = "id='project_executives_role_".$val["id"]."' onchange='project_executive_other(this)'";
                                            $project_executives_role_options = array(
                                                "Finance"       => lang("Finance"),
                                                "Engineering"   => lang("Engineering"),
                                                "Construction"  => lang("Construction"),
                                                "Admin"         => lang("Admin"),
                                                "Affairs"       => lang("Affairs"),
                                                "Other"         => lang("Other")
                                            );
                                            echo form_dropdown("project_executives_role",$project_executives_role_options,$val["role"],$project_executives_role_attr);
                                        ?>
                                        <div class="errormsg"></div>
                                    </div>
                                    
                                    <?php if(isset($val["role_other"]) && $val["role_other"]!=''){ $dropdownStyle = 'display:block;';} else{$dropdownStyle = 'display:none;';}?>
                                    <div style="<?php echo $dropdownStyle;?> clear:both;" class="role_other">
                                        <?php echo form_label(lang("Other").":","",array("class"=>"left_label")); ?>
                                        <?php echo form_input(array("name"=>"project_executives_role_other","id"=>"project_executives_role_other","value"=>isset($val["role_other"])?$val["role_other"]:'')); ?>
                                        <div class="errormsg" id="err_project_executives_role_other"></div>
                                    </div>

                                    <div style="clear:both;">
                                        <?php echo form_label(lang("Email").":","",array("class"=>"left_label")); ?>
                                        <div class="fld">
                                            <?php echo form_input(array("name"=>"project_executives_email","id"=>"project_executives_email","value"=>$val["email"])); ?>
                                            <div class="errormsg" ></div>
                                        </div>
                                    </div>
                                    
                                    <?php echo form_submit(array("name"=>"Update","class"=>"light_green btn_lml","value"=>lang("Update"))); ?>
                                    <?php echo form_reset(array("class"=>"light_red btn_sml","value"=>lang("Close"))); ?>
                                    <?php echo form_close(); ?>
                                </div>
                                
                            </li>
                            <?php   
                            }
                            ?>
                        </ul>
                        <ul>
                            <li>
                                <div class="view">
                                    <?php //lable like=> + Add Executives?>
                                    <a id="addnewExecutive" class="edit project_row_add" href="javascript:void(0);" onclick="rowtoggle(this.id);"> + <?php echo lang('AddExecutives');?></a>

                                </div>

                                <div class="edit add_new">
                                    <?php echo form_open_multipart("projects/add_executive/".$slug."",array("id"=>"executive_form","class"=>"ajax_form")); ?>
                                    <?php echo form_hidden("project_executives_row_","0",FALSE,"class='project_new_row' disabled='disabled'"); ?>

                                    <?php echo form_label(lang("Name").":","",array("class"=>"left_label")); ?>
                                    <div class="fld">
                                        <?php echo form_input(array("name"=>"project_executives_name","id"=>"project_executives_name")); ?>
                                        <div class="errormsg" id="err_project_executives_name"></div>
                                    </div>
                                    <br>
                                    
                                    <?php echo form_label(lang("Company").":","",array("class"=>"left_label")); ?>
                                    <div class="fld">
                                        <?php echo form_input(array("name"=>"project_executives_company","id"=>"project_executives_company")); ?>
                                        <div class="errormsg" id="err_project_executives_company"></div>
                                    </div>
                                    <br>
                                    
                                    <?php echo form_label(lang("Role").":","",array("class"=>"left_label")); ?>
                                    <div class="fld">
                                        <?php 
                                            $project_executives_role_attr = "id='project_executives_role' onchange='project_executive_other(this)'";
                                            $project_executives_role_options = array(
                                                "Finance"       => lang("Finance"),
                                                "Engineering"   => lang("Engineering"),
                                                "Construction"  => lang("Construction"),
                                                "Admin"         => lang("Admin"),
                                                "Affairs"       => lang("Affairs"),
                                                "Other"         => lang("Other")
                                            );
    
                                            echo form_dropdown("project_executives_role",$project_executives_role_options,'',$project_executives_role_attr);
                                        ?>
                                        <div class="errormsg" id="err_project_executives_role"></div>
                                    </div>
                                    <div style="display:none;clear:both;" class="role_other">
                                        <?php echo form_label(lang("Other").":","",array("class"=>"left_label")); ?>
                                        <?php echo form_input(array("name"=>"project_executives_role_other","id"=>"project_executives_role_other")); ?>
                                        <div class="errormsg" id="err_project_executives_role_other"></div>
                                    </div>
                                    <div style="clear:both;">
                                    <?php echo form_label(lang("Email").":","",array("class"=>"left_label")); ?>
                                    <div class="fld">
                                        <?php echo form_input(array("name"=>"project_executives_email","id"=>"project_executives_email")); ?>
                                        <div class="errormsg" id="err_project_executives_email"></div>
                                    </div>
                                    </div>  
                                    
                                    <?php echo form_submit(array("name"=>"Add New","class"=>"light_green btn_lml","value"=>lang("AddNew"))); ?>
                                    <?php echo form_close(); ?>

                                </div>
                                
                            </li>
                        </ul>

                    </div>
                    
                    
                </div>

        
                <div id="tabs-3" class="col5_tab project_form" style="display:none">
                
                

            <div class="proj_organization">
            <?php 
            echo form_open_multipart("projects/update_orgExpert/".$project['pid'],array("id"=>"update_orgExpert",'class'=>'ajax_form clearfix')); ?>
            <?php
                $opt = array(
                    'lbl_project_expAdv' => array(
                        'class' => 'left_label'
                    ),
                    'submit' => array(
                        'name' => 'update_Organization',
                        'value' => lang('UpdateOrganizationOwner'),
                        'class' => 'light_green btn_lml'
                    ),
                    
                );
            ?>
                <?php echo form_label(lang('Organization').':', 'project_expAdv',$opt['lbl_project_expAdv']);?>
                <div class="fld">
                    <?php 
                        $project_expAdv_attr = "id='project_expAdv'";
                        $project_expAdv_options = get_all_expertAdverts();
                        $project_expAdv_orgid   = ($proj_org['orgid'])?($proj_org['orgid']):'';
                        echo form_dropdown("project_expAdv",$project_expAdv_options['organization'],$project_expAdv_orgid,$project_expAdv_attr);
                    ?>
                    <div class="errormsg" id="err_project_expAdv"></div>
                </div>
                <?php if(isset($proj_org['status'])&& $proj_org['status']=='1')
                { 
                    echo form_label(lang('Approved'),'',array('class'=>'left_label','style'=>'color:Green;font-weight:bold;width:70px;'));
                }
                elseif(isset($proj_org['status'])&& $proj_org['status']=='0')
                { 
                    echo form_label(lang('Pending'),'',array('class'=>'left_label','style'=>'color:Blue;font-weight:bold;width:70px;'));
                }
                else
                {
                    echo form_hidden("hdn_project_organizations_action",'Add');
                }
                ?>
            <?php echo form_submit($opt["submit"]); ?>
            <?php echo form_close(); ?>
            </div>
            <br/>

                
                    <div class="clearfix matrix_dropdown project_organizations">
                        <ul id="load_organization_form">

                            <?php
                            foreach($project["organization"] as $key=>$val)
                            {
                            ?>
                            <li class="" id="row_id_<?php echo $val["id"]; ?>">
                                
                                <div class="view clearfix">
                                    
                                    <span class="left"><?php echo $val["role"]; ?></span>

                                    <span class="left middle">
                                        <strong><?php echo $val["company"]; ?></strong>
                                        <br>
                                        <?php echo $val["contact"].", ".$val["email"]; ?>
                                    </span>

                                    <a class="right delete" href="#projects/delete_organization"><?php echo lang('Delete');?></a>

                                    <a class="right edit" id="edit_organization_<?php echo $val["id"];?>" href="javascript:void(0);" onclick="rowtoggle(this.id);"><?php echo lang('Edit');?></a>

                                </div>

                                <div class="edit">
                                    <?php echo form_open_multipart("projects/update_organization/".$slug."",array("id"=>"update_organization_form","name"=>"update_organization_form_".$val["id"],"class"=>"ajax_form")); ?>
                                    <?php echo form_hidden("hdn_project_organizations_id",$val["id"]); ?>

                                    <?php echo form_label(lang("CompanyName").":","",array("class"=>"left_label")); ?>
                                    <div class="fld">
                                        <?php echo form_input(array("name"=>"project_organizations_company","id"=>"project_organizations_company","value"=>$val["company"])); ?>
                                        <div class="errormsg" id="err_project_organizations_company_name"></div>
                                    </div>
                                    <br>
                                    
                                    
                                    <?php echo form_label(lang("Role").":","",array("class"=>"left_label")); ?>
                                    <div class="fld">
                                        <?php 
                                            $project_organizations_role_attr = "";
                                            $project_organizations_role_options = array(
                                                "Sponsor"   => lang("Sponsor"),
                                                "Overseer"  => lang("Overseer")
                                            );
                                            echo form_dropdown("project_organizations_role",$project_organizations_role_options,$val["role"],$project_organizations_role_attr);
                                        ?>
                                        <div class="errormsg"></div>
                                    </div>
                                    
                                    <br>
                                    
                                    <?php echo form_label(lang("Contact").":","",array("class"=>"left_label")); ?>
                                    <div class="fld">
                                    <?php echo form_input(array("name"=>"project_organizations_contact","id"=>"project_organizations_contact","value"=>$val["contact"])); ?>
                                        <div class="errormsg"></div>
                                    </div>
                                    <br>
                                    
                                    <?php echo form_label(lang("Email").":","",array("class"=>"left_label")); ?>
                                    <div class="fld">
                                    <?php echo form_input(array("name"=>"project_organizations_email","id"=>"project_organizations_contact","value"=>$val["email"])); ?>
                                        <div class="errormsg"></div>
                                    </div>
                                    <br>
                                    
                                    <?php echo form_submit(array("name"=>"Update","class"=>"light_green btn_lml","value"=>lang("Update"))); ?>
                                    <?php echo form_reset(array("class"=>"light_red btn_sml","value"=>lang("Close"))); ?>
                                    <?php echo form_close(); ?>

                                </div>

                            </li>
                            <?php   
                            }
                            ?>
                            </ul>
                            
                            <ul>
                            <li>
                                <div class="view">
                                    
                                    <a href="javascript:void(0);" id="addOrganization" onclick="rowtoggle(this.id);" class="edit project_row_add"><?php echo "+ ".lang('AddOrganizations');?></a>

                                </div>

                                <div class="edit add_new">
                                    <?php echo form_open_multipart("projects/add_organization/".$slug."",array("id"=>"organization_form","class"=>"ajax_form")); ?>
                                    <?php echo form_hidden("hdn_project_organizations_id","0",FALSE,"class='project_new_row' disabled='disabled'"); ?>

                                    <?php echo form_label(lang("CompanyName").":","",array("class"=>"left_label")); ?>
                                    
                                    <div class="fld">
                                        <?php echo form_input(array("name"=>"project_organizations_company","id"=>"project_organizations_company")); ?>
                                        <div class="errormsg"></div>
                                    </div>
                                    <br>
                                    
                                    <?php echo form_label(lang("Role").":","",array("class"=>"left_label")); ?>
                                    <div class="fld">
                                        <?php 
                                            $project_organizations_role_attr = "";
                                            $project_organizations_role_options = array(
                                                "Sponsor"   => lang("Sponsor"),
                                                "Overseer"  => lang("Overseer")
                                            );
                                            echo form_dropdown("project_organizations_role",$project_organizations_role_options,'',$project_organizations_role_attr);
                                        ?>
                                        <div class="errormsg"></div>
                                    </div>
                                    <br>
                                    
                                    <?php echo form_label(lang("Contact").":","",array("class"=>"left_label")); ?>
                                    <div class="fld">
                                        <?php echo form_input(array("name"=>"project_organizations_contact","id"=>"project_organizations_contact")); ?>
                                        <div class="errormsg"></div>
                                    </div>
                                    <br>
                                    
                                    <?php echo form_label(lang("Email").":","",array("class"=>"left_label")); ?>
                                    <div class="fld">
                                        <?php echo form_input(array("name"=>"project_organizations_email","id"=>"project_organizations_email")); ?>
                                        <div class="errormsg"></div>
                                    </div>
                                    <br>
                                    
                                    <?php echo form_submit(array("name"=>"Add New","class"=>"light_green btn_lml","value"=>lang("AddNew"))); ?>
                                    <?php echo form_close(); ?>
                                </div>

                            </li>
                        </ul>

                    </div>

                </div>

            </div></div><!-- end #tabs -->

            <div aria-labelledby="ui-dialog-title-dialog-message" class="ui-dialog ui-widget ui-widget-content ui-corner-all ui-draggable ui-resizable" role="dialog"       style="display: none; z-index: 1002; outline: 0px none; position: absolute; height: auto; width: 300px; top: 1050px; left: 558px;" tabindex="-1">
                <div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
                    <span id="ui-dialog-title-dialog-message" class="ui-dialog-title"><?php echo lang('Message');?></span>
                    <a class="ui-dialog-titlebar-close ui-corner-all" href=javascript:void(0); role="button">
                        <span class="ui-icon ui-icon-closethick"><?php echo lang('close');?></span>
                    </a>
                </div>
                <div id="dialog-message" class="ui-dialog-content ui-widget-content" scrollleft="0" scrolltop="0" style="width: auto; min-height: 12.8px; height: auto      ;">
                    <?php echo lang('updatedMessage');?></div>
                <div class="ui-resizable-handle ui-resizable-n"></div>
                <div class="ui-resizable-handle ui-resizable-e"></div>
                <div class="ui-resizable-handle ui-resizable-s"></div>
                <div class="ui-resizable-handle ui-resizable-w"></div>
                <div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se ui-icon-grip-diagonal-se" style="z-index: 1001;"></div>
                <div class="ui-resizable-handle ui-resizable-sw" style="z-index: 1002;"></div>
                <div class="ui-resizable-handle ui-resizable-ne" style="z-index: 1003;"></div>
                <div class="ui-resizable-handle ui-resizable-nw" style="z-index: 1004;"></div>
                <div class="ui-dialog-buttonpane ui-widget-content ui-helper-clearfix">
                    <div class="ui-dialog-buttonset">
                        <button aria-disabled="false" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" type="button">
                        <span class="ui-button-text"><?php echo lang('Ok');?></span></button>
                    </div>
                </div>
            </div>

        </div><!-- end #col5 -->

    </div><!-- end #content -->

    <div id="dialog-message"></div>

<script src="/js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="/js/selectize.min.js"></script>
<link rel="stylesheet" type="text/css" href="/css/selectize.css" />
<script>
    var mapCoords = [<?php echo $project['lat'],',', $project['lng'];?>];
    var isAdmin = true;
    var slug = '<?php echo $slug; ?>';
    var map_geom = <?php echo json_encode($map_geom); ?>;

    $('#project_keywords').selectize({
        plugins: ['remove_button'],
        delimiter: ',',
        persist: false,
        create: function(input) {
            return {
                value: input,
                text: input
            }
        }
    });

    $('#modal1').on('hidden.bs.modal', function (e) {
        // do something...
        $('#modal1 iframe').attr("src", $("#modal1 iframe").attr("src"));
    });

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

<style>
.ui-datepicker-calendar {
    display: none;
}
.selectize-input {
    width: 363px;
}
</style>

<!-- Youtube Modal Start -->
<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <!--Content-->
        <div class="modal-content" style="margin-top: 100px">
            <!--Body-->
            <div class="modal-body mb-0 p-0">
                <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/lzMQbpXG7xQ"
                            allowfullscreen></iframe>
                </div>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
<!-- Youtube Modal End -->
