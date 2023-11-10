<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package baseinstall
 */

// custom fields for intro block of blog page
$post_archive_title = get_the_title( get_option('page_for_posts', true) );
$post_archive_link = get_permalink( get_option( 'page_for_posts' ) );
?>

<?php if ( is_singular() ) : ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('singlePost'); ?>>
		<div class="singlePost__wrapper">

			<header class="singlePost__header">
                <div class="singlePost__headerBreadcrumb">
                    <a class="singlePost__headerBreadcrumb-link" href="<?php echo $post_archive_link; ?>"><?php echo $post_archive_title; ?></a>
                    <span class="singlePost__headerBreadcrumb-divider">/</span>
                    <?php the_title( '<span class="singlePost__headerBreadcrumb-title">', '</span>' ); ?>
                </div>

				<?php the_title( '<h1 class="singlePost__title">', '</h1>' ); ?>

				<div class="singlePost__entryMeta">
					<?php get_template_part('template-parts/blog-post-meta-author'); ?>
					<?php get_template_part('template-parts/blog-post-meta-categories'); ?>
					<?php echo '<span class="singlePost__entryMeta-date">' . get_the_date('F j, Y') . '</span>';  ?>
					<?php if (get_field('reviewed')) :
					get_template_part('template-parts/blog-post-meta-reviewer');
					endif; ?>
				    <?php // get reading time if not empty
				    // if( ! empty( wp_reading_time() )){ echo '<span class="article__entry-readtime">' . wp_reading_time() . ' min read</span>'; } ?>
				</div>
			</header>

			<div class="singlePost__entryWrapper">
				<div class="singlePost__entrySidebar">
					<?php get_template_part('template-parts/blog-post-meta-toc'); ?>
					<?php get_template_part('template-parts/blog-post-meta-tags'); ?>
					<?php get_template_part('template-parts/blog-post-meta-social'); ?>
				</div>

				<div class="singlePost__entryContent"><?php 
					// if present, get the post featured image 
					if (has_post_thumbnail()) { // if a thumbnail has been set
						$imgID = get_post_thumbnail_id($post->ID); // get id of featured image
						$featuredImage = wp_get_attachment_image_src($imgID, 'full' ); // get url of featured image (returns array)
						$imgURL = $featuredImage[0]; // get url of image from array
						echo '<div class="singlePost__entryImageWrap"><img class="singlePost__entryImage" src="' . $imgURL . '" alt="' . get_the_title() . '"></div>';
					}

					// get post content
					the_content(
						sprintf(
							wp_kses(
								/* translators: %s: Name of current post. Only visible to screen readers */
								__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'baseinstall' ),
								array(
									'span' => array(
										'class' => array(),
									),
								)
							),
							wp_kses_post( get_the_title() )
						)
					); ?>

					<?php /* hiding this on laptop and larger for now */ ?>
					<footer class="singlePost__entryFooter">
						<?php baseinstall_entry_footer(); ?>
					</footer>
				</div>
			</div>

		</div>
	</article>



	<?php
		/**
		 * RELATED POSTS
		 * If regular blog post (NOT custom Press or Resource post type), get related posts
		 */
		if ( ! is_singular( array( 'press', 'resources' ) ) ) {
			// to enable related posts for custom post types, get rid of the 'if' statement around this template call 
			get_template_part('template-parts/blog-related-posts'); 
		}

		/**
		 * BLOG PAGE CONTENT
		 * This will get the content blocks added on the Blog page
		 * Located in archive-post-grid.php and content.php 
		 */
		$page_for_posts_id = get_option( 'page_for_posts' );
		echo apply_filters( 'the_content', get_post_field( 'post_content', $page_for_posts_id ) );
	?>


<?php else : ?>


	<?php
	/**
	 * POST EXCERPTS
	 * If not a single post, get post featured image, title, date, read time, and link
	 * This renders the cards used on the main blog page, archives, and search results
	 */
	get_template_part('template-parts/blog-featured-post-card'); ?>


<?php endif; ?>
