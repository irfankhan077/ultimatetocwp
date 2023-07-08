<?php
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Header main class
 *
 * @since 1.0.0
 */
class NSM_Header{

    /**
     * Header classes.
     *
     * @since 1.0.0
     */
    public $classes = [];

    /**
     * Class constructor
     *
     * @since 1.0.0
     */
    public function __construct(){
        $this->setup_header();
    }

    /**
     * Setup the whole header object.
     *
     * @since 1.0.0
     */
    public function setup_header(){

        // Set header classes
        $this->classes  = $this->set_classes();

    }

    /**
     * Set the header classes
     *
     * @since 1.0.0
     */
    private function set_classes(){
        $classes    = [];
        $classes[]  = 'site-header';
        $classes[]  = $this->get_position();

        return implode( ' ', $classes );
    }

    /**
     * Returns the header classes
     *
     * @since 1.0.0
     */
    public function get_classes(){
        return $this->classes;
    }

    /**
     * Get the header position
     *
     * @since 1.0.0
     */
    public function get_position(){
        return get_field('header_position', 'option');
    }

}