<?php
/**
 * The template for displaying all service reviews.
 *
 * @package nsm
 */

get_header();
the_post();

$service = new NSM_Service(get_the_ID());

get_template_part('template-parts/subheader');

?>

<article id="post-<?php the_ID(); ?>" class="<?php echo NSM_Service_Helper::get_classes( $service, 'pt-30 pb-10 pt-sm-40 pb-sm-20 service-detail mb-0') ?>">
    <div class="entry-content fs-16 fs-sm-18 container">
        <?php the_content() ?>
    </div>
</article>
	
<?php
if ($modules = get_field('modules')) :
    get_template_part('template-parts/loop/modules', null, ['modules' => $modules]);
endif;
get_footer(); 
?>