<?php
/**
 *  Template Name: FAQ
 */
get_header();

$args = [
    'post_type' => 'qustions',
    'order' => 'ASC',
    'post_status' => 'publish',
    'posts_per_page' => -1
];

$query = new WP_Query($args);
?>

    <section class="faq">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="title"><?php the_title(); ?></h1>
                </div>
                <?php
                if ($query->have_posts()) :
                    $count = 0;
                    ?>
                    <div class="col-12 faq-wrapper">
                        <?php while ($query->have_posts()) :
                            $query->the_post();
                            $count++;
                            $active = ($count === 1) ? ' open' : '';
                            $show = ($count === 1) ? ' style="display: block;"' : '';
                            ?>
                            <div class="faq-item<?php echo $active; ?>">
                                <h4 class="faq-header">
                                    <i class="fas fa-angle-down"></i> <span><?php the_title(); ?></span>
                                </h4>
                                <div class="content faq-content" <?php echo $show; ?>><?php the_content(); ?></div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php endif;
                wp_reset_postdata(); ?>
            </div>
        </div>
    </section>

<?php get_footer(); ?>