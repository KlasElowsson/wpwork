<?php

// Add new post type for Produkter
// 
add_action('init', 'azta_produkt_init');
function azta_produkt_init() 
{
	$aztaz_prod_labels = array(
		'name' => _x('Produkter', 'post type general name'),
		'singular_name' => _x('Produkt', 'post type singular name'),
		'all_items' => __('Alla produkter'),
		'add_new' => _x('Lägg till ny produkt', 'produkt'),
		'add_new_item' => __('Lägg till ny produkt'),
		'edit_item' => __('Justera produkt'),
		'new_item' => __('Ny produkt'),
		'view_item' => __('Visa produkt'),
		'search_items' => __('Sök bland produkter'),
		'not_found' =>  __('Ingen produkt hittad'),
		'not_found_in_trash' => __('Inga produkter hittade i papperskorgen'), 
		'parent_item_colon' => ''
	);
	$args = array(
		'labels' => $aztaz_prod_labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 4,
		'supports' => array('title','editor','thumbnail','excerpt','custom-fields'),
		'has_archive' => 'produkter'
	); 
//    'supports' => array('title','editor','author','thumbnail','excerpt','comments','custom-fields'),
	register_post_type('products',$args);
}


// Add new Custom Post Type icons
add_action( 'admin_head', 'produkt_icons' );
function produkt_icons() {
?>
  <style type="text/css" media="screen">
    #menu-posts-products .wp-menu-image {
      background: url(<?php bloginfo('url') ?>/wp-content/themes/images/produktsmall.png) no-repeat 6px !important;
    }
    .icon32-posts-products {
      background: url(<?php bloginfo('url') ?>/wp-content/themes/images/produkt.png) no-repeat !important;
    }
    </style>
<?php } 


// Add custom taxonomies
add_action( 'init', 'aztaz_create_taxonomies', 0 );

function aztaz_create_taxonomies() 
{
  // Produkt kategori
  $prodkat_labels = array(
    'name' => _x( 'Produkt kategori', 'taxonomy general name' ),
    'singular_name' => _x( 'Produkt kategori', 'taxonomy singular name' ),
    'search_items' =>  __( 'Sök i produkt kategorier' ),
    'all_items' => __( 'Alla produkt kategorier' ),
    'most_used_items' => null,
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Justera produkt kategori' ), 
    'update_item' => __( 'Uppdatera produkt kategori' ),
    'add_new_item' => __( 'Lägg till ny produkt kategori' ),
    'new_item_name' => __( 'Ny produkt kategori' ),
    'menu_name' => __( 'Produkt kategori' ),
  );
  register_taxonomy('prod-type','products',array(
    'hierarchical' => true,
    'labels' => $prodkat_labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array('slug' => 'prod-type' )
  ));
  
  // Produkt-storlek
  $prodsize_labels = array(
    'name' => _x( 'Produkt storlek', 'taxonomy general name' ),
    'singular_name' => _x( 'Produkt storlek', 'taxonomy singular name' ),
    'search_items' =>  __( 'Sök i produkt storlekar' ),
    'all_items' => __( 'Alla produkt storlekar' ),
    'most_used_items' => null,
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Justera produkt storlek' ), 
    'update_item' => __( 'Uppdatera produkt storlek' ),
    'add_new_item' => __( 'Lägg till ny produkt storlek' ),
    'new_item_name' => __( 'Ny produkt storlek' ),
    'menu_name' => __( 'Produkt storlekar' ),
  );
  register_taxonomy('prod-size','products',array(
    'hierarchical' => true,
    'labels' => $prodsize_labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array('slug' => 'prod-size' )
  ));
    
  // Produkt-color
    $prodcol_labels = array(
    'name' => _x( 'Produkt färger', 'taxonomy general name' ),
    'singular_name' => _x( 'Produkt färg', 'taxonomy singular name' ),
    'search_items' =>  __( 'Sök bland produkt färger' ),
    'all_items' => __( 'Alla produkt färger' ),
    'most_used_items' => null,
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Justera produkt färg' ), 
    'update_item' => __( 'Uppdatera produkt färg' ),
    'add_new_item' => __( 'Lägg till ny produkt färg' ),
    'new_item_name' => __( 'Ny produkt färg' ),
    'menu_name' => __( 'Produkt färger' ),
  );
  register_taxonomy('prod-col','products',array(
    'hierarchical' => true,
    'labels' => $prodcol_labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array('slug' => 'prod-col' )
  ));
  
  }
