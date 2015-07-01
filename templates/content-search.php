<?php
/**
 * The template part for displaying results in search pages.
 *
 * @package wbb-starter-theme
 */
?>

<article <?php post_class (); ?>>

	<header>
		<h2 class="entry-title"><a href="<?php the_permalink (); ?>"><?php the_title (); ?></a></h2>

		<?php if ( get_post_type () === 'post' )
		{
			wbb_entry_meta ();
		} ?>

	</header>

	<div class="entry-summary">

		<?php the_excerpt (); ?>

	</div>

</article>
