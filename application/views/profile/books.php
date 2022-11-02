<div id="content" class="clearfix">
    <div id="col4">
        <ul id="profile_nav">
            <li><a href='/profile/account_settings'><?php echo lang('ProfileInformation');?></a></li>
            <!-- ExpertAdverts Start-->
            <?php if($usertype == '8')
            {?>
            <li><a href="/profile/edit_seats"><?php echo lang('EditSeats');?></a></li>
            <li><a href="/profile/edit_case_studies"><?php echo lang('EditCaseStudies');?></a></li>
            <li><a href="javascript:void(0);"><?php echo lang('StorePurchaseHistory');?></a></li>
            <li><a href="javascript:void(0);"><?php echo lang('LicenseInformation');?></a></li>
            <?php
            }
            else
            {
                ?>
            <li><a href="/profile/my_projects"><?php echo lang('MyProjects');?></a></li>
            <?php
            }
            ?>
            <!-- ExpertAdverts End-->
            <li><a href="/profile/account_settings_email"><?php echo lang('EmailPassword');?></a></li>
            <li class="here"><a href="/profile/books">Books</a></li>
        </ul>
    </div><!-- end #col4 -->

    <div id="col5">
        <h1 class="col_top gradient"><?php echo lang('ProfileInformation');?></h1>
        <div class="profile_links">
            <div id="form_submit">
                <a href="/expertise/<?php echo $users['uid'];?>"
                    class="light_gray"><?php echo lang('ViewMyProfile'); ?></a>
            </div>
        </div>

        <div id="profile_tabs">
            <ul>
                <li><a href="#project-involvement">Books</a></li>
            </ul>
            <div id="project-involvement" class="col5_tab project_form">

                <div class="clearfix">
                    <!-- EDIT HERE -->
                    <!-- the inline padding below won't be needed if this sits in tabs -->
                    <h2>Bookshelf</h2>
                    <div class="clearfix matrix_dropdown project_executives">

                        <?php
                        if(count($books)> 0)
                        {
                            $cntLink = 1;
                            foreach($books as $book)
                            {?>

                        <ul id="load_executive_form">
                            <li class="" id="row_id_<?php echo $cntLink; ?>">

                                <div class="view clearfix">
                                    <span class="left"><strong><?php echo $book['title'];?></strong>
                                        <p><?php echo $book['content'];?></p>
                                    </span>


                                    <a class="right delete"
                                        href="#profile/delete_book/<?php echo $book['id']?>"><?php lang('Delete');?></a>
                                    <a class="right edit" id="edit_executive_<?php echo $cntLink; ?>"
                                        href="javascript:void(0);"
                                        onclick="rowtoggle(this.id);"><?php echo lang('Edit');?></a>

                                </div>
                                <div class="edit">
                                    <?php echo form_open('profile/update_book/'.$book['id'],array('id'=>'book_form','name'=>'book_form','method'=>'post','class'=>'ajax_form'));?>
                                    <?php

                                            $opt['book_form'] = array(
                                                'lbl_booktitle' => array(
                                                    'class' => 'left_label'
                                                ),
                                                'book_title'	=> array(
                                                    'name' 		=> 'book_title',
                                                    'id' 		=> 'book_title',
                                                    'value'		=> $book['title'],
                                                ),
                                                'lbl_bookcontent' => array(
                                                    'class' => 'left_label'
                                                ),
                                                'book_content'	=> array(
                                                    'name' 		=> 'book_content',
                                                    'id' 		=> 'book_content',
                                                    'value'		=> $book['content'],
                                                )
                                            );

                                            ?>
                                    <?php echo form_hidden("hdn_book_id",$book["id"]); ?>

                                    <?php echo form_label('Book Title'.':', '', $opt['book_form']['lbl_booktitle']);?>
                                    <div class="fld">
                                        <?php echo form_input($opt['book_form']['book_title']);?>
                                        <div id="err_project_name" class="errormsg"></div>
                                    </div>
                                    <br>

                                    <div class="fld">
                                        <h5 class="left_label">Book Content</h5>
                                        <br />
                                        <div text>
                                            <?php echo form_textarea(array(
                                                    'type' => 'text',
                                                    'class' => 'tinymce',
                                                    'id' => 'book_content',
                                                    'name' => 'book_content',
                                                    'value' => $opt['book_form']['book_content']['value'],
                                                    'data-width' => '675',
                                                    'data-height' => '400'
                                                )); ?>
                                        </div>
                                    </div>
                                    <br>

                                    <?php echo form_submit('link_submit', lang('Update'),'class = "light_green btn_lml"');?>
                                    <input type="reset" name="" value="<?php echo lang('Close');?>"
                                        class="light_red btn_sml" />

                                    <?php echo form_close(); ?>

                                </div>

                            </li>
                        </ul>

                        <?php
                            }
                        }
                        ?>

                        <ul>
                            <li>
                                <div class="view">
                                    <a id="addnewBook" class="edit project_row_add" href="javascript:void(0);"
                                        onclick="rowtoggle(this.id);">+ Add New Book</a>
                                </div>

                                <div class="edit add_new">
                                    <?php echo form_open('profile/create_book/',array('id'=>'create_book_form','name'=>'create_book_form','method'=>'post','class'=>'ajax_form'));?>
                                    <?php
                                    $opt['create_book_form'] = array(
                                        'lbl_booktitle' => array(
                                            'class' => 'left_label'
                                        ),
                                        'book_title'	=> array(
                                            'name' 		=> 'book_title',
                                            'id' 		=> 'book_title',
                                        ),
                                        'lbl_bookcontent' => array(
                                            'class' => 'left_label'
                                        ),
                                        'book_content'	=> array(
                                            'name' 		=> 'book_content',
                                            'id' 		=> 'book_content',
                                        )
                                    );

                                    ?>

                                    <?php echo form_label('Name of Book'.':', '', $opt['create_book_form']['lbl_booktitle']);?>
                                    <div class="fld">
                                        <?php echo form_input($opt['create_book_form']['book_title']);?>
                                        <div id="err_project_name" class="errormsg"></div>
                                    </div>
                                    <br>

                                    <div class="contenttitle2">
                                        <h3>Book Content</h3>
                                    </div>
                                    <br />
                                    <div>
                                        <?php echo form_textarea(array(
                                            'type' => 'text',
                                            'class' => 'tinymce',
                                            'id' => 'book_content',
                                            'name' => 'book_content',
                                            'value' => '',
                                            'data-width' => '675',
                                            'data-height' => '400'
                                        )); ?>
                                    </div>
                                    <br>

                                    <?php echo form_submit('link_submit', 'Add This Book','class = "light_green"');?>
                                    <input type="reset" name="" value="<?php echo lang('Close');?>"
                                        class="light_red btn_sml" />

                                    <?php echo form_close(); ?>

                                </div>

                            </li>
                        </ul>

                    </div>


                </div>
                <!-- END EDIT -->


            </div>

        </div>

    </div><!-- end #tabs -->



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
                <button aria-disabled="false"
                    class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button"
                    type="button">
                    <span class="ui-button-text"><?php echo lang('Ok');?></span></button>
            </div>
        </div>
    </div>

</div><!-- end #col5 -->
</div><!-- end #content -->