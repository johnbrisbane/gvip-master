<style>
    .forum-post-container .media {
        margin: 10px 10px 10px 10px;
        padding: 20px 10px 20px 10px;
        border-bottom: 1px solid #f1f1f1;
    }
    .forum-avatar .img-circle {
        height: 48px;
        width: 48px;
    }
    .media-body > .media {
        background: #f9f9f9;
        border-radius: 3px;
        border: 1px solid #f1f1f1;
    }
    .forum-post-container .media-body .photos {
        margin: 10px 0;
    }
    .media-body > .media .forum-avatar {
        width: 70px;
        margin-right: 10px;
    }
    .media-body > .media .forum-avatar .img-circle {
        height: 38px;
        width: 38px;
    }
    .mid-icon {
        font-size: 66px;
    }
    .forum-item {
        margin: 10px 0;
        padding: 10px 0 20px;
        border-bottom: 1px solid #f1f1f1;
    }
    .views-number {
        font-size: 24px;
        line-height: 18px;
        font-weight: 400;
    }
    .forum-container,
    .forum-post-container {
        padding: 30px !important;
    }
    .forum-item small {
        color: #999;
    }
    .forum-item .forum-sub-title {
        color: #999;
        margin-left: 50px;
    }
    .forum-title {
        margin: 15px 0 15px 0;
    }
    .forum-info {
        text-align: center;
    }
    .forum-desc {
        color: #999;
    }
    .forum-icon {
        float: left;
        width: 20%;
        margin-right: 20px;
        text-align: center;
    }
    a.forum-item-title {
        color: inherit;
        display: block;
        font-size: 18px;
        font-weight: 600;
    }
    a.forum-item-title:hover {
        color: inherit;
    }
    .forum-icon .fa {
        font-size: 30px;
        margin-top: 8px;
        color: #9b9b9b;
    }
    .forum-item.active .fa {
        color: #1ab394;
    }
    .forum-item.active a.forum-item-title {
        color: #1ab394;
    }
    @media (max-width: 992px) {
        .forum-info {
            /* Comment this is you want to show forum info in small devices */
            display: none;
        }
        .forum-desc {
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
    <div id="col10" class="center_col">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="wrapper wrapper-content animated fadeInRight">

                        <div class="ibox-content m-b-sm border-bottom">
                            <div class="p-xs">
                                <div class="pull-left m-r-md">
                                    <i class="fa fa-globe text-navy mid-icon"></i>
                                </div>
                                <h2>Welcome to <?php echo $category['cat_name']; ?></h2>
                                <span>Below are the current threads. Join a discussion or create a new one!</span>
                            </div>
                        </div>
                        <br>
                        <?php if (Auth::id() > 0){ ?>
                        <div style="text-align: left; padding-left: 3%; padding-bottom: 2%">
                            <button class="btn" onclick="window.location.href= <?php echo "'" . $category['slug'] . "/create_topic'" ; ?>">Create a Topic</button>
                        </div>
                        <?php } else { ?>
                        <div style="text-align: left; padding-left: 3%; padding-bottom: 2%">
                            <p>Create an Account to join the conversation!</p>
                        </div>
                        <?php }?>

                        <div class="ibox-content forum-container">
                            <div class="forum-title">
                                <h3>All Topics</h3>
                            </div>

                            <?php
                            if ($topics > 0) {
                                foreach ($topics as $topic) {
                                    if (in_array(Auth::id(), INTERNAL_USERS) || Auth::id() == $topic['uid']) {
                                        ?>
                                        <div style="text-align: right">
                                            <a class="delete" href="<?php echo base_url()?>messageboard/delete_topic/<?php echo $topic['id']; ?>" >Delete</a>
                                        </div>
                                    <?php } ?>
                                    <div class="forum-item" style="overflow: scroll">
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="forum-icon">
                                                    <div>
                                                        <a href="/expertise/<?php echo $topic['uid'];?>">
                                                            <?php
                                                            if($topic['membertype']== '8')
                                                            {
                                                                $fullname = $topic['organization'];
                                                            }
                                                            else
                                                            {
                                                                $fullname = $topic['firstname']." ".$topic['lastname'];

                                                            }
                                                            // Use helper expert_image function that deals with too large image sizes
                                                            // by displaying a placeholder image instead of actual one for oversized images
                                                            $src = expert_image($topic["userphoto"], 48, array(
                                                                'max' => 48,
                                                                'rounded_corners' => array('all', '3'),
                                                                'allow_scale_larger' => TRUE,
                                                                'bg_color' => '#ffffff',
                                                                'crop' => TRUE
                                                            ));
                                                            ?>
                                                            <div class="div_resize_img198">
                                                                <img src="<?php echo $src; ?>" style="margin:0px">
                                                            </div>
                                                        </a>
                                                        <p><?php echo $fullname; ?></p>
                                                    </div>
                                                </div>
                                                <a href="<?php echo base_url(). 'messageboard/' . $topic['slug'] . '/' . $topic['id'] ?>"
                                                   class="forum-item-title"><?php echo $topic['topic_subject'] ?></a>
                                                <div class="forum-sub-title"><?php echo $topic['message'] ?></div>
                                            </div>
                                            <div class="col-md-1 forum-info">
                                    <span class="views-number">
                                        <?php echo $topic['posts'] ?>
                                    </span>
                                                <div>
                                                    <small>Replies</small>
                                                </div>
                                            </div>
                                            <div style="text-align: right">
                                                <p><?php echo $topic['created_at']; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php }
                            }
                            else {
                                echo '<h1> No topics to display!</h1>';
                            }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>