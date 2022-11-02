<?php
if ($dep == 'DOT') {
    $pagename = 'Department of Transportation (DOT)';
    $pagedesc = 'Central to the vitality of the US infrastructure market, DOT is responsible for highways, roads, transit, air, and transportation safety. Of the 3,600+ projects profiled in CG/LA’s intelligent infrastructure database, GVIP, 1876 are transportation projects, with 570 highways and 530 transit projects, and 206 airport projects. Of the Biden appointments to DOT so far, most have a background in transit. With this Administration’s emphasis on sustainability and reduction of our collective carbon footprint, these leaders are likely to focus on all forms of passenger rail – AMTRAK, commuter rail, and high-speed rail. ';
    $pagephoto = 'https://d2huw5an5od7zn.cloudfront.net/Biden+Admin+photos/drive-download-20210127T173459Z-001/DOT+LOGO.jpg';
}
elseif ($dep == 'DOI') {
    $pagename = 'Department of the Interior (DOI)';
    $pagedesc = 'DOI is responsible for managing America’s vast natural and cultural resources, as well as the cultural heritage of our Native peoples. The promotion of energy security and critical minerals development is especially important for the infrastructure community, as the national security of domestic supply chains is critical to almost every project in development. It also houses the EPA, providing environmental surveillance and compliance, and technical assistance to support recovery planning of public health and infrastructure, such as wastewater treatment plants.';
    $pagephoto = 'https://d2huw5an5od7zn.cloudfront.net/Biden+Admin+photos/drive-download-20210127T173459Z-001/INTERIOR+LOGO.png';
}
elseif ($dep == 'DOC') {
    $pagename = 'Department of Commerce (DOC)';
    $pagedesc = 'By promoting job creation and economic growth, DOC plays a key role in fostering innovation by setting standards and conducting foundational research and development. The past year has laid bare the need to rebuild an economy that is more equitable and more resilient, and these picks signal an emphasis on economic inclusion, with sustainability at the forefront. The 3,600+ GVIP project profiles represent a cumulative $9.3T in total project value across all sectors, and a tremendous opportunity to spur widespread gains in GDP across geographies and socioeconomic groups. ';
    $pagephoto = 'https://d2huw5an5od7zn.cloudfront.net/Biden+Admin+photos/drive-download-20210127T173459Z-001/COMMERCE+LOGO.png';
}
elseif ($dep == 'DOE') {
    $pagename = 'Department of Energy (DOE)';
    $pagedesc = 'The mission of the Energy Department is to ensure America\'s energy security and prosperity by addressing its energy, environmental and nuclear challenges, typically through policy, regulation, and science and technology solutions. Of the 667 energy projects in GVIP, 51 are petro-based, 130 wind, 152 solar, and 125 hydro. Sustainability is not only a core directive across all departments of the Biden Administration, but new technologies being developed in the energy sector trend as sustainable by default. ';
    $pagephoto = 'https://d2huw5an5od7zn.cloudfront.net/Biden+Admin+photos/drive-download-20210127T173459Z-001/DOE+LOGO.png';
}
elseif ($dep == 'USDA') {
    $pagename = 'Department of Agriculture (USDA)';
    $pagedesc = 'USDA provides leadership on food, agriculture, natural resources, rural development, nutrition, and related issues based on public policy, the best available science, and effective management. They also house the office of Rural Development and the Rural Utilities Service, which provides financing to build or improve infrastructure in rural communities. This includes water and waste treatment, electric power and telecommunications services. There are currently 45 telecommunications projects in GVIP.';
    $pagephoto = 'https://d2huw5an5od7zn.cloudfront.net/Biden+Admin+photos/drive-download-20210127T173459Z-001/USDA+LOGO.png';
}
elseif ($dep == 'DOL') {
    $pagename = 'Department of Labor (DOL)';
    $pagedesc = 'With weekly unemployment claims around 1M, 2021 begins with the worst jobs market in modern American history. The DOL will be responsible for ensuring workers have the necessary skills, training, and opportunities to keep American workers employed and able to earn living wages. With GVIP projects representing over 25M jobs over the next decade, a focus on infrastructure would be a catalyst for opportunity creation. ';
    $pagephoto = 'https://d2huw5an5od7zn.cloudfront.net/Biden+Admin+photos/drive-download-20210127T173459Z-001/LABOR+LOGO.png';
}
elseif ($dep == 'WHEO') {
    $pagename = 'White House Executive Office of the President';
    $pagedesc = 'To provide the President with the support that he needs to govern effectively, the Executive Office of the President (EOP) has responsibility for tasks ranging from communicating the President’s message to the American people to promoting our trade interests abroad. They also play an important role in setting economic and technological priorities from a centralized location. ';
    $pagephoto = 'https://d2huw5an5od7zn.cloudfront.net/Biden+Admin+photos/drive-download-20210127T173459Z-001/EXEC+OFFICE+OF+PRESIDENT+LOGO.png';
}
elseif ($dep == 'SBA') {
    $pagename = 'Small Business Administration (SBA)';
    $pagedesc = 'Protecting the interests of small business concerns, the SBA strengthens the American economy by preserving free competitive enterprise. Of the 3,000+ GVIP projects, most create opportunities for small business involvement through contracting, subcontracting, and supplier relationships. These small-, medium-, and large-scale infrastructure projects all have roles for small businesses  to play in the feasibility, development, design, engineering, construction, and operational phases. ';
    $pagephoto = 'https://d2huw5an5od7zn.cloudfront.net/Biden+Admin+photos/drive-download-20210127T173459Z-001/SBA-PoweredBy-FINAL_1.png';
}
?>

