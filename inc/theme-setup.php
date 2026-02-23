<?php
/**
 * Theme Setup Functions
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
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * @since 1.0.0
 */
function devengine_theme_setup(): void {
	// Load theme text domain.
	load_theme_textdomain( 'devengine', DEVENGINE_DIR . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Add support for block styles.
	add_theme_support( 'wp-block-styles' );

	// Add support for appearance tools.
	add_theme_support( 'appearance-tools' );

	// Add support for post thumbnails.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 630, true );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Add support for HTML5 markup.
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Add support for editor styles.
	add_theme_support( 'editor-styles' );
	add_editor_style( 'dist/css/editor-style.css' );

	// Add support for responsive embeds.
	add_theme_support( 'responsive-embeds' );

	// Add support for wide and full alignments.
	add_theme_support( 'align-wide' );

	// Register custom image sizes.
	add_image_size( 'devengine-hero', 1920, 1080, true );
	add_image_size( 'devengine-card', 800, 600, true );
	add_image_size( 'devengine-masonry', 600, 900, false );
	add_image_size( 'devengine-thumb', 400, 400, true );

	// Register navigation menus.
	register_nav_menus(
		array(
			'primary' => esc_html__( 'Primary Navigation', 'devengine' ),
			'footer'  => esc_html__( 'Footer Navigation', 'devengine' ),
		)
	);

	// Set content width.
	if ( ! isset( $GLOBALS['content_width'] ) ) {
		$GLOBALS['content_width'] = 1200;
	}
}

