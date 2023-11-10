<?php
/**
 * Template part for displaying featured post above blog/archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package baseinstall
 */

?>

<?php 
// custom fields for intro block of blog page
$page_for_posts_id = get_option( 'page_for_posts' ); // get blog page
$blog_page_title = get_the_title( $page_for_posts_id ); // get title of blog page
?>

<div class="blogIntro">

	<div class="container">
		<?php if (!empty($blog_page_title)) { ?>
			<h1 class="blogIntro__title"><?php echo $blog_page_title; ?></h1>
		<?php } ?>
	</div>

	<div class="siteSearch">
		<div class="container">
			<form class="siteSearch__form" action="/" method="get">
				<label class="siteSearch__formLabel " for="search">Search <?php echo get_the_title( get_option('page_for_posts', true) ); ?></label>
				<input class="siteSearch__formInput" type="text" name="s" id="search" placeholder="Search <?php echo $blog_page_title; ?>" value="<?php the_search_query(); ?>" />
				<input class="siteSearch__formButton" type="submit" alt="Search" value="Search" />
			</form>
		</div>
	</div>

</div>

