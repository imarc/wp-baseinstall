<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package regenerativechangelab
 */


/**
 * ARCHIVE TOP BANNER
 * This shows archive categories, tags, and search query results
 * Also located on search.php */

if ( have_posts() ) : 
	get_template_part('template-parts/blog-intro-banner'); 
?>

	<div class="container -wide">
	    <?php get_template_part('template-parts/blog-filter-dropdown');?>
	</div>

	<div class="resource__wrapper">

		<div class="resource__wrapper-posts">
		    <div class="featuredPosts__blog"> 
				<?php
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

				$args = array(
				    'post_type'=>'resources', // Your post type name
				    'posts_per_page' => 10,
				    'paged' => $paged,
				);

				$loop = new WP_Query( $args );
				if ( $loop->have_posts() ) {
				    while ( $loop->have_posts() ) : $loop->the_post();
				    	get_template_part('template-parts/blog-featured-post-card');
				    endwhile;

				    /* placeholders for keeping flex item spacing consistent */ ?>
				    <i class="featuredPosts__blog-spacer" aria-hidden="true"></i>
				    <i class="featuredPosts__blog-spacer" aria-hidden="true"></i>
				    <?php 
				}
				wp_reset_postdata();
				?>
		    </div>

	        <div class="pagination">
	            <?php regenerativechangelab_numeric_posts_nav(); ?>
	        </div>
		</div>

		<?php // Let's get those ACF variables 
		$resources_page = get_page_by_path( 'resources-content' ); 
		$blog_intro_eyebrow = get_field('resource_ad_block', $resources_page);
		if (!empty($blog_intro_eyebrow)) { ?>
		    <div class="-adBlock">
			    <div class="-adBlock-inner">
					<span class="-eyebrow"><?php echo $blog_intro_eyebrow; ?></span>
			    </div>
		    </div>
		<?php } ?>

	</div>


	<?php // get CTA / page content from Resources page 
	$get_resources_page = get_page_by_path( 'resources-content' ); 
	$the_query = new WP_Query( $get_resources_page );
	while ( $the_query->have_posts() ) :
		$the_query->the_post();
		the_content();
	endwhile;
	wp_reset_postdata();


else :

	get_template_part( 'template-parts/content', 'none' );

endif;

?>
