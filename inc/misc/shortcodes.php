<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Shortcode to display the year
 *
 * @since 1.0.0
 */
function nsm_shortcode_current_year(){
	return date('Y');
}
add_shortcode("current_year", "nsm_shortcode_current_year");

/**
 * Shortcode to display the month
 *
 * @since 1.0.0
 */
function nsm_shortcode_current_month_year(){
	$monthslist = array(
		esc_html__('January', 'nsm'),
		esc_html__('February', 'nsm'),
		esc_html__('March', 'nsm'),
		esc_html__('April', 'nsm'),
		esc_html__('May', 'nsm'),
		esc_html__('June', 'nsm'),
		esc_html__('July', 'nsm'),
		esc_html__('August', 'nsm'),
		esc_html__('September', 'nsm'),
		esc_html__('October', 'nsm'),
		esc_html__('November', 'nsm'),
		esc_html__('December', 'nsm')
	);
	$currentmonth = (int)date('m');
	return $monthslist[$currentmonth - 1] . " " . date('Y');
}
add_shortcode("current_month_year", "nsm_shortcode_current_month_year");

/**
 * Shortcode to display the year
 *
 * @since 1.0.0
 */
function nsm_shortcode_howto( $atts ){

	$atts = shortcode_atts( array(
        'id' 		=> null,
        'layout' 	=> 'layout-1'
    ), $atts, 'howto' );

	if( empty($atts['id']) )
	return false;

	if( get_post_type( $atts['id'] ) != 'guide' )
	return false;

	// Local Business
	$schema = [
		'@context' 		=> 'https://schema.org',
		'@type' 		=> 'HowTo',
		'name' 			=> get_the_title( $atts['id'] ),
		'description' 	=> get_field( 'guide_description', $atts['id'] ),
		'image' 		=> has_post_thumbnail( $atts['id'] ) ? get_the_post_thumbnail_url( $atts['id'], 'full' ) : null,
		'totalTime' 	=> 'PT2M'
	];

	$cost 		= get_field( 'guide_estimated_cost', $atts['id'] );
	$currency 	= get_field( 'guide_estimated_cost_currency', $atts['id'] );

	if( $cost && $currency ){
		$schema['estimatedCost'] = [
			'@type' => 'MonetaryAmount',
			'currency' => $currency,
			'value' => $cost
		];
	}

	if( $supply = get_field( 'guide_supply', $atts['id'] ) ){
		foreach( $supply as $supply_item ){
			$schema['supply'][] = [
				'@type' => 'HowToSupply',
				'name' => $supply_item['guide_supply_name']
			];
		}
	}

	if( $tools = get_field( 'guide_tools', $atts['id'] ) ){
		foreach( $tools as $tool ){
			$schema['tool'][] = [
				'@type' => 'HowToTool',
				'name' => $tool['guide_tool_name']
			];
		}
	}

	if( $steps = get_field( 'guide_steps', $atts['id'] ) ){
		foreach( $steps as $step ){
			$schema['step'][] = [
				'@type' => 'HowToStep',
				'name' 	=> $step['guide_step_name'],
				'image' => $step['guide_step_image'],
				'text' 	=> $step['guide_step_description'],
				'url' 	=> get_the_permalink(),
			];
		}
	}

	ob_start();
	?>
	
	<div class="howto mb-30 entry-content">
		<h2 class="howto-title"><?php echo get_the_title( $atts['id'] ) ?></h2>
		<p class="howto-description"><?php echo get_field( 'guide_description', $atts['id'] ); ?></p>

		<div class="row">
			<div class="sm-6">
			<?php if( $tools ) { ?>
				<p class="howto-list-title fs-14 tt-u fw-sb"><?php echo get_field( 'guide_tools_title', $atts['id'] ) ?></p>
				<ul>
					<?php foreach( $tools as $tool ){ ?>
					<li><?php echo $tool['guide_tool_name'] ?></li>
					<?php } ?>
				</ul>
			<?php } ?>
			</div>
			<div class="sm-6">
			<?php if( $supply ) { ?>
				<p class="howto-list-title"><?php echo get_field( 'guide_supply_title', $atts['id'] ) ?></p>
				<ul>
					<?php foreach( $supply as $supply_item ){ ?>
					<li><?php echo $supply_item['guide_supply_name'] ?></li>
					<?php } ?>
				</ul>
			<?php } ?>
			</div>
		</div>
				
		<?php if( $steps ) { ?>
		<div class="howto-steps">
			<?php foreach( $steps as $key => $step ){ ?>
			<div class="howto-step text-center text-sm-left mt-20 d-block d-sm-flex ai-c">
				<?php if( $step['guide_step_image'] ){ ?>
				<img class="mr-sm-20 mb-20 mb-sm-0 mw-300" src="<?php echo $step['guide_step_image'] ?>" alt="<?php echo $step['guide_step_name'] ?>">
				<?php } ?>
				<div class="howto-step-content">
					<span class="howto-step-count d-block fs-14 fw-500 tt-u mb-5"> <?php echo get_field( 'guide_step_title', $atts['id'] ) . ' ' . ($key + 1) ?></span>
					<h3><?php echo $step['guide_step_name'] ?></h3>
					<p class="mb-0"><?php echo $step['guide_step_description'] ?></p>
				</div>
			</div>
			<?php } ?>
		</div>
		<?php } ?>

	</div>
	<script type="application/ld+json">
		<?php echo json_encode($schema) ?>
	</script>

	<?php
	return ob_get_clean();
}
add_shortcode("howto", "nsm_shortcode_howto");

/**
 * Shortcode to display a button
 *
 * @since 1.0.0
 */
function nsm_shortcode_button( $atts ){

	$atts = shortcode_atts( array(
        'text' 	=> 'Read More',
        'link' 	=> null,
		'align' => 'text-center'
    ), $atts, 'nsm_button' );

	if( empty($atts['link']) )
	return false;

	ob_start();
	?>
	<div class="<?php echo $atts['align'] ?> mb-20">
		<a href="<?php echo $atts['link'] ?>" class="btn btn-primary"><?php echo $atts['text'] ?></a>
	</div>
	<?php

	return ob_get_clean();
}
add_shortcode("nsm_button", "nsm_shortcode_button");

/**
 * Shortcode for the contact form
 *
 * @since 1.0.0
 */
function nsm_shortcode_contact(){
	ob_start();
	
	get_template_part( 'template-parts/shortcodes/contact' );

	return ob_get_clean();
}
add_shortcode("nsm_contact", "nsm_shortcode_contact");

function nsm_shortcode_posts( $attr ){

    $attr = shortcode_atts( array(
        'category'      => null,
        'columns'       => 4,
        'count'         => 6,
    ), $attr );
    
    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => $attr['count']
    );

    if( $attr['category'] ){
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'category',
                'field' => 'id',
                'terms' => [ $attr['category'] ],
            )
        );
    }

    $q = new WP_Query($args);

    ob_start();
    
    if( $q->have_posts() ){ ?>
    <div class="row post-list">
        <?php
        while( $q->have_posts() ):
            $q->the_post();
            ?>
            <div class="md-<?php echo $attr['columns'] ?> sm-6">
                <?php get_template_part( 'template-parts/post/layouts/layout-1' ); ?>
            </div>
        <?php endwhile; ?>
    </div>
    <?php 
        wp_reset_postdata();
    } 

    return ob_get_clean();

}
add_shortcode('post_list','nsm_shortcode_posts');