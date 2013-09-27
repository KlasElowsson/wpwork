<?php
/**
 *
 */

get_header(); ?>

		<div id="container" class="one-column">
			<div id="content" role="main">

			<?php
			/* Run the loop to output the page.
			 * If you want to overload this in a child theme then include a file
			 * called loop-page.php and that will be used instead.
			 */
			 //  get_template_part( 'loop', 'page' );
       $kpe_post_query = new WP_Query(array('post_type' => 'products',
                         'posts_per_page' => -1,
                         'orderby' => 'title',
                         'order' => 'ASC'));
 //$kpe_post_query->query("&post_type=products");//&orderby=title&order=DESK");
        //var_dump($kpe_post_query);
      ?>
      <h3>Produkter:</h3>
      <?php if ( $kpe_post_query->have_posts()) : 
          while ( $kpe_post_query->have_posts()) : 
            $kpe_post_query->the_post();
      ?>
      <div>
      <a href="<?php echo the_permalink(); ?>"
        title="<?php echo the_title(); ?>"><?php echo the_title(); ?></a>
      
      </div>
      <?php   endwhile; 
          endif; 
       
			?>
      <?php //var_dump($kpe_post_query); ?>
      <?php /* Display navigation to next/previous pages when applicable */ ?>
      <?php if (  $kpe_post_query->max_num_pages > 1 ) : ?>
       <?php 
       //echo $kpe_post_query->max_num_pages; 
       ?>
              <div id="nav-below" class="navigation">
                <!-- <div class="nav-previous">p<?php previous_posts_link( __( '<span class="meta-nav">&larr;</span> Föregående Produktsida', 'twentyten' ), $kpe_post_query->max_num_pages ); ?></div> -->
                <!-- <div class="nav-next">n<?php next_posts_link( __( 'Nästa Produktsida <span class="meta-nav">&rarr;</span>', 'twentyten' ), $kpe_post_query->max_num_pages ); ?></div> -->
              </div><!-- #nav-below -->
      <?php endif; ?>
			

			</div><!-- #content -->
		</div><!-- #container -->

<?php get_footer(); ?>
