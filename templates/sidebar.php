<?php
/**
 * The sidebar of our theme.
 *
 * @package wbb-starter-theme
 */
?>

<aside class="sidebar" role="complementary">

    <?php if ( is_active_sidebar( 'Side Bar' ) ) : ?>

        <?php dynamic_sidebar( 'Side Bar' ); ?>

    <?php else : ?>

        <?php
        /*
         * This content shows up if there are no widgets defined in the backend.
        */
        ?>

        <div class="alert alert-no-widgets">

            <p><?php _e( 'This is a widget ready area. Add some and they will appear here.', 'webberty' );  ?></p>

        </div>

    <?php endif; ?>

</aside>

