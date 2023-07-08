<form data-parsley-validate id="nsm-cf-form" class="nsm-gtm_contact" method="POST">
    <?php wp_nonce_field( 'contact', 'contact_nonce' ); ?>
    <input type="hidden" id="action" name="action" value="contact">

    <p class="tc-l fs-12"><?php esc_html_e('All fields marked as * are required', 'nsm') ?></p>

    <div class="row">
        <div class="sm-6 mb-15">
            <label><?php esc_html_e('Full Name', 'nsm') ?> <em>*</em></label>
            <input type="text" name="fname" required placeholder="<?php echo esc_attr__('First Name', 'nsm')  ?>">
        </div>
        <div class="sm-6 mb-15">
            <label><?php esc_html_e('Phone Number', 'nsm') ?></label>
            <input type="text" name="phone" placeholder="<?php echo esc_attr__('Phone Number', 'nsm')  ?>">
        </div>
        <div class="sm-6 mb-15">
            <label><?php esc_html_e('Email Address', 'nsm') ?> <em>*</em></label>
            <input required type="email" name="email" placeholder="<?php echo esc_attr__('Email Address', 'nsm')  ?>">
        </div>
        <div class="sm-6 mb-15">
            <label><?php esc_html_e('Subject', 'nsm') ?> <em>*</em></label>
            <input required type="text" name="subject" placeholder="<?php echo esc_attr__('Subject', 'nsm') ?>">
        </div>

    </div>

    <label><?php esc_html_e('Your Message', 'nsm') ?> <em>*</em></label>
    <textarea required class="mb-15" name="message" cols="30" rows="10"></textarea>

    <button type="submit" class="submit-contact btn btn-primary"><?php esc_html_e('Submit', 'nsm') ?></button>

</form>