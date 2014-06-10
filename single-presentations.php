<?php
/**
 * The template for displaying a single-column page.
 *
 * Template Name: Full-Width Page
 *
 * @package PIPELINE
 */

get_header(); ?>

<div id="primary" class="content-area full-width">
    <main id="main" class="site-main" role="main">

        <?php while ( have_posts() ) : the_post(); ?>

            <?php get_template_part( 'content', 'presentations-single' ); ?>

        <?php endwhile; // end of the loop. ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>