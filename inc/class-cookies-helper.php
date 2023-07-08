<?php

class NSM_Cookies_Helper{

    /**
     * Set a cookie
     * 
     * @param string $key - The key of the cookie
     * @param string $value - The value to store in the cookie
     * @param string $duration - The time for cookie's life
     * 
     * @since 1.0.0
     */
    public static function set( $key, $value, $duration ){
        setcookie( $key, $value, $duration, "/");
    }

    /**
     * Unset a cookie
     * 
     * @param string $key - The key of the cookie
     * 
     * @since 1.0.0
     */
    public static function unset( $key ){

        if (isset($_COOKIE[$key])) {
            unset($_COOKIE[$key]);
            setcookie($key, '', time() - 3600, '/');
            return true;
        }
        return false;

    }

    /**
     * Get a cookie
     * 
     * @param string $key - The key of the cookie
     * 
     * @since 1.0.0
     */
    public static function get( $key ){
        return isset($_COOKIE[$key]) ? $_COOKIE[$key] : null;
    }

}