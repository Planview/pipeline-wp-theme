<?php
/**
 * Created by PhpStorm.
 * User: scrockett
 * Date: 3/24/14
 * Time: 11:51 AM
 *
 * Template Name: Front Page
 */

get_header( 'head' ); ?>
    <?php
    /*
     * Navbar
     */
    ?>
    <div class="navbar-wrapper">
        <div class="container">
            <nav class="navbar navbar-default" role="navigation">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only"><?php _e( 'Toggle navigation', 'pipeline' ); ?></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <?php wp_nav_menu(
                            array(
                                'theme_location'    =>  'navbar-front',
                                'fallback_cb'       =>  false,
                                'menu_class'        =>  'nav navbar-nav navbar-right',
                                'depth'             =>  2,
                                'walker'            =>  new Pipeline_Bootstrap_Nav_Walker(),
                                'container'         =>  false,
                            )
                        ); ?>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
        </div>
    </div>

    <?php
    /*
     * Carousel
     */
    if ( have_rows( 'front_carousel' ) ) :
        $pipeline_carousel_slides = get_field( 'front_carousel' );
    ?>
    <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="12000">
        <ol class="carousel-indicators">
            <?php for ( $i = 0, $ii = count($pipeline_carousel_slides); $i < $ii; $i += 1 ) : ?>
                <li data-target="#myCarousel" data-slide-to="0" <?php echo (0 == $i ? 'class="active"' : ''); ?>></li>
            <?php endfor; ?>
        </ol>

        <?php $pipeline_carousel_slide_count = 0; ?>
        <div class="carousel-inner">
            <?php while ( have_rows('front_carousel') ) : the_row(); ?>
                <div class="item <?php echo ( 0 === $pipeline_carousel_slide_count ? 'active' : '' ); $pipeline_carousel_slide_count += 1; ?>">
                    <?php $pipeline_carousel_image = get_sub_field('carousel_image'); ?>
                    <div class="carousel-image bg-size <?php the_sub_field( 'carousel_image_position' ); ?>" style="background-image:url(<?php echo esc_url( $pipeline_carousel_image['url'] ); ?>)"></div>
                    <div class="container">
                        <div class="carousel-caption"><?php the_sub_field('carousel_caption'); ?></div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="icon-next"></span>
        </a>
    </div>
    <?php endif; /* Carousel */ ?>

    <div class="home-wrapper">
        <div class="container marketing">
            <?php
            /*
             * Front Page Columns
             */
            if ( have_rows( 'front_columns' ) ) :
            ?>
                <div class="row">
                    <?php while ( have_rows( 'front_columns' ) ) : the_row(); ?>
                        <div class="mini-item text-center">
                            <?php the_sub_field( 'columns_content' ); ?>
                        </div>
                    <?php endwhile; ?>
                </div><!-- /.row -->
            <?php endif; ?>

            <hr class="featurette-divider">

            <?php
            /*
             * Featurettes
             */
            if ( have_rows( 'front_featurettes' ) ) :
                $pipeline_featurette_count = 0;
                while ( have_rows( 'front_featurettes' ) ) : the_row();
                    $pipeline_featurette_alignment = ( 1 == $pipeline_featurette_count % 2 ? 'image-left' : 'image-right' );
                    $pipeline_featurette_count += 1;
                    $pipeline_featurette_image = get_sub_field( 'featurette_image' );
                    ?>
                    <div class="featurette <?php echo $pipeline_featurette_alignment ?>" id="<?php echo esc_attr( the_sub_field( 'featurette_id' ) ); ?>">
                        <div class="featurette-image-wrap">
                            <?php
                            printf(
                                (
                                    get_sub_field( 'featurette_image_link' ) ?
                                    '<a href="%3$s" class="%4$s"><img class="featurette-image" src="%1$s" alt="%2$s" /></a>' :
                                    '<img class="featurette-image" src="%s" alt="%s" />'
                                ),
                                esc_url( $pipeline_featurette_image['url'] ),
                                esc_attr( $pipeline_featurette_image['alt'] ),
                                esc_url( get_sub_field( 'featurette_image_link_url' ) ),
                                esc_url( get_sub_field( 'featurette_image_link_class' ) )
                            ); ?>
                        </div>
                        <article class="featurette-content">
                            <?php if ( $pipeline_featurette_header_image = get_sub_field( 'featurette_header_image' ) ) {
                                printf(
                                    '<img class="featurette-header-image" src="%1$s" alt="%2$s" />',
                                    esc_url( $pipeline_featurette_header_image['url'] ),
                                    esc_attr( $pipeline_featurette_header_image['alt'] )
                                );
                            } ?>
                            <h2 class="featurette-heading"><?php the_sub_field('featurette_title'); ?></h2>
                            <?php the_sub_field('featurette_content'); ?>
                        </article>
                    </div>

                    <hr class="featurette-divider">
                <?php endwhile;
            endif; ?>

            <div class="container" style="margin-bottom:80px">
                <?php the_field( 'front_below' ); ?>
            </div>

            <?php if ( get_field( 'float_tab_title' ) ) : ?>
                <div class="fixed-link">
                    <a href="<?php echo esc_url( get_field( 'float_tab_link_url' ) ); ?>" class="scroll-anchor"><?php the_field( 'float_tab_title' ); ?></a>
                </div>
            <?php endif; ?>

            <footer id="colophon" class="site-footer" role="contentinfo">
                <div class="sponsors">
                    <?php the_field('pipeline_footer_content', 'option'); ?>
                </div>
                <?php wp_nav_menu( array(
                    'theme_location'    =>  'footer-links',
                    'fallback_cb'       =>  false,
                    'container'         =>  'nav',
                    'menu_class'        =>  'list-inline',
                    'menu_id'           =>  'footer-links',
                    'depth'             =>  -1,
                ) ); ?>
                <div class="site-info">
                    <?php printf( __( 'Copyright &copy; %s PIPELINE Conference. All rights reserved.', 'pipeline' ), date('Y') ); ?>
                </div><!-- .site-info -->
            </footer><!-- #colophon -->
        </div><!-- .marketing -->
    </div><!-- .home-wrapper -->

    <?php wp_footer(); ?>
</body>
</html>