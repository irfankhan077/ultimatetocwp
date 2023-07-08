<?php $options = $args['options'];  ?>

<?php if($title = NSM_Module::title($options) ){ ?>
<div class="title container p-relative text-center">
    <div class="content mw-700 mr-auto ml-auto">
        <?php if($title['design_title']){ ?>
            <span class="design-title bg-phue tc-p px-10 py-5 mb-10 d-i-block fs-14"><?php echo $title['design_title'] ?></span>
        <?php } ?>
        <<?php echo $title['title_tag'] ?> class="mb-10 h2" style="color: <?php echo $title['title_color'] ?>">
            <?php echo $title['title'] ?>
        </<?php echo $title['title_tag'] ?>>
        <?php if($title['subtitle']){ ?>
            <p class="fs-md-18 mb-0" style="color: <?php echo $title['subtitle_color'] ?>"><?php echo $title['subtitle'] ?></p>
        <?php } ?>
    </div>
</div>
<?php } ?>