<?php
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Actions main class
 *
 * @since 1.0.0
 */
class NSM_Actions{

    /**
     * Class constructor
     *
     * @since 1.0.0
     */
    public function __construct(){
        add_filter( 'body_class', [$this, 'body_class'] );
        add_filter( 'excerpt_more', [$this, 'excerpt_more'] );
        add_filter( 'excerpt_length', [$this, 'excerpt_length'], 999 );
        add_filter( 'the_title', 'do_shortcode' );
        add_action( 'wp_footer', [$this, 'back_to_top'] );
        add_filter( 'get_avatar', [$this, 'acf_profile_avatar'], 10, 5);
        add_filter( 'wpseo_robots', [$this, 'noindex_paged'] );
        add_action( 'wp_head', [$this, 'business_schema']);
        add_filter( 'the_content', [$this, 'wrap_tables_with_div'] );
        add_filter( 'acf_the_content', [$this, 'wrap_tables_with_div'] );
        //add_filter( 'the_content', [$this, 'anchortag_unfollow_with_div'] );
        //add_filter( 'acf_the_content', [$this, 'anchortag_unfollow_with_div'] );

        add_filter('wp_revisions_to_keep', [$this, 'nsm_limit_revisions'], 10, 2);
    }

    /**
    * Wraps tables in the content with a div for responsiveness.
    *
    * @since 1.0.0
    */
    public function wrap_tables_with_div( $content ){
        return preg_replace_callback('~<table.*?</table>~is', function($match) {
            return '<div style="overflow:auto">' . $match[0] . '</div>';
        }, $content);
    }

    /**
    * NSM limit of page revisions
    *
    * @since 1.0.3
    */
    public function nsm_limit_revisions($num, $post){
        $n              = get_field( 'limit_revision', 'option' ) ? get_field( 'limit_revision', 'option' ) : '5';
        $target_types   = get_field( 'revision_post_types', 'options' ) ? get_field('revision_post_types','options') : array('page');
        $is_target_type = in_array($post->post_type, $target_types);
        return $is_target_type ? $n : $num;
    }

    /**
    * Anchor tag add rel unfollow.
    *
    * @since 1.0.0
    */
    public function anchortag_unfollow_with_div( $content ){

        // Get anchor tags
        // Check attributes ['id', 'class', 'data-', 'rel', 'href', 'target']
        // get class="$" id="$" data-"$" and store in an array
        // take the href and check if internal link/external link/mailto:/tel:
        // check the rel, if it has nofollow already, we wil (strpos) l continue/skip
        // check the target, if already set to _blank, continue, else add target _blank to external only
        // If no nofollow, we will take $ and append $ nofollow to them
        
        // return preg_replace_callback('~<(a\s[^>]+)>~isU', function($match){
        //     list($original, $tag) = $match;
        //     return strpos($tag, site_url()) ? $original : "<$tag rel='nofollow'>";
        // }, $content);
        $regexp_link = '/<a[^A-Za-z>](.*?)>(.*?)<\/a[\s+]*>/is';
        return preg_replace_callback($regexp_link, function($matches){
            $original_link = $matches[0];
            $atts = $matches[1];
            $label = $matches[2];
            //If href not exists in attribute return orignial link
            if(strpos($atts,'href') === false){
                return $original_link;
            }

            $created_link = $this->get_created_link( $label, $atts );
    
            if ( false === $created_link ) {
                return $original_link;
            }
    
            return $created_link;

            // echo '<pre>';
            // var_dump(explode('=',$matches[1]));
            // echo '</pre>';
            // $attributes = explode(' ',$matches[1]);
            // foreach($attributes as $key => $attribute){
            //     echo $attribute.'</br>';
            // }
            // list($original, $tag) = $matches;
            // return strpos($tag, site_url()) ? $original : "<$tag rel='nofollow'>";
        }, $content);

    }

    

    /**
    * Adds necessary classes to the body.
    *
    * @since 1.0.0
    */
    function body_class($classes){
        $subheader = nsm()->subheader;
        $classes[] = 'has-'.nsm()->header->get_position().'-header';
        return $classes;
    }

    /**
    * Return custom excerpt length.
    *
    * @since 1.0.0
    */
    function excerpt_length( $length ) {
        return 25;
    }

    /**
    * Return the markup for the more button.
    *
    * @since 1.0.0
    */
    function excerpt_more( $more ) {
        if (!is_admin())
            return '...';
    }

    /**
    * Add back to top.
    *
    * @since 1.0.0
    */
    public function back_to_top(){
        if( !get_field('enable_to_top', 'option') )
        return false;
        
        echo '<div class="to-top"></div>';
    }

    /**
    * Updates get_avatar with the custom acf user avatar.
    *
    * @since 1.0.0
    */
    public function acf_profile_avatar( $avatar, $id_or_email, $size, $default, $alt ){
        $user = false;
    
        if ( is_numeric( $id_or_email ) ) {
    
            $id = (int) $id_or_email;
            $user = get_user_by( 'id' , $id );
    
        } elseif ( is_object( $id_or_email ) ) {
    
            if ( ! empty( $id_or_email->user_id ) ) {
                $id = (int) $id_or_email->user_id;
                $user = get_user_by( 'id' , $id );
            }
    
        } else {
            $user = get_user_by( 'email', $id_or_email );   
        }
    
        if ( $user && is_object( $user ) ) {

            $custom_image = get_field( 'user_image', 'user_'.$user->ID );
            if( isset($custom_image['url']) && !empty($custom_image['url']) && isset($custom_image['alt']) ){
                $custom_url = $custom_image['url'];
                $custom_alt = $custom_image['alt'];
                $avatar = "<img alt='{$custom_alt}' src='{$custom_url}' class='avatar avatar-{$size} photo' height='{$size}' width='{$size}' />";
            }
    
        }
    
        return $avatar;
    }

    /**
    * Print the LocalBusiness & AutoRental schema markup
    *
    * @since 1.0.0
    */
    public function business_schema(){
        $obj = get_field('local_business_schema', 'option');

        if(get_field('local_business', 'option') != false){
            get_template_part( 'template-parts/schema/local-business', null, ['obj' => $obj] );
        }
        
    }

    /**
    * Sets pages 2 and above to noindex
    *
    * @since 1.0.0
    */
    public function noindex_paged( $robotsstr ){
        if ( is_page() && is_paged() )
        return 'noindex,follow';

        return $robotsstr;
    }

}