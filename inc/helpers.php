<?php 
/**
 * Helper functions
 */

/**
 * Maybe change the protocol on URL for HTTPS
 */
function pipeline_maybe_https( $url ) {
	$url = trim( $url );
	if ( is_ssl() ) {
		$url = preg_replace( '/^http:/i', 'https:', $url );
	}
	return esc_url( $url );
}