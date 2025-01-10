<?php
function oeslideshow_shortcode($atts) {
    $atts = shortcode_atts(array(
        'slideshow' => '',
    ), $atts);

    $args = array(
        'post_type' => 'oeslideshow_images',
        'posts_per_page' => -1,
    );

    if (!empty($atts['slideshow'])) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'slideshow_group',
                'field' => 'slug',
                'terms' => $atts['slideshow'],
            ),
        );
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        $output = '<div class="oe-slideshow-container">';
        $output .= '<button class="oe-prev">&lt;</button>';
        $output .= '<div class="oe-slideshow">';
    
        $indicator_html = '<div class="oe-indicators">';
        $slide_index = 0;
    
        while ($query->have_posts()) {
            $query->the_post();
            $image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
            $title = get_the_title();
    
            if ($image_url) {
                $output .= '<div class="oe-slide">';
                $output .= '<a href="' . esc_url($image_url) . '" class="image-link" data-lightbox="slideshow" data-title="' . esc_attr($title) . '">';
                $output .= '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($title) . '">';
                $output .= '</a>';
                $output .= '<p class="oe-caption">' . esc_html($title) . '</p>';
                $output .= '</div>';
    
                // Add an indicator for each slide
                $indicator_html .= '<span class="oe-indicator" data-slide="' . $slide_index . '"></span>';
                $slide_index++;
            }
        }
    
        $output .= '</div>'; // Close .oe-slideshow
        $output .= '<button class="oe-next">&gt;</button>';
        $indicator_html .= '</div>'; // Close .oe-indicators
        $output .= $indicator_html;
        $output .= '</div>'; // Close .oe-slideshow-container
    
        wp_reset_postdata();
    } 
    else {
        $output = '<p>No images found for this slideshow.</p>';
    }

    return $output;
}
add_shortcode('oe-slideshow', 'oeslideshow_shortcode');

?>