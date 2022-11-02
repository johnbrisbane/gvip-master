<style type="text/css">
    html,
    body {
        overflow: hidden;
    }
</style>

<?php if (in_array(Auth::id(), INTERNAL_USERS)) { ?>
<a href="https://gvip.io/maps/exports_data/<?php echo $details['id']?>">Download Map Data</a>
<?php } ?>
<br>
<?php if (in_array(Auth::id(), INTERNAL_USERS)) { ?>
    <a href="https://gvip.io/maps/export_geojson/<?php echo $details['id']?>">Download Geojson Data</a>
<?php } ?>

<div id="content" class="clearfix" style="width: 100%">
    <div style="text-align: center;">
        <h1 class="large page-title"><?php echo $details['title'];?></h1>
    </div>

    <div style="padding-top: 10px">
        <div style="width:50%; display: inline-block">
            <?php
            $data = array($projects, $members, $details);

            if ($details['category_id'] == 1){
                $this->load->view('maps/map_layout', $data);
            }
            elseif ($details['id'] == 2) {
                $this->load->view('maps/map_layout_hydrogen', $data);
            }
            else {
                $this->load->view('maps/map_layout_default', $data);
            }
            ?>
        </div><!-- end #col1 -->

        <div style="width: 50%; float: right; height: 650px; overflow: scroll">
            <div style="float:left;">
                <?php echo form_open('/maps/custom/'.$details['id'], array(
                    'id' => 'projects_search_form',
                    'name' => 'search_form',
                    'method' => 'GET')); ?>
                <div class="filter_option">
                    <p><?php echo lang('Filterby').':';?></p>
                </div>

                <div class="filter_option">
                    <?php echo form_dropdown('stage', stages_dropdown('select'), $filter['stage']); //"id='project_stage'" ?>
                    <?php echo form_dropdown('sector', sector_dropdown_stim(), $filter['sector']) //id="member_sectors" ?>
                    <?php echo form_dropdown('subsector', subsector_dropdown($filter['sector']), $filter['subsector'], 'style="width:170px;"') ?>
                    <?php if($details['category_id'] == 1){ echo form_dropdown('state', state_dropdown('select'), $filter['state']); } ?>
                </div>

                <br>

                <div style="float: left; padding-right: 10px;">
                    <div class="filter_option">
                        <?php echo form_dropdown('sort_options', $sort_options, $sort) ?>
                    </div>
                </div>

                <div class="filter_option">
                    <p><?php echo lang('Search');?> :</p>
                </div>
                <div class="filter_option">
                    <?php echo form_input('searchtext', $filter['searchtext'], 'placeholder="'. lang('ProjectTextSearchTip').'"') //"id"=>"search_text" ?>
                </div>
                <div class="filter_option">
                    <?php echo form_submit('search', lang('Search'), 'class = "light_green"') ?>
                </div>
                <a href="/maps/custom/<?php echo $details['id'];?>" style="float: right; padding-left: 10px"><?php echo 'Reset Filters';?></a>

                <input type="hidden" name="sort" value="<?php echo $sort ?>">
                <?php echo form_close(); ?>
            </div>

            <?php $this->load->view('maps/_projects_preview', array_merge($data, array('id' => $details['id'])));?>
        </div><!-- end #col2 -->
    </div>


</div><!-- end #content -->

<div id="dialog-message"></div>

<script>
    var subsectors = <?php echo json_encode($all_subsectors) ?>;
</script>
