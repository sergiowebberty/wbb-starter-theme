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


}) ( jQuery );