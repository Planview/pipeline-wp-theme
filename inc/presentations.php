<?php 
/**
 * Helper functions for the presentations
 */

function pipeline_presentation_time_range( $timezone = null, $twenty_four_hour = true, $post = null ) {
	if ( ! isset( $timezone ) )
		$timezone = "GMT";
	if ( ! isset( $post ) )
		$post = get_the_id();

	$start_time = get_field( 'pv_event_presentation_start_time', $post );
	$end_time = get_field( 'pv_event_presentation_end_time', $post );

	$timezone_object = new DateTimeZone( $timezone );
	$start_time_object = new DateTime( '@' . $start_time );
	$end_time_object = new DateTime( '@' . $end_time );

	$start_time_object->setTimezone( $timezone_object );
	$end_time_object->setTimezone( $timezone_object );

	$return_string = '';

	if ( ! $twenty_four_hour && $start_time_object->format( 'a' ) !== $end_time_object->format( 'a' ) ) {
		$return_string .= $start_time_object->format( 'g:i a' );
		$return_string .= ' &ndash; ';
		$return_string .= $end_time_object->format( 'g:i a T' );
	} elseif ( ! $twenty_four_hour ) {
		$return_string .= $start_time_object->format( 'g:i' );
		$return_string .= '&ndash;';
		$return_string .= $end_time_object->format( 'g:i a T' );
	} else {
		$return_string .= $start_time_object->format( 'G:i' );
		$return_string .= '&ndash;';
		$return_string .= $end_time_object->format( 'G:i' );
		$return_string .= ( $timezone === "GMT" ? ' GMT' : $end_time_object->format( ' T' ) );
	}

	return $return_string;
}

function pipeline_time_converter_link( $post = null ) {
	if ( ! $post )
		$post = get_the_id();

	$start_time = get_field( 'pv_event_presentation_start_time', $post );
	$end_time = get_field( 'pv_event_presentation_end_time', $post );

	$timezone_object = new DateTimeZone( 'America/Chicago' );
	$start_time_object = new DateTime( '@' . $start_time );
	$end_time_object = new DateTime( '@' . $end_time );

	$start_time_object->setTimezone( $timezone_object );
	$end_time_object->setTimezone( $timezone_object );

	$hours_difference = intval( $end_time_object->format( 'G' ) ) -
		intval( $start_time_object->format( 'G' ) );
	$minutes_difference = intval( $end_time_object->format( 'i' ), 10 ) -
		intval( $start_time_object->format( 'i' ), 10 );

	if ( $minutes_difference < 0 ) {
		$minutes_difference += 60;
		$hours_difference -= 1;
	}
	if ( $hours_difference < 0 ) {
		$hours_difference += 24;
	}

	return sprintf(
		'http://www.timeanddate.com/worldclock/fixedtime.html?msg=PIPELINE+Conference&amp;iso=%s&amp;p1=24%s%s',
		$start_time_object->format('Ymd\THi'),
		( $hours_difference ? '&amp;ah=' . $hours_difference : '' ),
		( $minutes_difference ? '&amp;am=' . $minutes_difference : '' )
	);
}

function pipeline_presentation_label_class() {
	switch ( get_field( 'pv_event_presentation_type' ) ) {
		case 'Practioner':
			return 'label-info';
		case 'Keynote':
			return 'label-danger';
	}
}

function pipeline_speaker_info( $field, $post = null ) {
	if ( ! $post )
		$post = get_the_id();

	$speakers = get_field( 'pv_event_speakers', $post );
	if ( ! $speakers || empty( $speakers ) )
		return false;

	$speaker = $speakers[0];

	if ( ! isset( $speaker[ $field ] ) )
		return false;

	return $speaker[ $field ];
}

function pipeline_acf_image( $image_object, $class = '', $size = null, $ratio = 1 ) {
	$url = $image_object['url'];
	$alt = $image_object['alt'];
	$height = $image_object['height'];
	$width = $image_object['width'];

	if ( $size ) {
		$url = $image_object['sizes'][$size];
		$height = $image_object['sizes']["{$size}-height"];
		$width = $image_object['sizes']["{$size}-width"];
	}

	return sprintf(
		'<img src="%s" alt="%s" height="%s" width="%s"%s>',
		esc_url( $url ),
		esc_attr( $alt ),
		esc_attr( round( $height * $ratio ) ),
		esc_attr( round( $width * $ratio ) ),
		( $class ? ' class="' . esc_attr( $class ) . '"' : '' )
	);
}

function pipeline_speaker_has_contact_info() {
	return 	pipeline_speaker_info( 'email' ) ||
			pipeline_speaker_info( 'web1' ) ||
			pipeline_speaker_info( 'web2' ) ||
			pipeline_speaker_info( 'twitter' );
}

