<?php
// Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'AuthorityDev Base' );
define( 'CHILD_THEME_URL', 'http://www.authroritydev.com' );

if ( ! isset( $content_width ) ) {
	$content_width = 740;
}

// Add Theme Customizer functionality
include_once(trailingslashit(get_stylesheet_directory()) . 'lib/admin/customizer.php');

// Mobile Detect PHP class
include_once(trailingslashit(get_stylesheet_directory()) . 'lib/mobile-detect/mobile-detect.php');
if ( class_exists( 'Mobile_Detect' ) ) {
$authoritydevbase_detect = new Mobile_Detect();
}

// Activate the child theme
add_action('genesis_setup','authoritydevbase_theme_setup', 15);

if ( ! function_exists( 'authoritydevbase_theme_setup' ) ) {
/*** THIS FIRES OFF ALL CHILD THEME SETUP - FUNCTIONS LOCATED IN /lib/authoritydevbase_child_functions.php ***/
function authoritydevbase_theme_setup() {

// Holds all of the funtions called from this main file
include_once( trailingslashit(get_stylesheet_directory()) . 'lib/authoritydevbase_child_functions.php' ); /* <-- THIS FILE IS REQUIRED!! DO NOT REMOVE --> */

// Add some custom options to the admin panel 
include_once( trailingslashit(get_stylesheet_directory()) . 'lib/admin/admin_functions.php' );

// Add additional theme options
include_once( trailingslashit(get_stylesheet_directory()) . 'lib/custom_theme_options.php' );

// This styles the visual editor
if ( function_exists( 'add_editor_style') ) {
add_editor_style( array( 'css/editor-style.css', authoritydevbase_font_url() ) );
}

// Translations can be added to the /languages/ directory
load_theme_textdomain( 'authroritydevbase', trailingslashit(get_stylesheet_directory()) . 'lib/languages' );
	
	
/*** CLEAN UP THE <HEAD> ***/

// Remove rsd link
//remove_action( 'wp_head', 'rsd_link' );  
                  
// Remove Windows Live Writer
//remove_action( 'wp_head', 'wlwmanifest_link' );   
                    
// Index link
//remove_action( 'wp_head', 'index_rel_link' ); 
                        
// Previous link
//remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );  
          
// Start link
//remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );   
          
// Links for adjacent posts
//remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 ); 

// Remove WP version
//remove_action( 'wp_head', 'wp_generator' );  


/*** OTHER <HEAD> ELEMENTS ***/

// Add Viewport meta tag for mobile browsers
if ( function_exists( 'authoritydevbase_viewport_meta_tag') ) {
add_action( 'genesis_meta', 'authoritydevbase_viewport_meta_tag' );
}

// Disable the action above if you want to use what Genesis adds for viewport. Use one or the other!
//add_theme_support( 'genesis-responsive-viewport' );

// Change favicon location 
if ( function_exists( 'authoritydevbase_favicon_filter') ) {
add_filter( 'genesis_pre_load_favicon', 'authoritydevbase_favicon_filter' );
}

// Add scripts & styles 
if ( function_exists( 'authoritydevbase_load_custom_scripts') ) {
add_action( 'wp_enqueue_scripts', 'authoritydevbase_load_custom_scripts', 99 );
}

// Remove version number from js and css
if ( function_exists( 'authoritydevbase_remove_script_version')) {
if ( ! is_admin() || ! is_admin_bar_showing() ){
add_filter( 'script_loader_src', 'authoritydevbase_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', 'authoritydevbase_remove_script_version', 15, 1 );
}
}

/*** STRUCTURE & REPOSITIONING ***/

// Add support for structural wraps 
add_theme_support( 'genesis-structural-wraps', array( 'header', 'nav', 'subnav', 'inner', 'footer-widgets', 'footer', 'home-middle', 'home-featured-wrapper', 'home-featured-halves', 'home-bottom') );

// Add custom body classes (is-[device-type], header-image)
if ( function_exists( 'authoritydevbase_body_classes')) {
add_filter( 'body_class', 'authoritydevbase_body_classes' );
}

// Add custm post classes ( post-even, post-odd, post-[counter])
if ( function_exists( 'authoritydevbase_body_classes')) {
add_filter( 'post_class', 'authoritydevbase_specials_post_class' );
}
// Add HTML5 functions
add_theme_support( 'html5', array('search-form', 'comment-form', 'comment-list',) );

// Enable support for Post Formats.
add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery',) );

// Add RSS feed links to <head> for posts and comments.
add_theme_support( 'automatic-feed-links' );

// Enable Post Thumbnails & sizes
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 672, 372, true );
add_image_size( 'authoritydevbase-grid-third', 352, 300, true );
add_image_size( 'authoritydevbase-full-width', 1038, 576, true );


// Adding Color Style Options
add_theme_support( 'genesis-style-selector', array( 
	'authoritydevbase-grey' => __( 'Grey', 'authoritydevbase' ),
	'authoritydevbase-red' => __( 'Red', 'authoritydevbase' ), 
	'authoritydevbase-blue' => __( 'Blue', 'authoritydevbase' ), 
	'authoritydevbase-yellow' => __( 'Yellow', 'authoritydevbase' ), 
	'authoritydevbase-purple' => __( 'Purple', 'authoritydevbase' ), 
	'authoritydevbase-green' => __( 'Green', 'authoritydevbase' ) 
));

// Add theme support for Custom Background
add_theme_support( 'custom-background', array('default-color' => 'FFFFFF') );

add_theme_support( 'custom-header', array(
	'width'           => 1140,
	'height'          => 164,
	'header-selector' => '.site-header .wrap'
	//'header-text' => false
) );

// Reposition primary nav menu
remove_action('genesis_after_header','genesis_do_nav');
add_action('genesis_before_header','genesis_do_nav');
//add_action('genesis_header_right','genesis_do_nav');


// Reposition secondary nav menu
remove_action('genesis_after_header','genesis_do_subnav');
add_action('genesis_before_header','genesis_do_subnav');
//add_action('genesis_header_right','genesis_do_subnav');


// Clean up nav id's & classes
add_filter( 'dropdown_menu_class_menus', 'authoritydevbase_dropdown_class_on_primary' );
add_filter('nav_menu_css_class', 'authoritydevbase_nav_class_filter', 100, 1);
add_filter( 'nav_menu_item_id', 'authoritydevbase_nav_id_filter', 10, 2 );

// Remove Genesis layout settings
//remove_theme_support( 'genesis-inpost-layouts' );

/*** CUSTOMIZING TITLES & DESCRIPTION & BREADCRUMBS ***/

// Remove and/or add custom site title
//remove_action( 'genesis_site_title', 'genesis_seo_site_title' );
//add_action( 'genesis_site_title', 'authoritydevbase_custom_seo_site_title' );

// Remove and/or add custom post title
//remove_action('genesis_entry_header','genesis_do_post_title');
//add_action('genesis_entry_header','authoritydevbase_do_custom_post_title');

// Remove and/or add custom site description
//remove_action( 'genesis_site_description', 'genesis_seo_site_description' );
//add_action( 'genesis_site_description', 'authoritydevbase_custom_seo_site_description' );

// Reposition breadcrumbs
//remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
//add_action( 'genesis_entry_header', 'genesis_do_breadcrumbs' );


/*** FOOTER ***/

// Footer creds
if ( function_exists( 'authoritydevbase_footer_creds_text') ) {
add_filter('genesis_footer_creds_text', 'authoritydevbase_footer_creds_text');
}

// Add support for footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

/*** OTHER GENESIS CLEANUP OPTIONS ***/

// Remove Genesis layout options
//genesis_unregister_layout( 'sidebar-content' );
//genesis_unregister_layout( 'content-sidebar-sidebar' );
//genesis_unregister_layout( 'sidebar-sidebar-content' );
//genesis_unregister_layout( 'sidebar-content-sidebar' );
//genesis_unregister_layout( 'content-sidebar' );
//genesis_unregister_layout( 'full-width-content' );

/*** SIDEBARS & WIDGETS ***/

// Remove the header right widget area
//unregister_sidebar( 'header-right' );
//unregister_sidebar( 'sidebar-alt' );

// Home page widgets
if ( function_exists( 'authoritydevbase_widgets_init') ) {
add_action( 'widgets_init', 'authoritydevbase_widgets_init' );
}

/*** OTHER ***/
if ( function_exists( 'authoritydevbase_prevent_theme_update') ) {
add_filter( 'http_request_args', 'authoritydevbase_prevent_theme_update', 5, 2 );
}

// Below is the closing bracket of theme setup. It's kinda important. 
} // <-- DO NOT REMOVE THIS
} // <-- Or THIS
?>