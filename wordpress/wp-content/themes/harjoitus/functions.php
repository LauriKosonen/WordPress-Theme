<?php
register_nav_menus(['primary' => 'Päävalikko']);

add_theme_support('post-thumbnails');

function oceanexplorer_assets() {
    wp_enqueue_style('style', get_stylesheet_uri());
    wp_enqueue_script('oceanexplore-script', get_template_directory_uri() . '/js/oceanexplore.js', array('jquery'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'oceanexplorer_assets');


function oceanexplore_widgets_init() {
    register_sidebar( array(
        'name' => 'Sidebar',
        'id' => 'sidebarmain',
        'before_widget' => '<div class="footer-widget>',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>'
    ));
}
add_action('widgets_init', 'oceanexplore_widgets_init');

function excerpt_read_more() {
    global $post;
    return ' <p><a href="' . get_permalink($post->ID) . '">Read more &raquo;</a></p>';
}
add_filter('excerpt_more', 'excerpt_read_more');

function custom_dynamic_excerpt_length($length) {
    if (is_front_page()) {
        return 20;
    } elseif (is_category('news')) {
        return 60;
    }
    return $length;
}
add_filter('excerpt_length', 'custom_dynamic_excerpt_length');

function ocean_explore_theme_setup() {
    add_theme_support('title-tag');
}
add_action('after_setup_theme', 'ocean_explore_theme_setup');


// featured report
function mytheme_customize_register($wp_customize) {
    $wp_customize->add_section('featured_report_section', array(
        'title' => 'Featured Report',
        'priority' => 30,
    ));

    $wp_customize->add_setting('featured_report', array(
        'default' => '',
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'featured_report_control', array(
        'label' => 'Select a Featured Report',
        'section' => 'featured_report_section',
        'settings' => 'featured_report',
        'type' => 'select',
        'choices' => mytheme_get_report_choices(),
    )));
}
add_action('customize_register', 'mytheme_customize_register');


function mytheme_get_report_choices() {
    $posts = get_posts(array(
        'category_name' => 'report',
        'numberposts' => -1,
        'orderby' => 'date',
        'order' => 'DESC',
    ));

    $choices = array('' => 'Select a report');
    foreach ($posts as $post) {
        $choices[$post->ID] = $post->post_title;
    }

    return $choices;
}

// custom background
add_theme_support( 'custom-background' );

?>