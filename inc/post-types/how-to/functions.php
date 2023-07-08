<?php


 // Add the custom columns to the car post type:
function guide_admin_table_columns($columns) {
    unset( $columns['author'] );
    $columns['shortcode'] = __( 'Shortcode', 'cfoxin' );

    return $columns;
}

// Add the data to the custom columns for the car post type:
function guide_admin_table_columns_data( $column, $post_id ) {

    switch ( $column ) {

        case 'shortcode' :
            echo '[howto id="'.$post_id.'"]';
        break;
       
    }
}
add_action( 'manage_guide_posts_custom_column' , 'guide_admin_table_columns_data', 10, 2 );
add_filter( 'manage_guide_posts_columns', 'guide_admin_table_columns' );