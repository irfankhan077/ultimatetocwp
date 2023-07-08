<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package nsm
 */
get_header();
$fof_image = get_field( 'fof_image', 'option' );
?>

<div class="section">
    <div class="container">

        <div class="text-center mb-30">
            <?php if( $fof_image ){ ?>
                <img src="<?php echo $fof_image ?>" alt="404">
            <?php }else{ ?>
                <span class="h1 jumbo-text fw-br tc-p">404</span>
            <?php } ?>
        </div>

        <div class="text-center mb-30">
            <h1 class="mb-15"><?php echo esc_html__('Oops! We couldn\'t find the page', 'nsm') ?></h1>
            <p><?php echo esc_html__('The page you are trying to visit does not exist anymore.', 'nsm') ?></p>
            <a href="<?php echo home_url( '/' ) ?>" class="mt-10 mt-sm-0 ml-0 ml-sm-5 btn btn-light"><?php esc_html_e('Take me home', 'nsm') ?></a>
        </div>

    </div>
</div>

<?php get_footer(); ?>
