<?php if ( ! defined ( 'WPINC' ) )
{
	header ( 'HTTP/1.0 404 Not Found' , TRUE , 404 );
	die( "404 Not Found" );
}

require_once locate_template ( 'system/WBB-libs/WBB-System-Neat-Menu-Walker.php' );