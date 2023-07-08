<?php

/**
 * Register the Category taxonomy
 * 
 * @since 1.0.0
 */
function nsm_module_category_tax(){
    $category_labels = array(
        'name'              => sprintf( _x( '%s Categories', 'taxonomy general name', 'nsm' ), 'Module' ),
        'singular_name'     => sprintf( _x( '%s Category', 'taxonomy singular name', 'nsm' ), 'Module' ),
        'search_items'      => sprintf( __( 'Search %s Categories', 'nsm' ), 'Module' ),
        'all_items'         => sprintf( __( 'All %s Categories', 'nsm' ), 'Module' ),
        'parent_item'       => sprintf( __( 'Parent %s Category', 'nsm' ), 'Module' ),
        'parent_item_colon' => sprintf( __( 'Parent %s Category:', 'nsm' ), 'Module' ),
        'edit_item'         => sprintf( __( 'Edit %s Category', 'nsm' ), 'Module' ),
        'update_item'       => sprintf( __( 'Update %s Category', 'nsm' ), 'Module' ),
        'add_new_item'      => sprintf( __( 'Add New %s Category', 'nsm' ), 'Module' ),
        'new_item_name'     => sprintf( __( 'New %s Category Name', 'nsm' ), 'Module' ),
        'menu_name'         => __( 'Categories', 'nsm' ),
    );
    
    $category_args = array(
        'public'       => false,
        'hierarchical' => true,
        'labels'       => $category_labels,
        'show_ui'      => true,
        'query_var'    => 'module_category',
        'rewrite'      => array( 'slug' => 'categories' )
    );
    register_taxonomy( 'module_category', ['module'], $category_args );
}
add_action('init',  'nsm_module_category_tax' );