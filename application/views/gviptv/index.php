<!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
<!-- Google Fonts -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
<!-- Bootstrap core CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
<!-- Material Design Bootstrap -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">

<!-- JQuery -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js">
</script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>


<style>
* {
    margin: 0;
    padding: 0;
}

.upper-filter__wrapper {
    margin: 1em 2em;
}

.upper-filter__header {
    display: inline-block;
    padding-right: 3em;
    font-size: 28px;
    font-weight: lighter;
    border-bottom: 1px solid #4a4a4a;
    color: #4a4a4a;
    margin-bottom: 1em;
}

.filter-btns__row {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    margin-bottom: 1em;
}

.filter-btn__single {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
    width: 14.2%;
    height: 75px;
    background: #d8dadf;
    border: .5px solid #5a5a5a;
    border-radius: 3.5px;
}

.filter-btn__single:hover {
    cursor: pointer;
    transition: 300ms;
    background: #bababa;
}

.filter-btn__single h1 {
    color: #5a5a5a;
    margin-left: 10px;
    font-size: 24px;
}

.filter-btn__single img {
    width: 35px;
    height: 35px;
    margin-right: 10px;

}

.gviptv-thumbnail__container {
    border-top: 1px solid #4a4a4a;
    border-bottom: 1px solid #4a4a4a;
    margin: 0 2em;
    height: 72vh;
    overflow-y: scroll;
    display: grid;
    grid-template-columns: repeat(4, minmax(240px, 25%));
    grid-template-rows: auto;
}

.gviptv-thumbnail__outer {
    height: 340px;
    display: flex;
    align-items: center;
    justify-content: center;

}

