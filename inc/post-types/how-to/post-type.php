<?php

/**
 * Function to Register "guide" custom post type.
 * 
 * @since 1.0.0
 */
function nsm_register_cpt_guide(){
    $labels = array(
        'name' => esc_html__('Guides', 'nsm'),
        'singular_name' => esc_html__('Guide', 'nsm'),
        'menu_name' => esc_html__('Guides', 'nsm'),
        'name_admin_bar' => esc_html__('Guide', 'nsm'),
        'add_new' => esc_html__('Add New', 'nsm'),
        'add_new_item' => esc_html__('Add New Guide', 'nsm'),
        'new_item' => esc_html__('New Guide', 'nsm'),
        'edit_item' => esc_html__('Edit Guide', 'nsm'),
        'view_item' => esc_html__('View Guide', 'nsm'),
        'all_items' => esc_html__('All Guide', 'nsm'),
        'search_items' => esc_html__('Search Guide', 'nsm'),
        'parent_item_colon' => esc_html__('Parent Guide:', 'nsm'),
        'not_found' => esc_html__('No guide found.', 'nsm'),
        'not_found_in_trash' => esc_html__('No guide found in Trash.', 'nsm'),
        'featured_image' => esc_html__('Guide Image', 'nsm'),
        'set_featured_image' => esc_html__('Set Guide Image', 'nsm'),
        'remove_featured_image' => esc_html__('Remove Guide Image', 'nsm'),
        'use_featured_image' => esc_html__('Use Guide Image', 'nsm'),
    );

    $cpt_guide_args = array(
        'labels' => $labels,
        'description' => esc_html__('List of available guides.', 'nsm'),
        'public' => false,
        'publicly_queryable' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => false,
        'show_in_rest' => true,
        'rewrite' => array('slug' => get_theme_mod( 'guide_rewrite', 'review' ) ),
        'capability_type' => 'post',
        'has_archive' => false,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title', 'author', 'thumbnail'),
        'menu_icon' => 'dashicons-book',
    );

    $cpt_guide_args = apply_filters('nsm/filters/cpt_guide_args', $cpt_guide_args);

    register_post_type('guide', $cpt_guide_args);
}
add_action('init', 'nsm_register_cpt_guide' );
