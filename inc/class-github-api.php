<?php
/**
 * GitHub API Integration Class
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
 * GitHub API client class.
 *
 * @since 1.0.0
 */
class GitHub_API {

	/**
	 * GitHub username.
	 *
	 * @since 1.0.0
	 * @var string
	 */
	private readonly string $username;

	/**
	 * GitHub personal access token.
	 *
	 * @since 1.0.0
	 * @var string
	 */
	private readonly string $token;

	/**
	 * Base API URL.
	 *
	 * @since 1.0.0
	 * @var string
	 */
	private string $base_url = 'https://api.github.com';

	/**
	 * Cache expiry time in seconds.
	 *
	 * @since 1.0.0
	 * @var int
	 */
	private int $cache_expiry = 0;

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 *
	 * @param string $username GitHub username.
	 * @param string $token     Optional. GitHub personal access token.
	 */
	public function __construct( string $username, string $token = '' ) {
		$this->username    = $username;
		$this->token       = $token;
		$this->cache_expiry = 12 * HOUR_IN_SECONDS;
	}

	/**
	 * Build request headers.
	 *
	 * @since 1.0.0
	 *
	 * @return array Headers array.
	 */
	private function build_headers(): array {
		$headers = array(
			'User-Agent' => 'DevEngine-Theme/1.0.0',
			'Accept'     => 'application/vnd.github.v3+json',
		);

		if ( ! empty( $this->token ) ) {
			$headers['Authorization'] = 'Bearer ' . $this->token;
		}

		return $headers;
	}

	/**
	 * Make API request.
	 *
	 * @since 1.0.0
	 *
	 * @param string $endpoint API endpoint.
	 * @return array|WP_Error Response data or error.
	 */
	private function make_request( string $endpoint ): array|WP_Error {
		$url = $this->base_url . $endpoint;

		$response = wp_remote_get(
			$url,
			array(
				'timeout' => 15,
				'headers' => $this->build_headers(),
			)
		);

		if ( is_wp_error( $response ) ) {
			return $response;
		}

		$response_code = wp_remote_retrieve_response_code( $response );

		if ( 200 !== $response_code ) {
			return new \WP_Error(
				'github_api_error',
				sprintf(
					/* translators: %d: HTTP status code */
					esc_html__( 'GitHub API error: HTTP %d', 'devengine' ),
					$response_code
				)
			);
		}

		$body = wp_remote_retrieve_body( $response );
		$data = json_decode( $body, true );

		if ( ! is_array( $data ) ) {
			return array();
		}

		return $data;
	}

	/**
	 * Get user repositories.
	 *
	 * @since 1.0.0
	 *
	 * @param int $per_page Number of repos per page.
	 * @return array|WP_Error Repositories array or error.
	 */
	public function get_repos( int $per_page = 6 ): array|WP_Error {
		$transient_key = "devengine_gh_repos_{$this->username}_{$per_page}";
		$cached        = get_transient( $transient_key );

		if ( false !== $cached ) {
			return $cached;
		}

		$response = $this->make_request(
			"/users/{$this->username}/repos?sort=updated&per_page={$per_page}"
		);

		if ( is_wp_error( $response ) ) {
			return $response;
		}

		$repos = array();

		foreach ( $response as $repo ) {
			$repos[] = array(
				'id'              => $repo['id'] ?? 0,
				'name'            => $repo['name'] ?? '',
				'full_name'       => $repo['full_name'] ?? '',
				'description'     => $repo['description'] ?? '',
				'html_url'        => $repo['html_url'] ?? '',
				'homepage'        => $repo['homepage'] ?? '',
				'language'        => $repo['language'] ?? '',
				'stargazers_count' => $repo['stargazers_count'] ?? 0,
				'forks_count'     => $repo['forks_count'] ?? 0,
				'topics'          => $repo['topics'] ?? array(),
				'updated_at'      => $repo['updated_at'] ?? '',
				'visibility'      => $repo['visibility'] ?? 'public',
			);
		}

		set_transient( $transient_key, $repos, $this->cache_expiry );

		return $repos;
	}

