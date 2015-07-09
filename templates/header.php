<?php
/**
 * The header of our theme.
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
<header class="site-header" role="banner">

	<div class="site-branding">

		<h1 class="site-title">

			<a href="<?php echo esc_url ( home_url ( '/' ) ); ?>" rel="home">

				<img src="<?php echo get_theme_mod ( 'wbb-logo-img-upload' , '' ); ?>" class="js-site-logo">

				<?php bloginfo ( 'name' ); ?></a></h1>

		<p class="site-description"><?php bloginfo ( 'description' ); ?></p>

	</div>

	<!-- Button launcher sliding panel -->
	<button type="button" class="js-menu-trigger offcanvas-button">
		...
	</button>

	<div class="site-navigation" role="banner" itemscope itemtype="http://schema.org/SiteNavigationElement">
		<div class="navigation-wrapper">
			<a href="javascript:void(0)" class="navigation-menu-button" id="js-mobile-menu">Menu</a>
			<nav role="navigation">

				<?php
				if ( has_nav_menu ( 'primary_navigation' ) ) :

					$defaults = array (
						'theme_location'  => 'primary_navigation' ,
						'menu'            => 'primary' ,
						'container'       => '' ,
						'container_class' => 'container_class' ,
						'container_id'    => 'container_id' ,
						'menu_class'      => 'navigation-menu show' ,
						'menu_id'         => 'js-navigation-menu' ,
						'echo'            => TRUE ,
						'before'          => '' ,
						'after'           => '' ,
						'link_before'     => '' ,
						'link_after'      => '' ,
						'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>' ,
						'depth'           => 4 ,

					);

					wp_nav_menu ( $defaults );

				endif;

				?>

			</nav>

		</div>
	</div>

	<!-- #site-navigation -->

</header>