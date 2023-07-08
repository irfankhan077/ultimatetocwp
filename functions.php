<?php
if ( ! defined( 'ABSPATH' ) ) exit;

define( 'NSM_DIR', get_template_directory() );
define( 'NSM_URI', get_template_directory_uri() );
if (!defined('NSM_VERSION')) {
    $my_theme = wp_get_theme();
    $theme_version = $my_theme->get( 'Version' );
    define('NSM_VERSION', $theme_version);
}

class NSM{
    
    /**
     * Class singleton property
     *
     * @since 1.0.0
     */
    private static $_instance = null;

    /**
	 * Header Object.
	 *
	 * @var object|NSM_Header
	 * @since 1.0.0
	 */
	public $header;

    /**
	 * Subheader Object.
	 *
	 * @var object|NSM_Subheader
	 * @since 1.0.0
	 */
	public $subheader;

    /**
     * Class constructor.
     *
     * @since 1.0.0
     */
    public function __construct(){

        add_action( 'wp', [$this, 'set_objects_with_post'], 999 );

    }

    /**
	 * Insures that only one instance of NSM exists in memory at any one
	 * time. Also prevents needing to define globals all over the place.
     *
     * @since 1.0.0
     */
    public static function get_instance(){

        if ( ! isset( self::$_instance ) && ! ( self::$_instance instanceof NSM ) ) {
            self::$_instance = new self();

			self::$_instance->includes();

            new NSM_Setup;
            new NSM_Actions;
            new NSM_Post_Actions;
            new NSM_Widget_Misc_func;

            self::$_instance->header = new NSM_Header;
            
		}

        return self::$_instance;
    }

