(function ($)
{
    'use strict';




    $ ( document ).ready ( function ()
                           {

                               /* // Equal height size for columns
                                (function() {

                                // apply your matchHeight on DOM ready (they will be automatically re-applied on load or resize)
                                $(function() {


                                // apply matchHeight to each item container's items
                                $('.equal').each(function() {
                                $(this).children('div').matchHeight({
                                byRow: true
                                });
                                });
                                });

                                })();
                                */

                               /*******************************************************************************************************************
                                * On Document ready ..
                                *******************************************************************************************************************/
                               $ ( function ()
                                   {

                                       // apply matchHeight to each item container's items
                                       $ ( '.equal' ).each ( function ()
                                                             {
                                                                 $ ( this ).children ( 'div' ).matchHeight ( { byRow : true } );
                                                             } );
                                   } );


                           } );





}) ( jQuery );