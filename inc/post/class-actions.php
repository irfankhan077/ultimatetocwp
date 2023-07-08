<?php

class NSM_Post_Actions{

    /**
	* Class constructor.
	*
	* @since 1.0.0
	*/
	public function __construct(){
        add_action( 'wp_footer', [$this, 'enqueue_post_styles']);
	}

    /**
     * Enqueue the css specific for blog archive layout.
     * 
     * @since 1.0.0
     */
    public function enqueue_post_styles(){

        if( is_archive() )
        wp_enqueue_style('posts-list');
        
    }

}