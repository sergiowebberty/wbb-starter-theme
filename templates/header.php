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
<h1 class="hidden"><?php bloginfo ( 'name' ); ?></h1>

<section class="site-header" role="banner">



    <h3 class="hidden">Header</h3>

    <header>



        <section class="site-branding">

            <h3 class="hidden">Logo</h3>

            <a href="<?php echo esc_url ( home_url ( '/' ) ); ?>" rel="home">

                <img src="<?php echo get_theme_mod ( 'wbb-logo-img-upload' , '' ); ?>" class="js-site-logo">

                <p class="site-description"><?php bloginfo ( 'description' ); ?></p>

        </section>

        <nav class="site-navigation" role="banner" itemscope itemtype="http://schema.org/SiteNavigationElement" role="navigation">

            <div class="navigation-wrapper">

                <a href="javascript:void(0)" class="navigation-menu-button" id="js-mobile-menu">Menu</a>


                <h3 class="hidden">Main navigation</h3>

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



            </div>
        </nav>

    </header>

	<!-- #site-navigation -->

</section>