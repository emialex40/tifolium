<!DOCTYPE HTML>
<html>

<head <?php language_attributes(); ?>>
    <?php if (!isset($_SERVER['HTTP_USER_AGENT']) || stripos($_SERVER['HTTP_USER_AGENT'], 'Lighthouse') === false) : ?>
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','GTM-P3XXD64');</script>
        <!-- End Google Tag Manager -->
    <?php endif; ?>
    <title><?php wp_title(''); ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <?php

    $favicon = get_option('theme_favicon');
    $logo = get_field('logo_inside', 'option');
    ?>

<!--    <meta name='apple-itunes-app' content='app-id=myAppStoreID'>-->
    <link rel="icon" href="<?php print $favicon; ?>" type="image/x-icon"/>
    <link rel="shortcut icon" href="<?php print $favicon; ?>" type="image/x-icon"/>

    <?php if (!isset($_SERVER['HTTP_USER_AGENT']) || stripos($_SERVER['HTTP_USER_AGENT'], 'Lighthouse') === false) : ?>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
              integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
              crossorigin="anonymous"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css"
              integrity="sha512-H9jrZiiopUdsLpg94A333EfumgUBpO9MdbxStdeITo+KEIMaNfHNvwyjjDJb+ERPaRS6DpyRlKbvPUasNItRyw=="
              crossorigin="anonymous"/>

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-194465821-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }

            gtag('js', new Date());

            gtag('config', 'UA-194465821-1');
            gtag('config', 'AW-382441342');
        </script>
    <?php endif; ?>

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php if (!isset($_SERVER['HTTP_USER_AGENT']) || stripos($_SERVER['HTTP_USER_AGENT'], 'Lighthouse') === false) : ?>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P3XXD64"
                      height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
<?php endif; ?>
<div id="root">
    <div class="app">
        <div class="app_main">
            <header id="header" class="header<?php echo is_front_page() ? ' header_home' : ''; ?>">
                <div class="container container_big">
                    <div class="row header_block">
                        <div class="col-md-2 col-5 header_logo">
                            <div class="logo">
                                <?php if (!is_front_page()) {
                                    echo '<a href="' . get_home_url() . '">';
                                } ?>
                                <img src="<?php echo $logo; ?>" alt="Logo">
                                <?php if (!is_front_page()) echo '</a>'; ?>
                            </div>
                        </div>
                        <div class="col-lg-4 offset-lg-2 col-5 header_search">
                            <?php get_search_form(); ?>
                        </div>
                        <div class="col-lg-1 col-md-1 col-5">
                            <div id="lang_switcher">
                                <?php
                                the_widget('qTranslateXWidget',
                                    array(
                                        'type' => 'custom',
                                        'format' => '%c',
                                        'hide-title' => true,
                                        'widget-css-off' => true
                                    ));
                                ?>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-2 header_top">
                            <div class="header_info">
                                <?php $phone = get_field('telefon', 'option'); ?>
                                <a href="<?php echo phone_format($phone); ?>"><i class="fas fa-phone"></i>
                                    <?php echo $phone; ?></a>
                                <a href="mailto:<?php the_field('e-mail', 'option'); ?>"><i
                                            class="far fa-envelope"></i> <?php the_field('e-mail', 'option'); ?></a>
                            </div>
                            <div class="mob_menu header_mob_menu">
                                <button id="hamburger_header" class="hamburger hamburger--collapse" type="button">
                                        <span class="hamburger-box">
                                            <span class="hamburger-inner"></span>
                                        </span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 menu">
                            <nav class="header_menu<?php echo (is_front_page()) ? ' header_menu_home' : ''; ?>">
                                <?php
                                if (has_nav_menu('header_menu')) {
                                    wp_nav_menu(array(
                                        'theme_location' => 'header_menu',
                                        'menu_class' => 'header_menu_links',
                                        'container' => '',
                                        'container_class' => '',
                                        'menu_id' => 'header_menu_links',
                                        'depth' => 1,
                                        'walker' => new Main_Submenu_Class()));
                                }

                                $menu = wp_get_nav_menu_items('Header Menu', array());
                                $children1 = true_get_nav_menu_children_items(15, $menu, 0);
                                $children2 = true_get_nav_menu_children_items(19, $menu, 0);

                                ?>
                            </nav>
                        </div>
                    </div>
                </div>
            </header>
            <main>
