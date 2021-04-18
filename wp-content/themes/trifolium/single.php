<?php

get_header();

$id = get_the_ID();
$image = get_the_post_thumbnail_url($id);

?>

    <section class="post">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="post-image" style="background-image: url(<?php echo $image; ?>);"></div>
                </div>
                <div class="col-12 post-header">
                    <h1 class="title"><?php the_title(); ?></h1>
                </div>
            </div>
            <div class="row post-content">
                <div class="col-12">
                    <article class="content">
                        <?php the_content(); ?>
                    </article>
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>