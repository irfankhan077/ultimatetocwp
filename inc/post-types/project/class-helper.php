<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class NSM_Project_Helper{

    /**
     * Get classes to add to the project.
     * 
     * @param object $project - The project object
     * @param string $extra - Any extra classes we need to add
     *
     * @since 1.0.0
     */
    public static function get_classes($project, $extra = ''){
        $classes = [];

        $classes[] = 'project';
        $classes[] = 'status-'.$project->get_project_status();
        $classes[] = $extra;

        return implode(' ', $classes);
    }

    /**
     * Return the number of columns for a project.
     * 
     * @param string $override - The override option per page
     * 
     * @since 1.0.0
     */
    public static function get_columns( $override = null ){
        return $override != null ? $override : get_field('project_columns', 'option');
    }

    /**
     * Returns the layout of the projects for a given page, or from global settings.
     * 
     * @param string $override - The override option per page
     * 
     * @since 1.0.0
     */
    public static function get_layout( $override = null ){
        return $override != null ? $override : get_field('project_layout', 'option');
    }

    /**
     * Get Projects
     *
     * Retrieve projects from the database.
     *
     * @since 1.0.0
     * @param array $args Arguments passed to get projects
     * @return NSM_Project[] $projects Projects retrieved from the database
     */
    public static function get_projects( $args = array() ) {

        // Ignore the arguments with null values
        $args = array_filter($args);

        $projects = new NSM_Project_Query( $args );
        return $projects->get_projects();
    }

    /**
     * Get search query parameters
     *
     * @since 1.0
     */
    public static function get_project_search_args(){
        $args = [];

        $args['order_by'] = isset($_GET['order_by']) ? $_GET['order_by'] : null;

        return $args;
    }

    /**
     * Returns the custom query options set from Project listings module.
     * 
     * @param int @meta_data - The options from the project listing module.
     * 
     * @since 1.0.0
     */
    public static function get_project_listing_query( $meta_data ){

        $query_args = [];

        $query_args['number']   = !empty($meta_data['projects_per_page']) ? intval($meta_data['projects_per_page']) : 20;
        $query_args['order_by'] = !empty($meta_data['order_by']) ? $meta_data['order_by'] : 'ID';

        // If by custom projects
        if( $meta_data['list_type'] == 2 ){
            $query_args['post__in'] = !empty($meta_data['selected_projects']) ? $meta_data['selected_projects'] : null;
        }elseif( $meta_data['list_type'] == 3 ){
            $query_args['project_type']    = !empty($meta_data['project_type']) ? $meta_data['project_type'] : [];
        }

        return $query_args;

    }

}