<?php
/**
 * Template part for displaying featured image, title, date, and read time in posts and archives
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package baseinstall
 */

?>


<div class="singlePost__entryMeta-reviewer"><span>Reviewed by </span><a href="<?php echo get_author_posts_url( $post->reviewed_by); ?>"><?php echo get_the_author_meta( 'display_name',$post->reviewed_by); ?></a></div>

