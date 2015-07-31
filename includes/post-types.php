<?php
// Exit if accessed directly
if(!defined('ABSPATH')) exit;


//Register post type
function ctcb_post_types(){
	//Add portfolio
	$labels = array('name' => __('Content Blocks', 'ctcb'),
	'singular_name' => __('Content Block', 'ctcb'),
	'add_new' => __('Add Content Block', 'ctcb'),
	'add_new_item' => __('Add New Content Block', 'ctcb'),
	'edit_item' => __('Edit Content Block', 'ctcb'),
	'new_item' => __('New Content Block', 'ctcb'),
	'view_item' => __('View Content Blocks', 'ctcb'),
	'search_items' => __('Search Content Blocks', 'ctcb'),
	'not_found' =>  __('No content blocks found.', 'ctcb'),
	'not_found_in_trash' => __('No content blocks found in the trash.', 'ctcb'), 
	'parent_item_colon' => '');
	
	$fields = array('labels' => $labels,
	'public' => false,
	'publicly_queryable' => false,
	'show_ui' => true, 
	'query_var' => true,
	'capability_type' => 'post',
	'hierarchical' => false,
	'show_in_nav_menus' => true,
	'menu_icon' => 'dashicons-schedule',
	'menu_position' => null,
	'supports' => array('title', 'editor')); 
	register_post_type('cpo_content_block', $fields);
}
add_action('init', 'ctcb_post_types');


//Declare columns
function ctcb_post_columns($columns){
	$columns = array(
	'cb' => '<input type="checkbox" />',
	'title' => __('Title', 'ctcb'),
	'ctcb-excerpt' => __('Content', 'ctcb'),
	'ctcb-location' => __('Location', 'ctcb'),
	'ctcb-pages' => __('Pages', 'ctcb'),
	);
	return $columns;
}
add_filter('manage_edit-cpo_content_block_columns', 'ctcb_post_columns') ;


//Declare column content
function ctcb_post_columns_content($column){
	global $post;
	switch($column){
		case 'ctcb-location': 
			echo ctcb_metadata_locations(get_post_meta($post->ID, 'block_location', true));
		break;	
		case 'ctcb-excerpt': 
			$content = strip_tags($post->post_content);
			echo substr($content, 0, 180);
			if(strlen($content) > 180) echo '&hellip;';
		break;	
		case 'ctcb-pages': 
			$pages = get_post_meta($post->ID, 'block_pages', true);
			if(is_array($pages)) foreach($pages as $current_page => $current_value){
				echo ctcb_metadata_pages($current_page).'<br>';
			}
		break;	
		default:break;
	}
}
add_action('manage_posts_custom_column', 'ctcb_post_columns_content', 2);


//Add metaboxes to block posts
function ctcb_metaboxes(){
	add_meta_box('cpo_content_block_settings', __('Block Settings', 'ctcb'), 'ctcb_metabox_settings', 'cpo_content_block', 'side', 'default');
	add_meta_box('cpo_content_block_appearance', __('Block Appearance', 'ctcb'), 'ctcb_metabox_appearance', 'cpo_content_block', 'normal', 'high');
}
add_action('add_meta_boxes', 'ctcb_metaboxes');


//Display metaboxes
function ctcb_metabox_settings($post){ 
	ctcb_meta_fields($post, ctcb_metadata_block_settings());
}


//Display metaboxes
function ctcb_metabox_appearance($post){ 
	do_action('ctcb_metabox_before_appearance');
	ctcb_meta_fields($post, ctcb_metadata_block_appearance());
	do_action('ctcb_metabox_after_appearance');
}


//Save metaboxes on post update
function ctcb_metabox_save($post){
	ctcb_meta_save(ctcb_metadata_block_settings());
	ctcb_meta_save(ctcb_metadata_block_appearance());
}
add_action('save_post_cpo_content_block', 'ctcb_metabox_save');