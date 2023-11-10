<?php

/**
 * Vertical Tab Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'verticalTabs__' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'verticalTabs';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

// Load values and assign defaults
$vertical_tab_rows = get_field('vertical_tab_block');
$vertical_tabs_title = get_field('vertical_tabs_title');

// globally available fields 
$background_color = get_field('background_color');
$text_color = get_field('text_color');
$top_bottom_padding = get_field('top_bottom_padding');

// adding random number string to allow multiple instances of tabbed blocks
$randomNumberString = rand(1111,9999); 

// Block preview
if( !empty( $block['data']['_is_preview'] ) ) { ?>
    <figure style="padding:0; margin:0;">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/template-parts/blocks/vertical_tabs/vertical_tabs-previsew.jpg" alt="Preview" style="display:block; width:100%; height:auto; margin:0; border: 1px solid #ddd;">
    </figure>

<?php } else { ?>

    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">

        <div class="container">

            <?php if (!empty($vertical_tabs_title)) { ?>
                <h2 class="verticalTabs__title"><?php echo $vertical_tabs_title; ?></h2>
            <?php } ?>

            <div class="verticalTabs__wrapper">

                <?php if ( have_rows( 'vertical_tab_block' ) ): $counter = '0'; ?>
                    <div class="verticalTabs__listContent">
                        <ul class="<?php echo $block['id']; ?> verticalTabs__list">
                            <?php while ( have_rows( 'vertical_tab_block' ) ): the_row();
                                $tab_title = get_sub_field( 'vertical_tab_title' );
                                $counter++; ?>
                                <li class="verticalTabs__listItem <?php if($counter == '1' ) { ?>-tabOpen<?php } ?>">
                                    <a class="verticalTabs__listItemLink" href="#tab-<?php echo $counter . $randomNumberString; ?>"><?php echo $tab_title; ?> <span class="verticalTabs__listItemIcon icon-chevron-right"></span></a>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <?php if ( have_rows( 'vertical_tab_block' ) ): $counter = '0'; ?>
                    <div class="<?php echo $block['id']; ?> verticalTabs__tabContent">
                        <?php while ( have_rows( 'vertical_tab_block' ) ): the_row();

                            $tab_text = get_sub_field( 'vertical_tab_text' );
                            $counter++; ?>

                            <div id="tab-<?php echo $counter . $randomNumberString; ?>" class="verticalTabs__tabPane <?php if($counter == '1' ) { ?>-tabOpen<?php } ?>"> 

                                <div class="verticalTabs__tabPane-inner">
                                    <div class="verticalTabs__tabPane-text">
                                        <?php echo $tab_text; ?>
                                    </div>
                                </div>


                            </div> 
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>

            </div>
        </div>


        <?php /* VERTICAL TAB STYLES/SCRIPTS */  

        /* Colors can be overridden by using the editor block */  
        if (!empty($background_color || $text_color)) { ?>
            <style type="text/css">
                #<?php echo $id; ?> {
                    background: <?php echo $background_color; ?>;
                    color: <?php echo $text_color; ?>;
                }
            </style> <?php } 
        else { /* do nothing */ } 

        /* Vanilla JS to animate the vertical tab panels - uses block ID for
         * specificity so multiple instances can appear on the same page */  
        if (!empty($vertical_tab_rows)) { ?>
            <script type="text/javascript">
                window.addEventListener("load", function() {
                    // store tabs variable
                    var verticalTabs = document.querySelectorAll(".<?php echo $block['id']; ?> > li");

                    function verticalTabClicks(tabClickEvent) {
                        for (var i = 0; i < verticalTabs.length; i++) {
                            verticalTabs[i].classList.remove("-tabOpen");
                        }
                        var clickedTab = tabClickEvent.currentTarget;
                        clickedTab.classList.add("-tabOpen");
                        tabClickEvent.preventDefault();
                        var verticalTabContent = document.querySelectorAll(".<?php echo $block['id']; ?> .verticalTabs__tabPane");
                        for (i = 0; i < verticalTabContent.length; i++) {
                            verticalTabContent[i].classList.remove("-tabOpen");
                        }
                        var anchorReference = tabClickEvent.target;
                        var activePaneId = anchorReference.getAttribute("href");
                        var activePane = document.querySelector(activePaneId);
                        activePane.classList.add("-tabOpen");
                    }
                    for (i = 0; i < verticalTabs.length; i++) {
                        verticalTabs[i].addEventListener("click", verticalTabClicks)
                    }
                });
            </script> <?php } 
        else { /* do nothing */ } ?>



        <?php // color and padding options from WP block editor
            if (!empty($background_color || $text_color || $top_bottom_padding)) { ?>
            <style type="text/css">
                #<?php echo $id; ?> { <?php

                    if (!empty($background_color)) {
                        echo 'background: ' . $background_color . ';'; }

                    if (!empty($text_color)) {
                        echo 'color: ' . $text_color . ';'; }

                    if( $top_bottom_padding == 'bottom_only' ) { 
                        echo 'padding-top: 1px'; } 

                    else if( $top_bottom_padding == 'top_only' ) { 
                        echo 'padding-bottom: 1px'; } 

                    else if( $top_bottom_padding == 'no_margin' ) { 
                        echo 'padding: 1px 0'; } 

                    else { } ?> 
                }
            </style>
        <?php } ?>
    </div>

<?php } ?>
