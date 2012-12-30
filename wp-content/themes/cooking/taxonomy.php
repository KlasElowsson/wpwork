<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 */

get_header(); ?>

		<div id="primary">
			<div id="content" role="main">
				<header class="page-header">
					<h1 class="page-title">
						<?php
							printf( __( 'Filed Under: %s' ), '<span>' . single_cat_title( '', false ) . '</span>' );
						?>
					</h1>
					<?php
						$category_description = category_description();
						if ( ! empty( $category_description ) ) :
							echo apply_filters( 'category_archive_meta', '<div class="category-archive-meta">' . $category_description . '</div>' );
						endif;
					?>
				</header>
			<?php if ( have_posts() ) : ?>

				<?php twentyeleven_content_nav( 'nav-above' ); ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
/**
 * The template for displaying content in the single.php template
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title">
			<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyeleven' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
				<?php the_title(); ?>
			</a>
		</h1>

		<div>Post type: <?php 
									$obj=get_post_type_object($post->post_type);
									echo $obj->labels->singular_name;					
								?>
		</div>
		
		<?php if ( get_post_type() == recipes ) { ?>
			<div class="entry-meta-custom">		
				<?php if (get_the_term_list( $post->ID, 'meal-type' ) != null ) { ?>
					<div>Meal type: <?php echo get_the_term_list( $post->ID, 'meal-type', '', ', ', '' ); ?></div>
				<?php } ?>
				<?php if (get_the_term_list( $post->ID, 'time' ) != null ) { ?>
					<div>Preparation time: <?php echo get_the_term_list( $post->ID, 'time', '', ', ', '' ); ?></div>
				<?php } ?>
				<?php if (get_the_term_list( $post->ID, 'servings' ) != null ) { ?>
					<div>Servings: <?php echo get_the_term_list( $post->ID, 'servings', '', ', ', '' ); ?></div>
				<?php } ?>
				<?php if (get_the_term_list( $post->ID, 'difficulty' ) != null ) { ?>
					<div>Difficulty: <?php echo get_the_term_list( $post->ID, 'difficulty', '', ', ', '' ); ?></div>
				<?php } ?>
				<?php if (get_the_term_list( $post->ID, 'ingredients' ) != null ) { ?>
					<div>Ingredients: <?php echo get_the_term_list( $post->ID, 'ingredients', '', ', ', '' ); ?></div>
				<?php } ?>
			</div><!-- .entry-meta-custom -->
			<?php } ?>
		
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'twentyeleven' ) . '</span>', 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
			<?php if ( (get_post_type() == photos) || (get_post_type() == videos) ) { ?>
				<?php if (get_the_term_list( $post->ID, 'techniques' ) != null ) { ?>
					<div>Technique: <?php echo get_the_term_list( $post->ID, 'techniques', '', ', ', '' ); ?></div>
				<?php } ?>
				<?php if (get_the_term_list( $post->ID, 'video-types' ) != null ) { ?>
					<div>Video type: <?php echo get_the_term_list( $post->ID, 'video-types', '', ', ', '' ); ?></div>
				<?php } ?>
				<?php if (get_the_term_list( $post->ID, 'meal-type' ) != null ) { ?>
					<div>Meal type: <?php echo get_the_term_list( $post->ID, 'meal-type', '', ', ', '' ); ?></div>
				<?php } ?>
				<?php if (get_the_term_list( $post->ID, 'ingredients' ) != null ) { ?>
					<div>Ingredients: <?php echo get_the_term_list( $post->ID, 'ingredients', '', ', ', '' ); ?></div>
				<?php } ?>

				<br />
			<?php } ?>
		<?php
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( __( ', ', 'twentyeleven' ) );

			/* translators: used between list items, there is a space after the comma */
			$tag_list = get_the_tag_list( '', __( ', ', 'twentyeleven' ) );
			if ( '' != $tag_list ) {
				$utility_text = __( 'This entry was posted in %1$s and tagged %2$s by <a href="%6$s">%5$s</a>. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'twentyeleven' );
			} elseif ( '' != $categories_list ) {
				$utility_text = __( 'This entry was posted in %1$s by <a href="%6$s">%5$s</a>. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'twentyeleven' );
			} else {
				$utility_text = __( 'This entry was posted by <a href="%6$s">%5$s</a>. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'twentyeleven' );
			}

			printf(
				$utility_text,
				$categories_list,
				$tag_list,
				esc_url( get_permalink() ),
				the_title_attribute( 'echo=0' ),
				get_the_author(),
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) )
			);
		?>
		<?php edit_post_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>

		<?php if ( get_the_author_meta( 'description' ) && is_multi_author() ) : // If a user has filled out their description and this is a multi-author blog, show a bio on their entries ?>
		<div id="author-info">
			<div id="author-avatar">
				<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentyeleven_author_bio_avatar_size', 68 ) ); ?>
			</div><!-- #author-avatar -->
			<div id="author-description">
				<h2><?php printf( esc_attr__( 'About %s', 'twentyeleven' ), get_the_author() ); ?></h2>
				<?php the_author_meta( 'description' ); ?>
				<div id="author-link">
					<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
						<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'twentyeleven' ), get_the_author() ); ?>
					</a>
				</div><!-- #author-link	-->
			</div><!-- #author-description -->
		</div><!-- #entry-author-info -->
		<?php endif; ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->
					

				<?php endwhile; ?>

				<?php twentyeleven_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'twentyeleven' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'twentyeleven' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>