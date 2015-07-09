(function ($)
{
    'use strict';

    $ ( function ()
        {
            $ ( '#js-navigation-menu' ).removeClass ( "show" );

        } );

    $ ( document ).on ( "click" , '#js-mobile-menu' , function (e)
    {
        e.preventDefault ();
        $ ( '#js-navigation-menu' ).slideToggle ( function ()
                                                  {
                                                      if ( $ ( '#js-navigation-menu' ).is ( ':hidden' ) )
                                                      {
                                                          $ ( '#js-navigation-menu' ).removeAttr ( 'style' );
                                                      }
                                                  } );

    } );





    /* This slide panel need the option to show normal navigation bar or slide panel as menu*/

    $ ( document ).on ( "click touchstart" , '.offcanvas-button,.offcanvas-fade-screen,.ofcanvas-close' , function (e)
    {

        $('.offcanvas-content,.offcanvas-fade-screen').toggleClass('is-visible');
        e.preventDefault();

    } );


}) ( jQuery );