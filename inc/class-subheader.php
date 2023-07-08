<?php
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Subheader main class
 *
 * @since 1.0.0
 */
class NSM_Subheader{

    /**
     * Id of the current page we are in.
     *
     * @since 1.0.0
     */
    protected $page_id = null;

    /**
     * Subheader title.
     *
     * @since 1.0.0
     */
    protected $title;

    /**
     * Subheader subtitle.
     *
     * @since 1.0.0
     */
    protected $subtitle;

    /**
     * Subheader background image.
     *
     * @since 1.0.0
     */
    protected $background_image;

    /**
     * Class constructor
     *
     * @since 1.0.0
     */
    public function __construct($page_id){

        $this->setup_subheader( $page_id );

    }

    /**
     * Setup the whole subheader object.
     *
     * @since 1.0.0
     */
    public function setup_subheader( $page_id ){

        // Set the page ID
        $this->page_id = $page_id;

        // Set the subheader title
        $this->title    = $this->set_title();

        // Set the subheader subtitle
        $this->subtitle = $this->set_subtitle();

        $this->background_image = $this->set_background_image();

    }

    /**
     * Set subheader title.
     *
     * @since 1.0.0
     */
    private function set_title(){
        $title = $this->page_id ? get_field( 'page_h1_title', $this->page_id ) : null;

        if( is_search() ){
            $title = esc_html__('Search Results for: ', 'nsm') . get_search_query();
        }elseif( is_404() ){
            $title = esc_html__('404', 'nsm');
        }elseif( is_tax() || is_category() || is_tag() ){
            $term = get_queried_object();
            $title = get_field( 'custom_h1', $term->taxonomy.'_'.$term->term_id );
        }
        
        return $title ? $title : wp_title('', '');
    }

    /**
     * Set subheader subtitle.
     *
     * @since 1.0.0
     */
    private function set_subtitle(){
        $subtitle = $this->page_id ? get_field( 'hero_text', $this->page_id ) : null;

        if( is_tax() || is_category() || is_tag() ){
            $term = get_queried_object();
            $subtitle = get_field( 'hero_text', $term->taxonomy.'_'.$term->term_id );
        }

        return $subtitle ? $subtitle : null;
    }

    /**
     * Set subheader background image.
     *
     * @since 1.0.0
     */
    private function set_background_image(){
        $background_image = $this->page_id ? get_field( 'background_image', $this->page_id ) : null;

        if( is_tax() || is_category() || is_tag() ){
            $term = get_queried_object();
            $background_image = get_field( 'subheader_image', $term->taxonomy.'_'.$term->term_id );
        }

        return $background_image ? $background_image : get_field( 'background_image', 'option' );

    }

    /**
     * Returns the subtitle of a given page.
     *
     * @since 1.0.0
     */
    public function get_subtitle(){
        return $this->subtitle;
    }

    /**
     * Returns the title of the current page being queried.
     *
     * @since 1.0.0
     */
    public function get_title(){
        return $this->title;
    }

    /**
     * Returns the background image of the current page being queried.
     *
     * @since 1.0.0
     */
    public function get_background_image(){
        return $this->background_image;
    }

}