<h1 class='nav-tab-wrapper'>General Settings</h1>

<div class="wrap">

	<form method="post" action="options.php">

		<?php settings_fields ( 'wbb-theme-setting-section' ); ?>
		<?php do_settings_sections ( 'wbb-theme-setting-section' ); ?>


		<table class="wp-list-table widefat fixed posts">

			<tbody>

			<tr class="alternate">

				<td>

					Activate Off Canvas

				</td>

				<td>

					<input type="checkbox" name="wbb_theme_activate_offcanvas" value="yes" <?php echo $activate_offcanvas == "yes" ? ' checked ' : ''; ?>>

				</td>

			</tr>

			</tbody>

		</table>


		<?php submit_button (); ?>

	</form>


	</form>

</div>



