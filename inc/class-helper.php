<?php
/**
 * Class responsible for handlind post type meta
 * 
 * @since 1.0.0
 *
 */
class NSM_Helper{

    /**
     * Get acf meta.
     *
     * @since 1.0.0
     */
    public static function get_meta( $id, $meta_keys = [] ){

        if( empty($meta_keys) ){
            return false;
        }

        // In case the key was fetched as a string instead of array
        if( !is_array($meta_keys) && !empty($meta_keys) ){
            $meta_keys = [$meta_keys];
        }

        $meta_arr = [];

        foreach( $meta_keys as $key => $val ){
            $meta_arr[$val] = get_field( $val, $id );
        }

        return $meta_arr;

    }

    /**
     * Get taxonomy terms.
     * 
     * @param int @post_id - The post id to get terms for
     * @param string @tax - The taxonomy in which we want to get terms for
     *
     * @since 1.0.0
     */
    public static function get_tax_terms( $post_id = null, $tax ){
        if($post_id){
            $terms = get_the_terms( $post_id, $tax );
        }else{
            $terms = get_terms( $tax );
        }

        return $terms && !is_wp_error( $terms ) ? $terms : false;
    }

    /**
     * Returns the first term of a given tax for a post.
     *
     * @since 1.0.0
     */
    public static function get_first_tax_term( $post_id, $tax ){
        $terms = self::get_tax_terms($post_id, $tax);
        return $terms && isset($terms[0]) ? $terms[0] : false;
    }

    /**
     * Build pagination
     *
     * @since 1.0.0
     *
     * @param array $args The arguments used to build the pagination.
     */
    public static function pagination( $args = array(), $paged = '' ) {

        $big = 999999;

        $defaults = array(
            'base'    => str_replace( array( $big, '#038;' ), array( '%#%', '&' ), esc_url( get_pagenum_link( $big ) ) ),
            'format'  => '?page=%#%',
            'current' => max( 1, get_query_var( 'page' ) ),
            'type'    => '',
            'total'   => '',
        );

        $args = wp_parse_args( $args, $defaults );

        $type  = $args['type'];
        $total = $args['total'];

        if ( is_single() ) {
			$args['base'] = get_permalink() . '%#%';
		}

        if( $paged ){
            $args['current'] = max( 1, $paged );
        }

        // Type and total must be specified.
        if ( empty( $type ) || empty( $total ) ) {
            return false;
        }

        $pagination = paginate_links(
            array(
                'base'    => $args['base'],
                'format'  => $args['format'],
                'current' => $args['current'],
                'total'   => $total
            )
        );

        if ( ! empty( $pagination ) ) : ?>
            <div id="<?php echo $type; ?>_pagination" class="mt-30 pagination navigation">
                <?php echo $pagination; ?>
            </div>
        <?php endif;
    }

    private static function generate_random_password() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    /**
     * Get the users IP address.
     * 
     * @since 1.0.0
     */
    public static function get_ip_address(){
        $ip = $_SERVER['REMOTE_ADDR'];
        if( isset($_SERVER['HTTP_CLIENT_IP']) ){
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }

        return $ip;
    }

    /**
     * Returns an array of posts as a key value pair (id => name)
     * 
     * @param $post_type - The post type we want to get.
     *
     * @since 1.0.0
     */
    public static function populate_posts_dropdown( $post_type ){
        $posts_list = [];

        $posts = get_posts([
            'numberposts'   => -1,
            'post_type'     => $post_type,
            'post_status'   => ['publish'],
            ''
        ]); 

        if($posts){
            foreach($posts as $post) {
                $posts_list[$post->ID] = $post->post_title;
            }
        }

        return $posts_list;
    }

}