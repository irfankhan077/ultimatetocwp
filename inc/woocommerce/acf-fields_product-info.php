<?php

function nsm_acf_product_info(){

    $location = array( array (
        array (
            'param' => 'post_type',
            'operator' => '==',
            'value' => 'product',
        ),
    ) );

    $fields = array(
        // Listing Image
        array (
            'key'            => 'listing_image_01',
            'label'          => 'Listing Image',
            'return_format'  => 'array',
            'preview_size'   => 'thumbnail',
            'name'           => 'listing_image',
            'type'           => 'image',
            'library'        => 'all',
            'wrapper' => array(
                'width' => '25'
            )
        ),
        // Product Badges Repeater
        array (
            'key'               => 'product_badges_01',
            'label'             => 'Badges',
            'name'              => 'product_badges',
            'type'              => 'repeater',
            'layout'            => 'block',
            'button_label'      => 'Add new badge',
            'sub_fields' => array(
                // Product Title
                array (
                    'key'            => 'product_badge_title_01',
                    'label'          => 'Title',
                    'placeholder'    => 'Enter the badge title',
                    'name'           => 'title',
                    'parent'         => 'product_badges_01',
                    'type'           => 'text',
                    'required'       => 1,
                    'wrapper' => array(
                        'width' => '50'
                    )
                ),
                array (
                    'key'            => 'background_color_01',
                    'label'          => 'Background Color',
                    'placeholder'    => 'Badge Background Color',
                    'name'           => 'background_color',
                    'parent'         => 'product_badges_01',
                    'type'           => 'select',
                    'ui'             => 1,
                    'required'       => 1,
                    'choices'        => array(
                        'bg-p'      => 'Primary',
                        'bg-suc'    => 'Success',
                        'bg-d'      => 'Dark',
                        'bg-s'      => 'Secondary',
                        'bg-e'      => 'Error',
                    ),
                    'wrapper' => array(
                        'width' => '50'
                    )
                ),
                
            )
        ),
        // Product Views
        array (
            'key'               => 'past_product_views_01',
            'label'             => 'Views',
            'name'              => 'past_product_views',
            'type'              => 'repeater',
            'layout'            => 'block',
            'button_label'      => 'Add new row',
            'sub_fields' => array(
                array (
                    'key'            => 'view_date_range_01',
                    'label'          => 'Date Range',
                    'name'           => 'view_date_range',
                    'parent'         => 'past_product_views_01',
                    'type'           => 'text',
                    'wrapper' => array(
                        'width' => '50'
                    )
                ),
                array (
                    'key'            => 'view_count_01',
                    'label'          => 'Count',
                    'name'           => 'view_count',
                    'parent'         => 'past_product_views_01',
                    'type'           => 'text',
                    'wrapper' => array(
                        'width' => '50'
                    )
                ),
                
            )
        ),
        
    );

    acf_add_local_field_group(array(
		'key' => 'nsm_product_info',
		'title' => 'Product Info',
		'fields' => $fields,
		'location' => $location,
	));
    
}
add_action( 'acf/init', 'nsm_acf_product_info' );
?>