<?php
/**
 *  Template Name: Услуги
 */

get_header();

?>

    <section class="services">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="title"><?php the_title(); ?></h1>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="services-wrapper">
                        <?php
                        $args = [
                            'taxonomy' => 'service_cats',
                            'orderby' => 'id', // здесь по какому полю сортировать
                            'order' => 'DESC',
                            'hide_empty' => false, // скрывать категории без товаров или нет
                            'exclude' => array(),
                            'parent' => 0 // id родительской категории
                        ];

                        $terms = get_terms($args);

                        foreach ($terms as $term) :
                            $taxonomy = $term->taxonomy;
                            $term_id = $term->term_id;
                            $name = $term->name;
                            $term_link = get_term_link($term_id, $taxonomy)
                            ?>
                            <a href="<?php echo $term_link; ?>" class="services-item">
                                <div class="services-item_icon">
                                    <?php echo get_field('cat_icon', 'term_' . $term_id); ?>
                                </div>
                                <h4 class="services-item_title"><?php echo $name; ?></h4>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?php if (get_the_content()) : ?>
                <div class="row services-content">
                    <div class="col-12 content">
                        <?php the_content(); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

    </section>

<?php get_footer(); ?>