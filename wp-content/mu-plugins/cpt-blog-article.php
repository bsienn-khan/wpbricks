<?php
/**
 * Plugin Name: Blog Article CPT (MU)
 * Description: Registers the "Blog Article" CPT with all extras: support for SCF/ACF fields, custom taxonomy, Bricks templates, and REST API.
 * Author: adeel.cs@gmail.com
 * Version: 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

const LABEL = 'blog_article';

final class BlogArticle {
	public static function register(): void {
		// Register Custom Post Type
		register_post_type( LABEL, [
			'label'         => 'Blog Articles',
			'labels'        => [
				'name'          => 'Blog Articles',
				'singular_name' => 'Blog Article',
				'add_new_item'  => 'Add New Blog Article',
				'edit_item'     => 'Edit Blog Article',
				'new_item'      => 'New Blog Article',
				'view_item'     => 'View Blog Article',
				'search_items'  => 'Search Blog Articles',
			],
			'public'        => true,
			'has_archive'   => true,
			'rewrite'       => [ 'slug' => 'blog' ],
			'menu_position' => 5,
			'menu_icon'     => 'dashicons-edit-page',
			'show_in_rest'  => true, // Enable for block editor & REST API
			'supports'      => [ 'title', 'editor', 'excerpt', 'thumbnail' ],
			'taxonomies'    => [ 'blog_topic' ],
		] );

		// Register Custom Taxonomy
		register_taxonomy( 'blog_topic', LABEL, [
			'label'        => 'Topics',
			'labels'       => [
				'name'          => 'Topics',
				'singular_name' => 'Topic',
				'search_items'  => 'Search Topics',
				'all_items'     => 'All Topics',
				'edit_item'     => 'Edit Topic',
				'update_item'   => 'Update Topic',
				'add_new_item'  => 'Add New Topic',
				'new_item_name' => 'New Topic Name',
			],
			'hierarchical' => true,
			'public'       => true,
			'show_in_rest' => true,
			'rewrite'      => [ 'slug' => 'topic' ],
		] );
	}
}

/*
 * Register the Blog Article CPT and its taxonomy
 */
add_action( 'init', [ BlogArticle::class, 'register' ] );
