<?php
/**
 * Template part for displaying media mentions in archive and landing pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package baseinstall
 */ ?>

<div class="-block">
    <div class="-block-inner">
        <div class="-image">
            <?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' ); ?>

            <?php if ( ! empty($thumb) ) : ?>
                <img src="<?php echo $thumb['0'];?>" alt="<?php echo get_the_title(); ?>">
            <?php else : ?>
                <img src="<?php echo get_template_directory_uri()?>/assets/dist/img/fallback.webp" alt="<?php echo get_the_title();?>">
            <?php endif; ?>
        </div>
        <div class="-date"><?php echo get_the_date('M Y'); ?></div>

        <div class="-text">
            <?php echo the_excerpt(); ?>
        </div>

        <?php 
        $media_mention_link = get_field('press_release_media_link');

        if( $media_mention_link ): 
            $media_link_url = $media_mention_link['url'];
            $media_link_title = $media_mention_link['title'];
            $media_link_target = $media_mention_link['target'] ? $media_mention_link['target'] : '_self';
            ?>
            <a class="-link" href="<?php echo esc_url( $media_link_url ); ?>" target="<?php echo esc_attr( $media_link_target ); ?>"><?php echo esc_html( $media_link_title ); ?></a>
        <?php endif; ?>

    </div>
</div>