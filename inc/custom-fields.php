<?php
/**
 * Created by PhpStorm.
 * User: scrockett
 * Date: 3/25/14
 * Time: 3:30 PM
 */

define( 'ACF_LITE' , true );
require_once( get_template_directory() . '/vendor/advanced-custom-fields/acf.php' );
require_once( get_template_directory() . '/vendor/acf-options-page/acf-options-page.php' );

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
    register_field_group(array (
        'id' => 'acf_footer-content',
        'title' => 'Footer Content',
        'fields' => array (
            array (
                'key' => 'field_5331ee29beaa0',
                'label' => 'Footer Content (Sponsors)',
                'name' => 'pipeline_footer_content',
                'type' => 'wysiwyg',
                'instructions' => 'Here you can format the footer content with the sponsors',
                'default_value' => '',
                'toolbar' => 'full',
                'media_upload' => 'yes',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'pipeline-theme-options',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array (
            'position' => 'normal',
            'layout' => 'default',
            'hide_on_screen' => array (
            ),
        ),
        'menu_order' => 0,
    ));
}
