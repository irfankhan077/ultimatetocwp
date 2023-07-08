<?php if( $background_image = nsm()->subheader->get_background_image() ){ ?>
<style>
    .module-subheader{
        background-image: url(<?php echo esc_attr($background_image) ?>);
    }
</style>
<?php } ?>
<div class="py-40 lx-module module-subheader text-center">
   
    <div class="p-relative container">
        <h1 class="mb-0 pb-15 pb-sm-0 p-relative entry-title tc-w"><?php echo do_shortcode(nsm()->subheader->get_title()) ?></h1>
        <?php if($subtitle = nsm()->subheader->get_subtitle()){ ?>
        <p class="mt-15 mb-0 tc-w fs-16 fs-md-18"><?php echo do_shortcode($subtitle) ?></p>
        <?php } ?>
    </div>

</div>
