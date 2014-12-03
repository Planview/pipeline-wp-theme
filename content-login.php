<?php 
/**
 * Displays a message asking the user to login to view the information.
 */
global $post;
$pipeline_current_link = home_url( '/' );;
if ( is_single() ) {
	$pipeline_current_link = get_permalink();
} elseif ( is_post_type_archive() ) {
	$pipeline_current_link = get_post_type_archive_link( $post->post_type );
} elseif ( is_search() ) {
	$pipeline_current_link = get_search_link();
}

 ?>

 <div class="login-message">
 <p class="lead"><?php _e('To view this page you must be logged in to PIPELINE.') ?></p>
 <p>
 	<?php if ( $post = get_field( 'pipeline_registration_page', 'option' ) ) : setup_postdata( $post ); ?><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="btn btn-lg btn-success"><?php _e( 'Register Now', 'pipeline' ); ?></a><?php endif; wp_reset_postdata(); ?>
 	<a href="<?php echo wp_login_url( $pipeline_current_link ); ?>" title="Log In" class="btn btn-lg btn-orange"><?php _e( 'Log In', 'pipeline' ); ?></a>
 </p>
 </div>