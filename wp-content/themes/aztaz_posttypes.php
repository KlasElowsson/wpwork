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


?>