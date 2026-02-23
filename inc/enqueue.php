<?php
/**
 * Asset Enqueuing Functions
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
 * Enqueue theme assets.
 *
 * @since 1.0.0
 */
function devengine_enqueue_assets(): void {
	// Enqueue main stylesheet.
	wp_enqueue_style(
		'devengine-main-style',
		DEVENGINE_URI . '/dist/css/main.css',
		array(),
		DEVENGINE_VERSION,
		'all'
	);

	// Enqueue core JavaScript as module.
	wp_enqueue_script(
		'devengine-core',
		DEVENGINE_URI . '/dist/js/theme-core.js',
		array(),
		DEVENGINE_VERSION,
		true
	);

	// Add type="module" attribute to core script.
	add_filter(
		'script_loader_tag',
		function ( string $tag, string $handle ) {
			if ( 'devengine-core' === $handle ) {
				$tag = str_replace( ' src', ' type="module" src', $tag );
			}
			return $tag;
		},
		10,
		2
	);

	// Preload Inter font from Google Fonts.
	wp_enqueue_style(
		'devengine-inter-font',
		'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap',
		array(),
		null
	);

	// Add preconnect resource hints for Google Fonts.
	add_filter(
		'wp_resource_hints',
		function ( array $urls, string $relation_type ): array {
			if ( 'preconnect' === $relation_type ) {
				$urls[] = 'https://fonts.googleapis.com';
				$urls[] = 'https://fonts.gstatic.com';
			}
			return $urls;
		},
		10,
		2
	);

	// Conditionally load Prism.js for code blocks.
	if ( has_block( 'devengine/code-block' ) ) {
		wp_enqueue_style(
			'devengine-prism-css',
			DEVENGINE_URI . '/assets/vendors/prism/prism.css',
			array(),
			DEVENGINE_VERSION
		);

		wp_enqueue_script(
			'devengine-prism-js',
			DEVENGINE_URI . '/assets/vendors/prism/prism.js',
			array(),
			DEVENGINE_VERSION,
			true
		);
	}

	// Conditionally load AOS for animations.
	$has_timeline = has_block( 'devengine/experience-timeline' );
	$has_bento    = has_block( 'devengine/project-bento-grid' );

	if ( $has_timeline || $has_bento ) {
		wp_enqueue_style(
			'devengine-aos-css',
			DEVENGINE_URI . '/assets/vendors/aos/aos.css',
			array(),
			DEVENGINE_VERSION
		);

		wp_enqueue_script(
			'devengine-aos-js',
			DEVENGINE_URI . '/assets/vendors/aos/aos.js',
			array(),
			DEVENGINE_VERSION,
			true
		);
	}

	// Conditionally load GitHub API script.
	if ( has_block( 'devengine/github-repo-card' ) ) {
		wp_enqueue_script(
			'devengine-github-api',
			DEVENGINE_URI . '/dist/js/github-api.js',
			array(),
			DEVENGINE_VERSION,
			true
		);
	}

	// Inline script for FOUC prevention (theme detection).
	$fouc_script = "
		(function() {
			const theme = localStorage.getItem('devengine-theme') || 
				(window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
			document.documentElement.classList.add('theme-' + theme);
		})();
	";

	wp_add_inline_script( 'devengine-core', $fouc_script, 'before' );
}
add_action( 'wp_enqueue_scripts', 'devengine_enqueue_assets', 10 );

/**
 * Enqueue block editor assets.
 *
 * @since 1.0.0
 */
function devengine_enqueue_block_editor_assets(): void {
	wp_enqueue_script(
		'devengine-blocks-editor',
		DEVENGINE_URI . '/dist/js/blocks.js',
		array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor' ),
		DEVENGINE_VERSION,
		true
	);

	wp_enqueue_style(
		'devengine-editor-style',
		DEVENGINE_URI . '/dist/css/editor-style.css',
		array( 'wp-edit-blocks' ),
		DEVENGINE_VERSION
	);
}
add_action( 'enqueue_block_editor_assets', 'devengine_enqueue_block_editor_assets' );

