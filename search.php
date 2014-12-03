<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package PIPELINE
 */

get_header(); ?>

	<section id="primary" class="content-area full-width">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'pipeline' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->
			<?php if ( is_user_logged_in() ) : ?>
			<div class="row">
				<div class="search-results-inner">
					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'content', 'search' ); ?>

					<?php endwhile; ?>
				</div>
			</div>

			<?php pipeline_paging_nav(); ?>
			
			<?php else: ?>
				<?php get_template_part( 'content', 'login' ); ?>
			<?php endif; ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->
<?php get_footer(); ?>
