<?php
/**
 * Custom Field Type Link :: Admin snippet
 *
 * Expecting the following vars from TB_Template:
 *
 * $title       string  (optional) will be in bold, above the field(s)
 * $key         string  the custom field's name
 *                          !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 *                          * note, this is a special case item, the key actually is the prefix for the stems `_text` and `_url` keys,
 *                          so only send 'tb_link_1', and then this view appends the stem. otherwise, we could shift this view to expect
 *                          different var names that are more explicit, like $key_url, $key_text.
 *                          !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 * $value_url   string  the value of the custom field
 * $value_text  string  the value of the custom field
 * $div_class   string  (optional) a class to attach to the container div
 * $div_id      string  (optional) an id to attach to the container div
 */

?>
<div class="custom_field_type_link <?php echo !empty($div_class)?$div_class:'';?>" <?php echo !empty($div_id)?'id="'.$div_id.'"':'';?>>

    <?php if(!empty($title)):?><strong class="link_box_title"><?php echo $title; ?></strong><br/><?php endif; ?>

    <label for="<?php echo $key; ?>_text">Text:</label><input id="<?php echo $key; ?>_text" type="text" placeholder="Link Title" size="36" name="<?php echo $key; ?>_text" value="<?php echo $value_text; ?>" /><br/>

    <label for="<?php echo $key; ?>_url">URL:</label><input placeholder="Link URL" id="<?php echo $key; ?>_url" type="text" size="36" name="<?php echo $key; ?>_url" value="<?php echo $value_url; ?>" />
</div>