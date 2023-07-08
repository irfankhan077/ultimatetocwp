<?php
/**
 * nsm Theme Customizer
 *
 * @package nsm
 */
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Return the dynamic css added from options.
 *
 * @since 1.0.0
 */
function nsm_dynamic_style(){

    ob_start();
    ?>
    :root {
        <?php if($pc = get_field('primary_color', 'option' ) ){ ?>
        --color-primary: <?php echo esc_attr($pc); ?>;
        <?php } ?>
        <?php if($pchover = get_field('primary_hover_color', 'option' ) ){ ?>
        --color-primary-hover: <?php echo esc_attr($pchover); ?>;
        <?php } ?>
        <?php if($pchue = get_field('primary_hue_color', 'option' ) ){ ?>
        --color-primary-hue: <?php echo esc_attr($pchue); ?>;
        <?php } ?>
        <?php if($sc = get_field('secondary_color', 'option' ) ){ ?>
        --color-secondary: <?php echo esc_attr($sc); ?>;
        <?php } ?>
        <?php if($schover = get_field('secondary_hover_color', 'option' ) ){ ?>
        --color-secondary-hover: <?php echo esc_attr($schover); ?>;
        <?php } ?>
        <?php if($schue = get_field('secondary_hue_color', 'option' ) ){ ?>
        --color-secondary-hue: <?php echo esc_attr($schue); ?>;
        <?php } ?>
        <?php if($m_heading_1_font_size = get_field('m_heading_1_font_size', 'option' ) ){ ?>
        --fs-h1: <?php echo esc_attr($m_heading_1_font_size); ?>px; 
        <?php } ?>
        <?php if($m_heading_2_font_size = get_field('m_heading_2_font_size', 'option' ) ){ ?>
        --fs-h2: <?php echo esc_attr($m_heading_2_font_size); ?>px;
        <?php } ?>
        <?php if($m_heading_3_font_size = get_field('m_heading_3_font_size', 'option' ) ){ ?>
        --fs-h3: <?php echo esc_attr($m_heading_3_font_size); ?>px;
        <?php } ?>
        <?php if($m_heading_4_font_size = get_field('m_heading_4_font_size', 'option' ) ){ ?>
        --fs-h4: <?php echo esc_attr($m_heading_4_font_size); ?>px;
        <?php } ?>
        <?php if($m_heading_5_font_size = get_field('m_heading_5_font_size', 'option' ) ){ ?>
        --fs-h5: <?php echo esc_attr($m_heading_5_font_size); ?>px;
        <?php } ?>
        <?php if($m_heading_6_font_size = get_field('m_heading_6_font_size', 'option' ) ){ ?>
        --fs-h6: <?php echo esc_attr($m_heading_6_font_size); ?>px;
        <?php } ?>
    }

    <?php if( $container_size = get_field( 'container_size', 'option' ) ){ ?>
    .container{
        max-width: <?php echo esc_attr($container_size); ?>px;
    }
    <?php } ?>

    <?php if( $gutter_size = get_field( 'gutter_size', 'option' ) ){ ?>
    .lg-1, .lg-10, .lg-11, .lg-12, .lg-2, .lg-3, .lg-4, .lg-5, .lg-6, .lg-7, .lg-8, .lg-9, 
    .md-1, .md-10, .md-11, .md-12, .md-2, .md-3, .md-4, .md-5, .md-6, .md-7, .md-8, .md-9, 
    .sm-1, .sm-10, .sm-11, .sm-12, .sm-2, .sm-3, .sm-4, .sm-5, .sm-6, .sm-7, .sm-8, .sm-9, 
    .xs-1, .xs-10, .xs-11, .xs-12, .xs-2, .xs-3, .xs-4, .xs-5, .xs-6, .xs-7, .xs-8, .xs-9{
        padding-left: <?php echo esc_attr($gutter_size); ?>px;
        padding-right: <?php echo esc_attr($gutter_size); ?>px;
    }
    .container{
        padding-left: <?php echo esc_attr($gutter_size); ?>px;
        padding-right: <?php echo esc_attr($gutter_size); ?>px;
    }
    .row{
        margin-left: -<?php echo esc_attr($gutter_size); ?>px;
        margin-right: -<?php echo esc_attr($gutter_size); ?>px;
    }
    <?php } ?>

    <?php if( $header_bg = get_field( 'header_bg', 'option' ) ){ ?>
    #masthead{
        background-color: <?php echo esc_attr($header_bg); ?>
    }
    <?php } ?>
    <?php if(get_field( 'header_transparent', 'option' )){ ?>
    #masthead{
        background-color: transparent;
    }
    <?php } ?>

    <?php if( $header_link = get_field( 'header_link', 'option' ) ){ ?>
    .main-navigation ul li a{
        color: <?php echo esc_attr($header_link); ?>;
    }
    .main-navigation ul .page_item_has_children > a::after, 
    .main-navigation ul .menu-item-has-children > a::after{
        border-top: 6px solid <?php echo esc_attr($header_link); ?>;
    }
    .burger span{
        background-color: <?php echo esc_attr($header_link); ?>
    }
    <?php } ?>

    <?php if( $header_link_hover = get_field( 'header_link_hover', 'option' ) ){ ?>
    .main-navigation ul li.current-menu-item > a,
    .main-navigation ul li.current_page_item > a,
    .main-navigation ul li a:hover{
        color: <?php echo esc_attr($header_link_hover); ?>
    }

    .main-navigation ul li.current-menu-item > a::after,
    .main-navigation ul li.current_page_item > a::after,
    .main-navigation ul .page_item_has_children > a:hover::after,
    .main-navigation ul .menu-item-has-children > a:hover::after{
        border-top: 6px solid <?php echo esc_attr($header_link_hover); ?>;
    }
    .burger:hover span{
        background-color: <?php echo esc_attr($header_link_hover); ?>;
    }
    <?php } ?>

    <?php if($header_submenu_color_hover = get_field( 'header_submenu_color_hover', 'option' ) ){ ?>
    #site-navigation ul li ul.sub-menu a:hover, 
    #site-navigation ul li ul.children a:hover{
        color: <?php echo esc_attr($header_submenu_color_hover); ?>
    }
    <?php } ?>
    <?php if( $header_top_bg = get_field( 'header_top_bg', 'option' ) ){ ?>
    .site-header-t{
        background-color: <?php echo esc_attr($header_top_bg); ?>
    }
    <?php } ?>
    <?php if( $header_top_color = get_field( 'header_top_color', 'option' ) ){ ?>
    .site-header-t .contact-info a{
        color: <?php echo esc_attr($header_top_color); ?>
    }
    .site-header-t a svg{
        fill: <?php echo esc_attr($header_top_color); ?>
    }
    <?php } ?>

    <?php if( $body_color = get_field( 'body_color', 'option' ) ){ ?>
    body{
        color: <?php echo esc_attr($body_color); ?>
    }
    <?php } ?>

    <?php if($headings_color = get_field( 'headings_color', 'option' ) ){ ?>
    h1, h2, h3, h4, b, strong,
    h1 a, h2 a, h3 a, h4 a,
    h5 a, h6 a, h5, h6, label{
        color: <?php echo esc_attr($headings_color); ?>
    }
    <?php } ?>

    <?php if($m_body_font_size = get_field('m_body_font_size', 'option') ){ ?>
        body{
            font-size: <?php echo esc_attr( $m_body_font_size ); ?>px;
        }
    <?php } ?>

    

    <?php if( $footer_bg = get_field( 'footer_bg', 'option' ) ){ ?>
    #footer-sidebar{
        background-color: <?php echo esc_attr($footer_bg); ?>;
    }
    <?php } ?>
    <?php if( $footer_widget_title_color = get_field( 'widget_title_color', 'option' ) ){ ?>
    #footer-sidebar .footer-column .widget-title{
        color: <?php echo esc_attr($footer_widget_title_color); ?>;
    }
    #footer-sidebar .footer-column .widget-title a span{
        color: <?php echo esc_attr($footer_widget_title_color); ?>;
    }
    <?php } ?>
    <?php if( $footer_copyright_bg = get_field( 'footer_copyright_bg', 'option' ) ){ ?>
    #colophon{
        background-color: <?php echo esc_attr($footer_copyright_bg); ?>;
    }
    <?php } ?>
    <?php if( $footer_copyright_text_color = get_field( 'footer_copyright_text_color', 'option' ) ){ ?>
    #colophon,
    #colophon a{
        color: <?php echo esc_attr($footer_copyright_text_color); ?>;
    }
    <?php } ?>

    <?php if( $footer_color = get_field( 'footer_color', 'option' ) ){ ?>
    #footer-sidebar, #footer-sidebar strong, #footer-sidebar b{
        color: <?php echo esc_attr($footer_color); ?>;
    }
    <?php } ?>
    <?php if( $footer_link_color = get_field( 'footer_link_color', 'option' ) ){ ?>
    #footer-sidebar .footer-column .widget_recent_entries ul li a:before, 
    #footer-sidebar .footer-column .widget_recent_comments ul li a:before,
    #footer-sidebar .footer-column .widget_categories ul li a:before, #footer-sidebar .footer-column .widget_pages ul li a:before, 
    #footer-sidebar .footer-column .widget_archive ul li a:before, #footer-sidebar .footer-column .widget_meta ul li a:before, 
    #footer-sidebar .footer-column .widget_nav_menu ul li a:before,
    #footer-sidebar .footer-column .widget ul li a{
        color: <?php echo esc_attr($footer_link_color); ?>;
    }
    <?php } ?>
    <?php if( $footer_link_color_hover = get_field( 'footer_link_color_hover', 'option' ) ){ ?>
    #footer-sidebar .footer-column .widget_recent_entries ul li a:hover:before, 
    #footer-sidebar .footer-column .widget_recent_comments ul li a:hover:before,
    #footer-sidebar .footer-column .widget_categories ul li a:hover:before, #footer-sidebar .footer-column .widget_pages ul li a:hover:before, 
    #footer-sidebar .footer-column .widget_archive ul li a:hover:before, #footer-sidebar .footer-column .widget_meta ul li a:hover:before, 
    #footer-sidebar .footer-column .widget_nav_menu ul li a:hover:before,
    #footer-sidebar .footer-column .widget ul li a:hover{
        color: <?php echo esc_attr($footer_link_color_hover); ?>;
    }
    <?php } ?>

    <?php if( $default_faq_bg = get_field( 'default_faq_bg', 'option' ) ){ ?>
        .module-faq{
            background-color: <?php echo esc_attr($default_faq_bg) ?>;
        }
    <?php } ?>

    @media (min-width: 992px) {
        :root {
            <?php if($heading_1_font_size = get_field('heading_1_font_size', 'option' ) ){ ?>
            --fs-h1: <?php echo esc_attr($heading_1_font_size); ?>px;
            <?php } ?>
            <?php if($heading_2_font_size = get_field('heading_2_font_size', 'option' ) ){ ?>
            --fs-h2: <?php echo esc_attr($heading_2_font_size); ?>px;
            <?php } ?>
            <?php if($heading_3_font_size = get_field('heading_3_font_size', 'option' ) ){ ?>
            --fs-h3: <?php echo esc_attr($heading_3_font_size); ?>px;
            <?php } ?>
            <?php if($heading_4_font_size = get_field('heading_4_font_size', 'option' ) ){ ?>
            --fs-h4: <?php echo esc_attr($heading_4_font_size); ?>px;
            <?php } ?>
            <?php if($heading_5_font_size = get_field('heading_5_font_size', 'option' ) ){ ?>
            --fs-h5: <?php echo esc_attr($heading_5_font_size); ?>px;
            <?php } ?>
            <?php if($heading_6_font_size = get_field('heading_6_font_size', 'option' ) ){ ?>
            --fs-h6: <?php echo esc_attr($heading_6_font_size); ?>px;
            <?php } ?>
        }

        <?php if($body_font_size = get_field('body_font_size', 'option') ){ ?>
            body{
                font-size: <?php echo esc_attr( $body_font_size ); ?>px;
            }
        <?php } ?> 
    }

    <?php
    $content = apply_filters('nsm/filters/dynamic_css', ob_get_clean());
    $content = str_replace(array("\r\n", "\r"), "\n", $content);
    $lines = explode("\n", $content);
    $dynamic_css = array();
    foreach ($lines as $i => $line) {
        if (!empty($line)) {
            $dynamic_css[] = trim($line);
        }
    }
    return implode($dynamic_css);
}