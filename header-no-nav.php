<?php
/**
 * The Header for our theme, minus the navbar.
 *
 * Displays from the start of the <body> to <div id="content">, also calls <head> code from header-head.php
 *
 * @package PIPELINE
 */
?>
<?php get_header('head'); ?>
<body <?php body_class('no-nav'); ?>>
<div id="page" class="hfeed site">

	<header id="masthead" class="site-header" role="banner">
        <div class="header-content">
            <div class="site-branding">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><h1 class="site-title bg-size"><?php bloginfo( 'name' ); ?></h1></a>
                <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
            </div>
            <aside class="announcements">
                <?php dynamic_sidebar('header-1'); ?>
            </aside>
        </div>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
