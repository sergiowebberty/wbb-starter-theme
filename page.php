<?php
/**
 * The template for displaying all pages.
 *
 * @package wbb-starter-theme
 */
if ( ! defined ( 'WPINC' ) )
{
	header ( 'HTTP/1.0 404 Not Found' , TRUE , 404 );
	die( "404 Not Found" );
}

wbb_breadcrumb (); ?>

<main class="article" role="main">

<?php

while ( have_posts () ) : the_post ();

	get_template_part ( 'templates/content' , 'page' );

endwhile; ?>

</main>