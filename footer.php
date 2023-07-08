<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package nsm
 */
?>

	<?php get_sidebar('footer'); ?>

	<footer id="colophon" class="py-15 text-center fs-14 bg-w site-footer" role="contentinfo">
		<div class="container">
			<div class="site-info">
				<?php echo '&copy; '.date_i18n( __( 'Y', 'nsm' ) ).' '.get_bloginfo('name').__('. All Rights Reserved.','nsm');  ?> <?php if(is_home() || is_front_page()): ?><?php esc_html_e( 'Built with ❤️ by ', 'nsm' ); ?><a class="fw-500" target="_blank" href="https://neverstopmedia.com/">NeverStop Media</a> <?php endif; ?>
			</div>
		</div>
	</footer><!-- #colophon -->

	<?php wp_footer(); ?>

</body>
</html>