<?php
/*
    Template used to display post lists.
    
    Available params:
    ---------------------
    $args['layout'] - The layout we want to use
    $args['columns'] - The number of columns we want to use
    $args['query'] - Custom query arguments
*/

// Temporary fix to parse the category selected.
if( isset($args['query']['category']) ){
	$args['query']['cat'] = [$args['query']['category']];
}
$q = new WP_Query($args['query']);
?>
<?php if ( $q->have_posts() ){ ?>
	<div class="row">
		<?php
		while( $q->have_posts() ):
			$q->the_post();
			?>
			<div class="<?php echo $args['columns']; ?> sm-6">
				<?php get_template_part( 'template-parts/post/layouts/'. $args['layout'] ); ?>
			</div>
		<?php endwhile; ?>
	</div>
	<?php 
	the_posts_pagination( array( 'mid_size' => 2 ));
	wp_reset_postdata(); 
	?>
<?php }else{ ?>
	<?php get_template_part( 'template-parts/content/content', 'none' ); ?>
<?php } ?>
