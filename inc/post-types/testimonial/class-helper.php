<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class NSM_Testimonial_Helper{

    /**
     * Get classes to add to the testimonial.
     * 
     * @param object $testimonial - The testimonial object
     * @param string $extra - Any extra classes we need to add
     *
     * @since 1.0.0
     */
    public static function get_classes($testimonial, $extra = ''){
        $classes = [];

        $classes[] = 'testimonial';
        $classes[] = 'status-'.$testimonial->get_testimonial_status();
        $classes[] = $extra;

        return implode(' ', $classes);
    }

    /**
     * Return the number of columns for a testimonial.
     * 
     * @param string $override - The override option per page
     * 
     * @since 1.0.0
     */
    public static function get_columns( $override = null ){
        return $override != null ? $override : get_field('testimonial_columns', 'option');
    }

    /**
     * Returns the layout of the testimonials for a given page, or from global settings.
     * 
     * @param string $override - The override option per page
     * 
     * @since 1.0.0
     */
    public static function get_layout( $override = null ){
        return $override != null ? $override : get_field('testimonial_layout', 'option');
    }

    /**
     * Get Testimonials
     *
     * Retrieve testimonials from the database.
     *
     * @since 1.0.0
     * @param array $args Arguments passed to get testimonials
     * @return NSM_Testimonial[] $testimonials Testimonials retrieved from the database
     */
    public static function get_testimonials( $args = array() ) {

        // Ignore the arguments with null values
        $args = array_filter($args);

        $testimonials = new NSM_Testimonial_Query( $args );
        return $testimonials->get_testimonials();
    }

    /**
     * Get search query parameters
     *
     * @since 1.0
     */
    public static function get_testimonial_search_args(){
        $args = [];

        $args['order_by'] = isset($_GET['order_by']) ? $_GET['order_by'] : null;

        return $args;
    }

    /**
     * Returns the custom query options set from Testimonial listings module.
     * 
     * @param int @meta_data - The options from the testimonial listing module.
     * 
     * @since 1.0.0
     */
    public static function get_testimonial_listing_query( $meta_data ){

        $query_args = [];

        $query_args['number']   = !empty($meta_data['testimonials_per_page']) ? intval($meta_data['testimonials_per_page']) : 20;
        $query_args['order_by'] = !empty($meta_data['order_by']) ? $meta_data['order_by'] : 'ID';

        // If by custom testimonials
        if( $meta_data['list_type'] == 2 ){

            $query_args['post__in'] = !empty($meta_data['selected_testimonials']) ? $meta_data['selected_testimonials'] : null;

        }

        return $query_args;

    }

}