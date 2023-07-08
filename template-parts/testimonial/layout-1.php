<?php
/*
    Template used to display testimonial layout 1
    
    Available params:
    ---------------------
    $args['testimonial'] - The testimonial object
    $args['key'] - The count in the current loop
    $args['layout'] - The layout selected from options
*/
$testimonial_id = $args['testimonial']->ID;
$testimonial    = new NSM_Testimonial($testimonial_id);
?>
<div class="<?php echo NSM_Testimonial_Helper::get_classes( $args['testimonial'], 'text-center d-flex fd-c jc-c ai-c px-15 py-15 mb-15 px-sm-25 py-sm-40 mb-15 mb-lg-30 br-12 bg-w p-relative b-shadow' ) ?>">


</div>
