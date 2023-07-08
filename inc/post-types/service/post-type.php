<?php

/**
 * Function to Register "service" custom post type.
 * 
 * @since 1.0.0
 */
function nsm_register_cpt_service(){
    $labels = array(
        'name' => esc_html__('Services', 'nsm'),
        'singular_name' => esc_html__('Service', 'nsm'),
        'menu_name' => esc_html__('Services', 'nsm'),
        'name_admin_bar' => esc_html__('Service', 'nsm'),
        'add_new' => esc_html__('Add New', 'nsm'),
        'add_new_item' => esc_html__('Add New Service', 'nsm'),
        'new_item' => esc_html__('New Service', 'nsm'),
        'edit_item' => esc_html__('Edit Service', 'nsm'),
        'view_item' => esc_html__('View Service', 'nsm'),
        'all_items' => esc_html__('All Services', 'nsm'),
        'search_items' => esc_html__('Search Services', 'nsm'),
        'parent_item_colon' => esc_html__('Parent Service:', 'nsm'),
        'not_found' => esc_html__('No services found.', 'nsm'),
        'not_found_in_trash' => esc_html__('No services found in Trash.', 'nsm'),
        'featured_image' => esc_html__('Service Image', 'nsm'),
        'set_featured_image' => esc_html__('Set Service Image', 'nsm'),
        'remove_featured_image' => esc_html__('Remove Service Image', 'nsm'),
        'use_featured_image' => esc_html__('Use Service Image', 'nsm'),
    );

    $cpt_service_args = array(
        'labels' => $labels,
        'description' => get_theme_mod( 'service_description' ),
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'services' ),
        'capability_type' => 'post',
        'has_archive' => false,
        'hierarchical' => true,
        'menu_position' => null,
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => 'dashicons-megaphone'
    );

    $cpt_service_args = apply_filters('nsm/filters/cpt_service_args', $cpt_service_args);

    register_post_type('service', $cpt_service_args);
}
add_action('init', 'nsm_register_cpt_service' );
