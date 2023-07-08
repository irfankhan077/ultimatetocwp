<form id="<?php echo esc_attr(uniqid('searchform-')) ?>" class="search-form"
      action="<?php print esc_url(home_url('/')); ?>" method="get">
    <label>
        <span class="screen-reader-text"><?php echo esc_html__('Search:', 'nsm') ?></span>
        <input type="search" class="search-field" placeholder="<?php echo esc_attr__('Search', 'nsm') ?>" id="<?php echo esc_attr(uniqid('search-form-')) ?>" value="<?php echo esc_attr(get_search_query()); ?>"
           name="s" required>
    </label>
    <input type="submit" class="search-submit" value="<?php echo esc_attr__('Search', 'nsm') ?>">
</form>