<?php

get_header(); ?>

<div id="content">
<main>
<?php
if (have_posts()) :

    while(have_posts()) : the_post(); ?>
    <article>
        <?php the_post_thumbnail('large')?>
        <h2><?php the_title(); ?></h2>
        <?php the_content(); ?>
    </article>
    <?php
    endwhile;

endif; ?>

<?php
if (comments_open() || get_comments_number()) :
    comments_template();
endif;
?>
</main>
</div> <!-- content päättyy -->
<?php
get_footer();
?>
