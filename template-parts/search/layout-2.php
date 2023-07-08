<?php $product = wc_get_product( $post->ID );?>
<div class="lg-4 md-6 sm-6 mb-10">
    <a href="<?php echo get_the_permalink();?>" class="h-100 px-10 py-10 border watch d-flex ai-c bg-w">
        <div class="mr-0 mr-sm-10 d-none thumb d-sm-flex ai-c jc-c bg-l">
            <img src="<?php echo get_the_post_thumbnail_url( $post->ID,'thumbnail' ); ?>" class="" alt="<?php echo get_the_title( ); ?>" />
        </div>
        <div class="f-1">
            <p class="fw-b fs-14 mb-0 tc-h highlight-term"><?php echo get_the_title( ); ?></p>
            <?php 
            $types = '';
            if( $term_list = get_the_terms($post->ID, 'product_brand') ):
                foreach($term_list as $term_single) {
                    $types .= $term_single->slug.', ';
                }
            ?>
            <span class="fs-12 tc-b highlight-term tt-c"><?php echo rtrim($types, ', ');?></span>
            <?php endif; ?>
            <div class="row gutter-sm">
                <div class="sm-12 xs-12 mt-5">
                    <?php 
                    if( $product->is_in_stock() && ( $product->get_price() != '' && $product->get_price() != 0 ) ){
                        if ( $price_html = $product->get_price_html() ) :
                             echo '<span class="price tc-h fs-12">'.$price_html.'</span>';
                         endif;
                     }elseif( !$product->is_in_stock() ){
                         echo '<p class="mt-5 tc-e mb-0 fw-sb fs-16">'.__('Sold Out', 'nsm').'</p>';
                     }?>
                </div>
                <div class="sm-12 xs-12 mt-5">
                    <?php NSM_Search_Actions::get_color_tax($product->get_id(), 'pa_color');?>
                </div>
                
            </div>
        </div>
    </a>
</div>