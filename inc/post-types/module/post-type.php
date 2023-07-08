<?php

/**
 * Function to Register "module" custom post type.
 * 
 * @since 1.0.0
 */
function nsm_register_cpt_module(){
    $labels = array(
        'name' => esc_html__('Modules', 'nsm'),
        'singular_name' => esc_html__('Module', 'nsm'),
        'menu_name' => esc_html__('Modules', 'nsm'),
        'name_admin_bar' => esc_html__('Module', 'nsm'),
        'add_new' => esc_html__('Add New', 'nsm'),
        'add_new_item' => esc_html__('Add New Module', 'nsm'),
        'new_item' => esc_html__('New Module', 'nsm'),
        'edit_item' => esc_html__('Edit Module', 'nsm'),
        'view_item' => esc_html__('View Module', 'nsm'),
        'all_items' => esc_html__('All Modules', 'nsm'),
        'search_items' => esc_html__('Search Modules', 'nsm'),
        'parent_item_colon' => esc_html__('Parent Module:', 'nsm'),
        'not_found' => esc_html__('No modules found.', 'nsm'),
        'not_found_in_trash' => esc_html__('No modules found in Trash.', 'nsm'),
        'featured_image' => esc_html__('Module Image', 'nsm'),
        'set_featured_image' => esc_html__('Set Module Image', 'nsm'),
        'remove_featured_image' => esc_html__('Remove Module Image', 'nsm'),
        'use_featured_image' => esc_html__('Use Module Image', 'nsm'),
    );

    $cpt_module_args = array(
        'labels' => $labels,
        'description' => esc_html__('Description.', 'nsm'),
        'public' => false,
        'publicly_queryable' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => false,
        'show_in_rest' => true,
        'rewrite' => false,
        'capability_type' => 'post',
        'has_archive' => false,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title'),
        'menu_icon' => 'dashicons-admin-site',
    );

    $cpt_module_args = apply_filters('nsm/filters/cpt_module_args', $cpt_module_args);

    register_post_type('module', $cpt_module_args);
}
add_action('init', 'nsm_register_cpt_module' );
