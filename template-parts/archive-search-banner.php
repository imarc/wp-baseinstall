<?php
/**
 * Template part for displaying featured image, title, date, and read time in posts and archives
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package baseinstall
 */

?>

<div class="blogIntro -archive">
    <div class="container">
        <?php if ( is_search() ) : ?>
            <?php // get number of search results, change wording whether singular or plural
            $allsearch = $wp_query;
            $total_results = $allsearch ->found_posts;
            $plural_or_not = ($allsearch ->found_posts == 1) ?  'result' : 'results'; ?>
            <span class="blogIntro__eyebrow"><?php echo $total_results . ' ' . $plural_or_not; ?> found for: </span><h1 class="blogIntro__title"><?php echo get_search_query(); ?></h1>

        <?php elseif ( is_category() ) : ?>
            <?php single_cat_title( '<span class="blogIntro__eyebrow">Items categorized: </span><h1 class="blogIntro__title">', '</h1>' ); ?>

        <?php elseif ( is_tax() ) : // can also be specific like so: is_tax( 'some-taxonomy' ); ?>
            <?php single_cat_title( '<span class="blogIntro__eyebrow">Items categorized: </span><h1 class="blogIntro__title">', '</h1>' ); ?>

        <?php elseif ( is_tag() ) : ?>
            <?php single_tag_title( '<span class="blogIntro__eyebrow">Items tagged: </span><h1 class="blogIntro__title">', '</h1>' ); ?>

        <?php elseif ( is_author() ) : 
            $temp_post = get_post();
            $user_id = get_the_author_meta( 'ID' ); 
            $display_name = get_the_author_meta('display_name', $user_id); // default username, if nothing else, this will be there 
            $first_name = get_the_author_meta('first_name',$user_id);
            $last_name = get_the_author_meta('last_name',$user_id);
            $full_name = "{$first_name} {$last_name}"; ?>
            <h1 class="blogIntro__title">Posts by <?php echo ( !empty( $first_name ) && !empty( $last_name ) ) ?  $full_name : $display_name; ?></h1>

        <?php elseif ( is_month() ) : ?>
            <?php the_archive_title( '<h1 class="blogIntro__title">', '</h1>' ); ?>

        <?php elseif ( is_post_type_archive() ) : ?>
            <?php post_type_archive_title( '<h1 class="blogIntro__title">', '</h1>' ); ?>

        <?php elseif ( is_home() ) : ?>
            <?php $post_page_title = get_the_title( get_option('page_for_posts', true) ); ?>
            <h1 class="blogIntro__title"><?php echo $post_page_title; ?></h1>

        <?php else : ?>
            <?php get_template_part('template-parts/blog-feature-banner'); // featured section ?>

        <?php endif; ?>

        <div class="blogIntro__pagination">
            <?php // Add status message to the effect of "showing posts 1-10 of X results "
            if ( !have_posts() ) {
                echo "<div class='pagination__count'>0 results</div>"; 
            } elseif ( is_main_query() ) {
                $pagenum = $wp_query->query_vars['paged'] < 1 ? 1 : $wp_query->query_vars['paged'];
                $first = ( ( $pagenum - 1 ) * $wp_query->query_vars['posts_per_page'] ) + 1;
                $last = $first + $wp_query->post_count - 1;
                echo "<div class='pagination__count'>Showing $first - $last of $wp_query->found_posts results</div>"; 
            } else {
                $pagenum = $query->query_vars['paged'] < 1 ? 1 : $query->query_vars['paged'];
                $first = ( ( $pagenum - 1 ) * $query->query_vars['posts_per_page'] ) + 1;
                $last = $first + $query->post_count - 1;
                echo "<div class='pagination__count'>Showing $first - $last of $query->found_posts results</div>"; 
            } ?>
        </div>

    </div>
</div>
