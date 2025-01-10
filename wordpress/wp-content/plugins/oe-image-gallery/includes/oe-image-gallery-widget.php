<?php

class Oegallery_Widget extends WP_Widget {
    public function __construct() {
        parent:: __construct(
            'oegallery_widget',
            'Simple Slideshow',
            array(
                'customize_selective_refresh' => true
            )
        );
    }

    public function form($instance) {
        $defaults = array(
            'title' => '',
            'category' => 'all'
        );

        extract(wp_parse_args( (array) $instance, $defaults)); ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">Header (optional)</label>
            <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" 
            name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($title); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('category')); ?>">Slideshow</label>
            <select id="<?php echo esc_attr($this->get_field_id('category')); ?>" name="<?php echo esc_attr($this->get_field_name('category')); ?>" class="widefat">
            <?php
                $terms = get_terms(
                    array(
                        'taxonomy' => 'slideshow_group',
                        'hide_empty' => false
                    )
                    );


                    foreach($terms as $term) :
                        $options[$term->slug] = $term->name;
                    endforeach;

                    foreach($options as $key => $name) :
                        echo '<option value="' . esc_attr($key) . '"' . selected($category, $key, false) . '>' . $name . '</option>';
                    endforeach;
            ?>

            </select>

        </p>

    <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = isset($new_instance['title']) ? wp_strip_all_tags($new_instance['title']) : '';
        $instance['category'] = isset($new_instance['category']) ? wp_strip_all_tags($new_instance['category']) : '';
        return $instance;

    }

    public function widget($args, $instance) {
        extract($args);

        $title = isset($instance['title']) ? apply_filters('widget_title', $instance['title']) : '';
        $category = isset($instance['category']) ? $instance['category'] : 'all';

        echo $before_widget;

        echo '<div class="wp-widget-oegallery">';
        if ($title) {
            echo $before_title . $title . $after_title;
        }

        $query_args = array(
            'post_type' => 'oeslideshow_images',
            'posts_per_page' => -1,
        );

        if (!empty($category) && $category !== 'all') {
            $query_args['tax_query'] = array(
                array(
                    'taxonomy' => 'slideshow_group',
                    'field' => 'slug',
                    'terms' => $category,
                ),
            );
        }

        $query = new WP_Query($query_args);

        if ($query->have_posts()) {
            echo '<div class="oe-slideshow-wrapper">';
            echo '<div class="oe-slideshow-container">';
            echo '<button class="oe-prev">&lt;</button>';
            echo '<div class="oe-slideshow">';

            while ($query->have_posts()) {
                $query->the_post();
                $image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
                $title = get_the_title();

                if ($image_url) {
                    echo '<div class="oe-slide">';
                    echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($title) . '">';
                    echo '<p class="oe-caption">' . esc_html($title) . '</p>';
                    echo '</div>';
                }
            }

            echo '</div>';
            echo '<button class="oe-next">&gt;</button>';
            echo '</div>';
            echo '</div>';

            wp_reset_postdata();
        } else {
            echo '<p>No images found for this slideshow.</p>';
        }

        echo '</div>';

        echo $after_widget;
    }
}

function oegallery_register_widget() {
    register_widget('Oegallery_Widget');
}

add_action('widgets_init', 'oegallery_register_widget');

?>