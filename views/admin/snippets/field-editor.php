<?php
/**
 * Custom Field Type Editor :: Admin snippet
 *
 * Expecting the following vars from TB_Template:
 *
 * $key         string  the custom field's internal name (used as the field name, & id, and links in to some js also
 * $value       string  the value of the custom field
 * $title       string  (optional) goes above the editor, as an H4 element
 * $div_class   string  (optional) a class to attach to the container div
 * $div_id      string  (optional) an id to attach to the container div
 */

?>

<div class="custom_field_type_editor <?php echo !empty($div_class)?$div_class:'';?>" <?php echo !empty($div_id)?'id="'.$div_id.'"':'';?>>

    <?php if(!empty($title)):?><h4><?php echo $title; ?></h4><?php endif; ?>

    <?php wp_editor($value, $key, $prev_id = 'title', $media_buttons = true); ?>

</div><!-- .custom_field_type_editor -->