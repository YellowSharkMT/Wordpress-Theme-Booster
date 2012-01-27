(function($){
    $(document).ready(function() {
        // cache original version of send_to_editor
        var original_send_to_editor = window.send_to_editor;
       // var original_savesend_button_text = $('td.savesend > input.button')[0].val();

        $('body.wp-admin div.custom_field_type_image').each(function(z, el){
            var $el = $(el),
                $field = $('input[type=text]', $el),
                $field_button = $('input[type=button]', $el);

            $field_button.click(function(){
                $('td.savesend > input.button').val('Select/Insert this Image');
                tb_show('', 'media-upload.php?type=image&TB_iframe=true');
                window.send_to_editor = function(html) {
                    img_url = $('img',html).attr('src');
                    $field
                        .val(img_url)
                        .siblings('img').attr('src',img_url).removeClass('empty-img');
                    tb_remove();
                }
                return false;
            });

        });

        // thanks, thickbox! they kindly set up an event we can bind to:
        $(document).bind('tb_unload',function(){
            // reset the original send_to_editor function. VERY important.
            window.send_to_editor = original_send_to_editor;
            //$('td.savesend > input.button').val(original_savesend_button_text);
        })
    });
}(jQuery));