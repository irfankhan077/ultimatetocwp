<article id="post-<?php the_ID(); ?>" <?php post_class('layout-1 mb-30'); ?>>

	<div class="featured-image img-h p-relative">
		<?php NSM_Post_Helper::the_thumbnail( 'nsm-blog-md', get_the_ID(), ' br-12 w-100' ); ?>
	</div>
	
	<div class="mt-15 post-body">
		<header class="entry-header">
			<div class="entry-meta fs-12 mb-5"><?php NSM_Post_Helper::posted_on() ?></div>
			<?php NSM_Post_Helper::the_title('h4 mb-10'); ?>
		</header>
	</div>

	<a class="tt-u fs-12 fw-sb tc-p td-u-h" href="<?php echo get_the_permalink() ?>">Read More</a>
		
</article>