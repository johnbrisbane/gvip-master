<div id="content" class="clearfix">
    <div id="col5" class="center_col">
        <h1 class="col_top gradient"><?php echo 'Create Topic'  ?></h1>
        <br>
        <?php echo form_open('messageboard/' . $category . '/create_topic', array('id' => 'create_topic')) ?>
        <div>
            <?php echo form_label('Title of Topic:', 'top_title', array('class' => 'left_label')) ?>
            <div class="fld">
                <?php echo form_input('title', set_value('title'), 'placeholder="' . 'Example: Rail Baltica Timeline' . '"'); ?>
                <div class="errormsg"><?php echo form_error('title'); ?></div>
            </div>
        </div>
        <div>
            <?php echo form_label('Message:', 'top_message', array('class' => 'left_label')) ?>
            <div class="fld">
                <?php echo form_textarea('message', set_value('message'), 'placeholder="' . 'Example: When is this project expected to be complete?' . '"'); ?>
                <div class="errormsg"><?php echo form_error('title'); ?></div>
            </div>
        </div>
        <br/>
        <div>
            <?php echo form_submit('create_topic', 'Create Topic', 'class="light_green left mt"') ?>
            <?php echo form_button('cancel', lang('Cancel'), 'class="light_gray left mt lmol" onclick="window.location.href=\'/messageboard\'"') ?>
        </div>
        <?php echo form_close() ?>
        <br>
    </div>
</div>