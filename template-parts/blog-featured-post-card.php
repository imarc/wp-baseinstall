<?php
/**
 * Template part for displaying the cards used on the main blog page, archives, and search results
 * If not a single post, get post featured image, title, date, read time, and link
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package baseinstall
 */

?>

<div class="blogSection__post">
    <div class="blogSection__postBorder">

        <div class="blogSection__postThumb">
            <?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' ); ?>

            <?php if ( ! empty($thumb) ) : ?>
                <img class="blogSection__postThumbImg" src="<?php echo $thumb['0'];?>" alt="<?php echo get_the_title(); ?>">
            <?php else : ?>
                <img class="blogSection__postThumbImg" src="<?php echo get_template_directory_uri()?>/assets/dist/img/fallback.jpg" alt="<?php echo get_the_title();?>">
            <?php endif; ?>
        </div>

        <div class="blogSection__postTextWrap">
            <div class="blogSection__postEyebrow">
                <?php // Taking care of all pages, posts, and custom post type categories 
                $post_type = get_post_type();

                if ( 'page' === $post_type ) {
                    echo 'Page';
                    
                } else {
                    the_category(', ');
                } ?>
            </div>
            <div class="blogSection__postTitle">
                <?php echo get_the_title(); ?>
            </div>
        </div>

        <a class="blogSection__postLink" href="<?php 
            // get external media link if available, otherwise get post link 
            $external_media_link = get_field('resource_external_media_link');
            $link_type = get_field('resource_link_type');
            $wp_home_url = home_url(); // for checking if external file is located in the same location 

            if ( 'resources' == get_post_type() && !empty($external_media_link) ) {
                echo $external_media_link;
            } else {
                echo get_permalink( get_the_ID() );
            } ?>" 

            <?php 
            // download if external media link present and root URL is the same, otherwise open in new tab 
            if ( 'resources' == get_post_type() && !empty($external_media_link) ) {
                if ( !empty($external_media_link) && $link_type == 'link_type_download' && (strpos($external_media_link, $wp_home_url) !== false)) {
                    echo ' download'; 
                } else {
                    echo ' target="_blank" rel="noopener noreferrer"'; 
                } 
            }
        ?>>

        <?php 
            // populate text based on link or file type 
            if ( !empty($external_media_link) && $link_type == 'link_type_download' && (strpos($external_media_link, $wp_home_url) !== false)) {
                echo 'Download';
            } else if ( !empty($external_media_link) && $link_type == 'link_type_download') {
                echo 'View resource';
            } else {
                echo 'Read more';
            } 
        ?></a>

    </div>
</div>
