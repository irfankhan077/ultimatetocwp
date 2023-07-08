<?php

/**
 * Register the Location taxonomy
 * 
 * @since 1.0.0
 */
function nsm_job_location_tax(){
    $location_labels = array(
        'name'              => sprintf( _x( '%s Locations', 'taxonomy general name', 'nsm' ), 'Job' ),
        'singular_name'     => sprintf( _x( '%s Location', 'taxonomy singular name', 'nsm' ), 'Job' ),
        'search_items'      => sprintf( __( 'Search %s Locations', 'nsm' ), 'Job' ),
        'all_items'         => sprintf( __( 'All %s Locations', 'nsm' ), 'Job' ),
        'parent_item'       => sprintf( __( 'Parent %s Location', 'nsm' ), 'Job' ),
        'parent_item_colon' => sprintf( __( 'Parent %s Location:', 'nsm' ), 'Job' ),
        'edit_item'         => sprintf( __( 'Edit %s Location', 'nsm' ), 'Job' ),
        'update_item'       => sprintf( __( 'Update %s Location', 'nsm' ), 'Job' ),
        'add_new_item'      => sprintf( __( 'Add New %s Location', 'nsm' ), 'Job' ),
        'new_item_name'     => sprintf( __( 'New %s Location Name', 'nsm' ), 'Job' ),
        'menu_name'         => __( 'Locations', 'nsm' ),
    );
    
    $location_args = array(
        'public'       => false,
        'hierarchical' => true,
        'labels'       => $location_labels,
        'show_ui'      => true,
        'query_var'    => 'job_location',
        'rewrite'      => array( 'slug' => 'locations' )
    );
    register_taxonomy( 'job_location', ['job'], $location_args );
}
add_action('init',  'nsm_job_location_tax' );