<?php

class NSM_View_Helper{

    public static function store( $product_id ){

        $views = [];

        if( $cookies =  NSM_Cookies_Helper::get('nsm_views') )
        $views = json_decode($cookies);

        if( !in_array( $product_id, $views ) )
        array_push( $views, $product_id );

        // Let's set the cookie for 1 week
        NSM_Cookies_Helper::set('nsm_views', json_encode($views, true), time() + (86400 * 7));

    }

}