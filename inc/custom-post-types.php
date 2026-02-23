<?php
/**
 * Custom Post Types and Taxonomies
 *
 * @package DevEngine_Premium
 * @since 1.0.0
 */

declare(strict_types=1);

/**
 * DevEngine Premium WordPress Theme, (C) 2024 DevEngine
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package DevEngine_Premium
 * @since 1.0.0
 */

/**
 * Register custom post types and taxonomies.
 *
 * @since 1.0.0
 */
function devengine_register_post_types(): void {
	// Register Projects post type.
	register_post_type(
		'devengine_project',
		array(
			'labels'              => array(
				'name'                  => esc_html_x( 'Projects', 'Post type general name', 'devengine' ),
				'singular_name'         => esc_html_x( 'Project', 'Post type singular name', 'devengine' ),
				'menu_name'             => esc_html_x( 'Projects', 'Admin Menu text', 'devengine' ),
				'name_admin_bar'        => esc_html_x( 'Project', 'Add New on Toolbar', 'devengine' ),
				'add_new'               => esc_html__( 'Add New', 'devengine' ),
				'add_new_item'          => esc_html__( 'Add New Project', 'devengine' ),
				'new_item'              => esc_html__( 'New Project', 'devengine' ),
				'edit_item'             => esc_html__( 'Edit Project', 'devengine' ),
				'view_item'             => esc_html__( 'View Project', 'devengine' ),
				'all_items'             => esc_html__( 'All Projects', 'devengine' ),
				'search_items'          => esc_html__( 'Search Projects', 'devengine' ),
				'parent_item_colon'     => esc_html__( 'Parent Projects:', 'devengine' ),
				'not_found'             => esc_html__( 'No projects found.', 'devengine' ),
				'not_found_in_trash'    => esc_html__( 'No projects found in Trash.', 'devengine' ),
				'featured_image'        => esc_html__( 'Project Cover Image', 'devengine' ),
				'set_featured_image'    => esc_html__( 'Set cover image', 'devengine' ),
				'remove_featured_image' => esc_html__( 'Remove cover image', 'devengine' ),
				'use_featured_image'    => esc_html__( 'Use as cover image', 'devengine' ),
				'archives'              => esc_html__( 'Project archives', 'devengine' ),
				'insert_into_item'      => esc_html__( 'Insert into project', 'devengine' ),
				'uploaded_to_this_item' => esc_html__( 'Uploaded to this project', 'devengine' ),
				'filter_items_list'     => esc_html__( 'Filter projects list', 'devengine' ),
				'items_list_navigation' => esc_html__( 'Projects list navigation', 'devengine' ),
				'items_list'            => esc_html__( 'Projects list', 'devengine' ),
			),
			'public'              => true,
			'show_in_rest'        => true,
			'has_archive'         => true,
			'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'revisions' ),
			'rewrite'             => array( 'slug' => 'projects' ),
			'menu_icon'           => 'dashicons-code-standards',
			'capability_type'     => 'post',
			'show_ui'             => true,
			'show_in_menu'        => true,
			'query_var'           => true,
			'can_export'          => true,
			'delete_with_user'    => false,
		)
	);

	// Register Snippets post type.
	register_post_type(
		'devengine_snippet',
		array(
			'labels'              => array(
				'name'                  => esc_html_x( 'Snippets', 'Post type general name', 'devengine' ),
				'singular_name'         => esc_html_x( 'Snippet', 'Post type singular name', 'devengine' ),
				'menu_name'             => esc_html_x( 'Snippets', 'Admin Menu text', 'devengine' ),
				'name_admin_bar'        => esc_html_x( 'Snippet', 'Add New on Toolbar', 'devengine' ),
				'add_new'               => esc_html__( 'Add New', 'devengine' ),
				'add_new_item'          => esc_html__( 'Add New Snippet', 'devengine' ),
				'new_item'              => esc_html__( 'New Snippet', 'devengine' ),
				'edit_item'             => esc_html__( 'Edit Snippet', 'devengine' ),
				'view_item'             => esc_html__( 'View Snippet', 'devengine' ),
				'all_items'             => esc_html__( 'All Snippets', 'devengine' ),
				'search_items'          => esc_html__( 'Search Snippets', 'devengine' ),
				'parent_item_colon'     => esc_html__( 'Parent Snippets:', 'devengine' ),
				'not_found'             => esc_html__( 'No snippets found.', 'devengine' ),
				'not_found_in_trash'    => esc_html__( 'No snippets found in Trash.', 'devengine' ),
				'featured_image'        => esc_html__( 'Snippet Cover Image', 'devengine' ),
				'set_featured_image'    => esc_html__( 'Set cover image', 'devengine' ),
				'remove_featured_image' => esc_html__( 'Remove cover image', 'devengine' ),
				'use_featured_image'    => esc_html__( 'Use as cover image', 'devengine' ),
				'archives'              => esc_html__( 'Snippet archives', 'devengine' ),
				'insert_into_item'      => esc_html__( 'Insert into snippet', 'devengine' ),
				'uploaded_to_this_item' => esc_html__( 'Uploaded to this snippet', 'devengine' ),
				'filter_items_list'     => esc_html__( 'Filter snippets list', 'devengine' ),
				'items_list_navigation' => esc_html__( 'Snippets list navigation', 'devengine' ),
				'items_list'            => esc_html__( 'Snippets list', 'devengine' ),
			),
			'public'              => true,
			'show_in_rest'        => true,
			'has_archive'         => true,
			'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
			'rewrite'             => array( 'slug' => 'snippets' ),
			'menu_icon'           => 'dashicons-editor-code',
			'capability_type'     => 'post',
			'show_ui'             => true,
			'show_in_menu'        => true,
			'query_var'           => true,
			'can_export'          => true,
			'delete_with_user'    => false,
		)
	);

	// Register Tech Stack taxonomy for Projects.
	register_taxonomy(
		'devengine_tech',
		array( 'devengine_project' ),
		array(
			'labels'            => array(
				'name'              => esc_html_x( 'Tech Stack', 'Taxonomy general name', 'devengine' ),
				'singular_name'     => esc_html_x( 'Tech', 'Taxonomy singular name', 'devengine' ),
				'menu_name'         => esc_html_x( 'Tech Stack', 'Admin Menu text', 'devengine' ),
				'all_items'         => esc_html__( 'All Tech', 'devengine' ),
				'edit_item'         => esc_html__( 'Edit Tech', 'devengine' ),
				'view_item'         => esc_html__( 'View Tech', 'devengine' ),
				'update_item'       => esc_html__( 'Update Tech', 'devengine' ),
				'add_new_item'      => esc_html__( 'Add New Tech', 'devengine' ),
				'new_item_name'     => esc_html__( 'New Tech Name', 'devengine' ),
				'search_items'     => esc_html__( 'Search Tech', 'devengine' ),
				'popular_items'     => esc_html__( 'Popular Tech', 'devengine' ),
				'separate_items_with_commas' => esc_html__( 'Separate tech with commas', 'devengine' ),
				'add_or_remove_items'        => esc_html__( 'Add or remove tech', 'devengine' ),
				'choose_from_most_used'      => esc_html__( 'Choose from the most used tech', 'devengine' ),
				'not_found'                  => esc_html__( 'No tech found.', 'devengine' ),
				'no_terms'                   => esc_html__( 'No tech', 'devengine' ),
				'items_list_navigation'      => esc_html__( 'Tech list navigation', 'devengine' ),
				'items_list'                 => esc_html__( 'Tech list', 'devengine' ),
			),
			'hierarchical'      => false,
			'public'            => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'show_tagcloud'     => true,
			'show_in_rest'      => true,
			'rewrite'           => array( 'slug' => 'tech' ),
		)
	);

	// Register Snippet Category taxonomy for Snippets.
	register_taxonomy(
		'devengine_category',
		array( 'devengine_snippet' ),
		array(
			'labels'            => array(
				'name'              => esc_html_x( 'Snippet Categories', 'Taxonomy general name', 'devengine' ),
				'singular_name'     => esc_html_x( 'Snippet Category', 'Taxonomy singular name', 'devengine' ),
				'menu_name'         => esc_html_x( 'Categories', 'Admin Menu text', 'devengine' ),
				'all_items'         => esc_html__( 'All Categories', 'devengine' ),
				'edit_item'         => esc_html__( 'Edit Category', 'devengine' ),
				'view_item'         => esc_html__( 'View Category', 'devengine' ),
				'update_item'       => esc_html__( 'Update Category', 'devengine' ),
				'add_new_item'      => esc_html__( 'Add New Category', 'devengine' ),
				'new_item_name'     => esc_html__( 'New Category Name', 'devengine' ),
				'parent_item'       => esc_html__( 'Parent Category', 'devengine' ),
				'parent_item_colon' => esc_html__( 'Parent Category:', 'devengine' ),
				'search_items'     => esc_html__( 'Search Categories', 'devengine' ),
				'popular_items'     => esc_html__( 'Popular Categories', 'devengine' ),
				'separate_items_with_commas' => esc_html__( 'Separate categories with commas', 'devengine' ),
				'add_or_remove_items'        => esc_html__( 'Add or remove categories', 'devengine' ),
				'choose_from_most_used'      => esc_html__( 'Choose from the most used categories', 'devengine' ),
				'not_found'                  => esc_html__( 'No categories found.', 'devengine' ),
				'no_terms'                   => esc_html__( 'No categories', 'devengine' ),
				'items_list_navigation'      => esc_html__( 'Categories list navigation', 'devengine' ),
				'items_list'                 => esc_html__( 'Categories list', 'devengine' ),
			),
			'hierarchical'      => true,
			'public'            => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'show_tagcloud'     => true,
			'show_in_rest'      => true,
			'rewrite'           => array( 'slug' => 'snippet-category' ),
		)
	);

	// Register meta fields for Projects.
	register_post_meta(
		'devengine_project',
		'_project_url',
		array(
			'show_in_rest' => true,
			'single'       => true,
			'type'         => 'string',
			'auth_callback' => function() {
				return current_user_can( 'edit_posts' );
			},
			'sanitize_callback' => 'esc_url_raw',
		)
	);

	register_post_meta(
		'devengine_project',
		'_project_github_url',
		array(
			'show_in_rest' => true,
			'single'       => true,
			'type'         => 'string',
			'auth_callback' => function() {
				return current_user_can( 'edit_posts' );
			},
			'sanitize_callback' => 'esc_url_raw',
		)
	);

	register_post_meta(
		'devengine_project',
		'_project_tech_stack',
		array(
			'show_in_rest' => true,
			'single'       => true,
			'type'         => 'array',
			'auth_callback' => function() {
				return current_user_can( 'edit_posts' );
			},
			'sanitize_callback' => function( $value ) {
				if ( ! is_array( $value ) ) {
					return array();
				}
				return array_map( 'sanitize_text_field', $value );
			},
		)
	);

	register_post_meta(
		'devengine_project',
		'_project_status',
		array(
			'show_in_rest' => true,
			'single'       => true,
			'type'         => 'string',
			'auth_callback' => function() {
				return current_user_can( 'edit_posts' );
			},
			'sanitize_callback' => function( $value ) {
				$allowed = array( 'active', 'archived', 'wip' );
				return in_array( $value, $allowed, true ) ? $value : 'active';
			},
		)
	);

	// Register meta fields for Snippets.
	register_post_meta(
		'devengine_snippet',
		'_snippet_language',
		array(
			'show_in_rest' => true,
			'single'       => true,
			'type'         => 'string',
			'auth_callback' => function() {
				return current_user_can( 'edit_posts' );
			},
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	register_post_meta(
		'devengine_snippet',
		'_snippet_difficulty',
		array(
			'show_in_rest' => true,
			'single'       => true,
			'type'         => 'string',
			'auth_callback' => function() {
				return current_user_can( 'edit_posts' );
			},
			'sanitize_callback' => function( $value ) {
				$allowed = array( 'beginner', 'intermediate', 'advanced' );
				return in_array( $value, $allowed, true ) ? $value : 'beginner';
			},
		)
	);
}
add_action( 'init', 'devengine_register_post_types', 5 );

/**
 * Flush rewrite rules on theme activation.
 *
 * @since 1.0.0
 */
function devengine_flush_rewrite_rules(): void {
	devengine_register_post_types();
	flush_rewrite_rules( false );
}
add_action( 'after_switch_theme', 'devengine_flush_rewrite_rules' );

