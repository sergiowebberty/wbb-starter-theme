<?php if ( ! defined ( 'WPINC' ) )
{
	header ( 'HTTP/1.0 404 Not Found' , TRUE , 404 );
	die( "404 Not Found" );
}

/*
| ----------------------------------------------------------------------------------------------------------------------
| Set default upload folder
| ----------------------------------------------------------------------------------------------------------------------
| Set default upload folder
*/
if ( get_option ( 'upload_path' ) == 'wp-content/uploads' || get_option ( 'upload_path' ) == NULL )
{

	update_option ( 'upload_path' , 'assets' );

}

/*
| ----------------------------------------------------------------------------------------------------------------------
| Sidebars
| ----------------------------------------------------------------------------------------------------------------------
| Set some default sidebars ....
*/
register_sidebars ( 1 , array ( 'name' => 'Side Bar' ) );

/*
| ----------------------------------------------------------------------------------------------------------------------
| Menus
| ----------------------------------------------------------------------------------------------------------------------
| Set default Menu's
*/
register_nav_menu ( 'primary_navigation' , __ ( 'Main navigation for the website' ) );

$menuname           = 'Main Navigation';
$primary_navigation = 'primary_navigation';
$menu_exists        = wp_get_nav_menu_object ( $menuname );


// If it doesn't exist, let's create it.
if ( ! $menu_exists )
{

	$menu_id = wp_create_nav_menu ( $menuname );

	// Set up default BuddyPress links and add them to the menu.
	wp_update_nav_menu_item ( $menu_id , 0 , array (
		'menu-item-title'   => __ ( 'Home' ) ,
		'menu-item-classes' => 'home' ,
		'menu-item-url'     => ( '/' ) ,
		'menu-item-status'  => 'publish'
	) );

	//Grab the theme locations and assign our newly - created menu
	if ( ! has_nav_menu ( $primary_navigation ) )
	{

		$locations                        = get_theme_mod ( 'nav_menu_locations' );
		$locations[ $primary_navigation ] = $menu_id;

		set_theme_mod ( 'nav_menu_locations' , $locations );

	}

	if ( ! has_nav_menu ( $primary_footer_navigation ) )
	{

		$locations                               = get_theme_mod ( 'nav_menu_locations' );
		$locations[ $primary_footer_navigation ] = $menu_id;

		set_theme_mod ( 'nav_menu_locations' , $locations );

	}

}

/************************************************************************************************************************************************
 * Any of these conditional tags that return true won't show the sidebar.
 * You can also specify your own custom function as long as it returns a boolean.
 *
 * To use a function that accepts arguments, use an array instead of just the function name as a string.
 *
 * Examples:
 *
 * 'is_single'
 * 'is_archive'
 * ['is_page', 'about-me']
 * ['is_tax', ['flavor', 'mild']]
 * ['is_page_template', 'about.php']
 * ['is_post_type_archive', ['foo', 'bar', 'baz']]
 *
 ***********************************************************************************************************************************************/
add_filter ( 'WBB_display_sidebar' , function ()
{
	return [
		'is_404' ,
		'is_home' ,
		'is_front_page' ,
			'is_single' ,
			'is_singular'
	];

} );
