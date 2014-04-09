<?php
/**
 * Custom Fields for the Footer
 * User: scrockett
 * Date: 4/8/14
 * Time: 2:46 PM
 */

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