<?php
function aasort (&$array, $key) {
    $sorter=array();
    $ret=array();
    reset($array);
    foreach ($array as $ii => $va) {
        $sorter[$ii]=$va[$key];
    }
    asort($sorter);
    foreach ($sorter as $ii => $va) {
        $ret[$ii]=$array[$ii];
    }
    $array=$ret;
}

?>

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>TheEvent Bootstrap Template - Index</title>
    <meta content="" name="descriptison">
    <meta content="" name="keywords">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="https://d2huw5an5od7zn.cloudfront.net/onlineforum/assets/vendor/bootstrap/css/bootstrap.min.css"
        rel="stylesheet">
    <link href="https://d2huw5an5od7zn.cloudfront.net/onlineforum/assets/vendor/venobox/venobox.css" rel="stylesheet">
    <link href="https://d2huw5an5od7zn.cloudfront.net/onlineforum/assets/vendor/font-awesome/css/font-awesome.min.css"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="https://d2huw5an5od7zn.cloudfront.net/onlineforum/assets/vendor/bootstrap/css/bootstrap.min.css"
        rel="stylesheet">
    <link href="https://d2huw5an5od7zn.cloudfront.net/onlineforum/assets/vendor/venobox/venobox.css" rel="stylesheet">
    <link href="https://d2huw5an5od7zn.cloudfront.net/onlineforum/assets/vendor/font-awesome/css/font-awesome.min.css"
        rel="stylesheet">
    <link
        href="https://d2huw5an5od7zn.cloudfront.net/onlineforum/assets/vendor/owl.carousel/assets/owl.carousel.min.css"
        rel="stylesheet">
    <link href="https://d2huw5an5od7zn.cloudfront.net/onlineforum/assets/vendor/aos/aos.css" rel="stylesheet">


    <!-- Template Main CSS File -->
    <link href="https://d2huw5an5od7zn.cloudfront.net/onlineforum/assets/css/style.css" rel="stylesheet">
    <link href='https://d2huw5an5od7zn.cloudfront.net/onlineforum/assets/css/premium_view.css' rel="stylesheet">
    <!-- =======================================================
            * Template Name: TheEvent - v2.2.0
            * Template URL: https://bootstrapmade.com/theevent-conference-event-bootstrap-template/
            * Author: BootstrapMade.com
            * License: https://bootstrapmade.com/license/
            ======================================================== -->
