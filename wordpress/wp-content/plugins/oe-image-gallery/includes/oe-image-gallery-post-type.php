<?php
/* Register new post type: slideshow */ 
function oeslideshow_register_post_type() {
    add_theme_support('post-thumbnails');

    $labels = array(
        'name' => 'Slideshow images',
        'singular_name' => 'Image',
        'add_new' => 'New image',
        'add_new_item' => 'Add new image',
        'edit_item' => 'Edit an image',
        'new_item' => 'New image',
        'view_items' => 'View images',
        'search_item' => 'Search images',
        'not_found' => 'Image not found',
        'not_found_in_trash' => 'Image not found in trash'

    );

    $args = array(
        'labels' => $labels,
        'has_archive' => true,
        'public' => true,
        'hierarchical' => false,
        'supports' => array(
            'title',
            'editor',
            'thumbnail',
            'custom-fields'
        ),
        'rewrite' => array('slug' => 'image'),
        'show_in_rest' => true
    );

    register_post_type('oeslideshow_images', $args);
}
add_action('init', 'oeslideshow_register_post_type');


function oeslideshow_register_taxonomy() {
    register_taxonomy('slideshow_group', 'oeslideshow_images', array(
        'labels' => array(
            'name' => 'Slideshows',
            'singular_name' => 'Slideshow',
            'add_new_item' => 'Add New Slideshow',
            'edit_item' => 'Edit Slideshow',
            'all_items' => 'All Slideshows',
        ),
        'hierarchical' => true,
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'slideshow'),
    ));
}
add_action('init', 'oeslideshow_register_taxonomy');



?>