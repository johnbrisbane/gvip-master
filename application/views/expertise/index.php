<style>
:root {
    --bg-light: #e8eaef;
    --bg-grey: #dadada;
    --primary-grey: #5a5a5a;

    --blue-bg: #BFD1FE;
    --blue-primary: #136695;
    --blue-hover: #9aa3d6;
    --green-bg: #9AD18A;
    --green-primary: #376728;
    --green-hover: #7BC365;

    --border: .5px solid;
    --radius: 3px;
}

body {
    background: white;
}

* {
    margin: 0;
    padding: 0;
}

.projects-page__wrapper {
    display: flex;
    flex-direction: row;
    justify-content: space-evenly;
    height: 82vh;

}

/* SIDEBAR */
.sidebar-container {
    position: relative;
    width: 17%;
    margin-top: 1.5em;
    height: 96%;

    border: .51px solid var(--primary-grey);
    border-radius: 3px;
    background: var(--bg-light);
}

.filter-header {
    border-bottom: 2px solid var(--primary-grey);
    font-size: 28px;
    padding-bottom: .2em;
    font-weight: 600;
    color: var(--primary-grey);
    margin: .5em .5em 1em .5em
}

.sidebar-row {
    margin: .5em 0;
}

.sidebar-row__head {
    margin: 0 .5em;
    padding-bottom: .5em;
    font-size: 22px;
    font-weight: 400;


    border-bottom: 1px solid var(--primary-grey);
    color: var(--primary-grey);

}

.buttons-row {
    display: flex;
    flex-direction: row;
    justify-content: space-evenly;

}

.sidebar-input {
    display: flex;
    flex-direction: column;
    margin: 1em .5em;
}

.sidebar-input input {
    padding: .5em 0;
    display: block;


    font-size: 16px;
    font-weight: 300;
    color: var(--primary-grey);
    border-radius: 7px;
}

.sidebar-input input:focus {
    border: 1px solid var(--primary-grey);
    outline: none;
}

.filter-options {
    display: flex;
    flex-direction: column;
}

.option-text {
    font-size: 16px;
    font-weight: 200;
    color: var(--primary-grey);
    padding-bottom: .5em;

}

.sidebar-count {
    margin: .5em 2.5em;
}

.filter_option {

    display: flex;
    flex-direction: column;
    margin: .5em .5em;
}

.filter_option select {
    width: 100%;
    background: var(--bg-grey);
    font-size: 18px;
    color: var(--primary-grey);
    border: 1px solid var(--primary-grey);

}

.submit-btn {
    width: 95%;
    display: flex;
    flex-direction: row;
    border: var(--border) var(--blue-primary);
    background: var(--blue-bg);
    color: var(--blue-primary);
    font-size: 24px;
    font-weight: bold;
    display: block;
    margin: .5em;
}

.submit-btn:hover {
    transition: 300ms;
    background: var(--blue-hover);
}

.show-hide-container {
    display: none;
}


.show-hide-btn {
    display: none;
}

/* MAIN CONTENT */
.main-content-container {
    width: 81%;
    height: 96%;
    margin-top: 1.5em;
    display: grid;
    grid-template-columns: repeat(7, minmax(200px, 14%));
    grid-template-rows: auto;
    overflow-y: scroll;
}

.project_listing {
    position: relative;
    border: var(--border) var(--primary-grey);
    border-bottom: transparent;
    background: var(--bg-light);
    margin-top: 0;
    height: 420px !important;
    margin-bottom: 5em;
}

.project_listing:hover {
    background: var(--bg-light);
}

.pl-name {
    margin: .25em;
    font-size: 15px;
    font-weight: 300;
    padding-bottom: .25em;
    border-bottom: var(--border) var(--primary-grey);
    margin-bottom: .5em;
}



.stat-row {
    display: flex;
    flex-direction: row;

}

.pl-org {
    font-size: 12px;
    color: black;
    margin-bottom: 1em;
}

.stat-name {
    font-size: 13px;
    font-weight: bold;

    margin: 0 !important;
    padding: 0 !important;
}

.stat-value {
    margin: 0 !important;
    padding: 0 !important;
    padding-left: 2.5px !important;

    font-size: 13px;
}

