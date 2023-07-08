<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Class responsible for testimonial custom post type functionality
 * 
 * @since 1.0.0
 *
 */
class NSM_Testimonial{

    /**
     * The testimonial ID.
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
    public function __construct( $testimonial_id ){
        $this->setup_testimonial( $testimonial_id );
    }

    /**
     * Set all the testimonial data.
     *
     * @since 1.0.0
     */
    private function setup_testimonial( $testimonial_id ){

        if ( empty( $testimonial_id ) ) {
			return false;
		}

        $testimonial = get_post( $testimonial_id );

        // testimonial ID
        $this->ID               = absint( $testimonial_id );

        // testimonial post info
		$this->post_status      = $testimonial->post_status;
		$this->date             = $testimonial->post_date;

    }

    /**
     * Get testimonial status
     *
     * @since 1.0.0
     */
    public function get_testimonial_status(){
        return $this->post_status;
    }

    /**
     * Get testimonial publish date
     *
     * @since 1.0.0
     */
    public function get_testimonial_date(){
        return $this->date;
    }

}
