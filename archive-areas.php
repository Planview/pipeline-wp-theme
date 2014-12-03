<?php 
/**
 * This is the template for listing all of the topic/resource areas
 */

get_header(); ?>

<div id="primary" class="content-area full-width">
    <main id="main" class="site-main" role="main">

            <header class="page-header">
                <h1 class="page-title">
                    <?php if ( get_field( 'pv_event_topics_archive_title', 'option' ) ) {
                            the_field( 'pv_event_topics_archive_title', 'option' );
                        } else {
                            _ex('Topic Areas', 'Page Title', 'launch');
                        } ?>
                </h1>
            </header><!-- .page-header -->
            <div class="page-content">
                <?php if ( is_user_logged_in() ) : ?>
                    <div class="page-intro">
                        <?php the_field('pv_event_topics_archive_intro', 'option'); ?>
                    </div>
                    <?php if ( have_posts() ) : ?>
                        <div class="topic-areas-listing-wrapper">
                            <div class="topic-areas-listing">
                                <?php while ( have_posts() ) : the_post(); ?>
                                    <div class="topic-area">
                                        <div class="topic-area-thumbnail hidden-xs">
                                            <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">
                                            <?php echo get_the_post_thumbnail( get_the_id(), array(100, 100), array( 'class' => 'topic-area-thumbnail-img' ) ); ?>
                                            </a>
                                        </div>
                                        <div class="topic-area-description">
                                            <?php the_excerpt(); ?>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <?php get_template_part( 'content', 'login' ); ?>
                <?php endif; ?>
            </div>

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>