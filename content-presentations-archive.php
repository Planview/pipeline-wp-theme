<?php 
/**
 * Inner content for presentations archive
 */

global $pipeline_show_times;
 ?>


<tr>
	<?php if ( $pipeline_show_times ) : ?>
	<th class="agenda-time-cell" scope="row">
		<?php echo pipeline_presentation_time_range( 'America/Chicago', false ); ?><br />
		<small>
			<a href="<?php echo pipeline_time_converter_link(); ?>" target="_blank">
			(<?php echo pipeline_presentation_time_range(); ?>)
			</a>
		</small><br />
		<span class="label <?php echo pipeline_presentation_label_class(); ?>"><?php echo pipeline_presentation_type(); ?></span>
	</th>
	<?php endif; ?>
	<td class="agenda-presentation-cell <?php echo pipeline_presentation_status_class(); ?>">
		<div class="media">
			<?php echo pipeline_acf_image( pipeline_speaker_info( 'photo' ), 'pull-left media-object' ); ?>
			<div class="media-body">
				<h3 class="media-heading"><?php echo pipeline_speaker_info( 'name' ); ?>
				<small class="agenda-speaker-title"><?php echo pipeline_speaker_info( 'title' ); ?></small></h3>
				<h4><i><?php the_title(); ?></i></h4>
				<?php if ( get_the_content() ) : ?>
					<details>
						<summary><?php _e( 'Abstract', 'pipeline' ); ?></summary>
						<?php the_content(); ?>
					</details>
				<?php endif; ?>
				<?php if ( pipeline_speaker_info( 'bio' ) || pipeline_speaker_has_contact_info() ) : ?>
					<details>
						<summary><?php _e( 'Speaker Bio', 'pipeline' ); ?></summary>
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
					</details>
				<?php endif; ?>
		<?php if ( is_user_logged_in() && pipeline_presentation_live() ) : ?>
			</div>
		</div>
			<p>
				<a href="<?php the_permalink(); ?>" title="<?php esc_attr( get_the_title() ); ?>" class="btn btn-info btn-block view-button"><?php _e( 'Watch Live!', 'pipeline' ); ?></a>
			</p>
		<?php elseif ( ( is_user_logged_in() && get_field( 'pv_event_presentation_on_demand_bool' ) ) || current_user_can( 'edit_posts' ) ) : ?>
			<p style="text-align:center;">
				<a href="<?php the_permalink(); ?>" title="<?php esc_attr( get_the_title() ); ?>" class="btn btn-orange view-button"><?php _e( 'View On-Demand', 'pipeline' ); ?></a>
			</p>
			</div>
		</div>
		<?php endif; ?>
	</td>
</tr>