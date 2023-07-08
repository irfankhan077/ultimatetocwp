<?php

if(function_exists('acf_add_options_page')){
    acf_add_options_page(array(
        'page_title' => __('Theme Settings', 'nsm'),
        'menu_title' => __('Theme Settings', 'nsm'),
        'menu_slug' => 'theme-settings',
        'capability' => 'edit_posts',
        'redirect' => false
    ));
}

function nsm_acf_save_path( $path ) {
    $path = NSM_DIR . '/acf-json';
    return $path;
}
add_filter('acf/settings/save_json', 'nsm_acf_save_path');

function nsm_acf_load_path( $paths ){
    // remove original path (optional)
    unset($paths[0]);
    $paths[] = NSM_DIR . '/acf-json';
    // return
    return $paths;
}
add_filter('acf/settings/load_json', 'nsm_acf_load_path');

function nsm_acf_image($img, $classes = ''){
    if(!$img)
        return false;

    ?>
    <img src="<?php echo esc_url($img['url']) ?>" class="<?php echo esc_attr($classes) ?>" alt="<?php echo esc_attr($img['alt']) ?>">
    <?php
}