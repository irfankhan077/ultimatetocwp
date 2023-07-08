<?php

class NSM_Module_Settings {

    public static $classes = [];

    public static $styles = [];
    
    public static $data = [];

    protected static function set_settings($settings) {
        if (!isset($settings['section_id'])) $settings['section_id'] = null;
        if (!isset($settings['text_color'])) $settings['text_color'] = null;
        if (!isset($settings['text_alignment'])) $settings['text_alignment'] = null;
        if (!isset($settings['background'])) $settings['background'] = null;
        if (!isset($settings['visibility'])) $settings['visibility'] = null;
    
        return $settings;
    }

    protected static function ID($id) {
        if (empty($id))
          return null;
    
        return $id;
    }

    protected static function class($classes) {
        if (empty($classes))
          return null;
    
        if (is_array($classes))
          $classes = implode(' ', $classes);
          
        return $classes;
    }

    protected static function style($styles) {
        if (empty($styles))
          return null;
    
        if (is_array($styles))
          $styles = implode(' ', $styles);
          
        return $styles;
    }

    protected static function data($data) {
        if (empty($data))
          return null;
    
        if (is_array($data)) 
          $data = implode(' ', $data);
          
        return $data;
    }

    public static function paddings($padding) {
        if (empty($padding))
          return null;
        
        $arr    = [];
        $pd     = $padding['pd'];
        $pm     = $padding['pm'];
    
        $arr[] = $pd['pt'];
        $arr[] = $pd['pb'];
        $arr[] = $pm['pt'];
        $arr[] = $pm['pb'];
    
      self::$classes = array_merge(self::$classes, $arr); 
    
        return implode(' ', $arr);
    }

    public static function text_color($color) {
        if (empty($color)) 
              return null;
              
        self::$classes[] = $color;
          
        return $color;
    }

    public static function text_alignment($alignment) {
        if (empty($alignment)) 
              return null;
    
        $arr    = [];
        $arr[]  = $alignment['tad'];
        $arr[]  = $alignment['tam'];
    
        self::$classes = array_merge(self::$classes, $arr);
        return implode(' ', $arr);
    }

    public static function background($backgrounds) {
        foreach ($backgrounds as $device => $bg) :
          if($bg['background_image'] != null){
            self::$data[] = 'data-bg_' . $device . '="url('. wp_get_attachment_image_url($bg['background_image'], 'nsm-'. $device .'-bg') . ')"';
            self::$data[] = 'data-bg_pos_' . $device . '="'. str_replace('-', ' ', $bg['background_position']) .'"';
            self::$data[] = 'data-bg_repeat_' . $device . '="'. $bg['background_repeat'] .'"';
            self::$data[] = 'data-bg_size_' . $device . '="'. str_replace('-', ' ', $bg['background_size']) .'"';
            self::$data[] = 'data-bg_attachment_' . $device . '="'. str_replace('-', ' ', $bg['background_attachment']) .'"';
            self::$data[] = 'data-bg_color_' . $device . '="'.$bg['background_color'] .'"';
          }elseif($bg['background_color'] != null){
            self::$data[] = 'data-bg_color_' . $device . '="'.$bg['background_color'] .'"';
          }
        endforeach;
    }

    public static function visibility($visibility) {
        if (empty($visibility) || $visibility === '0') 
          return null;
    
        self::$classes[] = $visibility;
    
        return $visibility;
    }
    
    public static function get_settings($settings){
        $settings = self::set_settings($settings);
        self::$classes = [];
        self::$styles = [];
        self::$data = [];
        
        if (isset($settings['padding']))
        self::paddings($settings['padding']);

        if (isset($settings['text_color']))
        self::text_color($settings['text_color']);

        if (isset($settings['text_align']))
        self::text_alignment($settings['text_align']);

        if (isset($settings['background']))
        self::background($settings['background']);
        
        if (isset($settings['visibility']))
        self::visibility($settings['visibility']);

        if (isset($settings['css_classes']))
        self::$classes[] = $settings['css_classes'];

        self::$classes[] = 'lx-module';

        return [
            'id' => self::ID($settings['section_id']),
            'class' => self::class(self::$classes),
            'style' => self::style(self::$styles),
            'data' => self::data(self::$data)
        ];
    }
  
}