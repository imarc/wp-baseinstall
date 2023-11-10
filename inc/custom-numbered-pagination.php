<?php
/**
 * Custom numbered pagination 
 *
 * @package baseinstall
 */



/**
 * NUMBERED PAGINATION
 * Add some proper numbered pagination to lists of posts, with links
 * The call to baseinstall_numeric_posts_nav() appears in: archive.php, front-page.php, index.php, and search.php
 */
function baseinstall_numeric_posts_nav() {
    if( is_singular() )
        return;

    global $wp_query;

    // Stop execution if there's only 1 page
    if( $wp_query->max_num_pages <= 1 )
        return;

    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max   = intval( $wp_query->max_num_pages );

    // Add current page to the array
    if ( $paged >= 1 )
        $links[] = $paged;

    // Add the pages around the current page to the array
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }

    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }

    // Open containing pagination <div> and <ul>
    echo '<ul>' . "\n";

    // Previous Post Link
    if ( get_previous_posts_link() )
        // printf( '<li class="prev-next">%s</li>' . "\n", get_previous_posts_link( 'Previous Page' ) );
        printf( '<li class="prev-next">%s</li>' . "\n", get_previous_posts_link( '<span class="pagination__chevron -prev icon-chevron-left"></span>' ) );

    // Link to first page, plus ellipses if necessary
    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );
        if ( ! in_array( 2, $links ) )
            echo '<li>…</li>';
    }

    // Link to current page, plus 2 pages in either direction if necessary
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
    }

    // Link to last page, plus ellipses if necessary
    if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) )
            echo '<li>…</li>' . "\n";
        $class = $paged == $max ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
    }

    // Next Post Link
    if ( get_next_posts_link() )
        // printf( '<li class="prev-next">%s</li>' . "\n", get_next_posts_link( 'Next Page' ) );
        printf( '<li class="prev-next">%s</li>' . "\n", get_next_posts_link( '<span class="pagination__chevron -next icon-chevron-right"></span>' ) );

    // Close containing <div> and <ul>
    echo '</ul>' . "\n";

    // Add status message to the effect of "showing posts 1-10 of X results "
    if ( is_main_query() ) {
        $pagenum = $wp_query->query_vars['paged'] < 1 ? 1 : $wp_query->query_vars['paged'];
        $first = ( ( $pagenum - 1 ) * $wp_query->query_vars['posts_per_page'] ) + 1;
        $last = $first + $wp_query->post_count - 1;
        echo "<div class='pagination__count'>$first - $last of $wp_query->found_posts results</div>"; 
    } else {
        $pagenum = $query->query_vars['paged'] < 1 ? 1 : $query->query_vars['paged'];
        $first = ( ( $pagenum - 1 ) * $query->query_vars['posts_per_page'] ) + 1;
        $last = $first + $query->post_count - 1;
        echo "<div class='pagination__count'>$first - $last of $query->found_posts results</div>"; 
    }
}

