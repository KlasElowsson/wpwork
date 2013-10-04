<?php

	define( 'HEADER_IMAGE_WIDTH', apply_filters( 'twentyten_header_image_width', 980 ) );
	define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'twentyten_header_image_height', 224 ) );

	function remove_twentyTen_headers() {
	unregister_default_headers( array(
	'berries',
	'cherryblossom',
	'concave',
	'fern',
	'forestfloor',
	'inkwell',
	'path',
	'sunset'	
	));
}
	
	add_action('after_setup_theme','remove_twentyTen_headers',11);
	
	register_default_headers( 
	array(
		'TheNewCool' => array(
			'url' => "%s/../thenewcool/images/HPmainGeneric.png",
			'thumbnail_url' => "%s/../thenewcool/images/HPmainGenericThumb.png",
			/* translators: header image description */
			'description' => __( 'The New Cool Header', 'twentyten' )
		)
	) 
);

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'header' => __( 'Header Navigation', 'twentyten' ),
		'footer' => __( 'Footer Navigation', 'twentyten' ),
	) );
	
	function tnc_remove_default_menu() {
		unregister_nav_menu('primary');
	}

	add_action('after_setup_theme','tnc_remove_default_menu',11);
	
	
	function tnc_remove_widgets(){
		unregister_sidebar( 'fourth-footer-widget-area' );
	}

	add_action( 'widgets_init', 'tnc_remove_widgets', 11 );
	
	// Register new widgetized areas
	function tnc_widgets_init() {

		// Area 1a, below Area 1 to the left.
	register_sidebar( array(
		'name' => __( 'Left Widget Area', 'twentyten' ),
		'id' => 'left-widget-area',
		'description' => __( 'Left widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 1b, below Area 1 to the right.
	register_sidebar( array(
		'name' => __( 'Right Widget Area', 'twentyten' ),
		'id' => 'right-widget-area',
		'description' => __( 'Right widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	}
	
	add_action( 'widgets_init', 'tnc_widgets_init' );
	
	add_image_size( 'small', 75, 75, true);
	add_image_size( 'medium', 280, 280, true);
	add_image_size( 'large', 616, 462, true);
	
	function tnc_contactmethods($contactmethods) {
		// Add Twitter
		$contactmethods['twitter'] = 'Twitter';
		return $contactmethods;
	}
	
	add_filter('user_contactmethods','tnc_contactmethods',10,1);
	
function tnc_hideMeta() {
	if (!is_admin()) {
		// register your script location, dependencies and version
		wp_register_script('hide',
			get_stylesheet_directory_uri() . '/js/hider.js',
			array('jquery') );
   // enqueue the script
   wp_enqueue_script('hide');			
	}
}

add_action('init', 'tnc_hideMeta');
	

?>