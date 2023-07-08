<?php

class NSM_Yith_Wcwl{

    public function __construct(){
        add_shortcode( 'yith_wcwl_items_count', [$this, 'yith_wcwl_get_items_count'] );
        add_shortcode( 'nsm_wishlist_content_shortcode', [$this, 'get_wishlist_content_shortcode'] );

        add_action( 'wp_ajax_yith_wcwl_update_wishlist_count', [$this, 'yith_wcwl_ajax_update_count'] );
        add_action( 'wp_ajax_nopriv_yith_wcwl_update_wishlist_count', [$this, 'yith_wcwl_ajax_update_count'] );

        add_action( 'woocommerce_before_shop_loop_item', [$this, 'get_yith_wishlist_link'], 5 );
        add_action( 'nsm/actions/product_title_single', [$this, 'get_yith_wishlist_link'], 5 );

    }

    public function yith_wcwl_ajax_update_count() {
        wp_send_json( array(
            'count'     => yith_wcwl_count_all_products()
        ));
    }

    public function yith_wcwl_get_items_count() {
        ob_start();
        echo esc_html( yith_wcwl_count_all_products() );
        return ob_get_clean();
    }

    public function get_wishlist_content_shortcode(){
        ob_start();
        echo do_shortcode('[yith_wcwl_wishlist]');
        return ob_get_clean();
    }

    public function product_single_title_wishlist(){
        ?>
        <div class="w-60px ml-10 text-right">
            <?php $this->get_yith_wishlist_link(); ?>
        </div>
        <?php
    }

    /**
     * YITH wish list link
     *
     * @since 1.0.0
     */
    public function get_yith_wishlist_link(){
        global $product;
        echo do_shortcode( '[yith_wcwl_add_to_wishlist product_id='.$product->get_id().']' );
    }

}