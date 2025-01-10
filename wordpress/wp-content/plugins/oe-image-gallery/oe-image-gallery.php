<?php
/*
Plugin Name: Simple Slideshow
Description: Plugin to display images and videos
Author: Lauri Kosonen
*/

require_once('includes/oe-image-gallery-post-type.php');
require_once('includes/oe-image-gallery-shortcodes.php');
require_once('includes/oe-image-gallery-widget.php');

function oeslideshow_setup_menu() {
    add_menu_page('Simple Slideshow', 'Slideshow', 'manage_options', 'oe-slideshow', 'oeslideshow_display_admin_page');

}

function oeslideshow_display_admin_page() {
    echo '<h1>Simple Slideshow</h1>';
    echo '<p>Add shortcode [oe-slideshow slideshow="slug"] to an article to display your selected images or videos in a slideshow</p>';
    echo '<p>This plugin also has a Widget!</p>';

}
add_action('admin_menu', 'oeslideshow_setup_menu');


function oeslideshow_assets() {
    wp_enqueue_style('oeslideshow-css', plugin_dir_url(__FILE__) . 'css/oe-image-gallery.css');
    wp_enqueue_script('oeslideshow-js', plugin_dir_url(__FILE__) . 'js/oe-image-gallery.js', array(), false, true);
    // Lightbox CSS
    wp_enqueue_style('lightbox-css', 'https://cdn.jsdelivr.net/npm/lightbox2@2.11.3/dist/css/lightbox.min.css');    
    // Lightbox JS
    wp_enqueue_script('lightbox-js', 'https://cdn.jsdelivr.net/npm/lightbox2@2.11.3/dist/js/lightbox.min.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'oeslideshow_assets');



function oeslideshow_add_meta_box() {
    add_meta_box(
        'oe_slideshow_selector',
        'Select Slideshow',
        'oeslideshow_render_meta_box',
        'post',
        'side'
    );
}
add_action('add_meta_boxes', 'oeslideshow_add_meta_box');

function oeslideshow_render_meta_box($post) {
    $selected = get_post_meta($post->ID, '_oe_slideshow', true);
    $terms = get_terms(array(
        'taxonomy' => 'slideshow_group',
        'hide_empty' => false,
    ));

    echo '<select name="oe_slideshow">';
    echo '<option value="">None</option>';
    foreach ($terms as $term) {
        $is_selected = ($selected === $term->slug) ? 'selected' : '';
        echo '<option value="' . esc_attr($term->slug) . '" ' . $is_selected . '>' . esc_html($term->name) . '</option>';
    }
    echo '</select>';
}

function oeslideshow_save_meta_box($post_id) {
    if (array_key_exists('oe_slideshow', $_POST)) {
        update_post_meta($post_id, '_oe_slideshow', sanitize_text_field($_POST['oe_slideshow']));
    }
}
add_action('save_post', 'oeslideshow_save_meta_box');

function oeslideshow_append_to_content($content) {
    if (is_singular('post')) {
        $slideshow = get_post_meta(get_the_ID(), '_oe_slideshow', true);
        if (!empty($slideshow)) {
            $content .= do_shortcode('[oe-slideshow slideshow="' . esc_attr($slideshow) . '"]');
        }
    }
    return $content;
}
add_filter('the_content', 'oeslideshow_append_to_content');





?>