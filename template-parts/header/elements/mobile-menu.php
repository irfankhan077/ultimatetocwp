<div class="mm px-30 py-30 p-fixed bg-w d-block d-md-none">
    <div class="site-branding pb-15">
        <?php nsm_get_custom_logo(); ?>
    </div>
    <?php 
    wp_nav_menu( array( 'theme_location' => 'mobile' ) ); 
    get_template_part('template-parts/header/elements/contact');
    ?>
</div>
<div class="mm-overlay p-fixed d-block d-md-none mm-trigger"></div>