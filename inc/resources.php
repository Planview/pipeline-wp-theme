<?php 
/**
 * Functionality for the `resources` post type
 */

/**
 * Return a Font-awesome class based on resource type
 */
function pipeline_resource_icon_class( $type ) {
	switch ($type) {
		case 'pdf':
			return 'fa-file-pdf-o';
		case 'video':
			return 'fa-film';
		case 'slideshare':
			return 'fa-bar-chart-o';
		default:
			return 'fa-external-link';
	}
}


/**
 * Filter the Query so that we get all the resources back
 */
function pipeline_resources_pre_get_posts( $query ) {
	if ( is_admin() || ! $query->is_main_query() || ! is_post_type_archive( 'resources' ) )
		return;

	$query->set('posts_per_page', -1);
	$query->set('orderby', 'name');
	$query->set('order', 'ASC');
}
add_action('pre_get_posts', 'pipeline_resources_pre_get_posts');

/**
 * A function to re-sort the library
 */
function pipeline_resources_sort() {
	$sorted_list = array();

	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();

			$topic = get_field( 'pv_event_resource_topic' );
			$type = get_field( 'pv_event_resource_type' );

			$topic = reset($topic);
			$type = reset($type);

			if ( ! isset( $sorted_list[$topic->name] ) ) {
				$sorted_list[$topic->name] = array();
			}

			if ( ! isset( $sorted_list[$topic->name][$type->name] ) ) {
				$sorted_list[$topic->name][$type->name] = array();
			}

			$sorted_list[$topic->name][$type->name][] = $GLOBALS['post'];
		}
	}

	uksort( $sorted_list, 'pipeline_resources_topics_sort' );
	$sorted_list = array_reverse( $sorted_list );

	foreach ( $sorted_list as $release_name => $release_array ) {
		uksort( $release_array, 'strcasecmp' );
		$sorted_list[$release_name] = $release_array;
	}

	return $sorted_list;
}

/**
 * Sorting funtion for the resources topics
 */
function pipeline_resources_topics_sort( $topic1_name, $topic2_name ) {
	$topic1 = get_term_by( 'name', $topic1_name, 'resource_topic');
	$topic2 = get_term_by( 'name', $topic2_name, 'resource_topic');

	$topic1_order = get_field( 'pv_event_tax_topics_order', 'resource_topic_' . $topic1->term_id );
	$topic2_order = get_field( 'pv_event_tax_topics_order', 'resource_topic_' . $topic2->term_id );

	return $topic2_order - $topic1_order;
}


/**
 * Filter the permalinks for resources
 */
function pipeline_resource_post_link( $permalink, $post ) {
	if ( 'resources' !== $post->post_type )
		return $permalink;

	$type = get_field( 'pv_event_resource_doc_type', $post->ID );

	switch ( $type ) {
		case 'pdf':
			$file = get_field( 'pv_event_resource_file', $post->ID );
			return $file['url'];
		case 'slideshare':
		case 'link':
			return trim( get_field( 'pv_event_resource_url', $post->ID ) );
	}
	return $permalink;
}
add_filter( 'post_type_link', 'pipeline_resource_post_link', 10, 2 );