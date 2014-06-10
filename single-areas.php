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

            <?php get_template_part( 'content', 'areas' ); ?>

            <?php
            // If comments are open or we have at least one comment, load up the comment template
            if ( comments_open() || '0' != get_comments_number() ) :
                comments_template();
            endif;
            ?>

        <?php endwhile; // end of the loop. ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>