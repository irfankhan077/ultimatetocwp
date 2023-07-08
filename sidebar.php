<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package nsm
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>
<div class="md-4 mt-30 mt-md-0">
	<div id="secondary" class="sidebar ml-md-40" role="complementary">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div>
</div>