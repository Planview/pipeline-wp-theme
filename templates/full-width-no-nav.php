<?php 
/**
 * This is a full-width page template that does not include the navbar at the top of the page
 * 
 * Template Name: Full Width (No Navbar)
 */

get_header('no-nav');
 ?>
 <div id="primary" class="content-area full-width">
    <main id="main" class="site-main" role="main">

        <?php while ( have_posts() ) : the_post(); ?>

            <?php get_template_part( 'content', 'page' ); ?>

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
