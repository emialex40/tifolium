<?php
/**
 *  Template Name: Отзывы
 */
get_header();

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$args = [
    'post_type' => 'reviews',
    'order' => 'ASC',
    'post_status' => 'publish',
    'paged' => $paged,
    'posts_per_page' => 5
];

$query = new WP_Query($args);

?>

    <section class="reviews">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="title"><?php the_title(); ?></h1>
                </div>
            </div>
            <?php if ($query->have_posts()) : ?>
                <div class="row">
                    <div class="col-12 reviews-wrapper">
                        <?php while ($query->have_posts()) :
                            $query->the_post();
                            ?>
                            <div class="reviews-item">
                                <h4 class="reviews-title"><?php the_title(); ?></h4>
                                <span class="reviews-date"><?php echo get_the_date('d.m.Y'); ?></span>
                                <div class="content reviews-text">
                                    <?php the_content(); ?>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                    <div class="col-12">
                        <div class="paged">
                            <?php theme_pagination($query->max_num_pages); ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>

<?php get_footer(); ?>