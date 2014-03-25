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

add_action('init', 'init_taxonomies', 0);
add_action('atom_ns', 'add_namespace');
add_action('rss2_ns', 'add_namespace');
add_filter('atom_entry', 'add_feed_entry');
add_filter('rss2_item', 'add_feed_entry');

function init_taxonomies()
{
	register_taxonomy('beacon', 'post',
		array(
			'hierarchical' => false,
			'label' => 'Beacon', 
			'query_var' => true,
			'rewrite' => false));
}

function add_namespace()
{
	echo 'xmlns:beacon="urn:waded.org:beacon"';
}

function add_feed_entry()
{
	/* this is just a sample; the taxonomies aren't aligned up with this yet */
	echo '<beacon:uuid>2b41bbe2-42c2-4b84-ab96-6e9d5509138b</beacon:uuid>';
	echo '<beacon:major>0</beacon:major>';
	echo '<beacon:minor>0</beacon:minor>';
}

