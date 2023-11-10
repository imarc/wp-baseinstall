<?php
/**
 * Miscellaneous Custom Functions 
 *
 * @package baseinstall
 */



/**
 * FAVICONS
 * Add custom favicons to admin dashboard and front end of site
 */
function baseinstall_admin_favicon() {
    $admin_favicon_url = get_stylesheet_directory_uri() . '/assets/favicons';
    echo '<link rel="shortcut icon" href="' . $admin_favicon_url . '/admin-favicon.ico" />';
}
add_action('login_head', 'baseinstall_admin_favicon');
add_action('admin_head', 'baseinstall_admin_favicon');

function baseinstall_main_favicon() {
    $main_favicon_url = get_stylesheet_directory_uri() . '/assets/favicons';
    echo '
    <link rel="shortcut icon" href="' . $main_favicon_url . '/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="' . $main_favicon_url . '/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="' . $main_favicon_url . '/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="' . $main_favicon_url . '/favicon-16x16.png">
    <link rel="manifest" href="' . $main_favicon_url . '/site.webmanifest">
    <link rel="mask-icon" href="' . $main_favicon_url . '/safari-pinned-tab.svg" color="#fbcc45">
    <meta name="msapplication-TileColor" content="#fbcc45">
    <meta name="msapplication-config" content="' . $main_favicon_url . '/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    ';
}
add_action('wp_head', 'baseinstall_main_favicon');



/**
 * Add SVG mime type 
 */
function add_svg_to_upload_mimes( $upload_mimes ) {
    $upload_mimes['svg'] = 'image/svg+xml';
    $upload_mimes['svgz'] = 'image/svg+xml';
    
    return $upload_mimes;
}
add_filter( 'upload_mimes', 'add_svg_to_upload_mimes', 10, 1 );



/**
 * CUSTOM EXCERPT LENGTH
 * Control length of blog excerpts.
 * For more consistent display, this will get the first two sentences 
 * of a blog post if the first sentence has fewer than twenty words 
 */
function custom_excerpt_length($excerpt) {
    $sentences = preg_split('/(?<=[.?!;:])/', $excerpt);
    $number_of_words = 20; 

    return substr_count($sentences[0], ' ') > $number_of_words  ? $sentences[0] : implode(' ', array_slice($sentences, 0, 2));
}
add_filter('get_the_excerpt', 'custom_excerpt_length', 999 );



/**
 * ESTIMATED READ TIME
 * Adds estimated read time to posts, 
 * based on 200 words per minute average  
 */
function wp_reading_time() {
    global $post;
    $content = get_post_field( 'post_content', $post->ID ); // get content
    $word_count = str_word_count( strip_tags( $content ) ); // count number of words
    $image_count = substr_count( $content, '<img' ); // count number of images
    $reading_time = $word_count / 200; // estimate ~200 words per minute
    $image_time = ( $image_count * 10 ) / 60; // add 10 sec for each image
    $total_time = round( $reading_time + $image_time ); // add time

    // if ( $total_time == 1 ) { $minute = " minute"; } // singular or plural
    // else { $minute = " minutes"; }

    if ( ! is_a($post, 'WP_Post') ) return; // if NOT a post, ignore
    // return $total_time . $minute; // if a post, return read time with 'min' label
    return $total_time; // if a post, return read time
}



/**
 * REMOVE STICKY POSTS FROM MAIN QUERY
 * Ensures that sticky posts only show up in
 * the custom block at top of main blog page
 */
function custom_post_archive_changes( $query ) {
    if ( is_home() && $query->is_main_query() ) {
        // exclude sticky posts from main blog page
        $get_sticky_posts = get_option("sticky_posts");
        $query->set( 'post__not_in', $get_sticky_posts );
    }
}
add_action( 'pre_get_posts', 'custom_post_archive_changes' );



/**
 * CUSTOM AUTHOR BASE SLUG
 * Handy when using a custom permalink taxonomy and you 
 * don't want URLs to be website.com/blog/author/johnsmith
 */
function custom_author_base_slug(){
    global $wp_rewrite;
    $wp_rewrite->author_base = 'author';
    $wp_rewrite->author_structure = '/' . $wp_rewrite->author_base . '/%author%';
}
add_action('init', 'custom_author_base_slug');






/**
 * DEFER SCRIPTS 
 * Trying to gain some extra page speed 
 */
function defer_parsing_of_js( $url ) {
    if ( is_user_logged_in() ) return $url; // don't break WP Admin, dummy 
    if ( FALSE === strpos( $url, '.js' ) ) return $url;
    if ( strpos( $url, 'jquery.js' ) ) return $url; // ignore jquery, WP needs it 
    return str_replace( ' src', ' defer src', $url );
}
add_filter( 'script_loader_tag', 'defer_parsing_of_js', 10 );



/**
 * HTTP Strict Transport Security (HSTS)
 * Set X-Frame-Options 
 * Add additional security headers to prevent click-jacking
 * Includes subdomain support 
 */
// function baseinstall_additional_securityheaders( $headers ) {
//     if ( ! is_admin() ) {
//         $headers['Strict-Transport-Security'] = 'max-age=31536000; includeSubDomains';
//         // prevent click-jacking
//         $headers['X-Frame-Options'] = 'SAMEORIGIN';
//         // x-content type options 
//         $headers['x-content-type-options'] = 'nosniff';
//         // iframe policy, only allow specific 3rd party iframes
//         $headers['Content-Security-Policy'] = "frame-ancestors 'none'; frame-src 'self' *.doubleclick.net *.vimeo.com *.facebook.com *.marketo.com *.driftt.com *.zdassets.com *.zendesk.com *.hotjar.com *.googletagmanager.com *.youtube-nocookie.com *.youtube.com https://get.baseinstall.com https://consentcdn.cookiebot.com https://widget.trustpilot.com us01ccistatic.zoom.us";
//         $headers['X-Content-Security-Policy'] = "frame-ancestors 'none'";

//         // Add CORS header for your site
//         $headers['Access-Control-Allow-Origin'] = 'https://www.baseinstall.com';

//         // setcookie("has_logged_in", "true", time() + (86400 * 30), "/"); // testing cookie logic 
//     }
//     return $headers;
// }
// add_filter( 'wp_headers', 'baseinstall_additional_securityheaders' );


