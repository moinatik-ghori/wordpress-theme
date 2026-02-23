<?php
/**
 * Header Template
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
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-to-content" href="#main-content"><?php esc_html_e( 'Skip to main content', 'devengine' ); ?></a>

<header class="site-header" role="banner" data-sticky="<?php echo esc_attr( get_theme_mod( 'devengine_header_sticky', true ) ? 'true' : 'false' ); ?>">
	<div class="site-header__inner container">
		<div class="site-header__brand">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-header__logo-text" rel="home">
					<?php bloginfo( 'name' ); ?>
				</a>
			<?php endif; ?>
		</div>

		<nav class="site-header__nav" role="navigation" aria-label="<?php esc_attr_e( 'Primary Navigation', 'devengine' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'menu_class'     => 'nav__list',
					'container'      => false,
					'fallback_cb'    => false,
					'walker'         => new \DevEngine\Nav_Walker(),
				)
			);
			?>
		</nav>

		<div class="site-header__actions">
			<?php if ( get_theme_mod( 'devengine_dark_mode_toggle', true ) ) : ?>
				<button class="btn btn--icon" data-theme-toggle aria-label="<?php esc_attr_e( 'Toggle dark mode', 'devengine' ); ?>" aria-pressed="false">
					<?php get_template_part( 'parts/icons/sun' ); ?>
				</button>
			<?php endif; ?>

			<a href="<?php echo esc_url( get_theme_mod( 'devengine_header_cta_url', '#contact' ) ); ?>" class="btn btn--primary">
				<?php echo esc_html( get_theme_mod( 'devengine_header_cta_text', 'Hire Me' ) ); ?>
			</a>

			<button class="btn btn--icon nav__hamburger" data-menu-toggle aria-label="<?php esc_attr_e( 'Open mobile menu', 'devengine' ); ?>" aria-expanded="false" aria-controls="mobile-nav">
				<span class="nav__hamburger-bar"></span>
				<span class="nav__hamburger-bar"></span>
				<span class="nav__hamburger-bar"></span>
			</button>
		</div>
	</div>
</header>

<nav id="mobile-nav" class="nav--mobile" role="navigation" aria-label="<?php esc_attr_e( 'Mobile Navigation', 'devengine' ); ?>" aria-hidden="true">
	<?php
	wp_nav_menu(
		array(
			'theme_location' => 'primary',
			'menu_class'     => 'nav--mobile__list',
			'container'      => false,
		)
	);
	?>
</nav>

<div class="nav__overlay" aria-hidden="true"></div>

<div id="header-sentinel" aria-hidden="true"></div>

<main id="main-content" class="site-main" role="main">

