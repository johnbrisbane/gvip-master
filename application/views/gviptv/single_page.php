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
:root {
    --light-grey: #D8DADF;
    --darkend-grey: #bababa;
    --dark-grey: #4a4a4a;
    --class-blue: #1984C8;
    --class-red: #920000;
    --class-purple: #710193;
    --class-green: #0B6623;
}

* {
    margin: 0;
    padding: 0;
}

.gviptv-main__container {
    margin-top: 2em;
    margin-left: 6em;
    height: 87vh;
    display: flex;
    flex-direction: row;

}

.main-content__wrapper {
    width: 75%;
    height: 100%;
    margin-right: 3em;
    background: #f1f1f1;
}

.youtube-video__container {
    height: 65%;

}

.embed-youtube-item {
    width: 100%;
    height: 100%;
}

.title-and-time__wrapper {
    margin: 1em 0;

}



.video-title {
    margin: 0;
    font-size: 24px;
    color: var(--dark-grey);

}

.video-time {
    margin: 0;
    font-size: 18px;
    color: var(--dark-grey);
}

.buttons-and-desc__wrapper {

    display: flex;
    flex-direction: row;
    justify-content: space-between;
    height: 24.7%;
}

.description-container {
    width: 65%;
    border-top: 1px solid var(--dark-grey);
    height: 100%;
    overflow-y: scroll;
}

.description-container * *,
.description-container *,
.description-container {
    font-size: 18px !important;
}

.button__wrapper {
    display: flex;
    flex-direction: row;
}

.tv-action-btn {
    margin-left: 1.5em;
    width: 150px;
    height: 50px;
    background: var(--light-grey);
    border: 1px solid var(--dark-grey);
    border-radius: 2.5px;
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
}

.tv-action-btn:hover {
    transition: 300ms;
    background: var(--darkend-grey);
}

.tv-action-btn img {
    width: 25px;
    height: 25px;
    margin-right: 0.5em;
}

.tv-action-btn p,
.tv-action-btn a {

    font-size: 20px;
    color: var(--dark-grey) !important;
    text-decoration: none;
    font-weight: bold;
    letter-spacing: 1px;
}

.tv-action-btn p {
    padding-top: 5px;
}

/* SIDEBAR CONTENT */
.sidebar-section__wrapper {
    overflow-y: scroll;
    width: 23%;
    height: 100%;
}

.sidebar-video__container {
    text-decoration: none;
    display: flex;
    flex-direction: row;
    background: #f1f1f1;
    margin-bottom: 2em;
}

.sidebar-video__container:hover {
    background: #e1e1e1;
    transition: 300ms;
}

.sidebar-image__wrapper {
    width: 225px;
    height: 150px;

}

.sidebar-image__wrapper img {
    width: 225px;
    height: 150px;
    object-fit: cover;
}

