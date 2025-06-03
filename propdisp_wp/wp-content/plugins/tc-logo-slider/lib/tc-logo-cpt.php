<?php
// Custom Post Type Setup
function tc_logo_slider_post_type() {
	$labels = array(
		'name' => __('All TC Logos', 'tc-logo-slider'),
		'singular_name' => __('TC Logo Slider', 'tc-logo-slider'),
		'add_new' => __('Add New Logo', 'tc-logo-slider'),
		'all_items' => __('All Logos', 'tc-logo-slider' ),
		'add_new_item' => __('Add New Logo', 'tc-logo-slider'),
		'edit_item' => __('Edit Slider', 'tc-logo-slider'),
		'new_item' => __('New Slider', 'tc-logo-slider'),
		'view_item' => __('View Slider', 'tc-logo-slider'),
		'search_items' => __('Search Slider', 'tc-logo-slider'),
		'not_found' => __('No Slider', 'tc-logo-slider'),
		'not_found_in_trash' => __('No Slider found in Trash', 'tc-logo-slider'),
		'parent_item_colon' => '',
		'menu_name' => __('TC Logo Slider', 'tc-logo-slider') // this name will be shown on the menu
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'exclude_from_search' => true,
		'publicly_queryable' => false,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'page',
		'has_archive' => true,
		'hierarchical' => false,
		'menu_position' => 5,
		'menu_icon' =>'dashicons-share-alt',
		'supports' => array('title','thumbnail', 'page-attributes')
	);
	register_post_type('tclogoslider', $args);
}
 add_action( 'init', 'tc_logo_slider_post_type' );

// Adding a taxonomy for the Slider post type
function themescode_Slider_taxonomy() {
		$args = array('hierarchical' => true);
		register_taxonomy( 'tclogo_category', 'tclogoslider', $args );
	}
 add_action( 'init', 'themescode_Slider_taxonomy', 0 );
