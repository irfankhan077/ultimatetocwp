<?php
/*
    Template used to display project layout 1
    
    Available params:
    ---------------------
    $args['project'] - The project object
    $args['layout'] - The layout selected from options
*/
$project_id = $args['project']->ID;
$project    = new NSM_Project($project_id);
?>
<a href="<?php echo get_the_permalink($project_id) ?>" class="<?php echo NSM_Project_Helper::get_classes( $args['project'], 'p-relative' ) ?>">
    <?php echo get_the_title( $project_id ); ?>
</a>