</head>
<style>
:root {
    --blue-background: #005268;
    --purple-blue-text: #0E1B4D;
}

.biden-admin-page {
    width: 100%;
    height: 89%;
    margin: 0;
}

.banner-image-container {
    position: relative;
    width: 100%;
    height: 20%;

}

.banner-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.sides-container {
    margin-top: 1rem;
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    height: 80%;
}

.single-side {
    background: white;
    border: 0.1px solid rgba(28, 28, 28, 0.1);
    border-radius: 10px;
    box-shadow: 0 4px 5px 0 rgb(0 0 0 / 14%), 0 1px 10px 0 rgb(0 0 0 / 12%), 0 2px 4px -1px rgb(0 0 0 / 30%);

}

.resp-depinfo-btn {
    display: none;
}

.resp-depexp-btn {
    display: none;
}

.first-side {
    width: 70%;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.main-info__container {
    height: 27%;
    display: flex;
    flex-direction: row;
    align-items: center;
}

.logo__container {
    position: relative;

    height: 100%;
    width: auto;
    max-width: 20%;

}

.logo-image {
    background: white;
    width: 100%;
    height: 100%;
    object-fit: scale-down;
}

.title-text {
    color: var(--purple-blue-text);
    font-size: 4rem;
    font-weight: bolder;
}

.second-side {
    width: 29%;
    height: 100%;
}

.dep-infotext {
    text-align: center;
    background-color: var(--blue-background);
    color: white;
    font-size: 3rem;
    font-weight: bold;
    padding: 0.3em 0;
    border-radius: 10px 10px 0 0;
}

.infotext-body {
    margin-top: 0.75em;
    padding: 0 0.5em;
    color: var(--purple-blue-text);
    font-weight: medium;
}

.dep-experts__container {
    height: 71%;

    overflow-y: scroll;
}

.single-expert__container {
    margin: 1em 0;
    height: 60%;
    background: var(--blue-background);
    border-radius: 10px;
    display: flex;

    flex-direction: row;
}

.expert-logo__container {

    display: flex;
    justify-content: flex-start;
    align-items: flex-start;
    width: 20%;
    height: 100%;
}

.expert-logo__image {

    object-fit: cover;
    width: 100%;
    height: 100%;
}

.single-expert__informtaion {
    margin-left: 1em;
    width: 76%;
}

.expert-name__container {
    margin: 0.5em 0;
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
}

.expert-name {
    width: 70%;
    color: white;
}

.expert-name div:first-of-type {

    font-size: 3.5rem;
    letter-spacing: 2.5px;
    font-weight: bold;

}

.expert-name div:last-of-type {
    font-size: 3rem;

    font-weight: medium;
}


.expert-button {
    text-align: center;
    width: 25%;
    border-radius: 40px;
    outline: none;
    border: none;
    font-size: 3rem;
    color: var(--purple-blue-text) !important;
    font-weight: medium;
    position: relative;
    overflow: hidden;
    z-index: 1;
}

.expert-button:after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: white;
    border-radius: 40px;
    z-index: -2;
}

.expert-button:before {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0%;
    height: 100%;
    background-color: #ccc;
    transition: all .3s;
    border-radius: 40px;
    z-index: -1;
}

.expert-button:hover:before {
    width: 100%;
}

.expert-information {
    font-weight: medium;
    color: white;
    height: fit-content !important;
    font-size: 2rem;
    margin-bottom: 1em;
}

@media screen and (max-width:1650px) {
    .infotext-body {
        font-size: 2rem;
    }


    .expert-name div:first-of-type {
        font-size: 3.1rem
    }

    .expert-name div:last-of-type {
        font-size: 2.7rem;
    }

    .expert-button {
        width: 21%;
        font-size: 2.7rem;
    }

    .expert-information {
        font-size: 1.7rem;
    }
}

