<?php
/**
 * @package Planview Product Launch
 */
?>

<article id="presentations-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php if ( $subtitle = get_field('pv_event_subtitle') ) printf( '<h2 class="subtitle">%s</h2>', $subtitle ) ?>
	</header><!-- .entry-header -->

	<div class="entry-content">

		<?php if ( is_user_logged_in() ) : ?>
			<div class="presentations-area">
				<div class="main-presentation-outer">
					<div class="presentations-video-wrapper limelight-video-respond"<?php echo ( ( $pipeline_vid_controls_height = get_field( 'pv_event_vid_controls_height' ) ) ? ' data-controls-height="' . $pipeline_vid_controls_height . '"' : '' ) ?><?php echo ( ( $pipeline_vid_controls_width = get_field( 'pv_event_vid_controls_width' ) ) ? ' data-controls-width="' . $pipeline_vid_controls_width . '"' : '' ) ?>>
						<?php 	if ( pipeline_presentation_live() ) the_field( 'pv_event_presentation_video');
								elseif ( get_field( 'pv_event_presentation_on_demand_bool' ) || current_user_can( 'edit_posts' ) ) the_field( 'pv_event_presentation_on_demand' ); ?>
					</div>
					<?php if ( pipeline_presentation_live() && $pipeline_question_form = get_field( 'pv_event_presentation_qa_form' ) ) : ?>
						<div class="presentation-question-wrapper">
							<h2 class="presentation-question-title"><?php _ex( 'Submit a Question for Live Q&amp;A', 'Heading', 'pipeline' ); ?></h2>
							<div class="presentation-question-inner">
								<?php gravity_form($pipeline_question_form->id, false, false, false, '', true, 1); ?>
							</div>
						</div>
					<?php endif; ?>
		            <?php
		            // If comments are open or we have at least one comment, load up the comment template
		            if ( comments_open() || '0' != get_comments_number() ) : ?>
		            	<div class="presentations-comments-inner">
		            		<div class="presentations-comments-header">
		            			<h2 class="presentations-comments-title">
		            				<a data-toggle="collapse" href="#comments-panel"><?php _ex( 'Comments', 'Heading', 'pipeline' ); ?></a>
		            			</h2>
		            		</div>
		            		<div class="presentations-comments-body">
		            			<?php if ( '0' != get_comments_number() ) : ?><p><a href="#comment-form" class="scroll-anchor-2 btn btn-block btn-info" data-scroll-parent=".presentations-comments-body"><?php _e('Post Your Comment', 'pipeline'); ?></a></p><?php endif; ?>
		            			<?php comments_template(); ?>
		            		</div>
		            	</div>
		            <?php endif; ?>
				</div>

				<div class="presentations-sidebar">
						<?php the_field( 'pv_event_presentation_sidebar' ); ?>

					<?php if ( have_rows( 'pv_event_speakers' ) ) : $pipeline_count = 0; ?>
						<div class="presentations-rep-inner">
							<div class="presentations-rep-header">
								<h2 class="presentations-rep-title"><?php _ex( 'Presenter', 'Heading', 'pipeline'); ?></h2>
							</div>
							<div class="presentations-rep-body">
							<ul class="media-list">
							<?php while ( have_rows( 'pv_event_speakers' ) ) : the_row(); $pipeline_count += 1; ?>
								<li>
									<div class="media">
										<?php if ( $pipeline_speaker_photo = get_sub_field('photo') ) {
											echo pipeline_acf_image( $pipeline_speaker_photo, 'pull-left media-object', null, 0.83 );
										} ?>
										<div class="media-body">
											<h4 class="media-heading"><?php the_sub_field( 'name' ); ?></h4>
											<h4 class="presentations-rep-job-title"><small><?php the_sub_field( 'title' ); ?></small></h4>
										</div>
									</div>
											<p style="margin-top: 10px;"><button class="btn btn-small btn-default btn-block" data-toggle="collapse" data-target="#bio<?php echo $pipeline_count ?>"><span class="fa fa-info-circle"></span> <?php _ex( 'About the Presenter', 'Toggle Button', 'pipeline' ); ?></button></p>
									<div id="bio<?php echo $pipeline_count; ?>" class="presentation-bio collapse">
										<?php echo pipeline_speaker_info( 'bio' ); ?>
										<?php if ( pipeline_speaker_has_contact_info() ) : ?>
											<h5><?php _e( 'Contact', 'pipeline' ); ?></h5>
											<ul class="list-unstyled">
												<?php if ( pipeline_speaker_info( 'email' ) ) : ?>
													<li>
														<a href="<?php echo antispambot( esc_url( 'mailto:' . pipeline_speaker_info( 'email' ) ) ); ?>">
															<span class="fa fa-envelope-square"></span> <?php echo antispambot( pipeline_speaker_info( 'email' ) ); ?>
														</a>
													</li>
												<?php endif; ?>
												<?php if ( pipeline_speaker_info( 'twitter' ) ) : ?>
													<li>
														<a href="<?php echo esc_url( 'https://twitter.com/' . pipeline_speaker_info( 'twitter' ) ); ?>" target="_blank">
															<span class="fa fa-twitter-square"></span> @<?php echo pipeline_speaker_info( 'twitter' ); ?>
														</a>
													</li>
												<?php endif; ?>
												<?php if ( pipeline_speaker_info( 'web1' ) ) : ?>
													<li>
														<a href="<?php echo esc_url( pipeline_speaker_info( 'web1' ) ); ?>" title="<?php esc_attr( pipeline_speaker_info( 'web1_text' ) ); ?>" target="_blank">
															<span class="fa fa-external-link"></span> <?php echo pipeline_speaker_info( 'web1_text' ); ?>
														</a>
													</li>
												<?php endif; ?>
												<?php if ( pipeline_speaker_info( 'web2' ) ) : ?>
													<li>
														<a href="<?php echo esc_url( pipeline_speaker_info( 'web2' ) ); ?>" title="<?php esc_attr( pipeline_speaker_info( 'web2_text' ) ); ?>" target="_blank">
															<span class="fa fa-external-link"></span> <?php echo pipeline_speaker_info( 'web2_text' ); ?>
														</a>
													</li>
												<?php endif; ?>
											</ul>
										<?php endif; ?>
									</div>
								</li>
							<?php endwhile; ?>
							</ul>
							</div>
						</div>
					<?php endif; ?>
						<?php if ( $pipeline_topic_resources = get_field( 'pv_event_presentation_resources' ) ) : ?>
							<div class="presentations-resources-wrapper">
								<div class="presentations-resources-inner">
									<div class="presentations-resources-header">
										<h2 class="presentations-resources-title"><?php _ex( 'Resources', 'Heading', 'pipeline' ); ?></h2>
									</div>
									<div class="presentations-resources-body">
										<ul class="presentations-resources-list">
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
						<div class="presentations-content-wrapper">
							<div class="presentations-content-inner">
								<div class="presentations-content-header">
									<h2 class="presentations-content-title"><?php _ex( "About This Presentation", 'Heading', 'pipeline') ?></h2>
								</div>
								<div class="presentations-content-body">
									<?php the_content(); ?>
								</div>
							</div>
						</div>

				</div>
			</div>
		<?php else: ?>
			<?php get_template_part( 'content', 'login' ); ?>
		<?php endif; //User logged in ?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
