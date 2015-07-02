<?php
/**
 * The template for displaying search results pages.
 *
 * @package wbb-starter-theme
 */
if ( ! defined ( 'WPINC' ) )
{
	header ( 'HTTP/1.0 404 Not Found' , TRUE , 404 );
	die( "404 Not Found" );
}


if ( ! have_posts () ) : ?>

	<div class="alert alert-warning">

		<?php _e ( 'Sorry, no results were found.' , WBB_THEME_SLUG ); ?>

	</div>

	<?php get_search_form (); ?>

<?php endif; ?>

<?php while ( have_posts () ) : the_post (); ?>

	<?php get_template_part ( 'templates/content' , 'search' ); ?>

<?php endwhile; ?>

<?php the_posts_navigation (); ?>