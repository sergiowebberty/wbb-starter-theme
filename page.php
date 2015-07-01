<?php
/**
 * The template for displaying all pages.
 *
 * @package wbb-starter-theme
 */


while ( have_posts () ) : the_post ();

	get_template_part ( 'templates/content' , 'page' );

endwhile;

