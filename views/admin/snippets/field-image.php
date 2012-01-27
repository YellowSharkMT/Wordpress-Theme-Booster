<?php
/**
 * Custom Field Type Image :: Admin snippet
 *
 * Expecting the following vars from TB_Template:
 *
 * $key         string  the custom field name
 * $value       string  the value of the custom field
 * $title       string  (optional) the label text
 * $note        string  (optional) a note beneath the input button
 * $div_class   string  (optional) a class to attach to the container div
 * $div_id      string  (optional) an id to attach to the container div
 */

?>
<div class="custom_field_type_image <?php echo !empty($div_class)?$div_class:'';?>" <?php echo !empty($div_id)?'id="'.$div_id.'"':'';?>>

    <?php if(!empty($title)):?><label for="<?php echo $key; ?>"><strong><?php echo $title; ?></strong><br/><?php endif; ?>

    <img src="<?php echo $value; ?>" width="75"/>

    <input id="<?php echo $key; ?>" type="text" size="36" name="<?php echo $key; ?>" value="<?php echo $value; ?>" />

    <?php if(!empty($title)):?></label><?php endif; ?>

    <br/>

    <input id="upload_button_<?php echo $key; ?>" type="button" value="Upload/Select Image" />
</label>
</div>