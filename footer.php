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
		<div class="site-info">
			<?php printf( __( 'Copyright &copy; %s PIPELINE Conference. All rights reserved.', 'pipeline' ), date('Y') ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
