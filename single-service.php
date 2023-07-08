<?php
/**
 * The template for displaying all service reviews.
 *
 * @package nsm
 */

get_header();
the_post();

$service = new NSM_Service(get_the_ID());

get_template_part('template-parts/subheader');

?>

<article id="post-<?php the_ID(); ?>" class="<?php echo NSM_Service_Helper::get_classes( $service, 'pt-30 pb-10 pt-sm-40 pb-sm-20 service-detail mb-0') ?>">
    <div class="entry-content fs-16 fs-sm-18 container">
        <?php the_content() ?>
    </div>
</article>

<div class="pb-30 pb-sm-40">
    <form data-parsley-validate id="nsm-cf-form" class="container" method="POST">
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
                <input required type="text" name="subject" value="<?php echo esc_attr__('I have an enquiry for ', 'nsm') . get_the_title(); ?>" placeholder="<?php echo esc_attr__('Subject', 'nsm') ?>">
            </div>

        </div>

        <label><?php esc_html_e('Your Message', 'nsm') ?> <em>*</em></label>
        <textarea required class="mb-15" name="message" cols="30" rows="10"></textarea>

        <button type="submit" class="submit-contact btn btn-primary"><?php esc_html_e('Submit', 'nsm') ?></button>

    </form>
</div>
	
<?php
if ($modules = get_field('modules')) :
    get_template_part('template-parts/loop/modules', null, ['modules' => $modules]);
endif;
get_footer(); 
?>