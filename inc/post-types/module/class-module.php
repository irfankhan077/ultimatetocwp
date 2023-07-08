<?php

class NSM_Module{

    /**
     * Return the button markup for a module
     *
     * @param array $options - The button options
     * 
     * @since 1.0.0
     */
    public static function button($options){
        if (!$options || !isset($options['cta_options'])) return false;

        $options['label'] = isset($options['label']) ? $options['label'] : false;
        $options['color'] = isset($options['colors']) ? $options['colors'] : 'btn-primary';
        $options['size']  = isset($options['sizes']) ? $options['sizes'] : 'btn-md';

        if($options['label'] == false)
            return false;

        if ($options['cta_options'] === '1') :
            $options['link'] = $options['page_link'];
        elseif ($options['cta_options'] === '2') :
            $options['link'] = $options['custom_link'];
        endif;

        return $options;
    }

    /**
     * Return the button markup for a module
     *
     * @param array $options - The button options
     * 
     * @since 1.0.0
     */
    public static function title($options){
        if(!$options) return false;

        if (empty($options['title']))
        return false;

        $attr   = '';
        $styles = [];
        
        $options['title_color'] = $options['title_color'] ? $options['title_color'] : 'var(--color-headings)';
        $options['subtitle_color'] = $options['subtitle_color'] ? $options['subtitle_color'] : 'var(--color-body)';

        return $options;
    }

}