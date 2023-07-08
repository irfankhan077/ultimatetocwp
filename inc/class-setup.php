<?php
if (!defined('ABSPATH')) {
    exit;
}

/**
 * theme functions and definitions
 *
 * @package nsm
 */
class NSM_Setup{

    /**
     * Class constructor
     *
     * @since 1.0.0
     */
    public function __construct(){

        add_action( 'after_setup_theme', [ $this, 'setup' ] );
        add_action( 'widgets_init', [ $this, 'widgets_init' ] );
        
    }

    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    public function setup() {

        // Make theme available for translation.
        load_theme_textdomain('nsm', NSM_DIR . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        /*
        * Let WordPress manage the document title.
        * By adding theme support, we declare that this theme does not use a
        * hard-coded <title> tag in the document head, and expect WordPress to
        * provide it for us.
        *
        */
        add_theme_support( 'title-tag' );

        /*
        * Enable support for Post Thumbnails on posts and pages.
        *
        * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
        */
        add_theme_support( 'post-thumbnails' );

        //Custom Logo
        add_theme_support( 'custom-logo' );

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus( array(
            'primary' => __( 'Primary Menu', 'nsm' ),
            'mobile' => __( 'Mobile Menu', 'nsm' ),
        ) );

        /*
        * Switch default core markup for search form, comment form, and comments
        * to output valid HTML5.
        */
        add_theme_support( 'html5', array(
            'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
        ) );

        /*
        * Enable support for Post Formats.
        * See http://codex.wordpress.org/Post_Formats
        */
        add_theme_support( 'post-formats', array(
            'image', 'video', 'quote', 'link',
        ) );

        // Set up the WordPress core custom background feature.
        add_theme_support( 'custom-background', apply_filters( 'nsm_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        ) ) );

        add_image_size('nsm-blog-md', 540, 390, true );
        add_image_size('nsm-dekstop-bg', 1920, 0, false);
        add_image_size('nsm-mobile-bg', 767, 0, false);

        add_theme_support( 'woocommerce' );
        add_theme_support( 'wc-product-gallery-zoom' ); //Only if want woocommerce built in
        add_theme_support( 'wc-product-gallery-lightbox' );//Only if want woocommerce built in
        add_theme_support( 'wc-product-gallery-slider' );//Only if want woocommerce built in
        
    }

    /**
     * Register widget area.
     *
     * @link http://codex.wordpress.org/Function_Reference/register_sidebar
     */
    function widgets_init() {
        register_sidebar( array(
            'name'          => __( 'Sidebar', 'nsm' ),
            'id'            => 'sidebar-1',
            'description'   => '',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<p class="widget-title h6"><span>',
            'after_title'   => '</span></p>',
        ) );

        register_sidebar( array(
            'name'          => __( 'Footer 1', 'nsm' ),
            'id'            => 'footer-1',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<p class="widget-title h6 mb-20"><span>',
            'after_title'   => '</span></p>',
        ) );

        register_sidebar( array(
            'name'          => __( 'Footer 2', 'nsm' ),
            'id'            => 'footer-2',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<p class="widget-title h6 mb-20"><span>',
            'after_title'   => '</span></p>',
        ) );

        register_sidebar( array(
            'name'          => __( 'Footer 3', 'nsm' ),
            'id'            => 'footer-3',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<p class="widget-title h6 mb-20"><span>',
            'after_title'   => '</span></p>',
        ) );

    }

}