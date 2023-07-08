<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package nsm
 */
get_header();

get_template_part( 'template-parts/subheader' );

?>
<div class="pt-30 pb-30 pt-sm-40 pb-sm-40">

	<div class="container">

    <?php if ( have_posts() ){ ?>
        <div class="row">
        <?php
        while( have_posts() ):
            the_post();
            ?>
            <div class="<?php echo NSM_Post_Helper::get_columns() ?> sm-6">
            <?php get_template_part( 'template-parts/post/layouts/'. NSM_Post_Helper::get_layout() ); ?>
            </div>
        <?php endwhile; ?>
        </div>
        <?php 
        the_posts_pagination( array( 'mid_size' => 2 ));
        wp_reset_postdata(); 
    }else{
        get_template_part( 'template-parts/content/content', 'none' );
    }
    ?>

    </div>

</div>

<?php get_footer(); ?>
