<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package nsm
 */

get_header();
the_post();

get_template_part('template-parts/subheader');
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'pt-30 pb-30 pt-sm-40 pb-sm-40' ); ?>>
    <div class="container entry-content">
        <?php the_content(); ?>
    </div>
</article>

<?php get_footer(); ?>
