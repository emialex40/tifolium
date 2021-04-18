<?php

//debug function for var_dump()
function debug($bug)
{
    echo '<pre style="padding: 15px; background: #000; display:block; width: 100%; color: #fff;">';
    var_dump($bug);
    echo '</pre>';
}

add_filter('the_generator', '__return_empty_string');
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');
remove_filter('the_content_feed', 'wp_staticize_emoji');
remove_filter('comment_text_rss', 'wp_staticize_emoji');
remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
add_filter('tiny_mce_plugins', 'disable_wp_emojis_in_tinymce');

add_filter('show_admin_bar', '__return_false');


add_filter('pll_get_post_types', 'unset_cpt_pll', 10, 2);
function unset_cpt_pll($post_types, $is_settings)
{
    $post_types['acf-field-group'] = 'acf-field-group';
    $post_types['acf'] = 'acf';
    return $post_types;
}

remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'rest_output_link_wp_head');
remove_action('wp_head', 'wp_oembed_add_discovery_links');
add_theme_support('post-thumbnails');
add_filter('jpeg_quality', function () {
    return 100;
});

function disable_wp_emojis_in_tinymce($plugins)
{
    if (is_array($plugins)) {
        return array_diff($plugins, array('wpemoji'));
    } else {
        return array();
    }
}

// disable gutenberg editor
if ('disable_gutenberg') {
    add_filter('use_block_editor_for_post_type', '__return_false', 100);
    remove_action('wp_enqueue_scripts', 'wp_common_block_scripts_and_styles');

    add_action('admin_init', function () {
        remove_action('admin_notices', ['WP_Privacy_Policy_Content', 'notice']);
        add_action('edit_form_after_title', ['WP_Privacy_Policy_Content', 'notice']);
    });
}


// svg upload
// add to wp-config string - define( 'ALLOW_UNFILTERED_UPLOADS', true );
add_filter('upload_mimes', 'svg_upload_allow');
function svg_upload_allow($mimes)
{
    $mimes['svg'] = 'image/svg+xml';

    return $mimes;
}

// styles and scripts including
function load_theme_styles()
{
    wp_enqueue_style('style');

    if (!isset($_SERVER['HTTP_USER_AGENT']) || stripos($_SERVER['HTTP_USER_AGENT'], 'Lighthouse') === false) {
        wp_enqueue_style('fontawesome', get_template_directory_uri() . '/css/fontawesome.min.css', array(), 'null', 'all');
    }

    wp_enqueue_style('custom-style', get_template_directory_uri() . '/css/custom-style.css', array(), time(), 'all');

//	wp_enqueue_script( 'jquery' );
    $js_directory_uri = get_template_directory_uri() . '/js/';

    wp_deregister_script('jquery');
    wp_register_script('jquery', ("https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"), false, '3.5.1', true);
    wp_enqueue_script('jquery');
    wp_enqueue_script('custom-script', $js_directory_uri . 'scripts.min.js', array('jquery'), time(), true);
}

add_action('wp_enqueue_scripts', 'load_theme_styles', 100);

// thumbnails sizes
add_theme_support('post-thumbnails');


add_image_size('logo-thumb', 100, 59);
add_image_size('hero-thumb', 140);
add_image_size('gallery-thumb', 426);
add_image_size('flags-thumb', 560);
add_image_size('bigest-thumb', 1920);

// acf option page include
if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title' => 'General Settings',
        'menu_title' => 'Theme Options',
        'menu_slug' => 'theme-general-settings',
        'capability' => 'edit_posts',
        'redirect' => false
    ));
}

// menu
class  Main_Submenu_Class extends Walker_Nav_Menu
{
    function start_lvl(&$output, $depth = 0, $args = array())
    {
        $classes = array('sub-menu', 'list-unstyled', 'child-navigation');
        $class_names = implode(' ', $classes);
        $output .= "\n" . '<ul class="' . $class_names . '">' . "\n";
    }