	/**
	 * Get single repository.
	 *
	 * @since 1.0.0
	 *
	 * @param string $repo Repository name.
	 * @return array|WP_Error Repository data or error.
	 */
	public function get_single_repo( string $repo ): array|WP_Error {
		$transient_key = "devengine_gh_repo_{$this->username}_{$repo}";
		$cached        = get_transient( $transient_key );

		if ( false !== $cached ) {
			return $cached;
		}

		$response = $this->make_request( "/repos/{$this->username}/{$repo}" );

		if ( is_wp_error( $response ) ) {
			return $response;
		}

		$repo_data = array(
			'id'                => $response['id'] ?? 0,
			'name'              => $response['name'] ?? '',
			'full_name'         => $response['full_name'] ?? '',
			'description'       => $response['description'] ?? '',
			'html_url'          => $response['html_url'] ?? '',
			'homepage'          => $response['homepage'] ?? '',
			'language'          => $response['language'] ?? '',
			'stargazers_count'  => $response['stargazers_count'] ?? 0,
			'forks_count'       => $response['forks_count'] ?? 0,
			'topics'            => $response['topics'] ?? array(),
			'updated_at'        => $response['updated_at'] ?? '',
			'visibility'        => $response['visibility'] ?? 'public',
			'open_issues_count' => $response['open_issues_count'] ?? 0,
			'default_branch'    => $response['default_branch'] ?? 'main',
			'license'           => $response['license']['name'] ?? '',
		);

		set_transient( $transient_key, $repo_data, $this->cache_expiry );

		return $repo_data;
	}

	/**
	 * Get pinned topics from repositories.
	 *
	 * @since 1.0.0
	 *
	 * @param array $repos Repositories array.
	 * @return array Unique sorted topics array.
	 */
	public function get_pinned_topics( array $repos ): array {
		$topics = array();

		foreach ( $repos as $repo ) {
			if ( isset( $repo['topics'] ) && is_array( $repo['topics'] ) ) {
				$topics = array_merge( $topics, $repo['topics'] );
			}
		}

		$topics = array_unique( $topics );
		sort( $topics );

		return $topics;
	}

	/**
	 * Flush cache for a username.
	 *
	 * @since 1.0.0
	 *
	 * @param string $username GitHub username.
	 */
	public static function flush_cache( string $username ): void {
		global $wpdb;

		$patterns = array(
			"%_transient_devengine_gh_repos_{$username}_%",
			"%_transient_timeout_devengine_gh_repos_{$username}_%",
			"%_transient_devengine_gh_repo_{$username}_%",
			"%_transient_timeout_devengine_gh_repo_{$username}_%",
		);

		foreach ( $patterns as $pattern ) {
			// phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching
			$wpdb->query(
				$wpdb->prepare(
					"DELETE FROM {$wpdb->options} WHERE option_name LIKE %s",
					$pattern
				)
			);
		}
	}
}

/**
 * Register REST API endpoint for GitHub repos.
 *
 * @since 1.0.0
 */
function devengine_register_github_rest_endpoint(): void {
	register_rest_route(
		'devengine/v1',
		'/github/repos',
		array(
			'methods'             => 'GET',
			'callback'            => function( \WP_REST_Request $request ) {
				$username = get_theme_mod( 'devengine_github_username', '' );
				$token    = get_theme_mod( 'devengine_github_token', '' );

				if ( empty( $username ) ) {
					return new \WP_Error(
						'no_username',
						esc_html__( 'GitHub username not configured.', 'devengine' ),
						array( 'status' => 400 )
					);
				}

				$per_page = absint( $request->get_param( 'per_page' ) ) ?: 6;
				$api      = new GitHub_API( $username, $token );
				$repos    = $api->get_repos( $per_page );

				if ( is_wp_error( $repos ) ) {
					return $repos;
				}

				$response = new \WP_REST_Response( $repos );
				$response->header( 'Cache-Control', 'public, max-age=43200' );

				return $response;
			},
			'permission_callback' => '__return_true',
		)
	);
}
add_action( 'rest_api_init', __NAMESPACE__ . '\\devengine_register_github_rest_endpoint' );

/**
 * Flush GitHub cache when project is saved.
 *
 * @since 1.0.0
 *
 * @param int $post_id Post ID.
 */
function devengine_flush_github_cache_on_save( int $post_id ): void {
	$post_type = get_post_type( $post_id );

	if ( 'devengine_project' === $post_type ) {
		$username = get_theme_mod( 'devengine_github_username', '' );
		if ( ! empty( $username ) ) {
			GitHub_API::flush_cache( $username );
		}
	}
}
add_action( 'save_post_devengine_project', __NAMESPACE__ . '\\devengine_flush_github_cache_on_save' );

