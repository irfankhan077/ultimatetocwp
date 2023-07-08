<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Class responsible for job custom post type functionality
 * 
 * @since 1.0.0
 *
 */
class NSM_Job{

    /**
     * The job ID.
     *
     * @since 1.0.0
     */
    public $ID = 0;

    /**
     * Post Status.
     *
     * @since 1.0.0
     */
    protected $post_status;

    /**
     * Post date.
     *
     * @since 1.0.0
     */
    protected $date;

    /**
     * Class constructor.
     *
     * @since 1.0.0
     */
    public function __construct( $job_id ){
        $this->setup_job( $job_id );
    }

    /**
     * Set all the job data.
     *
     * @since 1.0.0
     */
    private function setup_job( $job_id ){

        if ( empty( $job_id ) ) {
			return false;
		}

        $job = get_post( $job_id );

        // job ID
        $this->ID               = absint( $job_id );

        // job post info
		$this->post_status      = $job->post_status;
		$this->date             = $job->post_date;

    }

    /**
     * Get job status
     *
     * @since 1.0.0
     */
    public function get_job_status(){
        return $this->post_status;
    }

    /**
     * Get job publish date
     *
     * @since 1.0.0
     */
    public function get_job_date(){
        return $this->date;
    }

}