// Produkter ska ingå i sökningen
function search_filter($query) {
  if ( !is_admin() && $query->is_main_query() ) {
    if ($query->is_search) {
      $query->set('post_type', array( 'post', 'products' ) );
    }
  }
}

add_action('pre_get_posts','search_filter');

//Sortering för taxanomier i main query
function prod_filter($query) {
  if ( !is_admin() && $query->is_main_query() ) {
    if ($query->is_tax) {
//      $query->set('orderby', 'title');
      $query->set('orderby', 'meta_value_num');
      $query->set('meta_key', 'Pris');
      $query->set('order', 'ASC');
    }
  }
}

add_action('pre_get_posts','prod_filter');

//some Widgets
//Widget for show taxonomies
class Taxonomy_Widget_Klaselo extends WP_Widget {

  public function __construct() {
    // widget actual processes
    parent::__construct(
     'taxonomy_widget_klaselo', // Base ID
      'Taxonomy Widget Klaselo', // Name
      array( 'description' => 'A Widget to show one taxonomy with links', ) // Args
    );
  }

  public function widget( $args, $instance ) {
    // outputs the content of the widget
    $title = apply_filters( 'widget_title', $instance['title'] );
    $my_tax = $instance['my_tax'];

    echo $args['before_widget'];
    if ( ! empty( $title ) )
      echo $args['before_title'] . $title . $args['after_title'];
    else {
      echo $args['before_title'] . "Taxonomy" . $args['after_title'];
    }

    $argstax = array( 'taxonomy' => $my_tax );
    $terms = get_terms($my_tax, $argstax);
    $count = count($terms); $i=0;
    if ($count > 0) {
        echo "<ul>";
        foreach ($terms as $term) {
          echo "<li>";
          echo '<a href="'. get_term_link( $term ) . '" title="' . sprintf(__('View all post filed under %s', 'my_localization_domain'), $term->name) . '">' . $term->name . '</a>';
          echo "</li>";
        }
        echo "</ul>";
    }
    echo $args['after_widget'];    
  }

  public function form( $instance ) {
    
    // outputs the options form on admin
    if ( isset( $instance[ 'title' ] ) ) {
      $title = $instance[ 'title' ];
    }
    else {
      $title = __( 'Vadå titel', 'text_domain' );
    }
    if ( isset( $instance[ 'my_tax' ] ) ) {
      $my_tax = $instance[ 'my_tax' ];
    }
    else {
      $my_tax = 'prod-type';
    }
    
    ?>
    <p>
    <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />

    <label for="<?php echo $this->get_field_id( 'my_tax' ); ?>"><?php _e( 'Taxonomy:' ); ?></label> 
    <input class="widefat" id="<?php echo $this->get_field_id( 'my_tax' ); ?>" name="<?php echo $this->get_field_name( 'my_tax' ); ?>" type="text" value="<?php echo esc_attr( $my_tax ); ?>" />
    </p>
    <?php 
    
  }

//  public function update( $new_instance, $old_instance ) {
    // processes widget options to be saved
//  }
  Public function update( $new_instance, $old_instance ) {
    $instance = $old_instance;

    /* Strip tags (if needed) and update the widget settings. */
    $instance['title'] = strip_tags( $new_instance['title'] );
    $instance['my_tax'] = strip_tags( $new_instance['my_tax'] );

    return $instance;
  }


}


add_action( 'widgets_init', function(){
     register_widget( 'Taxonomy_Widget_Klaselo' );
});
?>