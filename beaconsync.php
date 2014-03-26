<?php
/*
Plugin Name: Beaconsync
Plugin URI: https://github.com/waded/beaconsync
Description: A plugin for relating posts to Bluetooth Low Energy beacons, and syncing the relationships to devices
Version: 0.1
Author: Wade Dorrell
Author URI: http://waded.org
License: MIT
GitHub Plugin URI: https://github.com/waded/beaconsync
*/

add_action('init', 'initTaxonomies', 0);
add_action('atom_ns', 'addNamespace');
add_action('rss2_ns', 'addNamespace');
add_filter('atom_entry', 'addBeaconsElementsToEntry');
add_filter('rss2_item', 'addBeaconsElementsToEntry');

function initTaxonomies()
{
	$labels = array(
		'name'                       => _x( 'Beacon UUID', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Beacon UUID', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Beacon UUID', 'text_domain' ),
		'all_items'                  => __( 'All UUIDs', 'text_domain' ),
		'parent_item'                => __( '', 'text_domain' ),
		'parent_item_colon'          => __( '', 'text_domain' ),
		'new_item_name'              => __( 'New UUID', 'text_domain' ),
		'add_new_item'               => __( 'Add New UUID', 'text_domain' ),
		'edit_item'                  => __( 'Edit UUID', 'text_domain' ),
		'update_item'                => __( 'Update UUID', 'text_domain' ),
		'separate_items_with_commas' => __( 'Only the first UUID will be used', 'text_domain' ),
		'search_items'               => __( 'Search UUIDs', 'text_domain' ),
		'add_or_remove_items'        => __( '', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from previous UUIDs', 'text_domain' ));

	register_taxonomy('beacon-uuid', 'post',
		array(
			'hierarchical' => false,
			'labels' => $labels,
			'query_var' => true,
			'rewrite' => false));

	$labels = array(
		'name'                       => _x( 'Beacon Major/Minor', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Beacon Major/Minor', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Beacon Major/Minor', 'text_domain' ),
		'all_items'                  => __( 'All Major/Minors', 'text_domain' ),
		'parent_item'                => __( '', 'text_domain' ),
		'parent_item_colon'          => __( '', 'text_domain' ),
		'new_item_name'              => __( 'New Major/Minor', 'text_domain' ),
		'add_new_item'               => __( 'Add New Major/Minor', 'text_domain' ),
		'edit_item'                  => __( 'Edit Major/Minor', 'text_domain' ),
		'update_item'                => __( 'Update Major/Minor', 'text_domain' ),
		'separate_items_with_commas' => __( 'E.g. "5.2"', 'text_domain' ),
		'search_items'               => __( 'Search Major/Minors', 'text_domain' ),
		'add_or_remove_items'        => __( '', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from previous Major/Minor values', 'text_domain' ));

	register_taxonomy('beacon-majorminor', 'post',
		array(
			'hierarchical' => false,
			'labels' => $labels,
			'query_var' => true,
			'rewrite' => false));
}

function addNamespace()
{
	echo 'xmlns:beacon="urn:beaconsync:1"';
}

function addBeaconsElementsToEntry()
{
	global $post;

	// We don't intend to support multiple beacons per post, so only take the first
	echoNothingOrNameOfFirstTerm(get_the_terms($post->ID, 'beacon-uuid'), 
		'<beacon:uuid>', '</beacon:uuid>');
	echoNothingOrNameOfFirstTerm(get_the_terms($post->ID, 'beacon-majorminor'), 
		'<beacon:majorminor>', '</beacon:majorminor>');
}

function echoNothingOrNameOfFirstTerm($terms, $prefix, $suffix)
{
	if (!empty($terms))
	{
		echo $prefix . reset($terms)->name . $suffix;
	}
}

