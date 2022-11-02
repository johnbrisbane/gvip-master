<div id="content" class="clearfix">
    <div id="col5" class="center_col">
        <h1 class="col_top gradient"><?php echo 'Create Reply'  ?></h1>
        <br>
        <?php echo form_open('messageboard/' . $category['slug'] . '/' . $topic['id'] .'/create_post', array('id' => 'create_post')) ?>
        <div>
            <?php echo form_label('Reply:', 'post_content', array('class' => 'left_label')) ?>
            <div class="fld">
                <?php echo form_textarea('post_content', set_value('post_content'), 'placeholder="' . 'Example: When is this project expected to be complete?' . '"'); ?>
                <div class="errormsg"><?php echo form_error('title'); ?></div>
            </div>
        </div>
        <br/>
        <div>
            <?php echo form_submit('create_post', 'Create Reply', 'class="light_green left mt"') ?>
            <?php echo form_button('cancel', 'Back', 'class="light_gray left mt lmol" onclick="window.location.href=\'/messageboard\'"') ?>
        </div>
        <?php echo form_close() ?>
        <br>
    </div>
</div>