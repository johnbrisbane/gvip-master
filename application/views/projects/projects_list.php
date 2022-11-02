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
    width: 17%;
    margin-top: 1.5em;
    height: 96%;

    border: .51px solid var(--primary-grey);
    border-radius: 3px;
    background: var(--bg-light);
}

.sidebar-row {
    margin: 1em 0;
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
    margin: 0 .5em;
    margin-top: .250em !important;
    display: flex;
    flex-direction: row;
    justify-content: space-evenly;

}

.green-btn {
    padding: 10px 20px;

    background: var(--green-bg);
    color: var(--green-primary);
    font-size: 15px;
    font-weight: 600;
    text-decoration: none;
    border: var(--border) var(--green-primary);
    border-radius: 3px;
}

.green-btn:hover {
    color: var(--green-primary);
    background: var(--green-hover);
    transition: 300ms;
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

.filter_option {

    display: flex;
    flex-direction: column;
    margin: 0 .5em;
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
    margin: 1em .5em;
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

.tranverse-row {
    margin: 0 .5em;
    display: flex;
    flex-direction: row;
    justify-content: flex-start;
}

.tranverse-btn {
    margin: 0 10px;
    color: var(--green-primary);
    background: var(--green-bg);
    border: var(--border) var(--green-primary);
    border-radius: 2px;
    padding: 5px 10px;
    font-size: 16px;
}

.tranverse-btn:hover {
    background: var(--green-hover);
    transition: 300ms;
}

.tranverse-count {

    font-weight: lighter;
    color: var(--primary-grey);
}

.disabled-btn {
    background: #aeaeae !important;
    color: var(--primary-grey);
    border: var(--border) var(--primary-grey);
}

.first-page-btn {
    margin-right: 2em;
}

.tranverse-row-mobile {
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
    margin-top: 0 !important;
    height: 420px;
    position: relative;
    border: var(--border) var(--primary-grey);
    border-bottom: transparent;
    background: var(--bg-light);
}

.project_listing:hover {
    background: var(--bg-light);
}

.pl-name {
    margin: .25em;
    /* padding: .25em; */
    font-size: 15px;
    color: var(--primary-grey);
    font-weight: 300;
    padding-bottom: .25em;
    border-bottom: var(--border) var(--primary-grey);
    margin-bottom: .5em;
}

.pl-stats {
    margin: .25em;
}

.stat-row {
    display: flex;
    flex-direction: row;

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

.sidebar-count {
    width: 98%;
    margin: .5em auto;
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



.pl-btn p {
    font-size: 20px;
    font-weight: 600;
    color: var(--blue-primary);

}

.pl-btn img {
    width: 32px;
    height: 32px;
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
        width: 30%;
        overflow-y: scroll;

    }

    .main-content-container {
        margin-left: 1em;
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

    .tranverse-row-mobile {
        display: flex;
        flex-direction: row;
        justify-content: center;
        margin-top: 10px;
    }

    .tranverse-btn {
        margin: 0 5px;
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
        height: fit-content;
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
        margin-left: 1em;
    }

    .pl-btn {
        width: 75%;
        height: 25px;
        padding: 2px 0;
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

@media screen and (max-height:750px) {
    .sidebar-container {
        overflow-y: scroll;
    }
}
</style>
<div class="show-hide-container"> <button id="sidebar-switch" class="show-hide-btn">SHOW SIDEBAR</button></div>

<div class="sidebar-count"> <?php echo form_paging(true, $page_from, $page_to, $total, lang('Projects'), $paging); ?>
</div>

<div class="projects-page__wrapper">
    <div id="sidebar-container" class="sidebar-container">
        <div class="sidebar-row buttons-row">
            <a href="/projects/create" style="color: #376728;" class="green-btn">Create Project</a>
            <a href="projects/top100" class="green-btn">Ranked Projects</a>
        </div>
        <?php echo form_open('/projects', array(
            'id' => 'projects_search_form',
            'name' => 'search_form',
            'method' => 'GET'
        )); ?>
        <div class="sidebar-row ">
            <p class="sidebar-row__head">Search Specific:</p>
            <div class="sidebar-input">
                <?php echo form_input('searchtext', $filter['searchtext'], 'placeholder="' . lang('ProjectTextSearchTip') . '"') //"id"=>"search_text"
                ?>
            </div>
        </div>
        <div class="sidebar-row ">
            <p class="sidebar-row__head">Filter Projects</p>
            <div class="filter-options">
                <div class="filter_option">
                    <p class="option-text">Filter Project Stage:</p>
                    <?php echo form_dropdown('stage', stages_dropdown('select'), $filter['stage']); //"id='project_stage'"
                    ?>
                </div>

                <div class="filter_option">
                    <p class="option-text">Filter Project Sector:</p>
                    <?php echo form_dropdown('sector', sector_dropdown(), $filter['sector']) //id="member_sectors"
                    ?>
                </div>

                <div class="filter_option">
                    <p class="option-text">Filter Project Sub Sector:</p>
                    <?php echo form_dropdown('subsector', subsector_dropdown($filter['sector']), $filter['subsector']) ?>
                </div>

                <div class="filter_option">
                    <p class="option-text">Filter Project Country:</p>
                    <?php echo form_dropdown('country', country_dropdown(), $filter['country']) //id="member_country"
                    ?>
                </div>
            </div>
        </div>
        <div class="sidebar-row ">
            <p class="sidebar-row__head">Sort Projects</p>
            <div class="filter-options">
                <div class="filter_option">
                    <p class="option-text">Sort Projects by:</p>
                    <?php echo form_dropdown('sort_options', $sort_options, $sort) ?>
                </div>

            </div>
        </div>


        <div class=" sidebar-row">
            <input type="hidden" name="sort" value="<?php echo $sort ?>">
            <input type="hidden" name="limit" value="<?php echo $limit ?>">
            <?php echo form_submit('search', lang('Search'), 'class = "submit-btn"') ?>
        </div>
    </div>
    <div id="main-container" class="main-content-container">
        <?php
        $i = 0;
        if (count($projects) > 0) {
            foreach ($projects as $project) { ?>
        <div class="project_listing">

            <?php $src = project_image($project['projectphoto'], 198, array('width' => 198)) ?>
            <img src="<?php echo $src ?>" alt="<?php echo $project['projectname'] . "'s photo" ?>">
            <div class="pl-info">
                <h1 class="pl-name"><?php echo $project['projectname'] ?></h1>

                <div class="pl-stats">
                    <div class="stat-row">
                        <p class="stat-name"><?php echo lang('Country') ?>:</p>
                        <p class="stat-value">
                            <?php echo $project['country'] != '' ? $project['country'] : "&mdash;"; ?>
                        </p>
                    </div>
                    <div class="stat-row">
                        <p class="stat-name "><?php echo lang('Sector') ?>:</p>
                        <p class="stat-value sector-name">
                            <?php echo $project['sector'] != '' ? $project['sector'] : "&mdash;"; ?>
                        </p>
                    </div>
                    <div class="stat-row">
                        <p class="stat-name "><?php echo lang('Stage') ?>:</p>
                        <p class="stat-value">
                            <?php echo $project['stage'] != '' ? ucfirst(lang($project['stage'])) : "&mdash;"; ?>
                        </p>
                    </div>
                    <div class="stat-row">
                        <p class="stat-name"><?php echo lang('Value') ?>:</p>
                        <p class="stat-value"> <?php echo format_budget($project['totalbudget']) ?>
                        </p>
                    </div>

                </div>
                <a href="/projects/<?php echo $project['slug']; ?>" class="pl-btn">
                    <img src="https://d2huw5an5od7zn.cloudfront.net/project_svgs/view-blue.svg">
                    <p>View Project</p>
                </a>
            </div><!-- end .project_listing -->
        </div>
        <?php $i++;
                if ($i == 4) {
                    $i = 0;
                }
            }
        } else { ?>
        <div>
            <div class="clear">&nbsp;</div>
            <h3><?php echo lang('NoProjectsfoundtodisplay') ?></h3>
            <div class="clear">&nbsp;</div>
        </div>
        <?php } ?>

        <!-- END OF ROW -->
    </div>
</div>

<script>
var subsectors = <?php echo json_encode($all_subsectors) ?>;



const sidebar_switch = document.querySelector('#sidebar-switch');
const sidebar_panel = document.querySelector('#sidebar-container');
const projects_num = document.querySelector('.result_info_top');
const main_panel = document.querySelector('#main-container');
let is_sidebar_on = false;
const count = projects_num.querySelector('p');



if (window.innerWidth <= 550)
    count.remove()





function switchSidebar() {
    if (is_sidebar_on === false) {
        sidebar_switch.innerHTML = 'HIDE FILTERS';
        sidebar_panel.style.height = '100%';
        main_panel.style.height = '0%'
    } else {
        sidebar_switch.innerHTML = 'SHOW FILTERS';
        sidebar_panel.style.height = '0%';
        main_panel.style.height = '100%'
    }
    is_sidebar_on = !is_sidebar_on;
}



sidebar_switch.addEventListener('click', switchSidebar);

for (const el of main_panel.children) {
    const h1 = el.querySelector('h1');
    const sector = el.querySelector('.sector-name');
    if (sector.innerHTML.includes('Communication Technologies'))
        sector.innerHTML = 'ICT'
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