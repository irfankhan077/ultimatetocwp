<?php
/**
 * The template for displaying all job reviews.
 *
 * @package nsm
 */

get_header();
the_post();

$job = new NSM_Job(get_the_ID());

get_template_part('template-parts/subheader');

?>

<article id="post-<?php the_ID(); ?>" class="<?php echo NSM_Job_Helper::get_classes( $job, 'py-30 py-sm-40 job-detail mb-0') ?>">

</article>

<div class="pb-30 pb-sm-40">
    <form enctype="multipart/form-data" data-parsley-validate id="nsm-job-form" class="container" method="POST">
        <?php wp_nonce_field( 'job_application', 'job_application_nonce' ); ?>
        <input type="hidden" id="action" name="action" value="apply_job">

        <p class="tc-l fs-12"><?php esc_html_e('All fields marked as * are required', 'nsm') ?></p>

        <div class="row">
            <div class="sm-6 mb-15">
                <label><?php esc_html_e('Full Name', 'nsm') ?> <em>*</em></label>
                <input type="text" name="fname" required placeholder="<?php echo esc_attr__('First Name', 'nsm')  ?>">
            </div>
            <div class="sm-6 mb-15">
                <label><?php esc_html_e('Phone Number', 'nsm') ?> <em>*</em> </label>
                <input type="text" required name="phone" placeholder="<?php echo esc_attr__('Phone Number', 'nsm')  ?>">
            </div>
            <div class="sm-6 mb-15">
                <label><?php esc_html_e('Email Address', 'nsm') ?> <em>*</em></label>
                <input required type="email" name="email" placeholder="<?php echo esc_attr__('Email Address', 'nsm')  ?>">
            </div>
            <div class="sm-6 mb-15">
                <label><?php esc_html_e('Subject', 'nsm') ?> <em>*</em></label>
                <input required type="text" name="subject" value="<?php echo esc_attr__('I would like to apply the for ', 'nsm') . get_the_title(); ?>" placeholder="<?php echo esc_attr__('Subject', 'nsm') ?>">
            </div>

        </div>

        <div class="mb-20">
            <label for="resume">
                <span class="d-block mb-10"><?php esc_html_e('Upload your resume', 'nsm') ?></span>
                <input required accept=".pdf,.doc,.docx" type="file" name="resume" id="resume">
            </label>
            <span class="d-block fs-12 tc-l">doc, docx, pdf <?php esc_html_e('files allowed', 'nsm') ?></span>
        </div>

        <label><?php esc_html_e('Your Message', 'nsm') ?> <em>*</em></label>
        <textarea required class="mb-15" name="message" cols="30" rows="10"></textarea>

        <button type="submit" class="submit-contact btn btn-primary"><?php esc_html_e('Apply', 'nsm') ?></button>

    </form>
</div>
	
<?php
if ($modules = get_field('modules')) :
    get_template_part('template-parts/loop/modules', null, ['modules' => $modules]);
endif;
get_footer(); 
?>