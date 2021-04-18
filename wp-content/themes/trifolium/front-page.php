<?php
    get_header('home');

    $id = get_the_ID();
    $bg_img = get_the_post_thumbnail_url($id, 'full');

?>

<!-- TODO: hero section beginning-->
<section class="front front_home" style="background-image: url(<?php echo $bg_img ?>); height: 100vh;">
    <div class="container">
        <div class="row">
            <div class="col-12 front_wrapper">
                <div class="front_icons">
                    <?php 
                    $iso = get_field('ikonki_iso', 'option');
                    
                    foreach ( $iso as $icon ) :
                ?>
                    <div class="front_icon">
                        <img src="<?php echo $icon['dobavit_ikonku']; ?>" alt="ISO Icon">
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- hero section end -->




<?php get_footer(); ?>
