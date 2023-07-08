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

$term = get_queried_object();
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

<?php if( $content = get_field( 'content', $term->taxonomy.'_'.$term->term_id ) ){ ?>
<div class="container entry-content pb-20 fs-16 fs-sm-18">
    <?php echo $content ?>
</div>
<?php } ?>

<?php if( $faq = get_field( 'faq', $term->taxonomy.'_'.$term->term_id ) ){ ?>
<div class="lx-module module-faq py-30 py-sm-40">
    <?php 
    get_template_part( 'template-parts/module/faq', null, [ 'options' => [
        'faq_title'     => get_field( 'faq_title', $term->taxonomy.'_'.$term->term_id ),
        'faq'           => $faq,
        'faq_columns'   => 'md-6',
        'load_schema'   => true
    ]]); 
    ?>
</div>
<?php } ?>

<?php get_footer(); ?>
