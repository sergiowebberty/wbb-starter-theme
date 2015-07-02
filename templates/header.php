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

	<div class="site-navigation" role="banner" itemscope itemtype="http://schema.org/SiteNavigationElement">
		<div class="navigation-wrapper">
            <nav role="navigation">

                <?php
                if ( has_nav_menu ( 'primary_navigation' ) ) :

                    wp_nav_menu ( [
                        'menu'            => 'primary' ,
                        'theme_location'  => 'primary_navigation' ,
                        'depth'           => 2 ,
                        'container'       => '' ,
                        'menu_class'      => 'navigation-menu show' ,
                        'menu_id'         => 'js-navigation-menu' ,
                        'fallback_cb'     => 'Neat_Menu_Walker::fallback' ,
                        'walker'          => new Neat_Menu_Walker()
                    ] );

                endif;

                ?>

            </nav>



		</div>



	</div>
	<!-- #site-navigation -->

</header>