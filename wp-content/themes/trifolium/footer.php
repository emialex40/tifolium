<?php
$footer_logo = get_field('footer_logo', 'option');
$footer_phone = get_field('phone', 'option');
$footer_email = get_field('email', 'option');
$menu = wp_get_nav_menu_items('Header Menu', array());
$children1 = true_get_nav_menu_children_items(15, $menu, 0);
$children2 = true_get_nav_menu_children_items(19, $menu, 0);
?>

</main>
</div>
</div>
</div>

<footer id="footer" class="footer <?php echo (is_front_page()) ? ' footer_home' : ''; ?>">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="footer_wrapper">
                    <p class="copyright">Copyraight &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>.
                        <?php the_field('copyright', 'option'); ?>.</p>
                    <div class="footer_social">
                        <?php
                        $socials = get_field('soczialnye_seti', 'option');

                        foreach ($socials as $social) :
                            ?>
                            <a class="footer_social_icon"
                               href="<?php echo $social['soc_link']; ?>"><?php echo $social['klass_ikonki']; ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<div id="mobile_menu" class="mobile_menu ">
    <div class="mobile_menu_info">
        <div class="mobile_menu_search">
            <?php get_search_form(); ?>
        </div>
        <?php $phone = get_field('telefon', 'option'); ?>
        <a href="<?php echo phone_format($phone); ?>"><i class="fas fa-phone"></i>
            <?php echo $phone; ?></a>
        <a href="mailto:<?php the_field('e-mail', 'option'); ?>"><i class="far fa-envelope"></i>
            <?php the_field('e-mail', 'option'); ?></a>
    </div>
    <nav class="mob_menu">
        <?php if (has_nav_menu('header_menu')) {
            wp_nav_menu(array(
                'theme_location' => 'header_menu',
                'menu_class' => 'mob_menu_links_mob',
                'container' => '',
                'container_class' => '',
                'menu_id' => 'mob_menu_links_mob',
                'depth' => 0,
                'walker' => new Main_Submenu_Class()));
        } ?>
    </nav>
</div>
<div class="bg "></div>
<script>
    var ajax_web_url = '<?php echo admin_url('admin-ajax.php', 'relative') ?>';
</script>


<?php wp_footer(); ?>
</body>

</html>
