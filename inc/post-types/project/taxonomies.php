<?php

/**
 * Register the Type taxonomy
 * 
 * @since 1.0.0
 */
function nsm_project_type_tax(){
    $type_labels = array(
        'name'              => sprintf( _x( '%s Types', 'taxonomy general name', 'nsm' ), 'Project' ),
        'singular_name'     => sprintf( _x( '%s Type', 'taxonomy singular name', 'nsm' ), 'Project' ),
        'search_items'      => sprintf( __( 'Search %s Types', 'nsm' ), 'Project' ),
        'all_items'         => sprintf( __( 'All %s Types', 'nsm' ), 'Project' ),
        'parent_item'       => sprintf( __( 'Parent %s Type', 'nsm' ), 'Project' ),
        'parent_item_colon' => sprintf( __( 'Parent %s Type:', 'nsm' ), 'Project' ),
        'edit_item'         => sprintf( __( 'Edit %s Type', 'nsm' ), 'Project' ),
        'update_item'       => sprintf( __( 'Update %s Type', 'nsm' ), 'Project' ),
        'add_new_item'      => sprintf( __( 'Add New %s Type', 'nsm' ), 'Project' ),
        'new_item_name'     => sprintf( __( 'New %s Type Name', 'nsm' ), 'Project' ),
        'menu_name'         => __( 'Types', 'nsm' ),
    );
    
    $type_args = array(
        'public'       => false,
        'hierarchical' => true,
        'labels'       => $type_labels,
        'show_ui'      => true,
        'query_var'    => 'project_type',
        'rewrite'      => array( 'slug' => 'types' )
    );
    register_taxonomy( 'project_type', ['project'], $type_args );
}
add_action('init',  'nsm_project_type_tax' );