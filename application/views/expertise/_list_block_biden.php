<?php
/**
 * Renders a list view block (e.g. for projects, experts, forums ...)
 *
 * @var boolean $last Is it a last block in a row
 * @var string $url A link url to the entity being displayed
 * @var array $image (array('url' => '/path/to/image.jpg', 'alt' => 'alt text', 'pad' => 1))
 * @var string $title Entity's title
 * @var array $properties Entity's properties
 **/


?>
<div class="single-expert__container">
    <a href="" class="expert-logo__container">
        <!-- Contract logo -->
        <img src="<?php echo $image['url']; ?>"
             class="expert-logo__image">
    </a>
    <div class="single-expert__informtaion">
        <div class="expert-name__container">
            <h1 class="expert-name">
                <!-- Name -->
                <div><?php echo $name; ?></div>
                <!-- Title -->
                <div><?php echo $title; ?></div>
            </h1>
            <!-- View Contract -->
        </div>

        <!-- Contract information -->
        <h1 class="expert-information">
            <?php echo $bio; ?>
        </h1>



    </div>
</div>

