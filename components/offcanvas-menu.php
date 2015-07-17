<div id="offcanvas_container">

	<nav>

		<div id="trigger-mobile" class="close-menu js-close-menu js-collapse-offcanvas reorder-close">x</div>

		<?php
		if ( has_nav_menu ( 'primary_navigation' ) ) :
                    
                        $menu_offcanvas = get_option ( 'wbb_theme_registered_menus' );

			$defaults = array (
				'theme_location' => 'primary_navigation' ,
				'menu'           => $menu_offcanvas ,
				'container'      => '' ,
				'echo'           => TRUE ,
				'before'         => '' ,
				'after'          => '' ,
				'link_before'    => '' ,
				'link_after'     => '' ,
				'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>' ,
				'depth'          => 4 ,

			);

			wp_nav_menu ( $defaults );

		endif;

		?>

	</nav>

</div>