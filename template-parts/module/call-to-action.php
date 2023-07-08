<?php $options = $args['options']; ?>
<?php
if($options['title']){
    get_template_part('template-parts/module/title', null, ['options' => $options['title']] ); 
}
?>
<div class="container">

    <div class="mt-25 d-sm-flex d-block">
        <?php if ($button = NSM_Module::button($options['button_one'])) : ?>
        <a href="<?php echo $button['link'] ?>" class="d-block d-sm-inline-block btn <?php echo $button['size'] . ' ' . $button['color'] ?>">
            <?php echo $button['label']; ?>
        </a>
        <?php endif; ?>
        <?php if ($button_two = NSM_Module::button($options['button_two'])) : ?>
        <a href="<?php echo $button_two['link'] ?>" class="d-block d-sm-inline-block ml-sm-15 mt-15 mt-sm-0 btn <?php echo $button_two['size'] . ' ' . $button_two['color'] ?>">
            <?php echo $button_two['label']; ?>
        </a>
        <?php endif; ?>
    </div>

</div>