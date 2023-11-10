<?php

/**
 * accordion_row Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'accordionRows__' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'accordionRows';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}


$accordion_rows_title = get_field('accordion_rows_title');
$accordion_rows_description = get_field('accordion_rows_description');
$accordion_rows_rows = get_field('accordion_rows_block');

// globally available fields 
$background_color = get_field('background_color');
$text_color = get_field('text_color');
$top_bottom_padding = get_field('top_bottom_padding');


// Block preview
if( !empty( $block['data']['_is_preview'] ) ) { ?>
    <figure style="padding:0; margin:0;">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/template-parts/blocks/accordion_rows/accordion_rows-previesw.jpg" alt="Preview" style="display:block; width:100%; height:auto; margin:0; border: 1px solid #ddd;">
    </figure>

<?php } else { ?>

    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">

        <div class="container">

            <?php if (!empty($accordion_rows_title) || !empty($accordion_rows_description)) { ?>
                <div class="accordionRows__text container">
                    <?php if (!empty($accordion_rows_title)) { ?>
                        <h2 class="accordionRows__title"><?php echo $accordion_rows_title; ?></h2>
                    <?php } ?>

                    <?php if (!empty($accordion_rows_description)) { ?>
                        <div class="accordionRows__description"><?php echo $accordion_rows_description; ?></div>
                    <?php } ?>
                </div>
            <?php } ?>
            
            <?php if ( have_rows( 'accordion_rows_block' ) ): $counter = '0'; ?>
                <div class="<?php echo $block['id']; ?> accordion">
                    <?php while ( have_rows( 'accordion_rows_block' ) ): the_row();
                        $tab_title = get_sub_field( 'accordion_rows_title' );
                        $tab_text = get_sub_field( 'accordion_rows_text' );
                        // $tab_image = get_sub_field( 'accordion_rows_image' );
                        $counter++; ?>

                        <section class="accordionRows__item">

                          <div class="accordionRows__heading"><button class="accordionRows__trigger <?php if(!empty($text_color)){echo '-customColor';}?>"><span class="accordionRows__toggle-x"></span><span class="accordionRows__toggle-text"><?php echo $tab_title; ?></span></button></div>

                            <div class="accordionRows__copy">

                                <?php /* if (!empty($tab_image)) { ?>
                                        <div class="-tab-image">
                                            <?php echo wp_get_attachment_image( $tab_image, 'full', '', ['class'=> 'hero__image','alt'=>$tab_title]); ?>
                                        </div>
                                <?php } */ ?>

                                <div class="accordionRows__copyText">
                                    <?php echo $tab_text; ?>
                                </div>
                            </div>
                        </section>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>



        <?php /* VERTICAL TAB STYLES/SCRIPTS */  

        /* Vanilla JS to animate the vertical tab panels - uses block ID for
         * specificity so multiple instances can appear on the same page */  
        if (!empty($accordion_rows_rows)) { ?>
            <script type="text/javascript">
                (function () {
                  const headings = document.querySelectorAll(".<?php echo $block['id']; ?> .accordionRows__heading");
                  const triggers = [];
                  const accordionItem = document.querySelectorAll(".<?php echo $block['id']; ?> .accordionRows__item");
                  const accordionContents = document.querySelectorAll(".<?php echo $block['id']; ?> .accordionRows__copy");
                  const copyOpenClass = "-open";

                  headings.forEach((h, i) => {
                    let accordionToggleButton = h.querySelector("button");
                    triggers.push(accordionToggleButton);
                    let target = h.nextElementSibling;
                    accordionToggleButton.onclick = () => {
                      let expanded = accordionToggleButton.getAttribute("aria-expanded") === "true";
                      if (expanded) {
                        closeItem(target, accordionToggleButton);
                      } else {
                        openItem(target, accordionToggleButton);
                      }
                    };
                  });
                  function closeAllExpandedItems() {
                    const expandedTriggers = triggers.filter(
                      (t) => t.getAttribute("aria-expanded") === "true"
                    );
                    const expandedCopy = Array.from(accordionContents).filter((c) =>
                      c.classList.value.includes(copyOpenClass)
                    );
                    expandedTriggers.forEach((trigger) => {
                      trigger.setAttribute("aria-expanded", false);
                    });
                    expandedCopy.forEach((copy) => {
                      copy.classList.remove(copyOpenClass);
                      copy.style.maxHeight = 0;
                      // copy.style.padding = "0 1.5rem 0 1.5rem";
                    });
                  }
                  function closeItem(target, accordionToggleButton) {
                    accordionToggleButton.setAttribute("aria-expanded", false);
                    target.classList.remove(copyOpenClass);
                    target.style.maxHeight = 0;
                    // target.style.padding = "0 1.5rem 0 1.5rem";
                  }
                  function openItem(target, accordionToggleButton) {
                    closeAllExpandedItems();
                    accordionToggleButton.setAttribute("aria-expanded", true);
                    target.classList.add(copyOpenClass);
                    target.style.maxHeight = target.scrollHeight + "px";
                    // target.style.padding = "1rem 1.5rem 2rem 1.5rem";
                  }
                  setTimeout(() => triggers[0].click(), 500); // opens first accordion block
                })();
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
