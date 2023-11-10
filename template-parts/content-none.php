<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package baseinstall
 */

?>

<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( 'Sorry, no results found.', 'baseinstall' ); ?></h1>
	</header>

	<div class="page-content">
		<a class="button" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">Back to homepage</a>
		<div class="no-results-search">
			<h3>Site Search</h3>
			<form class="siteSearch__form" action="/" method="get">
				<label class="siteSearch__formLabel " for="search">Search <?php echo get_the_title( get_option('page_for_posts', true) ); ?></label>
				<input class="siteSearch__formInput" type="text" name="s" id="search" placeholder="Search full site" value="<?php the_search_query(); ?>" />
				<input class="siteSearch__formButton" type="submit" alt="Search" value="Search" />
				<input type="hidden" name="post_type" value="any">
			</form>
		</div>
	</div>
</section>
