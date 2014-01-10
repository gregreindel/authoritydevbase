/**
 * Theme Customizer 
 */

( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );
	
	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			//alert(to);
			if ( 'blank' === to ) {
				$( '.site-title, .site-description, .site-title a' ).css('color', '' );
			} else {
				$( '.site-title, .site-description, .site-title a' ).css('color', to );
			}
		} );
	} );

	// Header text scolor.
	wp.customize( 'authoritydevbase_options.site_header_background_color', function( value ) {
		value.bind( function( to ) {
			alert(to);
			if ( 'blank' === to ) {
				$( '.site-header' ).css('color', '' );
			} else {
				$( '.site-header' ).css('color', to );
			}
		} );
	} );
	

} )( jQuery );
