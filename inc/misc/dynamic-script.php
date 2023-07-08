<?php
/**
 * nsm Theme Customizer
 *
 * @package nsm
 */
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Return the dynamic css added from options.
 *
 * @since 1.0.0
 */
function nsm_dynamic_script(){ 

    ob_start();
    ?>
    
    <?php if( get_field( 'header_search', 'options' ) ){ ?>
(function ($) {
    'use strict';
    /*==========================
    SEARCH MODULE
    ==========================*/
    let delay = (callback, ms) => {
        var timer = 0;
        return function() {
          var context = this, args = arguments;
          clearTimeout(timer);
          timer = setTimeout(function () {
            callback.apply(context, args);
          }, ms || 0);
        };
    };
    jQuery(".search-form-trigger").on('click', function(e){
        e.preventDefault();
        $('body').toggleClass('search-form-active');
        setTimeout(function() {
            $("#nsm-search-form").find('.nsm_s').focus() 
        }, 500);
    });
    $("body").on('click', ".sp-trigger", function(e){
        e.preventDefault();
        $('body').removeClass('search-form-active');
    });
    let request;
    $("body").on('keyup', ".nsm_s",delay(function(){
        /*Abort any pending request*/
        if (request) {
            request.abort();
        }
        let $searchPopup = $(this).closest('.sp'),
        $ajaxData = $searchPopup.find(".ajax-data");
        $ajaxData.html(`<p class="px-10 py-10 mb-0">${nsm_ajax_object.finding}</p>`);
        let searchTerm = $(this).val();
        request = $.ajax({
            url: nsm_ajax_object.ajaxurl,
            type: "post",
            data: {
                action: 'ajax_nsm_search',
                nsm_s: searchTerm
            }
        });
        /*Callback handler that will be called on success*/
        request.done(function (response){
            $ajaxData.html(response.data.data);
        });
        /*Callback handler that will be called regardless*/
        /*if the request failed or succeeded*/
        request.always(function () {
            $ajaxData.show();
        });
    }, 500));
})(jQuery);
    <?php } ?>

    <?php
    $content = apply_filters('nsm/filters/dynamic_script', ob_get_clean());
    $content = str_replace(array("\r\n", "\r"), "\n", $content);
    $lines = explode("\n", $content);
    $dynamic_script = array();
    foreach ($lines as $i => $line) {
        if (!empty($line)) {
            $dynamic_script[] = trim($line);
        }
    }
    return implode($dynamic_script);
    
}