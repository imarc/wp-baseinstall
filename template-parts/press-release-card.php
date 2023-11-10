<?php
/**
 * Template part for displaying press release excerpts in archive and landing pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package baseinstall
 */ ?>

<div class="-block">
    <div class="-date">
        <div class="-date-month"><?php echo get_the_date('M j'); ?></div>
        <div class="-date-year"><?php echo get_the_date('Y'); ?></div>
    </div>
    <div class="-text">
        <h3 class="-title"><a class="-title-link" href="<?php echo get_permalink( get_the_ID() );?>"><?php echo get_the_title(); ?></a></h3>

        <?php 
            // get press release subtitle if present 
            $press_release_subtitle = get_field( 'press_release_subtitle' );
            if (!empty($press_release_subtitle)) { ?>
                <p class="-subheading"><?php echo $press_release_subtitle; ?></p><?php 
            }

            // get custom excerpt if present, otherwise get default excerpt 
            $press_release_excerpt = get_field( 'press_release_excerpt' );
            if (!empty($press_release_excerpt)) { ?>
                <p class="-excerpt"><?php echo $press_release_excerpt; ?></p><?php 
            } else {
                echo the_excerpt(); 
            } 
        ?>
    </div>
</div>
