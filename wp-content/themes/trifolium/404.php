<?php
get_header();
?>

<section class="not_found">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="not_found_center">
                    <div class="not_found_main">404</div>
                    <p>Данная страница не найдена</p>
                    <a href="<?php echo get_home_url('/'); ?>">На главную</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>