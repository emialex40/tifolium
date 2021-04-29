<?php
/**
 *   Template Name: Thank You Page
 **/
get_header();
?>

<section class="thankyou">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="thankyou_wrapper">
                    <h1><?php the_title(); ?></h1>
                    <?php the_content(); ?>
                    <a href="<?php echo get_home_url(); ?>"><i class="fas fa-home"></i>  <?php the_field('na_glavnuyu', 'option'); ?></a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>