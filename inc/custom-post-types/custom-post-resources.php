<?php
/**
 * Custom Post Type - Resources 
 * Client Stories, Whitepapers, Webinars, Videos, and Infographics
 *
 * @package baseinstall
 */

function baseinstall_resources_post_type() {
	$labels = array(
		'name'                => __( 'Resources'),
		'singular_name'       => __( 'Resource'),
		'menu_name'           => __( 'Resources'),
		'parent_item_colon'   => __( 'Parent Resource'),
		'all_items'           => __( 'All Resources'),
		'view_item'           => __( 'View Resource'),
		'add_new_item'        => __( 'Add New Resource'),
		'add_new'             => __( 'Add New'),
		'edit_item'           => __( 'Edit Resource'),
		'update_item'         => __( 'Update Resource'),
		'search_items'        => __( 'Search Resources'),
		'not_found'           => __( 'Not Found'),
		'not_found_in_trash'  => __( 'Not found in Trash')
	);
	$args = array(
		'label'               => __( 'resources'),
		'description'         => __( 'Resources and Webinars'),
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
		'taxonomies'		 			=> array( 'resource-types, post_tag' ),
		'menu_icon'           => 'dashicons-book-alt',
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
    // 'rewrite'							=> true,
    'rewrite' => array('slug' => 'resources', 'with_front' => false),
	);
	register_post_type( 'resources', $args );
}
add_action( 'init', 'baseinstall_resources_post_type', 0 );


// Taxonomy for Custom Post Type
function baseinstall_resource_types_taxonomy() {
  $labels = array(
    'name' 							=> _x( 'Resource Types', 'taxonomy general name' ),
    'singular_name' 		=> _x( 'Resource Type', 'taxonomy singular name' ),
    'search_items' 			=>  __( 'Search Resource Types' ),
    'all_items' 				=> __( 'All Resource Types' ),
    'parent_item' 			=> __( 'Parent Resource Type' ),
    'parent_item_colon'	=> __( 'Parent Resource Type:' ),
    'edit_item' 				=> __( 'Edit Resource Type' ), 
    'update_item' 			=> __( 'Update Resource Type' ),
    'add_new_item' 			=> __( 'Add New Resource Type' ),
    'new_item_name' 		=> __( 'New Resource Type Name' ),
    'menu_name' 				=> __( 'Resource Types' ),
  ); 	
  register_taxonomy('resource-types',array('resources'), array(
    'hierarchical'			=> true,
		'has_archive'				=> true,
    'labels'						=> $labels,
    'show_ui'						=> true,
    'show_admin_column'	=> true,
    'query_var'					=> true,
    // 'rewrite' 					=> true,
    // 'rewrite' => array('with_front' => false),
    'rewrite' 					=> array( 'slug' => 'all-resources', 'pages' => true, 'with_front' => false),
		'show_in_rest'			=> true,
  ));
}
add_action( 'init', 'baseinstall_resource_types_taxonomy', 0 );



/**
* Function to add Tag Selection to Custom Post Type
*/
function add_tag_to_resources() {
	register_taxonomy_for_object_type('post_tag', 'resources');
}
add_action('init', 'add_tag_to_resources');
