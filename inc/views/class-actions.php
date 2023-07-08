<?php

class NSM_View_Actions{

    public function __construct(){

        add_action( 'template_redirect', [$this, 'user_update'] );
        add_action( 'woocommerce_single_product_summary', [$this, 'display'], 10 );
        add_action( 'wp', [$this, 'schedule_clear_views_cron'] );
        add_action( 'clear_views', [$this, 'clear_cron'] );

    }

    /**
     * Add the weekly cron job for clearing views.
     * 
     * @since 1.0.0
     */
    public function schedule_clear_views_cron(){
        if( !wp_next_scheduled( 'clear_views' ) ) {
            wp_schedule_event( time(), 'weekly', 'clear_views' );  
        }
    }

    /**
     * Resets the product views to a default random between 10 and 20.
     * 
     * @since 1.0.0
     */
    public function clear_cron(){

        $products = new WP_Query([ 
            'post_type'      => 'product',
            'posts_per_page' => -1
        ]);

        if( $products->have_posts() ){
            while ( $products->have_posts() ){
                $products->the_post();
                
                add_row( "past_product_views", [ 
                    'view_count'      => get_post_meta( get_the_ID(), 'nsm_product_views', true ),
                    'view_date_range' => date("Y-m-d", strtotime("-1 week")) . ' / ' . date("y-m-d"),
                ], get_the_ID() );

                update_post_meta( get_the_ID(), 'nsm_product_views', rand(10, 20) );

            }
            wp_reset_postdata();
        }

    }

    /**
     * Update the view count of a product for the week.
     * 
     * @since 1.0.0
     */
    public function user_update(){

        if( !is_singular('product') )
        return false;

        global $product;
        $product = wc_get_product(get_the_ID());

        $views = [];
        
        NSM_View_Helper::store( $product->get_id() );
        if( $cookies = NSM_Cookies_Helper::get('nsm_views') )
        $views = json_decode($cookies);
        
        $current_views = get_post_meta( $product->get_id(), 'nsm_product_views', true ) ? get_post_meta( $product->get_id(), 'nsm_product_views', true ) : rand(10, 20);

        if( !in_array( $product->get_id(), $views ) )
        update_post_meta( $product->get_id(), 'nsm_product_views', (int)$current_views + 1 );
        
    }

    /**
     * Display the count of views.
     * 
     * @since 1.0.0
     */
    public function display(){

        global $product;

        if( $views = get_post_meta( $product->get_id(), 'nsm_product_views', true ) ){
            $past_views = get_field( 'past_product_views', $product->get_id() );
            ?>
            <p class="fs-14 tc-e my-15">This item has <b><?php echo sprintf( _n( '%s view', '%s views', $views, 'producty' ), $views ) ?></b> this week.</p>
            <?php

            // Add some admin data
            if( current_user_can('administrator') && $past_views ){
                ?>
                <div class="px-10 py-10 border mb-10">
                    <p class="mb-10 d-flex ai-c fs-14 fw-500">
                        Unique views for the past 5 weeks
                    </p>
                    <?php
                    $past_views = array_slice($past_views, -5);
                    foreach( $past_views as $key => $view ){

                        if(empty($view['view_count']))
                        continue;
                        
                        $dates = explode(' / ', $view['view_date_range']);

                        if(count($dates) < 2)
                        continue;

                        ?>
                        <div class="fs-14 mb-5">
                            <b><?php echo sprintf( _n( '%s view', '%s views',$view['view_count'], 'producty' ),$view['view_count'] ) ?></b>
                            between <?php echo date('M, d Y', strtotime($dates[0])) . ' & ' . date('M, d Y', strtotime($dates[1])) ?>
                            (<?php echo count($past_views) - $key == 1 ? 'Last week' : sprintf( _n( '%s week', '%s weeks', count($past_views) - $key , 'producty' ), count($past_views) - $key ) . ' ago' ?>)
                        </div>
                    <?php } ?>
                </div>
                <?php
            }

        }

    }

}