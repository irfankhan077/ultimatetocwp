<?php

class NSM_WooCommerce_Actions{

    public function __construct(){

        add_action( 'woocommerce_before_main_content', [$this, 'subheader'], 5 );
        remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);

        add_action( 'woocommerce_before_main_content', [$this, 'shop_container_start'], 15 );
        add_action( 'woocommerce_before_single_product', [$this, 'product_breadcrumbs'], 5 );

        add_filter( 'wpseo_schema_breadcrumblist', [$this, 'breadcrumbs_schema'], 10, 1 );

        add_action( 'woocommerce_after_main_content', [$this, 'div_close_tag'], 5 );

        remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

        // remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
        // remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
        
        remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
        add_action( 'woocommerce_before_shop_loop_item', [$this, 'template_loop_product_link_open'], 10 );

        remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
        add_action( 'woocommerce_shop_loop_item_title', [$this, 'product_title'], 10 );

        remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
        add_action('woocommerce_before_shop_loop_item_title', [$this, 'product_thumbnail'], 10 );

        add_filter('woocommerce_currency_symbol', [$this, 'change_aed_symbol'], 10, 2);
        add_filter('woocs_currency_data_manipulation', [$this, 'change_aed_symbol_woocs'], 1, 1);

        add_filter( 'woocommerce_show_page_title', '__return_false' );
        add_filter( 'woocommerce_sale_flash', '__return_false' );
        
        remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
        remove_action( 'woocommerce_archive_description', 'woocommerce_product_archive_description', 10 );

        remove_action(  'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

        remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );

        add_action( 'woocommerce_after_shop_loop_item_title', [$this, 'div_close_tag'], 5 );
        add_action( 'woocommerce_after_shop_loop_item_title', [$this, 'template_loop_price'], 10 );
        
        add_action( 'wp_enqueue_scripts', [$this, 'enqueue_product_scripts'] );

        // PRODUCT DETAIL HOOKS
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
        remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
        remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
        remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

        add_filter( 'woocommerce_product_description_heading', '__return_null' );
        add_filter( 'woocommerce_product_additional_information_heading', '__return_null' );
        
        add_action( 'woocommerce_single_product_summary', [$this, 'template_single_title'], 5 );
        add_action( 'woocommerce_single_product_summary', [$this, 'template_single_price'], 10 );
        
        add_filter( 'woocommerce_product_single_add_to_cart_text', [$this, 'template_single_atc_text'] );
        
        add_action( 'woocommerce_after_main_content', [$this, 'template_single_modular'], 30 );
        add_action( 'woocommerce_after_main_content', [$this, 'product_cat_information'], 90 );

        add_action( 'woocommerce_after_single_product_summary', [$this, 'sticky_product_card'], 10 );
        
