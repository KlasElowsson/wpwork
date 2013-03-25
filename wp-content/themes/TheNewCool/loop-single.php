<?php
/**
 * The loop that displays a single post.
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop-single.php.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.2
 */
?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>



				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h1 class="entry-title"><?php the_title(); ?></h1>

					<div class="entry-meta">
						<?php twentyten_posted_on(); ?>
					</div><!-- .entry-meta -->

					<div class="entry-content">
					<?php if (has_post_thumbnail()) { ?>
						<div class="featuredImage">
							<?php the_post_thumbnail('large')?>
						</div>
					<?php } ?>
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentyten' ), 'after' => '</div>' ) ); ?>
					</div><!-- .entry-content -->

<div class="hider">
	<a href="#" title="Show/hide author and related info">Hide &uarr;</a>
</div>

<div id="metaHideContainer">
<div id="metaHide">
<?php if ( get_the_author_meta( 'description' ) ) : // If a user has filled out their description, show a bio on their entries  ?>
					
<div class="profile">
	<div class="profileText">
		<?php the_author_meta('description'); ?>
	</div> <!-- END .profileText -->
	<div class="profileStats">
		<?php if (function_exists('get_avatar')) { echo get_avatar( get_the_author_meta('email'), '80' ); }?>
		<div class="profileName">
			<?php the_author_posts_link(); ?> 
		</div> <!-- END .profileName -->
		<div class="profileJob">
			<a href="<?php the_author_meta('user_url'); ?>" title="<?php the_author_meta('first_name'); ?>'s website"><?php the_author_meta('first_name'); ?>'s website</a><br />
Follow <?php the_author_meta('first_name'); ?> on <a href="http://www.twitter.com/<?php the_author_meta('twitter'); ?>" title="Twitter name: <?php the_author_meta('twitter'); ?>">Twitter</a>
		</div> <!-- END .profileJob -->
	</div> <!-- END .profileStats -->
</div> <!-- END .profile -->			
					
<?php endif; ?>

<?php get_template_part('related'); ?>

</div><!-- END #metaHide -->
</div><!-- END #metaHideContainer-->

					<div class="entry-utility">
						<?php twentyten_posted_in(); ?>
						<?php edit_post_link( __( 'Edit', 'twentyten' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .entry-utility -->
				</div><!-- #post-## -->



				<?php comments_template( '', true ); ?>

<?php endwhile; // end of the loop. ?>