<?php
/**
 * The template for displaying modular structure in pages.
 *
 * Template Name: Modular
 *
 * @package nsm
 */
get_header();
the_post();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php
    if ($modules = get_field('modules')) :
        get_template_part('template-parts/loop/modules', null, ['modules' => $modules]);
    endif;
    ?>
</article>

<?php get_footer(); ?>