.pl-btn {
    position: absolute;
    width: 100%;
    bottom: 0;
    padding: 5px 0;
    transform: translateY(95%);
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    border: var(--border) var(--blue-primary);
    border-radius: 3px;
    background: var(--blue-bg);
    text-decoration: none !important;
}

.pl-btn:hover {
    background: var(--blue-hover);
    transition: 300ms;
}

.pl-btn p {
    font-size: 20px;
    font-weight: 600;
    color: var(--blue-primary);

}

.stat-url {
    font-weight: bold;
    color: var(--blue-primary) !important;
    text-decoration: none;
}

.pl-btn img {
    width: 28px;
    height: 28px;
}


.result_info_top .buttons a,
.result_info_bottom .buttons a {
    border: var(--border) var(--primary-grey);
    background: var(--bg-grey);
    color: var(--primary-grey);
    margin: 0 4px;
}

.result_info_top .buttons strong {
    font-size: 14px;
    color: var(--primary-grey);
    font-weight: bolder;
}

.result_info_top p,
.result_info_bottom p {
    font-size: 14px;
    color: var(--primary-grey);
    font-weight: bolder;
}



@media screen and (max-width:1750px) {
    .sidebar-container {
        width: 20%;
    }

    .main-content-container {
        grid-template-columns: repeat(6, minmax(200px, 16.5%));
    }

}

@media screen and (max-width:1550px) {

    .main-content-container {
        grid-template-columns: repeat(5, minmax(200px, 20%));
    }

}



/* BELLOW 1400PX */
@media screen and (max-width:1400px) {
    .sidebar-container {
        width: 38%;
        overflow-y: scroll;
    }

    .main-content-container {
        grid-template-columns: repeat(4, minmax(200px, 25%));
    }

}

@media screen and (max-width:1150px) {
    .sidebar-container {
        width: 38%;
    }

    .main-content-container {
        width: 60%;
        grid-template-columns: repeat(3, minmax(200px, 33%));
    }
}

@media screen and (max-width:1000px) {
    .main-content-container {

        grid-template-columns: repeat(2, minmax(200px, 50%));
    }

}

@media screen and (max-width:750px) {
    .sidebar-container {
        width: 55%;
    }

    .main-content-container {
        width: 39%;
        grid-template-columns: repeat(1, minmax(200px, 90%));
    }

}

@media screen and (max-width:580px) {

    .result_info_top p,
    .result_info_bottom p {
        font-size: 10px;

    }
}

