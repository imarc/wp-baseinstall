<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package baseinstall
 */

if ( have_posts() ) : ?>

	<?php
	/**
	 * ARCHIVE TOP BANNER
	 * This shows archive categories, tags, and search query results
	 * Also located on archive.php */
	get_template_part('template-parts/archive-search-banner'); 

	// get all relevant posts for grid
	get_template_part('template-parts/archive-post-grid'); 
	
else :

	get_template_part( 'template-parts/content', 'none' );

endif;
?>
