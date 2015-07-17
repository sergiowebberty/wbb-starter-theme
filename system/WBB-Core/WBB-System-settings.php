<?php

add_action ( 'admin_menu' , 'wbb_theme_setup_menu' ) ;

add_action ( 'admin_init' , 'register_wbb_theme_setting' ) ;

// Insert Menu Item
function wbb_theme_setup_menu ()
{

    add_theme_page ( 'Wbb Theme' , 'Wbb Theme' , 'manage_options' , 'wbb-theme-plugin-settings' , 'wbb_theme_settings' , 'dashicons-archive'  ) ;
}

// Function called in settings menu item
function wbb_theme_settings ()
{

    $menus = get_terms ( 'nav_menu' , array ( 'hide_empty' => true ) ) ;

    $registered_menus = get_option ( 'wbb_theme_registered_menus' ) ? get_option ( 'wbb_theme_registered_menus' ) : array () ;

    $activate_offcanvas = get_option ( 'wbb_theme_activate_offcanvas' ) ? get_option ( 'wbb_theme_activate_offcanvas' ) : array () ;

    require plugin_dir_path ( __FILE__ ) . 'partials/wbb_theme_settings_callback.php' ;
}

function register_wbb_theme_setting ()
{
    register_setting ( 'wbb-theme-setting-section' , 'wbb_theme_registered_menus' ) ;

    register_setting ( 'wbb-theme-setting-section' , 'wbb_theme_activate_offcanvas' ) ;
}




// PUBLIC PART

