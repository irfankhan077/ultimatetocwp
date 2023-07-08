<?php
// Creating the widget
class NSM_Modular_Widget extends WP_Widget{
    function __construct(){
        parent::__construct(
            'NSM_Modular_Widget',
            __('Modular Widget', 'nsm'),
            array( 'description' => __('Modular widget', 'nsm')
        ));
    }

    // Creating widget front-end
    // This is where the action happens
    public function widget($args, $instance){

        $title = apply_filters('widget_title', $instance['title']);
        echo $args['before_widget'];

        if (!empty($title))
        echo $args['before_title'] . $title . $args['after_title'];

        if ($modules = get_field('modules', 'widget_'.$args['widget_id'])) :
            get_template_part('template-parts/loop/modules', null, ['modules' => $modules]);
        endif;

        echo $args['after_widget'];
    }

    public function form($instance)
    {

    $title = isset($instance['title']) ?  $instance['title'] : $title = __('New title', 'nsm');
    ?>
    <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?> 
    <input class="widefat" id="<?php echo $this->get_field_id('title');?>" name="<?php echo $this->get_field_name('title');?>" type="text" value="<?php echo esc_attr($title); ?>" />
    <?php
    }

    public function update($new_instance, $old_instance){
        $instance          = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        return $instance;
    }
    
}

// Register and load the widget
function load_widget(){
    register_widget('NSM_Modular_Widget');
}
add_action('widgets_init', 'load_widget');