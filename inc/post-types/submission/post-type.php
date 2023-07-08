<?php

/**
 * Function to Register "submission" custom post type.
 * 
 * @since 1.0.0
 */
function nsm_register_cpt_submission(){
    $labels = array(
        'name' => esc_html__('Submissions', 'nsm'),
        'singular_name' => esc_html__('Submission', 'nsm'),
        'menu_name' => esc_html__('Submissions', 'nsm'),
        'name_admin_bar' => esc_html__('Submission', 'nsm'),
        'add_new' => esc_html__('Add New', 'nsm'),
        'add_new_item' => esc_html__('Add New Submission', 'nsm'),
        'new_item' => esc_html__('New Submission', 'nsm'),
        'edit_item' => esc_html__('Edit Submission', 'nsm'),
        'view_item' => esc_html__('View Submission', 'nsm'),
        'all_items' => esc_html__('All Submissions', 'nsm'),
        'search_items' => esc_html__('Search Submissions', 'nsm'),
        'parent_item_colon' => esc_html__('Parent Submission:', 'nsm'),
        'not_found' => esc_html__('No submissions found.', 'nsm'),
        'not_found_in_trash' => esc_html__('No submissions found in Trash.', 'nsm'),
        'featured_image' => esc_html__('Submission Image', 'nsm'),
        'set_featured_image' => esc_html__('Set Submission Image', 'nsm'),
        'remove_featured_image' => esc_html__('Remove Submission Image', 'nsm'),
        'use_featured_image' => esc_html__('Use Submission Image', 'nsm'),
    );

    $cpt_submission_args = array(
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
        'menu_icon' => 'dashicons-money-alt',
    );

    $cpt_submission_args = apply_filters('nsm/filters/cpt_submission_args', $cpt_submission_args);

    register_post_type('submission', $cpt_submission_args);
}
add_action('init', 'nsm_register_cpt_submission' );
