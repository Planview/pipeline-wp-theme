<?php 
/**
 * Some functions for comments
 */

function pipeline_script_page_info() {
	if ( ! is_single() ) return;

	global $post;

	$pipeline_data = array(
		'ajaxUrl' => admin_url( 'admin-ajax.php' ),
		'post_id' => $post->ID,
		'post_type' => $post->post_type,
	);

	wp_localize_script( 'pipeline', 'pipeline', $pipeline_data );
}
add_action('wp_head', 'pipeline_script_page_info', 20);

function pipeline_ajax_comments_paging() {
	if ( ! isset( $_POST['post_id'] ) || ! isset( $_POST['comment_page'] ) ||
		! isset( $_POST['post_type'] ) ) die();

	global $wp_post_types;

	$post_id = intval( $_POST['post_id'] );
	$comment_page = intval( $_POST['comment_page'] );
	$post_type = $_POST['post_type'];

	if ( ! $post_id || ! $comment_page || ! isset( $wp_post_types[ $post_type ] ) )
		die();

	query_posts( "p={$post_id}&post_type={$post_type}&cpage={$comment_page}" );

	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();
			comments_template();
		}
	}

	die();
}
add_action( 'wp_ajax_pipeline_comment_paging', 'pipeline_ajax_comments_paging' );