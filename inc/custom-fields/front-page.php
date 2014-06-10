<?php
/**
 * Custom Fields for the Front Page
 * User: scrockett
 * Date: 4/8/14
 * Time: 2:44 PM
 */

register_field_group(array (
    'id' => 'acf_floating-tab',
    'title' => 'Floating Tab',
    'fields' => array (
        array (
            'key' => 'field_5344511c91c54',
            'label' => 'Title',
            'name' => 'float_tab_title',
            'type' => 'text',
            'default_value' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'formatting' => 'html',
            'maxlength' => '',
        ),
        array (
            'key' => 'field_5344512b91c55',
            'label' => 'Link URL',
            'name' => 'float_tab_link_url',
            'type' => 'text',
            'default_value' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'formatting' => 'html',
            'maxlength' => '',
        ),
    ),
    'location' => array (
        array (
            array (
                'param' => 'page_type',
                'operator' => '==',
                'value' => 'front_page',
                'order_no' => 0,
                'group_no' => 0,
            ),
        ),
        array (
            array (
                'param' => 'page_template',
                'operator' => '==',
                'value' => 'front-page.php',
                'order_no' => 0,
                'group_no' => 1,
            ),
        ),
    ),
    'options' => array (
        'position' => 'side',
        'layout' => 'default',
        'hide_on_screen' => array (
            0 => 'the_content',
            1 => 'custom_fields',
        ),
    ),
    'menu_order' => 0,
));
register_field_group(array (
    'id' => 'acf_front-page-fields',
    'title' => 'Front Page Fields',
    'fields' => array (
        array (
            'key' => 'field_537ea93051caf',
            'label' => 'Redirect Logged in Users to New page',
            'name' => 'pipeline_logged_in_home',
            'type' => 'text',
            'default_value' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'formatting' => 'html',
            'maxlength' => '',
        ),
        array (
            'key' => 'field_5344458aa314f',
            'label' => 'Carousel',
            'name' => 'front_carousel',
            'type' => 'repeater',
            'required' => 1,
            'sub_fields' => array (
                array (
                    'key' => 'field_534445d9a3150',
                    'label' => 'Carousel Image',
                    'name' => 'carousel_image',
                    'type' => 'image',
                    'required' => 1,
                    'column_width' => '',
                    'save_format' => 'object',
                    'preview_size' => 'medium',
                    'library' => 'all',
                ),
                array (
                    'key' => 'field_53457df144867',
                    'label' => 'Image Positioning',
                    'name' => 'carousel_image_position',
                    'type' => 'radio',
                    'required' => 1,
                    'choices' => array (
                        'center' => 'Anchor Center',
                        'top' => 'Anchor Top',
                        'bottom' => 'Anchor Bottom',
                        'left' => 'Anchor Left',
                        'right' => 'Anchor Right',
                        'top-left' => 'Anchor Top Left',
                        'top-right' => 'Anchor Top Right',
                        'bottom-left' => 'Anchor Bottom Left',
                        'bottom-right' => 'Anchor Bottom Right',
                    ),
                    'default_value' => 'center',
                    'layout' => 'vertical',
                ),
                array (
                    'key' => 'field_534445f7a3151',
                    'label' => 'Caption',
                    'name' => 'carousel_caption',
                    'type' => 'wysiwyg',
                    'required' => 1,
                    'column_width' => '',
                    'default_value' => '',
                    'toolbar' => 'full',
                    'media_upload' => 'no',
                ),
            ),
            'row_min' => 1,
            'row_limit' => 5,
            'layout' => 'row',
            'button_label' => 'Add Carousel Item',
        ),
        array (
            'key' => 'field_5344465ca3152',
            'label' => 'Columns Below Carousel',
            'name' => 'front_columns',
            'type' => 'repeater',
            'sub_fields' => array (
                array (
                    'key' => 'field_534446bda3153',
                    'label' => 'Content',
                    'name' => 'columns_content',
                    'type' => 'wysiwyg',
                    'required' => 1,
                    'column_width' => '',
                    'default_value' => '',
                    'toolbar' => 'full',
                    'media_upload' => 'yes',
                ),
            ),
            'row_min' => 3,
            'row_limit' => 3,
            'layout' => 'table',
            'button_label' => 'Add Column',
        ),
        array (
            'key' => 'field_5344472da3154',
            'label' => 'Featurettes',
            'name' => 'front_featurettes',
            'type' => 'repeater',
            'sub_fields' => array (
                array (
                    'key' => 'field_5344474aa3155',
                    'label' => 'Title',
                    'name' => 'featurette_title',
                    'type' => 'text',
                    'instructions' => 'Subtitles can be added with <code>&lt;span class="text-muted"&gt;&hellip;&lt;/span&gt;</code>',
                    'required' => 1,
                    'column_width' => '',
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'formatting' => 'html',
                    'maxlength' => '',
                ),
                array (
                    'key' => 'field_1397598368344',
                    'label' => 'Header Image',
                    'name' => 'featurette_header_image',
                    'type' => 'image',
                    'required' => 1,
                    'column_width' => '',
                    'save_format' => 'object',
                    'preview_size' => 'medium',
                    'library' => 'all',
                ),
                array (
                    'key' => 'field_5344478ca3156',
                    'label' => 'Content',
                    'name' => 'featurette_content',
                    'type' => 'wysiwyg',
                    'instructions' => 'You should use <code>&lt;p class="lead"&gt;&hellip;&lt;/p&gt;</code> for these sections',
                    'required' => 1,
                    'column_width' => '',
                    'default_value' => '',
                    'toolbar' => 'full',
                    'media_upload' => 'yes',
                ),
                array (
                    'key' => 'field_534447afa3157',
                    'label' => 'Image',
                    'name' => 'featurette_image',
                    'type' => 'image',
                    'required' => 1,
                    'column_width' => '',
                    'save_format' => 'object',
                    'preview_size' => 'medium',
                    'library' => 'all',
                ),
                array (
                    'key' => 'field_534447d0a3158',
                    'label' => 'Link Image?',
                    'name' => 'featurette_image_link',
                    'type' => 'true_false',
                    'column_width' => '',
                    'message' => '',
                    'default_value' => 0,
                ),
                array (
                    'key' => 'field_5344481ea3159',
                    'label' => 'Link URL',
                    'name' => 'featurette_image_link_url',
                    'type' => 'text',
                    'required' => 1,
                    'conditional_logic' => array (
                        'status' => 1,
                        'rules' => array (
                            array (
                                'field' => 'field_534447d0a3158',
                                'operator' => '==',
                                'value' => '1',
                            ),
                        ),
                        'allorany' => 'all',
                    ),
                    'column_width' => '',
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'formatting' => 'html',
                    'maxlength' => '',
                ),
                array (
                    'key' => 'field_53444841a315a',
                    'label' => 'Link Class',
                    'name' => 'featurette_image_link_class',
                    'type' => 'text',
                    'conditional_logic' => array (
                        'status' => 1,
                        'rules' => array (
                            array (
                                'field' => 'field_534447d0a3158',
                                'operator' => '==',
                                'value' => '1',
                            ),
                        ),
                        'allorany' => 'all',
                    ),
                    'column_width' => '',
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'formatting' => 'html',
                    'maxlength' => '',
                ),
                array (
                    'key' => 'field_53444872a315b',
                    'label' => 'ID',
                    'name' => 'featurette_id',
                    'type' => 'text',
                    'instructions' => 'Use only a valid ID. This will be sanitized and may not work as expected if the ID was not valid.',
                    'required' => 1,
                    'column_width' => '',
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'formatting' => 'html',
                    'maxlength' => '',
                ),
            ),
            'row_min' => 2,
            'row_limit' => 4,
            'layout' => 'row',
            'button_label' => 'Add Featurette',
        ),
        array (
            'key' => 'field_5344494ca315c',
            'label' => 'Content Below Featurettes',
            'name' => 'front_below',
            'type' => 'wysiwyg',
            'instructions' => 'All content will be printed inside a <code>class="container"</code>',
            'default_value' => '',
            'toolbar' => 'full',
            'media_upload' => 'yes',
        ),
    ),
    'location' => array (
        array (
            array (
                'param' => 'page_type',
                'operator' => '==',
                'value' => 'front_page',
                'order_no' => 0,
                'group_no' => 0,
            ),
        ),
        array (
            array (
                'param' => 'page_template',
                'operator' => '==',
                'value' => 'front-page.php',
                'order_no' => 0,
                'group_no' => 1,
            ),
        ),
    ),
    'options' => array (
        'position' => 'normal',
        'layout' => 'no_box',
        'hide_on_screen' => array (
            0 => 'the_content',
            1 => 'custom_fields',
        ),
    ),
    'menu_order' => 0,
));
