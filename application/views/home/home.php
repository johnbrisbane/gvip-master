<style>
* {
    overflow-x: hidden;
    margin: 0;
    padding: 0;
}

:root {

    --blue-background: #005268;
    --small-brdradius: 5px;
    --big-brdradius: 15px
}


.hero-image {
    position: relative;
    height: 600px;
}

video {
    object-fit: cover;
    position: absolute;
    width: 100vw;
    height: 100%;
    z-index: 1 !important;
    top: 0;
    left: 0;
}

.wrap {
    position: relative;
    width: 100%;
    height: 100%;
    z-index: 2;
    background: rgba(0, 0, 0, 0.4);
}

@media screen and (max-width:540px) {
    .head-cta {
        display: flex !important;
        justify-content: center !important;
    }
}

/* GVIPTV VIDEOS SECTION */

body * {
    overflow-y: hidden;
}

.main-content__container {

    background-color: var(--blue-background);
}

.svg-container {
    height: 25vh;
    clip-path: polygon(100% 0%,
            0% 0%,
            0% 65%,
            1% 64.95%,
            2% 64.8%,
            3% 64.6%,
            4% 64.3%,
            5% 63.9%,
            6% 63.45%,
            7% 62.9%,
            8% 62.25%,
            9% 61.55%,
            10% 60.8%,
            11% 59.95%,
            12% 59.05%,
            13% 58.1%,
            14% 57.1%,
            15% 56.05%,
            16% 55%,
            17% 53.9%,
            18% 52.8%,
            19% 51.65%,
            20% 50.5%,
            21% 49.35%,
            22% 48.2%,
            23% 47.05%,
            24% 45.9%,
            25% 44.8%,
            26% 43.75%,
            27% 42.75%,
            28% 41.75%,
            29% 40.8%,
            30% 39.9%,
            31% 39.1%,
            32% 38.35%,
            33% 37.65%,
            34% 37.05%,
            35% 36.5%,
            36% 36.05%,
            37% 35.65%,
            38% 35.35%,
            39% 35.15%,
            40% 35.05%,
            41% 35%,
            42% 35.05%,
            43% 35.2%,
            44% 35.45%,
            45% 35.75%,
            46% 36.15%,
            47% 36.65%,
            48% 37.2%,
            49% 37.85%,
            50% 38.55%,
            51% 39.35%,
            52% 40.2%,
            53% 41.1%,
            54% 42.05%,
            55% 43.05%,
            56% 44.1%,
            57% 45.15%,
            58% 46.3%,
            59% 47.4%,
            60% 48.55%,
            61% 49.7%,
            62% 50.85%,
            63% 52%,
            64% 53.15%,
            65% 54.25%,
            66% 55.35%,
            67% 56.4%,
            68% 57.45%,
            69% 58.4%,
            70% 59.35%,
            71% 60.2%,
            72% 61.05%,
            73% 61.8%,
            74% 62.45%,
            75% 63.05%,
            76% 63.6%,
            77% 64.05%,
            78% 64.4%,
            79% 64.7%,
            80% 64.85%,
            81% 65%,
            82% 65%,
            83% 64.9%,
            84% 64.75%,
            85% 64.5%,
            86% 64.2%,
            87% 63.75%,
            88% 63.25%,
            89% 62.7%,
            90% 62.05%,
            91% 61.3%,
            92% 60.5%,
            93% 59.65%,
            94% 58.75%,
            95% 57.8%,
            96% 56.8%,
            97% 55.75%,
            98% 54.65%,
            99% 53.55%,
            100% 52.4%);
    background: var(--blue-background);
}

.splash-text {
    height: fit-content;
    overflow-y: hidden;
    font-size: 36px;
    display: block;
    width: 90%;
    margin: 2em auto;
    padding-bottom: 10px;
}

.white-text {
    color: white;
}

.blue-text {
    margin-top: 0;
    color: var(--blue-background);
}

.sign-link {
    color: white;
    text-decoration: underline;
    font-weight: bolder;
}

