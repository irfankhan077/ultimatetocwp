<?php
/**
 * View Order
 *
 * Shows the details of a particular order on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/view-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.0.0
 */

defined( 'ABSPATH' ) || exit;

$notes              = $order->get_customer_order_notes();
$item_count         = $order->get_item_count() - $order->get_item_count_refunded();
$shipping_address   = $order->get_formatted_shipping_address();
$billing_address    = $order->get_formatted_billing_address();
?>
<h1 class="h4 ff-b"><?php echo __( 'Order #', 'nsm' ) . $order->get_order_number() ?></h1>

<div class="nsm-order-header bg-l px-10 py-10 mb-20 d-block d-sm-flex ai-c jc-b">
    <div class="d-block d-sm-flex ai-c">
        <div class="mr-sm-20 mb-10 mb-sm-0 fs-14">
            <span class="d-block tt-u"><?php esc_html_e('Order No.', 'nsm') ?></span>
            <a class="fw-sb tc-l" href="<?php echo esc_url( $order->get_view_order_url() ); ?>">
                <?php echo esc_html( _x( '#', 'hash before order number', 'nsm' ) . $order->get_order_number() ); ?>
            </a>
        </div>
        <div class="mr-sm-20 mb-10 mb-sm-0 fs-14">
            <span class="d-block tt-u"><?php esc_html_e('Order Date', 'nsm') ?></span>
            <time class="fw-sb tc-l" datetime="<?php echo esc_attr( $order->get_date_created()->date( 'c' ) ); ?>"><?php echo esc_html( $order->get_date_created()->date('M d, Y') ); ?></time>
        </div>
        <div class="mr-sm-20 mb-10 mb-sm-0 fs-14">
            <span class="d-block tt-u"><?php esc_html_e('Total', 'nsm') ?></span>
            <span class="fw-sb tc-l"><?php echo wp_kses_post( sprintf( _n( '%1$s for %2$s item', '%1$s for %2$s items', $item_count, 'nsm' ), $order->get_formatted_order_total(), $item_count ) ); ?></span>
        </div>
    </div>
    <div>
    <?php
    $actions = wc_get_account_orders_actions( $order );
    if ( ! empty( $actions ) ) {
        foreach ( $actions as $key => $action ) {
            if( $key == 'view' )
            continue;

            echo '<a href="' . esc_url( $action['url'] ) . '" class="fs-12 ml-0 ml-sm-10 mr-10 mr-sm-0 tt-u fw-b ' . sanitize_html_class( $key ) . '">' . esc_html( $action['name'] ) . '</a>';
        }
    }
    ?>
    </div>
</div>

<div class="px-15 pt-15 bg-w b-shadow">
    <div class="row">
        <div class="md-4 mb-15">
            <p class="fw-sb tc-h fs-14 fs-md-16 mb-5"><?php esc_html_e('Shipping Address', 'nsm') ?></p>
            <?php echo $shipping_address ? $shipping_address : __('You have not set up this type of address yet.', 'nsm'); ?>
        </div>
        <div class="md-4 mb-15">
            <p class="fw-sb tc-h fs-14 fs-md-16 mb-5"><?php esc_html_e('Billing Address', 'nsm') ?></p>
            <?php echo $billing_address ? $billing_address : __('You have not set up this type of address yet.', 'nsm'); ?>
        </div>
        <div class="md-4 mb-15">
            <p class="fw-sb tc-h fs-14 fs-md-16 mb-5"><?php esc_html_e('Payment Method', 'nsm') ?></p>
            <?php echo $order->get_payment_method_title(); ?>
        </div>
        <div class="md-8 mb-15">
            <p class="fw-sb tc-h fs-14 fs-md-16 mb-5"><?php esc_html_e('Order Summary', 'nsm') ?></p>
            <div class="d-flex ai-c jc-b mb-10">
                <span><?php esc_html_e('Subtotal', 'nsm') ?></span>
                <span><?php echo $order->get_subtotal_to_display() ?></span>
            </div>
            <div class="d-flex ai-c jc-b mb-10">
                <span><?php esc_html_e('Tax (Inclusive)', 'nsm') ?></span>
                <span><?php echo $order->get_total_tax() ?></span>
            </div>
            <div class="d-flex ai-c jc-b mb-10">
                <span><?php esc_html_e('Discount', 'nsm') ?></span>
                <span><?php echo $order->get_total_discount() ?></span>
            </div>
            <div class="d-flex ai-c jc-b mb-10">
                <b class="tc-h"><?php esc_html_e('Total', 'nsm') ?></b>
                <b class="tc-h"><?php echo $order->get_formatted_order_total() ?></b>
            </div>
        </div>
    </div>
</div>

<div class="nsm-order <?php echo $order->get_status() ?> bg-w my-20 b-shadow px-5 py-5">
    
    <div class="nsm-order-body p-relative px-10 pt-10">
        <div class="d-i-flex ai-c mb-10 nsm-order-status fs-14 px-10 py-10 fw-500 text-center <?php echo $order->get_status() ?>">
        <span class="d-block mr-5 br-round"></span>
        <?php echo esc_html( wc_get_order_status_name( $order->get_status() ) ); ?>
        </div>
        <?php 
        foreach ( $order->get_items() as $item_id => $item ) {
            global $product;
            $product = $item->get_product();
            
            ?>
        <div class="d-flex ai-c mb-10">
            <div class="w-60px w-sm-100px">
            <?php 
            if( $listing_image = get_field( 'listing_image', $product->get_id() ) ){
                nsm_acf_image($listing_image);
            }else{
                woocommerce_template_loop_product_thumbnail();
            }
            ?>
            </div>
            <a class="ml-15 f-1 fs-14 fs-md-16 mw-470" href="<?php echo get_the_permalink($product->get_id()) ?>"><?php echo $product->get_title(); ?></a>
        </div>
        <?php } ?>
        
    </div>

</div>

<?php if ( $notes ) : ?>
    <p class="h5"><?php esc_html_e('Order Updates', 'nsm') ?></p>
	<ol class="woocommerce-OrderUpdates commentlist notes">
		<?php foreach ( $notes as $note ) : ?>
		<li class="woocommerce-OrderUpdate comment note">
			<div class="woocommerce-OrderUpdate-inner comment_container">
				<div class="woocommerce-OrderUpdate-text comment-text">
					<p class="woocommerce-OrderUpdate-meta meta"><?php echo date_i18n( esc_html__( 'l jS \o\f F Y, h:ia', 'nsm' ), strtotime( $note->comment_date ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
					<div class="woocommerce-OrderUpdate-description description">
						<?php echo wpautop( wptexturize( $note->comment_content ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
			</div>
		</li>
		<?php endforeach; ?>
	</ol>
<?php endif; ?>

<p class="bg-phue px-20 py-20 mb-0 tc-h fw-500 fs-14">
	<?php esc_html_e('Have any questions about your order, you can contact us at any time for any follow up.', 'nsm') ?>
</p>