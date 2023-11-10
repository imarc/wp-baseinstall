<?php
/**
 * Template part for displaying featured image, title, date, and read time in posts and archives
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package baseinstall
 */

?>

<div id="subscribeBlock" class="subscribe_nag">

    <button id="subscribeToggle" class="subscribe-toggle">Subscribe</button>
    <?php 
    if ($newsletterSignupHeading = get_option('baseinstall_options')['baseinstall-form-title']) { 
        echo '<div class="-title">' . $newsletterSignupHeading . '</div>';
    } else {}

    if ($newsletterSignupCopy = get_option('baseinstall_options')['baseinstall-form-copy']) { 
        echo '<div class="-text">' . $newsletterSignupCopy . '</div>';
    } else {}
    ?>

    <div class="hubspot_subscribe_nag">
        <?php 
        if ($newsletterSignupForm = get_option('baseinstall_options')['baseinstall-form-embed']) { 
            echo $newsletterSignupForm;
        } else {} 
        ?>

        <script type="text/javascript">
            // variables for subscription nag toggle and content
            var subscribeBlock = document.querySelector('#subscribeBlock');
                subscribeToggle = document.querySelector('#subscribeToggle');
            // Toggle search and set WAI-ARIA values 
            subscribeToggle.onclick = function() {
              if (hasClass(subscribeBlock, '-is-open')) {
                removeClass(subscribeToggle, 'toggled'); 
                removeClass(subscribeBlock, '-is-open');
                subscribeToggle.innerHTML = "Subscribe";
              } else {
                addClass(subscribeToggle, 'toggled'); 
                addClass(subscribeBlock, '-is-open');
                subscribeToggle.innerHTML = "Close";
              }
            };
            setTimeout(() => subscribeToggle.click(), 5000); 
        </script>
    </div>

</div>
