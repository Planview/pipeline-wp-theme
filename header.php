<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package PIPELINE
 */
?><!DOCTYPE html>
<!--[if lte IE 8]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--><html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
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

        <nav class="navbar navbar-default" role="navigation">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <?php wp_nav_menu(
                        array(
                            'theme_location'    =>  'navbar-left',
                            'fallback_cb'       =>  false,
                            'menu_class'        =>  'nav navbar-nav',
                            'depth'             =>  2,
                            'walker'            =>  new Pipeline_Bootstrap_Nav_Walker()
                        )
                    ); ?>
                    <?php wp_nav_menu(
                        array(
                            'theme_location'    =>  'navbar-right',
                            'fallback_cb'       =>  false,
                            'menu_class'        =>  'nav navbar-nav navbar-right',
                            'depth'             =>  2,
                            'walker'            =>  new Pipeline_Bootstrap_Nav_Walker()
                        )
                    ); ?>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
