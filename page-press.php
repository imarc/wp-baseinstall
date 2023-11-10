<?php
/**
 * Template Name: Press Archive
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package baseinstall
 */

while ( have_posts() ) :
	the_post();

    // get page content, hero, testimonial, etc.
	get_template_part( 'template-parts/content', 'page' );

endwhile; // End of the loop.
?>


<div class="press">
    <div class="press__releases container">

        <h1 class="-section-title">Press Releases</h1>

        <?php
        global $post;
        $recentPosts = new WP_Query(array(
            'post_type' => 'press',
            'tax_query' => array(
                array (
                    'taxonomy' => 'press-types',
                    'field' => 'slug',
                    'terms' => 'press-releases',
                )
            ),
            'showposts' => 10, // Number of posts to pull
            'order' => 'DESC', // Puts new posts first, to put oldest posts first, change to 'ASC'query
        ));
        while ($recentPosts->have_posts()) : $recentPosts->the_post();
            /**
             * PRESS RELEASE EXCERPT
             * Template part for press release excerpts */
            get_template_part('template-parts/press-release-card'); ?>

            <?php 
        endwhile; wp_reset_postdata(); ?>

        <a class="button" href="<?php echo get_term_link( 'press-releases', 'press-types' ); ?>">View All</a>

    </div>
</div>







<div class="press press-media">
    <div class="press__media">

        <h1 class="-section-title">Media coverage</h1>

        <div class="-row">

            <?php
            global $post;
            $recentPosts = new WP_Query(array(
                'post_type' => 'press',
                'tax_query' => array(
                    array (
                        'taxonomy' => 'press-types',
                        'field' => 'slug',
                        'terms' => 'media-coverage',
                    )
                ),
                'showposts' => 6, // Number of posts to pull
                'offset' => 0,  // Set this to 1 to skip over first post, 2 to skip the first two, etc.
                'order' => 'DESC', // Puts new posts first, to put oldest posts first, change to 'ASC'
                'post__not_in' => get_option("sticky_posts"), // Ignore sticky posts for this particular query
            ));

            while ($recentPosts->have_posts()) : $recentPosts->the_post(); 
                /**
                 * PRESS MEDIA EXCERPT
                 * Template part for media mentions */
                get_template_part('template-parts/press-media-card'); 

            endwhile; wp_reset_postdata(); ?>

        </div>

        <?php /* <a class="button" href="/press/media-coverage/">View All</a> */ ?>
        <a class="button" href="<?php echo get_term_link( 'media-coverage', 'press-types' ); ?>">View All</a>

    </div>
</div>
