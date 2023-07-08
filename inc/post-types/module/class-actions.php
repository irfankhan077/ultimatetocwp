<?php

class NSM_Module_Actions {

    public function __construct(){
        add_action( 'before_module', [$this, 'before_module']);
        add_action( 'after_module', [$this, 'after_module']);

        add_filter('nav_menu_css_class', [$this, 'module_megamenu_classes'], 10, 4);
        add_filter('walker_nav_menu_start_el', [$this, 'module_megamenu_start_el'], 10, 4);

    }

    /**
    * Before a module.
    *
    * @since 1.0.0
    */
    public function before_module($args = []){

        if(empty($args['settings']))
            return false;

        $attr = ' ';
        foreach($args['settings'] as $key => $setting) :
            if ($key === 'data') :
                $attr .= $setting;
            else :
                $attr .= $setting ? $key . '="' . $setting . '"' : '';
            endif;
        endforeach;
    
        echo "<div ${attr}>";

    }

    /**
    * After a module
    *
    * @since 1.0.0
    */
    public function after_module(){
        echo '</div>';
    }

    /**
     * Filters a menu item's starting output.
     *
     * The menu item's starting output only includes `$args->before`, the opening `<a>`,
     * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
     * no filter for modifying the opening and closing `<li>` for a menu item.
     *
     * @param string $item_output The menu item's starting HTML output.
     * @param object $item Menu item data object.
     * @param int $depth Depth of menu item. Used for padding.
     * @param stdClass $args An object of wp_nav_menu() arguments.
     * @since 1.0.0
     *
     */
    public function module_megamenu_start_el($item_output, $item, $depth, $args){

        $is_mm_enabled = get_field('enable_mega_menu', $item);
        $mm_size = get_field('mm_container_size', $item);
        $modules = get_field('modules', $item);

        if ($is_mm_enabled && !empty($modules)) {

            ob_start();

            get_template_part('template-parts/loop/modules', null, ['modules' => $modules]);

            $mm_content = ob_get_clean();

            $description_html = '<ul class="sub-menu mega-menu-wrap"><li class="'.$mm_size.'">' . $mm_content . '</li></ul>';
            return $item_output . $description_html;
        }

        return $item_output;

    }

    /**
     * Adds the necessary classes for the megamenu.
     *
     * @param string $classes string of classes for the menu item
     * @param object $item The menu item object.
     * @param array $args The argumens of the menu item.
     * @param int $depth The depth of the current menu item.
     * @since 1.0.0
     *
     */
    public function module_megamenu_classes($classes, $item, $args, $depth){

        if ( get_field('enable_mega_menu', $item) ) 
        $classes[] = esc_attr('mega-menu-item menu-item-has-children');

        if ( $size = get_field('menu_size', $item) ) 
        $classes[] = esc_attr('mega-menu-'.$size);

        return $classes;

    }
    
}