<?php $columns = $args['columns'];?>
<article id="post-<?php the_ID(); ?>" <?php post_class('layout-2 '.$columns.' sm-12 mb-30'); ?>>

	<div class="featured-image img-h p-relative">
		<?php NSM_Post_Helper::the_thumbnail( 'nsm-blog-md', get_the_ID(), ' w-100' ); ?>
	</div>
	
	<div class="mt-15 post-body"> 
		<header class="entry-header">
			<div class="entry-meta fs-12 mb-5"><?php NSM_Post_Helper::posted_on() ?></div>
			<?php NSM_Post_Helper::the_title('h4 mb-10 tt-n'); ?>
			<p class=""><?php echo wp_trim_words( wp_strip_all_tags(apply_filters( 'the_content', get_the_content() )), 5, '...');?></p>
		</header>
	</div>
	<a class="fs-12 fw-sb tc-p td-u-h d-flex btn-blog ai-c" href="<?php echo get_the_permalink() ?>"><?php esc_html_e('Explore More', 'nsm'); ?></a>
</article> 