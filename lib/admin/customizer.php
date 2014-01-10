<?php
/**
 *  Customizer
 *
 **/

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function authoritydevbase_customize_register( $wp_customize ) {
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
    $wp_customize->get_setting( 'authoritydevbase_options[header_background_color]' )->transport = 'postMessage';
}
add_action( 'customize_register', 'authoritydevbase_customize_register' );

// Js
function authoritydevbase_customize_preview_js() {
	wp_enqueue_script( 'authoritydevbase_customizer', trailingslashit( CHILD_URL ) . '/lib/admin/theme-customizer.js', array( 'customize-preview' ), '20131225', true );
}
add_action( 'customize_preview_init', 'authoritydevbase_customize_preview_js' );


// TextArea Control Class
if ( class_exists( 'WP_Customize_Control' ) ) {
    class AuthorityDevTextAreaControl extends WP_Customize_Control {
        public $type = 'textarea';
        public function __construct( $manager, $id, $args = array() ) {
            $this->statuses = array( '' => __( 'Default', 'authoritydevbase' ) );
            parent::__construct( $manager, $id, $args );
        }

        public function render_content() {
            echo '<label>
                <span class="customize-control-title">' . esc_html( $this->label ) . '</span>
                <textarea rows="5" style="width:100%;" ';
            $this->link();
            echo '>' . esc_textarea( $this->value() ) . '</textarea>
                </label>';
        }
    }

}

// Returns the options array 
function authoritydevbase_options($name, $default = false) {
    $options = ( get_option( 'authoritydevbase_options' ) ) ? get_option( 'authoritydevbase_options' ) : null;
    // return if it exists
    if ( isset( $options[ $name ] ) ) {
        return apply_filters( 'authoritydevbase_options_$name', $options[ $name ] );
    }
    // return default else
    return apply_filters( 'authoritydevbase_options_$name', $default );
}