@media screen and (max-width:550px) {
    .sidebar-count {
        width: 75%;
    }

    .show-hide-container {
        margin-top: 1em;
        margin-bottom: 0;
        z-index: 1;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .projects-page__wrapper {
        flex-direction: column;
    }

    .show-hide-btn {
        font-size: 16px;
        padding: 10px 25px;
        background: var(--bg-grey);
        color: var(--primary-grey);
        border: var(--border) var(--primary-grey);
        display: initial
    }


    .main-content-container {
        width: 100%;
        height: 100%;
        grid-template-columns: repeat(2, minmax(200px, 50%));
    }

    .sidebar-container {
        width: 100%;
        height: 0%;
    }
}

@media screen and (max-width:470px) {
    .sidebar-count {
        width: 90%;
    }

}

@media screen and (max-width:410px) {
    .sidebar-count {
        width: 100%;
    }

    .main-content-container {
        margin: auto;
        width: 100%;
        grid-template-columns: repeat(1, minmax(200px, 100%));
    }

    .submit-btn {
        margin-bottom: 0;
    }

    .sidebar-row {
        margin: 0.5em 0;
    }

    .project_listing {
        display: flex;
        flex-direction: row;
        height: fit-content !important;
    }

    .filter_option .option-text {
        font-size: 14px;
    }

    .sidebar-input input {
        font-size: 14px;
    }

    .green-btn {
        padding: 5px 30px;
    }

    .sidebar-row__head {
        font-size: 16px;
    }

    .filter_option select {
        font-size: 14px;
    }

    .project_listing img {
        width: 198px;
        height: 198px;
    }

    .pl-info {
        display: flex;

        flex-direction: column;
        padding: 10px !important;
    }

    .pl-btn {
        width: 75%;
        height: 25px;
        padding: 2px 0;
        transform: translateY(0%);
    }

    .pl-name {
        width: 100%;
        font-size: 14px;
    }

    .stat-name,
    .stat-value {
        font-size: 12px;
    }



    .pl-btn img {
        width: 18px;
        height: 18px;

    }

    .pl-btn p {
        font-size: 16px;
    }

}

@media screen and (max-height:850px) {
    .sidebar-container {
        overflow-y: scroll;
    }



}
</style>
<div class="show-hide-container"> <button id="sidebar-switch" class="show-hide-btn">SHOW SIDEBAR</button></div>
<div class="sidebar-count">
    <?php echo form_paging(true, $page_from, $page_to, $filter_total, lang('Experts'), $paging); ?>
</div>
<div class="projects-page__wrapper">

    <div id="sidebar-container" class="sidebar-container">

        <h1 class="filter-header">Experts Filter</h1>

        <?php echo form_open('expertise/', array(
            'id' => 'expertise_search_form',
            'name' => 'search_form',
            'method' => 'get')) ?>

        <div class="sidebar-row ">
            <p class="sidebar-row__head">Search Specific Experts:</p>
            <div class="sidebar-input">
                <?php echo form_input('searchtext', $filter['searchtext'], 'placeholder="'. lang('ExpertTextSearchTip').'"') //'id="search_text"' ?>
            </div>
        </div>

        <div class="sidebar-row ">
            <p class="sidebar-row__head">Filter Experts:</p>
            <div class="filter-options">
                <div class="filter_option">
                    <p class="option-text">Experts Country:</p>
                    <?php echo form_dropdown('country', country_dropdown(), $filter['country']) //id="member_country" ?>
                </div>

                <div class="filter_option">
                    <p class="option-text">Experts Sector:</p>
                    <?php echo form_dropdown('sector', sector_dropdown(), $filter['sector']) //id="member_sectors" ?>
                </div>

                <div class="filter_option">
                    <p class="option-text">Experts Sub Sector:</p>
                    <?php echo form_dropdown('subsector', subsector_dropdown($filter['sector']), $filter['subsector']) ?>
                </div>

                <div class="filter_option">
                    <p class="option-text">Experts Discipline:</p>
                    <?php echo form_dropdown('discipline', discipline_dropdown(), $filter['discipline']) //'id="member_discipline"' ?>
                </div>
            </div>
        </div>


        <div class="sidebar-row ">
            <p class="sidebar-row__head">Sort Options</p>
            <div class="filter-options">
                <div class="filter_option">
                    <p class="option-text">Sort Experts by:</p>
                    <?php echo form_dropdown('sort_options', $sort_options, $sort) ?>
                </div>

            </div>
        </div>


        <div class=" sidebar-row">
            <?php echo form_submit('search', lang('Search'),'class = "submit-btn"') ?>
        </div>
        
        <input type="hidden" name="sort" value="<?php echo $sort ?>">

        <?php echo form_close();?>

    </div>

    <div id="main-container" class="main-content-container">

        <?php

        $i = 0;
        if(count($users)>0)
        {
            foreach($users as $key=> $val)
            {

                //ExpertAdverts Start
                if($val['membertype']== '8')
                {
                    $fullname = $val['organization'];
                }
                else
                {
                    $fullname = $val['firstname']." ".$val['lastname'];

                }
                //ExpertAdverts End

                ?>
        <div class="project_listing <?php if($i==3) { echo "project_listing_last"; }  ?> left">

            <a href="/expertise/<?php echo $val['uid'];?>">
                <?php
                        // Use helper expert_image function that deals with too large image sizes
                        // by displaying a placeholder image instead of actual one for oversized images
                        $src = expert_image($val["userphoto"], 198, array(
                            'max' => 198,
                            'rounded_corners' => array('all', '3'),
                            'allow_scale_larger' => TRUE,
                            'bg_color' => '#ffffff',
                            'crop' => TRUE
                        ));
                        ?>
                <div class="div_resize_img198">
                    <img src="<?php echo $src; ?>" alt="<?php echo "$fullname's photo"; ?>" style="margin:0px">
                </div>
            </a>
            <div class="pl-info">
                <h1 class="pl-name"><?php echo $fullname; ?></h1>
                <p style="margin:.5em 0; padding:0 5px;" class="pl-org"> <?php if ($val['membertype'] == MEMBER_TYPE_MEMBER) {
                                echo $val['title'] . ' at ' . $val['organization'] . ' in ';
                            }
                            echo $val['country']; ?></p>

                <div style="margin:.5em 0; padding:0 5px;" class="pl-stats">
                    <div class="stat-row">
                        <p class="stat-name"><?php echo lang('Sector') ?>:</p>
                        <p class="stat-value sector-value"><?php  echo $val['expert_sector'] ?: '&mdash;' ?></p>
                    </div>
                    <div class="stat-row">
                        <p class="stat-name"><?php echo lang('Discipline') ?>:</p>
                        <p class="stat-value discipline-value"><?php echo $val['discipline'] ?: '&mdash;';?></p>
                    </div>
                    <div class="stat-row">
                        <p style="font-weight: bold;" class="stat-name"><?php
                                    $rated = $val['rating_overall'] > 0 && $val['rating_count'] > 0;
                                    $rating_value = number_format((float) $val['rating_overall'], 1) . ' (' . $val['rating_count'] . ')';
                                    ?> <?php echo lang('Rating') ?>:</p>
                        <p class="stat-value">
                            <?php echo $rated ? $rating_value : '&mdash;' ?>
                        </p>
                    </div>
                </div>
                <a href="/expertise/<?php echo $val['uid'];?>" class="pl-btn">
                    <img src="https://d2huw5an5od7zn.cloudfront.net/project_svgs/profile.svg">
                    <p>Expert Profile</p>
                </a>
            </div>

        </div>
        <?php $i++; if ($i == 4) $i = 0; }
        }
        else
        {
            ?>
        <div>
            <div class="clear">&nbsp;</div>
            <h3 align="center"><?php echo lang('NoExpertiseplay')?></h3>
            <div class="clear">&nbsp;</div>
        </div>
        <?php
        }
        ?>
    </div>


</div>
<script>
var subsectors = <?php echo json_encode($all_subsectors) ?>;


let is_sidebar_on = false;
const sidebar_switch = document.querySelector('#sidebar-switch');
const sidebar_panel = document.querySelector('#sidebar-container');
const main_panel = document.querySelector('#main-container');
const projects_num = document.querySelector('.result_info_top');
const count = projects_num.querySelector('p');



if (window.innerWidth <= 550)
    count.remove()






function switchSidebar() {
    if (is_sidebar_on === false) {
        sidebar_switch.innerHTML = 'HIDE SIDEBAR';
        sidebar_panel.style.height = '100%';
        main_panel.style.height = '0%'
    } else {
        sidebar_switch.innerHTML = 'SHOW SIDEBAR';
        sidebar_panel.style.height = '0%';
        main_panel.style.height = '100%'
    }
    is_sidebar_on = !is_sidebar_on;
}



sidebar_switch.addEventListener('click', switchSidebar);
for (const el of main_panel.children) {
    const sector = el.querySelector('.sector-value');
    const discipline = el.querySelector('.discipline-value');
    const url = el.querySelector('.pl-btn').getAttribute('href')

    if (sector.innerHTML.includes(' Communication Technologies') && window.innerWidth <= 550)
        sector.innerHTML = 'ICT';

    if (sector.innerHTML.includes(','))
        sector.innerHTML = ` Multiple... <a href="${url}" class="stat-url">View</a>`;


    if (discipline.innerHTML.includes(','))
        discipline.innerHTML = ' Multiple... <a href="${url}" class="stat-url">View </a>'
}



window.addEventListener('resize', () => {
    if (window.innerWidth <= 550)
        return;
    else {
        main_panel.style.height = '100%';
        sidebar_panel.style.height = '100%';
        projects_num.appendChild(count)

    }
})

// main_panel.addEventListener('scroll', () => {
//     const window_height = main_panel.scrollHeight - main_panel.clientHeight
//     const scroll_height = main_panel.scrollTop
//     if (scroll_height > (window_height - 200)) {
//         //    PHP Code to load more Projects
//     }
// })
</script>