@media screen and (max-width:1250px) {
    .dep-infotext {
        font-size: 2.4rem;
    }

    .infotext-body {
        font-size: 1.6rem;
    }


    .expert-name div:first-of-type {
        font-size: 2.7rem
    }

    .expert-name div:last-of-type {
        font-size: 2.3rem;
    }

    .expert-button {
        width: 20%;
        font-size: 2.3rem;
    }

    .expert-information {
        font-size: 1.5rem;
    }
}

@media screen and (max-width:750px) {

    .resp-depinfo-btn {
        display: block;
        width: 50%;
        margin: auto;
        text-align: center;
        color: var(--blue-background);
        font-size: 1.5rem;
        font-weight: bold;
        border-radius: 15px;
        padding: 0.5em 0;
        border: 3px solid var(--blue-background);
    }

    .resp-depinfo-btn:hover {
        color: white;
        background: var(--blue-background);
    }

    .first-side {
        width: 100%;
    }

    .second-side {
        display: none;
    }


    .resp-depexp-btn {
        display: block;
        width: 50%;
        margin: auto 2em;
        text-align: center;
        color: var(--blue-background);
        font-size: 1.5rem;
        font-weight: bold;
        border-radius: 15px;
        padding: 0.5em 0;
        border: 3px solid var(--blue-background);
    }

    .resp-depexp-btn:hover {
        color: white;
        background: var(--blue-background);
    }


}


@media screen and (max-width:550px) {
    .banner-image-container {
        position: relative;
        width: 100%;
        height: 10%;

    }

    .main-info__container {
        align-items: flex-start;
    }

    .logo-image {
        height: initial;
    }

    .title-text {
        font-size: 3rem;
    }

    .expert-name div:first-of-type {
        font-size: 2rem;
    }

    .expert-name div:last-of-type {
        font-size: 1.8rem;
    }

    .expert-information {
        font-size: 1.3rem;
    }
}

