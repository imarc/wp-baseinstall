<?php
/**
 * Template part for displaying featured image, title, date, and read time in posts and archives
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package baseinstall
 */

?>

<div class="blogSection">
    <div class="blogSection__container">

        <?php if ( is_home() && !is_paged() ) { ?>
            <h2 class="blogSection__title">Blog posts</h2>
        <?php } ?>

        <div class="blogSection__posts">
            <?php // Start the Loop 
            while ( have_posts() ) : 
                the_post();
                if ( is_search() ) {
                    get_template_part( 'template-parts/content', 'search' ); // if search, grab matching items
                    // echo 'search';
                } else {
                    get_template_part( 'template-parts/content', get_post_type() ); // otherwise, get relevant content
                    // echo 'regular content';
                }
            endwhile; 
            ?>

            <?php /* placeholders for keeping flex item spacing consistent */ ?>
            <i class="featuredPosts__blog-spacer" aria-hidden="true"></i>
            <i class="featuredPosts__blog-spacer" aria-hidden="true"></i>
        </div>

        <div class="pagination">
            <?php baseinstall_numeric_posts_nav(); ?>
        </div>

    </div>
</div>


<?php 
/**
 * BLOG PAGE CONTENT
 * This will get the content blocks added on the Blog page
 * Located in archive-post-grid.php and content.php 
 */
$page_for_posts_id = get_option( 'page_for_posts' );
echo apply_filters( 'the_content', get_post_field( 'post_content', $page_for_posts_id ) );
?>
