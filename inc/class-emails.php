<?php

class NSM_Emails{

    /**
     * Send an email.
     * 
     * @param array $data - The data receieved
     * @param string $email_type - The type of email, possibilities are marked above each method below.
     * @param string $to - The list of recipients
     * @param string $subject - The subject of the email
     *
     * @since 1.0.0
     */
    public static function send( $data, $email_type, $to = '', $subject = '' ){

        ob_start();
        self::$email_type( $data );
        $body = ob_get_clean();

        $headers = array('Content-Type: text/html; charset=UTF-8');

        wp_mail( $to, $subject, $body, $headers );

    }

    /**
     * Email header.
     *
     * @since 1.0.0
     */
    private static function header(){
        get_template_part('template-parts/emails/header');
    }

    /**
     * Email footer
     *
     * @since 1.0.0
     */
    private static function footer(){
        get_template_part('template-parts/emails/footer');
    }


    /**
     * When a contact is placed.
     * @see $email_type in self::send()
     * 
     * @param array $data - The data receieved
     *
     * @since 1.0.0
     */
    private static function on_contact( $data ){

        self::header();

        get_template_part('template-parts/emails/contact', null, $data);

        self::footer();

    }

    /**
     * When a job application is placed.
     * @see $email_type in self::send()
     * 
     * @param array $data - The data receieved
     *
     * @since 1.0.0
     */
    private static function on_job_application( $data ){

        self::header();

        get_template_part('template-parts/emails/job-application', null, $data);

        self::footer();

    }
    
}