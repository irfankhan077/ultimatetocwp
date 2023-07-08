<?php
$options            = $args['options'];
$title              = $options['page_h1_title'] ? $options['page_h1_title'] : nsm()->subheader->get_title();
$subtitle           = $options['hero_text'] ? $options['hero_text'] : nsm()->subheader->get_subtitle();
$background_image   = $options['background_image'] ? $options['background_image'] : nsm()->subheader->get_background_image();
?>
<?php if( $background_image ){ ?>
<style>
    .module-subheader{
        background-image: url(<?php echo esc_attr($background_image) ?>);
    }
</style>
<?php } ?>
<div class="p-relative container">
    <h1 class="mb-0 p-relative entry-title tc-w"><?php echo do_shortcode($title) ?></h1>
    <?php if($subtitle){ ?>
    <p class="mt-15 mb-0 tc-w fs-16 fs-md-18"><?php echo do_shortcode($subtitle); ?></p>
    <?php } ?>
</div>