<?php
/**
 * The Sidebar containing the primary and secondary widget areas.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>

<div id="fixed" class="widget-area">
	<ul class="xoxo">
		<li id="permanent">
			<a href="http://www.twitter.com/mor10" title="Mor10 on Twitter" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/HPonTwitter.png" alt="Hansel &amp; Petal on Twitter" target="_blank"/></a>
		</li>	
	</ul>
</div>

		<div id="primary" class="widget-area" role="complementary">
			<ul class="xoxo">
				
				
<?php
	/* When we call the dynamic_sidebar() function, it'll spit out
	 * the widgets for that widget area. If it instead returns false,
	 * then the sidebar simply doesn't exist, so we'll hard-code in
	 * some default sidebar stuff just in case.
	 */
	if ( ! dynamic_sidebar( 'primary-widget-area' ) ) : ?>

			<li id="search" class="widget-container widget_search">
				<?php get_search_form(); ?>
			</li>

			

			

		<?php endif; // end primary widget area ?>
			</ul>
		</div><!-- #primary .widget-area -->
		
		
		


