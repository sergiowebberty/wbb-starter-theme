<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package wbb-starter-theme
 */

?>

<footer class="site-footer" role="contentinfo">

	<p class="copyright">&copy; <?php echo date ( 'Y' ); ?> <?php bloginfo ( 'name' ); ?>.</p>


	<?php wp_footer (); ?>

</footer>

