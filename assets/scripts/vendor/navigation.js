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

    $ ( document ).on ( "click touchstart" , '.sliding-panel-button,.sliding-panel-fade-screen,.sliding-panel-close' , function (e)
    {

        $('.sliding-panel-content,.sliding-panel-fade-screen').toggleClass('is-visible');
        e.preventDefault();

    } );


}) ( jQuery );