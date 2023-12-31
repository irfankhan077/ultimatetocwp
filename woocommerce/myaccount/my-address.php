<?php
/**
 * My Addresses
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-address.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.6.0
 */

defined( 'ABSPATH' ) || exit;

$customer_id = get_current_user_id();

if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) {
	$get_addresses = apply_filters(
		'woocommerce_my_account_get_addresses',
		array(
			'billing'  => __( 'Billing address', 'nsm' ),
			'shipping' => __( 'Shipping address', 'nsm' ),
		),
		$customer_id
	);
} else {
	$get_addresses = apply_filters(
		'woocommerce_my_account_get_addresses',
		array(
			'billing' => __( 'Billing address', 'nsm' ),
		),
		$customer_id
	);
}

?>
<h1 class="h4 ff-b"><?php esc_html_e('Addresses', 'nsm') ?></h1>
<p class="bg-phue px-20 py-20 tc-h fw-500 fs-14">
	<?php echo apply_filters( 'woocommerce_my_account_my_address_description', esc_html__( 'The following addresses will be used on the checkout page by default.', 'nsm' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
</p>

<?php if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) : ?>
	<div class="row">
<?php endif; ?>

<?php foreach ( $get_addresses as $name => $address_title ) : ?>
	<?php $address = wc_get_account_formatted_address( $name ); ?>

	<div class="sm-6 mb-10 mb-sm-0 woocommerce-Address">
		<div class="px-10 py-10 px-sm-20 py-sm-20 h-100 b-shadow bg-w">
            <header class="mb-15 woocommerce-Address-title title d-flex ai-c jc-b">
                <p class="h6 mb-0 d-i-block"><?php echo esc_html( $address_title ); ?></p>
                <a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address', $name ) ); ?>" class="td-u fw-500 edit"><?php echo $address ? esc_html__( 'Edit', 'nsm' ) : esc_html__( 'Add', 'nsm' ); ?></a>
            </header>
            <address class="mb-0">
                <?php echo $address ? wp_kses_post( $address ) : esc_html_e( 'You have not set up this type of address yet.', 'nsm' ); ?>
            </address>
        </div>
	</div>

<?php endforeach; ?>

<?php if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) : ?>
	</div>
	<?php
endif;
