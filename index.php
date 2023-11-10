<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package baseinstall
 */

if ( have_posts() ) : 

	if( !is_paged() ){ 
		// get the 'featured' sticky post at the top of the main blog page
		get_template_part('template-parts/blog-intro-banner'); 
		// get_template_part('template-parts/blog-feature-banner');  // Resources and newsletter CTA on the /blog landing page 
		
	} else {
		get_template_part('template-parts/archive-search-banner'); 
	} 

	// get all relevant posts for grid
	get_template_part('template-parts/archive-post-grid'); 
	
else :

	get_template_part( 'template-parts/content', 'none' );

endif;

?>
