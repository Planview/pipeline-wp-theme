<?php 
/**
 * Controls for the Topic Areas
 */

/**
 * Check for contact info
 */
function launch_sponsor_contact_info() {
	return  get_field('pv_event_topic_sponsor_url') ||
			get_field('pv_event_topic_sponsor_email') ||
			get_field('pv_event_topic_sponsor_phone') ||
			get_field('pv_event_topic_sponsor_facebook') ||
			get_field('pv_event_topic_sponsor_twitter');
}

function pipeline_agenda_topics_bool() {
	global $pipeline_agenda_topics_shown;
	$pipeline_agenda_topics_shown = false;
}
add_action( 'init', 'pipeline_agenda_topics_bool' );

function pipeline_agenda_topics_column() {
	global $pipeline_agenda_topics_shown, $posts, $post;
	if ( $pipeline_agenda_topics_shown )
		return;

	$pipeline_agenda_topics_shown = true;

	$colspan = count( $posts );

	$query_args = array(
		'post_type'   => 'areas',
		'order'       => 'ASC',
		'orderby'     => 'menu_order',
		'posts_per_page'	=> -1,			
	);

	$topics_query = new WP_Query( $query_args );
	
	?>
	<td class="agenda-topic-cell" rowspan="<?php echo $colspan; ?>">
		<?php if ( $topics_query->have_posts() ) : ?>
			<div id="accordion" class="panel-group">
				<?php while ( $topics_query->have_posts() ) : $topics_query->the_post(); ?>
					<div class="panel panel-default agenda-topic-panel">
						<div class="panel-heading">
							<h3 class="panel-title">
								<a data-toggle="collapse" href="#<?php echo $post->post_name ?>">
									<?php the_title(); ?>
								</a>
							</h3>
						</div>
						<div id="<?php echo $post->post_name ?>" class="panel-collapse collapse">
							<div class="panel-body">
								<p><?php the_excerpt(); ?></p>
								<?php if ( is_user_logged_in() ) : ?>
									<p>
										<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" class="btn btn-info btn-block"><?php _e( 'Visit Topic Area', 'pipeline' ); ?></a>
									</p>
								<?php endif; ?>
							</div>
						</div>
					</div>
				<?php endwhile; ?>
			</div>
		<?php endif; ?>
	</td>
	<?php
	wp_reset_postdata();
}

function pipeline_topics_pre_get_posts( $query ) {
	if ( is_admin() || ! is_post_type_archive( 'areas' ) )
		return;

	$query->set( 'orderby', 'menu_order' );
	$query->set( 'order', 'ASC' );
}
add_action( 'pre_get_posts', 'pipeline_topics_pre_get_posts' );