// Theme customizer settings
add_action( 'customize_register', 'authoritydevbase_customizer' );
function authoritydevbase_customizer($wp_customize){
    
    // Remove default WP Customize sections
    $wp_customize->remove_section('background_image');
    $wp_customize->remove_section('header_image');
    $wp_customize->remove_section('static_front_page');


    // General Settings
    $wp_customize->add_section('authoritydevbase_general_settings', array(
        'title' => 'General Settings',
        'description'    => __('Website General Settings', 'authoritydevbase'),
        'priority' => 59,
    ));
	// Site Title Setting
    $wp_customize->add_setting('blogname', array( 
        'default'    => get_option('blogname'),
        'type'       => 'option',
        'capability' => 'manage_options',
    ) );
    $wp_customize->add_control('blogname', array( 
        'label'    => __('Site Title', 'authoritydevbase'),
        'section'  => 'authoritydevbase_general_settings',
        'priority' => 1,
    ) );
	// Site Description Setting
    $wp_customize->add_setting('blogdescription', array( 
        'default'    => get_option('blogdescription'),
        'type'       => 'option',
        'capability' => 'manage_options',
    ) );
 	// Site Description Control   
    $wp_customize->add_control('blogdescription', array( 
        'label'    => __('Tagline', 'authoritydevbase'),
        'section'  => 'authoritydevbase_general_settings',
        'priority' => 2,
    ) );
	// Add Favicon Setting
    $wp_customize->add_setting('authoritydevbase_options[favicon]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'manage_options',
    ) );
	// Add Favicon Control
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'authoritydevbase_options[favicon]', array(
        'label'    => __('Favicon', 'authoritydevbase'),
        'section'  => 'authoritydevbase_general_settings',
        'settings' => 'authoritydevbase_options[favicon]',
        'priority' => 5,
    ) ) );
	// Add Background Image Section
    $wp_customize->add_section( 'background_image', array(
        'title'          => __( 'Background Settings', 'authoritydevbase' ),
        'theme_supports' => 'custom-background',
        'priority'       => 80,
    ) );

	
	
	
	
	
	
	$settings_field = GENESIS_SETTINGS_FIELD;
	// START theme style selector
	$wp_customize->add_setting( $settings_field.'[style_selection]', array(
		'type'           => 'option',
		'default' =>  genesis_get_option( 'style_selection' ),
		'capability'     => 'edit_theme_options',
		//'sanitize_callback' => 'authoritydevbase_genesis_settings_sanitizer_init',
	) );	
	$styles  = get_theme_support( 'genesis-style-selector' );
	if ( ! empty( $styles ) ) {$styles = array_shift( $styles ); }
	$wp_customize->add_control( $settings_field.'[style_selection]', array(
		'label'      => __( 'Color Scheme', 'themename' ),
		'section'    => 'authoritydevbase_general_settings',
		'settings'   => $settings_field.'[style_selection]',
		'type'       => 'select',
		'choices'    => $styles,
	) ); // END theme style selector  
	
	
	
	
	
	  
	  
	  
	  
	  
    $wp_customize->add_section( 'header_image', array(
        'title'          => __( 'Header Settings', 'authoritydevbase' ),
        'theme_supports' => 'custom-header',
        'priority'       => 60,
    ) );
	// Add Header Text Hide Setting
    $wp_customize->add_setting('display_header_text', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
    ) );
	// Add Header Text Hide Control
    $wp_customize->add_control( 'display_header_text', array(
        'settings' => 'header_textcolor',
        'label'    => __( 'Show Title & Tagline', 'authoritydevbase' ),
        'section'  => 'header_image',
        'type'     => 'checkbox',
        'priority' => 4,
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_textcolor', array(
        'label'   => __( 'Header Text Color', 'authoritydevbase' ),
        'section' => 'header_image',
    ) ) );
    // Background Color Setting	 
    $wp_customize->add_setting( 'background_color', array(
        'default'        => get_theme_support( 'custom-background', 'default-color' ),
        'theme_supports' => 'custom-background',
        'sanitize_callback'    => 'sanitize_hex_color_no_hash',
        'sanitize_js_callback' => 'maybe_hash_hex_color',
    ) );
    // Background Color Control	 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'background_color', array(
        'label'   => __( 'Background Color', 'authoritydevbase' ),
        'section' => 'background_image',
    ) ) );
    # Footer Settings
    $wp_customize->add_section('authoritydevbase_footer_settings', array(
        'title' => 'Footer Settings',
        'description'    => __('Website Footer Settings', 'authoritydevbase'),
        'priority' => 70,
        'transport' => 'postMessage',
    ));
    # Back To Top Option
    $wp_customize->add_setting('authoritydevbase_options[footer_backtotop]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
    ) );
    $wp_customize->add_control('authoritydevbase_options[footer_backtotop]', array(
        'settings'  => 'authoritydevbase_options[footer_backtotop]',
        'label'     => __('Enable Back To Top Link', 'authoritydevbase'),
        'section'   => 'authoritydevbase_footer_settings',
        'type'      => 'checkbox',
        'transport' => 'postMessage',
        'priority'  => 3,
		'default' => '0',
    ) );
    // Custom Back To Top Text Setting
    $wp_customize->add_setting('authoritydevbase_options[footer_backtotop_text]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
    ) );
    // Custom Back To Top Text Control
    $wp_customize->add_control('authoritydevbase_options[footer_backtotop_text]', array(
		'default' => __('Back To Top', 'authoritydevbase'),
		'settings' => 'authoritydevbase_options[footer_backtotop_text]',
        'label'   => __('Custom Back To Top Text', 'authoritydevbase'),
        'section' => 'authoritydevbase_footer_settings',
        'type'     => 'text',
        'priority' => 4,
	) );
    // Sticky Top Bar Option Setting
    $wp_customize->add_setting('authoritydevbase_options[sticky_topbar]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
    ) );
    // Sticky Top Bar Option Control
    $wp_customize->add_control('authoritydevbase_options[sticky_topbar]', array(
        'settings'  => 'authoritydevbase_options[sticky_topbar]',
        'label'     => __('Sticky Top Bar', 'authoritydevbase'),
        'section'   => 'nav',
        'type'      => 'checkbox',
        'transport' => 'postMessage',
        'priority'  => 3,
    ) );
    // Front Page Settings Section
    $wp_customize->add_section( 'static_front_page', array(
        'title'          => __( 'Front Page Settings', 'authoritydevbase' ),
        'priority'       => 120,
        'description'    => __( 'Your theme supports a static front page.', 'authoritydevbase'),
    ) );
    // Front Page Content Setting
    $wp_customize->add_setting( 'show_on_front', array(
        'default'        => get_option( 'show_on_front' ),
        'capability'     => 'manage_options',
        'type'           => 'option',
       	'theme_supports' => 'static-front-page',
    ) );
    // Front Page Content Control
    $wp_customize->add_control( 'show_on_front', array(
        'label'   => __( 'Front page displays', 'authoritydevbase' ),
        'section' => 'static_front_page',
        'type'    => 'radio',
        'choices' => array(
            'posts' => __( 'Widgitized homepage', 'authoritydevbase' ),
            'page'  => __( 'A static page', 'authoritydevbase' ),
        ),
    ) );
    // Front Page Content Setting    
    $wp_customize->add_setting( 'page_on_front', array(
        'type'       => 'option',
        'capability' => 'manage_options',
    ) );
    // Front Page Content Control
    $wp_customize->add_control( 'page_on_front', array(
        'label'      => __( 'Front page', 'authoritydevbase' ),
        'section'    => 'static_front_page',
        'type'       => 'dropdown-pages',
    ) );
    $wp_customize->add_setting( 'page_for_posts', array(
        'type'           => 'option',
        'capability'     => 'manage_options',
        'theme_supports' => 'static-front-page',
    ) );
    $wp_customize->add_control( 'page_for_posts', array(
        'label'      => __( 'Posts page', 'authoritydevbase' ),
        'section'    => 'static_front_page',
        'type'       => 'dropdown-pages',
    ) );
}