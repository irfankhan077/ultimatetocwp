<?php
$networks = [
    'facebook' => __('Facebook','nsm'),
    'twitter' => __('Twitter','nsm'),
    'instagram' => __('Instagram','nsm'),
    'tiktok' => __('TikTok','nsm'),
    'pinterest' => __('Pinterest','nsm'),
    'youtube' => __('Youtube','nsm'),
    'linkedin' => __('Linkedin','nsm'),
    'whatsapp' => __('Whatsapp','nsm'),
];

foreach($networks as $key => $network){

    if( $social = get_field( 'social_url_'.$key, 'option' ) ){
        ?>
        <a class="bg-w mr-10 br-4 px-10 w-40px h-40px py-10 d-flex ai-c jc-c" target="_blank" rel="nofollow" href="<?php echo $social ?>">
            <?php echo nsm_get_social_network_icon($key) ?>
        </a>
        <?php
    }

}