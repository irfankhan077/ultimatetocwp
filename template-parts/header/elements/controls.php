
<?php if( get_field( 'header_controls_account', 'options' ) ){ ?>
<li class="d-none d-md-block mr-30">
    <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" rel="nofollow">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 100 100"><path d="M59.3 52.2C65.8 48.2 70 40.3 70 33c0-10.4-8.5-22-20-22S30 22.6 30 33c0 7.3 4.2 15.2 10.7 19.2C25.3 56.3 14 70.4 14 87c0 1.1.9 2 2 2h68c1.1 0 2-.9 2-2 0-16.6-11.3-30.7-26.7-34.8zM34 33c0-10.3 8.5-18 16-18s16 7.7 16 18-8.5 18-16 18-16-7.7-16-18zM18.1 85c1-16.7 15-30 31.9-30s30.9 13.3 31.9 30H18.1z"/><path fill="#00F" d="M1224-790V894H-560V-790h1784m8-8H-568V902h1800V-798z"/></svg>
    </a>
</li>
<?php } ?>
<?php if( get_field( 'header_controls_wishlist', 'options' ) ){ ?>
<li class="d-none d-md-block mr-30 wishlist-trigger p-relative">
    <span class="c-pointer" title="<?php echo esc_attr__('Your Wishlist', 'nsm') ?>">
        <svg width="24" height="24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 471.701 471.701" xml:space="preserve">
            <path d="M433.601,67.001c-24.7-24.7-57.4-38.2-92.3-38.2s-67.7,13.6-92.4,38.3l-12.9,12.9l-13.1-13.1
                c-24.7-24.7-57.6-38.4-92.5-38.4c-34.8,0-67.6,13.6-92.2,38.2c-24.7,24.7-38.3,57.5-38.2,92.4c0,34.9,13.7,67.6,38.4,92.3
                l187.8,187.8c2.6,2.6,6.1,4,9.5,4c3.4,0,6.9-1.3,9.5-3.9l188.2-187.5c24.7-24.7,38.3-57.5,38.3-92.4
                C471.801,124.501,458.301,91.701,433.601,67.001z M414.401,232.701l-178.7,178l-178.3-178.3c-19.6-19.6-30.4-45.6-30.4-73.3
                s10.7-53.7,30.3-73.2c19.5-19.5,45.5-30.3,73.1-30.3c27.7,0,53.8,10.8,73.4,30.4l22.6,22.6c5.3,5.3,13.8,5.3,19.1,0l22.4-22.4
                c19.6-19.6,45.7-30.4,73.3-30.4c27.6,0,53.6,10.8,73.2,30.3c19.6,19.6,30.3,45.6,30.3,73.3
                C444.801,187.101,434.001,213.101,414.401,232.701z"/>
        </svg>
        <span class="yith-wcwl-items-count count w-20px h-20px br-round bg-d tc-w d-flex ai-c jc-c fs-12 fw-500"><?php echo do_shortcode('[yith_wcwl_items_count]') ?></span>
    </span>
</li>
<?php } ?>
<?php if( get_field( 'header_controls_cart', 'options' ) ){ ?>
<li class="p-relative">
    <span class="watchy-cart cart-trigger c-pointer" title="<?php echo esc_attr__('Your Cart', 'nsm') ?>" href="<?php echo esc_url(wc_get_cart_url()); ?>">
        <svg width="24" height="24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 483.1 483.1" xml:space="preserve">
            <path d="M434.55,418.7l-27.8-313.3c-0.5-6.2-5.7-10.9-12-10.9h-58.6c-0.1-52.1-42.5-94.5-94.6-94.5s-94.5,42.4-94.6,94.5h-58.6
                c-6.2,0-11.4,4.7-12,10.9l-27.8,313.3c0,0.4,0,0.7,0,1.1c0,34.9,32.1,63.3,71.5,63.3h243c39.4,0,71.5-28.4,71.5-63.3
                C434.55,419.4,434.55,419.1,434.55,418.7z M241.55,24c38.9,0,70.5,31.6,70.6,70.5h-141.2C171.05,55.6,202.65,24,241.55,24z
                M363.05,459h-243c-26,0-47.2-17.3-47.5-38.8l26.8-301.7h47.6v42.1c0,6.6,5.4,12,12,12s12-5.4,12-12v-42.1h141.2v42.1
                c0,6.6,5.4,12,12,12s12-5.4,12-12v-42.1h47.6l26.8,301.8C410.25,441.7,389.05,459,363.05,459z"/>
        </svg>
        <span class="count w-20px h-20px br-round bg-d tc-w d-flex ai-c jc-c fs-12 fw-500"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
    </span>
</li>
<?php } ?>
