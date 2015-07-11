<?php
/*
Plugin Name: CPO Content blocks
Description: Allows you to create reusable pieces of content that you can place anywhere in your site. Insert them into your posts, on a sidebar, or place them directly onto the layout thanks to the different areas available.
Author: CPOThemes
Version: 1.0.0
Author URI: http://www.cpothemes.com
*/

//Plugin setup
if(!function_exists('ctcb_setup')){
	add_action('plugins_loaded', 'ctcb_setup');
	function ctcb_setup(){
		//Load text domain
		$textdomain = 'ctcb';
		$locale = apply_filters('plugin_locale', get_locale(), $textdomain);
		if(!load_textdomain($textdomain, trailingslashit(WP_LANG_DIR).$textdomain.'/'.$textdomain.'-'.$locale.'.mo')){
			load_plugin_textdomain($textdomain, FALSE, basename(dirname(__FILE__)).'/languages/');
		}
	}
}


//Add public stylesheets
add_action('wp_enqueue_scripts', 'ctcb_add_styles');
function ctcb_add_styles(){
	$stylesheets_path = plugins_url('css/' , __FILE__);
	wp_enqueue_style('ctcb-content-blocks', $stylesheets_path.'style.css');
}


//Add admin stylesheets
add_action('admin_print_styles', 'ctcb_add_styles_admin');
function ctcb_add_styles_admin(){
	$stylesheets_path = plugins_url('css/' , __FILE__);
	wp_enqueue_style('ctcb-admin', $stylesheets_path.'admin.css');
}


//Add all Shortcode components
$core_path = plugin_dir_path(__FILE__);

//General
require_once($core_path.'includes/post-types.php');
require_once($core_path.'includes/meta.php');
require_once($core_path.'includes/forms.php');
require_once($core_path.'includes/general.php');
require_once($core_path.'includes/metadata.php');