.sign-link:hover {
    color: #55c0e9;
    transition: 300ms ease-in-out;
}

.center {
    text-align: center;
}

.gviptv-videos__container {
    height: 40vh;
    display: flex;
    flex-direction: row;
    justify-content: space-evenly;
}

.single-card {
    background: white;
    width: 30%;
    height: 100%;
    border-radius: var(--big-brdradius);
}

.single-card:hover {
    transition: 300ms ease-in-out;
    cursor: pointer;
    transform: scale(1.05);
}

.gviptv-image {
    height: 70%;
    width: 100%;
    background: lightgrey;

}

.gviptv-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.gviptv-info__container {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: row;
    height: 30%;
}

.category-svg {
    width: 25%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}

.category-svg img {
    width: 80%;
    height: 80%;
    object-fit: scale-down;
}

.gviptv-name {
    display: flex;
    width: 75%;
    font-size: 24px;
    color: var(--blue-background);
}

/* PROJECTS AND EXPERTS SECTION */
.projects-experts__section {
    margin-bottom: 2em;
    background: #F1F1F3;
}

.projects-experts__container {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    height: 90%;

}

.single-section {
    padding: 2em 1em 1em 1em;
    width: 40%;
    border-radius: var(--big-brdradius);
    height: 100%;
    background: #e1e1e1
}

.section-header {
    text-align: center;
    color: var(--blue-background);
    font-size: 30px;
    padding-bottom: 5px;

}

.single-project-row {
    height: 150px;
    margin-top: 2em;
    display: flex;
    flex-direction: row;
}

.project-img {
    width: 150px;
    height: 150px;
    border-radius: 50%;
}

