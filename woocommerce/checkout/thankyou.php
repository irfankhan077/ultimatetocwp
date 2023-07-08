<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="woocommerce-order">

	<?php
	if ( $order ) :

		do_action( 'woocommerce_before_thankyou', $order->get_id() );
		?>

		<?php if ( $order->has_status( 'failed' ) ) : ?>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php esc_html_e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'nsm' ); ?></p>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
				<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php esc_html_e( 'Pay', 'nsm' ); ?></a>
				<?php if ( is_user_logged_in() ) : ?>
					<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php esc_html_e( 'My account', 'nsm' ); ?></a>
				<?php endif; ?>
			</p>

		<?php else : ?>

            <div class="ml-auto mr-auto mw-700 px-20 py-20 px-sm-30 py-sm-30 bg-w b-shadow">
                <div class="text-center">
                    <h1 class="h4 mt-20"><?php esc_html_e('Your order is successful!', 'nsm') ?></h1>
                </div>

                <ul class="woocommerce-order-overview woocommerce-thankyou-order-details fs-14 mb-30">

                    <li class="woocommerce-order-overview__order order py-10 border-b d-sm-flex ai-c">
                        <span class="w-150px"><?php esc_html_e( 'Order number:', 'nsm' ); ?></span>
                        <strong class="d-block f-1 tc-l"><?php echo $order->get_order_number(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
                    </li>

                    <li class="woocommerce-order-overview__date date py-10 border-b d-sm-flex ai-c">
                        <span class="w-150px"><?php esc_html_e( 'Date:', 'nsm' ); ?></span>
                        <strong class="d-block f-1 tc-l"><?php echo wc_format_datetime( $order->get_date_created() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
                    </li>

                    <?php if ( is_user_logged_in() && $order->get_user_id() === get_current_user_id() && $order->get_billing_email() ) : ?>
                        <li class="woocommerce-order-overview__email email py-10 border-b d-sm-flex ai-c">
                            <span class="w-150px"><?php esc_html_e( 'Email:', 'nsm' ); ?></span>
                            <strong class="d-block f-1 tc-l"><?php echo $order->get_billing_email(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
                        </li>
                    <?php endif; ?>

                    <li class="woocommerce-order-overview__total total py-10 border-b d-sm-flex ai-c">
                        <span class="w-150px"><?php esc_html_e( 'Total:', 'nsm' ); ?></span>
                        <strong class="d-block f-1 tc-l"><?php echo $order->get_formatted_order_total(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
                    </li>

                    <?php if ( $order->get_payment_method_title() ) : ?>
                        <li class="woocommerce-order-overview__payment-method method pt-10 d-sm-flex ai-c">
                            <span class="w-150px"><?php esc_html_e( 'Payment method:', 'nsm' ); ?></span>
                            <strong class="d-block f-1 tc-l"><?php echo wp_kses_post( $order->get_payment_method_title() ); ?></strong>
                        </li>
                    <?php endif; ?>

                </ul>

                <?php do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() ); ?>
		        <?php do_action( 'woocommerce_thankyou', $order->get_id() ); ?>

            </div>

            <div class="text-center mt-30">
                <a href="<?php echo site_url('/') ?>" class="btn"><?php esc_html_e('Back Home', 'nsm') ?></a>
            </div>

		<?php endif; ?>

	<?php else : ?>

		<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you. Your order has been received.', 'nsm' ), null ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>

	<?php endif; ?>

</div>