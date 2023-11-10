<?php
/**
 * baseinstall functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package baseinstall
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'baseinstall_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function baseinstall_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on baseinstall, use a find and replace
		 * to change 'baseinstall' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'baseinstall', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'baseinstall' ),
				'menu-2' => esc_html__( 'Secondary', 'baseinstall' ),
				'menu-3' => esc_html__( 'Tertiary', 'baseinstall' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'baseinstall_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'baseinstall_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function baseinstall_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'baseinstall_content_width', 640 );
}
add_action( 'after_setup_theme', 'baseinstall_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function baseinstall_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'baseinstall' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'baseinstall' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'baseinstall_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function baseinstall_scripts() {
	// STYLES MOVED - these are now called in the <head> following critical CSS file 
	// wp_enqueue_style( 'baseinstall-main-style', get_template_directory_uri() . '/assets/dist/css/critical.css', array(), _S_VERSION );
	// wp_enqueue_style( 'baseinstall-main-style', get_template_directory_uri() . '/assets/dist/css/styles.css', array(), _S_VERSION );
	// wp_enqueue_style( 'baseinstall-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'baseinstall-style', 'rtl', 'replace' );
	wp_enqueue_script( 'baseinstall-navigation', get_template_directory_uri() . '/assets/dist/js/scripts.js', array('jquery'), _S_VERSION, true );
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'baseinstall_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}





/**
 * CUSTOM FUNCTIONS START BELOW
 * Everything above is core WordPress stuff, and below are some 
 * optional additions and enhancements to theme functionality. 
 * The theme wrapper is the only critical one. The nav walker isn't as 
 * important but will make the navigation menu much easier to style.
 * Theme options are handy for global custom fields without needing ACF. 
 * Everything else is a nice-to-have, edit or delete to suit your needs
 */





/**
 * THEME WRAPPER 
 * Don't Repeat Yourself - header, footer, and sidebar are called in base.php 
 * You can have multiple wrappers (base-single.php, base-page.php, etc.) 
 * and they can be overwritten like any other template 
 */
function baseinstall_template_path() {
	return baseinstall_wrapper::$main_template;
}
function baseinstall_template_base() {
	return baseinstall_wrapper::$base;
}
class baseinstall_wrapper {

	// Stores the full path to the main template file
	static $main_template;

	// Stores the base name of the template file; e.g. 'page' for 'page.php' etc.
	static $base;
	static function wrap( $template ) {
		self::$main_template = $template;
		self::$base = substr( basename( self::$main_template ), 0, -4 );
		if ( 'index' == self::$base )
			self::$base = false;
		$templates = array( 'base.php' );
		if ( self::$base )
			array_unshift( $templates, sprintf( 'base-%s.php', self::$base ) );
		return locate_template( $templates );
	}
}
add_filter( 'template_include', array( 'baseinstall_wrapper', 'wrap' ), 99 );



/**
 * Custom nav walker to add consistent class/ID for CSS/JS targeting.
 */
require get_template_directory() . '/inc/nav-walker.php';

/*
 * Load the theme options page.
 */
require get_template_directory() . '/inc/theme-options/theme-options.php';

/*
 * Custom post types
 * Press Releases and Media Coverage
 * Resources, Guides, and Infographics
 * Additional CPT functionality, check if post is CPT, add tags, include in author pages 
 */
// require get_template_directory() . '/inc/custom-post-types/custom-post-press.php';
// require get_template_directory() . '/inc/custom-post-types/custom-post-resources.php';
// require get_template_directory() . '/inc/custom-post-types/custom-post-additions.php';

/**
 * Custom blocks category and registration
 * Register each of the custom WP Gutenberg blocks, add name, description, color, icon
 */
require get_template_directory() . '/inc/custom-content-blocks.php';

/**
 * NUMBERED PAGINATION
 * Add some proper numbered pagination to lists of posts, with links
 * The call to baseinstall_numeric_posts_nav() appears in: archive.php, front-page.php, index.php, and search.php
 */
require get_template_directory() . '/inc/custom-numbered-pagination.php';

/**
 * CUSTOM LOGIN SCREEN
 * overrides default WP logo, background image/color, link, title, and login form 
 */
// require get_template_directory() . '/inc/custom-login-screen.php';

/**
 * MISCELLANEOUS CUSTOM FUNCTIONS 
 * Add favicons to front end and WP dashboard
 * SVG mime types 
 * Custom excerpt length 
 * Read time calculator 
 * Hide sticky posts from main query 
 */
require get_template_directory() . '/inc/custom-functions.php';
