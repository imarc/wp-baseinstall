<?php
/**
 * Template part for displaying related items at the bottom of blog posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package baseinstall
 */

?>

<div class="blogSection__related">

    <div class="blogSection__relatedHeader">
        <h4 class="blogSection__relatedTitle">You might also like</h4>
        <?php /* <a class="blogSection__relatedLink" href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>">See blog</a> */ ?>
    </div>

    <div class="blogSection__container">
        <div class="blogSection__posts -relatedPosts">
            <?php // get 3 related regular posts 
                $orig_post = $post;
                global $post;
                $categories = get_the_category($post->ID);
                if ($categories) {
                    $category_ids = array();
                    foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
                    $args=array(
                        'category__in' => $category_ids,
                        'post__not_in' => array($post->ID), // exclude current post 
                        'posts_per_page'=> 3, // Number of related posts that will be shown.
                    );
                    $baseinstall_query = new wp_query( $args );
                    if( $baseinstall_query->have_posts() ) {
                        while( $baseinstall_query->have_posts() ) {
                            $baseinstall_query->the_post();
                            get_template_part('template-parts/blog-featured-post-card'); // post featured image, title, date, read time, and link
                        }
                    } else { 
                        // if no related posts, just grab the most 3 most recent non-sticky posts 
                        $recentPosts = new WP_Query(array(
                            'showposts' => 3, 
                            'offset' => 0,  // Set this to 1 to skip over first post, 2 to skip the first two, etc.
                            'order' => 'DESC', // Puts new posts first, to put oldest posts first, change to 'ASC'
                            'post__not_in' => get_option("sticky_posts"), // Ignore sticky posts for this particular query
                        ));
                        while ($recentPosts->have_posts()) : $recentPosts->the_post();
                            get_template_part('template-parts/blog-featured-post-card'); // post featured image, title, date, read time, and link
                        endwhile; 
                    }
                }
                $post = $orig_post;
                wp_reset_query(); 
            ?>
        </div>
    </div>

</div>
