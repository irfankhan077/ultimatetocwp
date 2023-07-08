<?php

class NSM_Service_Actions{

    /**
	* Class constructor.
	*
	* @since 1.0.0
	*/
	public function __construct(){
        add_action( 'wp_footer', [$this, 'enqueue_service_styles'] );
        add_action( 'wp_head', [$this, 'service_schema']);
	}

    /**
     * Enqueue the css specific for service & faq layouts.
     * 
     * @since 1.0.0
     */
    public function enqueue_service_styles(){

        // Singular service or booking page Scripts
        if( is_singular('service') )
        wp_enqueue_style( "service-single", NSM_URI . "/assets/css/service/service-single.css", array(), NSM_VERSION);
        
    }

    /**
    * Print the Service schema markup in the service details page
    *
    * @since 1.0.0
    */
    public function service_schema(){

        if(!is_singular('service'))
        return false;

        get_template_part( 'template-parts/schema/service' );

    }

}