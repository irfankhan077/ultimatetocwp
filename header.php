<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	
	<?php wp_body_open(); ?>

	<?php get_template_part('template-parts/header/elements/mobile-menu'); ?> 
	<header id="masthead" class="<?php echo esc_attr(nsm()->header->get_classes()) ?>" role="banner">
		<?php get_template_part('template-parts/header/content'); ?> 
	</header>