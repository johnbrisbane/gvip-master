<?php
$now = time(); // or your date as well
$datediff = $now - strtotime($created_at);
$createdays = round($datediff / (60 * 60 * 24));

$editdiff = $now - strtotime($updated_at);
$editdays = round($editdiff / (60 * 60 * 24));
?>

<div class="clearfix" id="content">
    <div class="expert_profile">
        <div class="expert_portlet white_box">
                <p style="float: right"><?php echo $createdays; ?> Days Ago</p>

            <?php
            $img = expert_image($specificbook->member_info['userphoto'], 140, array('rounded_corners' => array( 'all','2' )) );
            $name = $specificbook->member_info['firstname'] . ' ' . $specificbook->member_info['lastname'] . "'s photo";
            ?>
            <img src="<?php echo $img ?>" alt="<?php echo $name ?>" width="140" height="140" style="margin:0px">

            <div class="content" >
                <?php /* <div class="ratings">92%</div> */ ?>
                <h1><?php echo $specificbook->member_info['firstname']." ".$specificbook->member_info['lastname']; ?></h1>
                <?php

                $toprow1 = '';
                if(isset($specificbook->member_info['title'])&& $specificbook->member_info['title'] != '')
                {
                    $toprow1 .= ucfirst($specificbook->member_info['title']);
                }

                else
                {
                    $toprow1 .= '';
                }
                ?>

                <div class="title"><?php echo $toprow1;?></div>

                <?php
                $fulllocation = array();

                if($specificbook->member_info['city']) {$fulllocation[] = $specificbook->member_info['city'];}
                if($specificbook->member_info['state']){$fulllocation[] = $specificbook->member_info['state'];}
                if($specificbook->member_info['country']){$fulllocation[] = $specificbook->member_info['country'];}
                ?>
                <?php if(count($fulllocation) > 0){?>
                    <div class="more_info"><strong><?php echo lang('Location')?>: </strong><?php echo implode(', ',$fulllocation);?></div>
                <?php } ?>
                <?php if(isset($expertise['areafocus']) && $expertise['areafocus']!= ''){?>
                    <div class="more_info"><strong><?php echo lang('FocusAreas')?>: </strong><?php echo $expertise['areafocus'];?></div>
                <?php } ?>
                <?php

                ?>
                <div><strong> Member since </strong> <?php echo $specificbook->member_info['registerdate'] ?></div>
                <div><strong><?php echo $totalbooks ?></strong> posts</div>
            </div>
            <div class="content" style="width: 97%" >
                <br>
                <div>
                    <b><?php echo $specificbook->title ?></b>
                    <?php echo htmlspecialchars_decode(stripslashes($specificbook->content)); ?>
                    <p style="float: right"><?php if($editdays != $createdays){echo '<i>Edited '.$editdays. ' Days Ago</i>';}; ?></p>
                </div>
            </div>
        </div><!-- expert_portlet -->
    </div>
</div>

