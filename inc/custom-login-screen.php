<?php
/**
 * Custom login screen styles, logo, link, and title  
 *
 * @package baseinstall
 */



/**
 * CUSTOM LOGIN SCREEN
 * overrides default WP logo, background image/color, and form styles
 */
function baseinstall_login_stylesheet() {
    wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/assets/dist/css/login-styles.css' );
}
add_action( 'login_enqueue_scripts', 'baseinstall_login_stylesheet' );



/**
 * CUSTOM LOGIN SCREEN LOGO LINK
 * Redirect custom login logo link to homepage
 */
function baseinstall_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'baseinstall_login_logo_url' );



/**
 * CUSTOM LOGIN SCREEN LOGO TITLE
 * Update custom login logo page title
 */
function baseinstall_login_logo_url_title( $title ) {
    return esc_attr( get_bloginfo( 'title' ) );
}
add_filter( 'login_headertext', 'baseinstall_login_logo_url_title' );
