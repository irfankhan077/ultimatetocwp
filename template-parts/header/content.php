<?php if( get_field( 'header_top', 'option' ) ){ ?>
<div class="site-header-t border-b py-5 d-none d-md-block">
	<div class="container d-flex fd-rr ai-c jc-b">
		<?php get_template_part('template-parts/header/elements/contact'); ?>
	</div>
</div>
<?php } ?>

<div class="site-header-b">
	<div class="container">
		<div class="site-header-b-inner d-flex ai-c jc-b">
			<div class="site-branding py-5">
				<?php nsm_get_custom_logo(); ?>
			</div>
			<?php get_template_part('template-parts/header/elements/nav'); ?>
					
			<?php if( get_field( 'header_controls', 'option' ) || get_field( 'header_search', 'option' )){ ?>
			<div class="d-flex ai-c ml-auto mr-20">
				<ul class="controls d-flex ai-c">
					<?php if( get_field( 'header_search', 'options' ) ){ ?>
						<li class="d-none d-md-block">
							<span class="c-pointer search-form-trigger">
								<svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M15.853 16.56c-1.683 1.517-3.911 2.44-6.353 2.44-5.243 0-9.5-4.257-9.5-9.5s4.257-9.5 9.5-9.5 9.5 4.257 9.5 9.5c0 2.442-.923 4.67-2.44 6.353l7.44 7.44-.707.707-7.44-7.44zm-6.353-15.56c4.691 0 8.5 3.809 8.5 8.5s-3.809 8.5-8.5 8.5-8.5-3.809-8.5-8.5 3.809-8.5 8.5-8.5z"></path></svg>
							</span>
						</li>
					<?php } 
					if( get_field( 'header_controls', 'option' )) {?>
						<?php get_template_part( 'template-parts/header/elements/controls' );
					} ?>
				</ul>
			</div>
			<?php } ?>
			
			<span class="mm-trigger burger-menu aside-trigger d-flex d-md-none">
				<svg width="100" height="100" viewBox="0 0 100 100">
					<path class="line line1" d="M 20,29.000046 H 80.000231 C 80.000231,29.000046 94.498839,28.817352 94.532987,66.711331 94.543142,77.980673 90.966081,81.670246 85.259173,81.668997 79.552261,81.667751 75.000211,74.999942 75.000211,74.999942 L 25.000021,25.000058"></path>
					<path class="line line2" d="M 20,50 H 80"></path>
					<path class="line line3" d="M 20,70.999954 H 80.000231 C 80.000231,70.999954 94.498839,71.182648 94.532987,33.288669 94.543142,22.019327 90.966081,18.329754 85.259173,18.331003 79.552261,18.332249 75.000211,25.000058 75.000211,25.000058 L 25.000021,74.999942"></path>
				</svg>
			</span>

			<?php if( $text = get_field('header_cta_text', 'option') ){ ?>
			<div class="d-none d-md-block">
				<a class="btn btn-sm nsm-gtm_cta" href="<?php echo get_field('header_cta_link', 'option') ?>">
					<?php echo esc_html($text) ?>
				</a>
			</div>
			<?php } ?>

		</div>
	</div>
</div>