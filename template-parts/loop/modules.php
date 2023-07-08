<?php

$modules = $args['modules'];
foreach ($modules as $module):
    $settings   = '';
    $options     = null;

    if (isset($module['settings']))
      $settings = NSM_Module_Settings::get_settings($module['settings']);

    if (isset($module['type']))
      $options = $module['type'] === '1' ? $module['manually'] : get_fields($module['module']);
    elseif (isset($module['manually']))
      $options = $module['manually'];

    $view = str_replace("_","-", $module['acf_fc_layout']);

    if (isset($module['settings']))
      $settings['class'] .= ' module-'.$view;
    
    do_action('before_module', ['settings' => $settings]);

    get_template_part('template-parts/module/' . $view, null, [
      'options'     => $options,
      'settings'    => $settings,
      'view'        => $view
    ]);

    do_action('after_module');
endforeach;
