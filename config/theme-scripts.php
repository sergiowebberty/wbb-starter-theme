<?php if ( ! defined ( 'WPINC' ) )
{
	header ( 'HTTP/1.0 404 Not Found' , TRUE , 404 );
	die( "404 Not Found" );
}

/*
| ----------------------------------------------------------------------------------------------------------------------
| Enqueue Scripts
| ----------------------------------------------------------------------------------------------------------------------
|   hook to use when enqueuing items that are meant to appear on the front end. Despite the name,
|   it is used for enqueuing both scripts and styles.
*/

// Load Scripts for this theme here
add_action ( 'wp_enqueue_scripts' , function ()
{

	wp_enqueue_script ( 'modernizr' , '' . get_template_directory_uri () . '/assets/scripts/vendor/modernizr.js' , array ( 'jquery' ) , NULL , FALSE );

} );

// Load Styles for this theme here
add_action ( 'wp_enqueue_scripts' , function ()
{

	wp_enqueue_style ( 'general-css' , '' . get_template_directory_uri () . '/assets/styles/general.css' , array () , '1.0.0' , 'all' );

} );