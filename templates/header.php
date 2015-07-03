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
    <!--<div class="site-navigation" role="banner">
        <div class="navigation-wrapper">
            <a href="javascript:void(0)" class="navigation-menu-button" id="js-mobile-menu">Menu</a>
            <nav role="navigation">
                <ul id="js-navigation-menu" class="navigation-menu show">
                    <li class="nav-link"><a href="javascript:void(0)">About Us</a></li>
                    <li class="nav-link"><a href="javascript:void(0)">Contact</a></li>
                    <li class="nav-link hover-menu">
                        <a href="javascript:void(0)">More</a>
                        <ul class="submenu">
                            <li class="hover-menu">
                                <a href="javascript:void(0)" class="hover-menu-item">Item with submenu</a>
                                <ul class="submenu">
                                    <li><a href="javascript:void(0)">Submenu Item</a></li>
                                    <li><a href="javascript:void(0)">Another Item</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-link"><a href="javascript:void(0)">Sign up</a></li>
                </ul>
            </nav>
        </div>
    </div>-->

	<!--<div class="site-navigation" role="banner" itemscope itemtype="http://schema.org/SiteNavigationElement">
		<div class="navigation-wrapper">
            <nav role="navigation">

                <?php
/*                if ( has_nav_menu ( 'primary_navigation' ) ) :

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

                */?>

            </nav>

		</div>
	</div>-->

	<div class="site-navigation" role="banner" itemscope itemtype="http://schema.org/SiteNavigationElement">
		<div class="navigation-wrapper">
            <a href="javascript:void(0)" class="navigation-menu-button" id="js-mobile-menu">Menu</a>
            <nav role="navigation">

                <?php
                if ( has_nav_menu ( 'primary_navigation' ) ) :

                    $defaults = array (
                        'theme_location'  => 'primary_navigation' ,
                        'menu'            => 'primary' ,
                        'container'      => '' ,
                        'container_class' => 'container_class' ,
                        'container_id'    => 'container_id' ,
                        'menu_class'      => 'navigation-menu show' ,
                        'menu_id'        => 'js-navigation-menu' ,
                        'echo'            => TRUE ,
                        'before'          => '' ,
                        'after'          => '' ,
                        'link_before'    => '' ,
                        'link_after'      => '' ,
                        'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>' ,
                        'depth'          => 2 ,

                    );

                    wp_nav_menu ( $defaults );

                endif;

                ?>

            </nav>

		</div>
	</div>



	<!-- #site-navigation -->

</header>