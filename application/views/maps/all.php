<div id="content" class="clearfix">
    <!--  Paginated list view for maps  -->
    <div id="col5" class="center_col white_box" style="width: 81em">

        <h1 class="col_top gradient"><?php echo 'Maps';?></h1>

        <div class="project_filter clearfix">

            <?php echo form_open('maps', array('id' => 'maps_search_form', 'name' => 'maps_search_form', 'method' => 'get'));?>

            <div style="float:right;">
                <div class="filter_option">
                    <p><?php echo lang('Filterby')?>:</p>
                </div><!-- end .filter_option -->

                <div class="filter_option">
                    <?php
                    $options = array_merge(array('' => '- '. lang('ForumSelectRegion') . ' -'), $categories);
                    $selected = isset($filter_by['category']) ? $filter_by['category'] : '';
                    echo form_dropdown('category', $options, $selected, 'id="category"');
                    ?>
                </div><!-- end .filter_option -->

                <div style="float:right; padding-right:10px;">
                    <div class="filter_option">
                        <p><?php echo lang('Search')?> :</p>
                    </div>
                    <div class="filter_option">
                        <?php
                        echo form_input(array(
                            'name'  => 'search_text',
                            'id'    => 'search_text',
                            'value' => isset($filter_by['searchtext']) ? $filter_by['searchtext'] : ''
                        ));
                        ?>
                    </div>
                    <div class="filter_option">
                        <?php echo form_submit('search', lang('Search'), 'class = "light_green"');?>
                    </div>
                </div>
                <?php echo form_close();?>

            </div>
        </div>

        <div class="inner clearfix">
            <?php
            echo form_paging(true, $page_from, $page_to, $total_rows, 'Maps', $paging);

            $index = 0;
            if ($total_rows > 0) {
                foreach($rows as $map) {
                    $data = array(
                        'url' => base_url() . 'maps/custom/' . $map['id'],
                        'image' => array(
                            'url' => forum_image($map['photo'], 198),
                            'alt' => $map['title'] . ' image'
                        ),
                        'title' => '<strong>' . $map['title'] . '</strong>',
                        'properties' => array(
                            array(lang('ForumRegion'), $map['category'], 1)
                        ),
                        'last' => ($index == 3)
                    );

                    $this->load->view('templates/_list_block', $data);
                    $index = ($index == 3) ? 0 : $index + 1;
                }
            } else {
                echo form_list_empty('No Maps Found');
            }
            ?>

            <div id="display-content"></div>

            <?php
            echo form_paging(false, $page_from, $page_to, $total_rows, 'Maps', $paging);
            ?>
        </div><!-- end .inner -->
    </div><!-- end #col5 -->
</div><!-- end #content -->

<div id="dialog-message"></div>
