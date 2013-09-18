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
<?php $annons_cnt=0; //Används för att gruppera 3 o 3 vid annonser ?>  

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>




  

<?php if ($annons_cnt==0) : ?>
      <div class="annons-grupp">
<?php elseif ($annons_cnt%2==0) : ?>
      </div><!-- slut annons-grupp -->
      <div class="annons-grupp">  
<?php endif; ?>  
<?php $annons_cnt++ ;?>





<!-- Här startar jag med mina rader -->
<?php //the_meta(); ?> <!-- Skriv ut meta -->
<?php get_post_custom(); ?>

<?php
$col_term = 'Färg ';
$lcol_term = ' ';
$color_terms = wp_get_object_terms($post->ID, 'prod-col');
if(!empty($color_terms)){
  if(!is_wp_error( $color_terms )){
    foreach($color_terms as $term){
      $col_term .= ' | '.$term->name ;
      $lcol_term .= ' | '.$term->name ;
    }
  }
}
$size_term = 'Storlek ';
$lsize_term = ' ' ;
$size_terms = wp_get_object_terms($post->ID, 'prod-size');
if(!empty($size_terms)){
  if(!is_wp_error( $size_terms )){
    foreach($size_terms as $term){
      $size_term .= ' | '.$term->name ; 
      $lsize_term .= ' | '.$term->name ; 
    }
  }
}
$var1 = "Storlek | ".$lsize_term ;
$var2 = "Färg | ".$lcol_term ;
$var3 = "";

$price = get_post_meta($post->ID, "Pris", true);
$shipping = 0;
?>


<?php if ( get_post_meta($post->ID, "Pris", true)) : // If a user has filled out their description, show a bio on their entries  ?>
 
 <!-- Title with link if multi -->
      <div id="post-<?php the_ID(); ?>" <?php post_class("annons-fl"); ?>>
      <h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

<!-- 
        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <h1 class="entry-title"><?php the_title(); ?></h1>
-->
          <div class="entry-content">
            <?php the_content(); ?>
            <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentyten' ), 'after' => '</div>' ) ); ?>
          </div><!-- .entry-content -->

          <div>
           
              <!--<ul class="post-meta">
                <li>-->
                  <div>
                  <span class="post-meta-key">Pris: </span><?php echo get_post_meta($post->ID, "Pris", true); ?>
                  </div>
                <!--</li>
                <li>..>-->
                  <div>
                  <span class="post-meta-key">Storlek: </span><?php echo $lsize_term; ?>
                  </div>
                <!--</li>
                <li>-->
                  <p>
                  <span class="post-meta-key">Färg: </span><?php echo $lcol_term; ?>
                  </p>
                <!--</li>
              </ul>-->
            
          </div>
<?php else : ?>
           Du måste ange ett pris för beräkningen  !!!! 
<?php endif; ?>


<?php 
if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
  the_post_thumbnail();
} 
?>
<div>
<?php
  $button_code = print_wp_cart_button_for_product(the_title(), $price, $shipping, $var1, $var2, $var3);
  echo $button_code; ?>
</div>
        </div><!-- #post-## -->


<?php endwhile; // end of the loop. ?>
<?php if ($annons_cnt > 0) :?>
      </div><!-- slut annons-grupp -->
<?php endif; ?>

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
        <div id="nav-below" class="navigation">
          <div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'twentyten' ) ); ?></div>
          <div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'twentyten' ) ); ?></div>
        </div><!-- #nav-below -->
<?php endif; ?>
