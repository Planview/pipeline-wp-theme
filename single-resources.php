<?php 
/**
 * This is a full-width template for videos
 */

// Redirect types that don't have single views

switch ( get_field( 'pv_event_resource_doc_type', $post->ID ) ) {
    case 'pdf':
        $file = get_field( 'pv_event_resource_file', $post->ID );
        wp_redirect( $file['url'] );
        break;
    case 'slideshare':
    case 'link':
        wp_redirect( trim( get_field( 'pv_event_resource_url', $post->ID ) ) );
        break;
}

get_header(); ?>

 <div id="primary" class="content-area full-width">
    <main id="main" class="site-main" role="main">

        <?php while ( have_posts() ) : the_post(); ?>

            <?php get_template_part( 'content', 'resources' ); ?>

        <?php endwhile; // end of the loop. ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); 