.single-project-info {
    margin-left: 2em;
    width: 70%;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.project-name {
    margin-bottom: 1em;
    font-size: 1.2em;
    letter-spacing: 1.5px;
}

.project-description {
    color: #555;
}

.project-button {
    width: 30%;
    color: white;
    background: var(--blue-background);
    border: none;
    font-size: 1.2em;
    border-radius: var(--small-brdradius);
    margin-top: 0.25em;
    padding-top: 0.25em;
    margin-bottom: 0.25em;
    padding-bottom: 0.25em;
}

.project-button a {
    width: 100%;
    height: 100%;
    text-decoration: none;
    color: white;
}

.project-button:hover {
    background: #004156;
    transition: 300ms;
}

@media screen and (max-width:1200px) {
    .single-section {
        width: 45%;
    }

    .project-name {
        font-size: 1.05em;
    }

    .project-description {
        font-size: 0.9em;
    }

    .gviptv-name {
        font-size: 18px;
    }
}

@media screen and (max-width:1150px) {
    .single-section {
        width: 49%;
    }
}

@media screen and (max-width:1050px) {
    .splash-text {
        font-size: 24px;
    }

    .section-header {
        font-size: 22px;
    }

    .project-button {
        width: 45%;
    }
}

@media screen and (max-width:875px) {
    .projects-experts__container {
        display: flex;
        flex-direction: column;
        align-items: center;
        height: fit-content;

    }

    .gviptv-name {
        font-size: 16px;
    }

    .single-section {
        margin-bottom: 1em;
        width: 80%;
    }
}

@media screen and (max-width:775px) {
    .project-img {
        border-radius: 10px;
    }

    .gviptv-videos__container {
        height: fit-content;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-evenly;
    }

    .single-card {
        height: 40vh;
        background: white;
        width: 80%;
        margin-bottom: 1.5em;
        border-radius: var(--big-brdradius);
    }
}

@media screen and (max-width:500px) {
    .project-name {
        font-size: 1em;
        margin-bottom: 0.2em;
    }

    .project-description {
        font-size: 0.8em;
    }

    .single-card {
        width: 98%;
    }

    .single-section {
        width: 98%;
    }

    .project-button {
        width: 70%;
    }
}
</style>



<section class="hero-image">
    <video src="https://d2huw5an5od7zn.cloudfront.net/Meet GVIP.mp4" type="video/webm" playsinline autoplay muted
        loop='true' poster="polina.jpg" id="bgvid"></video>
    <div class="wrap">
        <div class="container">
            <div class="headline">
                <h1 class="h1-xl">Build your Membership in the Global Infrastructure Community</h1>
            </div>
            <div class="head-cta">
                <div>
                    <a class="btn std lt-blue" href="/signup">Join for Free</a>
                    <a class="btn std clear play" href="https://youtube.com/watch?v=U_xIrk7P_KY"><span>Watch It in
                            Action</span></a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="gviptv-videos__section">
    <div class="main-content__container">
        <h1 class="splash-text white-text">Meet GVIP. A growing online community of over 2000+ experts and 3000+
            projects updated by owners in real-time. GVIP gets you expertise, visibility, and community. Use GVIP to
            connect directly with decision-makers through messaging and stay up to date on industry trends through our
            24-hour newsfeed feature, updating with new projects, members, exclusive interviews, and more <a
                class="sign-link" href="https://www.gvip.io/login">Sign in/Sign up Free now. </a>
        </h1>
        <h1 class="splash-text center white-text">Top GViPTV Videos For This Week</h1>
        <div class="gviptv-videos__container">
            <a href="https://www.gvip.io/gviptv/view/60" target="_blank" class="single-card">
                <div class="gviptv-image">
                    <img src="https://d2huw5an5od7zn.cloudfront.net/gviptv/images/Toledo-BC.jpg">
                </div>
                <div class="gviptv-info__container">
                    <div class="category-svg">
                        <img src="https://d2huw5an5od7zn.cloudfront.net/project_svgs/investmeant_gviptv.svg">
                    </div>
                    <h1 class="gviptv-name">Toledo & BlueConduit - Fighting Lead Lines with AI
                    </h1>
                </div>
            </a>
            <a href="https://www.gvip.io/gviptv/view/61" target="_blank" class="single-card">
                <div class="gviptv-image">
                    <img src="https://d2huw5an5od7zn.cloudfront.net/gviptv/images/Briq.jpg">
                </div>
                <div class="gviptv-info__container">
                    <div class="category-svg"> <img
                            src="https://d2huw5an5od7zn.cloudfront.net/project_svgs/leadership_gviptv.svg"></div>
                    <h1 class="gviptv-name">Briq - Getting Runaway Projects on Track
                    </h1>
                </div>
            </a>
            <a href="https://www.gvip.io/gviptv/view/41" target="_blank" class="single-card">
                <div class="gviptv-image">
                    <img src="https://d2huw5an5od7zn.cloudfront.net/gviptv/images/nPlan3.jpg">
                </div>
                <div class="gviptv-info__container">
                    <div class="category-svg"> <img
                            src="https://d2huw5an5od7zn.cloudfront.net/project_svgs/leadership_gviptv.svg"></div>
                    <h1 class="gviptv-name">
                        nPlan - Facilitating Projects with AI and Data-aided Public Sector Decision Makers
                    </h1>
                </div>
            </a>
        </div>
    </div>
    <div class="svg-container"></div>
</section>
<section class="projects-experts__section">
    <div class="projects-experts__container">
        <div class="single-section ">
            <h1 class="section-header">Top Projects for This Week</h1>
            <div class="projects-section">
                <div class="single-project-row">
                    <div class="project-img">
                        <img
                            src="https://www.gvip.io/img/content_projects/50a65c037b1245c9ad5e905f053ce613.jpg?crop=1&w=164&h=164&s=d4c53ccc3a99eb53c435c003554cf357">
                    </div>
                    <div class="single-project-info">
                        <div>
                            <h1 class="project-name">Aydin Denizli Highway
                            </h1>
                            <p class="project-description">Aydın-Denizli Highway is one of the parts of the major
                                highway
                                network that will connect two major tourism cities in Turkey, İzmir and Antalya. .....
                            </p>
                        </div>
                        <button class="project-button"><a href="https://www.gvip.io/projects/aydin-denizli-highway"
                                target="_blank">VIEW</a></button>
                    </div>
                </div>

                <div class="single-project-row">
                    <div class="project-img">
                        <img
                            src="https://www.gvip.io/img/content_projects/d902b5e3aab98a26ea82ff638722d85a.png?crop=1&w=164&h=164&s=e753a70f1c4419507044d58d0cd4fb73">
                    </div>
                    <div class="single-project-info">
                        <div>
                            <h1 class="project-name">Lekki Deep Seaport / Tolaram Port@Lekki</h1>
                            <p class="project-description">A multi-purpose, deep water port at the heart of the Lagos
                                Free Trade Zone, Port@Lekki will be one of the most modern ports, supporting the
                                burgeoning trade across...</p>
                        </div>
                        <button class="project-button"><a href="https://www.gvip.io/projects/lekki-deep-seaport"
                                target="_blank">VIEW</a></button>
                    </div>
                </div>

                <div class="single-project-row">
                    <div class="project-img">
                        <img
                            src="https://www.gvip.io/img/content_projects/686a039ef3f2869bd249f4b8437bad2b.jpg?crop=1&w=164&h=164&s=1c4ba7d1472dde590190206cd3873997">
                    </div>
                    <div class="single-project-info">
                        <div>
                            <h1 class="project-name">Icebreaker Wind
                            </h1>
                            <p class="project-description">21MW Icebreaker Wind is a unique wind energy project - the
                                first offshore wind facility in the Great Lakes, the first freshwater wind farm in North
                                America, ...</p>
                        </div>
                        <button class="project-button"><a href="https://www.gvip.io/projects/icebreaker-wind"
                                target="_blank">VIEW</a></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="single-section ">
            <h1 class="section-header">Top Experts for This Week</h1>
            <div class="experts-section">
                <div class="single-project-row">
                    <div class="project-img">
                        <img
                            src="https://www.gvip.io/img/member_photos/7330d372da93a3714bec0fb5d30a1ea6.png?w=140&h=140&s=960fc5e19b7b87056baac8c6400363de">
                    </div>
                    <div class="single-project-info">
                        <div>
                            <h1 class="project-name">Bouroujian has joined GViP!
                            </h1>
                            <p class="project-description">Sosy Bouroujian, Project Manager at OCO Global is now on
                                GViP. They
                                are currently located in Richmond, United States</p>
                        </div>
                        <button class="project-button"><a href="https://www.gvip.io/expertise/4681"
                                target="_blank">PROFILE</a></button>
                    </div>
                </div>
                <div class="single-project-row">
                    <div class="project-img">
                        <img
                            src="https://www.gvip.io/img/member_photos/506eaefc6e9f74a128c60f7b53b322be.jpg?w=140&h=140&s=1b78e654a6f372844ac8de40870c4bba">
                    </div>
                    <div class="single-project-info">
                        <div>
                            <h1 class="project-name">Carruthers has joined GViP!
                            </h1>
                            <p class="project-description">Robin Carruthers, Director at Infrastructure Analysts
                                is now on
                                GViP. They are currently located in Chevy Chase, United States</p>
                        </div>
                        <button class="project-button"><a href="https://www.gvip.io/expertise/4686"
                                target="_blank">PROFILE</a></button>
                    </div>
                </div>
                <div class="single-project-row">
                    <div class="project-img">
                        <img
                            src="https://www.gvip.io/img/member_photos/2320a8e5a808cc63d18d5b30d57abed3.PNG?w=140&h=140&s=a7a7b29e80b707eb45eac1754ab3b77c">
                    </div>
                    <div class="single-project-info">
                        <div>
                            <h1 class="project-name">Deniz Pala has joined GViP!
                            </h1>
                            <p class="project-description">Serdar Deniz Pala, Analyst at Investment Office of the
                                Presidency of Turkey is now on
                                GViP. They are currently located in Turkey </p>
                        </div>
                        <button class="project-button"><a href="https://www.gvip.io/expertise/4679"
                                target="_blank">PROFILE</a></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>


<script src="https://www.youtube.com/iframe_api" async="async"></script>