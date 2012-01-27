<?php

global $post, $post_ID;

$app = new ThemeBooster();
$fields = $app->get_custom_field_values($post_ID);

$custom_field_tpl = new TB_Template();

$custom_field_editor_view = 'admin/snippets/field-editor';
$custom_field_link_view = 'admin/snippets/field-link';
$custom_field_image_view = 'admin/snippets/field-image';


wp_nonce_field( 'tb_app', 'TB_NONCE' );

?>
<div class="tb_wrapper">
    <table class="form-table" width="100%" cellpadding="0" cellspacing="0">

        <!-- Example of Content Editor -->
        <tr class="custom-field-content">
            <td colspan="2">
                <!-- content editor: tb_content_box_1 -->
                <?php
                $data = array(
                    'key'=>'tb_content_box_1',
                    'value'=>$fields->tb_content_box_1,
                    'title'=>'Content Box 1',
                );
                echo $custom_field_tpl->get_view($custom_field_editor_view, $data);
                ?>
            </td>
        </tr>

        <!-- Example of Custom Image Uploads -->

        <tr><td colspan="2"><h4>Custom Image Uploads</h4></td></tr>

        <tr class="custom-field-images">
            <th scope="row"><label for="tb_img_1">Image 1:</label></th>
            <td>
                <?php
                $data = array(
                    'key'=>'tb_img_1',
                    'value'=>$fields->tb_img_1,
                );
                echo $custom_field_tpl->get_view($custom_field_image_view, $data);
                ?>
            </td>
        </tr>        <tr class="custom-field-images">
                    <th scope="row"><label for="tb_img_2">Image 1:</label></th>
                    <td>
                        <?php
                        $data = array(
                            'key'=>'tb_img_2',
                            'value'=>$fields->tb_img_2,
                        );
                        echo $custom_field_tpl->get_view($custom_field_image_view, $data);
                        ?>
                    </td>
                </tr>

        <!-- Example of a set of relevant links (text/url fields) -->
        <tr><td colspan="2"><h4>Custom Links</h4></td></tr>

        <tr>
            <td colspan="2">
                <table cellpadding="0" cellspacing="0" class="form-table">

                    <?php for($i=1;$i<=6;$i = $i + 2): ?>
                        <tr>
                            <td width="50%">
                                <?php
                                $index = $i;
                                $text_key = 'tb_link_' . $index . '_text';
                                $url_key = 'tb_link_' . $index . '_url';

                                $data = array(
                                    'title' => 'Link #' . $index,
                                    'value_text' => $fields->$text_key,
                                    'value_url' => $fields->$url_key,
                                    'key' => 'tb_link_' . $index,
                                );
                                $custom_field_tpl->get_view($custom_field_link_view, $data); ?>
                            </td>

                            <td width="50%">
                                <?php
                                $index = $i+1;
                                $text2_key = 'tb_link_' . $index . '_text';
                                $url2_key = 'tb_link_' . $index . '_url';

                                $data2 = array(
                                    'title' => 'Link #' . $index,
                                    'value_text' => $fields->$text2_key,
                                    'value_url' => $fields->$url2_key,
                                    'key' => 'tb_link_' . $index,
                                );
                                $custom_field_tpl->get_view($custom_field_link_view, $data2); ?>
                            </td>
                        </tr>
                        <?php endfor; ?>
                </table>
            </td>
        </tr>

    </table>
</div><!-- .tb_wrapper -->