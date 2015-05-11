<?php

/** 
 @link              http://webconnex.com
 @since             1.0.0
 @package           WX Form Management
 
 @wordpress-plugin
 Plugin Name:       WX Form Management
 Plugin URI:        http://webconnex.com/wordpress/
 Description:       An easy way to include your WebConnex forms in WordPress
Version:            1.2
 Author:            WebConnex
 Author URI:        http://webconnex.com/
 License:           Attribution-NonCommercial-NoDerivatives 4.0 International
 License URI:       http://creativecommons.org/licenses/by-nc-nd/4.0/legalcode
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) 
{
  die;
}


class wx_form_management {
  
  function __construct() {
    add_shortcode( 'wxform', array(__CLASS__,'wxform_shortcode_fn' ));
    add_action('media_buttons_context',  array(__CLASS__,'add_wx_button'));
    add_action('admin_footer', array(__CLASS__,'add_wx_popup' ));
    add_action('admin_enqueue_scripts', array(__CLASS__,'wx_load_admin_styles' ));
  }
  
  function wx_build_link($formUrl, $content, $button = array('color'=>'FFF','background'=>'7BB045')) {
    wp_enqueue_style('wx-form-management', plugin_dir_url( __FILE__ ) . 'wx-form-management-styles.php?color='.$button['color'].'&background='.$button['background'], null, '1.0');
    return '<a class="wx-button" href="'.$formUrl.'">'.$content.'</a>';  
  }

  function wx_build_embed($formUrl, $content) 
  {
    if(strpos($formUrl, '?') === true) {
       $formUrl .= '&mode=wp';
    }
    else {
      $formUrl .= '?mode=wp';
    }
    wp_enqueue_script('iframeresize', plugin_dir_url( __FILE__ ) . 'iframeResizer.min.js',  array('jquery'));
    wp_enqueue_script('wx-form-management', plugin_dir_url( __FILE__ ) . 'wx-form-management.js',  array('jquery'));
    return '<iframe class="wx-embed" src="'.$formUrl.'" width="100%" scrolling="no"></iframe>';
  }

  function wx_build_modal($formUrl, $content, $button = array('color'=>'FFF','background'=>'7BB045'))
  {
    wp_enqueue_script('thickbox', null,  array('jquery'));
    wp_enqueue_style('thickbox.css', '/'.WPINC.'/js/thickbox/thickbox.css', null, '1.0');
    wp_enqueue_style('wx-form-management', plugin_dir_url( __FILE__ ) . 'wx-form-management-styles.php?color='.$button['color'].'&background='.$button['background'], null, '1.0');
    return '<a class="wx-button thickbox" href="'.$formUrl.'?TB_iframe=true&width=800&height=550">'.$content.'</a>';  
  }


  function wxform_shortcode_fn($attributes, $content) 
  {
    if(!$attributes['url']) 
    {
      return '';
    }
    else
    {
      $formUrl = $attributes['url'];

      $displayType = 'link';
      if($attributes['type']) 
      {
        $displayType = $attributes['type'];
      }

      if(!$content)
      {
        $content = 'Click Here'; 
      }
      
      $button = array('color'=>'FFF','background'=>'7BB045');
      if($attributes['fg']) 
      {
        $button['color'] = ltrim($attributes['fg'], '#');
      }
      if($attributes['bg']) 
      {
        $button['background'] = ltrim($attributes['bg'], '#');
      }
      return call_user_func(array(__CLASS__,'wx_build_'.$displayType), $formUrl, $content, $button);
    }
  }


  //Setting up Editor Elements
  function add_wx_button()
  {
   return '<a href="javascript:tb_show(\'\',\'#TB_inline?width=800&height=550&inlineId=wx_popup_container\',\'\')" id="insert-wxform-button" class="button" title="Add WebConnex Form"><span class="dashicons dashicons-feedback"></span> Add WebConnex Form</a>';
  }
  function add_wx_popup()
  {
    if($GLOBALS['hook_suffix'] == 'post.php' || $GLOBALS['hook_suffix'] == 'post-new.php')
    {
      include(plugin_dir_path( __FILE__ ) . 'admin/wx-form-management-editor-popup.php');
    }
  }

  function wx_load_admin_styles($hook_suffix) 
  {
    if($hook_suffix == 'post.php' || $hook_suffix == 'post-new.php')
    {
      wp_enqueue_style('wx-styles', plugin_dir_url( __FILE__ ) . 'admin/css/wx-form-management-admin.css');
      wp_enqueue_style( 'wp-color-picker' );
      wp_enqueue_script('wx-script', plugin_dir_url( __FILE__ ) . 'admin/js/wx-form-management-admin.js',array('wp-color-picker'));
    }
  }  
}


$wx_form_management = new wx_form_management();

