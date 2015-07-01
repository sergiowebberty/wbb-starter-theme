<?php
/**
 * The header of our theme.
 *
 * @package wbb-starter-theme
 */
?>

<header class="site-header" role="banner">

    <div class="site-branding">

        <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>

        <p class="site-description"><?php bloginfo( 'description' ); ?></p>

    </div><!-- .site-branding -->

    <nav class="site-navigation" role="navigation">

        <?php
        if (has_nav_menu('primary_navigation')) :

            wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']);

        endif;

        ?>

    </nav><!-- #site-navigation -->

</header>