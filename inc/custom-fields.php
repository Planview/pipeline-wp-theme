<?php
/**
 * Created by PhpStorm.
 * User: scrockett
 * Date: 3/25/14
 * Time: 3:30 PM
 */

if ( ! defined( 'ACF_LITE' ) ) define( 'ACF_LITE' , true );

require_once( get_template_directory() . '/vendor/advanced-custom-fields/acf.php' );
if ( ! function_exists( 'acf_set_options_page_title' ) )
	require_once( get_template_directory() . '/vendor/acf-options-page/acf-options-page.php' );
require_once( get_template_directory() . '/vendor/acf-repeater/acf-repeater.php' );

if( function_exists('acf_add_options_sub_page') )
{
    acf_add_options_sub_page(array(
        'title' => _x('Theme Options', 'Option page title', 'planview'),
        'parent' => 'themes.php',
        'slug' => 'pipeline-theme-options',
        'capability' => 'edit_theme_options'
    ));
}

if(function_exists("register_field_group"))
{
    include_once( get_template_directory() . '/inc/custom-fields/options.php');
    include_once( get_template_directory() . '/inc/custom-fields/front-page.php');
}
