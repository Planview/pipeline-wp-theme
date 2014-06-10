<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package PIPELINE
 */
?>

	</div><!-- #content -->
    <?php if ( is_user_logged_in() && get_field( 'pipeline_survey_url', 'option' ) ) : ?>
    <div class="survey-link-wrapper">
        <?php printf(
            '<a href="%1$s" class="survey-link%3$s"%4$s><span class="text-hide">%5$s</span></a>',
            esc_url( get_field( 'pipeline_survey_url', 'option' ) ),
            null,
            ( get_field( 'pipeline_survey_class', 'option' ) ? ' ' . esc_attr( 'pipeline_survey_class', 'option' ) : '' ),
            ( get_field( 'pipeline_survey_target', 'option' ) ? ' target="_blank"' : '' ),
            get_field( 'pipeline_survey_text', 'option' )
        ); ?>
    </div>
    <?php endif; ?>
    <?php if ( ! is_user_logged_in() ) : ?>
    <div class="follow-menu-wrapper hidden-xs">
        <div class="follow-menu-heading">
            <h1 class="follow-menu-title text-hide"><?php _ex( 'Follow', 'Heading') ?></h1>            
        </div>
        <?php    /**
            * Displays a navigation menu
            * @param array $args Arguments
            */
            $follow_menu_args = array(
                'theme_location' => 'follow-links' . ( is_user_logged_in() ? '-logged-in' : '' ),
                'container_class' => 'follow-menu-container',
                'menu_class' => 'lead list-unstyled',
                'fallback_cb' => false,
                'depth' => -1,
                'walker' => new Pipeline_Follow_Nav_Walker()
            );
        
            wp_nav_menu( $follow_menu_args ); ?>
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
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
