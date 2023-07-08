<?php
/*
    Template used to display service layout 1
    
    Available params:
    ---------------------
    $args['service'] - The service object
    $args['layout'] - The layout selected from options
*/
$service_id = $args['service']->ID;
$service    = new NSM_Service($service_id);
?>
<a href="<?php echo get_the_permalink($service_id) ?>" class="<?php echo NSM_Service_Helper::get_classes( $args['service'], 'p-relative' ) ?>">
    <?php echo get_the_title( $service_id ); ?>
</a>
