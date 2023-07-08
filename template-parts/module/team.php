<?php $options = $args['options']; ?>
<div class="container">

    <div class="row">
        <?php foreach($options['members'] as $member){ ?>
        <div class="<?php echo $options['columns'] ?> text-center mb-30 sm-6">
            <?php nsm_acf_image( $member['image'], 'mw-200 mb-10 br-round' ) ?>
            <p class="h4 mb-5"><?php echo $member['name'] ?></p>
            <p class="fs-16 fw-sb mb-5"><?php echo $member['designation'] ?></p>
            <p class="mb-0"><?php echo $member['short_description'] ?></p>
        </div>
        <?php } ?>
    </div>

</div>