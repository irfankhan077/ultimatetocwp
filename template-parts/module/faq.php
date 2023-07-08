<?php $options = $args['options']; ?>
<div class="container">

    <?php if($options['faq_title']){ ?>
    <h2 class="text-center mb-20"><?php echo $options['faq_title']; ?></h2>
    <?php } ?>

    <div class="row">

        <?php 
        get_template_part('template-parts/loop/faq', '', [
            'faq'       => $options['faq'],
            'columns'   => $options['faq_columns'] ? $options['faq_columns'] : 'md-6',
            'schema'    => $options['load_schema']
        ]);
        ?>

    </div>

</div>