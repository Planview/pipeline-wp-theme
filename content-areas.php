<article id="areas-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<div class="row">
			<div class="col-xs-8">
				<div class="title-inner">
				<h1 class="entry-title"><?php the_title(); ?></h1>
				<?php if ( get_field('pv_event_subtitle') ) printf( '<h2 class="subtitle">%s</h2>', get_field( 'pv_event_subtitle' ) ); ?>					
				</div>
			</div>
			<div class="col-xs-4 sponsor-info-header">
				<div class="pull-right">
					<h3 class="sponsored-by"><small>Sponsored By</small></h3>
					<?php $pipeline_sponsor_image = get_field( 'pv_event_topic_sponsor_logo'); ?>
					<img src="<?php echo $pipeline_sponsor_image['sizes']['medium']; ?>" alt="<?php echo esc_attr( $pipeline_sponsor_image['alt'] ); ?>" width="150" height="<?php echo intval($pipeline_sponsor_image['sizes']['medium-height'] * 150 / $pipeline_sponsor_image['sizes']['medium-width']); ?>">
				</div>
			</div>
		</div>
	</header><!-- .entry-header -->

	<div class="entry-content">

		<?php if ( is_user_logged_in() ) : ?>
			<div class="topic-content">
				<?php the_content(); ?>	
			</div>
			<div class="topics-area">

				<div class="main-topic-outer">
					<div class="topics-video-wrapper limelight-video-respond"<?php echo ( ( $pipeline_vid_controls_height = get_field( 'pv_event_vid_controls_height' ) ) ? ' data-controls-height="' . $pipeline_vid_controls_height . '"' : '' ) ?><?php echo ( ( $pipeline_vid_controls_width = get_field( 'pv_event_vid_controls_width' ) ) ? ' data-controls-width="' . $pipeline_vid_controls_width . '"' : '' ) ?>>
						<?php the_field( 'pv_event_topic_playlist'); ?>
					</div>
					<div class="topics-below-video">

						<?php if ( $pipeline_topic_resources = get_field( 'pv_event_presentation_resources' ) ) : ?>
							<div class="topics-resources-wrapper">
								<div class="topics-resources-inner">
									<div class="topics-resources-header">
										<h2 class="topics-resources-title"><?php _ex( 'Resources', 'Heading', 'pipeline' ); ?></h2>
									</div>
									<div class="topics-resources-body">
										<ul class="topics-resources-list">
										<?php foreach ( $pipeline_topic_resources as $post ) : setup_postdata( $post ); ?>
											<li>
												<?php printf(
													'<a href="%1$s" title="%2$s" target="_blank"><span class="fa %4$s"></span> %3$s</a>',
													esc_url( get_permalink() ),
													esc_attr( get_the_excerpt() ),
													get_the_title(),
													pipeline_resource_icon_class( get_field( 'pv_event_resource_doc_type' ) )
												); ?>
											</li>
										<?php endforeach; wp_reset_postdata(); ?>
										</ul>
									</div>
								</div>
							</div>
						<?php endif; ?>
						<div class="topics-sponsor-wrapper<?php echo ( get_field( 'pv_event_presentation_resources' ) ? '' : ' no-resources') ?>">
							<div class="topics-sponsor-inner">
								<div class="topics-sponsor-header">
									<h2 class="topics-sponsor-title"><?php printf( _x( 'About the Sponsor: %s', 'Heading', 'pipeline' ), get_field( 'pv_event_topic_sponsor_name' ) ); ?></h2>
								</div>
								<div class="topics-sponsor-body">
									<?php the_field( 'pv_event_topic_sponsor_desc' ); ?>
									<?php if ( launch_sponsor_contact_info() ) : ?>
										<h4><?php _e( 'Contact Information', 'pipeline' ); ?></h4>
										<ul class="list-unstyled">
											<?php if ( get_field( 'pv_event_topic_sponsor_url' ) ) : ?>
												<li>
													<a href="<?php echo esc_url( get_field( 'pv_event_topic_sponsor_url') ); ?>" title="<?php echo esc_attr( sprintf( '%s Website', get_field('pv_event_topic_sponsor_name') ) ); ?>" target="_blank">
														<span class="fa fa-external-link"></span> <?php printf( '%s Website', get_field('pv_event_topic_sponsor_name') ); ?>
													</a>
												</li>
											<?php endif; ?>
											<?php if ( get_field( 'pv_event_topic_sponsor_email' ) ) : ?>
												<li>
													<a href="<?php echo antispambot( esc_url( 'mailto:' . get_field( 'pv_event_topic_sponsor_email' ) ) ); ?>">
														<span class="fa fa-envelope-square"></span> <?php echo antispambot( get_field( 'pv_event_topic_sponsor_email' ) ); ?>
													</a>
												</li>
											<?php endif; ?>
											<?php if ( get_field( 'pv_event_topic_sponsor_phone' ) ) : ?>
												<li>
													<span class="fa fa-phone-square"></span> <?php the_field( 'pv_event_topic_sponsor_phone' ); ?>
												</li>
											<?php endif; ?>
											<?php if ( get_field( 'pv_event_topic_sponsor_facebook' ) ) : ?>
												<li>
													<a href="<?php echo esc_url( get_field( 'pv_event_topic_sponsor_facebook' ) ); ?>" title="<?php echo esc_attr( sprintf( __( '%s on Facebook', 'pipeline'), get_field( 'pv_event_topic_sponsor_name' ) ) ); ?>">
														<span class="fa fa-facebook-square"></span> <?php printf( __('%s on Facebook', 'pipeline' ), get_field( 'pv_event_topic_sponsor_name' ) ); ?>
													</a>
												</li>
											<?php endif; ?>
											<?php if ( get_field( 'pv_event_topic_sponsor_twitter' ) ) : ?>
												<li>
													<a href="<?php echo esc_url( 'https://twitter.com/' . get_field( 'pv_event_topic_sponsor_twitter' ) ); ?>" title="<?php echo esc_attr( '@' . get_field( 'pv_event_topic_sponsor_twitter' ) ); ?>">
														<span class="fa fa-twitter-square"></span> @<?php the_field( 'pv_event_topic_sponsor_twitter' ); ?>
													</a>
												</li>
											<?php endif; ?>
										</ul>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="chat-wrapper">
					<div class="chat-inner">
						<div class="chat-header">
						<?php if ( have_rows( 'pv_event_speakers' ) ) : $pipeline_count = 0; ?>
							<?php while ( have_rows( 'pv_event_speakers' ) ) : the_row(); ?>
								<div class="media">
									<?php if ( $pipeline_speaker_photo = get_sub_field('photo') ) {
										printf(
											'<img src="%1$s" alt="%2$s" height="%3$s" width="%4$s" class="media-object pull-left img-rounded" />',
											pipeline_maybe_https($pipeline_speaker_photo['sizes']['thumbnail']),
											esc_attr( $pipeline_speaker_photo['alt'] ),
											esc_attr( $pipeline_speaker_photo['sizes']['thumbnail-height'] * 0.33 ),
											esc_attr( $pipeline_speaker_photo['sizes']['thumbnail-width'] * 0.33 )
										);
									} ?>
									<div class="media-body">
										<span class="h4 small topics-rep-tagline"><?php the_sub_field( 'tagline' ); ?></span>
										<h4 class="media-heading"><?php the_sub_field( 'name' ); ?></h4>
										<h4 class="topics-rep-job-title"><small><?php the_sub_field( 'title' ); ?></small></h4>
									</div>
								</div>
							<?php endwhile; ?>
						<?php else : ?>
							<h2 class="chat-title"><?php _ex('Chat', 'Heading', 'pipeline'); ?></h2>
						<?php endif; ?>
						</div>
						<div class="chat-body">
							<?php if ( get_field( 'pv_event_topic_on_demand_bool' ) && $pipeline_question_form = get_field( 'pv_event_topics_qa_form' ) ) : ?>
								<h2 class="topic-question-title"><?php _ex( 'Ask a Question', 'Heading', 'pipeline' ); ?></h2>
								<div class="topic-question-inner">
									<?php gravity_form($pipeline_question_form->id, false, false, false, '', true, 1); ?>
								</div>
							<?php else : ?>
								<?php echo do_shortcode( get_field( 'pv_event_topic_chat' ) ); ?>
							<?php endif; ?>
						</div>
					</div>
					<?php if ( $pipeline_forum = get_field( 'pv_event_topic_forum') ) : $pipeline_forum = reset( $pipeline_forum ); ?>
						<div class="topics-forum-inner">
							<div class="topics-forum-header">
								<h2 class="topics-forum-title"><?php _ex( 'Discussion Boards', 'Heading', 'pipeline' ); ?></h2>
							</div>
							<div class="topics-forum-body">
								<p><?php the_field( 'pv_event_topic_forum_intro' ); ?></p>
								<p>
									<?php printf(
										'<a class="btn btn-info btn-block" href="%s">%s</a>',
										get_permalink( $pipeline_forum ),
										get_field( 'pv_event_topic_forum_link_text' )
									); ?>
								</p>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>
		<?php else: ?>
			<?php get_template_part( 'content', 'login' ); ?>
		<?php endif; //User logged in ?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
