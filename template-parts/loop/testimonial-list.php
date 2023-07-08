<?php
/*
    Template used to display testimonial lists.
    
    Available params:
    ---------------------
    $args['layout'] - The layout we want to use
    $args['columns'] - The number of columns we want to use
    $args['query'] - Custom query arguments
*/
$query_args     = isset($args['query']) && !empty($args['query']) ? $args['query'] : [];
$filters        = NSM_Testimonial_Helper::get_testimonial_search_args();
$per_page       = isset($query_args['number']) && $query_args['number'] ? $query_args['number'] : 25;
$search_args    = isset($args['search_args']) ? $args['search_args'] : array_filter( NSM_Testimonial_Helper::get_testimonial_search_args() );

// Update our search arguments with the search filters if any
if( $search_args ){
    $query_args = array_merge( $search_args, $query_args);
}

if ( get_query_var( 'paged' ) ){
    $paged = get_query_var('paged');
}else if ( get_query_var( 'page' ) ){
    $paged = get_query_var( 'page' );
}else{
    $paged = 1;
}
$query_args['page'] = $paged;

$testimonials   = NSM_Testimonial_Helper::get_testimonials( $query_args );

$layout     = isset($args['layout']) && !empty($args['layout']) ? $args['layout'] : NSM_Testimonial_Helper::get_layout();
$columns    = isset($args['columns']) && !empty($args['columns']) ? $args['columns'] : NSM_Testimonial_Helper::get_columns();
if( isset($testimonials['testimonials']) && $testimonials['testimonials'] ){
?>
<div id="list-of-testimonials-<?php echo esc_attr(uniqid()) ?>" class="row testimonial-list <?php echo 'testimonials-list-' . esc_attr($layout) ?>">
    <?php foreach( $testimonials['testimonials'] as $key => $testimonial ): ?>
    <div class="<?php echo $columns ?> sm-6">
        <?php
        get_template_part( 'template-parts/testimonial/' . $layout, null, [
            'testimonial'   => $testimonial,
            'key' 		=> $key,
            'layout' 	=> $layout,
        ]);
        ?>
    </div>
    <?php endforeach; ?>
</div>
<?php 
    echo NSM_Helper::pagination([
        'type'  => 'testimonial', 
        'total' => ceil( $testimonials['max_num_pages'] )
    ], $paged);
?>
<?php } ?>