@media screen and (max-width:460px) {
    .resp-depinfo-btn {
        width: 80%;
    }

    .resp-depexp-btn {
        width: 80%;
    }

    .single-expert__container {
        flex-direction: column;
        height: fit-content;
        width: 100%;
    }

    .expert-logo__container {
        width: 100%;
        height: 100%;
    }

    .single-expert__informtaion {
        width: 95%;
    }

    .expert-name__container {
        margin: 1em 0;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .expert-name {
        width: 100%;
        color: white;
    }

    .expert-button {
        align-self: flex-end;
        margin-right: 0.5em;
        width: 40%;
    }

    .expert-information {
        font-size: 1.7rem;
    }

}
</style>
<!-- Footer Banner -->

<main id="main" class="premium-main-page biden-admin-page">
    <div class="banner-image-container">
        <a href="https://www.cg-la.com/store/p/gvip-annual-institutional-account-public-sector">
            <img src="https://d2huw5an5od7zn.cloudfront.net/skinny_banner.jpg" class="banner-image" />
        </a>
    </div>
    <div class="sides-container">
        <div id="dep-experts__container" class="single-side first-side">
            <div class="main-info__container">
                <div class="logo__container">
                    <img src="<?php echo $pagephoto?>" alt="<?php echo $dep?>" class="logo-image">
                </div>

                <h1 class="title-text"><?php echo $pagename; ?></h1>
            </div>
            <button id="open-depinfo" class="resp-depinfo-btn">Department Information</button>
            <div class="dep-experts__container">
                <!-- ARRAY OF DEPARTMENT CONTRACTS -->




                <?php
                $index = 0;
                if (count($users) > 0) {
                    aasort($users,"photo");
                    $users= array_reverse($users);
                    foreach($users as $key=> $val) {

                        $fullname = $val['name'];

                        $data = array(
                            'url' => base_url() . 'expertise/biden_admin/' . $val['lastname'],
                            'image' => array(
                                'url' => $val['photo'],
                                'alt' => $fullname . ' image'
                            ),
                            'title' => $val['position'] ,
                            'name' => '<strong>' . $fullname . '</strong>',
                            'last' => ($index == 3),
                            'bio' => $val['bio'],
                            'department' => $val['Department']
                        );
                        if ($val['Department'] == $dep && $fullname != 'TBD' && $val['photo'] != null) {
                            $this->load->view('expertise/_list_block_biden', $data);
                        }
                        elseif ($val['Department'] == $dep && $fullname != 'TBD'){
                            ?>
                <div class="single-expert__container">
                    <div class="single-expert__informtaion">
                        <div class="expert-name__container">
                            <h1 class="expert-name">
                                <!-- Name -->
                                <div><?php echo $data['name']; ?></div>
                                <!-- Title -->
                                <div><?php echo $data['title']; ?></div>
                            </h1>
                        </div>
                    </div>
                </div>
                <?php
                        }
                    }
                } else {
                    echo form_list_empty(lang('NoExpertisedplay'));
                }
                ?>

            </div>
        </div>


        <!-- DEPARTMENT INFORMATION -->
        <div id="dep-info__container" class="single-side second-side">
            <h1 class="dep-infotext">Department Information</h1>
            <button id="close-depinfo" class="resp-depexp-btn">Department Experts</button>
            <h1 class='infotext-body'><?php echo $pagedesc ?></h1>
        </div>
    </div>
</main><!-- End #main -->













<!-- Vendor JS Files -->
<script src="https://d2huw5an5od7zn.cloudfront.net/onlineforum/assets/vendor/jquery/jquery.min.js"></script>
<script src="https://d2huw5an5od7zn.cloudfront.net/onlineforum/assets/vendor/bootstrap/js/bootstrap.bundle.min.js">
</script>
<script src="https://d2huw5an5od7zn.cloudfront.net/onlineforum/assets/vendor/jquery.easing/jquery.easing.min.js">
</script>
<script src="https://d2huw5an5od7zn.cloudfront.net/onlineforum/assets/vendor/php-email-form/validate.js"></script>
<script src="https://d2huw5an5od7zn.cloudfront.net/onlineforum/assets/vendor/venobox/venobox.min.js"></script>
<script src="https://d2huw5an5od7zn.cloudfront.net/onlineforum/assets/vendor/owl.carousel/owl.carousel.min.js"></script>
<script src="https://d2huw5an5od7zn.cloudfront.net/onlineforum/assets/vendor/superfish/superfish.min.js"></script>
<script src="https://d2huw5an5od7zn.cloudfront.net/onlineforum/assets/vendor/hoverIntent/hoverIntent.js"></script>
<script src="https://d2huw5an5od7zn.cloudfront.net/onlineforum/assets/vendor/aos/aos.js"></script>

<!-- Template Main JS File -->
<script src="https://d2huw5an5od7zn.cloudfront.net/onlineforum/assets/js/main.js"></script>
<script>
let isDepartmentInfoOpen = false;

// First and Second slide
const depInfoContainer = document.querySelector('#dep-info__container');
const depExpertsContainer = document.querySelector('#dep-experts__container')
const openBtn = document.querySelector('#open-depinfo');
const closeBtn = document.querySelector('#close-depinfo');
const openOrClose = () => {
    depInfoContainer.style.display = 'block';
    depExpertsContainer.style.display = 'block';

    if (isDepartmentInfoOpen === true) {
        depInfoContainer.style.display = 'none';
        depExpertsContainer.style.width = '100%';
        isDepartmentInfoOpen = false;


    } else if (isDepartmentInfoOpen === false) {
        depInfoContainer.style.width = '100%';
        depExpertsContainer.style.display = 'none';
        isDepartmentInfoOpen = true;

    }

    return;
}
openBtn.addEventListener('click', openOrClose)
closeBtn.addEventListener('click', openOrClose);
</script>