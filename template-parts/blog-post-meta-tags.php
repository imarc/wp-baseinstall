<?php
/**
 * Template part for displaying featured image, title, date, and read time in posts and archives
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package baseinstall
 */

?>

<?php // get post tags if they exist 
$terms = wp_get_post_terms($post->ID); 
if ( ! empty( $terms ) ) { ?>
    <div class="singlePost__entrySidebar-tags">
        <div class="singlePost__entrySidebar-tagsHeading">
            Tags
        </div>

        <?php 
            // get tags 
            foreach ( $terms as $term ) {
                $term_link = get_term_link( $term );
                if ( is_wp_error( $term_link ) ) { continue; }
                echo '<a class="singlePost__entrySidebar-tagsButton" href="' . esc_url( $term_link ) . '">' . $term->name . '</a>';
            }
        ?>
    </div>
<?php } ?>
