<?php

$options = $args['options'];
$args = [
    'layout' 	    => NSM_Project_Helper::get_layout($options['project_layout']),
    'columns'	    => NSM_Project_Helper::get_columns($options['project_columns']),
    'query'         => NSM_Project_Helper::get_project_listing_query( $options )
];
?>
<div class="container">

    <?php if($options['content_before_list']){ ?>
        <div class="entry-content fs-16 fs-sm-18 mb-20">
            <?php echo $options['content_before_list'] ?>
        </div>
    <?php } ?>

    <?php get_template_part('template-parts/loop/project-list', null, $args); ?>

    <?php if ($button = NSM_Module::button($options['button'])) : ?>
        <div class="text-center mt-25">
            <a href="<?php echo $button['link'] ?>" class="btn <?php echo $button['size'] . ' ' . $button['color'] ?>">
                <?php echo $button['label']; ?>
            </a>
        </div>
    <?php endif; ?>

</div>