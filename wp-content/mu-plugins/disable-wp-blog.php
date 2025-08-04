<?php
/*
Plugin Name: Disable WP Blog (MU)
Description: Disables the default WordPress blog post type, taxonomies, feeds, and related routes.
Version: 1.0
Author: adeel.cs@gmail.com
*/

// Remove default Posts menu
add_action('admin_menu', function () {
	remove_menu_page('edit.php');
});

// Hide Post Widgets from Dashboard
add_action('wp_dashboard_setup', function () {
	remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
	remove_meta_box('dashboard_primary', 'dashboard', 'side');
});

// Remove Tags and Categories from Posts
add_action('init', function () {
	unregister_taxonomy_for_object_type('post_tag', 'post');
	unregister_taxonomy_for_object_type('category', 'post');
});

//Disable Post Feeds
add_action('do_feed',     '__return_false', 1);
add_action('do_feed_rdf', '__return_false', 1);
add_action('do_feed_rss', '__return_false', 1);
add_action('do_feed_rss2','__return_false', 1);
add_action('do_feed_atom','__return_false', 1);

// Remove default post_type rewrite rules
add_filter('rewrite_rules_array', function ($rules) {
	foreach ($rules as $rule => $rewrite) {
		if (strpos($rewrite, 'index.php?post_type=post') !== false) {
			unset($rules[$rule]);
		}
	}
	return $rules;
});

// Filter to disable the post_type from being registered and display in admin / plugins
add_filter( 'register_post_type_args', function ( $args, $post_type ) {
	if ( $post_type === 'post' ) {
		$args['public']              = false;
		$args['show_in_menu']        = false;
		$args['publicly_queryable']  = false;
		$args['exclude_from_search'] = true;
		$args['show_in_rest']        = true; // Keep this true to avoid Site Health error REST API check failures
	}

	return $args;
}, 10, 2 );
