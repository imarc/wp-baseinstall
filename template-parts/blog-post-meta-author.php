<?php
/**
 * Template part for displaying featured image, title, date, and read time in posts and archives
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package baseinstall
 */

?>


<a class="singlePost__entryMeta-author" href="<?php echo get_author_posts_url( $post->post_author); ?>"><?php echo get_the_author_meta( 'display_name',$post->post_author); ?></a><span class="singlePost__entryMeta-separator">|</span>

