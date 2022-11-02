<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
<style>
    hr {
        border-top: 1px solid #007bff;
        width:70%;
    }

    a {color: #000;}


    .card{
        background-color: #FFFFFF;
        padding:0;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        border-radius:4px;
        box-shadow: 0 4px 5px 0 rgba(0,0,0,0.14), 0 1px 10px 0 rgba(0,0,0,0.12), 0 2px 4px -1px rgba(0,0,0,0.3);
    }


    .card:hover{
        box-shadow: 0 16px 24px 2px rgba(0,0,0,0.14), 0 6px 30px 5px rgba(0,0,0,0.12), 0 8px 10px -5px rgba(0,0,0,0.3);
        color:black;
    }

    address{
        margin-bottom: 0px;
    }




    #author a{
        color: #fff;
        text-decoration: none;

    }
</style>

<?php
if (count($rows) > 0) {
    ?>
    <div class="space-2 bg-light">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <?php foreach($rows as $members) {
                    $url = '/expertise/' . $members['uid'];
                    ?>


                    <div class="col-lg-4 col-md-4 col-sm-4" style="padding-top: 5px; padding-right: 5px; padding-left: 5px">
                        <!-- Card -->
                        <div class="card border-0 shadow" style="overflow: hidden">
                            <!-- Card image -->
                            <div class="view ">
                                <a href="<?php echo $url ?>">
                                    <img class="card-img-top rounded-top" loading="lazy" src="<?php echo expert_image($members['userphoto'], 500); ?>" alt="Card image cap">
                                    <div class="mask rgba-white-slight"></div>
                                </a>
                            </div>
                            <!-- Card content -->
                            <div class="card-body border rounded-bottom" style="display:inline-block; white-space: nowrap; text-overflow: ellipsis; overflow: hidden;">
                                <a class="card-text small mb-2 d-block"><?php echo $members['organization']; ?></a>
                                <!-- Title --><a href="<?php echo $url; ?>" class="h5 card-title"><?php echo $members['firstname'] . ' ' . $members['lastname']; ?></a>
                                <!-- Description -->
                                <p><?php echo $members['country'] ?></p>
                                <hr>
                                <ul class="list-unstyled d-flex mb-3 text-left small">
                                    <li class="pledged">
                                        <p class="mb-1 font-weight-bold text-dark">Organization</p>
                                        <span class="amount"><?php echo $members['organization'];?> </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- Card -->
                    </div>
                    <!-- end col -->


                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    <?php
}
?>
