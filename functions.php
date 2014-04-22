<?php
/**
 * PIPELINE functions and definitions
 *
 * @package PIPELINE
 */


/**
 * Set up the theme info to use for stuff
 */
function pipeline_theme_info() {
    global $pipeline_theme_info;
    $pipeline_theme_info = wp_get_theme();
}
add_action('init', 'pipeline_theme_info');

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'pipeline_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function pipeline_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on PIPELINE, use a find and replace
	 * to change 'pipeline' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'pipeline', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'navbar-left' => __( 'Navbar Menu &ndash; Left Side', 'pipeline' ),
        'navbar-right' => __( 'Navbar Menu &ndash; Right Side', 'pipeline' ),
        'navbar-front' => __( 'Navbar Menu &ndash; Front Page Only (Right)', 'pipeline' ),
        'footer-links' => __( 'Links in the Footer Above Copyright', 'pipeline' ),
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'pipeline_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form',
		'gallery',
	) );
}
endif; // pipeline_setup
add_action( 'after_setup_theme', 'pipeline_setup' );

/**
 * Enqueue scripts and styles.
 */
function pipeline_scripts() {
    global $pipeline_theme_info, $wp_styles;

	if ( is_admin() ) wp_enqueue_style( 'pipeline-style', get_stylesheet_uri() );

    if ( !is_admin() ) {
        wp_enqueue_style( 'pipeline-style', get_stylesheet_directory_uri() . '/css/style.css' );
        wp_enqueue_style( 'pipeline-style-ie8', get_stylesheet_directory_uri() . '/css/ie8.css' );
        $wp_styles->add_data( 'pipeline-style-ie8', 'conditional', 'lte IE 8' );
    }

    wp_enqueue_script('modernizr', get_template_directory_uri() . '/js/min/modernizr.min.js', array(), '2.7.2', false);
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/min/bootstrap.min.js', array('jquery'), '3.1.1', true);
    wp_register_script('webshim', get_template_directory_uri() . '/vendor/webshim/js-webshim/minified/polyfiller.js', array('modernizr', 'jquery'), '1.12.4', true);
    wp_enqueue_script('pipeline', get_template_directory_uri() . '/js/min/pipeline.min.js', array('modernizr', 'jquery', 'webshim', 'fancybox' ), $pipeline_theme_info->get( 'Version' ), true );
    wp_enqueue_script( 'fancybox', get_template_directory_uri() . 'vendor/fancybox/source/jquery.fancybox.pack.js', array( 'jquery' ), '2.1.5', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'pipeline_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Widget settings for this theme.
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom nav walkers for this theme.
 */
require get_template_directory() . '/inc/nav-walker-bootstrap.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load Custom Fields
 */
require get_template_directory() . '/inc/custom-fields.php';

/**
 * Load Custom Fields for Nav Menu
 */
require get_template_directory() . '/inc/nav-custom-fields.php';
