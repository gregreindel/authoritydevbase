<?php 

// Add Viewport meta tag for mobile browsers
function authoritydevbase_viewport_meta_tag() {
	echo '<meta name="HandheldFriendly" content="True" />'."\n";
	echo '<meta name="MobileOptimized" content="320" />'."\n";
	echo '<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>'."\n";
}

// Change favicon location 
function authoritydevbase_favicon_filter( $favicon_url ) {
	$authoritydevbase_favicon_url = authoritydevbase_options( 'favicon' );
	if (! $authoritydevbase_favicon_url == ''){
	return esc_url($authoritydevbase_favicon_url);
	} else {
	return get_bloginfo('stylesheet_directory').'/images/favicon.png';
	}
}

// Add scripts & styles
function authoritydevbase_load_custom_scripts() {
		  
	  wp_enqueue_style( 'googlefonts', authoritydevbase_font_url(), array(), null );
	  wp_enqueue_style( 'font-awesome',  '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css' );
	  wp_enqueue_style( 'authoritydevbase-ie', trailingslashit( CHILD_URL ) . 'css/authoritydevbase-ie.css' );
	  wp_style_add_data( 'authoritydevbase-ie', 'conditional', 'lt IE 9' );  
	
	if ( get_background_image() ){
	  wp_enqueue_script( 'backstretch', trailingslashit( CHILD_URL ) . 'js/backstretch.js', array( 'jquery' ), '1.0', true );
	  wp_localize_script( 'backstretch', 'authoritydevbaseBackstretch', array(
		  'imgSrc' => str_replace( 'http:', '', get_background_image() ),
	  ) );
	}
	
	  global $authoritydevbase_detect;
	  $deviceType = ($authoritydevbase_detect->isMobile() ? ($authoritydevbase_detect->isTablet() ? 'isTablet' : 'isMobile') : 'isDesktop');
	  
	  wp_enqueue_script( 'authoritydevbase', trailingslashit( CHILD_URL ) . 'js/authoritydevbase.js', array( 'jquery' ), '1.0', true );
	  wp_localize_script( 'authoritydevbase', 'authoritydevbaseDefaults', array(
		  'device' => esc_js($deviceType),
		  'BackToTop' => esc_js(authoritydevbase_options( 'footer_backtotop' )),
		  'BackToTopText' => esc_js(authoritydevbase_options( 'footer_backtotop_text' )),
		  'StickyNav' => esc_js(authoritydevbase_options( 'sticky_topbar' )),
		  'StickyNavTarget' => esc_js(__( '.nav-primary', 'authoritydevbase' )),
	  ) );
}

function authoritydevbase_font_url() {
	$font_url = '';
	$font_url = add_query_arg( 'family', 'Source+Sans+Pro:400,300,700,400italic,200,700italic', "//fonts.googleapis.com/css" );
	return $font_url;
}

// Remove version number from css and js
function authoritydevbase_remove_script_version( $src ){
    if (preg_match("(\?ver=)", $src )){
	$parts = explode( '?', $src );
	return $parts[0];
	}else{
	return $src;
	}
}

// Add body classes
function authoritydevbase_body_classes( $classes ) {
    global $authoritydevbase_detect;
	$deviceType = ($authoritydevbase_detect->isMobile() ? ($authoritydevbase_detect->isTablet() ? 'isTablet' : 'isMobile') : 'isDesktop');
	$classes[] = sanitize_html_class($deviceType);
	return $classes;
}

/**
 * Apply Dropdown Menu Class to Primary Only
 *
 * @author Bill Erickson
 * @link https://gist.github.com/billerickson/6700212
 *
 * @param array $menus, theme locations
 * @return array $menus
 */
function authoritydevbase_dropdown_class_on_primary( $menus ) {
  return array( 'primary' );
}
// Reduce nav classes
function authoritydevbase_nav_class_filter( $var ) {
return is_array($var) ? array_intersect($var, array('current-menu-item', 'menu-item', 'menu-item-has-children')) : '';
}
//	Add page slug as nav IDs
function authoritydevbase_nav_id_filter( $id, $item ) {
return 'nav-'.sanitize_title_with_dashes($item->title);
}

// Add post classes
function authoritydevbase_specials_post_class( $classes ) {
	global $wp_query;
	if ( is_archive() || is_search() || is_home() ) {
	if( 0 == $wp_query->current_post || 0 == $wp_query->current_post % 2 ) {
	$classes[] = 'post-even';
	} else {
	$classes[] = 'post-odd';
	}
	$classes[] = 'post-count-'.intval($wp_query->current_post);
	}
	return $classes;
}

