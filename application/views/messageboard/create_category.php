<div id="content" class="clearfix">
    <div id="col5" class="center_col">
        <h1 class="col_top gradient"><?php echo 'Create Category' ?></h1>
        <br>
        <?php echo form_open('messageboard/create_category', array('id' => 'new_category')) ?>
        <div>
            <?php echo form_label('Title of Category:', 'cat_title', array('class' => 'left_label')) ?>
            <div class="fld">
                <?php echo form_input('title', set_value('title'), 'placeholder="' . 'Example: Projects' . '"'); ?>
                <div class="errormsg"><?php echo form_error('title'); ?></div>
            </div>
        </div>
        <div>
            <?php echo form_label('Description of Category:', 'cat_desc', array('class' => 'left_label')) ?>
            <div class="fld">
                <?php echo form_textarea('desc', set_value('desc'), 'placeholder="' . 'Example: Discussions about Infrastructure Projects' . '"'); ?>
                <div class="errormsg"><?php echo form_error('title'); ?></div>
            </div>
        </div>
        <br/>
        <div>
            <?php echo form_submit('create_category', 'Create Category', 'class="light_green left mt"') ?>
            <?php echo form_button('cancel', lang('Cancel'), 'class="light_gray left mt lmol" onclick="window.location.href=\'/messageboard\'"') ?>
        </div>
        <?php echo form_close() ?>
        <br>
    </div>
</div>