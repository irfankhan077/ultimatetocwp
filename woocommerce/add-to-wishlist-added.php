<?php
/**
 * Add to wishlist button template - Added to list
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Wishlist
 * @version 3.0.0
 */

/**
 * Template variables:
 *
 * @var $wishlist_url string Url to wishlist page
 * @var $exists bool Whether current product is already in wishlist
 * @var $show_exists bool Whether to show already in wishlist link on multi wishlist
 * @var $product_id int Current product id
 * @var $product_type string Current product type
 * @var $label string Button label
 * @var $browse_wishlist_text string Browse wishlist text
 * @var $already_in_wishslist_text string Already in wishlist text
 * @var $product_added_text string Product added text
 * @var $icon string Icon for Add to Wishlist button
 * @var $link_classes string Classed for Add to Wishlist button
 * @var $available_multi_wishlist bool Whether add to wishlist is available or not
 * @var $disable_wishlist bool Whether wishlist is disabled or not
 * @var $template_part string Template part
 * @var $loop_position string Loop position
 */

if ( ! defined( 'YITH_WCWL' ) ) {
	exit;
} // Exit if accessed directly

global $product;
?>

<a href="#"
  rel="nofollow"
  class="wishlist-trigger"
  title="<?php echo esc_attr__('Browse Wishlist', 'nsm') ?>"
  data-title="<?php echo esc_attr( apply_filters( 'yith_wcwl_add_to_wishlist_title', $label ) ); ?>">
    <svg width="24" height="24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 13.066 13.066" xml:space="preserve">
      <path style="fill:#d92929;" d="M6.555,12.558c-0.098,0-0.195-0.034-0.273-0.103c-0.233-0.2-5.718-4.954-6.199-7.885
        C-0.133,3.243,0.071,2.201,0.69,1.474C1.22,0.85,2.034,0.507,2.982,0.507c0.082,0,0.165,0.002,0.247,0.008
        c0.058-0.003,0.115-0.004,0.172-0.004c1.048,0,2.343,0.461,3.109,2.421c0.43-1.196,1.311-2.417,3.328-2.417
        c1.135,0,2.023,0.342,2.571,0.987c0.597,0.701,0.787,1.733,0.569,3.068c-0.479,2.929-5.918,7.684-6.149,7.884
        C6.751,12.524,6.653,12.558,6.555,12.558z"/>
    </svg>
</a>
