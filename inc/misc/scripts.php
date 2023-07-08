<?php
if (!defined('ABSPATH')) {
  exit;
}

/**
 * Enqueue scripts and styles.
 * 
 * @since 1.0.0
 */
function nsm_scripts() {

  /**
   * Contains critical CSS (Every element that loads above the fold)
   * Anything else thats not above the fold will be loaded on demand
   * and added to its own stylesheet
   */
  wp_enqueue_style( 'main', NSM_URI . '/assets/css/main.css', array(), NSM_VERSION);
  wp_enqueue_style( 'critical', NSM_URI . '/assets/css/critical.css', array(), NSM_VERSION);

  // Enqueue the dynamic css inline.
  $dynamic_style = nsm_dynamic_style();
  if (!empty($dynamic_style)) {
    wp_add_inline_style('main', $dynamic_style);
  }
  
  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }
  
  wp_enqueue_script( 'main', NSM_URI . '/assets/js/main.js', ['jquery'], NSM_VERSION, true );
 // Enqueue the dynamic script inline.
  $dynamic_script = nsm_dynamic_script();
  if (!empty($dynamic_script)) {
    wp_add_inline_script('main', $dynamic_script);
  }
  wp_enqueue_script( 'slick', NSM_URI . '/assets/js/slick.min.js', array(), '1.8.1', true );

  wp_enqueue_script("module-settings", NSM_URI . '/assets/js/module-settings.js', [], NSM_VERSION, true);
  wp_localize_script( 'module-settings', 'nsm_ajax_object', [
    'ajaxurl' => admin_url('admin-ajax.php'),
    'finding' => get_field( 's_finding_search_text', 'options' ) ? get_field( 's_finding_search_text', 'options' ) : __('Search for News','nsm')
  ]);

  wp_dequeue_style('wp-block-library');
  wp_dequeue_style('wp-block-library-theme');

}
add_action( 'wp_enqueue_scripts', 'nsm_scripts' );

/**
 * Load Google fonts.
 * 
 * @since 1.0.0
 */
function nsm_load_google_fonts(){ 

  $font_families[] = 'family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap';
  $font_families[] = 'family=Roboto:wght@100;300;400;500;700;900&display=swap';

  $query_args = implode('&', $font_families);
  $fonts_url = 'https://fonts.googleapis.com/css2?'.$query_args;

  return $fonts_url;
}

/**
 * Enqueue Footer scripts
 *
 * @since 1.0.0
 */
function enqueue_footer_scripts(){
  wp_enqueue_style('google-fonts', nsm_load_google_fonts(), array(), null);
  wp_enqueue_style( 'slick', NSM_URI . '/assets/css/slick.min.css', array(), '1.8.1');
  wp_enqueue_script( 'parsley', NSM_URI . '/assets/js/parsley.min.js', array(), '1.0.0', true );

}
add_action( 'wp_footer', 'enqueue_footer_scripts' );

/**
 * Enqueue all admin scripts and styles
 * 
 * @since 1.0.0
 */
function nsm_enqueue_admin_scripts(){
	wp_enqueue_style( 'nsm-admin', NSM_URI . '/assets/css/admin/admin.css', [], '1.0.0' );
}
add_action( 'admin_enqueue_scripts', 'nsm_enqueue_admin_scripts' );

/**
 * Preload stylesheets that are not set to asset lazy
 *
 * @since 1.0.0
 */
function nsm_preload_styles( $html, $handle ){
  if( !is_admin() ){
    $html = str_replace("rel='stylesheet'", "rel='stylesheet preload' as='style' ", $html);
  }
  return $html;
}
add_filter( 'style_loader_tag',  'nsm_preload_styles', 10, 2 );

add_filter( 'jetpack_sharing_counts', '__return_false', 99 );
add_filter( 'jetpack_implode_frontend_css', '__return_false', 99 );