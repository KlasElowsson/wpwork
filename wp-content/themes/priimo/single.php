<?php
/**
 * @package Priimo
 */
?>
<?php global $priimo_options; ?>
<?php get_header(); ?>
<?php if($priimo_options['sidebar_layout'] == 'one-left-sidebar'): ?>
<?php get_sidebar(1); ?>
<?php endif; ?>
<div class="container">
    <?php if(have_posts()) : ?>
        <?php while(have_posts()) : the_post(); ?>
            <?php get_template_part('content', 'single'); ?>
            <div class="single-navigation">
                <span class="nav-previous"><?php previous_post_link('%link', __('Previous', 'priimo')); ?></span>
                <span class="nav-next"><?php next_post_link('%link', __('Next', 'priimo')); ?></span>
            </div>
            <?php comments_template('', true); ?>
        <?php endwhile; ?>
    <?php else: ?>
    <article id="post-0" <?php post_class(); ?>>
        <h2 class="entry-title"><?php _e('Nothing Found', 'priimo'); ?></h2>
        <div class="entry-content">
            <p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'priimo' ); ?></p>
            <p><?php get_search_form(); ?></p>
        </div>
    </article>
    <?php endif; ?>
</div>
<?php if($priimo_options['sidebar_layout'] == 'one-right-sidebar'): ?>
<?php get_sidebar(1); ?>
<?php endif; ?>
<?php get_footer(); ?>