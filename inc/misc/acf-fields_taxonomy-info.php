<?php

function nsm_acf_taxonomy_info(){

    $location = array( 
        array (
            array (
                'param' => 'taxonomy',
                'operator' => '==',
                'value' => 'product_cat',
            ), 
        ),
        array(
            array (
                'param' => 'taxonomy',
                'operator' => '==',
                'value' => 'category',
            ),
        ),
        array(
            array (
                'param' => 'taxonomy',
                'operator' => '==',
                'value' => 'post_tag',
            ),
        )
    );

    $fields = array(
        array (
            'key'            => 'custom_h1_01',
            'label'          => 'Custom H1',
            'placeholder'    => 'Enter a custom heading',
            'name'           => 'custom_h1',
            'type'           => 'text',
        ),
        array (
            'key'            => 'hero_text_02',
            'label'          => 'Hero Text',
            'name'           => 'hero_text',
            'type'           => 'textarea',
        ),
        array (
            'key'            => 'content_01',
            'label'          => 'Category Content',
            'name'           => 'content',
            'type'           => 'wysiwyg',
        ),
        array (
            'key'            => 'subheader_image_01',
            'label'          => 'Subheader Image',
            'name'           => 'subheader_image',
            'type'           => 'image',
            'return_format'  => 'url'
        ),
        array (
            'key'            => 'faq_title_01',
            'label'          => 'FAQ Title',
            'name'           => 'faq_title',
            'type'           => 'text',
        ),
        array (
            'key'               => 'faq_01',
            'label'             => 'FAQ',
            'name'              => 'faq',
            'type'              => 'repeater',
            'layout'            => 'block',
            'button_label'      => 'Add new question',
            'sub_fields' => array(
                array (
                    'key'            => 'faq_question_01',
                    'label'          => 'Question',
                    'placeholder'    => 'Enter the question',
                    'name'           => 'faq_question',
                    'parent'         => 'faq_01',
                    'type'           => 'text',
                    'required'       => 1,
                ),
                array (
                    'key'            => 'faq_answer_01',
                    'label'          => 'Answer',
                    'placeholder'    => 'Enter the answer',
                    'name'           => 'faq_answer',
                    'parent'         => 'faq_01',
                    'type'           => 'text',
                    'required'       => 1,
                ),  
            )
        ),
    );

    acf_add_local_field_group(array(
		'key' => 'nsm_taxonomy_info',
		'title' => 'Taxonomy Info',
		'fields' => $fields,
		'location' => $location,
	));
    
}
add_action( 'acf/init', 'nsm_acf_taxonomy_info' );
?>