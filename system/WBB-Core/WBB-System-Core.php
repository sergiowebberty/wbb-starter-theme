<?php if ( ! defined ( 'WPINC' ) )
{
	header ( 'HTTP/1.0 404 Not Found' , TRUE , 404 );
	die( "404 Not Found" );
}

class WBB_System_Core
{

	/**********************************************************************************************************************
	 * Stores the full path to the main template file
	 *********************************************************************************************************************/
	static $main_template;

	/**********************************************************************************************************************
	 * Stores the base name of the template file; e.g. 'page' for 'page.php' etc.
	 *********************************************************************************************************************/
	static $base_template;

	/**********************************************************************************************************************
	 * Store Theme settings
	 *
	 * @var
	 *********************************************************************************************************************/
	static $theme_settings;

	/**********************************************************************************************************************
	 * Base Wrapper core
	 *
	 * @documentation : https://codex.wordpress.org/Plugin_API/Filter_Reference/template_include
	 *
	 * @param $template
	 *
	 * @return string
	 *********************************************************************************************************************/
	static function base_wrapper ( $template )
	{

		self::$main_template = $template;
		self::$base_template = basename ( self::$main_template , '.php' );

		if ( 'index' == self::$base_template )
		{
			self::$base_template = FALSE;
		}

		$templates = array ( 'base.php' );

		if ( self::$base_template )
		{
			array_unshift ( $templates , sprintf ( 'base-%s.php' , self::$base_template ) );
		}

		return locate_template ( $templates );
	}

	/**********************************************************************************************************************
	 * Load Content on base.php
	 *
	 * @documentation : https://codex.wordpress.org/Plugin_API/Filter_Reference/template_include
	 *
	 * @return mixed
	 *********************************************************************************************************************/
	static function load_content ()
	{
		return WBB_System_Core::$main_template;
	}

	/**********************************************************************************************************************
	 *  Remove actions ....
	 *********************************************************************************************************************/
	private static function _remove_action ()
	{

		if ( isset( self::$theme_settings->remove_action ) && ( ! empty( self::$theme_settings->remove_action ) ) )
		{

			if ( is_array ( self::$theme_settings->remove_action ) )
			{

				foreach ( self::$theme_settings->remove_action as $remove_action )
				{

					remove_action ( $remove_action[ 0 ] , $remove_action[ 1 ] , ( isset( $remove_action[ 2 ] ) ? $remove_action[ 2 ] : FALSE ) , ( isset( $remove_action[ 3 ] ) ? $remove_action[ 3 ] : 10 ) );

				}
			}

		}

	}

	/**********************************************************************************************************************
	 * Add Theme Support
	 *********************************************************************************************************************/
	private static function _theme_support ()
	{

		if ( isset( self::$theme_settings->theme_support ) && ( ! empty( self::$theme_settings->theme_support ) ) )
		{

			if ( is_array ( self::$theme_settings->theme_support ) )
			{

				foreach ( self::$theme_settings->theme_support as $theme_support )
				{

					add_theme_support ( $theme_support[ 0 ] , ( isset( $theme_support[ 1 ] ) ? $theme_support[ 1 ] : TRUE ) );

				}
			}

		}

	}

	/**********************************************************************************************************************
	 * Add custom Meta tags
	 *********************************************************************************************************************/
	static function add_meta_tags ()
	{

		if ( isset( self::$theme_settings->meta_tags ) && ( ! empty( self::$theme_settings->meta_tags ) ) )
		{

			if ( is_array ( self::$theme_settings->meta_tags ) )
			{

				foreach ( self::$theme_settings->meta_tags as $meta )
				{

					echo $meta . "\n";

				}
			}
			else
			{

				echo self::$theme_settings->meta_tags;

			}
		}
	}

	/**********************************************************************************************************************
	 * This Function will add the page title to the body_class for easy styling of page files
	 *
	 * @param $classes
	 *
	 * @return mixed
	 *********************************************************************************************************************/
	static function title_in_body_class ( $classes )
	{

		$blog = array_search ( 'blog' , $classes );

		unset( $classes[ $blog ] );

		if ( is_singular () )
		{

			global $post;

			array_push ( $classes , "{$post->post_type}-{$post->post_name}" );

		}
		elseif ( is_404 () )
		{

			array_push ( $classes , "error404" );

		}

		return $classes;
	}


	/**
	 * Creates a nicely formatted and more specific title element text
	 * for output in head of document, based on current view.
	 *
	 * @since Twenty Twelve 1.0
	 *
	 * @param string $title Default title text for current view.
	 * @param string $sep   Optional separator.
	 *
	 * @return string Filtered title.
	 */
	 static function wbb_wp_title ( $title , $sep )
	{
		global $paged , $page;

		if ( is_feed () )
		{
			return $title;
		}

		// Add the site name.
		$title .= get_bloginfo ( 'name' );

		// Add the site description for the home/front page.
		$site_description = get_bloginfo ( 'description' , 'display' );
		if ( $site_description && ( is_home () || is_front_page () ) )
		{
			$title = "$title $sep $site_description";
		}

		// Add a page number if necessary.
		if ( $paged >= 2 || $page >= 2 )
		{
			$title = "$title $sep " . sprintf ( __ ( 'Page %s' , WBB_THEME_SLUG ) , max ( $paged , $page ) );
		}

		return $title;
	}


	/**********************************************************************************************************************
	 * @param $theme_settings
	 *********************************************************************************************************************/
	static function init ( $theme_settings )
	{

		self::$theme_settings = $theme_settings;

		self::_remove_action ();
		self::_theme_support ();

		add_filter ( 'wp_title' , [
			'WBB_System_Core' ,
			'wbb_wp_title'
		] , 10 , 2 );

		add_filter ( 'template_include' , [
			'WBB_System_Core' ,
			'base_wrapper'
		] , 99 );

		// Add custom Meta tags
		add_action ( 'wp_head' , [
			'WBB_System_Core' ,
			'add_meta_tags'
		] , 1 );

		// This Function will add the page title to the body_class for easy styling of page files...
		add_action ( 'body_class' , [
			'WBB_System_Core' ,
			'title_in_body_class'
		] );

	}

}

