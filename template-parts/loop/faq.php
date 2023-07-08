<?php
/*
    Template used to display faq
    
    Available params:
    ---------------------
    $args['schema'] - Whether to show schema or not
    $args['faq'] - The faq items
    $args['columns'] - The number of columns to display the FAQ items in
*/
$faqs = $args['faq'];

if ($faqs) {
    $columns = $args['columns'];
    foreach( $faqs as $faq ){
    ?>
        <div class="<?php echo $columns ?> sm-6">
            <div class="faq-item bg-w b-shadow px-20 py-20 mt-20">
                <div class="faq-question c-pointer p-relative">
                    <p class="h5 mb-0"><?php echo $faq['faq_question']; ?></p>
                </div>
                <div class="faq-answer d-none mt-10">
                    <p class="mb-0"><?php echo $faq['faq_answer']; ?></p>
                </div>
            </div>
        </div>
    <?php
    }
    get_template_part( 'template-parts/schema/faq', null, [
        'faq'       => $faqs,
        'schema'    => $args['schema']
    ]);
} 
?>