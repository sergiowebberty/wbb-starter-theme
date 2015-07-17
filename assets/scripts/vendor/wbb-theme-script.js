(function ($)
{
    'use strict';



    // Add Color Picker to all inputs that have 'color-field' class
    $(function () {
        $('.js-color-picker').wpColorPicker();
    });




    $(document).ready(function () {

        // Upload / Change Image
        function logo_image_upload(button_class) {

            var _custom_media = true,
                    _orig_send_attachment = wp.media.editor.send.attachment;

            $('body').on('click', button_class, function (e) {

                var button_id = '#' + jQuery(this).attr('id'),
                        self = jQuery(button_id),
                        send_attachment_bkp = wp.media.editor.send.attachment,
                        button = jQuery(button_id),
                        id = button.attr('id').replace('-button', '');

                _custom_media = true;

                wp.media.editor.send.attachment = function (props, attachment) {

                    if (_custom_media) {

                        $('#offcanvas-icon-preview').attr('src', attachment.url).css('display', 'block');
                        $('#offcanvas-icon-remove').css('display', 'inline-block');
                        $('#offcanvas-icon-preview-noimg').css('display', 'none');
                        $('#' + id).val(attachment.url).trigger('change');
                        $("#wbb_theme_offcanvas_icon").val(attachment.url);
                    } else {

                        return _orig_send_attachment.apply(button_id, [props, attachment]);

                    }
                }

                wp.media.editor.open(button);

                return false;
            });
        }
        logo_image_upload('.offcanvas-icon-upload');

        // Remove Image
        function logo_image_remove(button_class) {

            $('body').on('click', button_class, function (e) {

                var button = jQuery(this),
                id = button.attr('id').replace('-remove', '');

                $('#offcanvas-icon-preview').css('display', 'none');
                $('#offcanvas-icon-preview-noimg').css('display', 'block');
                $("#wbb_theme_offcanvas_icon").val("");
                button.css('display', 'none');
                $('#' + id).val('').trigger('change');

            });
        }
        logo_image_remove('.offcanvas-icon-remove');

    });

})(jQuery);