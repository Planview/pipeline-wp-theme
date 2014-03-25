<?php
/**
 * Functions, filters and actions pretaining to widget display
 * User: scrockett
 * Date: 3/25/14
 * Time: 9:07 AM
 */

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function pipeline_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Sidebar', 'pipeline' ),
        'id'            => 'sidebar-1',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div></aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2><div class="widget-content">',
    ) );
    register_sidebar( array(
        'name'          => __( 'Front Page Sidebar', 'pipeline' ),
        'id'            => 'front-1',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div></aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2><div class="widget-content">',
    ) );
    register_sidebar( array(
        'name'          => __( 'Header', 'pipeline' ),
        'id'            => 'header-1',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'pipeline_widgets_init' );

/**
 * Filter the widget display content and force a title
 */
function pipeline_widget_display($instance, $widget, $args) {
    if ( $args["id"] == "header-1" ) return $instance;
    if ( !isset($instance["title"]) || !$instance["title"] ) {
        $instance["title"] = $widget->name;
    }

    return $instance;
}
add_filter('widget_display_callback', 'pipeline_widget_display', 20, 3);


//function pipeline_widget_display2($instance, $this, $args) {
//    var_dump($this);
//
//    return $instance;
//}
//add_filter('widget_display_callback', 'pipeline_widget_display2', 40, 3);