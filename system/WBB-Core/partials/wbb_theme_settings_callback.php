<h1 class='nav-tab-wrapper'>General Settings</h1>

<div class="wrap">

    <form method="post" action="options.php">

        <?php settings_fields ( 'wbb-theme-setting-section' ) ; ?>
        <?php do_settings_sections ( 'wbb-theme-setting-section' ) ; ?>




        <table class="wp-list-table widefat fixed posts" >

            <tbody>

                <tr>

                    <td>

                        Select Menu

                    </td>


                    <td>

                        <select name="wbb_theme_registered_menus" autocomplete="off">

                            <?php
                            foreach ( $menus as $menu )
                            {
                                ?>
                                <option value="<?php echo $menu -> slug ; ?>" <?php echo isset ( $registered_menus ) && $registered_menus == $menu -> slug ? ' selected ' : '' ; ?>><?php echo $menu -> name ; ?></option>


                            <?php }
                            ?>

                        </select>

                    </td>

                </tr>
                
                <tr class="alternate">

                    <td>

                        Activate Off Canvas

                    </td>


                    <td>

                        <input type="checkbox" name="wbb_theme_activate_offcanvas" value="yes"  <?php echo $activate_offcanvas == "yes" ? ' checked ' : '' ; ?>>


                    </td>

                </tr>

            </tbody>

        </table>














<?php submit_button () ; ?>

    </form>

</div>




