<?php

function nsm_acf_guide_info(){

    $location = array( array (
        array (
            'param' => 'post_type',
            'operator' => '==',
            'value' => 'guide',
        ),
    ) );

    $fields = array(
        // Guide Tools Title
        array (
            'key' => 'guide_tools_title_01',
            'label' => 'Tools Heading Title',
            'placeholder' => 'The title that will be used above the list of tools needed',
            'default_value' => 'Tools Required:',
            'name' => 'guide_tools_title',
            'type' => 'text',
            'wrapper' => array(
                'width' => '33.33'
            )
        ),
        // Guide Supply Title
        array (
            'key' => 'guide_supply_title_01',
            'label' => 'Supply Heading Title',
            'placeholder' => 'The title that will be used above the list of supply needed',
            'default_value' => 'Supply Required:',
            'name' => 'guide_supply_title',
            'type' => 'text',
            'wrapper' => array(
                'width' => '33.33'
            )
        ),
        // Step text
        array (
            'key' => 'guide_step_title_01',
            'label' => 'Step Text',
            'placeholder' => 'The step text',
            'default_value' => 'Step',
            'name' => 'guide_step_title',
            'type' => 'text',
            'wrapper' => array(
                'width' => '33.33'
            )
        ),
        // Guide Description
        array (
            'key' => 'guide_description_01',
            'label' => 'Description',
            'name' => 'guide_description',
            'type' => 'textarea',
        ),
        // Guide Steps Repeater
        array (
            'key'               => 'guide_steps_01',
            'label'             => 'Steps',
            'name'              => 'guide_steps',
            'type'              => 'repeater',
            'layout'            => 'block',
            'button_label'      => 'Add new Step',
            'sub_fields' => array(
                // Step Name
                array (
                    'key'            => 'guide_step_name_01',
                    'label'          => 'Step Name',
                    'placeholder'    => 'Enter the step name',
                    'name'           => 'guide_step_name',
                    'parent'         => 'guide_steps_01',
                    'type'           => 'text',
                    'required'       => 1,
                    'wrapper' => array(
                        'width' => '25'
                    )
                ),
                // Step Image
                array (
                    'key'            => 'guide_step_image_01',
                    'label'          => 'Step Image',
                    'return_format'  => 'url',
                    'preview_size'   => 'thumbnail',
                    'name'           => 'guide_step_image',
                    'parent'         => 'guide_steps_01',
                    'type'           => 'image',
                    'library'        => 'all',
                    'wrapper' => array(
                        'width' => '25'
                    )
                ),
                // Step Description
                array (
                    'key' => 'guide_step_description_01',
                    'label' => 'Step Description',
                    'name' => 'guide_step_description',
                    'required'       => 1,
                    'type' => 'textarea',
                    'wrapper' => array(
                        'width' => '50'
                    )
                ),
            )
        ),
        // Tools Repeater
        array (
            'key'               => 'guide_tools_01',
            'label'             => 'Tools',
            'name'              => 'guide_tools',
            'type'              => 'repeater',
            'layout'            => 'table',
            'instructions'      => 'An object used (but not consumed) when performing instructions or a direction (e.g. Internet connection, Mobile, computer, tablet)',
            'button_label'      => 'Add new Tool',
            'sub_fields' => array(
                // Step Name
                array (
                    'key'            => 'guide_tool_name_01',
                    'label'          => 'Tool Name',
                    'placeholder'    => 'Enter the tool name',
                    'name'           => 'guide_tool_name',
                    'parent'         => 'guide_tools_01',
                    'type'           => 'text',
                    'required'       => 1,
                )
            )
        ),
        // Supply Repeater
        array (
            'key'               => 'guide_supply_01',
            'label'             => 'Supply',
            'name'              => 'guide_supply',
            'type'              => 'repeater',
            'layout'            => 'table',
            'instructions'      => 'A supply consumed when performing instructions or a direction (e.g. Pengar, BankID, Zimpler)',
            'button_label'      => 'Add new Supply',
            'sub_fields' => array(
                // Step Name
                array (
                    'key'            => 'guide_supply_name_01',
                    'label'          => 'Supply Name',
                    'placeholder'    => 'Enter the supply name',
                    'name'           => 'guide_supply_name',
                    'parent'         => 'guide_supply_01',
                    'type'           => 'text',
                    'required'       => 1,
                )
            )
        ),
        array (
            'key' => 'guide_estimated_cost_01',
            'label' => 'Estimated Cost',
            'placeholder' => 'Estimated cost of all the tools needed',
            'default_value' => '10',
            'name' => 'guide_estimated_cost',
            'type' => 'text',
            'wrapper' => array(
                'width' => '50'
            )
        ),
        array (
            'key' => 'guide_estimated_cost_currency_01',
            'label' => 'Currency',
            'placeholder' => 'Currency used in the estimated cost',
            'default_value' => 'EUR',
            'name' => 'guide_estimated_cost_currency',
            'type' => 'text',
            'wrapper' => array(
                'width' => '50'
            )
        ),
        
    );

    acf_add_local_field_group(array(
		'key' => 'nsm_guide_info',
		'title' => 'Guide Info',
		'fields' => $fields,
		'location' => $location,
	));

    
}
add_action( 'acf/init', 'nsm_acf_guide_info' );
?>