    /**
     * Call all required files.
     *
     * @since 1.0.0
     */
    public function includes(){

        require_once NSM_DIR . '/inc/class-setup.php';
        require_once NSM_DIR . '/inc/class-actions.php';
        require_once NSM_DIR . '/inc/misc/acf.php';
        require_once NSM_DIR . '/inc/misc/scripts.php';
        require_once NSM_DIR . '/inc/misc/shortcodes.php';
        require_once NSM_DIR . '/inc/misc/shortcoder.php';
        require_once NSM_DIR . '/inc/misc/functions.php';
        require_once NSM_DIR . '/inc/misc/widget-function.php';
        require_once NSM_DIR . '/inc/misc/dynamic-css.php';
        require_once NSM_DIR . '/inc/misc/dynamic-script.php';
        require_once NSM_DIR . '/inc/misc/acf-fields_taxonomy-info.php';
        include_once NSM_DIR . '/inc/misc/init.php';

        require_once NSM_DIR . '/inc/class-header.php';
        require_once NSM_DIR . '/inc/class-subheader.php';


        require_once NSM_DIR . '/inc/class-helper.php';
        require_once NSM_DIR . '/inc/class-data.php';
        require_once NSM_DIR . '/inc/class-emails.php';

        require_once NSM_DIR . '/inc/post/class-helper.php';
        require_once NSM_DIR . '/inc/post/class-actions.php';

        // Modular
        require_once NSM_DIR . '/inc/post-types/module/post-type.php';
        require_once NSM_DIR . '/inc/post-types/module/taxonomies.php';
        require_once NSM_DIR . '/inc/post-types/module/widgets.php';
        require_once NSM_DIR . '/inc/post-types/module/class-module.php';
        require_once NSM_DIR . '/inc/post-types/module/class-settings.php';
        require_once NSM_DIR . '/inc/post-types/module/class-actions.php';

        // Cookies
        require_once NSM_DIR . '/inc/class-cookies-helper.php';

        // Service
        require_once NSM_DIR . '/inc/post-types/service/post-type.php';
        require_once NSM_DIR . '/inc/post-types/service/class-service.php';
        require_once NSM_DIR . '/inc/post-types/service/class-query.php';
        require_once NSM_DIR . '/inc/post-types/service/class-helper.php';
        require_once NSM_DIR . '/inc/post-types/service/class-actions.php';

        // Testimonial
        require_once NSM_DIR . '/inc/post-types/testimonial/post-type.php';
        require_once NSM_DIR . '/inc/post-types/testimonial/class-testimonial.php';
        require_once NSM_DIR . '/inc/post-types/testimonial/class-query.php';
        require_once NSM_DIR . '/inc/post-types/testimonial/class-helper.php';

        // Job
        require_once NSM_DIR . '/inc/post-types/job/post-type.php';
        require_once NSM_DIR . '/inc/post-types/job/taxonomies.php';
        require_once NSM_DIR . '/inc/post-types/job/class-job.php';
        require_once NSM_DIR . '/inc/post-types/job/class-actions.php';
        require_once NSM_DIR . '/inc/post-types/job/class-query.php';
        require_once NSM_DIR . '/inc/post-types/job/class-helper.php';

        // Project
        require_once NSM_DIR . '/inc/post-types/project/post-type.php';
        require_once NSM_DIR . '/inc/post-types/project/taxonomies.php';
        require_once NSM_DIR . '/inc/post-types/project/class-project.php';
        require_once NSM_DIR . '/inc/post-types/project/class-query.php';
        require_once NSM_DIR . '/inc/post-types/project/class-helper.php';

        // Howto
        require_once NSM_DIR . '/inc/post-types/how-to/acf-fields.php';
        require_once NSM_DIR . '/inc/post-types/how-to/post-type.php';
        require_once NSM_DIR . '/inc/post-types/how-to/functions.php';
      
        new NSM_Module_Actions;
        new NSM_Service_Actions;
        new NSM_Job_Actions;

        if( class_exists('WooCommerce') ){
            require_once NSM_DIR . '/inc/woocommerce/acf-fields_product-info.php';
            require_once NSM_DIR . '/inc/woocommerce/woocommerce-shortcoder.php';
            require_once NSM_DIR . '/inc/woocommerce/class-actions.php';
            
            new NSM_WooCommerce_Actions;

            if( class_exists('YITH_WCWL') ){
                require_once NSM_DIR . '/inc/woocommerce/class-yith-wcwl.php';
                new NSM_Yith_Wcwl;
            }

            // Views
            require_once NSM_DIR . '/inc/views/class-actions.php';
            require_once NSM_DIR . '/inc/views/class-helper.php';

            new NSM_View_Actions;
        }
        if(get_field( 'header_search', 'options' ) != false):
            require_once NSM_DIR . '/inc/misc/search-actions.php';
            new NSM_Search_Actions;
        endif;

        // Submissions
        require_once NSM_DIR . '/inc/post-types/submission/post-type.php';
        require_once NSM_DIR . '/inc/post-types/submission/class-submission.php';
        require_once NSM_DIR . '/inc/post-types/submission/class-query.php';
        require_once NSM_DIR . '/inc/post-types/submission/class-helper.php';
        require_once NSM_DIR . '/inc/post-types/submission/class-actions.php';

        new NSM_Submission_Actions;

        if ( defined( 'JETPACK__VERSION' ) ) 
        require NSM_DIR . '/inc/misc/jetpack.php';

    }

    /**
    * Create the subheader object. This method is hooked to the 'wp' action
    * so that we have access to the post global object.
    *
    * @since 1.0.0
    */
    public function set_objects_with_post(){
        $page_id = !is_archive() ? get_queried_object_id() : null;
        self::$_instance->subheader = new NSM_Subheader( $page_id );
    }

}

/**
 * Instantiate NSM class.
 *
 * @since 1.0.0
 */
function nsm(){
    return NSM::get_instance();
}
nsm();

require NSM_DIR . '/plugin-update-checker/plugin-update-checker.php';
$update_checker = Puc_v4_Factory::buildUpdateChecker(
    'https://github.com/neverstopmedia/nsm-startup-theme',
    __FILE__,
    get_template()
);
$update_checker->setAuthentication('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');
$update_checker->setBranch('main');

if(is_admin() && strpos($_SERVER['PHP_SELF'], 'themes.php') !== false){
    $update_checker->checkForUpdates();
}