<?php 

function authoritydevbase_post_date_shortcode( $atts ) {
global $post;
	$defaults = array(
		'after'  => '',
		'before' => '',
		'format' => 'relative',
		'label'  => '',
	);

	$atts = shortcode_atts( $defaults, $atts, 'custom_post_time' );

	$month =  sprintf ('<span %s>', genesis_attr('date-month')) .get_the_time('M', $post->ID).'</span>';
	$day =  sprintf ('<span %s>', genesis_attr('date-day')) .get_the_time('j', $post->ID).'</span>';
	$year =  sprintf ('<span %s>', genesis_attr('date-year')) .get_the_time('Y', $post->ID).'</span>';
	$display = $month.' '.$day.' '.$year;
	$output = sprintf( '<time %s>', genesis_attr( 'entry-time' ) ) . $atts['before'] . $atts['label'] . $display . $atts['after'] . '</time>';
	
	return apply_filters( 'authoritydevbase_post_date_shortcode', $output, $atts );
}

add_shortcode( 'format_post_time', 'authoritydevbase_post_date_shortcode' );

?>