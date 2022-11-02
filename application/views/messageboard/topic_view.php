<?php
$data = array(
    'topic' => $topic,
    'posts' => $posts,
    'category' => $category
);
?>
<style>
    .messageboard-post-container .media {
        margin: 10px 10px 10px 10px;
        padding: 20px 10px 20px 10px;
        border-bottom: 1px solid #f1f1f1;
    }
    .messageboard-avatar .img-circle {
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
        width: 38px;
    }
    .mid-icon {
        font-size: 66px;
    }
    .messageboard-item {
        height: auto;
        padding: 10px 0 20px;
        border-bottom: 1px solid #f1f1f1;
    }
    .views-number {
        font-size: 24px;
        font-weight: 400;
    }
    .messageboard-container,
    .messageboard-post-container {
        padding: 30px !important;
    }
    .messageboard-item small {
        color: #999;
    }
    .messageboard-item .messageboard-sub-title {
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
        width: 20%;
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
    <div id="col10" class="center_col">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="wrapper wrapper-content animated fadeInRight">

                        <div class="ibox-content m-b-sm border-bottom">
                            <div class="p-xs">
                                <div class="pull-left m-r-md" style="width: 15%">
                                    <div>
                                        <a href="/expertise/<?php echo $topic_user['uid'];?>">
                                            <?php
                                            if($topic_user['membertype']== '8')
                                            {
                                                $fullname = $topic_user['organization'];
                                            }
                                            else
                                            {
                                                $fullname = $topic_user['firstname']." ".$topic_user['lastname'];

                                            }
                                            // Use helper expert_image function that deals with too large image sizes
                                            // by displaying a placeholder image instead of actual one for oversized images
                                            $src = expert_image($topic_user["userphoto"], 48, array(
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
                                <h2><?php echo $topic['topic_subject']; ?></h2>
                                <span><?php echo $topic['message']; ?></span>
                                <br>
                                <p style="text-align: right"><?php echo DateFormat($topic['created_at'], DATEFORMAT, FALSE); ?></p>
                            </div>
                        </div>
                        <br>
                        <div class="ibox-content messageboard-container">
                            <div class="messageboard-title">
                                <h3>All Replies</h3>
                            </div>

                            <?php
                            if ($posts > 0) {
                                foreach ($posts as $post) {
                                    if (in_array(Auth::id(), INTERNAL_USERS) || Auth::id() == $post['uid']) {
                                        ?>
                                        <div style="text-align: right">
                                            <a class="delete" href="<?php echo base_url()?>messageboard/delete_post/<?php echo $post['id']; ?>" >Delete</a>
                                        </div>
                                    <?php } ?>
                                    <div class="messageboard-item" style="overflow: scroll">
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="messageboard-icon">
                                                    <div>
                                                        <a href="/expertise/<?php echo $post['uid'];?>">
                                                            <?php
                                                            if($post['membertype']== '8')
                                                            {
                                                                $fullname = $post['organization'];
                                                            }
                                                            else
                                                            {
                                                                $fullname = $post['firstname']." ".$post['lastname'];

                                                            }
                                                            // Use helper expert_image function that deals with too large image sizes
                                                            // by displaying a placeholder image instead of actual one for oversized images
                                                            $src = expert_image($post["userphoto"], 48, array(
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
                                                <a class="messageboard-sub-title" style="font-size: 1.2em; color: black"><?php echo $post['post_content'] ?></a>
                                            </div>
                                            <br>
                                            <div style="text-align: right">
                                                <p><?php echo $post['created_at']; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php }
                            }
                            else {
                                echo '<h3> No replies yet!</h3>';
                            }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if (Auth::id() > 0){
        $this->load->view('messageboard/create_post', $data);
        }
        else{ ?>
        <p>Create an Account to Join the Conversation</p>
        <?php } ?>

    </div>
</div>
