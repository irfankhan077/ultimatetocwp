<?php
$email = get_field( 'contact_email', 'option' );
$phone  = get_field( 'contact_phone', 'option' );

if( $phone || $email ){
?>
<div class="contact-info">
    <?php if($phone){ ?>
        <a class="nsm-gtm_dial" href="tel:<?php echo str_replace(' ', '', $phone); ?>"><?php esc_html_e('Call Us', 'nsm') ?></a>
    <?php } ?>
    <?php if($email){ ?>
        <a class="nsm-gtm_email" href="mailto:<?php echo str_replace(' ', '', $email); ?>"><?php esc_html_e('Send Us a Message', 'nsm') ?></a>
    <?php } ?>
</div>
<?php } ?>
<div class="social-media d-flex ai-c py-10">
    <?php get_template_part('template-parts/social-media'); ?>
</div>