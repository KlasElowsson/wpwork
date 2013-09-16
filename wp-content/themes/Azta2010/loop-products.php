<?php
/**
 * The loop that displays a single post.
 *
 * The loop displays the posts and the post content. See
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



<!-- Här startar jag med mina rader -->
<?php //the_meta(); ?> <!-- Skriv ut meta -->
<?php get_post_custom(); ?><br>

<?php 
  $var1 = "Storlek | ".get_post_meta($post->ID, "Storlek", true);
  $var2 = "Farg | ".get_post_meta($post->ID, "Farg", true);
  $var3 = "";
  
  $price = get_post_meta($post->ID, "Pris", true);
  $shipping = 0;
?>

<?php if ( get_post_meta($post->ID, "Pris", true)) : // If a user has filled out their description, show a bio on their entries  ?>
        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <h1 class="entry-title"><?php the_title(); ?></h1>

          <div class="entry-content">
            <?php the_content(); ?>
            <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentyten' ), 'after' => '</div>' ) ); ?>
          </div><!-- .entry-content -->

          <div>
            <div>
              <ul class="post-meta">
                <li>
                  <span class="post-meta-key">Pris: </span><?php echo get_post_meta($post->ID, "Pris", true); ?>
                </li>
                <li>
                  <span class="post-meta-key">Storlek: </span><?php echo get_post_meta($post->ID, "Storlek", true); ?>
                </li>
                <li>
                  <span class="post-meta-key">Färg: </span><?php echo get_post_meta($post->ID, "Farg", true); ?>
                </li>
              </ul>
            </div><!-- Metadata -->
          </div>
<?php else : ?>
           Du måste ange ett pris för beräkningen  !!!! 
<?php endif; ?>


<?php 
if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
  the_post_thumbnail();
} 
?>
<p>
<?php
  $button_code = print_wp_cart_button_for_product(the_title(), $price, $shipping, $var1, $var2, $var3);
  echo $button_code; ?>
</p>
        </div><!-- #post-## -->


<?php endwhile; // end of the loop. ?>