        add_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 20 );
        add_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

        // MISC HOOKS
        add_filter('woocommerce_add_to_cart_fragments', [$this, 'refresh_cart_fragment']);
   
        add_filter( 'yith_wcwl_is_wishlist_responsive', '__return_false' );

        remove_action( 'woocommerce_widget_shopping_cart_buttons', 'woocommerce_widget_shopping_cart_button_view_cart', 10 );
        remove_action( 'woocommerce_widget_shopping_cart_buttons', 'woocommerce_widget_shopping_cart_proceed_to_checkout', 20 );
        
        add_action( 'woocommerce_widget_shopping_cart_buttons', [$this, 'widget_shopping_cart_button_view_cart'], 10 );
        add_action( 'woocommerce_widget_shopping_cart_buttons', [$this, 'widget_shopping_cart_proceed_to_checkout'], 20 );

        add_action('woocommerce_before_mini_cart', [$this, 'before_mini_cart'], 40);

        remove_action( 'woocommerce_widget_shopping_cart_total', 'woocommerce_widget_shopping_cart_subtotal', 10 );
        add_action( 'woocommerce_widget_shopping_cart_total', [$this, 'widget_shopping_cart_subtotal'], 10 );

        add_action( 'wp_footer', [$this, 'cart_sidebar'] );
        add_action( 'wp_footer', [$this, 'wishlist_sidebar'] );

        add_filter( 'wc_add_to_cart_message_html', [$this, 'after_atc_message'], 1, 10 );

        remove_action( 'woocommerce_cart_is_empty', 'wc_empty_cart_message', 10 );
        add_action( 'woocommerce_cart_is_empty', [$this, 'empty_cart_message'], 10 );

        add_action( 'woocommerce_before_single_product_summary' , [$this, 'before_single_product_summary_wrap'], 5 );
        add_action( 'woocommerce_after_single_product_summary' , [$this, 'div_close_tag'], 15 );

        add_action( 'widgets_init', [ $this, 'shop_widgets' ] );

        add_action( 'enqueue_block_assets', [$this, 'wc_dequeue_block_assets'] );

    }

    /**
    * Dequeue woo block styles.
    *
    * @since 1.0.3
    */
    public function wc_dequeue_block_assets(){
        wp_deregister_script( 'wc-blocks-style' );
        wp_dequeue_style( 'wc-blocks-style' );       
    }

    /**
     * Register widget area.
     *
     * @link http://codex.wordpress.org/Function_Reference/register_sidebar
     */
    public function shop_widgets() {
        register_sidebar( array(
            'name'          => __( 'Shop', 'nsm' ),
            'id'            => 'shop',
            'description'   => '',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<p class="widget-title h6"><span>',
            'after_title'   => '</span></p>',
        ) );
    }

    public function before_single_product_summary_wrap() {
       echo '<div class="d-md-flex jc-b" id="product-fold">';
    }

    public function empty_cart_message(){
        ?>
        <div class="text-center">
            <svg width="60" height="60" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 483.1 483.1" xml:space="preserve">
                <path d="M434.55,418.7l-27.8-313.3c-0.5-6.2-5.7-10.9-12-10.9h-58.6c-0.1-52.1-42.5-94.5-94.6-94.5s-94.5,42.4-94.6,94.5h-58.6
                    c-6.2,0-11.4,4.7-12,10.9l-27.8,313.3c0,0.4,0,0.7,0,1.1c0,34.9,32.1,63.3,71.5,63.3h243c39.4,0,71.5-28.4,71.5-63.3
                    C434.55,419.4,434.55,419.1,434.55,418.7z M241.55,24c38.9,0,70.5,31.6,70.6,70.5h-141.2C171.05,55.6,202.65,24,241.55,24z
                    M363.05,459h-243c-26,0-47.2-17.3-47.5-38.8l26.8-301.7h47.6v42.1c0,6.6,5.4,12,12,12s12-5.4,12-12v-42.1h141.2v42.1
                    c0,6.6,5.4,12,12,12s12-5.4,12-12v-42.1h47.6l26.8,301.8C410.25,441.7,389.05,459,363.05,459z"></path>
            </svg>
            <p class="ml-auto mr-auto mw-470 mb-0 mt-20"><?php esc_html_e( 'Your cart is currently empty. Add something and check back again.', 'nsm' ); ?></p>
        </div>
        <?php
    }

    public function after_atc_message( $message ){

        $message = sprintf( '<a href="%s" tabindex="1" class="button wc-forward">%s</a> %s', esc_url( wc_get_checkout_url() ), esc_html__( 'Checkout', 'nsm' ), 'Item added to your cart.' );
        return $message;

    }

    public function cart_sidebar(){
        if( is_checkout() || is_cart() )
        return false;

        ?>
        <div class="nsm_drawer nsm_cart-sidebar-wrapper woocommerce">
            <div class="widget_shopping_cart_content"></div>
            <div class="nsm_drawer-overlay nsm_cart-sidebar-overlay cart-trigger"></div>
        </div>
        <?php
    }

    public function product_title(){
        global $product;

        echo '<p class="fs-14 tt-u fw-500 mb-0 mt-15 tc-h">'.get_the_title($product->get_id()).'</p>';
        
    }

    public function wishlist_sidebar(){
        ?>
        <div class="nsm_drawer nsm_wishlist-sidebar-wrapper woocommerce">
            <div class="widget_wishlist_content">
                <div class="nsm_wishlist-sidebar-header px-20 py-sm-30 py-20 px-sm-30 d-flex ai-c jc-b">
                    <p class="h4 mb-0">Your Wishlist</p>
                    <div class="close wishlist-trigger c-pointer d-flex ai-c jc-c">
                        <span></span>
                        <span></span>
                    </div>
                </div>
                <?php echo do_shortcode('[nsm_wishlist_content_shortcode]') ?>
            </div>
            <div class="nsm_drawer-overlay nsm_wishlist-sidebar-overlay wishlist-trigger"></div>
        </div>
        <?php
    }

    public function widget_shopping_cart_subtotal(){
		echo '<strong class="tc-l fs-20 fw-500">' . esc_html__( 'Subtotal:', 'nsm' ) . '</strong> ' . WC()->cart->get_cart_subtotal(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }

    /**
     * Mini cart header
     *
     * @since 1.0.0
     */
    public function before_mini_cart(){
        ?>
        <div class="nsm_cart-sidebar-header px-20 py-sm-30 py-20 px-sm-30 d-flex ai-c jc-b">
            <p class="h4 mb-0"><?php echo esc_html__('Your Cart', 'slices') ?></p>
            <div class="close cart-trigger c-pointer d-flex ai-c jc-c">
                <span></span>
                <span></span>
            </div>
        </div>
        <?php
    }

    public function widget_shopping_cart_button_view_cart(){
		echo '<div class="md-6 mb-15 mb-md-0"><button type="button" class="cart-trigger btn btn-light w-100">' . esc_html__( 'Continue Shopping', 'nsm' ) . '</button></div>';
    }
    
    public function widget_shopping_cart_proceed_to_checkout(){
		echo '<div class="md-6 mb-15 mb-md-0"><a href="' . esc_url( wc_get_checkout_url() ) . '" class="btn checkout w-100 wc-forward">' . esc_html__( 'Checkout', 'nsm' ) . '</a></div>';
    }

    public function template_single_price(){
        global $product;

        if ( !$product->is_in_stock() || ( $product->get_price() == '' || $product->get_price() == 0 ) )
        return false;

        woocommerce_template_single_price();
       
    }

    public function sticky_product_card(){
        global $product;
        if( !$product->is_in_stock() )
        return false;
        
        ?>
        <div class="px-10 py-sm-20 py-10 px-sm-20 b-shadow bg-w p-fixed product-sticky w-100">
            <div class="d-sm-flex ai-c jc-b">

                <div class="d-flex mb-10 mb-sm-0 ai-c mw-700">
                    <div class="w-sm-100px w-60px">
                    <?php
                    if( $listing_image = get_field( 'listing_image', $product->get_id() ) ){
                        nsm_acf_image($listing_image);
                    }else{
                        woocommerce_template_loop_product_thumbnail();
                    }
                    ?>
                    </div>
                    <p class="f-1 ml-20 h4 ff-h mb-0 fw-500"><?php echo $product->get_title(); ?></p>
                </div>

                <?php if( $product->get_price() ){ ?>
                <a class="btn" href="<?php echo $product->add_to_cart_url() ?>"><?php esc_html_e('Buy Now', 'nsm') ?></a>
                <?php } ?>

            </div>
        </div>
        <?php
    }

    public function refresh_cart_fragment($fragments){
        global $woocommerce;

        ob_start();
        ?>

        <a class="nsm-cart cart-trigger" title="<?php echo esc_attr__('Your Cart', 'nsm') ?>" href="<?php echo esc_url(wc_get_cart_url()); ?>">
            <svg width="24" height="24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 483.1 483.1" xml:space="preserve">
                <path d="M434.55,418.7l-27.8-313.3c-0.5-6.2-5.7-10.9-12-10.9h-58.6c-0.1-52.1-42.5-94.5-94.6-94.5s-94.5,42.4-94.6,94.5h-58.6
                    c-6.2,0-11.4,4.7-12,10.9l-27.8,313.3c0,0.4,0,0.7,0,1.1c0,34.9,32.1,63.3,71.5,63.3h243c39.4,0,71.5-28.4,71.5-63.3
                    C434.55,419.4,434.55,419.1,434.55,418.7z M241.55,24c38.9,0,70.5,31.6,70.6,70.5h-141.2C171.05,55.6,202.65,24,241.55,24z
                    M363.05,459h-243c-26,0-47.2-17.3-47.5-38.8l26.8-301.7h47.6v42.1c0,6.6,5.4,12,12,12s12-5.4,12-12v-42.1h141.2v42.1
                    c0,6.6,5.4,12,12,12s12-5.4,12-12v-42.1h47.6l26.8,301.8C410.25,441.7,389.05,459,363.05,459z"/>
            </svg>
            <span class="count w-20px h-20px br-round bg-d tc-w d-flex ai-c jc-c fs-12 fw-500"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
        </a>

        <?php
        $fragments['a.nsm-cart'] = ob_get_clean();
        return $fragments;
    }

    public function enqueue_product_scripts(){
        wp_enqueue_style( 'nsm-woocommerce', NSM_URI . '/assets/css/woocommerce/woocommerce.css', array(), NSM_VERSION);

        wp_enqueue_script( 'nsm-woocommerce', NSM_URI . '/assets/js/woocommerce/woocommerce.js', array(), NSM_VERSION, true );

        if( is_singular('product') )
        wp_enqueue_script( 'product-single', NSM_URI . '/assets/js/woocommerce/product-single.js', array(), NSM_VERSION, true );

        // Let's add account styles and scripts
        if( is_account_page() )
        wp_enqueue_style( 'my-account', NSM_URI . '/assets/css/woocommerce/my-account.css', array(), NSM_VERSION);
    }

    public function template_single_modular(){
        global $product;

        if(!is_product())
        return false;

        // Product details modular content
        if ($modules = get_field('modules', $product->get_id())):
            get_template_part('template-parts/loop/modules', null, ['modules' => $modules]);
        endif;

    }

    public function product_cat_information(){

        if( !is_tax('product_cat') )
        return false;

        $term = get_queried_object();

        if( $content = get_field( 'content', $term->taxonomy.'_'.$term->term_id ) ){ ?>
        <div class="container entry-content pb-20 fs-16 fs-sm-18">
            <?php echo $content ?>
        </div>
        <?php }

        if( $faq = get_field( 'faq', $term->taxonomy.'_'.$term->term_id ) ){ ?>
        <div class="lx-module module-faq py-30 py-sm-40">
            <?php 
            get_template_part( 'template-parts/module/faq', null, [ 'options' => [
                'faq_title'     => get_field( 'faq_title', $term->taxonomy.'_'.$term->term_id ),
                'faq'           => $faq,
                'faq_columns'   => 'md-6',
                'load_schema'   => true
            ]]); 
            ?>
        </div>
        <?php }

    }

    public function template_single_atc_text() {
        return __( 'Buy Now', 'nsm' ); 
    }

    /*=============================
    PRODUCT DETAIL HOOKS
    ===============================*/

    public function product_breadcrumbs(){
        if(function_exists('bcn_display') ){
            echo '<div class="breadcrumb mb-30" id="breadcrumb">';
            bcn_display();
            echo '</div>';
        }
    }

    public function breadcrumbs_schema( $data ){

        if( !function_exists('bcn_display_json_ld') )
        return $data;
        
        if( is_tax('product_cat') || is_singular('product') ){
            $navxt_schema = json_decode( bcn_display_json_ld( true ), true );
            $data['itemListElement'] = $navxt_schema['itemListElement'];
        }

        return $data;
    }

    public function template_single_title(){
        global $product;

        ?>
        <div class="entry-header d-flex ai-s jc-b">
            <div class="f-1">
                <div class="product-badges">
                <?php if( $badges  = get_field( 'product_badges', $product->get_id() ) ){ ?>
                    <?php foreach( $badges as $badge ){ ?>
                    <span class="badge p-relative text-center d-i-block px-5 py-5 tt-u fw-sb fs-12 tc-h mb-15 <?php echo $badge['background_color'] ?>">
                        <?php echo $badge['title'] ?>
                    </span>
                    <?php } } ?>
                </div>
                <h1 class="product_title entry-title h3 fw-500"><?php echo $product->get_title(); ?></h1>
            </div>
            <?php echo do_action( 'nsm/actions/product_title_single' ) ?>
        </div>
        <?php
    }

    public function subheader(){

        if(is_product())
        return false;

        get_template_part('template-parts/subheader');

    }

    public function shop_container_start(){
        echo '<div class="container pt-30 pt-sm-40 pb-30 pb-sm-40">';
    }

    public function div_close_tag(){
        echo '</div>';
    }

    public function template_loop_price(){
        global $product;
        
        if( $product->is_in_stock() && ( $product->get_price() != '' && $product->get_price() != 0 ) ){
            woocommerce_template_loop_price();
        }elseif( !$product->is_in_stock() ){
            echo '<p class="mt-5 tc-e mb-0 fw-sb fs-16">'.__('Sold Out', 'nsm').'</p>';
        }

    }

    public function template_loop_product_link_open(){
        global $product;
        echo '<a class="woocommerce-LoopProduct-link woocommerce-loop-product__link text-center h-100 d-flex fd-c jc-b" href="'.get_the_permalink($product->get_id()).'">';
    }

    public function product_thumbnail(){
        global $product;
        
        ?>
        <div class="product-body">
            <div class="product-thumbnail p-relative o-hidden">
            <?php if( $badges = get_field( 'product_badges', $product->get_id() ) ){ ?>
                <div class="product-badges d-flex fd-c">
                    <?php foreach( $badges as $badge ){ ?>
                    <span class="fs-12 text-center mb-15 tt-u fw-sb px-5 py-5 badge p-relative <?php echo $badge['background_color'] ?>">
                        <?php echo $badge['title'] ?>
                    </span>
                    <?php } ?>
                </div>
            <?php } ?>
            <?php
            if( $listing_image = get_field( 'listing_image', $product->get_id() ) ){
                nsm_acf_image($listing_image);
            }else{
                woocommerce_template_loop_product_thumbnail();
            }
            ?>
            </div>
        <?php 
    }

    public function change_aed_symbol( $currency_symbol, $currency ) {
        switch( $currency ) {
            case 'AED': 
                $currency_symbol = 'AED '; 
                break;
        }
        return $currency_symbol;
    }

    public function change_aed_symbol_woocs($currencies){
        foreach ($currencies as $key => $value){
            if ( $key =='AED' )
            $currencies[$key]['symbol'] = 'AED';
        }
        return $currencies;
    }
    
}