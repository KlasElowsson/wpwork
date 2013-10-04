<?php

// Inserts a box with the two most recent posts from the same category as the current post

?>
<?php
	$backup = $post; // backup current object
	$current = $post->ID; // current page ID

	global $post;
	$thisCat = get_the_category(); // gets the current categori(es)
	$currentCategory = $thisCat[0]->cat_ID; // gets the primary category
	$stepper = 1; // default value for the counter
	$myposts = get_posts('numberposts=2&order=DESC&orderby=ID&category=' . $currentCategory . '&exclude=' . $current); // gets the two most recent posts from the current category excluding the current post
	
	$check = count($myposts); // Checks how many posts were returned by the query above
	if ($check > 1 ) { // if there are two or more posts then...
	?> 
		<div id="recent">Recent Related Posts</div>
		<div id="related" class="group">
			<?php 
				foreach($myposts as $post) : setup_postdata($post); // The Loop
			?>
				<div class="story<?php echo $stepper ?>">
					<h2><a href="<?php the_permalink() ?>" title="<?php the_title() ?>" rel="bookmark"><?php the_title() ?></a></h2>
					<div class="date"><?php the_time('F j, Y'); ?></div>
					<div class="theExcerpt">
					<?php if (has_post_thumbnail() ) { ?>
						<div class="relatedThumb">
							<a href="<?php the_permalink() ?>" title="<?php the_title() ?>" rel="bookmark">
								<?php the_post_thumbnail('small'); ?>
							</a>
						</div>
					<?php } ?>
					<?php the_excerpt(); ?>
				</div>
			</div>
			<?php
				$stepper = ($stepper+1); // stepper + 1
				endforeach; 
			?> 
			<?php
				$post = $backup; //restore current object
				wp_reset_query();
			?>
		</div><!-- #related -->
<?php } ?>