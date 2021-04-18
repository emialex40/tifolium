<?php

get_header();

$queried_object = get_queried_object();
$taxonomy = $queried_object->taxonomy;
$term_id = $queried_object->term_id;
$slug = $queried_object->slug;

//$term_name
$image = get_field('cat_img', $taxonomy . '_' . $term_id);
$text = get_field('cat_text', $taxonomy . '_' . $term_id);

$args = [
    'post_type' => 'service',
    'post_status' => 'publish',
    'order' => 'ASC',
    'posts_per_page' => -1,
    'tax_query' => [
        [
            'taxonomy' => $taxonomy,
            'field' => 'id',
            'terms' => $term_id
        ]
    ]
];

$query = new WP_Query($args);

?>
<section class="services_cat">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="title"><?php echo single_cat_title(); ?></h1>
            </div>
        </div>
        <div class="row services_cat-content">
            <div class="col-lg-8 col-12">
                <div class="services_cat-img">
                    <?php if ( $image ) : ?>
                    <img src="<?php echo $image; ?>" alt="<?php echo single_cat_title(); ?>">
                    <?php endif; ?>
                </div>
                <article class="content services_cat-text">
                    <?php echo $text; ?>
                </article>
            </div>
            <div class="col-lg-4 col-12">
                <div class="services_cat-wrapper">
                    <?php
                    if (have_posts()) :
                        while (have_posts()) :
                            the_post();
                            ?>
                            <a href="<?php the_permalink(); ?>">
                                <h5 class="services_cat-posts"><?php the_title(); ?></h5>
                            </a>
                        <?php
                        endwhile;
                    endif;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>


<?php get_footer(); ?>
