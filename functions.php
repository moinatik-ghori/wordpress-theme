<?php
/**
 * DevEngine Premium Theme Functions
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

// Define theme constants.
if ( ! defined( 'DEVENGINE_VERSION' ) ) {
	define( 'DEVENGINE_VERSION', '1.0.0' );
}

if ( ! defined( 'DEVENGINE_DIR' ) ) {
	define( 'DEVENGINE_DIR', get_template_directory() );
}

if ( ! defined( 'DEVENGINE_URI' ) ) {
	define( 'DEVENGINE_URI', get_template_directory_uri() );
}

if ( ! defined( 'DEVENGINE_INC' ) ) {
	define( 'DEVENGINE_INC', DEVENGINE_DIR . '/inc/' );
}

// Load theme setup.
require_once DEVENGINE_INC . 'theme-setup.php';

// Load asset enqueuing.
require_once DEVENGINE_INC . 'enqueue.php';

// Load custom post types.
require_once DEVENGINE_INC . 'custom-post-types.php';

// Load GitHub API integration.
require_once DEVENGINE_INC . 'class-github-api.php';

// Load theme customizer.
require_once DEVENGINE_INC . 'customizer.php';

// Load block patterns.
require_once DEVENGINE_INC . 'block-patterns.php';

// Load breadcrumbs.
require_once DEVENGINE_INC . 'breadcrumbs.php';

// Load security functions.
require_once DEVENGINE_INC . 'security.php';

// Load navigation walker.
require_once DEVENGINE_INC . 'nav-walker.php';

/**
 * Initialize theme setup.
 *
 * @since 1.0.0
 */
add_action( 'after_setup_theme', 'devengine_theme_setup', 10 );

/**
 * Register widget areas.
 *
 * @since 1.0.0
 */
function devengine_register_sidebars(): void {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Blog Sidebar', 'devengine' ),
			'id'            => 'devengine-sidebar',
			'description'   => esc_html__( 'Add widgets here to appear in the blog sidebar.', 'devengine' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Widget Area', 'devengine' ),
			'id'            => 'devengine-footer',
			'description'   => esc_html__( 'Add widgets here to appear in the footer.', 'devengine' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'devengine_register_sidebars' );

