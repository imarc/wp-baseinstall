<?php
/**
 * Custom Post Type additional functions  
 *
 * @package baseinstall
 */



/**
 * CUSTOM POST TYPE CHECK 
 * Check if a post is a custom post type.
 * mixed $post Post object or ID boolean
 */
function is_custom_post_type( $post = NULL ) {
    $all_custom_post_types = get_post_types( array ( '_builtin' => FALSE ) );

    // there are no custom post types
    if ( empty ( $all_custom_post_types ) )
        return FALSE;

    $custom_types      = array_keys( $all_custom_post_types );
    $current_post_type = get_post_type( $post );

    // could not detect current type
    if ( ! $current_post_type )
        return FALSE;

    return in_array( $current_post_type, $custom_types );
}



/**
 * ADD TAGS TO CUSTOM POST TYPE ARCHIVES 
 * include CPTs in tag searches  
 */
function post_type_tags_fix($request) {
    if ( isset($request['tag']) && !isset($request['post_type']) )
    $request['post_type'] = 'any';
    return $request;
} 
add_filter('request', 'post_type_tags_fix');



/**
 * ADD CUSTOM POST TYPES TO AUTHOR PAGE 
 * include CPTs in search of author content 
 */
function post_types_author_archives($query) {
    // Add 'press' and 'resource' post types to author archives
    // Add more post types in single quotes before 'post'
    if ( $query->is_author ) {
        $query->set( 'post_type', array('press', 'resources', 'post') );
        // Remove the action after it runs 
        remove_action( 'pre_get_posts', 'post_types_author_archives' );
    }
}
add_action( 'pre_get_posts', 'post_types_author_archives' );



