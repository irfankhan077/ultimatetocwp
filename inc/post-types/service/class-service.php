<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Class responsible for service custom post type functionality
 * 
 * @since 1.0.0
 *
 */
class NSM_Service{

    /**
     * The service ID.
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
    public function __construct( $service_id ){
        $this->setup_service( $service_id );
    }

    /**
     * Set all the service data.
     *
     * @since 1.0.0
     */
    private function setup_service( $service_id ){

        if ( empty( $service_id ) ) {
			return false;
		}

        $service = get_post( $service_id );

        // service ID
        $this->ID               = absint( $service_id );

        // service post info
		$this->post_status      = $service->post_status;
		$this->date             = $service->post_date;

    }

    /**
     * Get service status
     *
     * @since 1.0.0
     */
    public function get_service_status(){
        return $this->post_status;
    }

    /**
     * Get service publish date
     *
     * @since 1.0.0
     */
    public function get_service_date(){
        return $this->date;
    }

}