.sidebar-text__wrapper {
    margin-left: 1em;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.sidebar-title,
.sidebar-category {
    color: var(--dark-grey);
    font-size: 15px;
}

.sidebar-category {
    padding-top: 5px;
    font-weight: bold;


}

.color-leadership {
    color: var(--class-blue);
}

.color-technology {
    color: var(--class-green);
}

.color-investment {
    color: var(--class-red);
}

.color-projects {
    color: var(--class-purple);
}

.copied-btn {
    padding-top: 5px;
    background: #bababa;
}

@media screen and (max-width:1500px) {
    .gviptv-main__container {
        margin-left: 1em;
    }

    .main-content__wrapper {
        width: 70%;
    }

    .sidebar-section__wrapper {
        width: 28%;
    }

}

@media screen and (max-width:1250px) {
    .main-content__wrapper {
        width: 65%;
    }

    .sidebar-section__wrapper {
        width: 33%;
    }
}

@media screen and (max-width:1050px) {
    .main-content__wrapper {
        width: 62%;
    }

    .sidebar-section__wrapper {
        width: 35%;
    }

    .youtube-video__container {
        height: 55%;
    }

    .video-title {
        font-size: 18px;
    }

    .video-time {
        font-size: 15px;
    }

    .description-container * *,
    .description-container *,
    .description-container {
        font-size: 14px !important;
    }

    .tv-action-btn {
        width: 120px;
        height: 40px;
        margin-left: .5em;
    }

    .tv-action-btn img {
        height: 20px;
        width: 20px;
        margin-right: .25em;
    }

    .tv-action-btn p,
    .tv-action-btn a {
        font-size: 15px;
    }

    .tv-action-btn p {
        margin-top: 6px
    }

    .sidebar-image__wrapper,
    .sidebar-image__wrapper img {
        width: 200px;
        height: 125px;
    }

    .sidebar-title {
        font-size: 13px;
        font-weight: 400;
    }

    .sidebar-category {
        font-size: 13px;
    }
}

@media screen and (max-width:920px) {
    .gviptv-main__container {
        margin-right: 1em;
        height: fit-content;
        flex-direction: column;
    }


    .main-content__wrapper {
        width: 100%;
        margin-bottom: 3em;
    }

    .sidebar-section__wrapper {
        width: 100%;
        height: fit-content;
    }

    .youtube-video__container {
        height: 45vh;
    }

    .video-title {
        font-size: 21px;
    }

    .video-time {
        font-size: 18px;
    }

    .description-container * *,
    .description-container *,
    .description-container {
        font-size: 18px !important;
    }

    .sidebar-image__wrapper,
    .sidebar-image__wrapper img {
        width: 250px;
        height: 175px;
    }

    .sidebar-title {
        font-size: 18px;
    }

    .sidebar-category {
        font-size: 18px;
    }
}

@media screen and (max-width:700px) {
    .video-title {
        font-size: 21px;
    }

    .video-time {
        font-size: 18px;
    }

    .description-container * *,
    .description-container *,
    .description-container {
        font-size: 16px !important;
    }

}

@media screen and (max-width:600px) {
    .buttons-and-desc__wrapper {
        flex-direction: column-reverse;
    }

    .button__wrapper {
        margin-bottom: 2em;
        width: 100%;
        justify-content: space-between;
    }

    .tv-action-btn {
        margin: 0;
        width: 150px;
        height: 50px;

    }

    .tv-action-btn img {
        width: 25px;
        height: 25px;
        margin-right: .5em;
    }

    .tv-action-btn p,
    .tv-action-btn a {
        font-size: 20px;
    }


    .description-container {
        width: 100%;
    }
}

@media screen and (max-width:500px) {

    .sidebar-image__wrapper,
    .sidebar-image__wrapper img {
        width: 200px;
        height: 125px;
    }

    .sidebar-title {
        font-size: 15px;
    }

    .sidebar-category {
        font-size: 15px;
    }
}
</style>
<div class="gviptv-main__container">
    <div class="main-content__wrapper">
        <div class="youtube-video__container">
            <iframe class="embed-youtube-item" src="<?php echo $details['link']; ?>" allowfullscreen></iframe>
        </div>
        <div class="title-and-time__wrapper">
            <p class="video-title"><?php echo $details['title']; ?></p>
            <p class="video-time"> <?php echo $details['created_at'] ?></p>
        </div>
        <div class="buttons-and-desc__wrapper">
            <div class="description-container"><?php echo $details['description']; ?>

            </div>
            <div class="button__wrapper">
                <button onclick="copyText(<?php echo $details['id']; ?>,this);" id='copy-btn' class="tv-action-btn">
                    <img src="https://d2huw5an5od7zn.cloudfront.net/project_svgs/gviptv_svgs/link.svg" class="tv-svg">
                    <p>Copy Link</p>
                </button>
                <button class="tv-action-btn">
                    <img src="https://d2huw5an5od7zn.cloudfront.net/project_svgs/gviptv_svgs/undo.svg" class="tv-svg">
                    <a href="https://www.gvip.io/gviptv">Go Back</a>
                </button>
            </div>
        </div>
    </div>
    <div class="sidebar-section__wrapper">

    </div>


</div>
<script>
const timeSplit = document.querySelector('.video-time');
console.log(timeSplit.innerHTML.split(' '))
timeSplit.innerHTML = timeSplit.innerHTML.split(' ')[1];

function copyText(id, element) {
    var dummy = document.createElement("textarea");
    document.body.appendChild(dummy);
    dummy.value = `https://www.gvip.io/gviptv/view/${id}`;
    element.innerHTML = ` <p>COPIED</p>`
    element.classList.add('copied-btn')
    dummy.select();
    document.execCommand("copy");
    document.body.removeChild(dummy);
    setTimeout(() => {
        element.innerHTML = `  <img src="https://d2huw5an5od7zn.cloudfront.net/project_svgs/gviptv_svgs/link.svg" class="tv-svg">
                    <p>Copy Link</p>`
        element.classList.remove('copied-btn');
    }, 1550)
}



<?php
    echo 'const hardcodedData = [';

    foreach($rows as $videos){
        if ( $details['id'] != $videos['id']){

            echo "{head: \"".$videos['title']."\",";
            echo "body: `".$videos['description']."`,";
            echo "type: \"".$videos['category']."\",";
            echo "videoUrl: \"".$videos['link']."\",";
            echo "category:  \"".$videos['category']."\",";
            echo "id: \"".$videos['id']."\",";
            echo "imageUrl: \"".$videos['thumbnail']."\"},";

        }
    }

    echo ']';

    ?>

function populate() {

    const sidebarContainer = document.querySelector('.sidebar-section__wrapper');
    sidebarContainer.innerHTML = '';
    hardcodedData.forEach(el => {
        sidebarContainer.innerHTML += `
        <a href="/gviptv/view/${el.id}" class="sidebar-video__container">
            <div class="sidebar-image__wrapper">
                <img src="${el.imageUrl}">
            </div>

            <div class="sidebar-text__wrapper">
                <p class="sidebar-title">${el.head}</p>
                <p class="sidebar-category color-${el.category.toLowerCase()}">${el.category}</p>
            </div>
        </a>
        `;
    })
}

window.addEventListener('load', populate)
</script>