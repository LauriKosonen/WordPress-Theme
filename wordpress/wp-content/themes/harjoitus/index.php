<!-- news -->
<?php

get_header(); ?>

<?php if ( is_front_page() ) : ?>
    <header id="site-header">
        <h1><?php bloginfo('name'); ?></h1>
    </header>
<?php endif; ?>

<div id="content">
<main>
<?php
if (have_posts()) :

    while(have_posts()) : the_post(); ?>
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
else: ?>
    <p>No posts.</p>
<?php

endif; ?>
</main>
</div> <!-- content päättyy -->
<?php
get_footer();
?>



