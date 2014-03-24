<?php
/**
 * Created by PhpStorm.
 * User: scrockett
 * Date: 3/24/14
 * Time: 11:51 AM
 */

get_header(); ?>
<?php get_sidebar('front'); ?>
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

            <?php while ( have_posts() ) : the_post(); ?>

                <?php get_template_part( 'content', 'page' ); ?>

            <?php endwhile; // end of the loop. ?>

        </main><!-- #main -->
    </div><!-- #primary -->
<?php get_footer();