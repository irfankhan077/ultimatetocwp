<?php $options = $args['options']; ?>
<div class="row">
<?php foreach($options['columns'] as $column){ ?>
    <div class="md-<?php echo 12 / sizeof($options['columns']) ?>">
    <?php if( $column['title'] ){ ?>
    <p class="pl-5 fs-16 tt-u tc-h fw-sb mb-5"><?php echo $column['title'] ?></p>
    <?php } ?>
    <ul>
        <?php 
        foreach($column['menu_items'] as $item){
            $link = $item['link_type'] == 2 ? 'link_custom' : 'link';
            ?>

            <?php if($item[$link]){ ?>
                <li><a href="<?php echo esc_url($item[$link]) ?>"><?php echo esc_html($item['label']); ?></a></li>
            <?php } ?>

        <?php } ?>
    </ul>
    </div>
<?php } ?>
</div>
