<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class NSM_Service_Helper{

    /**
     * Get classes to add to the service.
     * 
     * @param object $service - The service object
     * @param string $extra - Any extra classes we need to add
     *
     * @since 1.0.0
     */
    public static function get_classes($service, $extra = ''){
        $classes = [];

        $classes[] = 'service';
        $classes[] = 'status-'.$service->get_service_status();
        $classes[] = $extra;

        return implode(' ', $classes);
    }

    /**
     * Return the number of columns for a service.
     * 
     * @param string $override - The override option per page
     * 
     * @since 1.0.0
     */
    public static function get_columns( $override = null ){
        return $override != null ? $override : get_field('service_columns', 'option');
    }

    /**
     * Returns the layout of the services for a given page, or from global settings.
     * 
     * @param string $override - The override option per page
     * 
     * @since 1.0.0
     */
    public static function get_layout( $override = null ){
        return $override != null ? $override : get_field('service_layout', 'option');
    }

    /**
     * Get Services
     *
     * Retrieve services from the database.
     *
     * @since 1.0.0
     * @param array $args Arguments passed to get services
     * @return NSM_Service[] $services Services retrieved from the database
     */
    public static function get_services( $args = array() ) {

        // Ignore the arguments with null values
        $args = array_filter($args);

        $services = new NSM_Service_Query( $args );
        return $services->get_services();
    }

    /**
     * Get search query parameters
     *
     * @since 1.0
     */
    public static function get_service_search_args(){
        $args = [];

        $args['s']                  = isset($_GET['service_s']) ? sanitize_text_field( $_GET['service_s'] ) : null;
        $args['order_by']           = isset($_GET['order_by']) ? $_GET['order_by'] : null;

        return $args;
    }

    /**
     * Returns the custom query options set from Service listings module.
     * 
     * @param int @meta_data - The options from the service listing module.
     * 
     * @since 1.0.0
     */
    public static function get_service_listing_query( $meta_data ){

        $query_args = [];

        $query_args['number']   = !empty($meta_data['services_per_page']) ? intval($meta_data['services_per_page']) : 20;
        $query_args['order_by'] = !empty($meta_data['order_by']) ? $meta_data['order_by'] : 'ID';

        // If by custom services
        if( $meta_data['list_type'] == 2 ){

            $query_args['post__in'] = !empty($meta_data['selected_services']) ? $meta_data['selected_services'] : null;

        }

        return $query_args;

    }

}