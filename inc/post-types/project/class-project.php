<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Class responsible for project custom post type functionality
 * 
 * @since 1.0.0
 *
 */
class NSM_Project{

    /**
     * The project ID.
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
    public function __construct( $project_id ){
        $this->setup_project( $project_id );
    }

    /**
     * Set all the project data.
     *
     * @since 1.0.0
     */
    private function setup_project( $project_id ){

        if ( empty( $project_id ) ) {
			return false;
		}

        $project = get_post( $project_id );

        // project ID
        $this->ID               = absint( $project_id );

        // project post info
		$this->post_status      = $project->post_status;
		$this->date             = $project->post_date;

    }

    /**
     * Get project status
     *
     * @since 1.0.0
     */
    public function get_project_status(){
        return $this->post_status;
    }

    /**
     * Get project publish date
     *
     * @since 1.0.0
     */
    public function get_project_date(){
        return $this->date;
    }

}
