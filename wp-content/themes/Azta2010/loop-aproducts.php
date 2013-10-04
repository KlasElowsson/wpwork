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
<?php 
//$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ) 
?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>


<!-- Här startar jag med mina rader -->
<?php //the_meta(); ?> <!-- Skriv ut meta -->
<?php get_post_custom(); ?>

<?php
$var1 = "";
$var2 = "";
$var3 = "";
//$col_term = 'Färg ';
$lcol_term = '';
$color_terms = wp_get_object_terms($post->ID, 'prod-col');
if(!empty($color_terms)){
  if(!is_wp_error( $color_terms )){
    foreach($color_terms as $term){
//      $col_term .= ' | '.$term->name ;
      $lcol_term .= ' | '.$term->name ;
    }
  }
}
//$size_term = 'Storlek ';
$lsize_term = '' ;
$size_terms = wp_get_object_terms($post->ID, 'prod-size');
if(!empty($size_terms)){
  if(!is_wp_error( $size_terms )){
    foreach($size_terms as $term){
//      $size_term .= ' | '.$term->name ; 
      $lsize_term .= ' | '.$term->name ; 
    }
  }
}
if ($lsize_term != $var1) {
$var1 = "Storlek ".$lsize_term ;
}
if ($lcol_term != $var2) {
$var2 = "Färg ".$lcol_term ;
}
$price = get_post_meta($post->ID, "Pris", true);
$shipping = 0;
$beskrivning = get_post_meta($post->ID, "beskr", true);
?>


<?php if ( get_post_meta($post->ID, "Pris", true)) : // If a user has filled out the price, show product  ?>
 
 <!-- Title with link if multi -->
      <div id="post-<?php the_ID(); ?>" <?php post_class("annons-fl2"); ?>>
      <h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

<?php 
//$photo_link=esc_url( apply_filters( 'the_permalink', get_permalink() ) );
if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
$default_attr = array(
      'class' => "attachment-medium",
      'alt' => $beskrivning,
      'title' => $beskrivning,
    );
    ?><div style="float: left"><a href="<?php the_permalink(); ?>"><?php
      the_post_thumbnail('thumbnail', $default_attr);
    ?></a></div><?php
} 
?>

<?php endif; ?>
          <div style="float: left; padding-left:10px;"><!-- Grouping -->
            <div>
            <span class="post-meta-key">Pris: </span><?php echo get_post_meta($post->ID, "Pris", true); ?>
            </div>
            
          <?php if (strlen($var1) > 0) : ?>
            <div>
              <span class="post-meta-key">Storlek: </span><?php echo $lsize_term; ?>
            </div>
          <?php endif;  ?>
          <?php if (strlen($var2) > 0) : ?>
            <div>
              <span class="post-meta-key">Färg: </span><?php echo $lcol_term; ?>
            </div>
          
          <?php endif;  ?>



          <div class="entry-content" style="width:300px">
            <?php the_content(); ?>
            <?php echo $beskrivning; ?>
          </div><!-- .entry-content -->


<div style="padding-top: 10px">
<?php
  $button_code = print_wp_cart_button_for_product(the_title( "" ,"" , false), $price, $shipping, $var1, $var2, $var3);
  //echo $button_code; ?>
</div>
        </div><!-- Grouping -->
        </div><!-- #post-## -->


<?php endwhile; // end of the loop. ?>

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
        <div id="nav-below" class="navigation">
          <!-- <div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'twentyten' ) ); ?></div> -->
          <!-- <div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'twentyten' ) ); ?></div> -->
          <div class="nav-previous"><?php previous_posts_link( __( '<span class="meta-nav">&larr;</span> Föregående Produktsida', 'twentyten' ) ); ?></div>
          <div class="nav-next"><?php next_posts_link( __( 'Nästa Produktsida <span class="meta-nav">&rarr;</span>', 'twentyten' ) ); ?></div>
        </div><!-- #nav-below -->
<?php endif; ?>
