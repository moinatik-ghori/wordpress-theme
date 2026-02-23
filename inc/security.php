<?php
/**
 * Security Hardening Functions
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

namespace DevEngine;

/**
 * Security hardening class.
 *
 * @since 1.0.0
 */
class Security {

	/**
	 * Initialize security measures.
	 *
	 * @since 1.0.0
	 */
	public static function init(): void {
		// HTTP Security Headers.
		add_action( 'send_headers', array( self::class, 'add_security_headers' ) );

		// WordPress Hardening.
		remove_action( 'wp_head', 'wp_generator' );

		// Remove RSD link.
		remove_action( 'wp_head', 'rsd_link' );

		// Remove wlwmanifest link.
		remove_action( 'wp_head', 'wlwmanifest_link' );

		// Remove shortlink.
		remove_action( 'wp_head', 'wp_shortlink_wp_head' );

		// Remove X-Pingback header.
		add_filter( 'wp_headers', array( self::class, 'remove_x_pingback' ) );

		// Disable XML-RPC.
		add_filter( 'xmlrpc_enabled', '__return_false' );

		// Disable user enumeration.
		add_action( 'template_redirect', array( self::class, 'prevent_user_enumeration' ) );

		// Hide login error hints.
		add_filter( 'login_errors', array( self::class, 'hide_login_errors' ) );

		// Limit post revisions.
		add_filter( 'wp_revisions_to_keep', array( self::class, 'limit_revisions' ) );

		// Disable file editing.
		if ( ! defined( 'DISALLOW_FILE_EDIT' ) ) {
			define( 'DISALLOW_FILE_EDIT', true );
		}
	}

	/**
	 * Add security headers.
	 *
	 * @since 1.0.0
	 */
	public static function add_security_headers(): void {
		if ( ! headers_sent() ) {
			header( 'X-Content-Type-Options: nosniff' );
			header( 'X-Frame-Options: SAMEORIGIN' );
			header( 'X-XSS-Protection: 1; mode=block' );
			header( 'Referrer-Policy: strict-origin-when-cross-origin' );
			header( 'Permissions-Policy: camera=(), microphone=(), geolocation=()' );

			// Content Security Policy.
			$csp = "default-src 'self'; " .
				"script-src 'self' 'unsafe-inline'; " .
				"style-src 'self' 'unsafe-inline' fonts.googleapis.com; " .
				"font-src 'self' fonts.gstatic.com; " .
				"img-src 'self' data: avatars.githubusercontent.com api.github.com";

			header( "Content-Security-Policy: {$csp}" );
		}
	}

	/**
	 * Remove X-Pingback header.
	 *
	 * @since 1.0.0
	 *
	 * @param array $headers Headers array.
	 * @return array Modified headers array.
	 */
	public static function remove_x_pingback( array $headers ): array {
		unset( $headers['X-Pingback'] );
		return $headers;
	}

	/**
	 * Prevent user enumeration.
	 *
	 * @since 1.0.0
	 */
	public static function prevent_user_enumeration(): void {
		if ( is_admin() ) {
			return;
		}

		if ( isset( $_GET['author'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
			wp_safe_redirect( home_url(), 301 );
			wp_die();
		}
	}

	/**
	 * Hide login error hints.
	 *
	 * @since 1.0.0
	 *
	 * @param string $error Error message.
	 * @return string Generic error message.
	 */
	public static function hide_login_errors( string $error ): string {
		return esc_html__( 'Invalid credentials.', 'devengine' );
	}

	/**
	 * Limit post revisions.
	 *
	 * @since 1.0.0
	 *
	 * @param int $num Number of revisions to keep.
	 * @return int Limited number of revisions.
	 */
	public static function limit_revisions( int $num ): int {
		return 5;
	}

	/**
	 * Verify AJAX nonce.
	 *
	 * @since 1.0.0
	 *
	 * @param string $action Action name.
	 * @return bool True if nonce is valid, false otherwise.
	 */
	public static function verify_nonce( string $action ): bool {
		return (bool) check_ajax_referer( $action, 'nonce', false );
	}
}

// Initialize security measures.
add_action( 'after_setup_theme', array( Security::class, 'init' ) );

