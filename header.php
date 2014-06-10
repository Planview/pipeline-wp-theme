<?php
/**
 * The Header for our theme.
 *
 * Displays from the start of the <body> to <div id="content">, also calls <head> code from header-head.php
 *
 * @package PIPELINE
 */
?>
<?php get_header('head'); ?>
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
                        <span class="sr-only"><?php _e('Toggle navigation', 'pipeline'); ?></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <?php wp_nav_menu(
                        array(
                            'theme_location'    =>  'navbar-left' . ( is_user_logged_in() ? '-logged-in' : '' ),
                            'fallback_cb'       =>  false,
                            'menu_class'        =>  'nav navbar-nav',
                            'depth'             =>  2,
                            'walker'            =>  new Pipeline_Bootstrap_Nav_Walker(),
                            'container'         =>  false,
                        )
                    ); ?>
                    <?php wp_nav_menu(
                        array(
                            'theme_location'    =>  'navbar-right' . ( is_user_logged_in() ? '-logged-in' : '' ),
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
	</header><!-- #masthead -->

	<div id="content" class="site-content">
