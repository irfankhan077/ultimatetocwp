<?php

class NSM_Submission_Actions{

    public function __construct(){

        add_action( 'wp_ajax_nopriv_contact', [$this, 'contact'] );
        add_action( 'wp_ajax_contact', [$this, 'contact'] );
        
        add_action( 'manage_submission_posts_custom_column' , [$this, 'submission_admin_table_columns_data'], 10, 2 );
		add_filter( 'manage_submission_posts_columns', [$this, 'submission_admin_table_columns'] );

        add_action( 'admin_menu', [$this, 'append_submission_count'] );

    }

    /**
    * Contact form function handler.
    *
    * @since 1.0.0
    */
    public function contact(){

        if( !wp_verify_nonce( $_POST['contact_nonce'], 'contact' ) )
        wp_send_json_error( ['message' => 'Invalid Nonce'] );

        $data = [
            'fname'     => sanitize_text_field( $_POST['fname'] ),
            'phone'     => sanitize_text_field( $_POST['phone'] ),
            'email'     => sanitize_text_field( $_POST['email'] ),
            'subject'   => sanitize_text_field( $_POST['subject'] ),
            'message'   => sanitize_text_field( $_POST['message'] ),
        ];
        
        $data = array_filter($data);

        // Let's insert the submission
        $submission = new NSM_Submission('contact');
        if( $submission->insert_contact( $data ) ){

            // Let's send an email to client and admin
            $on_contact_admin = get_field('on_contact_admin', 'option');

            $data['role'] = 'admin';
            NSM_Emails::send( $data, 'on_contact', $on_contact_admin['recipients'], $on_contact_admin['subject'] );
            wp_send_json_success( ['message' => __('We have received your message, and will be getting back to you shortly.', 'nsm') ] );

        }

        wp_send_json_error( ['message' => 'We couldnt process your trade. Please try again later.' ] );

    }
    
    public function append_submission_count() {
        global $menu;

        $submissions = NSM_Submission_Helper::get_submissions([
            'submission_status' => 'pending'
        ]);

        $found = isset($submissions['found_posts']) ? $submissions['found_posts'] : 0;
        
        foreach ( $menu as $key => $value ) {
            if ( $menu[$key][2] == 'edit.php?post_type=submission' ) {
                $menu[$key][0] .= ' <span class="update-plugins">' . $found . '</span> ';
                return;
            }
        }

    }

    // Add the custom columns to the booking post type:
	public function submission_admin_table_columns($columns) {
		$columns['submission_type'] = __( 'Type', 'nsm' );
		$columns['submission_status'] = __( 'Status', 'nsm' );

		return $columns;
	}

	// Add the data to the custom columns for the booking post type:
	public function submission_admin_table_columns_data( $column, $post_id ) {
		switch ( $column ) {

			case 'submission_type' :
				echo get_field('submission_type', $post_id );
				break;
			case 'submission_status' :
				$status = get_field('status', $post_id );
				echo '<span class="nsm-status status-'.$status.'">'.$status.'</span>';
				break;
		}
	}
    
}