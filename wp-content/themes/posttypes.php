<?php

// Add new post type for Recipes
add_action('init', 'cooking_recipes_init');
function cooking_recipes_init() 
{
	$recipe_labels = array(
		'name' => _x('Recipes', 'post type general name'),
		'singular_name' => _x('Recipe', 'post type singular name'),
		'all_items' => __('All Recipes'),
		'add_new' => _x('Add new recipe', 'recipes'),
		'add_new_item' => __('Add new recipe'),
		'edit_item' => __('Edit recipe'),
		'new_item' => __('New recipe'),
		'view_item' => __('View recipe'),
		'search_items' => __('Search in recipes'),
		'not_found' =>  __('No recipes found'),
		'not_found_in_trash' => __('No recipes found in trash'), 
		'parent_item_colon' => ''
	);
	$args = array(
		'labels' => $recipe_labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 5,
		'supports' => array('title','editor','author','thumbnail','excerpt','comments','custom-fields'),
		'has_archive' => 'recipes'
	); 
	register_post_type('recipes',$args);
}

// Add new post type for Photos
add_action('init', 'cooking_photos_init');
function cooking_Photos_init() 
{
	$photo_labels = array(
		'name' => _x('Photos', 'post type general name'),
		'singular_name' => _x('Photo', 'post type singular name'),
		'all_items' => __('All Photos'),
		'add_new' => _x('Add new photo', 'photos'),
		'add_new_item' => __('Add new photo'),
		'edit_item' => __('Edit photo'),
		'new_item' => __('New photo'),
		'view_item' => __('View photo'),
		'search_items' => __('Search in photos'),
		'not_found' =>  __('No photos found'),
		'not_found_in_trash' => __('No photos found in trash'), 
		'parent_item_colon' => ''
	);
	$args = array(
		'labels' => $photo_labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 5,
		'supports' => array('title','editor','author','thumbnail','excerpt','comments','custom-fields'),
		'has_archive' => 'photos'
	); 
	register_post_type('photos',$args);
}

// Add new post type for Videos
add_action('init', 'cooking_videos_init');
function cooking_videos_init() 
{
	$video_labels = array(
		'name' => _x('Videos', 'post type general name'),
		'singular_name' => _x('Video', 'post type singular name'),
		'all_items' => __('All Videos'),
		'add_new' => _x('Add new video', 'videos'),
		'add_new_item' => __('Add new video'),
		'edit_item' => __('Edit video'),
		'new_item' => __('New video'),
		'view_item' => __('View video'),
		'search_items' => __('Search in videos'),
		'not_found' =>  __('No videos found'),
		'not_found_in_trash' => __('No videos found in trash'), 
		'parent_item_colon' => ''
	);
	$args = array(
		'labels' => $video_labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 5,
		'supports' => array('title','editor','author','thumbnail','excerpt','comments','custom-fields'),
		'has_archive' => 'videos'
	); 
	register_post_type('videos',$args);
}

// Add new Custom Post Type icons
add_action( 'admin_head', 'cooking_icons' );
function cooking_icons() {
?>
	<style type="text/css" media="screen">
		#menu-posts-recipes .wp-menu-image {
			background: url(<?php bloginfo('url') ?>/wp-content/themes/images/recipessmall.png) no-repeat 6px !important;
		}
		.icon32-posts-recipes {
			background: url(<?php bloginfo('url') ?>/wp-content/themes/images/recipes.png) no-repeat !important;
		}
		#menu-posts-photos .wp-menu-image {
			background: url(<?php bloginfo('url') ?>/wp-content/themes/images/photosmall.png) no-repeat 6px !important;
		}
		.icon32-posts-photos {
			background: url(<?php bloginfo('url') ?>/wp-content/themes/images/photo.png) no-repeat !important;
		}
		#menu-posts-videos .wp-menu-image {
			background: url(<?php bloginfo('url') ?>/wp-content/themes/images/videosmall.png) no-repeat 6px !important;
		}
		.icon32-posts-videos {
			background: url(<?php bloginfo('url') ?>/wp-content/themes/images/video.png) no-repeat !important;
		}

    </style>
<?php } 


// Add custom taxonomies
add_action( 'init', 'cooking_create_taxonomies', 0 );

