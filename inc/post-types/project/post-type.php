<?php

/**
 * Function to Register "project" custom post type.
 * 
 * @since 1.0.0
 */
function nsm_register_cpt_project(){
    $labels = array(
        'name' => esc_html__('Projects', 'nsm'),
        'singular_name' => esc_html__('Project', 'nsm'),
        'menu_name' => esc_html__('Projects', 'nsm'),
        'name_admin_bar' => esc_html__('Project', 'nsm'),
        'add_new' => esc_html__('Add New', 'nsm'),
        'add_new_item' => esc_html__('Add New Project', 'nsm'),
        'new_item' => esc_html__('New Project', 'nsm'),
        'edit_item' => esc_html__('Edit Project', 'nsm'),
        'view_item' => esc_html__('View Project', 'nsm'),
        'all_items' => esc_html__('All Projects', 'nsm'),
        'search_items' => esc_html__('Search Projects', 'nsm'),
        'parent_item_colon' => esc_html__('Parent Project:', 'nsm'),
        'not_found' => esc_html__('No projects found.', 'nsm'),
        'not_found_in_trash' => esc_html__('No projects found in Trash.', 'nsm'),
        'featured_image' => esc_html__('Project Image', 'nsm'),
        'set_featured_image' => esc_html__('Set Project Image', 'nsm'),
        'remove_featured_image' => esc_html__('Remove Project Image', 'nsm'),
        'use_featured_image' => esc_html__('Use Project Image', 'nsm'),
    );

    $cpt_project_args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'projects' ),
        'capability_type' => 'post',
        'has_archive' => false,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => 'dashicons-html'
    );

    $cpt_project_args = apply_filters('nsm/filters/cpt_project_args', $cpt_project_args);

    register_post_type('project', $cpt_project_args);
}
add_action('init', 'nsm_register_cpt_project' );
