<?php 
/**
  * This is the template for the presentations
  * listing/agenda page
  */

get_header(); ?>
 <div id="primary" class="content-area full-width">
    <main id="main" class="site-main" role="main">
    	<article id="resources-archive">
			<header class="entry-header">
				<h1 class="entry-title"><?php the_field( 'pv_event_resources_archive_title', 'option' ); ?></h1>
			</header><!-- .entry-header -->

			<?php if ( is_user_logged_in() ) : ?>
				<div class="page-content">
					<div class="page-intro">
						<?php the_field('pv_event_resources_archive_intro', 'option'); ?>
					</div>
					<div class="resources-listing">
						<?php $pipeline_resources_posts = pipeline_resources_sort(); ?>
						<?php if ( ! empty( $pipeline_resources_posts ) ) : $pipeline_section_count = 0 ?>
							<?php foreach ( $pipeline_resources_posts as $section_title => $section ) : ?>
								<?php echo ( 0 == ($pipeline_section_count % 2) ? '<div class="row">' : '' ); ?>
									<div class="col-sm-6">
										<div class="panel resources-panel">
											<div class="panel-heading">
												<h2 class="h4" style="margin-top: 0; margin-bottom: 0;"><?php echo $section_title ?></h2>
											</div>
											<div class="panel-body">
												<?php foreach ( $section as $subsection_title => $subsection ) : ?>
													<h3 class="resources-type-heading"><?php echo $subsection_title ?></h3>
													<ul class="list-unstyled">
														<?php foreach ( $subsection as $post ) : setup_postdata( $post ); ?>
															<?php get_template_part( 'content', 'resources' ); ?>
														<?php endforeach; ?>
													</ul>
												<?php endforeach; ?>
											</div>
										</div>
									</div>
								<?php echo ( 1 == ($pipeline_section_count % 2) ? '</div>' : '' ); ?>
								<?php $pipeline_section_count += 1; ?>
							<?php endforeach; ?>
						<?php endif; wp_reset_postdata(); ?>					
					</div>
				</div>
			<?php endif; ?>
		</article><!-- #post-## -->
    </main><!-- #main -->
</div><!-- #primary -->
<?php get_footer(); 