<?php

class NSM_Search_Actions{

    public function __construct(){

        add_action( 'wp_ajax_nopriv_ajax_nsm_search', [$this, 'ajax_nsm_search'] );
        add_action( 'wp_ajax_ajax_nsm_search', [$this, 'ajax_nsm_search'] ); 
        add_action( 'wp_footer', [$this, 'nsm_search'] );
    }

    /**
    * NSM Search form function handler.
    *
    * @since 1.0.0
    */
    public function ajax_nsm_search(){

        $data = [
            'keyword'     => sanitize_text_field( $_POST['nsm_s'] ),
        ];
        
        $data = array_filter($data);

        $layout = get_field( 'search_layout', 'options' ) ? get_field('search_layout','options') : '1';
        $columns = get_field( 'search_columns', 'options' ) ? get_field('search_columns','options') : 'md-3';
        $posttypes = get_field( 'select_post_type', 'options' ) ? get_field('select_post_type','options') : 'post';

        $the_query = new WP_Query( array( 'showposts'=>'-1', 's' => esc_attr( $data['keyword'] ), 'post_type' => $posttypes, 'post_status' => array( 'publish' ) ) );
        if( $the_query->have_posts() ) :
            ?>
            <div class="d-sm-flex ai-c jc-b mb-15"><span class="d-block fw-sb fs-16 fs-sm-18"><?php esc_html_e( 'Search Results : ', 'nsm' ); ?> <?php echo $the_query->post_count ?></span></div>
                <div class="row gutter-sm">
                <?php
                while( $the_query->have_posts() ): $the_query->the_post();
                    get_template_part( 'template-parts/search/layout-'.$layout, null, [
                        'columns'   =>  $columns,
                    ]);
                endwhile;
            wp_reset_postdata();  
        else: 
            ?>
            <h3><?php echo __('No Results Found', 'nsm') ?></h3>
            <?php
        endif;
        ?>
            </div>
        </div>
        <?php
        wp_send_json_success( [ 'data' => ob_get_clean(), 'message' => __('We have received your products.', 'nsm') ] );
    }

    public static function get_color_tax($pid,$tax)
    {
        $terms = get_the_terms($pid, $tax);
        $colors ='';
        if($terms):
            $colors .='<p class="loop-color mb-10">';
            foreach($terms as $term) {
                $colors .= '<span style="background:'.get_term_meta( $term->term_id, '_yith_wccl_value', true, $tax ).'"></span>';
            }
            $colors .='</p>';
        endif;
        echo $colors;
    }


    /**
    * Search Section
    *
    * @since 1.0.0
    */
    public function nsm_search(){ ?> 
        <div class="sp py-20 px-md-40 py-md-40 w-100 h-100 bg-w nsm-search-form" id="nsm-search-form"> 

            <div class="sp-sticky container d-flex ai-c">
                <div class="ml-15 ml-md-0 close d-flex ai-c jc-c sp-trigger py-sm-40 pl-20 pr-sm-40 pr-20 py-20 c-pointer">
                    <span class="d-block"></span>
                    <span class="d-block"></span>
                </div>
                <p class="h3 d-none d-sm-block tt-u fw-b mb-0 ml-30"><?php echo get_field( 's_popup_heading', 'options' ) ? get_field( 's_popup_heading', 'options' ) : __('Browse our lastest news','nsm'); ?></p>
            </div>

            <div class="container overflow">
                <form method="GET" class="p-relative search-form mb-20 form--disable-enter-key">
                    <div class="d-flex ai-c w-100 p-relative">
                        <div class="search-icon d-flex ai-c jc-c">
                            <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M15.853 16.56c-1.683 1.517-3.911 2.44-6.353 2.44-5.243 0-9.5-4.257-9.5-9.5s4.257-9.5 9.5-9.5 9.5 4.257 9.5 9.5c0 2.442-.923 4.67-2.44 6.353l7.44 7.44-.707.707-7.44-7.44zm-6.353-15.56c4.691 0 8.5 3.809 8.5 8.5s-3.809 8.5-8.5 8.5-8.5-3.809-8.5-8.5 3.809-8.5 8.5-8.5z"></path></svg>
                        </div>
                        <input type="text" autocomplete="off" class="nsm_s fs-sm-20" name="nsm_s" placeholder="<?php echo get_field( 's_search_placeholder', 'options' ) ? get_field( 's_search_placeholder', 'options' ) : __('Search for News','nsm'); ?>">
                    </div>
                </form>
                
                
                <div class="ajax-data"></div>
            </div>

            </div>
        <?php
    }

}