<style type="text/css">
    html,
    body {
        overflow: hidden;
    }
</style>

<div id="content" class="clearfix" style="width: 100%">
    <div style="text-align: center;">
        <h1 class="large page-title"><?php echo $details['title'] ?></h1>
    </div>

    <div style="padding-top: 10px">
        <div style="width:50%; display: inline-block">
            <?php $this->load->view('stimulus/expert_map', $members);?>
        </div><!-- end #col1 -->

        <div style="width: 50%; float: right; height: 650px; overflow: scroll">
            <?php $this->load->view('stimulus/experts_preview', $members);?>
        </div><!-- end #col2 -->
    </div>


</div><!-- end #content -->