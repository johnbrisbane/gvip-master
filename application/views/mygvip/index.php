<div class="clearfix" id="content" style="width: 90%;">
    <br>
    <div class="column_1" style="margin-top: 2%">
        <!-- Key Executives -->
        <section class="similar-experts group">
            <h2 class="shadow my_vip_header h2"><?php echo lang('MyVipKeyExecutives') ?></h2>
            <div>
                <ul class="reset">
                    <?php if (count($key_executives) == 0) { ?>
                        <li class="not_found">
                            <?php echo lang('MyVipKeyExecutivesNotFound'); ?>
                        </li>
                    <?php } ?>

                    <?php foreach($key_executives as $expert) { ?>
                        <?php $fullname = $expert['firstname'] . ' ' . $expert['lastname'] ?>
                        <li class="m_person">
                            <a href="/expertise/<?php echo $expert['uid'] ?>" class="image recommendation" data-recommendation-location="My GViP" data-recommendation-category="Expert" data-recommendation-section="Key Executives" data-recommendation-target-id="<?php echo $expert['uid'] ?>" data-recommendation-target-name="<?php echo $fullname ?>">
                                <img src="<?php echo expert_image($expert['userphoto']) ?>" alt="<?php echo $fullname ?>'s photo">
                            </a>
                            <p class="content">
                                <a href="/expertise/<?php echo $expert['uid'] ?>" class="recommendation" data-recommendation-location="My GViP" data-recommendation-category="Expert" data-recommendation-section="Key Executives" data-recommendation-target-id="<?php echo $expert['uid'] ?>" data-recommendation-target-name="<?php echo $fullname ?>"><?php echo $fullname ?></a>
                                <span class="title"><?php echo $expert['title'] ?></span>
                                <span class="title"><?php echo $expert['organization'] ?></span>
                            </p>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </section>

        <!-- Similar Projects -->
        <section class="similar-projects group">
            <h2 class="shadow my_vip_header h2"><?php echo lang('MyVipSimilarProjects') ?></h2>
            <div>
                <?php if (count($similar_projects) == 0) { ?>
                    <p class="not_found">
                        <?php echo lang('MyVipSimilarProjectsNotFound'); ?>
                    </p>
                <?php } ?>
                <?php foreach ($similar_projects as $project) { ?>
                    <article class="m_project">
                        <div class="image">
                            <div class="image_wrap">
                                <a href="<?php echo '/projects/' . $project['id'] ?>" class="recommendation" data-recommendation-location="My GViP" data-recommendation-category="Project" data-recommendation-section="Similar Projects" data-recommendation-target-id="<?php echo $project['id'] ?>" data-recommendation-target-name="<?php echo $project['projectname'] ?>">
                                    <img src="<?php echo project_image($project['projectphoto']) ?>" alt="<?php echo $project['projectname'] . "'s photo" ?>">
                                </a>
                            </div>
                            <span class="ps_<?php echo project_stage_class($project['stage']) ?>"></span>
                            <span class="price"><?php echo format_budget($project['totalbudget']) ?></span>
                        </div>
                        <div class="content">
                            <h3 class="the_title"><a href="<?php echo '/projects/' . $project['id'] ?>" class="recommendation" data-recommendation-location="My GViP" data-recommendation-category="Project" data-recommendation-section="Similar Projects" data-recommendation-target-id="<?php echo $project['id'] ?>" data-recommendation-target-name="<?php echo $project['projectname'] ?>"><?php echo $project['projectname'] ?></a></h3>
                            <span class="type <?php echo project_sector_class($project['sector']) ?>"><?php echo ucfirst($project['sector']) ?></span>
                        </div>
                    </article>
                <?php } ?>
            </div>
        </section>

        <!-- My Projects -->
        <section class="my-projects group">
            <h2 class="shadow my_vip_header h2"><?php echo lang('MyVipMyProjects') ?></h2>
            <div>
                <?php if (count($my_projects) > 0) { ?>
                    <?php foreach ($my_projects as $project) { ?>
                        <article class="m_project">
                            <div class="image">
                                <div class="image_wrap">
                                    <a href="<?php echo '/projects/' . $project['id'] ?>" class="recommendation" data-recommendation-location="My GViP" data-recommendation-category="Project" data-recommendation-section="My Projects" data-recommendation-target-id="<?php echo $project['id'] ?>" data-recommendation-target-name="<?php echo $project['projectname'] ?>">
                                        <img src="<?php echo project_image($project['projectphoto']) ?>" alt="<?php echo $project['projectname'] . "'s photo" ?>">
                                    </a>
                                </div>
                                <span class="ps_<?php echo project_stage_class($project['stage']) ?>"></span>
                                <span class="price"><?php echo format_budget($project['totalbudget']) ?></span>
                            </div>
                            <div class="content">
                                <h3 class="the_title"><a href="<?php echo '/projects/' . $project['id'] ?>" class="recommendation" data-recommendation-location="My GViP" data-recommendation-category="Project" data-recommendation-section="My Projects" data-recommendation-target-id="<?php echo $project['id'] ?>" data-recommendation-target-name="<?php echo $project['projectname'] ?>"><?php echo $project['projectname'] ?></a></h3>
                                <span class="type <?php echo project_sector_class($project['sector']) ?>"><?php echo ucfirst($project['sector']) ?></span>
                            </div>
                        </article>
                    <?php } ?>
                    <div class="more_link">
                        <a href="/mygvip/myprojects"><?php echo lang('ViewMore') ?></a>
                    </div>
                <?php } else { ?>
                    <p class="not_found">
                        <?php echo lang('MyVipMyProjectsNotFound'); ?>
                    </p>
                <?php } ?>
            </div>
        </section>

        <!-- My Experts -->
        <section class="similar-experts group">
            <h2 class="shadow my_vip_header h2"><?php echo lang('MyVipMyExperts') ?></h2>
            <div>
                <ul class="reset">
                    <?php foreach($my_experts as $expert) { ?>
                        <li class="m_person">
                            <a href="/expertise/<?php echo $expert['uid'] ?>" class="image recommendation" data-recommendation-location="My GViP" data-recommendation-category="Expert" data-recommendation-section="My Experts" data-recommendation-target-id="<?php echo $expert['uid'] ?>" data-recommendation-target-name="<?php echo $expert['fullname'] ?>">
                                <img src="<?php echo expert_image($expert['userphoto']) ?>" alt="<?php echo $expert['fullname'] ?>'s photo">
                            </a>
                            <p class="content">
                                <a href="/expertise/<?php echo $expert['uid'] ?>" class="recommendation" data-recommendation-location="My GViP" data-recommendation-category="Expert" data-recommendation-section="My Experts" data-recommendation-target-id="<?php echo $expert['uid'] ?>" data-recommendation-target-name="<?php echo $expert['fullname'] ?>"><?php echo $expert['fullname'] ?></a>
                                <span class="title"><?php echo $expert['title'] ?></span>
                                <span class="title"><?php echo $expert['organization'] ?></span>
                            </p>
                        </li>
                    <?php } ?>
                    <?php if (empty($my_experts)) { ?>
                        <li class="not_found m_person"><?php echo lang('MyVipMyExpertsNotFound') ?></li>
                    <?php } ?>
                </ul>
                <?php if (! empty($my_experts)) { ?>
                    <div class="more_link">
                        <a href="/mygvip/myexperts"><?php echo lang('ViewMore') ?></a>
                    </div>
                <?php } ?>
                <div class="more_link">
                    <a href="/mygvip/myfollowers"><?php echo lang('ViewMyFollowers') ?></a>
                </div>
            </div>
        </section>

        <!-- New Experts -->
        <section class="similar-experts group">
            <h2 class="shadow my_vip_header h2"><?php echo lang('MyVipNewExperts') ?></h2>
            <div>
                <ul class="reset">
                    <?php foreach($new_experts as $expert) { ?>
                        <?php $fullname = $expert['firstname'] . ' ' . $expert['lastname'] ?>
                        <li class="m_person">
                            <a href="/expertise/<?php echo $expert['uid'] ?>" class="image recommendation" data-recommendation-location="My GViP" data-recommendation-category="Expert" data-recommendation-section="New Experts" data-recommendation-target-id="<?php echo $expert['uid'] ?>" data-recommendation-target-name="<?php echo $fullname ?>">
                                <img src="<?php echo expert_image($expert['userphoto']) ?>" alt="<?php echo $fullname ?>'s photo">
                            </a>
                            <p class="content">
                                <a href="/expertise/<?php echo $expert['uid'] ?>" class="recommendation" data-recommendation-location="My GViP" data-recommendation-category="Expert" data-recommendation-section="New Experts" data-recommendation-target-id="<?php echo $expert['uid'] ?>" data-recommendation-target-name="<?php echo $fullname ?>"><?php echo $fullname ?></a>
                                <span class="title"><?php echo $expert['title'] ?></span>
                                <span class="title"><?php echo $expert['organization'] ?></span>
                            </p>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </section>

        <!-- My Discussions -->
        <?php if (! empty($my_discussions)) { ?>
            <section class="similar-experts group">
                <h2 class="shadow my_vip_header h2"><?php echo mb_convert_case(lang('MyVipMyDiscussions'), MB_CASE_UPPER) ?></h2>
                <div>
                    <ul class="reset">
                        <?php foreach($my_discussions as $discussion) { ?>
                            <li class="m_person">
                                <a href="/projects/discussions/<?php echo $discussion['project_id'] ?>/<?php echo $discussion['id'] ?>" class="image recommendation" data-recommendation-location="My GViP" data-recommendation-category="Discussion" data-recommendation-section="My Discussions" data-recommendation-target-id="<?php echo $discussion['id'] ?>" data-recommendation-target-name="<?php echo $discussion['title'] ?>">
                                    <img src="<?php echo safe_image(USER_NO_IMAGE_PATH, DISCUSSION_IMAGE_PLACEHOLDER, null, array('max' => 50)) ?>" alt="Discussion's photo">
                                </a>
                                <p class="content">
                                    <a href="/projects/discussions/<?php echo $discussion['project_id'] ?>/<?php echo $discussion['id'] ?>" class="recommendation" data-recommendation-location="My GViP" data-recommendation-category="Discussion" data-recommendation-section="My Discussions" data-recommendation-target-id="<?php echo $discussion['id'] ?>" data-recommendation-target-name="<?php echo $discussion['title'] ?>"><?php echo $discussion['title'] ?></a>
                                </p>
                            </li>
                        <?php } ?>
                    </ul>
                    <div class="more_link">
                        <a href="/mygvip/mydiscussions"><?php echo lang('ViewMore') ?></a>
                    </div>
                </div>
            </section>
        <?php } ?>

        <section class="similar-experts group">
            <h2 class="shadow my_vip_header h2"><?php echo 'Maximize the Value of Your Profile' ?></h2>
            <div>
                <ul class="reset">
                    <li class="m_person">
                        <span class="light_green" data-toggle="modal" data-target="#modal1">Watch Profile Tutorial</span>
                    </li>

                    <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index: 9999999">
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

                </ul>
            </div>
        </section>

    </div>

    <div class="column_2">
        <!-- map -->
        <div class="map" style="margin-left: 2em">
            <div class="map_filter my_vip">
                <form id="map_search">
                    <div class="form_row">
                        <!-- <div class="input_group pe_toggle"> -->
                        <div class="select_wrap input_group">
                            <!--                            <span class="show_me">Show:</span>-->
                            <div class="form_control">
                                <?php
                                $members_options = show_members_dropdown2();
                                $keys = array_keys($members_options);
                                echo form_dropdown("content_type", $members_options, array(array_shift($keys)), 'id="content_type" class="toggle_experts"');
                                $keys = null;
                                ?>
                            </div>
                        </div>

                        <div class="select_wrap input_group stage toggle_projects">
                            <!--                            <span class="word">Stage:</span>-->
                            <div class="form_control">
                                <!--                                <label class="access" for="f4">Stage:</label>-->
                                <?php
                                $project_stage_options = stages_dropdown();
                                echo form_dropdown("project_stage",$project_stage_options,'','class="toggle_projects"');
                                ?>
                            </div>
                        </div>

                        <div class="select_wrap input_group discipline toggle_experts">
                            <!--                            <span class="word">In:</span>-->
                            <div class="form_control">
                                <!--                                <label class="access" for="f4">In:</label>-->
                                <?php
                                $expert_discipline_options =  discipline_dropdown();
                                array_shift($expert_discipline_options);
                                $list = array('' => lang('AnyDiscipline')) + $expert_discipline_options;
                                echo form_dropdown("expert_discipline",$list,'','class="toggle_experts"');
                                ?>
                            </div>
                        </div>

                        <div class="select_wrap input_group sector">
                            <!--                            <span class="word">Sector:</span>-->
                            <div class="form_control">
                                <!--                                <label class="access" for="f3">Sectors</label>-->
                                <select id="f3" name="sector">
                                    <option value="">All Sectors</option>
                                    <?php echo map_sector_options() ?>
                                </select>
                            </div>
                        </div>

                        <div class="select_wrap input_group toggle_projects budget">
                            <!--                            <span class="word">Value:</span>-->
                            <div class="form_control">
                                <!--                                <label class="access" for="f6">Budget</label>-->
                                <?php
                                $budget_dropdown_options = budget_dropdown();
                                echo form_dropdown('budget',$budget_dropdown_options,'','class="toggle_projects" id="budget"');
                                ?>
                            </div>
                        </div>
                    </div>
                </form>
            </div><!-- end filter -->
        </div>
        <div class="dn" id="map_projects"></div>
        <div class="dn" id="map_experts"></div>
        <div id="map_wrapper" class="my_vip">
            <div id="p_e_map" class="p_e_map" style="width:98%; height:450px; margin-left: 2em">
                <a href="http://mapbox.com/about/maps" class='mapbox-wordmark' target="_blank">Mapbox</a>
            </div>
        </div>
    </div>
</div>

<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script><!-- CSS only -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
      integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

<!-- JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
</script>
<script>
    AOS.init();
</script>

<style>
    body,
    html {
        height: 100%;
        scroll-behavior: smooth;
    }



    .newsfeed-filter {
        font-size: 24px;
        margin-left: 0em;
        font-weight: bold;
        letter-spacing: 1px;
        color: #5a5a5a;
        border-bottom: 1px solid #5a5a5a;
        margin-bottom: 1em;
    }

    .containerpop {
        display: none;
        z-index: 100;
    }


    .xpop {
        position: absolute;
        right: 15px;
        top: 25px;
        width: 40px;
        height: 35px;
        cursor: pointer;

    .one,
    .two {
        background-color: black;
        height: 3px;
        width: 100%;
        cursor: pointer;
    }

    .one {
        transform: rotate(45deg) translate(7px, 7px);
    }

    .two {
        transform: rotate(-45deg) translate(-4px, 4px);
    }
    }

    .pop-up__container {
        height: 250px;
        align-items: center;
        display: flex;
        flex-direction: row;
    }

    .pop-up__svg {
        margin: 1.5em 2.5em;
        border-radius: 50%;
        width: 150px;
        height: 150px;

    }

    .pop-up__svg img {
        margin: auto;
        width: 100%;
        height: 100%;
        animation-name: helper-load;
        animation-duration: 3000ms;
        animation-fill-mode: forwards;
    }

    .pop-up__message {

        height: 200px;
        display: flex;
        flex-direction: row;

    }

    .pop-up__arrow {
        width: 0;
        height: 0;
        border-top: 100px solid transparent;
        border-bottom: 100px solid transparent;
        border-right: 100px solid #eee;
    }

    .pop-up__content {
        height: 200px;
        width: 70%;
        background: #eee;
        border-radius: 0 10px 10px 0;
        box-shadow: 2px 2px 5px #bababa;
        animation-name: popup-load;
        animation-duration: 500ms;
        animation-fill-mode: forwards;

    }

    .pop-up__header {
        width: 90%;
        font-size: 24px;
        font-weight: lighter;
        color: #136695;
        margin: .5em;
    }

    .pop-up__body {
        margin: .5em;
        font-weight: normal;
        font-size: 20px;
        color: #5a5a5a;
    }

    .pop-up__url {
        text-decoration: none;
    }

    .pop-up__action {
        margin-top: 5px;
        transform: translateX(-120%);
        width: 25px;
        height: 25px;

    }

    .pop-up__action img {
        width: 100%;
        height: 100%;

    }

    .pop-up__action img:hover {
        cursor: pointer;
        transform: scale(1.1);
        transition: 300ms;
    }



    @keyframes popup-load {
        from {
            width: 10%
        }

        to {
            width: 70%;
        }
    }

    @keyframes helper-load {
        0% {
            opacity: 0;
        }

        20% {
            opacity: 1;
        }

        30% {
            opacity: 0.9;
        }

        40% {
            opacity: 1;
        }

        50% {
            opacity: 0.9;
        }

        60% {
            opacity: 1;
        }

        70% {
            opacity: 0.9;
        }

        80% {
            opacity: 1;
        }

        90% {
            opacity: 0.9;
        }

        100% {
            opacity: 1;
        }
    }

    @keyframes helper-disapear {
        0% {
            transform: rotate(0%);
            opacity: 1;
        }

        99% {
            transform: rotate(360deg);
            opacity: 0;
        }

        100% {
            display: none;
        }

    }

    @keyframes popup-disapear {
        from {
            width: 70%
        }

        to {
            width: 0%;

        }
    }

    .button-container {
        margin-top: 2em;
    }


    .containerpop {
        box-shadow: 0px 0px 68px -2px rgba(59, 59, 59, .5);
        width: 800px;
        height: 425px;
        position: absolute;
        left: 50%;
        top: 1000px;
        transform: translate(-50%, -50%);
        background-color: white;
        background-size: 100%;
        margin: 0 auto;

    }

    .button-container {
        margin: 2em 2.5em !important;
        padding: 0 !important;
    }

    .light_green {
        border: 1px solid #376728;
        background: #9ad18a;
        color: #376728;
        font-size: 20px;
    }

    .light_green:hover {
        transition: 300ms;
        background: #7BC365;
        cursor: pointer;
    }

    @media screen and (max-width:1000px) {
        .pop-up__header {
            font-size: 18px;
        }

        .pop-up__body {
            font-size: 16px;
        }
    }

    @media screen and (max-width:500px) {
        .pop-up__header {
            font-size: 14px;
        }

        .pop-up__body {
            font-size: 11px;
        }

        .pop-up__arrow {
            border-right: 50px solid #eee;
        }

    }

    .daily-ui {
        position: absolute;
        bottom: -98px;
        font-size: 12em;
        font-weight: 700;
        color: rgba(84, 167, 147, .1);
        text-shadow: rgba(255, 255, 255, 0.0980392) -1px -1px 1px, rgba(84, 167, 147, 0.1) 1px 1px 1px;
    }
</style>
<hr class="solid" style="border-top: 3px solid #bbb; width: 100%">
<div class="button-container" style="width: 61%; height: 5%">
    <span id="click-me" class="light_green" style="margin-left: 5%">Create a Post</span>
</div>
<div class="containerpop" id="show_post" style="z-index: 10000">
    <div class="xpop">
        <div class="one"></div>
        <h1>X</h1>
        <div class="two"></div>
    </div>

    <div style="padding-left: 15px; padding-top: 10px">
        <?php echo form_open('profile/create_book/',array('id'=>'create_book_form','name'=>'create_book_form','method'=>'post','class'=>'ajax_form'));?>
        <?php
        $opt['create_book_form'] = array(
            'lbl_booktitle' => array(
            ),
            'book_title'	=> array(
                'name' 		=> 'book_title',
                'id' 		=> 'book_title',
            ),
            'lbl_bookcontent' => array(
            ),
            'book_content'	=> array(
                'name' 		=> 'book_content',
                'id' 		=> 'book_content',
            )
        );

        ?>

        <?php echo form_label('Post Title'.':', '', $opt['create_book_form']['lbl_booktitle']);?>
        <div>
            <?php echo form_input(array(
                'type' => 'text',
                'id' => 'book_title',
                'name' => 'book_title',
                'value' => '',
                'style' => 'width:50%; height:1%'
            ));?>
            <div id="err_project_name" class="errormsg"></div>
        </div>
        <div class="contenttitle2">
            <p>Content:</p>
        </div>
        <div>
            <?php echo form_textarea(array(
                'type' => 'text',
                'id' => 'book_content',
                'class' => 'tinymce',
                'name' => 'book_content',
                'value' => '',
                'data-width' => '760',
                'data-height' => '190'
            )); ?>
        </div>
        <br>

        <?php echo form_submit('link_submit', 'Share','class = "light_green"');?>

        <?php echo form_close(); ?>
    </div>
</div>

<div aria-labelledby="ui-dialog-title-dialog-message"
     class="ui-dialog ui-widget ui-widget-content ui-corner-all ui-draggable ui-resizable" role="dialog"
     style="display: none; z-index: 1002; outline: 0px none; position: absolute; height: auto; width: 300px; top: 1050px; left: 558px;"
     tabindex="-1">
    <div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
        <span id="ui-dialog-title-dialog-message" class="ui-dialog-title">Message</span>
        <a class="ui-dialog-titlebar-close ui-corner-all" href=javascript:void(0); role="button">
            <span class="ui-icon ui-icon-closethick">close</span>
        </a>
    </div>
    <div id="dialog-message" class="ui-dialog-content ui-widget-content" scrollleft="0" scrolltop="0"
         style="width: auto; min-height: 12.8px; height: auto;">
        <?php echo lang('successupdated');?></div>
    <div class="ui-resizable-handle ui-resizable-n"></div>
    <div class="ui-resizable-handle ui-resizable-e"></div>
    <div class="ui-resizable-handle ui-resizable-s"></div>
    <div class="ui-resizable-handle ui-resizable-w"></div>
    <div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se ui-icon-grip-diagonal-se"
         style="z-index: 1001;"></div>
    <div class="ui-resizable-handle ui-resizable-sw" style="z-index: 1002;"></div>
    <div class="ui-resizable-handle ui-resizable-ne" style="z-index: 1003;"></div>
    <div class="ui-resizable-handle ui-resizable-nw" style="z-index: 1004;"></div>
    <div class="ui-dialog-buttonpane ui-widget-content ui-helper-clearfix">
        <div class="ui-dialog-buttonset">
            <button aria-disabled="false" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only"
                    role="button" type="button">
                <span class="ui-button-text"><?php echo lang('Ok');?></span></button>
        </div>
    </div>
</div>


<script>

    $("#click-me").click(function() {
        $("#show_post").toggle("slow", function() {});
        window.scrollTo(0, 700);
    });

    $(".xpop").click(function() {
        $(".containerpop").toggle("slow", function() {
            // Animation complete.
        });
    });

    const pop_up_action = document.querySelector('.pop-up__action');

    const pop_up_content = document.querySelector('.pop-up__content');

    const pop_up_message = document.querySelector('.pop-up__message')

    const pop_up_triangle = document.querySelector('.pop-up__arrow');

    const pop_up_bot = document.querySelector('.pop-up__svg');

    const pop_up_container = document.querySelector('.pop-up__container')


    pop_up_action.addEventListener('click', () => {
        pop_up_content.style.animationName = 'popup-disapear';
        pop_up_content.querySelector('h1').style.visibility = 'hidden';
        pop_up_content.querySelector('p').style.visibility = 'hidden';
        setTimeout(() => {
            pop_up_message.remove();
            console.log(pop_up_bot)
            pop_up_bot.querySelector('img').style.animationDuration = '500ms'
            pop_up_bot.querySelector('img').style.animationName = 'helper-disapear';
            setTimeout(() => {
                pop_up_container.remove();
            }, 500)
        }, 500)

    })
</script>

<!-- Main content section -->
<section id="feed-section">
    <div class="container-fluid">
        <div class="row">

            <div class="sidebar-container col-xl-2 mr-auto col-12 mb-4 my-3" style="margin-left: 5em">

                <div style="display: none;" class="col-12 sidebar-section-row">
                    <h1 class="sidebar-section__header mb-4">Sort posts</h1>
                    <div id='sort-select'>
                        <div id="sort-all" class="row my-2 selected-post navbar-row">
                            <h2 id='sort-all' class='ml-4 mt-1'>All posts</h2>
                        </div>
                        <div id="sort-recent" class="row my-2 navbar-row">
                            <h2 id="sort-recent" class='ml-4 mt-1'>Recently added first</h2>
                        </div>
                        <div id="sort-mvf" class="row my-2 navbar-row">
                            <h2 id="sort-mvf" class='ml-4 mt-1'>Most viewed first</h2>
                        </div>
                        <div id="sort-mlf" class="row my-2 navbar-row">
                            <h2 id="sort-mlf" class='ml-4 mt-1'>Most liked first</h2>
                        </div>
                    </div>
                </div>
                <h1 class="newsfeed-filter">Filter News Feed</h1>
                <div class="col-12 last-row sidebar-section-row">
                    <div id="filter-select">
                        <div id='all' class="row my-2 selected-post navbar-row">
                            <h2 id='all' class='ml-4 mt-1'>All News</h2>
                        </div>
                        <div id='tv' class="row my-2 navbar-row">
                            <h2 id='tv' class='ml-4 mt-1'>GVIPTV Only</h2>
                        </div>
                        <div id='experts' class="row my-2 navbar-row">
                            <h2 id='experts' class='ml-4 mt-1'>Experts Only</h2>
                        </div>
                        <div id="projects" class="row my-2 navbar-row">
                            <h2 id="projects" class='ml-4 mt-1'>Projects Only</h2>
                        </div>
                    </div>
                </div>
            </div>

            <div id="news-container" class='col-12 mx-auto col-xl-8 col-md-7 mb-4'>
                <div class="loading-circle"></div>
                <!-- NewsFeed Content -->
            </div>
</section>
<script>
    // HARDCODED DATA

    <?php
    echo 'const feed = [';

    foreach ($gviptvrows as $videos) {
        echo "{id: \"" . $videos['id'] . "\",";
        echo "time: `" . $videos['created_at'] . "`,";
        echo "description_head: \"" . $videos['title'] . "\",";
        echo "description_body: `" . $videos['description'] . "`,";
        echo "image_url: \"" . $videos['thumbnail'] . "\",";
        echo "relevant_link: \"" . "https://www.gvip.io/gviptv/view/" .$videos['id']. "\",";
        echo "like_count:" . '0' . ",";
        echo "is_liked_by_user:" . 'false' . ",";
        echo "timestamp: \"" .  "\",";
        echo "category: \"" . 'tv' . "\",";
        echo "comments: " . '[]' . "},";
    }

    foreach ($projects as $project) {
        $src = project_image($project['projectphoto'], 198, array('width' => 198));
        $last_date = $model_obj->last_update($project['pid']);
        echo "{id: \"" . $project['pid'] . "\",";
        echo "time: `" . $last_date . "`,";
        echo "description_head: \"" . $project['projectname'] . "\",";
        echo "description_body: `" . $project['description'] . "`,";
        echo "image_url: \"" . $src . "\",";
        echo "relevant_link: \"" . 'https://www.gvip.io/projects/' . $project['slug'] . "\",";
        echo "like_count:" . '0' . ",";
        echo "is_liked_by_user:" . 'false' . ",";
        echo "timestamp: \"" .  "\",";
        echo "category: \"" . 'projects' . "\",";
        echo "comments: " . '[]' . "},";
    }

    foreach ($users as $key => $val) {
        $src = expert_image($val["userphoto"], 198, array(
            'max' => 198,
            'allow_scale_larger' => TRUE,
            'bg_color' => '#ffffff',
            'crop' => TRUE
        ));
        $last_date = $model_obj->last_update_member($val['uid']);
        echo "{id: \"" . $val['uid'] . "\",";
        echo "time: `" . $last_date . "`,";
        echo "description_head: \"" .$val['firstname']." ".$val['lastname']."" . "\",";
        echo "description_body: `".$val['title'].", ".$val['organization'] . "" . "`,";
        echo "location: \"" . $val['country']  . "\",";
        echo "image_url: \"" . $src . "\",";
        echo "relevant_link: \"" . 'https://www.gvip.io/expertise/' . $val['uid'] . "\",";
        echo "like_count:" . '0' . ",";
        echo "is_liked_by_user:" . 'false' . ",";
        echo "timestamp: \"" .  "\",";
        echo "category: \"" . 'experts' . "\",";
        echo "comments: " . '[]' . "},";
    }

    foreach ($books as $book) {
        echo "{id: \"" . $book['id'] . "\",";
        echo "time: `" . $book['updated_at'] . "`,";
        echo "description_head: \"" . $book['title'] . "\",";
        echo "user_name: \"" . $book['user']['firstname']. ' ' . $book['user']['lastname'] . "\",";
        echo "description_body: `" . $book['content'] . "`,";
        echo "image_url: \"" . 'https://www.gvip.io/img/member_photos/' . $book['user']['userphoto'] . '?w=140&h=140' . "\",";
        echo "relevant_link: \"" . 'https://www.gvip.io/expertise/book_view/' . $book['id'] . "\",";
        echo "like_count:" . '0' . ",";
        echo "is_liked_by_user:" . 'false' . ",";
        echo "timestamp: \"" .  "\",";
        echo "category: \"" . 'books' . "\",";
        echo "comments: " . '[]' . "},";
    }
    echo ']';
    ?>


    const childrenOfSort = document.querySelector('#sort-select').children;
    const childrenOfFilter = document.querySelector('#filter-select').children;


    const concatText = (text, num = 200, readMore = false, url) => text.length > num ?
        `${text.substring(0,num)}... ${readMore? `<a href="${url}" target="_blank">Read More</a>`:''}` :
        `${text}`;


    function copyText(url, e) {
        var dummy = document.createElement("textarea");
        document.body.appendChild(dummy);
        dummy.value = url;
        e.innerHTML = ` <p>COPIED</p>`
        e.classList.add('copied-btn')
        dummy.select();
        document.execCommand("copy");
        document.body.removeChild(dummy);
        setTimeout(() => {
            e.innerHTML = ` <img src="https://d2huw5an5od7zn.cloudfront.net/project_svgs/send2.svg" alt="">
                                    <p>SHARE</p>`
            e.classList.remove('copied-btn');
        }, 1550)
    }

    // SORT AND FILTER SELECTION CHANGES
    const replaceSelected = (parent, currElement) => {
        for (el of parent) el.classList.remove('selected-post')

        currElement.tagName === 'DIV' ? currElement.classList.add('selected-post') : currElement.parentElement.classList
            .add('selected-post')
        return currElement.id
    }


    const getSelected = (children) => {
        for (el of children)
            if (el.classList.contains('selected-post') || el.classList.contains('selected-post'))
                return el.id;
    }

    for (el of childrenOfSort) {
        el.addEventListener('click', e => {
            replaceSelected(childrenOfSort, e.target)
            const newFeed = feed.sort((a, b) => new Date(b.time) - new Date(a.time));
            populate({
                data: newFeed,
                filter: getSelected(childrenOfFilter),
                sort: getSelected(childrenOfSort),
                isFirst: true
            })
        })
    }

    for (el of childrenOfFilter) {
        el.addEventListener('click', e => {
            replaceSelected(childrenOfFilter, e.target)
            const newFeed = feed.sort((a, b) => new Date(b.time) - new Date(a.time));
            populate({
                data: newFeed,
                filter: getSelected(childrenOfFilter),
                sort: getSelected(childrenOfSort),
                isFirst: true
            })

        })
    }


    // MAIN FUNCTION THAT LOOPS THE DATA

    const populate = (obj) => {
        const {

            isFirst,
            filter,
            sort
        } = obj;
        let {
            data
        } = obj
        const newsContainer = document.querySelector('#news-container');

        if (isFirst === true) {
            newsContainer.innerHTML = ``;
        } else
            newsContainer.removeChild(newsContainer.lastChild)


        if (filter !== 'all')
            data = data.filter(el => el.category === filter)

        const newData = data.splice(0, 20);

        if (newData.length === 0)
            newsContainer.innerHTML = ` <div class="no-more mt-4">
                    <h1 class="text-center mt-4 display-2">There are no posts currently</h1>
                </div>`
        else
            newData.forEach(el => {

                newsContainer.innerHTML += renderSingleCard(el);

            })

        if (data.length > 0) {

            newsContainer.innerHTML +=
                `<div class='row mx-0'><div id='add-more' class='add-more-btn col-md-5 mx-auto'>Load More</div><a class='add-more-btn col-md-5 mx-auto' href='#page-start'>Back to Top</a>  </div>`


            document.querySelector('#add-more').addEventListener('click', () => {
                populate({
                    data,
                    filter,
                    sort,
                    isFirst: false
                })
            })

        }

    }

    function renderSingleCard(element) {
        const {
            image_url,
            category,
            relevant_link,
            description_head,
            time,
            description_body,
            user_name
        } = element;
        if (category === 'projects')
            return ` <div class="news-container project-container">
                    <div class="article-img__wrapper">
                        <img
                            src="${image_url}">
                    </div>
                    <div class="article-info__wrapper">
                        <h1 class="feed-title">${description_head}</h1>
                        <p class="feed-time">${time}</p>
                        <p class="feed-desc">${concatText(description_body,200)}
                        </p>
                        <a href="${relevant_link}" target="blank" class="read-more">More On This Project</a>
                    </div>
                    <div class="article-btns__wrapper">
                    <a href="${relevant_link}" target="blank" class="btn-element">
                            <img src="https://d2huw5an5od7zn.cloudfront.net/project_svgs/visibility-gray.svg" alt="">
                            <p>VIEW</p>
                        </a>
                        <button onclick="copyText('${relevant_link}',this);" class="btn-element">
                            <img src="https://d2huw5an5od7zn.cloudfront.net/project_svgs/send2.svg" alt="">
                            <p>SHARE</p>
                        </button>
                    </div>
                </div>`;
        if (category === 'tv')
            return ` <div class="news-container gviptv-container">
                    <div class="article-img__wrapper">
                        <img src="${image_url}">
                        <a href="https://www.gvip.io/gviptv" class="read-more">Click here to Watch More GViPTV</a>
                    </div>
                    <div class="article-info__wrapper">
                        <h1 class="feed-title">${description_head}</h1>
                        <p class="feed-time">${time}</p>
                        <div class="feed-desc">
                        ${concatText(description_body,200)}
                        </div>
                    </div>
                    <div class="article-btns__wrapper">
                    <a href="${relevant_link}" target="blank" class="btn-element">
                            <img src="https://d2huw5an5od7zn.cloudfront.net/project_svgs/tv-screen-gray.svg" alt="">
                            <p>WATCH</p>
                        </a>
                        <button onclick="copyText('${relevant_link}',this);" class="btn-element">
                            <img src="https://d2huw5an5od7zn.cloudfront.net/project_svgs/send2.svg" alt="">
                            <p>SHARE</p>
                        </button>
                    </div>
                </div>`
        if (category === 'experts')
            return `<div class="news-container expert-container">
                    <div class="article-img__wrapper">
                        <img
                            src="${image_url}">
                    </div>
                    <div class="article-info__wrapper">
                        <h1 class="feed-title">${description_head}</h1>
                        <p class="feed-time">Joined GViP on ${time}</p>
                        <p class="feed-pos">${concatText(description_body,100)}</p>
                        <p class="feed-loc">Location: ${element.location}</p>
                        <a href="${relevant_link}" target="blank" class="read-more">More About This Expert</a>
                    </div>
                    <div class="article-btns__wrapper">
                    <a href="${relevant_link}" target="blank" class="btn-element">
                            <img src="https://d2huw5an5od7zn.cloudfront.net/project_svgs/user-gray.svg" alt="">
                            <p>PROFILE</p>
                        </a>
                        <button  onclick="copyText('${relevant_link}',this);" class="btn-element">
                            <img src="https://d2huw5an5od7zn.cloudfront.net/project_svgs/send2.svg" alt="">
                            <p>SHARE</p>
                        </button>
                    </div>
                </div>`
        if (category === 'books')
            return `<div class="news-container expert-container">
                    <div class="article-img__wrapper">
                        <img
                            src="${image_url}">
                    </div>
                    <div class="article-info__wrapper">
                        <h1 class="feed-title">${description_head}</h1>
                        <h3 class="feed-title">${user_name}</h3>
                        <p class="feed-time">${time}</p>
                        <p class="feed-pos">${concatText(description_body, 100)}</p>
                        <a href="${relevant_link}" target="blank" class="read-more">More About This Expert</a>
                    </div>
                    <div class="article-btns__wrapper">
                    <a href="${relevant_link}" target="blank" class="btn-element">
                            <img src="https://d2huw5an5od7zn.cloudfront.net/project_svgs/user-gray.svg" alt="">
                            <p>PROFILE</p>
                        </a>
                        <button  onclick="copyText('${relevant_link}',this);" class="btn-element">
                            <img src="https://d2huw5an5od7zn.cloudfront.net/project_svgs/send2.svg" alt="">
                            <p>SHARE</p>
                        </button>
                    </div>
                </div>



`;
        else return ``;
    }

    function dateFailsafe(date) {
        if (date == 0 || date == undefined || date == null)
            return '<p></p>';
        else return date;

    }

    function populateRecommended(projects, experts) {
        const projectsDiv = document.querySelector('#recommended-projects');
        const expertsDiv = document.querySelector('#recommended-experts');
        if (projects.length === 0)
            document.querySelector('#recommended-projects-header').innerHTML = '';

        if (experts.length === 0)
            document.querySelector('#recommended-experts-header').innerHTML = '';

        projects.forEach(el => {
            const {
                image_url,
                header,
                time,
                text,
                url
            } = el;
            projectsDiv.innerHTML += `<div class="recommended-row">
                            <div class="image-wrapper">
                                <img
                                    src="${image_url}">
                            </div>
                            <div class="recproj-header">
                                <h2>${header}</h2>
                                <p>${dateFailsafe(time)}</p>
                            </div>
                            <div class="recproj-body">
                                <p>${concatText(text,300,true,url)}</p>
                            </div>
                            <div class="rec-btns">
                                <a href="${url}" target="_blank" class="btn-element">
                                    <img src="https://d2huw5an5od7zn.cloudfront.net/project_svgs/visibility-gray.svg"
                                        alt="">
                                    <p>VIEW</p>
                                </a>
                                <button  onclick="copyText('${url}',this);" class="btn-element">
                                    <img src="https://d2huw5an5od7zn.cloudfront.net/project_svgs/send2.svg" alt="">
                                    <p>SHARE</p>
                                </button>
                            </div>
                        </div>`;
        })
        experts.forEach(el => {
            const {
                image_url,
                name,
                time,
                title,
                location,
                url
            } = el;
            expertsDiv.innerHTML += ` <div class="recommended-row">
                            <div class="recexp-info__wrapper">
                                <img
                                    src="${image_url}">
                                <div class="recexp-info">
                                    <h1 class="title">${name}</h1>
                                    <p class="date">${dateFailsafe(time)}</p>
                                    <h1 class="position">${title}</h1>
                                    <p class="location"><b class="bold">Location: </b>${location}
                                    </p>
                                </div>
                            </div>
                            <div class="recexp-body">
                                <div class="recexp-body__text">

                                </div>
                            </div>
                            <div class="rec-btns">
                                <a target="_blank" href="${url}" class="btn-element">
                                    <img src="https://d2huw5an5od7zn.cloudfront.net/project_svgs/user-gray.svg" alt="">
                                    <p>PROFILE</p>
                                </a>
                                <button  onclick="copyText('${url}',this);" class="btn-element">
                                    <img src="https://d2huw5an5od7zn.cloudfront.net/project_svgs/send2.svg" alt="">
                                    <p>SHARE</p>
                                </button>
                            </div>`;
        })


    }
    // START THE LOOP ON PAGE LOAD
    window.addEventListener('load', () => {
        const newFeed = feed.sort((a, b) => new Date(b.time) - new Date(a.time));
        populate({
            data: newFeed,
            filter: getSelected(childrenOfFilter),
            sort: getSelected(childrenOfSort),
            isFirst: true
        })
        populateRecommended(projectsData, expertsData);

    })

    $('#modal1').on('hidden.bs.modal', function (e) {
        // do something...
        $('#modal1 iframe').attr("src", $("#modal1 iframe").attr("src"));
    });
</script>
