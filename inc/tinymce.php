<?php
/**
 * Created by PhpStorm.
 * User: scrockett
 * Date: 4/22/14
 * Time: 3:05 PM
 */

function pipeline_tinymce_settings_filter ( $settings ) {
    if ( !isset( $settings['extended_valid_elements'] ) ) {
        $settings['extended_valid_elements'] = 'span[*]';
    } else {
        $settings['extended_valid_elements'] .= ',span[*]';
    }
    return $settings;
}
add_filter( 'tiny_mce_before_init', 'pipeline_tinymce_settings_filter' );