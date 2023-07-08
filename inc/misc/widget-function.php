<?php
if (!defined('ABSPATH'))
	exit;


class NSM_Widget_Misc_func{

	public function __construct(){
		//Wigdets
		add_filter( 'widget_form_callback', [$this, 'nsm_widget_form_extend'], 10, 2);
		add_filter( 'widget_update_callback', [$this, 'nsm_widget_update'], 10, 2 );
		add_filter( 'dynamic_sidebar_params', [$this, 'nsm_dynamic_sidebar_params'] );
		add_filter( 'widget_form_callback', [$this, 'nsm_widget_form_extend_link'], 10, 2 );
	}

	/**
	 * 
	 * Custom Class field in widgets
	 * @since 3.1.3 
	 * 
	*/
	public function nsm_widget_form_extend( $instance, $widget ) {
		if ( !isset($instance['classes']) )
			$instance['classes'] = null;   
			$row = "<p><label>Class:</label>\t<input type='text' name='widget-{$widget->id_base}[{$widget->number}][classes]' id='widget-{$widget->id_base}-{$widget->number}-classes' class='widefat' value='{$instance['classes']}'/></p>\n";   
			echo $row;
			return $instance;
	}

	public function nsm_widget_form_extend_link( $instance, $widget ) {
		if ( !isset($instance['link']) )
			$instance['link'] = null;   
			$row = "<p><label>Widget Title Link:</label>\t<input type='text' name='widget-{$widget->id_base}[{$widget->number}][link]' id='widget-{$widget->id_base}-{$widget->number}-link' class='widefat' value='{$instance['link']}'/></p>\n";    
			echo $row;
			return $instance;
	}

	public function nsm_widget_update( $instance, $new_instance ) {
		$instance['classes'] = $new_instance['classes'];
		$instance['link'] = $new_instance['link'];
		return $instance;
	}
	
	public function nsm_dynamic_sidebar_params( $params ) {
		global $wp_registered_widgets;
		
		$widget_id    	= $params[0]['widget_id'];
		$widget_obj    	= $wp_registered_widgets[$widget_id];
		$widget_opt    	= get_option($widget_obj['callback'][0]->option_name);
		$widget_num    	= $widget_obj['params'][0]['number'];    
		$link			= isset( $widget_opt[ $widget_num ]['link'] ) ? $widget_opt[ $widget_num ]['link'] : '';
		if($link){
			$params[0]['before_title'] = '<p class="widget-title h6 mb-20"><a href="'.$link.'"><span>'; 
			$params[0]['after_title'] = '</span></a></p>';
		}
		if ( isset($widget_opt[$widget_num]['classes']) && !empty($widget_opt[$widget_num]['classes']) )
			$params[0]['before_widget'] = preg_replace( '/class="/', "class=\"{$widget_opt[$widget_num]['classes']} ", $params[0]['before_widget'], 1 );
		return $params;
	}

}


//Feets to meter
function meter($feet){
	$feet = floatval($feet) / 3.2808399;
	return number_format($feet, 2);
}
