<?php
/**
 * Custom Post Type - Press 
 * Press Releases and Media Coverage
 *
 * @package baseinstall
 */

function baseinstall_press_post_type() {
	$labels = array(
		'name'                => __( 'News & Press'),
		'singular_name'       => __( 'News & Press'),
		'menu_name'           => __( 'News & Press'),
		'parent_item_colon'   => __( 'Parent Press'),
		'all_items'           => __( 'All News & Press'),
		'view_item'           => __( 'View Post'),
		'add_new_item'        => __( 'Add New Press'),
		'add_new'             => __( 'Add New'),
		'edit_item'           => __( 'Edit Press'),
		'update_item'         => __( 'Update Press'),
		'search_items'        => __( 'Search News & Press'),
		'not_found'           => __( 'Not Found'),
		'not_found_in_trash'  => __( 'Not found in Trash')
	);
	$args = array(
		'label'               => __( 'press'),
		'description'         => __( 'News & Press Releases'),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields'),
		'public'              => true,
		'hierarchical'        => false,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'has_archive'         => true,
		'show_in_rest' 		    => true,
		'can_export'          => true,
		'exclude_from_search' => false,
		// 'exclude_from_search' => true,
		'taxonomies'		 			=> array( 'press-types, post_tag' ),
		'menu_icon'           => 'dashicons-megaphone',
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
    // 'rewrite'							=> true,'
    'rewrite' => array('slug' => 'press', 'with_front' => false),
	);
	register_post_type( 'press', $args );
}
add_action( 'init', 'baseinstall_press_post_type', 0 );


// Taxonomy for Custom Post Type
function baseinstall_press_types_taxonomy() {
  $labels = array(
    'name' 							=> _x( 'Press Types', 'taxonomy general name' ),
    'singular_name' 		=> _x( 'Press Type', 'taxonomy singular name' ),
    'search_items' 			=>  __( 'Search Press Types' ),
    'all_items' 				=> __( 'All Press Types' ),
    'parent_item' 			=> __( 'Parent Press Type' ),
    'parent_item_colon'	=> __( 'Parent Press Type:' ),
    'edit_item' 				=> __( 'Edit Press Type' ), 
    'update_item' 			=> __( 'Update Press Type' ),
    'add_new_item' 			=> __( 'Add New Press Type' ),
    'new_item_name' 		=> __( 'New Press Type Name' ),
    'menu_name' 				=> __( 'Press Types' ),
  ); 	
  register_taxonomy('press-types',array('press'), array(
    'hierarchical' 			=> true,
		'has_archive'				=> true,
    'labels' 						=> $labels,
    'show_ui' 					=> true,
    'show_admin_column'	=> true,
    'query_var' 				=> true,
    // 'rewrite' 					=> true,
    'rewrite' 					=> array( 'slug' => 'all-press', 'pages' => true, 'with_front' => false),
    // 'rewrite' => array('with_front' => false),
		'show_in_rest' 			=> true,
  ));
}
add_action( 'init', 'baseinstall_press_types_taxonomy', 0 );



/**
* Function to add Tag Selection to Custom Post Type
*/
function add_tag_to_press() {
	register_taxonomy_for_object_type('post_tag', 'press');
}
add_action('init', 'add_tag_to_press');
