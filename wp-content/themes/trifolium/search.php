<?php

get_header();

$s = get_search_query();
$args = array(
    's' => $s
);

$the_query = new WP_Query($args);
?>

<?php if ($the_query->have_posts()) : ?>
    <section class="post">

        <div class="container">

            <div class="row">
                <div class="col-12">
                    <h3><?php the_field('rezultati_poyska', 'option'); ?>:
                        "<?php echo $s; ?>"</h3>
                </div>
            </div>
            <?php while ($the_query->have_posts()) :
                $the_query->the_post();
                ?>
                <div class="row post-content">
                    <div class="col-12">
                        <article class="content">
                            <h4><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h4>
                            <?php the_excerpt(); ?>
                        </article>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </section>
<?php else : ?>
<section class="post">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3><?php the_field('po_vashemu_zaprosu', 'option'); ?> &laquo; <?php echo $s; ?>	&raquo; <?php the_field('rezultatov_ne_najdeno', 'option'); ?>!</h3>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<?php get_footer(); ?>