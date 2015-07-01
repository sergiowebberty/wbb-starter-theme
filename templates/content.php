<?php
/**
 * Template part for displaying a message when no posts are found.
 *
 * @package wbb-starter-theme
 */
?>

<article id="post-<?php the_ID (); ?>" <?php post_class (); ?>>

	<header class="entry-header">
		<?php the_title ( sprintf ( '<h1 class="entry-title"><a href="%s" rel="bookmark">' , esc_url ( get_permalink () ) ) , '</a></h1>' ); ?>


		<?php if ( 'post' == get_post_type () ) : ?>

			<div class="entry-meta">

				<?php wbb_entry_meta (); ?> <!-- function for date and author and comments count /--->

			</div>

		<?php endif; ?>

	</header>
	<!-- .entry-header -->

	<div class="entry-summary">

		<?php the_excerpt (); ?>

	</div>

	<footer class="entry-footer">

		<?php wbb_entry_footer (); ?>     <!-- function for categories, tags and comments/--->

	</footer>
	<!-- .entry-footer -->

</article><!-- #post-## -->