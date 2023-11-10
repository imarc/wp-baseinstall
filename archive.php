<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package regenerativechangelab
 */

if ( have_posts() ) : ?>

	<?php
	/**
	 * ARCHIVE TOP BANNER
	 * This shows archive categories, tags, and search query results
	 * Also located on search.php
	 * 
	 * While organization of post-related content is still being discussed (as of 10/26/2022), the archive 
	 * will show a search banner on the top-level Blog and Custom Post Type (CPT) parent pages. If it's NOT the 
	 * main landing page for Resources or Press CPTs, or the default Posts, it will show a simple title banner. 
	 * */

	if ( (is_post_type_archive('resources') && !is_paged()) || (is_post_type_archive('press') && !is_paged()) || is_home() ) {
		get_template_part('template-parts/blog-intro-banner'); 

	} else {
		get_template_part('template-parts/archive-search-banner'); 
		
	}

	// get all relevant posts for grid
	get_template_part('template-parts/archive-post-grid'); 
	
else :

	get_template_part( 'template-parts/content', 'none' );

endif;

?>
