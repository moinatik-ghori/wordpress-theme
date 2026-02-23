<?php
/**
 * GitHub Repo Card Block Render
 *
 * @package DevEngine_Premium
 * @since 1.0.0
 *
 * @var array    $attributes Block attributes.
 * @var string   $content    Block content.
 * @var WP_Block $block      Block instance.
 */

declare(strict_types=1);

use DevEngine\GitHub_API;

// Sanitize attributes.
$username = isset( $attributes['username'] ) ? sanitize_text_field( $attributes['username'] ) : '';
$repo_name = isset( $attributes['repoName'] ) ? sanitize_text_field( $attributes['repoName'] ) : '';
$show_topics = isset( $attributes['showTopics'] ) ? (bool) $attributes['showTopics'] : true;
$show_stats = isset( $attributes['showStats'] ) ? (bool) $attributes['showStats'] : true;

// Get GitHub credentials from customizer.
$github_username = get_theme_mod( 'devengine_github_username', '' );
$github_token = get_theme_mod( 'devengine_github_token', '' );

// Use custom username if provided, otherwise fall back to customizer setting.
$api_username = ! empty( $username ) ? $username : $github_username;

if ( empty( $api_username ) || empty( $repo_name ) ) {
	?>
	<div <?php echo get_block_wrapper_attributes(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
		<div class="card card--repo card--error">
			<p><?php esc_html_e( 'GitHub username and repository name are required.', 'devengine' ); ?></p>
		</div>
	</div>
	<?php
	return;
}

// Instantiate GitHub API.
$api = new GitHub_API( $api_username, $github_token );
$repo = $api->get_single_repo( $repo_name );

// Handle API errors.
if ( is_wp_error( $repo ) ) {
	?>
	<div <?php echo get_block_wrapper_attributes(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
		<div class="card card--repo card--error">
			<p><?php echo esc_html( $repo->get_error_message() ); ?></p>
		</div>
	</div>
	<?php
	return;
}

// Ensure we have valid repo data.
if ( empty( $repo ) || ! isset( $repo['name'] ) ) {
	?>
	<div <?php echo get_block_wrapper_attributes(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
		<div class="card card--repo card--error">
			<p><?php esc_html_e( 'Repository not found.', 'devengine' ); ?></p>
		</div>
	</div>
	<?php
	return;
}

// Format updated date.
$updated_at = isset( $repo['updated_at'] ) ? $repo['updated_at'] : '';
$formatted_date = '';
if ( ! empty( $updated_at ) ) {
	$formatted_date = wp_date( get_option( 'date_format' ), strtotime( $updated_at ) );
}

// Get language slug for badge class.
$language = isset( $repo['language'] ) ? strtolower( $repo['language'] ) : '';
$language_class = ! empty( $language ) ? 'badge--' . esc_attr( sanitize_html_class( $language ) ) : '';

?>
<div <?php echo get_block_wrapper_attributes(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<article class="card card--repo">
		<header class="card__header">
			<h3 class="card__title">
				<a href="<?php echo esc_url( $repo['html_url'] ); ?>" target="_blank" rel="noopener noreferrer">
					<?php echo esc_html( $repo['name'] ); ?>
				</a>
			</h3>
			<?php if ( ! empty( $repo['language'] ) ) : ?>
				<span class="badge badge--tech <?php echo esc_attr( $language_class ); ?>">
					<?php echo esc_html( $repo['language'] ); ?>
				</span>
			<?php endif; ?>
			<?php if ( isset( $repo['visibility'] ) && 'public' !== $repo['visibility'] ) : ?>
				<span class="badge badge--visibility">
					<?php echo esc_html( ucfirst( $repo['visibility'] ) ); ?>
				</span>
			<?php endif; ?>
		</header>

		<div class="card__body">
			<?php if ( ! empty( $repo['description'] ) ) : ?>
				<p class="card__description">
					<?php echo esc_html( $repo['description'] ); ?>
				</p>
			<?php endif; ?>

			<?php if ( $show_topics && ! empty( $repo['topics'] ) && is_array( $repo['topics'] ) ) : ?>
				<div class="repo-topics">
					<?php foreach ( $repo['topics'] as $topic ) : ?>
						<span class="badge badge--tech">
							<?php echo esc_html( $topic ); ?>
						</span>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>

			<?php if ( ! empty( $formatted_date ) ) : ?>
				<p class="card__meta">
					<?php
					printf(
						/* translators: %s: Formatted date */
						esc_html__( 'Updated: %s', 'devengine' ),
						esc_html( $formatted_date )
					);
					?>
				</p>
			<?php endif; ?>
		</div>

		<?php if ( $show_stats ) : ?>
			<footer class="card__footer">
				<div class="repo-stats">
					<span class="stat-item">
						⭐ <?php echo esc_html( $repo['stargazers_count'] ?? 0 ); ?>
					</span>
					<span class="stat-item">
						🍴 <?php echo esc_html( $repo['forks_count'] ?? 0 ); ?>
					</span>
				</div>
				<a href="<?php echo esc_url( $repo['html_url'] ); ?>" target="_blank" rel="noopener noreferrer" class="btn btn--primary">
					<?php esc_html_e( 'View on GitHub', 'devengine' ); ?>
				</a>
			</footer>
		<?php endif; ?>
	</article>
</div>