    function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output)
    {
        $id_field = $this->db_fields['id'];
        if (is_object($args[0]))
            $args[0]->has_children = !empty($children_elements[$element->$id_field]);
        return parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }

    function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0)
    {
        global $wp_query;

        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        $class_names_arr = array();
        $class_names = $value = '';

        $classes = empty($item->classes) ? array() : (array)$item->classes;

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item));
        $class_names_arr[] = esc_attr($class_names);
        $class_names_arr[] = 'menu-item-id-' . $item->ID;
        $span_act = "";
        if ($args->has_children) {
            $class_names_arr[] = 'has-child';
            if (in_array('current-menu-item', $classes)) {
                $class_names_arr[] = 'focus';
                $span_act = 'active';
            }
            if (in_array('current-menu-parent', $classes)) {
                $class_names_arr[] = 'focus';
                $span_act = 'active';
            }
            if (in_array('current-menu-ancestor', $classes)) {
                $class_names_arr[] = 'focus';
                $span_act = 'active';
            }


        }


        $class_names = ' class="' . implode(' ', $class_names_arr) . '"';
        $menu_locations = '';
        if (isset($args->menu_id)) {
            if ($args->menu_id != '') $menu_locations = $args->menu_id . '_';
        }

        $output .= $indent . '<li id="menu-item-' . $menu_locations . $item->ID . '"' . $value . $class_names . '>';
        $attributes = '';
        if ($item->url != '#') {
            $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
            $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
            $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
            $attributes .= !empty($item->url) ? ' href="' . $item->url . '"' : '';
        }

        $item_output = $args->before;
        $item_output .= '<div class="items"><a' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID);
        $item_output .= $args->link_after;
        $item_output .= '</a>';
        if ($args->has_children) $item_output .= '<span data-from="menu-item-' . $menu_locations . $item->ID . '" class="show_sub_menu ' . $span_act . '"><i></i></span>';
        $item_output .= '</div>';

        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}

// children menu func
function true_get_nav_menu_children_items($parent_id, $nav_menu_items, $dpth = true)
{
    $children = array();
    foreach ((array)$nav_menu_items as $nav_item) {
        if ($nav_item->menu_item_parent == $parent_id) {
            $children[] = $nav_item;

            // если вам не нужны дочерние всех уровней вложенности, то даже можете удалить следующие 5 строк кода
            if ($dpth) {
                if ($dch = get_nav_menu_item_children($nav_item->ID, $nav_menu_items))
                    $children = array_merge($children, $dch);
            }
        }
    }
    return $children;
}

function menulang_setup()
{
    load_theme_textdomain('themename', get_template_directory() . '/languages');
    register_nav_menus(array('header_menu' => __('Header Menu', 'themename')));
    register_nav_menus(array('footer_menu' => __('Footer Menu', 'themename')));
}

add_action('after_setup_theme', 'menulang_setup');

// sidebar register
function inspiry_theme_sidebars()
{
    register_sidebar(
        [
            'name' => __('header_widget', 'themename'),
            'id' => 'Header Widget',
            'description' => __('header_widget', 'themename'),
            'before_widget' => '',
            'after_widget' => '',
            'before_title' => '',
            'after_title' => ''
        ]
    );
}

add_action('widgets_init', 'inspiry_theme_sidebars');

// phone format for links
function phone_format($phone)
{
    $result = 'tel:+' . preg_replace("/\D+/", "", $phone);
    return $result;

//    call function <?php phone_format($phone)
}

