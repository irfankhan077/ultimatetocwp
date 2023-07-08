<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 4.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

do_action( 'woocommerce_before_customer_login_form' ); ?>

<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>

<div id="customer_login">

	<div class="nsm_auth-toggle nsm_tab-toggle mb-20 d-flex ai-c jc-c">
		<div class="nsm_auth-toggle-inner">
			<button type="button" class="active" name="button"> <?php esc_html_e('Login', 'nsm'); ?> </button>
			<button type="button" name="button"> <?php esc_html_e('Register', 'nsm'); ?> </button>
		</div>
	</div>

<?php endif; ?>

	<div class="nsm_auth-wrapper nsm_tab-wrapper nsm_auth-login">

	  	<div class="nsm_auth-form">

			<form class="woocommerce-form woocommerce-form-login login b-shadow" method="post">
				<div class="row ai-c">
					<div class="d-none d-sm-block sm-6 text-center">
					<?php 
					if( $image = get_field( 'woo_login_image', 'options' ) )
					nsm_acf_image( $image );
					?>
					</div>
					<div class="sm-6">
						<p class="h5 text-center"><?php esc_html_e( 'Login', 'nsm' ); ?></p>
			
						<?php do_action( 'woocommerce_login_form_start' ); ?>

						<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
							<label for="username"><?php esc_html_e( 'Username or email address', 'nsm' ); ?>&nbsp;<span class="required">*</span></label>
							<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
						</p>
						<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
							<label for="password"><?php esc_html_e( 'Password', 'nsm' ); ?>&nbsp;<span class="required">*</span></label>
							<input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" />
						</p>

						<?php do_action( 'woocommerce_login_form' ); ?>

						<div class="d-flex ai-c jc-b mb-15">
							<label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
								<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e( 'Remember me', 'nsm' ); ?></span>
							</label>
							<p class="woocommerce-LostPassword lost_password text-center mb-0">
								<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'nsm' ); ?></a>
							</p>
						</div>

						<p class="form-row">
							<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
							<button type="submit" class="woocommerce-button button woocommerce-form-login__submit" name="login" value="<?php esc_attr_e( 'Log in', 'nsm' ); ?>"><?php esc_html_e( 'Log in', 'nsm' ); ?></button>
						</p>

						<?php do_action( 'woocommerce_login_form_end' ); ?>
					</div>
				</div>
			</form>
		  	
	  	</div>

	</div>

<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>

	<div class="nsm_auth-wrapper nsm_tab-wrapper nsm_auth-register d-none">

        <div class="nsm_auth-form">

            <form method="post" class="woocommerce-form woocommerce-form-register register b-shadow" <?php do_action( 'woocommerce_register_form_tag' ); ?> >
				<div class="row ai-c">
					<div class="d-none d-sm-block sm-6 text-center">
					<?php 
					if( $image = get_field( 'woo_login_image', 'options' ) )
					nsm_acf_image( $image );
					?>
					</div>
					<div class="sm-6">
						<p class="h5 text-center"><?php esc_html_e( 'Register', 'nsm' ); ?></p>

						<?php do_action( 'woocommerce_register_form_start' ); ?>

						<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

							<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
								<label for="reg_username"><?php esc_html_e( 'Username', 'nsm' ); ?>&nbsp;<span class="required">*</span></label>
								<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
							</p>

						<?php endif; ?>

						<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
							<label for="reg_email"><?php esc_html_e( 'Email address', 'nsm' ); ?>&nbsp;<span class="required">*</span></label>
							<input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
						</p>

						<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

							<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
								<label for="reg_password"><?php esc_html_e( 'Password', 'nsm' ); ?>&nbsp;<span class="required">*</span></label>
								<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" />
							</p>

						<?php else : ?>

							<p><?php esc_html_e( 'A password will be sent to your email address.', 'nsm' ); ?></p>

						<?php endif; ?>

						<?php do_action( 'woocommerce_register_form' ); ?>

						<p class="woocommerce-FormRow form-row">
							<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
							<button type="submit" class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit" name="register" value="<?php esc_attr_e( 'Register', 'nsm' ); ?>"><?php esc_html_e( 'Register', 'nsm' ); ?></button>
						</p>

						<?php do_action( 'woocommerce_register_form_end' ); ?>
					</div>
				</div>
            </form>

        </div>

    </div>

</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
