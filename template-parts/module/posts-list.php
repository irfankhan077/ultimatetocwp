<?php
$options = $args['options'];
$query   = NSM_Post_Helper::get_query($options);
?>
<div class="container">

    <?php if($options['content_before_list']){ ?>
    <div class="entry-content fs-16 fs-sm-18 mb-20">
        <?php echo $options['content_before_list'] ?>
    </div>
    <?php } ?>

    <?php 
    get_template_part('template-parts/loop/posts-list', null, [
        'layout'    => NSM_Post_Helper::get_layout($options['posts_layout']),
        'columns'   => NSM_Post_Helper::get_columns($options['posts_columns']),
        'query'     => $query
    ]); 
    ?>

    <?php if ($button = NSM_Module::button($options['button'])) : ?>
        <div class="text-center mt-25">
            <a href="<?php echo $button['link'] ?>" class="btn <?php echo $button['size'] . ' ' . $button['color'] ?>">
                <?php echo $button['label']; ?>
            </a>
        </div>
    <?php endif; ?>

</div>