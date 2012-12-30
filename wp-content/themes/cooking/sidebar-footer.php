<?php
/**
 * The Footer widget areas.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>


<div id="supplementary" class="three" >
	<div id="first" class="widget-area" role="complementary">
		<?php if ( ! dynamic_sidebar( 'sidebar-3' ) ) { ?>
			<aside class="widget">
				<h3 class="widget-title">Recent Recipes</h3>
				<ul>  
					<?php
					$postslist = get_posts('numberposts=4&order=DESC&orderby=date&post_type=recipes');
					foreach ($postslist as $post) :
						setup_postdata($post);
					?> 
						<li class="entry">
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						</li>
					<?php endforeach; ?>
	           	</ul>
			</aside>
		<?php } ?>
	</div><!-- #first .widget-area -->

	<div id="second" class="widget-area" role="complementary">
		<?php if ( ! dynamic_sidebar( 'sidebar-4' ) ) { ?>
			<aside class="widget">
				<h3 class="widget-title">Recent Photos</h3>
				<ul>  
					<?php
					$postslist = get_posts('numberposts=4&order=DESC&orderby=date&post_type=photos');
					foreach ($postslist as $post) :
						setup_postdata($post);
					?> 
						<li class="entry">
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						</li>
					<?php endforeach; ?>
	           	</ul>
			</aside>
		<?php } ?>
	</div><!-- #second .widget-area -->

	<div id="third" class="widget-area" role="complementary">
		<?php if ( ! dynamic_sidebar( 'sidebar-3' ) ) { ?>
			<aside class="widget">
				<h3 class="widget-title">Recent Videos</h3>
				<ul>  
					<?php
					$postslist = get_posts('numberposts=4&order=DESC&orderby=date&post_type=videos');
					foreach ($postslist as $post) :
						setup_postdata($post);
					?> 
						<li class="entry">
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						</li>
					<?php endforeach; ?>
	           	</ul>
			</aside>
		<?php } ?>
	</div><!-- #third .widget-area -->
</div><!-- #supplementary -->