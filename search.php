<?php
/**
 * The template for displaying search results pages.
 *
 * @package wbb-starter-theme
 */


if ( ! have_posts () ) : ?>

	<div class="alert alert-warning">

		<?php _e ( 'Sorry, no results were found.' , 'webberty' ); ?>

	</div>

	<?php get_search_form (); ?>

<?php endif; ?>

<?php while ( have_posts () ) : the_post (); ?>

	<?php get_template_part ( 'templates/content' , 'search' ); ?>

<?php endwhile; ?>

<?php the_posts_navigation (); ?>