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
