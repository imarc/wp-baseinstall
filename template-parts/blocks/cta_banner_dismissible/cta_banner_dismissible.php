<?php

/**
 * Dismissible CTA Banner Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'dismissibleCtaBanner-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'dismissibleCtaBanner';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

// Load values and assign defaults.
$dismissible_cta_eyebrow = get_field('dismissible_cta_eyebrow');
$dismissible_cta_title = get_field('cta_banner_title') ?: 'Your title here ...';
$dismissible_cta_button = get_field('dismissible_cta_button');
$dismissible_cta_button2 = get_field('dismissible_cta_secondary_button');
$dismissible_cta_image = get_field('dismissible_cta_image'); 

// globally available fields 
$background_color = get_field('background_color');
$text_color = get_field('text_color');

// Block preview
if( !empty( $block['data']['_is_preview'] ) ) { ?>
    <figure style="padding:0; margin:0;">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/template-parts/blocks/cta_banner_dismissable/cta_banner_dismissable-previesw.jpg" alt="Preview" style="display:block; width:100%; height:auto; margin:0; border: 1px solid #ddd;">
    </figure>

<?php } else { ?>
        
    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> <?php if(!empty($background_color)){echo '-customBgColor';}?>">

        <div id="dismissibleCtaBanner" class="dismissibleCtaBanner__block">
            <div class="dismissibleCtaBanner__inner">
                <div class="-text">
                    <div class="-copy">
                        <?php if (!empty($dismissible_cta_eyebrow)) { ?>
                            <span class="-eyebrow <?php if(!empty($text_color)){echo '-customTextColor';}?>"><?php echo $dismissible_cta_eyebrow; ?></span>
                        <?php } ?>
                        <?php if (!empty($dismissible_cta_title)) { ?>
                            <h1 class="-title <?php if(!empty($background_color)){echo '-customTextColor';}?>"><?php echo $dismissible_cta_title; ?></h1>
                        <?php } ?>
                    </div>
                    <div class="-links">
                        <?php if( $dismissible_cta_button ): 
                            $cta_link_one_url = $dismissible_cta_button['url'];
                            $cta_link_one_title = $dismissible_cta_button['title'];
                            $cta_link_one_target = $dismissible_cta_button['target'] ? $dismissible_cta_button['target'] : '_self';
                            ?>
                            <a class="button" href="<?php echo esc_url( $cta_link_one_url ); ?>" target="<?php echo esc_attr( $cta_link_one_target ); ?>"><?php echo esc_html( $cta_link_one_title ); ?></a>
                        <?php endif; ?>
                        <?php if( $dismissible_cta_button2 ): 
                            $cta_link_one_url = $dismissible_cta_button2['url'];
                            $cta_link_one_title = $dismissible_cta_button2['title'];
                            $cta_link_one_target = $dismissible_cta_button2['target'] ? $dismissible_cta_button2['target'] : '_self';
                            ?>
                            <a class="-textLink <?php if(!empty($background_color)){echo '-customTextColor';}?>" href="<?php echo esc_url( $cta_link_one_url ); ?>" target="<?php echo esc_attr( $cta_link_one_target ); ?>"><?php echo esc_html( $cta_link_one_title ); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if (!empty($dismissible_cta_image)) { ?>
                    <div class="-image">
                        <?php echo wp_get_attachment_image( $dismissible_cta_image, 'full', '', ['class'=> '-img','alt'=>$dismissible_cta_title]); ?>
                        <?php /* decorative line, hiding for now 
                        <div class="-line"></div> */ ?>
                    </div>
                <?php } ?>
            </div>
            <span id="closeDismissibleCtaBanner" class="-close">
                <svg clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m12 10.93 5.719-5.72c.146-.146.339-.219.531-.219.404 0 .75.324.75.749 0 .193-.073.385-.219.532l-5.72 5.719 5.719 5.719c.147.147.22.339.22.531 0 .427-.349.75-.75.75-.192 0-.385-.073-.531-.219l-5.719-5.719-5.719 5.719c-.146.146-.339.219-.531.219-.401 0-.75-.323-.75-.75 0-.192.073-.384.22-.531l5.719-5.719-5.72-5.719c-.146-.147-.219-.339-.219-.532 0-.425.346-.749.75-.749.192 0 .385.073.531.219z"/></svg>
            </span>
        </div>

        <?php // color and padding options from WP block editor 
            if (!empty($background_color || $text_color )) { ?>
            <style type="text/css">
                <?php echo '#' . $id; ?> { <?php

                    if (!empty($background_color)) {
                        echo 'background: ' . $background_color . ';'; }

                    if (!empty($text_color)) {
                        echo 'color: ' . $text_color . ';'; } ?> 
                }
            </style>
        <?php } ?>

        <script type="text/javascript">
            // dismissible CTA
            const ctaBanner = document.getElementById("dismissibleCtaBanner");
            const closeCtaBanner = document.getElementById("closeDismissibleCtaBanner");
            if (closeCtaBanner) {
                closeCtaBanner.addEventListener('click', function (event) {
                    ctaBanner.classList.add("-hidden");
                });
            }
        </script>

    </div>

<?php } ?>
