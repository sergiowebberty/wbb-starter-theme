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

		//print_R($template)  ;

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
	 * Init Webberty theme framework
	 *********************************************************************************************************************/
	static function init ()
	{
		add_filter ( 'template_include' , array (
			'WBB_System_Core' ,
			'base_wrapper'
		) , 99 );

	}

}

