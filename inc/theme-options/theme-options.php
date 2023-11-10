<?php 
/*
 * theme-options.php
 * 
 * Table of contents:
 * 
 * 1. DEFINITIONS
 * 2. HOOKS
 * 3. RENDER FUNCTIONS
 * 4. SANITIZE FUNCTIONS
 * 5. CUSTOM SCRIPTS
 * 6. OTHER FUNCTIONS
 */



/*
 * 1. DEFINITIONS
 * Section information.
 */
$baseinstall_sections = [
    'section-theme-settings' => [
        'title' => 'Theme Settings',
        'desc'  => 'General theme settings.'
    ],
    'section-form-settings' => [
        'title' => 'Marketing Settings',
        'desc'  => 'Newsletter signup form and related text that displays in the site footer.'
    ],
    'section-social-settings' => [
        'title' => 'Social Settings',
        'desc'  => 'Edit your social media profiles. Empty fields will not show on the front end.'
    ],
    'section-google-settings' => [
        'title' => 'Google Tag Manager Settings',
        'desc'  => 'Copy and paste your GTM scripts here.'
    ],
    'section-tracker-settings' => [
        'title' => 'Third-Party Tracking Scripts',
        'desc'  => 'Copy and paste other tracking scripts here. IMPORTANT: adding additional tracking scripts can cause slower page load speed.'
    ],
    'section-schema-settings' => [
        'title' => 'Schema Settings',
        'desc'  => 'Copy and paste schema scripts here.'
    ]
];

/*
 * Field information.
 */
$baseinstall_fields = [
    // 'baseinstall-logo' => [
    //     'title'    => 'Footer logo',
    //     'type'     => 'upload',
    //     'section'  => 'section-theme-settings',
    //     'default'  => '',
    //     'desc'     => 'Set your footer logo. Upload or choose an existing one.',
    //     'sanitize' => ''
    // ],
    // 'baseinstall-footer-address' => [
    //     'title'    => 'Street Address',
    //     'type'     => 'text',
    //     'section'  => 'section-theme-settings',
    //     'default'  => '',
    //     'desc'     => '',
    //     'sanitize' => 'default'
    // ],
    // 'baseinstall-footer-citystatezip' => [
    //     'title'    => 'City, State, Zip',
    //     'type'     => 'text',
    //     'section'  => 'section-theme-settings',
    //     'default'  => '',
    //     'desc'     => '',
    //     'sanitize' => 'default'
    // ],
    'baseinstall-footer-copyright' => [
        'title'    => 'Copyright text',
        'type'     => 'text',
        'section'  => 'section-theme-settings',
        'default'  => '',
        'desc'     => '',
        'sanitize' => 'default'
    ],
    'baseinstall-form-title' => [
        'title'    => 'Newsletter heading',
        'type'     => 'text',
        'section'  => 'section-form-settings',
        'default'  => '',
        'desc'     => '',
        'sanitize' => 'default'
    ],
    'baseinstall-form-copy' => [
        'title'    => 'Newsletter copy',
        'type'     => 'text',
        'section'  => 'section-form-settings',
        'default'  => '',
        'desc'     => '',
        'sanitize' => 'default'
    ],
    'baseinstall-form-embed' => [
        'title'    => 'Newsletter signup form',
        'type'     => 'textarea',
        'section'  => 'section-form-settings',
        'default'  => '',
        'desc'     => '',
        'sanitize' => ''
    ],
    'baseinstall-social-linkedin' => [
        'title'    => 'LinkedIn profile',
        'type'     => 'text',
        'section'  => 'section-social-settings',
        'default'  => '',
        'desc'     => '',
        'sanitize' => 'full'
    ],
    'baseinstall-social-twitter' => [
        'title'    => 'Twitter profile',
        'type'     => 'text',
        'section'  => 'section-social-settings',
        'default'  => '',
        'desc'     => '',
        'sanitize' => 'full'
    ],
    'baseinstall-social-facebook' => [
        'title'    => 'Facebook profile',
        'type'     => 'text',
        'section'  => 'section-social-settings',
        'default'  => '',
        'desc'     => '',
        'sanitize' => 'full'
    ],
    'baseinstall-social-instagram' => [
        'title'    => 'Instagram profile',
        'type'     => 'text',
        'section'  => 'section-social-settings',
        'default'  => '',
        'desc'     => '',
        'sanitize' => 'full'
    ],
    'baseinstall-social-youtube' => [
        'title'    => 'YouTube profile',
        'type'     => 'text',
        'section'  => 'section-social-settings',
        'default'  => '',
        'desc'     => '',
        'sanitize' => 'full'
    ],
    'baseinstall-gtm-header' => [
        'title'    => 'GTM Header Script',
        'type'     => 'textarea',
        'section'  => 'section-google-settings',
        'default'  => '',
        'desc'     => '',
        'sanitize' => ''
    ],
    'baseinstall-gtm-body' => [
        'title'    => 'GTM Body Script',
        'type'     => 'textarea',
        'section'  => 'section-google-settings',
        'default'  => '',
        'desc'     => '',
        'sanitize' => ''
    ],
    'baseinstall-thirdparty-script-header' => [
        'title'    => 'Third-Party Header Scripts',
        'type'     => 'textarea',
        'section'  => 'section-tracker-settings',
        'default'  => '',
        'desc'     => 'Scripts for the &lt;head&gt; go here',
        'sanitize' => ''
    ],
    'baseinstall-thirdparty-script-body' => [
        'title'    => 'Third-Party Body Script',
        'type'     => 'textarea',
        'section'  => 'section-tracker-settings',
        'default'  => '',
        'desc'     => 'Scripts for the &lt;body&gt; go here',
        'sanitize' => ''
    ],
    'baseinstall-homepage-schema-scripts' => [
        'title'    => 'Homepage Schema Scripts',
        'type'     => 'textarea',
        'section'  => 'section-schema-settings',
        'default'  => '',
        'desc'     => 'Schema scripts specific to the homepage',
        'sanitize' => ''
    ],
    'baseinstall-global-schema-scripts' => [
        'title'    => 'Global Schema Scripts',
        'type'     => 'textarea',
        'section'  => 'section-schema-settings',
        'default'  => '',
        'desc'     => 'Schema scripts to appear on all pages',
        'sanitize' => ''
    ]
];