function cooking_create_taxonomies() 
{
	// Meal type
	$meal_labels = array(
		'name' => _x( 'Meal type', 'taxonomy general name' ),
		'singular_name' => _x( 'Meal type', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search in meal type' ),
		'all_items' => __( 'All meal type' ),
		'most_used_items' => null,
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => __( 'Edit meal type' ), 
		'update_item' => __( 'Update meal type' ),
		'add_new_item' => __( 'Add new meal type' ),
		'new_item_name' => __( 'New meal type' ),
		'menu_name' => __( 'Meal type' ),
	);
	register_taxonomy('meal-type',array('recipes','photos','videos'),array(
		'hierarchical' => true,
		'labels' => $meal_labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'meal-type' )
	));
	
	// Level of difficulty
	$difficulty_labels = array(
		'name' => _x( 'Levels of difficulty', 'taxonomy general name' ),
		'singular_name' => _x( 'Level of difficulty', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search in level of difficulty' ),
		'all_items' => __( 'All levels of difficulty' ),
		'most_used_items' => null,
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => __( 'Edit level of difficulty' ), 
		'update_item' => __( 'Update level of difficulty' ),
		'add_new_item' => __( 'Add new level of difficulty' ),
		'new_item_name' => __( 'New level of difficulty' ),
		'menu_name' => __( 'Levels of difficulty' ),
	);
	register_taxonomy('difficulty','recipes',array(
		'hierarchical' => true,
		'labels' => $difficulty_labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'difficulty' )
	));

	// Ingredients
		$ingredients_labels = array(
		'name' => _x( 'Ingredients', 'taxonomy general name' ),
		'singular_name' => _x( 'Ingredient', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search in ingredients' ),
		'popular_items' => __( 'Popular ingredients' ),
		'all_items' => __( 'All ingredients' ),
		'most_used_items' => null,
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => __( 'Edit ingredient' ), 
		'update_item' => __( 'Update ingredient' ),
		'add_new_item' => __( 'Add new ingredient' ),
		'new_item_name' => __( 'New ingredient name' ),
		'separate_items_with_commas' => __( 'Separate ingredients with commas' ),
	    'add_or_remove_items' => __( 'Add or remove ingredients' ),
	    'choose_from_most_used' => __( 'Choose from the most used ingredients' ),
		'menu_name' => __( 'Ingredients' ),
	);
	register_taxonomy('ingredients',array('recipes','photos','videos'),array(
		'hierarchical' => false,
		'labels' => $ingredients_labels,
		'show_ui' => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var' => true,
		'rewrite' => array('slug' => 'ingredient' )
	));

	// Preparation time
	$time_labels = array(
		'name' => _x( 'Preparation time', 'taxonomy general name' ),
		'singular_name' => _x( 'Preparation time', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search in preparation times' ),
		'all_items' => __( 'All preparation times' ),
		'most_used_items' => null,
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => __( 'Edit preparation time' ), 
		'update_item' => __( 'Update preparation time' ),
		'add_new_item' => __( 'Add new preparation time' ),
		'new_item_name' => __( 'New preparation time' ),
		'menu_name' => __( 'Preparation time' ),
	);
	register_taxonomy('time','recipes',array(
		'hierarchical' => true,
		'labels' => $time_labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'time' )
	));
	
	// Servings
	$servings_labels = array(
		'name' => _x( 'Servings', 'taxonomy general name' ),
		'singular_name' => _x( 'Servings', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search in servings' ),
		'all_items' => __( 'All servingss' ),
		'most_used_items' => null,
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => __( 'Edit serving' ), 
		'update_item' => __( 'Update serving' ),
		'add_new_item' => __( 'Add new serving' ),
		'new_item_name' => __( 'New serving' ),
		'menu_name' => __( 'Servings' ),
	);
	register_taxonomy('servings','recipes',array(
		'hierarchical' => true,
		'labels' => $servings_labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'serving' )
	));

	// Technique (photos)
	$techniques_labels = array(
		'name' => _x( 'Techniques', 'taxonomy general name' ),
		'singular_name' => _x( 'Technique', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search in techniques' ),
		'all_items' => __( 'All techniques' ),
		'most_used_items' => null,
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => __( 'Edit technique' ), 
		'update_item' => __( 'Update technique' ),
		'add_new_item' => __( 'Add new technique' ),
		'new_item_name' => __( 'New technique' ),
		'menu_name' => __( 'Techniques' ),
	);
	register_taxonomy('techniques','photos',array(
		'hierarchical' => true,
		'labels' => $techniques_labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'technique' )
	));
	
	// Video type
	$video_labels = array(
		'name' => _x( 'Video type', 'taxonomy general name' ),
		'singular_name' => _x( 'Video type', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search in video types' ),
		'all_items' => __( 'All video types' ),
		'most_used_items' => null,
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => __( 'Edit video type' ), 
		'update_item' => __( 'Update video type' ),
		'add_new_item' => __( 'Add new video type' ),
		'new_item_name' => __( 'New video type' ),
		'menu_name' => __( 'Video types' ),
	);
	register_taxonomy('video-types','videos',array(
		'hierarchical' => true,
		'labels' => $video_labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'video-types' )
	));
}


?>