<h1 class='nav-tab-wrapper'>General Settings</h1>

<div class="wrap">

    <form method="post" action="options.php">

        <?php settings_fields ( 'wbb-theme-setting-section' ) ; ?>
        <?php do_settings_sections ( 'wbb-theme-setting-section' ) ; ?>


        <h3 class='nav-tab-wrapper'>Breadcrumb</h3>

        <table class="wp-list-table widefat fixed posts">

            <tbody>


                <tr class="alternate">

                    <td>

                        Activate Breadcrumbs

                    </td>

                    <td>

                        <input type="checkbox" name="wbb_theme_activate_breadcrumb" value="yes" <?php echo $activate_breadcrumb == "yes" ? ' checked ' : '' ; ?>>

                    </td>

                </tr>

                <tr >

                    <td>

                        Breadcrumbs Separator

                    </td>

                    <td>

                        <input type="text" name="wbb_theme_breadcrumb_separator" value="<?php echo $breadcrumb_separator ; ?>">

                    </td>

                </tr>

            </tbody>

        </table>




        <h3 class='nav-tab-wrapper'>Off Canvas Menu</h3>

        <table class="wp-list-table widefat fixed posts">

            <tbody>

                <tr class="alternate">

                    <td>

                        Activate Off Canvas

                    </td>

                    <td>

                        <input type="checkbox" name="wbb_theme_activate_offcanvas" value="yes" <?php echo $activate_offcanvas == "yes" ? ' checked ' : '' ; ?>>

                    </td>

                </tr>

                <tr>

                    <td>

                        Off Canvas Background

                    </td>

                    <td>

                        <input type="text" name="wbb_theme_offcanvas_background" value="<?php echo $offcanvas_background ; ?>" class="js-color-picker">

                    </td>

                </tr>

                <tr class="alternate">

                    <td>

                        Off Canvas Font Color

                    </td>

                    <td>

                        <input type="text" name="wbb_theme_offcanvas_color" value="<?php echo $offcanvas_color ; ?>" class="js-color-picker">

                    </td>

                </tr>

                <tr>

                    <td>

                        Off Canvas Menu Icon

                    </td>

                    <td>

                        <?php $img_style    = ( $offcanvas_icon != '' ) ? '' : 'style="display:none;"' ; ?>

                        <img id="offcanvas-icon-preview" src="<?php echo esc_attr ( $offcanvas_icon ) ; ?>" <?php echo $img_style ; ?> />

                        <?php $no_img_style = ( $offcanvas_icon != '' ) ? 'style="display:none;"' : '' ; ?>


                        <span class="logo-no-image" id="offcanvas-icon-preview-noimg" <?php echo $no_img_style ; ?>><?php _e ( 'No image selected' , 'wbb-starter-theme' ) ; ?></span>


                        <input type="text" id="wbb_theme_offcanvas_icon" name="wbb_theme_offcanvas_icon" value="<?php echo $offcanvas_icon ; ?>" class="logo-url" />

                        <input type="button" value="<?php echo _e ( 'Remove' , 'wbb-starter-theme' ) ; ?>" class="button offcanvas-icon-remove" id="offcanvas-icon-remove" <?php echo $img_style ; ?> />
   
                        <input type="button" value="<?php _e ( 'Change Image' , 'wbb-starter-theme' );?>" class="button offcanvas-icon-upload" id="offcanvas-icon-button" />



                    </td>

                </tr>





            </tbody>

        </table>




        <h3 class='nav-tab-wrapper'>Pagination</h3>


        <table class="wp-list-table widefat fixed posts">

            <tbody>



                <tr>

                    <td>

                        Activate Pagination

                    </td>

                    <td>

                        <input type="checkbox" name="wbb_theme_activate_pagination" value="yes" <?php echo $activate_pagination == "yes" ? ' checked ' : '' ; ?>>

                    </td>

                </tr>



            </tbody>

        </table>


        <?php submit_button () ; ?>

    </form>


</form>

</div>