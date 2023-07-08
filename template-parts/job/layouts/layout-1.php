<?php
/*
    Template used to display job layout 1
    
    Available params:
    ---------------------
    $args['job'] - The job object
    $args['layout'] - The layout selected from options
*/
$job_id = $args['job']->ID;
$job    = new NSM_Job($job_id);
?>
<a href="<?php echo get_the_permalink($job_id) ?>" class="<?php echo NSM_Job_Helper::get_classes( $args['job'], 'p-relative' ) ?>">
    <?php echo get_the_title( $job_id ); ?>
</a>
