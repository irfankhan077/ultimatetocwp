<?php
/**
 * The template for displaying all single posts.
 *
 * @package nsm
 */

get_header(); 
the_post();

get_template_part('template-parts/subheader');

?>

<div class="pt-30 pb-30 pt-sm-40 pb-sm-40">

    <div class="container">

        <div class="row">

            <div class="<?php echo is_active_sidebar('sidebar-1') ? 'md-8' : 'md-12'; ?>">
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                
                    <div class="post-thumbnail mw-900 ml-auto mr-auto p-relative">
                        <?php the_post_thumbnail('full'); ?>
                    </div>
                    <div class="post-meta my-15 fs-14 tc-l">
                        <?php NSM_Post_Helper::posted_on(); ?>
                    </div>
                    <div class="entry-content fs-16 fs-sm-18">
                        <?php the_content(); ?>
                    </div>
                    
                    <?php
                    wp_link_pages( array(
                        'before' => '<div class="page-links">' . __( 'Pages:', 'nsm' ),
                        'after'  => '</div>',
                    ) );
                    ?>
                    
                </article>
                
                <?php
                // Author box
                NSM_Post_Helper::get_post_authorbox();
                
                // Related Posts
                NSM_Post_Helper::get_related_post();

                ?>
            </div>

            <?php get_sidebar(); ?>
            
        </div>
    </div>

</div>

<?php
    if ($modules = get_field('modules')) :
        get_template_part('template-parts/loop/modules', null, ['modules' => $modules]);
    endif;
?>

<?php get_footer(); ?>
