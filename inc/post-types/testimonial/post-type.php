<?php

/**
 * Function to Register "testimonial" custom post type.
 * 
 * @since 1.0.0
 */
function nsm_register_cpt_testimonial(){
    $labels = array(
        'name' => esc_html__('Testimonials', 'nsm'),
        'singular_name' => esc_html__('Testimonial', 'nsm'),
        'menu_name' => esc_html__('Testimonials', 'nsm'),
        'name_admin_bar' => esc_html__('Testimonial', 'nsm'),
        'add_new' => esc_html__('Add New', 'nsm'),
        'add_new_item' => esc_html__('Add New Testimonial', 'nsm'),
        'new_item' => esc_html__('New Testimonial', 'nsm'),
        'edit_item' => esc_html__('Edit Testimonial', 'nsm'),
        'view_item' => esc_html__('View Testimonial', 'nsm'),
        'all_items' => esc_html__('All Testimonials', 'nsm'),
        'search_items' => esc_html__('Search Testimonials', 'nsm'),
        'parent_item_colon' => esc_html__('Parent Testimonial:', 'nsm'),
        'not_found' => esc_html__('No testimonials found.', 'nsm'),
        'not_found_in_trash' => esc_html__('No testimonials found in Trash.', 'nsm'),
        'featured_image' => esc_html__('Testimonial Image', 'nsm'),
        'set_featured_image' => esc_html__('Set Testimonial Image', 'nsm'),
        'remove_featured_image' => esc_html__('Remove Testimonial Image', 'nsm'),
        'use_featured_image' => esc_html__('Use Testimonial Image', 'nsm'),
    );

    $cpt_testimonial_args = array(
        'labels' => $labels,
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
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => 'dashicons-admin-users'
    );

    $cpt_testimonial_args = apply_filters('nsm/filters/cpt_testimonial_args', $cpt_testimonial_args);

    register_post_type('testimonial', $cpt_testimonial_args);
}
add_action('init', 'nsm_register_cpt_testimonial' );
