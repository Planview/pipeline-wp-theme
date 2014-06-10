<?php 
/**
  * This is a template that finds the presentation that is currently live
  * and forwards to that post.
  *
  *	Template Name: Live Presentation Link
  */

$pipeline_live_presentation = pipeline_get_next_presentation( time(), true );

if ( $pipeline_live_presentation ) :
	wp_safe_redirect( get_the_permalink( $pipeline_live_presentation->ID ), 302 );
else :
	wp_safe_redirect( get_post_type_archive_link( 'presentations' ), 302 );
endif;