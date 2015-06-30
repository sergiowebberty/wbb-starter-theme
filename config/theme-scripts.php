<?php if ( ! defined ( 'WPINC' ) )
{
	header ( 'HTTP/1.0 404 Not Found' , TRUE , 404 );
	die( "404 Not Found" );
}


/**
 * Load Scripts for this theme in front end
 */
function themeScripts ()
{
	wp_enqueue_script ( 'jquery' , '' . get_template_directory_uri () . '/assets/scripts/lib/jquery-1.11.0.min.js' , array () , NULL , TRUE );
	wp_enqueue_script ( 'modernizr' , '' . get_template_directory_uri () . '/assets/scripts/modernizr.js' , array ( 'jquery' ) , NULL , FALSE );
	wp_enqueue_script ( 'match-height-min' , '' . get_template_directory_uri () . '/assets/scripts/jquery.matchHeight-min.js' , array ( 'jquery' ) , NULL , TRUE );
	wp_enqueue_script ( 'components' , '' . get_template_directory_uri () . '/assets/scripts/components.js' , array ( 'jquery' ) , NULL , TRUE );
}

add_action ( 'wp_enqueue_scripts' , 'themeScripts' );


/**
 * Load Styles for this theme here
 */
function themeStyles ()
{
	wp_enqueue_style ( 'general-css' , '' . get_template_directory_uri () . '/assets/styles/general.css' , array () , '1.0.0' , 'all' );
}

add_action ( 'wp_enqueue_scripts' , 'themeStyles' );