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
add_action ( 'wp_enqueue_scripts' , 'wbb_wp_enqueue_scripts' );
function wbb_wp_enqueue_scripts ()
{

	// Styles
	wp_enqueue_script ( 'modernizr' , '' . get_template_directory_uri () . '/assets/scripts/vendor/modernizr.js' , array ( 'jquery' ) , NULL , FALSE );
	wp_enqueue_script ( 'menu-navigation' , '' . get_template_directory_uri () . '/assets/scripts/vendor/navigation.js' , array ( 'jquery' ) , NULL , FALSE );

	// Scripts
	wp_enqueue_style ( 'general-css' , '' . get_template_directory_uri () . '/assets/styles/general.css' , array () , '1.0.0' , 'all' );

}


add_action ( 'admin_enqueue_scripts' , 'wbb_theme_add_color_picker' );
function wbb_theme_add_color_picker ( $hook )
{

	if ( is_admin () )
	{

		// Add the color picker css file
		wp_enqueue_style ( 'wp-color-picker' );

		// Include our custom jQuery file with WordPress Color Picker dependency
		wp_enqueue_script ( 'custom-script-handle' , '' . get_template_directory_uri () . '/assets/scripts/vendor/wbb-theme-script.js' , array ( 'wp-color-picker' ) , FALSE , TRUE );
	}
}