/*
 * 2. HOOKS
 */
add_action( 'after_setup_theme', 'baseinstall_init_option' );
add_action( 'admin_menu', 'baseinstall_update_menu' );
add_action( 'admin_init', 'baseinstall_init_settings' );
add_action( 'admin_enqueue_scripts', 'baseinstall_options_custom_scripts' );



/*
 * 3. RENDER FUNCTIONS
 * Renders a section description.
 */
function baseinstall_render_section( $args ) {
    global $baseinstall_sections;

    echo "<p>" . $baseinstall_sections[ $args['id'] ]['desc'] . "</p>";
    echo "<hr />";
}

/*
 * Renders input fields: can be text, textarea, checkbox, radio, select, or upload
 */
function baseinstall_render_field( $id ) {
    global $baseinstall_fields;

    $options = get_option( 'baseinstall_options' );

    // If options are not set yet for that ID, grab the default value.
    $field_value = isset( $options[ $id ] ) ? $options[ $id ] : baseinstall_get_field_default( $id );

    // Generate HTML markup based on field type.
    switch ( $baseinstall_fields[ $id ]['type'] ) {
        case 'text': 
            echo "<input type='text' class='baseinstall-custom-text-width' name='baseinstall_options[" . $id . "]' value='" . $field_value . "' />";
            echo "<p class='description'>" . $baseinstall_fields[ $id ]['desc'] . "</p>";
            
            break;

        case 'upload':
            $visibility_class = ( '' != $field_value ) ? "" : "hide";

            echo "<img src='" . $field_value . "' alt='Logo' class='baseinstall-custom-thumbnail " . $visibility_class . "' id='" . $id . "-thumbnail' />";
            echo "<input type='hidden' name='baseinstall_options[" . $id . "]' id='" . $id . "-upload-field' value='" . $field_value . "' />";
            echo "<input type='button' class='btn-upload-img button' value='Upload logo' data-field-id='" . $id . "' />";
            echo "<input type='button' class='btn-remove-img button " . $visibility_class . "' value='Remove logo' data-field-id='" . $id . "' id='" . $id . "-remove-button' />";
            echo "<p class='description'>" . $baseinstall_fields[ $id ]['desc'] . "</p>";
            
            break;

        case 'textarea': 
            echo "<textarea name='baseinstall_options[" . $id . "]' cols='40' rows='10' class='baseinstall-custom-text-width'>" . $field_value . "</textarea>";
            echo "<p class='description'>" . $baseinstall_fields[ $id ]['desc'] . "</p>";
            
            break;

        case 'checkbox':
            echo "<input type='checkbox' name='baseinstall_options[" . $id . "]' id='" . $id . "' value='1' " . checked( $field_value, 1, false ) . " />";
            echo "<label for='" . $id . "'>" . $baseinstall_fields[ $id ]['label'] . "</label>";

            break;

        case 'radio': 
            // Generate as many radio buttons as there are children.
            for ( $i = 0; $i < sizeof( $baseinstall_fields[ $id ]['children'] ); $i++ ) {
                echo "<p>";
                echo "<input type='radio' name='baseinstall_options[" . $id . "]' id='baseinstall_options[" . $id . "]-" . $i . "' value='" . $i . "' " . checked( $field_value, $i, false ) . " />";
                echo "<label for='baseinstall_options[" . $id . "]-" . $i . "'>" . $baseinstall_fields[ $id ]['children'][ $i ] . "</label>";
                echo "</p>";
            }

            break;

        case 'select': 
            echo "<select name='baseinstall_options[" . $id . "]'>";
            for ( $i = 0; $i < sizeof( $baseinstall_fields[ $id ]['children'] ); $i++ ) {
                echo "<option value='" . $i . "' " . selected( $field_value, $i, false ) . ">";
                echo $baseinstall_fields[ $id ]['children'][ $i ];
                echo "</option>";
            }
            echo "</select>";

            break;
    }
}

