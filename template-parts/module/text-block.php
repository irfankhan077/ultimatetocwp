<?php $options = $args['options']; ?>
<div class="container">

    <?php if(is_array($options['blocks'])){ ?>
        <div class="row">
            <?php
            foreach($options['blocks'] as $block){
                get_template_part('template-parts/loop/text-block', null, [
                    'block'     => $block,
                    'columns'   => $options['columns']
                ]); 
            }
            ?>
        </div>
    <?php } ?>

</div>