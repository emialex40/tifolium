<?php

get_header();

?>

<section class="post">
    <div class="container">
        <div class="row">
            <div class="col-12">
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