function pipeline_presentations_archive_query( $query ) {
	if ( ! is_post_type_archive( 'presentations' ) || ! $query->is_main_query() )
		return;

	$query->set( 'posts_per_page', -1 );
	$query->set( 'order', 'ASC' );
	$query->set( 'orderby', 'meta_value_num' );
	$query->set( 'meta_key', 'pv_event_presentation_start_time' );

	return;
}
add_action( 'pre_get_posts', 'pipeline_presentations_archive_query' );

function pipeline_presentation_live( $post = null ) {
	if ( ! $post )
		$post = get_the_id();

	$open_time_offset = 10 * 60; // 15 minutes in seconds
	$end_time_offset = 5 * 60; // 15 minutes in seconds

	$time_now = time();
	$start_time = get_field( 'pv_event_presentation_start_time', $post ) - $open_time_offset;
	$end_time = get_field( 'pv_event_presentation_end_time', $post ) + $end_time_offset;

	return ( $time_now < $end_time && $time_now > $start_time );
}

function pipeline_presentation_status_class( $post = null ) {
	if ( ! $post )
		$post = get_the_id();


	if ( pipeline_presentation_live() )
		return 'presentation-live';
	if ( get_field( 'pv_event_presentation_on_demand_bool' ) )
		return 'presentation-on-demand';
	if ( get_field( 'pv_event_presentation_start_time') > time() )
		return 'presentation-upcoming';

	return 'presentation-complete';
}

function pipeline_get_next_presentation( $time = null, $live_now = false, $post_id = null ) {
	global $post;

	if ( ! $post_id && ! $time )
		$post_id = get_the_id();

	if ( ! $time )
		$time = get_field( 'pv_event_presentation_start_time', $post_id );

	if ( $live_now ) {
		$meta_query = array(
			array(
				'key' => 'pv_event_presentation_start_time',
				'value' => $time + 15 * 60,
				'compare' => '<=',
				'type' => 'NUMERIC'
			),
			array(
				'key' => 'pv_event_presentation_end_time',
				'value' => $time,
				'compare' => '>',
				'type' => 'NUMERIC'
			),
			'relation' => 'AND'
		);
	} else {
		$meta_query = array(
			array(
				'key' => 'pv_event_presentation_start_time',
				'value' => $time,
				'compare' => '>',
				'type' => 'NUMERIC'
			)
		);
	}

	$query = new WP_Query(array(
		'post_type' => 'presentations',
		'meta_query' => $meta_query,
		'meta_key' => 'pv_event_presentation_start_time',
		'orderby' => 'meta_value_num',
		'order' => 'ASC',
		'posts_per_page' => 1
	));

	if ( $query->have_posts() ) {
			return $query->post;
	}

	return false;
}

function pipeline_presentation_redirect() {
	global $post;
	if ( ! is_single() || $post->post_type !== 'presentations' 
		|| current_user_can( 'edit_posts' ) ) return;

	if ( pipeline_presentation_live( $post->ID ) ||
		get_field( 'pv_event_presentation_on_demand_bool', $post->ID ) )
		return;

	$next_presentation = pipeline_get_next_presentation( time(), true );

	if ( false !== $next_presentation )
		wp_safe_redirect( get_permalink( $next_presentation->ID ), 302 );
	else
		wp_safe_redirect( home_url( '?post_type=presentations' ), 302 );
}
add_action( 'template_redirect', 'pipeline_presentation_redirect' );

function pipeline_presentation_script_vars() {
	global $post;
	if ( ! is_single() || $post->post_type !== 'presentations' ||
		get_field( 'pv_event_presentation_on_demand_bool', $post->ID ) || current_user_can( 'edit_posts' ) ) return;

	$next_presentation = pipeline_get_next_presentation();
	$new_url = ( $next_presentation ? get_permalink( $next_presentation->ID ) : home_url( '?post_type=presentations' ) );

	$script_vars = array(
		'presentationEnds' => get_field( 'pv_event_presentation_end_time' ) + 5 * 60,
		'nextPresentation' => $new_url,
		'message' => sprintf(
			__( 'The presentation will be ending soon. You can click <a href="%s">here</a> to go to the ' .
				'next presentation, or you will be automatically redirected in 5 minutes', 'pipeline' ),
			esc_url( $new_url )
		)
	);

	wp_localize_script( 'pipeline', 'pipelinePresentation', $script_vars );
}
add_action( 'wp_head', 'pipeline_presentation_script_vars', 2 );

function pipeline_presentation_type( $post = null ) {
	if ( ! $post )
		$post = get_the_id();

	$type = get_field( 'pv_event_presentation_type', $post );

	$type = preg_replace('/Practioner/i', 'Practitioner', $type);

	return $type;
}