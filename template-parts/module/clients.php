<?php $options = $args['options']; ?>
<?php if($options['clients']){ ?>
<div class="container">
    <div class="row ai-c jc-c">
        <?php foreach($options['clients'] as $key => $client){ ?>
        <div class="md-3 sm-6 mb-15 text-center">
            <img class="w-150px" src="<?php echo $client['logo'] ?>" alt="<?php echo $client['name'] ?>">
        </div>
        <?php } ?>
    </div>
</div>
<?php } ?>