<?php

/**
 * Function to Register "job" custom post type.
 * 
 * @since 1.0.0
 */
function nsm_register_cpt_job(){
    $labels = array(
        'name' => esc_html__('Jobs', 'nsm'),
        'singular_name' => esc_html__('Job', 'nsm'),
        'menu_name' => esc_html__('Jobs', 'nsm'),
        'name_admin_bar' => esc_html__('Job', 'nsm'),
        'add_new' => esc_html__('Add New', 'nsm'),
        'add_new_item' => esc_html__('Add New Job', 'nsm'),
        'new_item' => esc_html__('New Job', 'nsm'),
        'edit_item' => esc_html__('Edit Job', 'nsm'),
        'view_item' => esc_html__('View Job', 'nsm'),
        'all_items' => esc_html__('All Jobs', 'nsm'),
        'search_items' => esc_html__('Search Jobs', 'nsm'),
        'parent_item_colon' => esc_html__('Parent Job:', 'nsm'),
        'not_found' => esc_html__('No jobs found.', 'nsm'),
        'not_found_in_trash' => esc_html__('No jobs found in Trash.', 'nsm'),
        'featured_image' => esc_html__('Job Image', 'nsm'),
        'set_featured_image' => esc_html__('Set Job Image', 'nsm'),
        'remove_featured_image' => esc_html__('Remove Job Image', 'nsm'),
        'use_featured_image' => esc_html__('Use Job Image', 'nsm'),
    );

    $cpt_job_args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'jobs' ),
        'capability_type' => 'post',
        'has_archive' => false,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title', 'thumbnail'),
        'menu_icon' => 'dashicons-editor-ul'
    );

    $cpt_job_args = apply_filters('nsm/filters/cpt_job_args', $cpt_job_args);

    register_post_type('job', $cpt_job_args);
}
add_action('init', 'nsm_register_cpt_job' );
