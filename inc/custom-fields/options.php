<?php
/**
 * Custom Fields for the Footer
 * User: scrockett
 * Date: 4/8/14
 * Time: 2:46 PM
 */

register_field_group(array (
    'id' => 'acf_login-message',
    'title' => 'Login Message',
    'fields' => array (
        array (
            'key' => 'field_535aaa9c56390',
            'label' => 'Login Message',
            'name' => 'pipeline_login_message',
            'type' => 'textarea',
            'instructions' => 'Text should be HTML wrapped in <code>&lt;&hellip; class="message"&gt;&hellip;&lt;/&hellip;"&gt;</code>',
            'default_value' => '',
            'placeholder' => '',
            'maxlength' => '',
            'rows' => '',
            'formatting' => 'html',
        ),
        array (
            'key' => 'field_537e2f60dee01',
            'label' => 'Unsupported Browser Alert',
            'name' => 'pipeline_unsupported_browser',
            'type' => 'textarea',
            'instructions' => 'This field can be plain text or <em>valid</em> HTML',
            'default_value' => '',
            'placeholder' => '',
            'maxlength' => '',
            'rows' => '',
            'formatting' => 'html',
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
        'layout' => 'no_box',
        'hide_on_screen' => array (
        ),
    ),
    'menu_order' => 0,
));
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
register_field_group(array (
    'id' => 'acf_survey-button',
    'title' => 'Survey Button',
    'fields' => array (
        array (
            'key' => 'field_5380e4e08bace',
            'label' => 'Link Text',
            'name' => 'pipeline_survey_text',
            'type' => 'text',
            'default_value' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'formatting' => 'html',
            'maxlength' => '',
        ),
        array (
            'key' => 'field_5380e5028bacf',
            'label' => 'Link Target URL',
            'name' => 'pipeline_survey_url',
            'type' => 'text',
            'default_value' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'formatting' => 'html',
            'maxlength' => '',
        ),
        array (
            'key' => 'field_5380e5228bad0',
            'label' => 'Link Class',
            'name' => 'pipeline_survey_class',
            'type' => 'text',
            'default_value' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'formatting' => 'html',
            'maxlength' => '',
        ),
        array (
            'key' => 'field_5380e57d8bad1',
            'label' => 'Open Link in a New Window',
            'name' => 'pipeline_survey_target',
            'type' => 'true_false',
            'message' => '',
            'default_value' => 0,
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
        'position' => 'side',
        'layout' => 'default',
        'hide_on_screen' => array (
        ),
    ),
    'menu_order' => 0,
));