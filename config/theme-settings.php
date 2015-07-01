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

$settings[ 'meta_tags' ][ ] = '<meta charset="utf-8">';
$settings[ 'meta_tags' ][ ] = '<meta name="viewport" content="width=device-width, initial-scale=1">';
$settings[ 'meta_tags' ][ ] = '<link rel="shortcut icon" href="../../assets/ico/favicon.ico">';


/*
| ----------------------------------------------------------------------------------------------------------------------
| Theme Support
| ----------------------------------------------------------------------------------------------------------------------
| Set Some Default Theme Support Settings
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

$settings[ 'theme_support' ][ ] = array ( 'post-thumbnails' );

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
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

return (object) $settings;


/**
 * Utility class which takes an array of conditional tags (or any function which returns a boolean)
 * and returns `false` if *any* of them are `true`, and `true` otherwise.
 *
 * @param array list of conditional tags (http://codex.wordpress.org/Conditional_Tags)
 *        or custom function which returns a boolean
 *
 * @return boolean
 */
class ConditionalTagCheck {
    private $conditionals;

    public $result = true;

    public function __construct($conditionals = []) {
        $this->conditionals = $conditionals;

        $conditionals = array_map([$this, 'checkConditionalTag'], $this->conditionals);

        if (in_array(true, $conditionals)) {
            $this->result = false;
        }
    }

    private function checkConditionalTag($conditional) {
        if (is_array($conditional)) {
            list($tag, $args) = $conditional;
        } else {
            $tag = $conditional;
            $args = false;
        }

        if (function_exists($tag)) {
            return $args ? $tag($args) : $tag();
        } else {
            return false;
        }
    }
}

/**
 * Define which pages shouldn't have the sidebar
 */
function display_sidebar() {
    static $display;

    if (!isset($display)) {
        $conditionalCheck = new ConditionalTagCheck(
        /**
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
         */
            [
                'is_404',
                'is_front_page',
                ['is_page_template', 'template-custom.php']
            ]
        );

        $display = apply_filters('sage/display_sidebar', $conditionalCheck->result);
    }

    return $display;
}