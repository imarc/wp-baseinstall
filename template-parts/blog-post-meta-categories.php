<?php
/**
 * Template part for displaying featured image, title, date, and read time in posts and archives
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package baseinstall
 */

?>

<?php 
    // Taking care of   all pages, posts, and custom post type categories 
    $post_type = get_post_type();

    if ( 'page' === $post_type ) {
        echo 'Page';

    } elseif ( 'resources' == get_post_type() ) {
        // if there are categories, get the first one 
        $terms = wp_get_post_terms($post->ID, 'resource-types');
        if ( ! empty( $terms ) ) {
            echo '<a class="singlePost__entryMeta-terms" href="'.get_term_link($terms[0], 'resource-types').'">'.$terms[0]->name.'</a> <span class="singlePost__entryMeta-termSeparator">|</span>';
        }

        // // in case we want to get ALL of the categories 
     //    $terms = wp_get_post_terms($post->ID, 'resource-types'); 
     //    foreach ( $terms as $term ) {
     //        $term_link = get_term_link( $term );
     //        if ( is_wp_error( $term_link ) ) { continue; }
     //        echo ' <a class="singlePost__entryMeta-category" href="' . esc_url( $term_link ) . '">' . $term->name . '</a> <span class="singlePost__entryMeta-separator">|</span>';
     //    }

    } elseif ( 'press' == get_post_type() ) {
        // if there are categories, get the first one 
        $terms = wp_get_post_terms($post->ID, 'press-types');
        if ( ! empty( $terms ) ) {
            echo '<a class="singlePost__entryMeta-terms" href="'.get_term_link($terms[0], 'press-types').'">'.$terms[0]->name.'</a> <span class="singlePost__entryMeta-termSeparator">|</span>';
        }

        // // in case we want to get ALL of the categories 
     //    $terms = wp_get_post_terms($post->ID, 'press-types'); 
     //    foreach ( $terms as $term ) {
     //        $term_link = get_term_link( $term );
     //        if ( is_wp_error( $term_link ) ) { continue; }
     //        echo ' <a class="singlePost__entryMeta-category" href="' . esc_url( $term_link ) . '">' . $term->name . '</a> <span class="singlePost__entryMeta-separator">|</span>';
     //    }

    } else {
        $categories = get_the_category();
        if ( ! empty( $categories ) ) {
            echo '<a class="singlePost__entryMeta-terms" href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a> <span class="singlePost__entryMeta-termSeparator">|</span>';
        }

        // // in case we want to get ALL of the categories 
        // $categories = get_the_category();
        // if ( ! empty( $categories ) ) {
        //  foreach( $categories as $category ) {
        //      echo ' <a class="singlePost__entryMeta-category" href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a> <span class="singlePost__entryMeta-separator">|</span>';
        //  }
        // }
    } 
?>
