                <div id="tabs-1" class="col2_tab">
                    <?php if (($project['projectdata']['lat'] && $project['projectdata']['lng']) || $isAdminorOwner ) { ?>
                        <div class="map_box clearfix">
                            <div id="project-map">
                                <a href="http://mapbox.com/about/maps" class='mapbox-wordmark' target="_blank">Mapbox</a>
                            </div>

                            <div class="clearfix">
                                <p class="left coord"><span class="geo"></span> <span class="address"><?php if ($project['projectdata']['location']!= '') { echo $project['projectdata']['location'];} else { echo "N/A";} ?></span> <?php if ($isAdminorOwner) { ?> <a class="save_location" style="display: none;">Save</a> <?php } ?></p>
                                <?php /* <p class="right coord"><span class="geo"><span class="latitude"><?php echo $val['latitude'];?></span>, <span class="longitude"><?php echo $val['longitude'];?></span></span> <a href="#"><?php echo lang("Map");?></a></p> */ ?>
                            </div>
                        </div>
                    <?php } ?>

                    <table class="overview_table">
                        <tr>
                            <th><?php echo lang('Stage');?>:</th>
                            <td>
                                <?php if ($project['projectdata']['stage'] != '' ){if($project['projectdata']['stage'] == "om") {echo "Operation &amp; Maintenance"; } else {echo ucfirst($project['projectdata']['stage']);}} else { echo "N/A";} ?>
                            </td>
                            <th><?php echo lang('Location');?>:</th>
                            <td class="city_state"><?php echo $project['prettylocation']; ?></td>
                        </tr>
                        <?php if ($project['projectdata']['stage_elaboration'] != '') { ?>
                        <tr>
                            <th><?php echo lang('StageElaboration');?>:</th>
                            <td><?php echo $project['projectdata']['stage_elaboration']; ?></td>
                            <th></th>
                            <td></td>
                        </tr>
                        <?php } ?>
                        <tr>
                            <th><?php echo lang('Sector');?>:</th>
                            <td><?php if ($project['projectdata']['sector']!= '') { echo $project['projectdata']['sector'];} else { echo "N/A";} ?></td>
                            <th><?php echo lang('Sub-Sector');?>:</th>
                            <td><?php if ($project['projectdata']['subsector'] != '') { echo $project['projectdata']['subsector'];} else { echo $project['projectdata']['subsector_other'];} ?></td>
                        </tr>
                        <tr>
                            <th><?php echo lang('FinancialStructure');?>:</th>
                            <td><?php if ($project['projectdata']['financialstructure']!= '') { echo $project['projectdata']['financialstructure'];} else { echo "N/A";} ?>
                            </td>
                            <th><?php echo lang('Budget');?>:</th>
                            <td><?php echo format_budget($project['projectdata']['totalbudget']) ?></td>
                        </tr>
                        <tr>
                            <th><?php echo lang('EstStart');?>:</th>
                            <td><?php if ($project['projectdata']['eststart']!= '' && $project['projectdata']['eststart']!= '1111-11-11'){ $startdt = new DateTime($project['projectdata']['eststart']); echo $startdt->format(DATEFORMATVIEW_MONTHONLY);} else { echo "N/A";} ?></td>
                            <th><?php echo lang('EstCompletion');?>:</th>
                            <td><?php if ($project['projectdata']['estcompletion']!= '' && $project['projectdata']['estcompletion'] != '1111-11-11'){$compdt = new DateTime($project['projectdata']['estcompletion']); echo $compdt->format(DATEFORMATVIEW_MONTHONLY);} else { echo "N/A";} ?></td>
                        </tr>
                        <tr>
                            <th><?php echo lang('Developer');?>:</th>
                            <td><?php if (isset($project['projectdata']['developer']) && $project['projectdata']['developer']!= ''){ echo $project['projectdata']['developer'];} else { echo "N/A";} ?></td>
                            <th><?php echo lang('Sponsor');?>:</th>
                            <td><?php if (isset($project['projectdata']['sponsor']) && $project['projectdata']['sponsor'] != '') { echo $project['projectdata']['sponsor'];} else { echo "N/A";} ?></td>
                        </tr>
                        <tr>
                            <th><?php echo lang('Website') ?>:</th>
                            <td>
                                <?php
                                if (! empty($project['projectdata']['website'])) {
                                    $url = $project['projectdata']['website'];
                                    $parsed_url = parse_url($project['projectdata']['website']);
                                    if (is_array($parsed_url)) {
                                        $readable_url = $parsed_url['host'];
                                    } ?>
                                    <a href="<?php echo $url ?>" target="_blank" title="<?php echo $url ?>"><?php echo $readable_url ?></a>
                                <?php } else { ?>
                                    N/A
                                <?php } ?>
                            </td>
                            <th><?php echo lang('EstJobsCreated') ?>:</th>
                            <td class="tooltip-container">
                                <div><?php echo ($project['projectdata']['jobs_created'] !== null) ? number_format($project['projectdata']['jobs_created']) : 'N/A' ?></div>
                                <a class="tooltip" title="<?php echo lang('JobsCreatedExplanation') ?>" target="_blank" href="https://gvip.zendesk.com/hc/en-us/articles/360003440613"></a>
                            </td>
                        </tr>
                        <tr>
                            <th>People Served:</th>
                            <td><?php if (isset($project['projectdata']['people_served']) && $project['projectdata']['people_served']!= ''){ echo $project['projectdata']['people_served'];} else { echo "N/A";} ?></td>
                            <th>Marginal People Served:</th>
                            <td><?php if (isset($project['projectdata']['marg_peopleserved']) && $project['projectdata']['marg_peopleserved'] != '') { echo $project['projectdata']['marg_peopleserved'];} else { echo "N/A";} ?></td>
                        </tr>
                        <tr>
                            <th>Increased Property Value:</th>
                            <td><?php if (isset($project['projectdata']['property_val']) && $project['projectdata']['property_val']!= ''){ echo $project['projectdata']['property_val'].' $MM';} else { echo "N/A";} ?></td>
                            <th>Carbon Emissions Saved:</th>
                            <td><?php if (isset($project['projectdata']['co2_saved']) && $project['projectdata']['co2_saved'] != '') { echo $project['projectdata']['co2_saved'].' Tons/Year';} else { echo "N/A";} ?></td>
                        </tr>
                        <tr>
                            <th>Economic Impact:</th>
                            <td><?php if (isset($project['projectdata']['econ_impact']) && $project['projectdata']['econ_impact']!= ''){ echo $project['projectdata']['econ_impact'].' $MM/Year';} else { echo "N/A";} ?></td>
                            <th>Carbon Emissions Saved:</th>
                            <td><?php if (isset($project['projectdata']['oil_eliminated']) && $project['projectdata']['oil_eliminated'] != '') { echo $project['projectdata']['oil_eliminated'].' Tons/Year';} else { echo "N/A";} ?></td>
                        </tr>
                    </table>
                </div>