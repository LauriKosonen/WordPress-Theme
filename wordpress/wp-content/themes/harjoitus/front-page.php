<?php

get_header(); ?>

<?php if ( is_front_page() ) : ?>
    <header id="site-header">
        <h1><?php bloginfo('name'); ?></h1>
    </header>
<?php endif; ?>

<div id="content">
<main>
    <h1 class="recent-articles-title">Recent Articles</h1>
    
    <div id="news-box">
<?php

$the_query = new WP_QUERY(array(
    'category_name' => 'article',
    'orderby' => 'date',
    'order' => 'desc',
    'posts_per_page' => '3'

));

if ($the_query->have_posts()) :

    while($the_query->have_posts()) : $the_query->the_post(); ?>
    <div class="news">
        <?php if ( has_post_thumbnail() ) : ?>
            <div class="news-thumbnail">
                <?php the_post_thumbnail('medium'); ?>
            </div>
        <?php endif; ?>
        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <p class="date"><?php echo get_the_date(); ?></p> <!-- varmista myöhemmin että toimii. eka video vikat 2min -->
        <?php the_excerpt(); ?>
    </div>
    <?php
    endwhile;
    wp_reset_postdata();
else: ?>
    <p>No posts.</p>
<?php

endif; ?>
</div>

<h1 class="recent-reports-title">Featured Report</h1>

<?php

$featured_report_id = get_theme_mod('featured_report');
if ($featured_report_id) {
    $the_query = new WP_Query(array(
        'p' => $featured_report_id,
        'posts_per_page' => 1
    ));
}

if ($the_query->have_posts()) :
    add_filter('excerpt_length', function($length) {
        return 50;
    });
    while ($the_query->have_posts()) : $the_query->the_post();
        ?>
        <article>
            <div class="news-content">
                <div class="thumbnail"><?php the_post_thumbnail('medium'); ?></div>
                <div class="text-content">
                    <h2 style="margin-bottom: 5px;"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <p class="date-category" style="margin-bottom: 5px;"><?php echo get_the_date(); ?> | <?php echo get_the_category_list(', '); ?></p>
                    <p class="excerpt-text" style="margin-bottom: 5px;"><?php the_excerpt(); ?></p>
                </div>
            </div>
        </article>
        <?php
    endwhile;
    wp_reset_postdata();
else : ?>
    <p>No posts.</p>
<?php endif; ?>

</main>
</div> <!-- content päättyy -->
<?php
get_footer();
?>
