<?php
/**
 * Theme Customizer Settings
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
 * Register Customizer settings and controls.
 *
 * @since 1.0.0
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager instance.
 */
function devengine_customizer_register( \WP_Customize_Manager $wp_customize ): void {
	// Panel 1: Design System.
	$wp_customize->add_panel(
		'devengine_design',
		array(
			'title'       => esc_html__( 'Design System', 'devengine' ),
			'description' => esc_html__( 'Customize the theme design system including colors, typography, and dark mode.', 'devengine' ),
			'priority'    => 30,
		)
	);

	// Section: Colors.
	$wp_customize->add_section(
		'devengine_colors',
		array(
			'title'    => esc_html__( 'Colors', 'devengine' ),
			'panel'    => 'devengine_design',
			'priority' => 10,
		)
	);

	$wp_customize->add_setting(
		'devengine_color_primary',
		array(
			'default'           => '#2dd4bf',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new \WP_Customize_Color_Control(
			$wp_customize,
			'devengine_color_primary',
			array(
				'label'   => esc_html__( 'Primary Accent (Teal)', 'devengine' ),
				'section' => 'devengine_colors',
			)
		)
	);

	$wp_customize->add_setting(
		'devengine_color_background',
		array(
			'default'           => '#0f172a',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new \WP_Customize_Color_Control(
			$wp_customize,
			'devengine_color_background',
			array(
				'label'   => esc_html__( 'Background (Slate)', 'devengine' ),
				'section' => 'devengine_colors',
			)
		)
	);

	$wp_customize->add_setting(
		'devengine_color_surface',
		array(
			'default'           => '#1e293b',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new \WP_Customize_Color_Control(
			$wp_customize,
			'devengine_color_surface',
			array(
				'label'   => esc_html__( 'Surface Color', 'devengine' ),
				'section' => 'devengine_colors',
			)
		)
	);

	$wp_customize->add_setting(
		'devengine_color_text',
		array(
			'default'           => '#f8fafc',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new \WP_Customize_Color_Control(
			$wp_customize,
			'devengine_color_text',
			array(
				'label'   => esc_html__( 'Body Text', 'devengine' ),
				'section' => 'devengine_colors',
			)
		)
	);

	$wp_customize->add_setting(
		'devengine_color_muted',
		array(
			'default'           => '#64748b',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new \WP_Customize_Color_Control(
			$wp_customize,
			'devengine_color_muted',
			array(
				'label'   => esc_html__( 'Muted Text', 'devengine' ),
				'section' => 'devengine_colors',
			)
		)
	);

	// Section: Typography.
	$wp_customize->add_section(
		'devengine_typography',
		array(
			'title'    => esc_html__( 'Typography', 'devengine' ),
			'panel'    => 'devengine_design',
			'priority' => 20,
		)
	);

	$wp_customize->add_setting(
		'devengine_font_body',
		array(
			'default'           => 'Inter',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'devengine_font_body',
		array(
			'label'   => esc_html__( 'Body Font', 'devengine' ),
			'section' => 'devengine_typography',
			'type'    => 'select',
			'choices' => array(
				'Inter'     => 'Inter',
				'DM Sans'   => 'DM Sans',
				'Outfit'    => 'Outfit',
				'Sora'      => 'Sora',
				'System UI' => 'System UI',
			),
		)
	);

	$wp_customize->add_setting(
		'devengine_font_heading',
		array(
			'default'           => 'Inter',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'devengine_font_heading',
		array(
			'label'   => esc_html__( 'Heading Font', 'devengine' ),
			'section' => 'devengine_typography',
			'type'    => 'select',
			'choices' => array(
				'Inter'     => 'Inter',
				'DM Sans'   => 'DM Sans',
				'Outfit'    => 'Outfit',
				'Sora'      => 'Sora',
				'System UI' => 'System UI',
			),
		)
	);

	$wp_customize->add_setting(
		'devengine_font_mono',
		array(
			'default'           => 'JetBrains Mono',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'devengine_font_mono',
		array(
			'label'   => esc_html__( 'Monospace Font', 'devengine' ),
			'section' => 'devengine_typography',
			'type'    => 'select',
			'choices' => array(
				'JetBrains Mono' => 'JetBrains Mono',
				'Fira Code'      => 'Fira Code',
				'Source Code Pro' => 'Source Code Pro',
			),
		)
	);

	$wp_customize->add_setting(
		'devengine_font_size_base',
		array(
			'default'           => 16,
			'sanitize_callback' => 'absint',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'devengine_font_size_base',
		array(
			'label'       => esc_html__( 'Base Font Size (px)', 'devengine' ),
			'section'     => 'devengine_typography',
			'type'        => 'range',
			'input_attrs' => array(
				'min'  => 14,
				'max'  => 20,
				'step' => 1,
			),
		)
	);

	// Section: Dark Mode.
	$wp_customize->add_section(
		'devengine_dark_mode',
		array(
			'title'    => esc_html__( 'Dark Mode', 'devengine' ),
			'panel'    => 'devengine_design',
			'priority' => 30,
		)
	);

	$wp_customize->add_setting(
		'devengine_dark_mode_default',
		array(
			'default'           => 'system',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'devengine_dark_mode_default',
		array(
			'label'   => esc_html__( 'Default Color Scheme', 'devengine' ),
			'section' => 'devengine_dark_mode',
			'type'    => 'select',
			'choices' => array(
				'dark'   => esc_html__( 'Dark', 'devengine' ),
				'light'  => esc_html__( 'Light', 'devengine' ),
				'system' => esc_html__( 'System', 'devengine' ),
			),
		)
	);

	$wp_customize->add_setting(
		'devengine_dark_mode_toggle',
		array(
			'default'           => true,
			'sanitize_callback' => 'rest_sanitize_boolean',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'devengine_dark_mode_toggle',
		array(
			'label'   => esc_html__( 'Show Dark Mode Toggle in Header', 'devengine' ),
			'section' => 'devengine_dark_mode',
			'type'    => 'checkbox',
		)
	);

	// Panel 2: GitHub Integration.
	$wp_customize->add_panel(
		'devengine_github_panel',
		array(
			'title'       => esc_html__( 'GitHub Integration', 'devengine' ),
			'description' => esc_html__( 'Configure GitHub API integration for repository displays.', 'devengine' ),
			'priority'    => 40,
		)
	);

	// Section: GitHub Settings.
	$wp_customize->add_section(
		'devengine_github',
		array(
			'title'    => esc_html__( 'GitHub Settings', 'devengine' ),
			'panel'    => 'devengine_github_panel',
			'priority' => 10,
		)
	);

	$wp_customize->add_setting(
		'devengine_github_username',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'devengine_github_username',
		array(
			'label'   => esc_html__( 'GitHub Username', 'devengine' ),
			'section' => 'devengine_github',
			'type'    => 'text',
		)
	);

	$wp_customize->add_setting(
		'devengine_github_token',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'devengine_github_token',
		array(
			'label'       => esc_html__( 'GitHub Personal Access Token (optional)', 'devengine' ),
			'description' => esc_html__( 'Used to increase API rate limit to 5000 req/hr. Stored in database — use a read-only token.', 'devengine' ),
			'section'     => 'devengine_github',
			'type'        => 'text',
		)
	);

	$wp_customize->add_setting(
		'devengine_github_repo_count',
		array(
			'default'           => 6,
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		'devengine_github_repo_count',
		array(
			'label'       => esc_html__( 'Number of Repos to Display', 'devengine' ),
			'section'     => 'devengine_github',
			'type'        => 'range',
			'input_attrs' => array(
				'min'  => 3,
				'max'  => 12,
				'step' => 3,
			),
		)
	);

	$wp_customize->add_setting(
		'devengine_github_show_topics',
		array(
			'default'           => true,
			'sanitize_callback' => 'rest_sanitize_boolean',
		)
	);

	$wp_customize->add_control(
		'devengine_github_show_topics',
		array(
			'label'   => esc_html__( 'Show Repository Topics as Tags', 'devengine' ),
			'section' => 'devengine_github',
			'type'    => 'checkbox',
		)
	);

	// Panel 3: Header & Navigation.
	$wp_customize->add_panel(
		'devengine_header_panel',
		array(
			'title'       => esc_html__( 'Header & Navigation', 'devengine' ),
			'description' => esc_html__( 'Customize header appearance and navigation settings.', 'devengine' ),
			'priority'    => 50,
		)
	);

	// Section: Header Settings.
	$wp_customize->add_section(
		'devengine_header',
		array(
			'title'    => esc_html__( 'Header Settings', 'devengine' ),
			'panel'    => 'devengine_header_panel',
			'priority' => 10,
		)
	);

	$wp_customize->add_setting(
		'devengine_header_sticky',
		array(
			'default'           => true,
			'sanitize_callback' => 'rest_sanitize_boolean',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'devengine_header_sticky',
		array(
			'label'   => esc_html__( 'Enable Sticky Header', 'devengine' ),
			'section' => 'devengine_header',
			'type'    => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'devengine_header_blur',
		array(
			'default'           => true,
			'sanitize_callback' => 'rest_sanitize_boolean',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'devengine_header_blur',
		array(
			'label'   => esc_html__( 'Enable Backdrop Blur on Scroll', 'devengine' ),
			'section' => 'devengine_header',
			'type'    => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'devengine_header_logo_height',
		array(
			'default'           => 40,
			'sanitize_callback' => 'absint',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'devengine_header_logo_height',
		array(
			'label'       => esc_html__( 'Logo Height (px)', 'devengine' ),
			'section'     => 'devengine_header',
			'type'        => 'range',
			'input_attrs' => array(
				'min'  => 30,
				'max'  => 80,
				'step' => 5,
			),
		)
	);

	$wp_customize->add_setting(
		'devengine_header_cta_text',
		array(
			'default'           => 'Hire Me',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'devengine_header_cta_text',
		array(
			'label'   => esc_html__( 'Header CTA Button Text', 'devengine' ),
			'section' => 'devengine_header',
			'type'    => 'text',
		)
	);

	$wp_customize->add_setting(
		'devengine_header_cta_url',
		array(
			'default'           => '#contact',
			'sanitize_callback' => 'esc_url_raw',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'devengine_header_cta_url',
		array(
			'label'   => esc_html__( 'Header CTA Button URL', 'devengine' ),
			'section' => 'devengine_header',
			'type'    => 'url',
		)
	);
}
add_action( 'customize_register', 'devengine_customizer_register' );

/**
 * Enqueue customizer preview JavaScript.
 *
 * @since 1.0.0
 */
function devengine_customizer_preview_js(): void {
	wp_enqueue_script(
		'devengine-customizer-preview',
		DEVENGINE_URI . '/assets/js/customizer-preview.js',
		array( 'customize-preview' ),
		DEVENGINE_VERSION,
		true
	);
}
add_action( 'customize_preview_init', 'devengine_customizer_preview_js' );

