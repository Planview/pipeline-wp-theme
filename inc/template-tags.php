<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package PIPELINE
 */

if ( ! function_exists( 'pipeline_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @return void
 */
function pipeline_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'launch' ); ?></h1>
		<ul class="nav-links">

			<?php if ( get_previous_posts_link() ) : ?>
			<li class="previous"><?php previous_posts_link( __( '<span class="meta-nav fa fa-chevron-left"></span> Previous Page', 'launch' ) ); ?></li>
			<?php endif; ?>

			<?php if ( get_next_posts_link() ) : ?>
			<li class="next"><?php next_posts_link( __( 'Next Page <span class="meta-nav fa fa-chevron-right"></span>', 'launch' ) ); ?></li>
			<?php endif; ?>

		</ul><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'pipeline_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @return void
 */
function pipeline_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'pipeline' ); ?></h1>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'pipeline' ) );
				next_post_link(     '<div class="nav-next">%link</div>',     _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link',     'pipeline' ) );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'pipeline_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function pipeline_posted_on() {
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	printf( __( '<span class="posted-on">Posted on %1$s</span><span class="byline"> by %2$s</span>', 'pipeline' ),
		sprintf( '<a href="%1$s" rel="bookmark">%2$s</a>',
			esc_url( get_permalink() ),
			$time_string
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		)
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 */
function pipeline_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so pipeline_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so pipeline_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in pipeline_categorized_blog.
 */
function pipeline_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'pipeline_category_transient_flusher' );
add_action( 'save_post',     'pipeline_category_transient_flusher' );

/**
 * Add  polyfills for IE8
 */
function pipeline_polyfill() {
    ?><!--[if lte IE 8]>
    <style>.bg-size{-ms-behavior:url('<?php echo get_template_directory_uri() . '/vendor/background-size-polyfill/backgroundsize.min.htc' ?>')}</style>
    <script src="<?php echo get_template_directory_uri() . '/vendor/respond/dest/respond.min.js' ?>"></script>
<![endif]-->
<?php
}
add_action('wp_head', 'pipeline_polyfill',20);

/**
 * Conditional Tag for gt IE8 on our style
 */
function pipeline_ie_style_conditional($output, $handle) {
    if ( $handle !== 'pipeline-style' && $handle !== 'pipeline-style-blessed1' && $handle !== 'pipeline-style-blessed2' && $handle !== 'pipeline-style-blessed3' ) return $output;

    return "<!--[if gt IE 8]><!-->\n" . $output . "<!--<![endif]-->\n";
}
add_filter( 'style_loader_tag', 'pipeline_ie_style_conditional', 10, 2 );

/**
 * Adds a banner image to the homepage
 *
 * @param $post_id
 */
function pipeline_banner_image( $post_id ) {
    if ( !is_page() || !is_front_page() ) return;
    if ( has_post_thumbnail( $post_id ) ) {
        the_post_thumbnail('full', array('class' => 'aligncenter img-responsive center-block hidden-xs'));
    }
}
add_action( 'pipeline_above_content_header', 'pipeline_banner_image', 10, 1 );
