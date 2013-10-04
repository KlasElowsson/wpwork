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
		
		
		<div id="leftRight">
<?php
	// Left widget area
?>

		<?php
	// Left widget area
?>

		<div id="leftWidgets" class="widget-area" role="complementary">
			<ul class="xoxo">
				<?php if ( ! dynamic_sidebar( 'left-widget-area' ) ) : ?>
					<li id="archives" class="widget-container">
				<h3 class="widget-title"><?php _e( 'Archives', 'twentyten' ); ?></h3>
				<ul>
					<?php wp_get_archives( 'type=monthly' ); ?>
				</ul>
			</li>
				<?php endif; // end primary widget area ?>
			</ul>
		</div><!-- #leftWidgets .widget-area -->

<?php
	// Right widget area
?>

		<div id="rightWidgets" class="widget-area" role="complementary">
			<ul class="xoxo">
				<?php if ( ! dynamic_sidebar( 'right-widget-area' ) ) : ?>
					<li id="meta" class="widget-container">
				<h3 class="widget-title"><?php _e( 'Meta', 'twentyten' ); ?></h3>
				<ul>
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<?php wp_meta(); ?>
				</ul>
			</li>
				<?php endif; ?>
			</ul>
		</div><!-- #rightWidgets .widget-area -->


</div><!-- END #leftRight -->

<?php
	// A second sidebar for widgets, just because.
	if ( is_active_sidebar( 'secondary-widget-area' ) ) : ?>

		<div id="secondary" class="widget-area" role="complementary">
			<ul class="xoxo">
				<?php dynamic_sidebar( 'secondary-widget-area' ); ?>
			</ul>
		</div><!-- #secondary .widget-area -->

<?php endif; ?>
