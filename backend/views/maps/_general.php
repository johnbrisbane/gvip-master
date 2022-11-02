<div style="width:50%" id="general_tab_form" class="clearfix">
    <?php
    echo form_open_multipart(current_url(), array(
        'id' => 'map_general_form',
        'class' => 'forum_general_form ajax_add_form'
    ));
    echo form_hidden('update', 'general');
    ?>

    <div class="contenttitle2">
        <h3>Map Details</h3>
    </div>
    <br/>
    <div id="div_general_photo_form">
        <div class="field">
            <?php echo form_label('Title:', 'title_label', array('class' => 'left_label')); ?>
            <div class="fld">
                <?php echo form_input(array(
                    'id'	=> 'title',
                    'value' => set_value('title', $details['title']),
                    'name'	=> 'title'
                )); ?>
                <div class="errormsg" id="err_title"><?php echo form_error('title'); ?></div>
            </div>
        </div>

        <div class="field" style="clear: both">
            <?php echo form_label('Category:', 'category_id_label', array('class' => 'left_label')); ?>
            <div class="fld">
                <?php echo form_dropdown('category_id', $categories, set_value('category_id', $details['category_id'])); ?>
                <div class="errormsg" id="err_category_id"><?php echo form_error('category_id'); ?></div>
            </div>
        </div>
        <br>
        <div class="field" style="clear: both">
            <?php echo form_label('Style:', 'style_id_label', array('class' => 'left_label')); ?>
            <div class="fld">
                <?php echo form_dropdown('style_url', $styles, set_value('style_url', $details['style_url'])); ?>
                <div class="errormsg" id="err_category_id"><?php echo form_error('category_id'); ?></div>
            </div>
        </div>
        <br>
        <div class="field">
            <div class="fld">
                <?php echo form_checkbox(array(
                    'id'	=> 'status',
                    'checked' => set_value('status', $details['status']),
                    'name'	=> 'status'
                )); ?>
                <?php echo form_label('Map enabled', 'status_label', array('class' => 'left_label')); ?>
                <div class="errormsg" id="err_status"><?php echo form_error('status'); ?></div>
            </div>
        </div>
        <div class="field">
            <div class="fld">
                <?php echo form_checkbox(array(
                    'id'	=> 'show_geojson',
                    'checked' => set_value('show_geojson', $details['show_geojson']),
                    'name'	=> 'show_geojson'
                )); ?>
                <?php echo form_label('Show GeoJson map', 'show_geojson_label', array('class' => 'left_label')); ?>
                <div class="errormsg" id="err_is_featured"><?php echo form_error('is_featured'); ?></div>
            </div>
        </div>
    </div>

    <div id="div_general_photo_form">

    <div style="clear:both;"></div>
    </div>

    <div class="contenttitle2">
        <h3>Map Description</h3>
    </div>
    <br/>
    <div>
        <?php echo form_textarea(array(
            'type' => 'text',
            'class' => 'tinymce',
            'id' => 'content',
            'name' => 'content',
            'value' => set_value('content', $details['content'], false),
            'data-width' => '675',
            'data-height' => '400'
        )); ?>
    </div>
    <br/>
    <div>
        <?php echo form_submit('submit', 'Update General Info', 'class="light_green no_margin_left"'); ?>
    </div>
    <?php echo form_close(); ?>
</div>
