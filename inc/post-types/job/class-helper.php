<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class NSM_Job_Helper{

    /**
     * Get classes to add to the job.
     * 
     * @param object $job - The job object
     * @param string $extra - Any extra classes we need to add
     *
     * @since 1.0.0
     */
    public static function get_classes($job, $extra = ''){
        $classes = [];

        $classes[] = 'job';
        $classes[] = 'status-'.$job->get_job_status();
        $classes[] = $extra;

        return implode(' ', $classes);
    }

    /**
     * Return the number of columns for a job.
     * 
     * @param string $override - The override option per page
     * 
     * @since 1.0.0
     */
    public static function get_columns( $override = null ){
        return $override != null ? $override : get_field('job_columns', 'option');
    }

    /**
     * Returns the layout of the jobs for a given page, or from global settings.
     * 
     * @param string $override - The override option per page
     * 
     * @since 1.0.0
     */
    public static function get_layout( $override = null ){
        return $override != null ? $override : get_field('job_layout', 'option');
    }

    /**
     * Get Jobs
     *
     * Retrieve jobs from the database.
     *
     * @since 1.0.0
     * @param array $args Arguments passed to get jobs
     * @return NSM_Job[] $jobs Jobs retrieved from the database
     */
    public static function get_jobs( $args = array() ) {

        // Ignore the arguments with null values
        $args = array_filter($args);

        $jobs = new NSM_Job_Query( $args );
        return $jobs->get_jobs();
    }

    /**
     * Get search query parameters
     *
     * @since 1.0
     */
    public static function get_job_search_args(){
        $args = [];

        $args['s']        = isset($_GET['property_s']) ? sanitize_text_field( $_GET['property_s'] ) : null;
        $args['order_by'] = isset($_GET['order_by']) ? $_GET['order_by'] : null;

        return $args;
    }

    /**
     * Returns the custom query options set from Job listings module.
     * 
     * @param int @meta_data - The options from the job listing module.
     * 
     * @since 1.0.0
     */
    public static function get_job_listing_query( $meta_data ){

        $query_args = [];

        $query_args['number']   = !empty($meta_data['jobs_per_page']) ? intval($meta_data['jobs_per_page']) : 20;
        $query_args['order_by'] = !empty($meta_data['order_by']) ? $meta_data['order_by'] : 'ID';

        // If by custom jobs
        if( $meta_data['list_type'] == 2 ){

            $query_args['post__in'] = !empty($meta_data['selected_jobs']) ? $meta_data['selected_jobs'] : null;

        }elseif( $meta_data['list_type'] == 3 ){
            $query_args['job_location']    = !empty($meta_data['job_location']) ? $meta_data['job_location'] : [];
        }

        return $query_args;

    }

}