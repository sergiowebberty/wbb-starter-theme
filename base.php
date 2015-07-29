<?php
/**
 * The main wrapper of the website.
 *
 * @package wbb-starter-theme
 */
if ( ! defined ( 'WPINC' ) )
{
	header ( 'HTTP/1.0 404 Not Found' , TRUE , 404 );
	die( "404 Not Found" );
}
?>
<!DOCTYPE html>
<html <?php html_schema (); ?> class="no-js" <?php language_attributes (); ?>>

<?php echo get_template_part ( 'templates/head' ); ?>

<body <?php body_class (); ?>>

<!--[if lt IE 7]>
<div class="alert">Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different
	browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to
	experience this site
</div><![endif]-->


<?php echo get_template_part ( 'components/offcanvas-menu' ); ?>


<div id="pushobj">

	<div class="site-container">

		<?php echo get_template_part ( 'templates/header' ); ?>

		<div class="main-container">

			<main class="site-main" role=main">
				<?php include WBB_System_Core::load_content (); ?>

			</main>

			<?php if ( wbb_display_sidebar () ) : ?>

				<?php echo get_template_part ( 'templates/sidebar' ); ?>

			<?php endif; ?>

		</div>

		<?php echo get_template_part ( 'templates/footer' ); ?>

	</div>

</div>


</body>

</html>
