<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package nsm
 */
if (!defined('ABSPATH')) {
    exit;
}
/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function nsm_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer' => false,
		'type' => 'click',
		'render' => 'nsm_jetpack_render_posts',
		'posts_per_page' => 10
	) );
}
add_action( 'after_setup_theme', 'nsm_jetpack_setup' );

function nsm_jetpack_render_posts() {
	while( have_posts() ) {
	    the_post();
		get_template_part( 'template-parts/blog/layout' , get_field('post_layout', 'option') );
	}
}

function nsm_filter_jetpack_infinite_scroll_js_settings( $settings ) {
    $settings['text'] = __( 'Load more posts...', 'nsm' );
    return $settings;
}
add_filter( 'infinite_scroll_js_settings', 'nsm_filter_jetpack_infinite_scroll_js_settings' );