// TODO: create post type
function create_post_type()
{
//post type
    $post_type_labels = array(
        'name' => __('Услуги', 'themename'),
        'singular_name' => __('Услуга', 'themename'),
        'add_new' => __('Добавить', 'themename'),
        'add_new_item' => __('Добавить', 'themename'),
        'edit_item' => __('Редактировать', 'themename'),
        'new_item' => __('Добавить', 'themename'),
        'view_item' => __('Смотреть', 'themename'),
        'search_items' => __('Искать', 'themename'),
        'not_found' => __('Не найдено', 'themename'),
        'parent_item_colon' => '',
    );
    $description = get_option('Перечень услуг');
    $post_type_args = array(
        'labels' => apply_filters('inspiry_property_post_type_labels', $post_type_labels),
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'has_archive' => true,
        'capability_type' => 'post',
        'hierarchical' => true,
        'menu_icon' => 'dashicons-portfolio',
        'menu_position' => 15,
        'description' => $description,
        'supports' => array('title', 'editor', 'thumbnail'),
        'rewrite' => array(
            'slug' => apply_filters('inspiry_property_slug', 'service'),
        ),
    );
    register_post_type('service', $post_type_args);

    // taxonomy
    register_taxonomy('service_cats', array('service'), array(
        'label' => 'Категории', // определяется параметром $labels->name
        'labels' => array(
            'name' => 'Категории услуг',
            'singular_name' => 'Категория',
            'search_items' => 'Искать',
            'all_items' => 'Все категории',
            'parent_item' => 'Родительская категория',
            'parent_item_colon' => 'Родительская категория:',
            'edit_item' => 'Редактировать',
            'update_item' => 'Обновить',
            'add_new_item' => 'Добавить',
            'new_item_name' => 'Новая категория',
            'menu_name' => 'Категории услуг',
        ),
        'description' => 'Категории услуг', // описание таксономии
        'public' => true,
        'show_in_nav_menus' => false, // равен аргументу public
        'show_ui' => true, // равен аргументу public
        'show_tagcloud' => false, // равен аргументу show_ui
        'hierarchical' => true,
        'rewrite' => array('slug' => 'services-categoies', 'hierarchical' => false, 'with_front' => false, 'feed' => false),
        'show_admin_column' => true, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
    ));

    $post_type_labels = array(
        'name' => __('FAQ', 'themename'),
        'singular_name' => __('FAQ', 'themename'),
        'add_new' => __('Добавить вопрос', 'themename'),
        'add_new_item' => __('Добавить вопрос', 'themename'),
        'edit_item' => __('Редактировать  вопрос', 'themename'),
        'new_item' => __('Добавить  вопрос', 'themename'),
        'view_item' => __('Смотреть  вопрос', 'themename'),
        'search_items' => __('Искать  вопрос', 'themename'),
        'not_found' => __('Не найдено', 'themename'),
        'parent_item_colon' => '',
    );
    $description = get_option('Часто задаваеміе вопросы');
    $post_type_args = array(
        'labels' => apply_filters('inspiry_property_post_type_labels', $post_type_labels),
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'has_archive' => true,
        'capability_type' => 'post',
        'hierarchical' => true,
        'menu_icon' => 'dashicons-format-status',
        'menu_position' => 16,
        'description' => $description,
        'supports' => array('title', 'editor', 'thumbnail'),
        'rewrite' => array(
            'slug' => apply_filters('qustions', 'service'),
        ),
    );
    register_post_type('qustions', $post_type_args);

    $post_type_labels = array(
        'name' => __('Отзывы', 'themename'),
        'singular_name' => __('Отзыв', 'themename'),
        'add_new' => __('Добавить отзыв', 'themename'),
        'add_new_item' => __('Добавить отзыв', 'themename'),
        'edit_item' => __('Редактировать  отзыв', 'themename'),
        'new_item' => __('Добавить  отзыв', 'themename'),
        'view_item' => __('Смотреть  отзыв', 'themename'),
        'search_items' => __('Искать  отзыв', 'themename'),
        'not_found' => __('Не найдено', 'themename'),
        'parent_item_colon' => '',
    );
    $description = get_option('Отзывы');
    $post_type_args = array(
        'labels' => apply_filters('inspiry_property_post_type_labels', $post_type_labels),
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'has_archive' => true,
        'capability_type' => 'post',
        'hierarchical' => true,
        'menu_icon' => 'dashicons-star-filled',
        'menu_position' => 17,
        'description' => $description,
        'supports' => array('title', 'editor', 'thumbnail'),
        'rewrite' => array(
            'slug' => apply_filters('review', 'service'),
        ),
    );
    register_post_type('reviews', $post_type_args);

}

add_action('init', 'create_post_type');

// pagination
function theme_pagination($pages = '')
{

    global $paged;

    if (is_page_template('template-home.php')) {
        $paged = intval(get_query_var('page'));
    }

    if (empty($paged)) {
        $paged = 1;
    }

    $prev = $paged - 1;
    $next = $paged + 1;
    $range = 2; // only change it to show more links
    $show_items = ($range * 2) + 1;

    if ($pages == '') {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if (!$pages) {
            $pages = 1;
        }
    }

    if (1 != $pages) {
        echo "<div class='pagination'>";
        echo ($paged > 2 && $paged > $range + 1 && $show_items < $pages) ? "<a href='" . get_pagenum_link(1) . "' class='real-btn'>&laquo; " . __('First', 'framework') . "</a> " : "";
        echo ($paged > 1 && $show_items < $pages) ? "<a href='" . get_pagenum_link($prev) . "' class='real-btn' >&laquo; " . __('Previous', 'framework') . "</a> " : "";

        for ($i = 1; $i <= $pages; $i++) {
            if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $show_items)) {
                echo ($paged == $i) ? "<span class='real-btn current'>" . $i . "</span> " : "<a href='" . get_pagenum_link($i) . "' class='real-btn'>" . $i . "</a> ";
            }
        }

        echo ($paged < $pages && $show_items < $pages) ? "<a href='" . get_pagenum_link($next) . "' class='real-btn' >" . __('Next', 'framework') . " &raquo;</a> " : "";
        echo ($paged < $pages - 1 && $paged + $range - 1 < $pages && $show_items < $pages) ? "<a href='" . get_pagenum_link($pages) . "' class='real-btn' >" . __('Last', 'framework') . " &raquo;</a> " : "";
        echo "</div>";
    }
}

add_filter('excerpt_length', function () {
    return 20;
});

add_filter('excerpt_more', function ($more) {
    return '  ......';
});
