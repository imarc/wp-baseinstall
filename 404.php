<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package regenerativechangelab
 */

?>

<section class="error-404 not-found">
	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( 'Sorry, this page could not be found.', 'regenerativechangelab' ); ?></h1>
	</header>

	<div class="page-content">

		<a class="button" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">Back to homepage</a>

	</div>
</section>
