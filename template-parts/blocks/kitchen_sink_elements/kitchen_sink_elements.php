<?php

/**
 * Kitchen Sink Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'kitchenSinkExamples-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'kitchenSinkExamples';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

// globally available fields 
$background_color = get_field('background_color');
$text_color = get_field('text_color');
$top_bottom_padding = get_field('top_bottom_padding');

// Block preview
if( !empty( $block['data']['_is_preview'] ) ) { ?>
    <figure style="padding:0; margin:0;">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/template-parts/blocks/kitchen_sink_elements/kitchen_sink_elements-previesw.jpg" alt="Preview" style="display:block; width:100%; height:auto; margin:0; border: 1px solid #ddd;">
    </figure>

<?php } else { ?>

    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">



        <div class="container">

<hr>
<!-- Standard Headings -->
<h1>Heading</h1>
<h2>Heading</h2>
<h3>Heading</h3>
<h4>Heading</h4>
<h5>Heading</h5>
<h6>Heading</h6>

<!-- Base type size -->
<p>The base type is 15px over 1.6 line height (24px)</p>

<!-- Other styled text tags -->
<p><strong>Bold Text</strong>, <em>Italicized Text</em>, <a>Inline text link</a>, <u>Underlined text</u></p>

<!-- Standard buttons -->
<a class="button" href="#">Primary button</a>
<a class="button -secondary" href="#">Secondary button</a>



<hr>
<!-- The above form looks like this -->
<form>
  <div class="row">
    <div class="column">
      <label for="exampleEmailInput">Your email</label>
      <input class="u-full-width" type="email" placeholder="test@mailbox.com" id="exampleEmailInput">
    </div>
    <div class="column">
      <label for="exampleRecipientInput">Reason for contacting</label>
      <select class="u-full-width" id="exampleRecipientInput">
        <option value="Option 1">Questions</option>
        <option value="Option 2">Admiration</option>
        <option value="Option 3">Business and Numbers</option>
      </select>
    </div>
  </div>
  <label for="exampleMessage">Message</label>
  <textarea class="u-full-width" placeholder="Hi Dave …" id="exampleMessage"></textarea>
  <label class="send-copy">
    <input type="checkbox">
    <span class="label-body">Send a copy to yourself</span>
  </label>
  <input class="button-primary" type="submit" value="Submit">
</form>
<hr>

<!-- Always wrap checkbox and radio inputs in a label and use a <span class="label-body"> inside of it -->

<!-- Note: The class .u-full-width is just a utility class shorthand for width: 100% -->



<ul>
  <li>Item 1</li>
  <li>
    Item 2
    <ul>
      <li>Item 2.1</li>
      <li>Item 2.2</li>
    </ul>
  </li>
  <li>Item 3</li>
</ul>


<pre><code>.some-class {
  background-color: red;
}</code></pre>


<table class="u-full-width">
  <thead>
    <tr>
      <th>Name</th>
      <th>Age</th>
      <th>Sex</th>
      <th>Location</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Dave Gamache</td>
      <td>26</td>
      <td>Male</td>
      <td>San Francisco</td>
    </tr>
    <tr>
      <td>Dwayne Johnson</td>
      <td>42</td>
      <td>Male</td>
      <td>Hayward</td>
    </tr>
  </tbody>
</table>









            <h1>Heading<span class="heading-font-size"> <code>&lt;h1&gt;</code> 50rem</span></h1>
            <h2>Heading<span class="heading-font-size"> <code>&lt;h2&gt;</code> 42rem</span></h2>
            <h3>Heading<span class="heading-font-size"> <code>&lt;h3&gt;</code> 36rem</span></h3>
            <h4>Heading<span class="heading-font-size"> <code>&lt;h4&gt;</code> 30rem</span></h4>
            <h5>Heading<span class="heading-font-size"> <code>&lt;h5&gt;</code> 24rem</span></h5>
            <h6>Heading<span class="heading-font-size"> <code>&lt;h6&gt;</code> 15rem</span></h6>

            <hr>

            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </div>






        <div class="container">
            <h1>Icons as HTML markup</h1>
            <p>This is a cheat sheet for the icon font. Just copy the html for the icon you'd like to use, and paste it where you'd like to use it. Using this method will not require adding any additional CSS.</p> 

            <div class="sana-glyph">
                <span class="icon-green-check"></span> &nbsp; green check &nbsp;|&nbsp; 
                <code>&lt;span class="icon-green-check"&gt;&lt;/span&gt;</code>
            </div>
            <div class="sana-glyph">
                <span class="icon-grey-x"></span> &nbsp; grey x &nbsp;|&nbsp; 
                <code>&lt;span class="icon-grey-x"&gt;&lt;/span&gt;</code>
            </div>
            <div class="sana-glyph">
                <span class="icon-plus"></span> &nbsp; plus sign &nbsp;|&nbsp; 
                <code>&lt;span class="icon-plus"&gt;&lt;/span&gt;</code>
            </div>
            <div class="sana-glyph">
                <span class="icon-minus"></span> &nbsp; minus sign &nbsp;|&nbsp; 
                <code>&lt;span class="icon-minus"&gt;&lt;/span&gt;</code>
            </div>
            <div class="sana-glyph">
                <span class="icon-pencil"></span> &nbsp; pencil &nbsp;|&nbsp; 
                <code>&lt;span class="icon-pencil"&gt;&lt;/span&gt;</code>
            </div>
            <div class="sana-glyph">
                <span class="icon-more"></span> &nbsp; more &nbsp;|&nbsp; 
                <code>&lt;span class="icon-more"&gt;&lt;/span&gt;</code>
            </div>
            <div class="sana-glyph">
                <span class="icon-filter"></span> &nbsp; filter &nbsp;|&nbsp; 
                <code>&lt;span class="icon-filter"&gt;&lt;/span&gt;</code>
            </div>
            <div class="sana-glyph">
                <span class="icon-external-link"></span> &nbsp; external link &nbsp;|&nbsp; 
                <code>&lt;span class="icon-external-link"&gt;&lt;/span&gt;</code>
            </div>
            <div class="sana-glyph">
                <span class="icon-envelope"></span> &nbsp; envelope &nbsp;|&nbsp; 
                <code>&lt;span class="icon-envelope"&gt;&lt;/span&gt;</code>
            </div>
            <div class="sana-glyph">
                <span class="icon-download"></span> &nbsp; download &nbsp;|&nbsp; 
                <code>&lt;span class="icon-download"&gt;&lt;/span&gt;</code>
            </div>
            <div class="sana-glyph">
                <span class="icon-circle-question"></span> &nbsp; circle question &nbsp;|&nbsp; 
                <code>&lt;span class="icon-circle-question"&gt;&lt;/span&gt;</code>
            </div>
            <div class="sana-glyph">
                <span class="icon-circle-info"></span> &nbsp; circle info &nbsp;|&nbsp; 
                <code>&lt;span class="icon-circle-info"&gt;&lt;/span&gt;</code>
            </div>
            <div class="sana-glyph">
                <span class="icon-circle-exclamation"></span> &nbsp; circle exclamation &nbsp;|&nbsp; 
                <code>&lt;span class="icon-circle-exclamation"&gt;&lt;/span&gt;</code>
            </div>
            <div class="sana-glyph">
                <span class="icon-circle-checkmark"></span> &nbsp; circle checkmark &nbsp;|&nbsp; 
                <code>&lt;span class="icon-circle-checkmark"&gt;&lt;/span&gt;</code>
            </div>
            <div class="sana-glyph">
                <span class="icon-circle-cancel"></span> &nbsp; circle cancel &nbsp;|&nbsp; 
                <code>&lt;span class="icon-circle-cancel"&gt;&lt;/span&gt;</code>
            </div>
            <div class="sana-glyph">
                <span class="icon-chevron-up"></span> &nbsp; chevron up &nbsp;|&nbsp; 
                <code>&lt;span class="icon-chevron-up"&gt;&lt;/span&gt;</code>
            </div>
            <div class="sana-glyph">
                <span class="icon-chevron-right"></span> &nbsp; chevron right &nbsp;|&nbsp; 
                <code>&lt;span class="icon-chevron-right"&gt;&lt;/span&gt;</code>
            </div>
            <div class="sana-glyph">
                <span class="icon-chevron-left"></span> &nbsp; chevron left &nbsp;|&nbsp; 
                <code>&lt;span class="icon-chevron-left"&gt;&lt;/span&gt;</code>
            </div>
            <div class="sana-glyph">
                <span class="icon-chevron-down"></span> &nbsp; chevron down &nbsp;|&nbsp; 
                <code>&lt;span class="icon-chevron-down"&gt;&lt;/span&gt;</code>
            </div>
            <div class="sana-glyph">
                <span class="icon-checkmark"></span> &nbsp; checkmark &nbsp;|&nbsp; 
                <code>&lt;span class="icon-checkmark"&gt;&lt;/span&gt;</code>
            </div>
            <div class="sana-glyph">
                <span class="icon-cancel"></span> &nbsp; cancel &nbsp;|&nbsp; 
                <code>&lt;span class="icon-cancel"&gt;&lt;/span&gt;</code>
            </div>
            <div class="sana-glyph">
                <span class="icon-calendar"></span> &nbsp; calendar &nbsp;|&nbsp; 
                <code>&lt;span class="icon-calendar"&gt;&lt;/span&gt;</code>
            </div>
            <div class="sana-glyph">
                <span class="icon-bell-horn"></span> &nbsp; bell horn &nbsp;|&nbsp; 
                <code>&lt;span class="icon-bell-horn"&gt;&lt;/span&gt;</code>
            </div>
            <div class="sana-glyph">
                <span class="icon-arrow-left"></span> &nbsp; arrow left &nbsp;|&nbsp; 
                <code>&lt;span class="icon-arrow-left"&gt;&lt;/span&gt;</code>
            </div>
            <div class="sana-glyph">
                <span class="icon-arrow-right"></span> &nbsp; arrow right &nbsp;|&nbsp; 
                <code>&lt;span class="icon-arrow-right"&gt;&lt;/span&gt;</code>
            </div>
            <div class="sana-glyph">
                <span class="icon-arrow-down"></span> &nbsp; arrow down &nbsp;|&nbsp; 
                <code>&lt;span class="icon-arrow-down"&gt;&lt;/span&gt;</code>
            </div>
            <div class="sana-glyph">
                <span class="icon-arrow-up"></span> &nbsp; arrow up &nbsp;|&nbsp; 
                <code>&lt;span class="icon-arrow-up"&gt;&lt;/span&gt;</code>
            </div>
        </div>

        <div class="container">
            <h1>Plain text icons</h1>
            <p>This variation will inherit the text size as well as color. It also will require adding a CSS rule declaring the font family like so: <code>font-family: 'Sana-Icons' !important;</code> to the parent container.</p>
            <div style="font-family: 'Sana-Icons' !important;">
                                          
            </div>
        </div>




<!-- 
<div style="padding: 4rem 0;">
    <div class="container">
        <div class="row">
            <div class="column" style="padding-top:4rem;padding-bottom: 4rem;">
                <h1 style="margin:0;">These are the boundaries of the regular container. <span class="icon-plus"></span></h1>
            </div>
        </div>
    </div>
</div>

<div class="container">
<a class="button">Button</a>
<a class="button -secondary">Button</a>
</div>

<div class="container">
<a class="button -small">Button</a>
<a class="button -small -secondary">Button</a>
</div>
 -->






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
