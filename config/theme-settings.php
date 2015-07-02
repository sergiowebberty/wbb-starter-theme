<?php if ( ! defined ( 'WPINC' ) )
{
	header ( 'HTTP/1.0 404 Not Found' , TRUE , 404 );
	die( "404 Not Found" );
}

/*
| ----------------------------------------------------------------------------------------------------------------------
| Add extra meta data
| ----------------------------------------------------------------------------------------------------------------------
| Add extra meta data in the heade.php side when <?php wp_head (); ?> is used
| This functionality is placed in system/WBB_Core/WBB-Core.php function name  AddMetaTags ().
*/

//Set custom head meta when there is MSIE ...
if ( isset( $_SERVER[ 'HTTP_USER_AGENT' ] ) && ( strpos ( $_SERVER[ 'HTTP_USER_AGENT' ] , 'MSIE' ) !== FALSE ) )
{

	$settings[ 'meta_tags' ][ ] = '<meta content="X-UA-Compatible: IE=edge,chrome=1" >';

}

$settings[ 'meta_tags' ][ ] = '<meta name="viewport" content="width=device-width, initial-scale=1">';

/*
| ----------------------------------------------------------------------------------------------------------------------
| Theme Support
| ----------------------------------------------------------------------------------------------------------------------
| Set Some Default The	<title><?php wp_title ( '|' , TRUE , 'right' ); ?></title>me Support Settings
*/
$settings[ 'theme_support' ][ ] = array (
	'html5' ,
	array (
		'comment-list' ,
		'comment-form' ,
		'search-form' ,
		'gallery' ,
		'caption'
	)
);

$settings[ 'theme_support' ][ ] = array ( 'automatic-feed-links' );

$settings[ 'theme_support' ][ ] = array (
	'post-formats' ,
	array (

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
	)
);

/*
| ----------------------------------------------------------------------------------------------------------------------
| Head Clean
| ----------------------------------------------------------------------------------------------------------------------
| Set default Menu's
*/

// Display the links to the extra feeds such as category feeds
$settings[ 'remove_action' ][ ] = array (
	'wp_head' ,
	'parent_post_rel_link' ,
	10 ,
	0
);

// Display the links to the general feeds: Post and Comment Feed
$settings[ 'remove_action' ][ ] = array (
	'wp_head' ,
	'feed_links' ,
	10
);

// Display the link to the Really Simple Discovery service endpoint, EditURI link
$settings[ 'remove_action' ][ ] = array (
	'wp_head' ,
	'rsd_link'
);

// Display the link to the Windows Live Writer manifest file.
$settings[ 'remove_action' ][ ] = array (
	'wp_head' ,
	'wlwmanifest_link'
);

// index link
$settings[ 'remove_action' ][ ] = array (
	'wp_head' ,
	'index_rel_link'
);

// prev link
$settings[ 'remove_action' ][ ] = array (
	'wp_head' ,
	'parent_post_rel_link' ,
	10 ,
	0
);

// start link
$settings[ 'remove_action' ][ ] = array (
	'wp_head' ,
	'start_post_rel_link' ,
	10 ,
	0
);

// start link
$settings[ 'remove_action' ][ ] = array (
	'wp_head' ,
	'adjacent_posts_rel_link' ,
	10 ,
	0
);

// start link
$settings[ 'remove_action' ][ ] = array (
	'wp_head' ,
	'wp_shortlink_wp_head' ,
	10 ,
	0
);

// Display the XHTML generator that is generated on the wp_head hook, WP ver
$settings[ 'remove_action' ][ ] = array (
	'wp_head' ,
	'wp_generator'
);

$settings[ 'remove_action' ][ ] = array (
	'wp_head' ,
	'print_emoji_detection_script' ,
	7
);

$settings[ 'remove_action' ][ ] = array (
	'wp_print_styles' ,
	'print_emoji_styles' ,
);

return (object) $settings;