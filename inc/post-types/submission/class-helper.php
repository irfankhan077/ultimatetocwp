<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class NSM_Submission_Helper{

    /**
     * Get Watches
     *
     * Retrieve submissions from the database.
     *
     * @since 1.0.0
     * @param array $args Arguments passed to get submissions
     * @return NSM_Submission_Query[] $submissions Watches retrieved from the database
     */
    public static function get_submissions( $args = array() ) {

        // Ignore the arguments with null values
        $args = array_filter($args);

        $submissions = new NSM_Submission_Query( $args );
        return $submissions->get_submissions();
    }
   
}