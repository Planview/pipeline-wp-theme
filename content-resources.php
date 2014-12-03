<?php 
/**
 * The content for the resources page
 */

if ( is_post_type_archive( 'resources' ) ) :
?>
<li>
	<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( get_the_excerpt() ); ?>"<?php echo ( 'video' !== get_field('pv_event_resource_doc_type') ? ' target="_blank"' : '' ) ?>>
		<span class="fa <?php echo pipeline_resource_icon_class( get_field( 'pv_event_resource_doc_type' ) ); ?>"></span> <?php the_title(); ?>
	</a>
</li>
<?php elseif ( is_single() ) : ?>
<article id="resources-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php if ( get_field('pv_event_subtitle') ) printf( '<h2 class="subtitle">%s</h2>' ) ?>
	</header><!-- .entry-header -->

	<div class="entry-content">

		<?php if ( is_user_logged_in() ) : ?>
			<div class="video-page-wrapper">
				<div class="limelight-video-respond resources-video"<?php echo ( ( $pipeline_vid_controls_height = get_field( 'pv_event_vid_controls_height' ) ) ? ' data-controls-height="' . $pipeline_vid_controls_height . '"' : '' ) ?><?php echo ( ( $pipeline_vid_controls_width = get_field( 'pv_event_vid_controls_width' ) ) ? ' data-controls-width="' . $pipeline_vid_controls_width . '"' : '' ) ?>>
					<?php the_field( 'pv_event_resource_video_code' ); ?>
				</div>
			</div>
			<div class="resources-content">
				<?php the_content(); ?>
			</div>
		<?php else: ?>
			<?php get_template_part( 'content', 'login' ); ?>
		<?php endif; //User logged in ?>

	</div><!-- .entry-content -->
</article><!-- #post-## -->

<?php endif; ?>