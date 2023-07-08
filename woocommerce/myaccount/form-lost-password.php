<?php
/**
 * Lost password form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-lost-password.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.2
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_lost_password_form' );
?>

<div class="nsm_auth-form">
    <form method="post" class="woocommerce-ResetPassword lost_reset_password px-20 py-20 border b-shadow bg-w">
        <div class="row ai-c">
            <div class="d-none d-sm-block sm-6 text-center">
                <?php 
                if( $image = get_field( 'woo_login_image', 'options' ) )
                nsm_acf_image( $image );
                ?>
            </div>
            <div class="sm-6">

                <p class="h5 text-center"><?php esc_html_e( 'Lost Password', 'nsm' ); ?></p>
                <p><?php echo apply_filters( 'woocommerce_lost_password_message', esc_html__( 'Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.', 'nsm' ) ); ?></p><?php // @codingStandardsIgnoreLine ?>

                <p class="woocommerce-form-row form-row w-100">
                    <label for="user_login"><?php esc_html_e( 'Username or email', 'nsm' ); ?></label>
                    <input class="woocommerce-Input woocommerce-Input--text input-text" type="text" name="user_login" id="user_login" autocomplete="username" />
                </p>

                <div class="clear"></div>

                <?php do_action( 'woocommerce_lostpassword_form' ); ?>

                <p class="woocommerce-form-row mb-0">
                    <input type="hidden" name="wc_reset_password" value="true" />
                    <button type="submit" class="woocommerce-Button button w-100" value="<?php esc_attr_e( 'Reset password', 'nsm' ); ?>"><?php esc_html_e( 'Reset password', 'nsm' ); ?></button>
                </p>

                <?php wp_nonce_field( 'lost_password', 'woocommerce-lost-password-nonce' ); ?>
            </div>
        </div>
    </form>
</div>
<?php
do_action( 'woocommerce_after_lost_password_form' );
