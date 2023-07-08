<?php
/*
 * The Footer Widget Area
 * @package nsm
 */
 ?>
 <?php if ( is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3') ) : ?>
	 <div id="footer-sidebar" class="pt-30 pb-30 pt-sm-40 pb-sm-40 widget-area">

		 <div class="container">

		 	<div class="row">
				<div class="sidebar footer-column mt-30 mt-sm-0 md-3 sm-4">
					<div class="mr-sm-30">
						<?php 
						if( $content = get_field('about_the_company', 'option') )
						echo $content;
						?>
						<div class="d-flex ai-c">
							<?php get_template_part('template-parts/social-media'); ?>
						</div>
					</div>
				</div>
				<?php  if ( is_active_sidebar( 'footer-1' ) ) : ?>
				<div class="sidebar footer-column mt-30 mt-sm-0 md-3 sm-4"> 
					<?php dynamic_sidebar( 'footer-1'); ?> 
				</div>
				<?php endif;
				if ( is_active_sidebar( 'footer-2' ) ) : ?>
				<div class="sidebar footer-column mt-30 mt-sm-0 md-3 sm-4"> 
					<?php dynamic_sidebar( 'footer-2'); ?> 
				</div> 
				<?php endif;
				if ( is_active_sidebar( 'footer-3' ) ) : ?>
				<div class="sidebar footer-column mt-30 mt-sm-0 md-3 sm-4"> <?php
					dynamic_sidebar( 'footer-3'); ?> 
				</div>
				<?php endif; ?>
				
			 </div>
	 	</div>
	 </div>	<!--#footer-sidebar-->	
<?php endif; ?>

