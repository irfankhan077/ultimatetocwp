<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$is_active_sidebar = is_active_sidebar('shop') && ( is_shop() || is_tax('product_cat') );
?>
<div class="row">
	<?php if($is_active_sidebar){ ?>
	<div class="md-3 sm-4">
		<?php dynamic_sidebar('shop') ?>
	</div>
	<?php } ?>
	<div class="<?php echo $is_active_sidebar ? 'md-9 sm-8' : 'md-12' ?>">
		<div class="products nsm-list-layout-1 columns-<?php echo esc_attr( wc_get_loop_prop( 'columns' ) ); ?>">

