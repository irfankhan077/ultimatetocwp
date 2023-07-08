<?php
/*
    Template used to display service lists.
    
    Available params:
    ---------------------
    $args['layout'] - The layout we want to use
    $args['columns'] - The number of columns we want to use
    $args['query'] - Custom query arguments
*/
$query_args     = isset($args['query']) && !empty($args['query']) ? $args['query'] : [];
$filters        = NSM_Service_Helper::get_service_search_args();
$per_page       = isset($query_args['number']) && $query_args['number'] ? $query_args['number'] : 25;
$search_args    = isset($args['search_args']) ? $args['search_args'] : array_filter( NSM_Service_Helper::get_service_search_args() );

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

$services   = NSM_Service_Helper::get_services( $query_args );

$layout     = isset($args['layout']) && !empty($args['layout']) ? $args['layout'] : NSM_Service_Helper::get_layout();
$columns    = isset($args['columns']) && !empty($args['columns']) ? $args['columns'] : NSM_Service_Helper::get_columns();
if( isset($services['services']) && $services['services'] ){
?>
<div id="list-of-services-<?php echo esc_attr(uniqid()) ?>" class="row service-list <?php echo 'services-list-' . esc_attr($layout) ?>">
    <?php foreach( $services['services'] as $key => $service ): ?>
    <div class="<?php echo $columns ?> sm-6">
        <?php
        get_template_part( 'template-parts/service/layouts/' . $layout, null, [
            'service'   => $service,
            'key' 		=> $key,
            'layout' 	=> $layout,
        ]);
        ?>
    </div>
    <?php endforeach; ?>
</div>
<?php 
    echo NSM_Helper::pagination([
        'type'  => 'service', 
        'total' => ceil( $services['max_num_pages'] )
    ], $paged);
?>
<?php } ?>