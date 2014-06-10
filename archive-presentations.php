<?php 
/**
  * This is the template for the presentations
  * listing/agenda page
  */
global $pipeline_show_times;
$pipeline_show_times = !!pipeline_get_next_presentation( time(), true );

get_header(); ?>
 <div id="primary" class="content-area full-width">
    <main id="main" class="site-main" role="main">
    	<article id="presentations-archive" <?php post_class(); ?>>
			<header class="entry-header">
				<h1 class="entry-title"><?php the_field( 'pv_event_presentations_archive_title', 'option' ); ?></h1>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php if ( have_posts() ) : ?>
					<?php the_field( 'pv_event_presentations_archive_intro', 'options' ); ?>
					<div class="table-responsive">
						<table class="agenda-table">
							<thead>
								<tr class="agenda-heading-row">
									<?php if ( $pipeline_show_times ) : ?>
									<th class="agenda-heading agenda-times" scope="col">
										<span class="fa fa-clock-o fa-3x pull-left"></span><span class="sr-only">Time</span>
									</th>
									<?php endif; ?>
									<th class="agenda-heading agenda-presentations" scope="col">
										<span class="fa fa-certificate fa-3x pull-left"></span><span class="h2">Featured Presentations
										<?php if ( $pipeline_show_times ) : ?><small>Friday, June 6</small>
										<?php else : ?><small>Available On-Demand</small><?php endif; ?></span>
									</th>
								</tr>
							</thead>
							<tbody>
						        <?php while ( have_posts() ) : the_post(); ?>

						            <?php get_template_part( 'content', 'presentations-archive' ); ?>

						        <?php endwhile; // end of the loop. ?>	
							</tbody>
						</table>
					</div>
			    <?php endif; ?>
			</div><!-- .entry-content -->
		</article><!-- #post-## -->

    </main><!-- #main -->
</div><!-- #primary -->
<?php get_footer(); 