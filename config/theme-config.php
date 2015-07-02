<?php if ( ! defined ( 'WPINC' ) )
{
	header ( 'HTTP/1.0 404 Not Found' , TRUE , 404 );
	die( "404 Not Found" );
}

// IMPORTANT : KEEP THIS FILE CLEAN AS YOU CAN ....


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
register_sidebar (
	[
		'name'          => __ ( 'Main Sidebar' , 'webberty' ) ,
		'id'            => 'sidebar-1' ,
		'description'   => __ ( 'Widgets in this area will be shown on all posts and pages.' , 'webberty' ) ,
		'before_widget' => '<li id="%1$s" class="widget %2$s">' ,
		'after_widget'  => '</li>' ,
		'before_title'  => '<h2 class="widgettitle">' ,
		'after_title'   => '</h2>' ,
	]
);

/*
| ----------------------------------------------------------------------------------------------------------------------
| Sidebars
| ----------------------------------------------------------------------------------------------------------------------
| Any of these conditional tags that return true won't show the sidebar.
| You can also specify your own custom function as long as it returns a boolean.
| To use a function that accepts arguments, use an array instead of just the function name as a string.
| Examples:
| 'is_single'
| 'is_archive'
| ['is_page', 'about-me']
| ['is_tax', ['flavor', 'mild']]
| ['is_page_template', 'about.php']
| ['is_post_type_archive', ['foo', 'bar', 'baz']]
*/
add_filter ( 'WBB_display_sidebar' ,
	function ()
	{

		return [
			'is_404' ,
			'is_home' ,
			'is_front_page' ,
			'is_single' ,
		];

	}
);

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
	wp_update_nav_menu_item ( $menu_id , 0 ,
		[
			'menu-item-title'   => __ ( 'Home' ) ,
			'menu-item-classes' => 'home' ,
			'menu-item-url'     => ( '/' ) ,
			'menu-item-status'  => 'publish'
		]
	);

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

/*
| ----------------------------------------------------------------------------------------------------------------------
| Head Clean
| ----------------------------------------------------------------------------------------------------------------------
| Set default Menu's
*/
remove_action ( 'wp_head' , 'parent_post_rel_link' , 10 , 0 );
remove_action ( 'wp_head' , 'feed_links' , 10 );
remove_action ( 'wp_head' , 'rsd_link' );
remove_action ( 'wp_head' , 'wlwmanifest_link' );
remove_action ( 'wp_head' , 'index_rel_link' );
remove_action ( 'wp_head' , 'parent_post_rel_link' , 10 , 0 );
remove_action ( 'wp_head' , 'start_post_rel_link' , 10 , 0 );
remove_action ( 'wp_head' , 'adjacent_posts_rel_link' , 10 , 0 );
remove_action ( 'wp_head' , 'wp_shortlink_wp_head' , 10 , 0 );
remove_action ( 'wp_head' , 'wp_generator' , 10 , 0 );
remove_action ( 'wp_head' , 'print_emoji_detection_script' , 7 );
remove_action ( 'admin_print_scripts' , 'print_emoji_detection_script' );
remove_action ( 'wp_print_styles' , 'print_emoji_styles' );
remove_action ( 'admin_print_styles' , 'print_emoji_styles' );

/*
| ----------------------------------------------------------------------------------------------------------------------
| Theme Support
| ----------------------------------------------------------------------------------------------------------------------
| Set Some Default The	<title><?php wp_title ( '|' , TRUE , 'right' ); ?></title>me Support Settings
*/
add_action ( 'after_setup_theme' , function ()
{

	add_theme_support ( 'html5' ,
		[
			'comment-list' ,
			'comment-form' ,
			'search-form' ,
			'gallery' ,
			'caption'
		]
	);

	add_theme_support ( 'automatic-feed-links' );

	add_theme_support ( 'post-formats' ,
		[

			//Typically styled without a title. Similar to a Facebook note update.
			'aside' ,

			//A gallery of images. Post will likely contain a gallery shortcode and will have image attachments.
			'gallery'
			,
			//A link to another site. Themes may wish to use the first <a href=””> tag in the post content as the external link for that post.
			//An alternative approach could be if the post consists only of a URL, then that will be the URL and the title (post_title) will be the name attached to the anchor for it.
			'link' ,

			// A single image. The first <img /> tag in the post could be considered the image.
			//Alternatively, if the post consists only of a URL, that will be the image URL and the title of the post (post_title) will be the title attribute for the image.
			'image' ,

			//quote - A quotation.
			//Probably will contain a blockquote holding the quote content.
			//Alternatively, the quote may be just the content, with the source/author being the title.
			'quote' ,

			// A short status update, similar to a Twitter status update.
			'status' ,

			//A single video. The first <video /> tag or object/embed in the post content could be considered the video.
			//Alternatively, if the post consists only of a URL, that will be the video URL.
			//May also contain the video as an attachment to the post, if video support is enabled on the blog (like via a plugin).
			'video' ,

			//An audio file. Could be used for Podcasting.
			'audio' ,

			// A chat transcript, like so:
			'chat'
		]
	);


} );

/*
| ----------------------------------------------------------------------------------------------------------------------
| Add extra meta data
| ----------------------------------------------------------------------------------------------------------------------
| Add extra meta data in the heade.php side when <?php wp_head (); ?> is used
| This functionality is placed in system/WBB_Core/WBB-Core.php function name  AddMetaTags ().
*/
add_action ( 'wp_head' , function ()
{

	//Set custom head meta when there is MSIE ...
	if ( isset( $_SERVER[ 'HTTP_USER_AGENT' ] ) && ( strpos ( $_SERVER[ 'HTTP_USER_AGENT' ] , 'MSIE' ) !== FALSE ) )
	{

		echo '<meta content="X-UA-Compatible: IE=edge,chrome=1" >' . "\n";

	}

	echo '<meta name="viewport" content="width=device-width, initial-scale=1">' . "\n";

} , 1 );

/*
| ----------------------------------------------------------------------------------------------------------------------
| Remove the  small segment of css in the head
| ----------------------------------------------------------------------------------------------------------------------
| There is a small segment of css in the head that we can remove
*/
add_action ( 'widgets_init' , function ()
{

	global $wp_widget_factory;

	remove_action ( 'wp_head' ,
		[
			$wp_widget_factory->widgets[ 'WP_Widget_Recent_Comments' ] ,
			'recent_comments_style'
		]
	);

} );