// Footer creds
function authoritydevbase_footer_creds_text($creds) {
		if ( is_front_page()) {
	$creds = '&copy;' .intval(date('Y')) .' '. get_bloginfo('name');
	$creds .= '<div id="'. sanitize_html_class('dev-credits').'">';
	$creds .=  __('Child theme by ', 'authoritydevbase' );
	$creds .= '<a href="http://www.authoritydev.com">';
	$creds .=  __('AuthorityDev', 'authoritydevbase' );
	$creds .= '</a></div>';
		}else {
	$creds = '&copy;' .intval(date('Y')) .' '. get_bloginfo('name');
		}
	 return  $creds;	
}

// Remove & add custom site title
function authoritydevbase_custom_seo_site_title() {
		if(is_front_page()){ 
	echo '<h1 class="site-title" itemprop="headline"><a title="'.get_bloginfo('name').'" href="'.get_bloginfo('url').'" rel="nofollow">'.get_bloginfo('name').'</a></h1>';
	}else {
	echo '<p class="site-title" itemprop="headline"><a title="'.get_bloginfo('name').'" href="'.get_bloginfo('url').'" rel="nofollow">'.get_bloginfo('name').'</a></p>';
		}
}

// Remove & add custom post title
function authoritydevbase_do_custom_post_title() {
	 echo the_title( '<h1 class="entry-title" itemprop="headline">' , '</h1>');
}

// Remove & add custom site description
function authoritydevbase_custom_seo_site_description() {
	echo '<p class="site-description">'.get_bloginfo('description').'</p>';
}

// Remove Genesis widgets
function authoritydevbase_remove_genesis_widgets() {
    unregister_widget( 'Genesis_eNews_Updates' );
    unregister_widget( 'Genesis_Featured_Page' );
    unregister_widget( 'Genesis_User_Profile_Widget' );
    unregister_widget( 'Genesis_Menu_Pages_Widget' );
    unregister_widget( 'Genesis_Widget_Menu_Categories' );
    unregister_widget( 'Genesis_Featured_Post' );
    unregister_widget( 'Genesis_Latest_Tweets_Widget' );
}

function authoritydevbase_widgets_init() {
	genesis_register_sidebar( array(
		'id'			=> 'home-featured-full',
		'name'			=> __( 'Home Featured Full', 'authoritydevbase' ),
		'description'	=> __( 'This is the featured section if you want full width.', 'authoritydevbase' ),
	) );
	genesis_register_sidebar( array(
		'id'			=> 'home-featured-left',
		'name'			=> __( 'Home Featured Left', 'authoritydevbase' ),
		'description'	=> __( 'This is the featured section left side.', 'authoritydevbase' ),
	) );
	genesis_register_sidebar( array(
		'id'			=> 'home-featured-right',
		'name'			=> __( 'Home Featured Right', 'authoritydevbase' ),
		'description'	=> __( 'This is the featured section right side.', 'authoritydevbase' ),
	) );
	genesis_register_sidebar( array(
		'id'			=> 'home-middle-1',
		'name'			=> __( 'Home Middle 1', 'authoritydevbase' ),
		'description'	=> __( 'This is the home middle left section.', 'authoritydevbase' ),
	) );
	genesis_register_sidebar( array(
		'id'			=> 'home-middle-2',
		'name'			=> __( 'Home Middle 2', 'authoritydevbase' ),
		'description'	=> __( 'This is the home middle center section.', 'authoritydevbase' ),
	) );
	genesis_register_sidebar( array(
		'id'			=> 'home-middle-3',
		'name'			=> __( 'Home Middle 3', 'authoritydevbase' ),
		'description'	=> __( 'This is the home middle right section.', 'authoritydevbase' ),
	) );
	genesis_register_sidebar( array(
		'id'			=> 'home-bottom',
		'name'			=> __( 'Home Bottom', 'authoritydevbase' ),
		'description'	=> __( 'This is the home bottom section.', 'authoritydevbase' ),
	) );
}
	
/**
* Don't Update Theme
* If there is a theme in the repo with the same name,
* this prevents WP from prompting an update.
*
* @link http://markjaquith.wordpress.com/2009/12/14/excluding-your-plugin-or-theme-from-update-checks/
* @author Mark Jaquith
* @since 1.0.0
*/
function authoritydevbase_prevent_theme_update( $r, $url ) {
if ( 0 !== strpos( $url, 'http://api.wordpress.org/themes/update-check' ) )
return $r; // Not a theme update request. Bail immediately.
$themes = unserialize( $r['body']['themes'] );
unset( $themes[ get_option( 'template' ) ] );
unset( $themes[ get_option( 'stylesheet' ) ] );
$r['body']['themes'] = serialize( $themes );
return $r;
}
?>