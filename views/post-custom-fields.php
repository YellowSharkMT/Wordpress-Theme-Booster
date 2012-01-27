<?php

$app = new ThemeBooster();
$fields = $app->get_custom_field_values();

?>

<ul>
    <?php foreach($fields as $key => $value): ?>
    <li>
        <h4><?php echo $key; ?>:</h4>
        <?php if(preg_match('/^tb_content_box_[0-9]+$/', $key)): ?>
            <?php echo apply_filters('the_content', $value); ?>
        <?php else: ?>
            <?php echo $value; ?>
        <?php endif; ?>


        <?php /*
        <?php if(preg_match('/^tb_content_box_[0-9]+$/', $key)): ?>
            <?php echo apply_filters('the_content', $value); ?>
        <?php elseif(preg_match('/^tb_img_[0-9]+$/', $key)): ?>
            <img src="<?php echo $value; ?>" alt="" />
        <?php else: ?>
            <?php echo $value; ?>
        <?php endif; ?>
        */ ?>

    </li>
    <?php endforeach; ?>
</ul>
