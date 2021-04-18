<?php
/**
 *   Template Name: Статьи
 */

get_header();


$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$args = [
    'post_type' => 'post',
    'order' => 'DESC',
    'post_status' => 'publish',
    'paged' => $paged,
    'posts_per_page' => 9,
    'tax_query' => array(
        'relation' => 'AND',
        array(
            'taxonomy' => 'category',
            'field' => 'id',
            'terms' => 16
        )
    )
];

$query = new WP_Query($args);

?>

    <section class="articles">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="title"><?php the_title(); ?></h1>
                </div>
                <?php if ($query->have_posts()) : ?>
                    <div class="col-12">
                        <div class="articles-grid">
                            <?php while ($query->have_posts()) :
                                $query->the_post();
                                $id = get_the_ID();
                                $image = get_the_post_thumbnail_url($id, 'gallery-thumb');
                                ?>
                                <article class="articles-item">
                                    <a href="<?php the_permalink(); ?>" class="articles-image">
                                        <img src="<?php echo $image; ?>" alt="<?php the_title(); ?>">
                                    </a>
                                    <div class="articles-text">
                                        <h4 class="articles-title"><a
                                                    href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                        <?php the_excerpt(); ?>
                                        <a class="articles-more"
                                           href="<?php the_permalink(); ?>"><?php the_field('chytat_dalshe', 'option'); ?>
                                            <i class="fas fa-angle-right"></i></a>
                                    </div>
                                </article>
                            <?php endwhile; ?>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="paged">
                            <?php theme_pagination($query->max_num_pages); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>


<?php get_footer(); ?>