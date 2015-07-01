<?php
/**
 * The template used for displaying page content in single.php
 *
 * @package wbb-starter-theme
 */
?>

<?php while ( have_posts () ) : the_post (); ?>

	<article id="post-<?php the_ID (); ?>" <?php post_class (); ?>>

		<header class="entry-header">

			<?php the_title ( '<h1 class="entry-title">' , '</h1>' ); ?>

			<div class="entry-meta">

				<?php wbb_entry_meta (); ?> <!-- function for date and author and comments count /--->

			</div>

		</header>

		<div class="entry-content">

			<?php the_content (); ?>

			<?php wp_link_pages ( array (
				'before' => '<nav class="page-nav"><p>' . __ ( 'Pages:' , WBB_THEME_SLUG ) ,
				'after'  => '</p></nav>'
			) ); ?>

		</div>

		<footer class="entry-footer">

			<?php wbb_entry_footer (); ?>     <!-- function for categories, tags and comments/--->

		</footer>
		<!-- .entry-footer -->

	</article>

<?php endwhile; ?>