/*
 * Renders the theme options page.
 */
function baseinstall_render_theme_options() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( 'You do not have sufficient permissions to access this page.' );
    } ?>

    <div class="wrap">
        <h1>Theme Options</h1>

        <?php settings_errors(); ?>

        <form action="options.php" method="post">
            <?php
                settings_fields( "baseinstall_options" );
                do_settings_sections( "baseinstall-theme-options" );
                echo "<hr />";
                submit_button();
            ?>
        </form>
    </div>
<?php }



/*
 * 4. SANITIZE FUNCTIONS
 * Sanitizes the settings.
 */
function baseinstall_options_validate( $input ) {
    // Define a blank array for the output.
    $output = [];

    // Do a general sanitization for every field.
    foreach ( $input as $key => $value ) {
        // Grab the sanitize option for this field.
        $field_sanitize = baseinstall_get_field_sanitize( $key );

        switch ( $field_sanitize ) {
            case 'default':
                $output[ $key ] = strip_tags( stripslashes( $input[ $key ] ) );
                break;
            
            case 'full':
                $output[ $key ] = esc_url_raw( strip_tags( stripslashes( $input[ $key ] ) ) );
                break;

            case 'google-analytics':
                $output[ $key ] = ( preg_match('/^UA-[0-9]+-[0-9]+$/', $input[ $key ] ) ) ? $input[ $key ] : '';
                break;

            default:
                $output[ $key ] = $input[ $key ];
                break;
        }
    }

    return $output;
}



/*
 * 5. CUSTOM SCRIPTS
 * Registers and loads custom JavaScript and CSS.
 */
function baseinstall_options_custom_scripts() {
    // Get information about the current page.
    $screen = get_current_screen();

    // Register a custom script that depends on jQuery, Media Upload and Thickbox (available from the Core).
    wp_register_script( 'baseinstall-custom-admin-scripts', get_template_directory_uri() .'/inc/theme-options/theme-options.js', array( 'jquery' ) );

    // Register custom styles.
    wp_register_style( 'baseinstall-custom-admin-styles', get_template_directory_uri() .'/inc/theme-options/theme-options.css' );
    
    // Only load these scripts if we're on the theme options page.
    if ( 'appearance_page_baseinstall-theme-options' == $screen->id ) {
        // Enqueues all scripts, styles, settings, and templates necessary to use all media JavaScript APIs.
        wp_enqueue_media();
        
        // Load our custom scripts.
        wp_enqueue_script( 'baseinstall-custom-admin-scripts' );

        // Load our custom styles.
        wp_enqueue_style( 'baseinstall-custom-admin-styles' );
    }    
}



/*
 * 6. OTHER FUNCTIONS
 * Returns the default value of a field.
 */
function baseinstall_get_field_default( $id ) {
    global $baseinstall_fields;

    return $baseinstall_fields[ $id ]['default'];
}

/*
 * Checks if the options exists in the database.
 */
function baseinstall_init_option() {
    $options = get_option( 'baseinstall_options' );

    if ( false === $options ) {
        add_option( 'baseinstall_options' );
    }
}

/*
 * Creates a sub-menu under Appearance.
 */
function baseinstall_update_menu() {
    add_theme_page( 'Theme Options', 'Theme Options', 'manage_options', 'baseinstall-theme-options', 'baseinstall_render_theme_options' );
}

/*
 * Registers and adds settings, sections and fields.
 */
function baseinstall_init_settings() {
    // Declare $baseinstall_sections and $baseinstall_fields as global.
    global $baseinstall_fields, $baseinstall_sections;

    // Register a general setting.
    // The $option_group is the same as $option_name to prevent the "Error: options page not found." problem.
    register_setting( "baseinstall_options", "baseinstall_options", "baseinstall_options_validate" );

    // Add sections as defined in the $baseinstall_sections array.
    foreach ($baseinstall_sections as $section_id => $section_value) {
        add_settings_section( $section_id, $section_value['title'], "baseinstall_render_section", "baseinstall-theme-options" );
    }

    // Add fields as defined in the $baseinstall_fields array.
    foreach ($baseinstall_fields as $field_id => $field_value) {
        add_settings_field( $field_id, $field_value['title'], "baseinstall_render_field", "baseinstall-theme-options", $field_value['section'], $field_id );
    }
}

/*
 * Returns the sanitized field value.
 */
function baseinstall_get_field_sanitize( $id ) {
    global $baseinstall_fields;

    return $baseinstall_fields[ $id ]['sanitize'];
}