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
			<a href="<?php echo esc_url ( home_url ( '/' ) ); ?>" rel="home"><?php bloginfo ( 'name' ); ?></a></h1>

		<p class="site-description"><?php bloginfo ( 'description' ); ?></p>

	</div>
	<!-- .site-branding -->

	<nav class="site-navigation" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">

		<?php
		if ( has_nav_menu ( 'primary_navigation' ) ) :

		/*	wp_nav_menu ( [
				'theme_location' => 'primary_navigation' ,
				'menu_class'     => 'nav'
			] );*/


			wp_nav_menu ( [
				'menu'            => 'primary' ,
				'theme_location'  => 'primary_navigation' ,
				'depth'           => 2 ,
				'container'       => 'div' ,
				'container_class' => 'collapse navbar-collapse' ,
				'container_id'    => 'bs-example-navbar-collapse-1' ,
				'menu_class'      => 'nav navbar-nav' ,
				'fallback_cb'     => 'wp_bootstrap_navwalker::fallback' ,
				'walker'          => new Neat_Menu_Walker()
			] );


		endif;

		?>

	</nav>
	<!-- #site-navigation -->

</header>