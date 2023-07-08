<?php

class NSM_Job_Actions{

    /**
	* Class constructor.
	*
	* @since 1.0.0
	*/
	public function __construct(){
        add_action( 'wp_footer', [$this, 'enqueue_job_styles'] );
        
        add_action( 'wp_ajax_nopriv_apply_job', [$this, 'apply_job'] );
        add_action( 'wp_ajax_apply_job', [$this, 'apply_job'] );
	}

    /**
     * Handler for applying to a job.
     * 
     * @since 1.0.0
     */
    public function apply_job(){

        if( !wp_verify_nonce( $_POST['job_application_nonce'], 'job_application' ) )
        wp_send_json_error( ['message' => 'Invalid Nonce'] );

        $data = [
            'fname'     => sanitize_text_field( $_POST['fname'] ),
            'phone'     => sanitize_text_field( $_POST['phone'] ),
            'email'     => sanitize_text_field( $_POST['email'] ),
            'subject'   => sanitize_text_field( $_POST['subject'] ),
            'message'   => sanitize_text_field( $_POST['message'] ),
        ];
        
        $data = array_filter($data);

        if( !isset($_FILES['resume']) )
        wp_send_json_error( ['message' => __('Something went wrong while uploading your resume', 'nsm')] );

        require_once( ABSPATH . 'wp-admin/includes/image.php' );
        require_once( ABSPATH . 'wp-admin/includes/file.php' );
        require_once( ABSPATH . 'wp-admin/includes/media.php' );

        // Set post ID to attach uploaded image to specific post
        $attachment_id = media_handle_upload('resume', 0);

        $data['file_url'] = wp_get_attachment_url( $attachment_id );
        $data['resume'] = $attachment_id;

        // Let's insert the submission
        $submission = new NSM_Submission('apply-job');
        if( $submission->insert_apply_job( $data ) ){

            // Let's send an email to client and admin
            $on_job_application_admin = get_field('on_job_application_admin', 'option');

            NSM_Emails::send( $data, 'on_job_application', $on_job_application_admin['recipients'], $on_job_application_admin['subject'] );
            wp_send_json_success( ['data' => $_FILES['resume'], 'message' => __('We have received your application, and will be getting back to you shortly.', 'nsm') ] );

        }

        wp_send_json_error( ['message' => 'We couldnt process your application. Please try again later.' ] );

    }

    /**
     * Enqueue the css specific for job layouts.
     * 
     * @since 1.0.0
     */
    public function enqueue_job_styles(){

        // Singular job page Scripts
        if( is_singular('job') ){
            wp_enqueue_style( "job-single", NSM_URI . "/assets/css/job/job-single.css", array(), NSM_VERSION);
            wp_enqueue_script( 'job-single', NSM_URI . '/assets/js/job/job-single.js', array(), NSM_VERSION, true );
        }
        
    }

}