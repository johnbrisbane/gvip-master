<style>
    .messageboard-post-container .media {
        margin: 10px 10px 10px 10px;
        padding: 20px 10px 20px 10px;
        border-bottom: 1px solid #f1f1f1;
    }
    .messageboard-avatar .img-circle {
        height: 48px;
        width: 48px;
    }
    .media-body > .media {
        background: #f9f9f9;
        border-radius: 3px;
        border: 1px solid #f1f1f1;
    }
    .messageboard-post-container .media-body .photos {
        margin: 10px 0;
    }
    .media-body > .media .messageboard-avatar {
        width: 70px;
        margin-right: 10px;
    }
    .media-body > .media .messageboard-avatar .img-circle {
        height: 38px;
        width: 38px;
    }
    .mid-icon {
        font-size: 66px;
    }
    .messageboard-item {
        margin: 10px 0;
        padding: 10px 0 20px;
        border-bottom: 1px solid #f1f1f1;
    }
    .views-number {
        font-size: 24px;
        line-height: 18px;
        font-weight: 400;
    }
    .messageboard-container,
    .messageboard-post-container {
        padding: 30px !important;
    }
    .messageboard-item small {
        color: #999;
    }
    .messageboard-item .forum-sub-title {
        color: #999;
        margin-left: 50px;
    }
    .messageboard-title {
        margin: 15px 0 15px 0;
    }
    .messageboard-info {
        text-align: center;
    }
    .messageboard-desc {
        color: #999;
    }
    .messageboard-icon {
        float: left;
        width: 30px;
        margin-right: 20px;
        text-align: center;
    }
    a.messageboard-item-title {
        color: inherit;
        display: block;
        font-size: 18px;
        font-weight: 600;
    }
    a.messageboard-item-title:hover {
        color: inherit;
    }
    .messageboard-icon .fa {
        font-size: 30px;
        margin-top: 8px;
        color: #9b9b9b;
    }
    .messageboard-item.active .fa {
        color: #1ab394;
    }
    .messageboard-item.active a.messageboard-item-title {
        color: #1ab394;
    }
    @media (max-width: 992px) {
        .messageboard-info {
            /* Comment this is you want to show messageboard info in small devices */
            display: none;
        }
        .messageboard-desc {
            float: none !important;
        }
    }

    .ibox.collapsed .ibox-content {
        display: none;
    }
    .ibox.collapsed .fa.fa-chevron-up:before {
        content: "\f078";
    }
    .ibox.collapsed .fa.fa-chevron-down:before {
        content: "\f077";
    }
    .ibox:after,
    .ibox:before {
        display: table;
    }
    .ibox-content {
        background-color: #ffffff;
        color: inherit;
        padding: 15px 20px 20px 20px;
        border-color: #e7eaec;
        border-image: none;
        border-style: solid solid none;
        border-width: 1px 0;
    }
    .text-navy {
        color: #1ab394;
    }
    .mid-icon {
        font-size: 66px !important;
    }
    .m-b-sm {
        margin-bottom: 10px;
    }
</style>

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<br>
<div id="content" class="clearfix">
    <div id="col12" class="center_col">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="wrapper wrapper-content animated fadeInRight">

                        <div class="ibox-content m-b-sm border-bottom">
                            <div class="p-xs">
                                <div class="pull-left m-r-md">
                                    <i class="fa fa-globe text-navy mid-icon"></i>
                                </div>
                                <h2>Welcome to our Message Board</h2>
                                <span>Feel free to choose topic you're interested in.</span>
                            </div>
                        </div>
                        <br>
                        <?php if (in_array(Auth::id(), INTERNAL_USERS)) { ?>
                        <div style="text-align: left; padding-left: 3%; padding-bottom: 2%">
                            <button class="btn" onclick="window.location.href='messageboard/create_category'">Create a Category</button>
                        </div>
                        <?php } ?>

                        <div class="ibox-content messageboard-container">
                            <div class="messageboard-title">
                                <div class="pull-right messageboard-desc">
                                    <samll>Total posts: <?php echo $totalposts ?></samll>
                                </div>
                                <h3>General subjects</h3>
                            </div>

                            <?php foreach ($categories as $category) {
                                if (in_array(Auth::id(), INTERNAL_USERS)) {
                                ?>
                                    <div style="text-align: right">
                                        <a class="delete" href="<?php echo base_url()?>messageboard/delete_category/<?php echo $category['id']; ?>" >Delete</a>
                                    </div>
                                <?php } ?>
                            <div class="messageboard-item">
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="messageboard-icon">
                                            <i class="fa fa-shield"></i>
                                        </div>
                                        <a href="<?php echo base_url().'messageboard/'.$category['slug'] ?>" class="messageboard-item-title"><?php echo $category['cat_name'] ?></a>
                                        <div class="messageboard-sub-title"><?php echo $category['cat_description'] ?></div>
                                    </div>
                                    <br>
                                    <div class="col-md-1 messageboard-info">
                                    <span class="views-number">
                                        <?php echo $category['topics'] ?>
                                    </span>
                                        <div>
                                            <small>Topics</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>