.gviptv-thumbnail__single {
    position: relative;
    border: 1px solid #4a4a4a;
    border-radius: 2.5px;
    width: 95%;
    height: 95%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.single-thumbnail__wrapper {
    width: 100%;
    height: 60%;

}

.single-thumbnail__wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.thumbnail-head {
    height: 40%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.thumbnail__header {
    font-size: 18px;
    color: #5a5a5a;
    margin: .25em .5em;
    font-weight: lighter;
}

.thumbnail-action__wrapper {
    bottom: 0;
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-between;

}

.thumbnail-category {
    width: 50%;
    font-weight: lighter;
    font-size: 18px;
    padding-left: .25em;
    color: #4a4a4a;
}

.watch-more__btn {
    margin-left: auto;
    width: 120px;
    height: 40px;
    background: #d8dadf;
    border: 1px solid #4a4a4a;
    border-radius: 2.5px;
    text-decoration: none;
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
}

.watch-more__btn:hover {
    cursor: pointer;
    transition: 300ms;
    background: #bababa;
}

.watch-more__btn img {
    width: 20px;
    height: 20px;

}

.watch-more__btn p {
    padding-left: 12px;
    padding-top: 10px;
    font-size: 15px;
    color: #4a4a4a;
}

.active-filter {
    border: 1px solid #136693;
}

.active-filter h1 {
    color: #136693;
}

/* RESPONSIVE STYLES */
@media screen and (max-width:1350px) {


    .filter-btn__single h1 {
        margin-left: 5px;
        font-size: 20px;
    }

    .filter-btn__single img {
        width: 30px;
        height: 30px;
        margin-right: 5px;

    }

    .thumbnail__header {
        font-size: 16px;
    }
}

@media screen and (max-width:1120px) {
    .filter-btn__single h1 {
        margin-left: 2px;
        font-size: 16px;
    }

    .filter-btn__single img {
        width: 25px;
        height: 25px;
        margin-right: 2px;

    }

    .thumbnail__header {
        font-size: 14px;
    }
}

@media screen and (max-width:1000px) {


    .gviptv-thumbnail__container {
        grid-template-columns: repeat(3, minmax(240px, 33.3%));
    }


    .thumbnail__header {
        font-size: 18px;
    }
}

@media screen and (max-width:850px) {
    .thumbnail__header {
        font-size: 14px;
    }

    .filter-btn__single {
        width: 33%;
    }
}

@media screen and (max-width:770px) {
    .upper-filter__header {
        font-size: 26px;
        border-bottom: none;
    }

    .gviptv-thumbnail__container {
        grid-template-columns: repeat(2, minmax(240px, 49.5%));
    }

    .thumbnail__header {
        font-size: 18px;
    }

    .filter-btn__single {
        flex-direction: column;
        text-align: center;
    }
}

@media screen and (max-width:660px) {
    .thumbnail__header {
        font-size: 15px;
    }

}

@media screen and (max-width:580px) {
    .upper-filter__header {
        font-size: 22px;
    }

    .filter-btns__row {
        display: grid;
        grid-template-columns: repeat(2, minmax(125px, 49.5%));
    }

    .filter-btn__single {
        width: 100%;
    }

    .gviptv-thumbnail__container {
        grid-template-columns: repeat(1, minmax(240px, 100%));
    }

    .thumbnail__header {
        font-size: 18px;
    }
}

.loading-placeholder {
    width: 150px;
    height: 150px;
    position: absolute;
    left: 50%;
    transform: translateX(-100%);
    margin-top: 10em;
    border: 7px solid transparent;
    border-bottom: 7px solid #5a5a5a;
    border-radius: 50%;
    animation: loading-circle linear;
    animation-duration: 500ms;
    animation-iteration-count: infinite;

}

@keyframes loading-circle {
    from {
        transform: rotateZ(0deg);
    }

    to {
        transform: rotateZ(360deg);
    }
}


/* Extra styles */

.class-investment {
    color: #800000;
    font-weight: bold;
}

.class-technology {
    color: #0b6623;
    font-weight: bold;
}

.class-projects {
    color: #710193;
    font-weight: bold;
}

.class-leadership {
    color: #136693;
    font-weight: bold;
}
</style>

<div class="upper-filter__wrapper">
    <h1 class="upper-filter__header">Select A Video Category:</h1>
    <div class="filter-btns__row ">
        <div id="btn-all" class="filter-btn__single active-filter">
            <img src="https://d2huw5an5od7zn.cloudfront.net/project_svgs/gviptv_svgs/all_blue.svg">
            <h1>All Videos</h1>
        </div>
        <div id='btn-recent' class="filter-btn__single">
            <img src="https://d2huw5an5od7zn.cloudfront.net/project_svgs/gviptv_svgs/recent_grey.svg">
            <h1>Recent Uploads</h1>
        </div>
        <div id='btn-projects' class="filter-btn__single ">
            <img src="https://d2huw5an5od7zn.cloudfront.net/project_svgs/gviptv_svgs/projects_grey.svg">
            <h1>Projects</h1>
        </div>
        <div id='btn-invest' class="filter-btn__single">
            <img src="https://d2huw5an5od7zn.cloudfront.net/project_svgs/gviptv_svgs/investmeant_grey.svg">
            <h1>Investment</h1>
        </div>
        <div id='btn-tech' class="filter-btn__single">
            <img src="https://d2huw5an5od7zn.cloudfront.net/project_svgs/gviptv_svgs/technology_grey.svg">
            <h1>Technology</h1>
        </div>
        <div id='btn-leader' class="filter-btn__single">
            <img src="https://d2huw5an5od7zn.cloudfront.net/project_svgs/gviptv_svgs/leadership_grey.svg">
            <h1>Leadership</h1>
        </div>
    </div>
</div>

<div id="main-content" class="gviptv-thumbnail__container">
    <div class="loading-placeholder"></div>

</div>




<script>
//Should be dynamicly loaded. Still waiting on John with that
//

<?php
    echo 'const hardcodedData = [';

    foreach ($rows as $videos) {
        echo "{head: \"" . $videos['title'] . "\",";
        echo "body: `" . $videos['description'] . "`,";
        echo "type: \"" . $videos['category'] . "\",";
        echo "videoUrl: \"" . $videos['link'] . "\",";
        echo "id: \"" . $videos['id'] . "\",";
        echo "imageUrl: \"" . $videos['thumbnail'] . "\"},";
    }

    echo ']';

    ?>


let currentlySeleceted = document.querySelector('#btn-all');

function replaceImageUrl(imageSrc, reversed) {

    const res = reversed === false ? imageSrc.replace('_grey.svg', '_blue.svg') : imageSrc.replace('_blue.svg',
        '_grey.svg');

    return res;

}

function replaceSelected(target) {
    currentlySeleceted.classList.remove('active-filter');
    currentlySeleceted.children[0].setAttribute('src', replaceImageUrl(currentlySeleceted.children[0].src, true));
    const targetElement = target.tagName === 'DIV' ? target : target.parentNode;
    currentlySeleceted = document.getElementById(targetElement.id);
    currentlySeleceted.classList.add('active-filter')
    currentlySeleceted.children[0].setAttribute('src', replaceImageUrl(currentlySeleceted.children[0].src, false));
}



// populating the container with the data
function populate(content, status, isFirst) {
    const mainContent = document.querySelector('#main-content');
    mainContent.innerHTML = ``;
    if (status !== 'all' && status !== 'recent')
        content = content.filter(el => el.type === status)
    content.forEach((el, i) => {
        mainContent.innerHTML +=
            `<div class="gviptv-thumbnail__outer">
        <div class="gviptv-thumbnail__single">
            <div class="single-thumbnail__wrapper">
                <img src="${el.imageUrl}">
            </div>
            <div class="thumbnail-head">
                <p class="thumbnail__header">${el.head}</p>
                <div class="thumbnail-action__wrapper">
                    <h1 class="thumbnail-category class-${el.type.toLowerCase()}">${el.type}</h1>
                    <a  href="/gviptv/view/${el.id}" class="watch-more__btn" href="">
                        <img src="https://d2huw5an5od7zn.cloudfront.net/project_svgs/gviptv_svgs/watch-grey.svg">
                        <p>Watch</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
        `

    })
}

$(document).ready(function() {
    populate(hardcodedData, 'all', false)
})

// //Button Event listeners
$('#btn-all').on('click', function(e) {
    document.querySelector('#main-content').innerHTML = `<div class='loading-placeholder'></div>`;
    replaceSelected(e.target)
    populate(hardcodedData, 'all', true);
})
$('#btn-recent').on('click', function(e) {
    document.querySelector('#main-content').innerHTML = `<div class='loading-placeholder'></div>`;
    replaceSelected(e.target)
    populate(hardcodedData.slice(0, 4), 'recent', true);
})
$('#btn-invest').on('click', function(e) {
    document.querySelector('#main-content').innerHTML = `<div class='loading-placeholder'></div>`;
    replaceSelected(e.target)
    populate(hardcodedData, 'Investment', true);
})
$('#btn-leader').on('click', function(e) {
    document.querySelector('#main-content').innerHTML = `<div class='loading-placeholder'></div>`;
    replaceSelected(e.target)
    populate(hardcodedData, 'Leadership', true);
})
$('#btn-projects').on('click', function(e) {
    document.querySelector('#main-content').innerHTML = `<div class='loading-placeholder'></div>`;
    replaceSelected(e.target)
    populate(hardcodedData, 'Projects', true);
})
$('#btn-tech').on('click', function(e) {
    document.querySelector('#main-content').innerHTML = `<div class='loading-placeholder'></div>`;
    replaceSelected(e.target)
    populate(hardcodedData, 'Technology', true);
})
</script>