<?php
if ($project['projectdata']['eststart'] == '' || $project['projectdata']['eststart'] == '1111-11-11'
    || $project['projectdata']['estcompletion'] == '' || $project['projectdata']['estcompletion'] == '1111-11-11'){
    echo '<h2>Timeline Coming Soon</h2>
          <div id="tabs-7" class="col2_tab">
          </div>';
}
else {
?>
<!-- 
<style>
.timeline-container {
    margin-left: 20px;
}

.stp__container {
    margin: 0;
    padding: 0;
    display: flex;
    align-items: center;
}

.circle-elm__box {
    margin: 0;
    padding: 0;
    width: 5%;

}

.circle_elm {
    margin: 0;
    padding: 0;
    transform: translateX(-50%);
    border-radius: 50%;
    width: 20px;
    height: 20px;
    border: 7px solid #2774a5;
    background: #2774a5;
}

.stp__text {
    font-size: 2rem;
    margin: 0;
    padding: 0;
}

.stp-extension {
    padding: 0;
    margin: 0;
    transform: translateX(-2.5px);
    border-left: 5px solid #2774a5;
    min-height: 25px;
}

.active-elm {
    background: white;
}

.wah__container {
    display: flex;
    margin-left: 1em;
    height: 40px;
    align-items: center;

}




.arrow-left {
    width: 0;
    height: 0;
    border-top: 15px solid white;
    border-bottom: 15px solid white;
    border-right: 30px solid #2774a5;
}

.wah__text {
    color: #2774a5;
    text-decoration: none;
    border: none !important;
    margin-left: 1em;
}
</style> -->

<h2>Timeline</h2>
<div id="tabs-7" class="col2_tab ">


    <?php if ($project['projectdata']['conceptual_date_from'] != '' && $project['projectdata']['conceptual_date_to'] != '1111-11-11 00:00:00') {?>
    <div class="timeline-container">
        <div class="stp-extended__container">
            <div class="stp__container">
                <div class="circle-elm__box">
                    <?php
                    $conceptualfrom = date("M Y",strtotime($project['projectdata']['conceptual_date_from']));
                    $conceptualto = date("M Y",strtotime($project['projectdata']['conceptual_date_to']));
                    if((time()-(60*60*24)) > strtotime($conceptualfrom)){
                        echo '<div class="circle_elm active-elm"></div>';
                    }
                    else {
                        echo '<div class="circle_elm"></div>';
                    }
                    ?>
                </div>
                <h1 class="stp__text">Conceptual (<?php echo $conceptualfrom ?> - <?php echo $conceptualto ?>)</h1>
                <?php
                if((time()-(60*60*24)) > strtotime($conceptualfrom) && (time()-(60*60*24)) < strtotime($conceptualto)){
                    echo '
                        <div class="wah__container">
                        <div class="arrow-left"></div>
                        <h2 class="wah__text">We are here</h2>
                        </div>
                    ';
                }
                ?>

            </div>
            <div class="stp-extension">
            </div>
        </div>
    </div>
    <?php } ?>


    <?php if ($project['projectdata']['feasibility_date_from'] != '' && $project['projectdata']['feasibility_date_to'] != '1111-11-11 00:00:00') {?>
    <div class="timeline-container">
        <div class="stp-extended__container">
            <div class="stp__container">
                <div class="circle-elm__box">
                    <?php
                $feasibilityfrom = date("M Y",strtotime($project['projectdata']['feasibility_date_from']));
                $feasibilityto = date("M Y",strtotime($project['projectdata']['feasibility_date_to']));
                if((time()-(60*60*24)) > strtotime($feasibilityfrom)){
                    echo '<div class="circle_elm active-elm"></div>';
                }
                else {
                    echo '<div class="circle_elm"></div>';
                }
                ?>
                </div>
                <h1 class="stp__text">Feasibility (<?php echo $feasibilityfrom ?> - <?php echo $feasibilityto ?>)</h1>
                <?php
            if((time()-(60*60*24)) > strtotime($feasibilityfrom) && (time()-(60*60*24)) < strtotime($feasibilityto)){
                echo '
                        <div class="wah__container">
                        <div class="arrow-left"></div>
                        <h2 class="wah__text">We are here</h2>
                        </div>
                    ';
                }
                 ?>
            </div>
            <div class="stp-extension">

            </div>
        </div>

    </div>
    <?php } ?>

    <?php if ($project['projectdata']['planning_date_from'] != '' && $project['projectdata']['planning_date_to'] != '1111-11-11 00:00:00') {?>
    <div class="timeline-container">
        <div class="stp-extended__container">
            <div class="stp__container">
                <div class="circle-elm__box">
                    <?php
                    $planningfrom = date("M Y",strtotime($project['projectdata']['planning_date_from']));
                    $planningto = date("M Y",strtotime($project['projectdata']['planning_date_to']));
                    if((time()-(60*60*24)) > strtotime($planningfrom)){
                        echo '<div class="circle_elm active-elm"></div>';
                    }
                    else {
                        echo '<div class="circle_elm"></div>';
                    }
                    ?>
                </div>
                <h1 class="stp__text">Planning (<?php echo $planningfrom ?> - <?php echo $planningto ?>)</h1>
                <?php
                if((time()-(60*60*24)) > strtotime($planningfrom) && (time()-(60*60*24)) < strtotime($planningto)){
                    echo '
                        <div class="wah__container">
                        <div class="arrow-left"></div>
                        <h2 class="wah__text">We are here</h2>
                        </div>
                    ';
                }
                ?>
            </div>
            <div class="stp-extension">

            </div>
        </div>
    </div>
    <?php } ?>

    <div class="timeline-container">
        <div class="stp-extended__container">
            <div class="stp__container">
                <div class="circle-elm__box">
                    <?php
                    $eststart = date("M Y",strtotime($project['projectdata']['eststart']));
                    $estcompletion = date("M Y",strtotime($project['projectdata']['estcompletion']));
                    if((time()-(60*60*24)) > strtotime($eststart)){
                        echo '<div class="circle_elm active-elm"></div>';
                    }
                    else {
                        echo '<div class="circle_elm"></div>';
                    }
                    ?>
                </div>
                <h1 class="stp__text">Construction (<?php echo $eststart ?> - <?php echo $estcompletion ?>)</h1>
                <?php
                if((time()-(60*60*24)) > strtotime($eststart) && (time()-(60*60*24)) < strtotime($estcompletion)){
                    echo '
                        <div class="wah__container">
                        <div class="arrow-left"></div>
                        <h2 class="wah__text">We are here</h2>
                        </div>
                    ';
                }
                ?>
            </div>
            <div class="stp-extension">

            </div>
        </div>
    </div>

    <div class="timeline-container">
        <div class="stp-extended__container">
            <div class="stp__container">
                <div class="circle-elm__box">
                    <?php
                    $eststart = date("M Y",strtotime($project['projectdata']['eststart']));
                    $estcompletion = date("M Y",strtotime($project['projectdata']['estcompletion']));
                    if((time()-(60*60*24)) > strtotime($estcompletion)){
                        echo '<div class="circle_elm active-elm"></div>';
                    }
                    else {
                        echo '<div class="circle_elm"></div>';
                    }
                    ?>
                </div>
                <h1 class="stp__text">O & M (<?php echo $estcompletion ?>)</h1>
                <?php
                if((time()-(60*60*24)) > strtotime($estcompletion)){
                    echo '
                        <div class="wah__container">
                        <div class="arrow-left"></div>
                        <h2 class="wah__text">We are here</h2>
                        </div>
                    ';
                }
                ?>
            </div>
        </div>
    </div>



</div>
<?php } ?>