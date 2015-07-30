<?php
/**
 * The sidebar of our theme.
 *
 * @package wbb-starter-theme
 */
?>

<?php if ( ! defined ( 'WPINC' ) )
{
	header ( 'HTTP/1.0 404 Not Found' , TRUE , 404 );
	die( "404 Not Found" );
}
?>
<aside class="sidebar" role="complementary">

    <h2 class="hidden">Sidebar</h2>



	<?php if ( is_active_sidebar ( 'sidebar-1' ) ) : ?>

    <section class="sidebar-widgets">

        <ul>

		<?php dynamic_sidebar ( 'sidebar-1' ); ?>

	<?php else : ?>

		<?php
		/*
		 * This content shows up if there are no widgets defined in the backend.
		*/
		?>

		<div class="flash-alert">

			<p><?php _e ( 'This is a widget ready area. Add some and they will appear here.' , WBB_THEME_SLUG ); ?></p>

		</div>

        </ul>

    </section>

	<?php endif; ?>



</aside>

