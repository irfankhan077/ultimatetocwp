<?php
/**
 * Orders
 *
 * Shows orders on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/orders.php.
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

do_action( 'woocommerce_before_account_orders', $has_orders ); ?>

<h1 class="h4 ff-b"><?php esc_html_e('Your Orders', 'nsm') ?></h1>
<p class="bg-phue px-20 py-20 tc-h fw-500 fs-14"><?php esc_html_e('Keep track of all past orders you have made.', 'nsm') ?></p>

<?php if ( $has_orders ) : ?>

	<p class="h6">
		<?php
		printf( // WPCS: XSS OK.
			esc_html( _nx( '%1$s order placed', '%1$s orders placed', sizeof($customer_orders->orders), 'orders placed', 'nsm' ) ),
			number_format_i18n( sizeof($customer_orders->orders) ),
		);
		?>
	</p>

	<?php
	foreach ( $customer_orders->orders as $customer_order ) {
		$order      = wc_get_order( $customer_order ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
		$item_count = $order->get_item_count() - $order->get_item_count_refunded();
		?>
	<div class="nsm-order <?php echo $order->get_status() ?> bg-w mt-20 b-shadow px-5 py-5">

		<div class="nsm-order-header bg-l px-10 py-10 d-block d-sm-flex ai-c jc-b">
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
					<span class="d-block tt-u"><?php echo esc_html_e('Total', 'nsm') ?></span>
					<span class="fw-sb tc-l"><?php echo wp_kses_post( sprintf( _n( '%1$s for %2$s item', '%1$s for %2$s items', $item_count, 'nsm' ), $order->get_formatted_order_total(), $item_count ) ); ?></span>
				</div>
			</div>
			<div>
			<?php
			$actions = wc_get_account_orders_actions( $order );
			if ( ! empty( $actions ) ) {
				foreach ( $actions as $key => $action ) {
					echo '<a href="' . esc_url( $action['url'] ) . '" class="fs-12 ml-0 ml-sm-10 mr-10 mr-sm-0 tt-u fw-b ' . sanitize_html_class( $key ) . '">' . $key == 'view' ? __('View Order Details', 'nsm') : $action['name'] . '</a>';
				}
			}
			?>
			</div>
		</div>

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

	<?php }	?>

	<?php do_action( 'woocommerce_before_account_orders_pagination' ); ?>

<?php else : ?>
	<div class="woocommerce-message woocommerce-message--info woocommerce-Message woocommerce-Message--info woocommerce-info mb-0">
		<a class="woocommerce-Button button" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>"><?php esc_html_e( 'Browse products', 'nsm' ); ?></a>
		<?php esc_html_e( 'No order has been made yet.', 'nsm' ); ?>
	</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_account_orders', $has_orders ); ?>
