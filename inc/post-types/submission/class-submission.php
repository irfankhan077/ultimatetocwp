<?php

class NSM_Submission{

    private $id;

    private $type;

    private $submission_id;

    private $ip_address;

    private $date_issued;

    private $key;

    private $args;

    public function __construct( $type = null ){
        $this->setup_submission($type);
    }

    public function setup_submission( $type ){

        $this->id               = null;

        $this->type             = $type;

        $this->submission_id    = $this->type != null ? rand( 10, 99999 ) : null;
        
        $this->ip_address       = $this->type != null ? NSM_Helper::get_ip_address() : null;

        $this->date_issued      = $this->type != null ? date("Y-m-d") : null;

        $this->key              = $this->type != null ? $this->generate_key() : null;

        $this->args             = $this->type != null ? $this->setup_query_args() : null;

    }

    public function insert_apply_job( $data ){

        if( $this->id = wp_insert_post( $this->args ) ){

            update_field('submission_type', $this->type, $this->id);

            // Let's update the name key.
            $data['name'] = $data['fname'];

            $this->process_submission_meta();
            $this->process_client_meta( $data );
            
            update_field('application_info', [
                'application_subject'  => $data['subject'], 
                'application_message'  => $data['message'], 
                'resume'  => $data['resume'], 
            ], $this->id);

        }

        return $this->id;


    }

    public function insert_contact( $data ){

        if( $this->id = wp_insert_post( $this->args ) ){

            update_field('submission_type', $this->type, $this->id);

            // Let's update the name key.
            $data['name'] = $data['fname'];

            $this->process_submission_meta();
            $this->process_client_meta( $data );
            
            update_field('contact_info', [
                'subject' => $data['subject'], 
                'message' => $data['message'],
            ], $this->id);

        }

        return $this->id;

    }

    /**
     * Function to update the default acf data for the submission.
     * 
     * @since 1.0.0
     */
    private function process_submission_meta(){

        $fields = [
            'submission_id'             => $this->submission_id,
            'submission_key'            => $this->key,
            'submission_ip_address'     => $this->ip_address,
            'submission_date_issued'    => $this->date_issued
        ];

        update_field('status', 'pending', $this->id);
        update_field('submission_meta', $fields, $this->id);

    }

    /**
     * Function to update the submission client info.
     * 
     * @param array $data - The submission data.
     * 
     * @since 1.0.0
     */
    private function process_client_meta( $data ){

        $fields = [
            'email'             => $data['email'],
            'full_name'         => $data['name'],
            'phone_number'      => $data['phone'],
        ];

        update_field('customer_details', $fields, $this->id);

    }

    /**
     * Function to generate an encrypted key from the submission id, start and end dates.
     * 
     * @param int $submission_id - the submission id.
     * @param string $start_date - the start date
     * @param string $end_date - the end date
     * 
     * @since 1.0.0
     */
    private function generate_key(){
        return md5($this->submission_id . '-' . $this->type . '-' . $this->ip_address);
    }

    private function setup_query_args(){
        return array(
            'post_author'    => 1,
            'post_title'     => '#'.$this->submission_id . ' - ' . $this->date_issued,
            'post_name'      => $this->submission_id,
            'post_content'   => '',
            'post_status'    => 'publish',
            'post_type'      => 'submission',
        );
    }

}