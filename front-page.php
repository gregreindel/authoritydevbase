<?php

add_action( 'genesis_meta', 'authoritydevbase_home_widget_test' );

// Add widgets to homepage. If no widgets, then loop.
function authoritydevbase_home_widget_test() {
	
	if ( (get_option( 'show_on_front' ) == 'posts') && ( is_active_sidebar( 'home-featured-full' ) || is_active_sidebar( 'home-featured-left' ) || is_active_sidebar( 'home-featured-right' ) || is_active_sidebar( 'home-middle-1' ) || is_active_sidebar( 'home-middle-2' ) || is_active_sidebar( 'home-middle-3' ) || is_active_sidebar( 'home-bottom' ) ) ){

		remove_action( 'genesis_loop', 'genesis_do_loop' );
		add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );
		add_action( 'genesis_before_loop', 'authoritydevbase_home_do_featured' );		
		add_action( 'genesis_before_loop', 'authoritydevbase_home_do_middle' );
		add_action( 'genesis_before_loop', 'authoritydevbase_home_do_bottom' );
	}
}

// Home feature widget section
function authoritydevbase_home_do_featured() {

	if ( is_active_sidebar( 'home-featured-full' ) ) {

		printf( '<section id="%s" %s>', sanitize_html_class('home-featured-wrapper'), genesis_attr('clearfix') );
		genesis_structural_wrap( 'home-featured-wrapper' );
	
			genesis_widget_area( 'home-featured-full', array(
				'before' => '<main class="home-featured-full">',
				'after' => '</main>',

			) );
			
		genesis_structural_wrap( 'home-featured-wrapper', 'close' );
		echo '</section><!-- end home-featured-wrapper -->'."\n";
	}
	
	if ( is_active_sidebar( 'home-featured-left' ) || is_active_sidebar( 'home-featured-right' ) ) {	
	
		printf( '<section id="%s" %s>', sanitize_html_class('home-featured-halves'), genesis_attr('clearfix') );
		genesis_structural_wrap( 'home-featured-halves' );
			
			genesis_widget_area( 'home-featured-left', array(
				'before' => '<aside class="home-featured-left one-half first">',
				'after' => '</aside>',
			) );
			
			genesis_widget_area( 'home-featured-right', array(
				'before' => '<aside class="home-featured-right one-half">',
				'after' => '</aside>',
			) );
			
		genesis_structural_wrap( 'home-featured-halves', 'close' );
		echo '</section><!-- end home-featured-halves -->'."\n";
	}	
}


// Home middle widget section
function authoritydevbase_home_do_middle() {

	if ( is_active_sidebar( 'home-middle-1' ) || is_active_sidebar( 'home-middle-2' ) || is_active_sidebar( 'home-middle-3' )  ) {								

		printf( '<section id="%s" %s>', sanitize_html_class('home-middle'), genesis_attr('clearfix') );
		genesis_structural_wrap( 'home-middle' );

			genesis_widget_area( 'home-middle-1', array(
				'before' => '<aside class="home-middle-1 widget-area one-third first">',
				'after' => '</aside>',
			) );
			
			genesis_widget_area( 'home-middle-2', array(
				'before' => '<aside class="home-middle-2 widget-area one-third">',
				'after' => '</aside>',
			) );
			genesis_widget_area( 'home-middle-3', array(
				'before' => '<aside class="home-middle-3 widget-area one-third">',
				'after' => '</aside>',

			) );									
		
		genesis_structural_wrap( 'home-middle', 'close' );
		echo '</section><!-- end home-middle -->'."\n";		
	}		
}


// Home bottom widget section
function authoritydevbase_home_do_bottom() {

	if ( is_active_sidebar( 'home-bottom' ) ) {								
	
		printf( '<section id="%s" %s>', sanitize_html_class('home-bottom'), genesis_attr('clearfix') );
		genesis_structural_wrap( 'home-bottom' );
			
			genesis_widget_area( 'home-bottom', array(
				'before' => '<aside class="home-bottom">',
				'after' => '</aside>',
			) );
		
		genesis_structural_wrap( 'home-bottom', 'close' );
		echo '</section><!-- end home-bottom -->'."\n";	
	}
}

// Go time
genesis();