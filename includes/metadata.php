<?php

function ctcb_metadata_block_settings(){

	$metadata = array();
	
	$metadata['block_location'] = array(
	'name' => 'block_location',
	'label' => __('Block Location', 'ctcb'),
	'desc' => __('Specify a location for this content block. content blocks can also be inserted through the [cpo_content_block] shortcode.', 'ctcb'),
	'type' => 'select',
	'option' => ctcb_metadata_locations());
	
	$metadata['block_filter'] = array(
	'name' => 'block_filter',
	'label' => __('Block Display', 'ctcb'),
	'desc' => __('Specify on which pages this block should be visible.', 'ctcb'),
	'type' => 'select',
	'option' => ctcb_metadata_filters());
	
	$metadata['block_priority'] = array(
	'name' => 'block_priority',
	'label' => __('Block Priority', 'ctcb'),
	'desc' => __('Specifies the priority in which this block should appear, in case of multiple blocks using the same location. Lower numbers mean higher priority.', 'ctcb'),
	'type' => 'text');
	
	return apply_filters('ctcb_metadata_block_settings', $metadata);
}

//Store metadata for block posts
function ctcb_metadata_block_appearance(){

	$metadata = array();
	
	/*$metadata['block_full'] = array(
	'name' => 'block_full',
	'label' => __('Full Width', 'ctcb'),
	'desc' => __('Removes all containers in this block. If enabled, the content will fill all the available width.', 'ctcb'),
	'type' => 'yesno');*/

	$metadata['block_padding'] = array(
	'name' => 'block_padding',
	'label' => __('Padding', 'ctcb'),
	'desc' => __('You can also use shorthand CSS notation to specify different paddings for each side.', 'ctcb'),
	'type' => 'text');

	$metadata['block_margin'] = array(
	'name' => 'block_margin',
	'label' => __('Margin', 'ctcb'),
	'desc' => __('You can also use shorthand CSS notation to specify different margins for each side.', 'ctcb'),
	'type' => 'text');

	$metadata['block_bg'] = array(
	'name' => 'block_bg',
	'label' => __('Background Color', 'ctcb'),
	'desc' => __('Indicates the background color for this content block. Leave empty for a transparent background.', 'ctcb'),
	'type' => 'color');
	
	$metadata['block_color'] = array(
	'name' => 'block_color',
	'label' => __('Color Scheme', 'ctcb'),
	'desc' => __('Allows you to change the color of texts inside this block, in case you use a dark color as the background.', 'ctcb'),
	'type' => 'select',
	'option' => ctcb_metadata_color());
	
	$metadata['block_css'] = array(
	'name' => 'block_css',
	'label' => __('Custom CSS Styling', 'ctcb'),
	'desc' => __('Allows you to customize the CSS styling of this block.', 'ctcb'),
	'type' => 'textarea');
	
	return apply_filters('ctcb_metadata_block_appearance', $metadata);
}


function ctcb_metadata_locations($key = null){
	$metadata = array(
	'0' => __('(None)', 'ctcb'),
	'core_separator' => array('name' => __('Standard WordPress Hooks', 'ctcb'), 'type' => 'separator'),
	'wp_footer' => 'wp_footer',
	'cpothemes_separator' => array('name' => __('CPOThemes Hooks', 'ctcb'), 'type' => 'separator'),
	'cpotheme_before_wrapper' => __('Before website wrapper', 'ctcb'),
	'cpotheme_top' => __('Top bar', 'ctcb'),
	'cpotheme_header' => __('In The Header', 'ctcb'),
	'cpotheme_before_main' => __('Before main content', 'ctcb'),
	'cpotheme_before_content' => __('Before post content', 'ctcb'),
	'cpotheme_after_content' => __('After post content', 'ctcb'),
	'cpotheme_after_main' => __('After main content', 'ctcb'),
	'cpotheme_subfooter' => __('In the subfooter', 'ctcb'),
	'cpotheme_before_footer' => __('Before footer area', 'ctcb'),
	'cpotheme_footer' => __('In the footer', 'ctcb'),
	'cpotheme_after_footer' => __('After footer area', 'ctcb'),
	'cpotheme_after_wrapper' => __('After website wrapper', 'ctcb'),
	'cpotheme_404' => __('On 404 pages', 'ctcb'),
	);
	
	$metadata = apply_filters('ctcb_metadata_locations', $metadata);
	return $key != null && isset($metadata[$key]) ? $metadata[$key] : $metadata;
}



function ctcb_metadata_filters($key = null){
	$metadata = array(
	'always' => __('Show Always', 'ctcb'),
	'front_page' => __('Front Page', 'ctcb'),
	'post' => __('Posts', 'ctcb'),
	'page' => __('Pages', 'ctcb'),
	'404' => __('404 Pages', 'ctcb'),
	'search' => __('Search Pages', 'ctcb'));
	
	//Add public post types
	/*$post_types = get_post_types(array('public' => true), 'objects');
	foreach($post_types as $current_type => $current_data)
		$metadata[$current_type] = $current_data->labels->name;*/
	
	//Add public taxonomies
	/*$taxonomies = get_taxonomies(array('public' => true), 'objects');
	foreach($taxonomies as $taxonomy => $current_data)
		$metadata[$taxonomy] = $current_data->labels->name;*/
	
	return $key != null && isset($metadata[$key]) ? $metadata[$key] : $metadata;
}

function ctcb_metadata_color($key = null){
	$metadata = array(
	'light' => __('Light Scheme', 'ctcb'),
	'dark' => __('Dark Scheme', 'ctcb'),
	);
	return $key != null && isset($metadata[$key]) ? $metadata[$key] : $metadata;
}