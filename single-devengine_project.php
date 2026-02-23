<?php
/**
 * Single Project Template
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

get_header();

// Retrieve project meta.
$project_url = esc_url( get_post_meta( get_the_ID(), '_project_url', true ) );
$project_github_url = esc_url( get_post_meta( get_the_ID(), '_project_github_url', true ) );
$project_tech_stack_raw = get_post_meta( get_the_ID(), '_project_tech_stack', true );
$project_status = esc_html( get_post_meta( get_the_ID(), '_project_status', true ) );

// Parse tech stack.
$project_tech_stack = array();
if ( ! empty( $project_tech_stack_raw ) ) {
	$decoded = json_decode( $project_tech_stack_raw, true );
	if ( is_array( $decoded ) ) {
		$project_tech_stack = $decoded;
	}
}

// Allowed technologies for sanitization.
$allowed_technologies = array(
	'JavaScript',
	'TypeScript',
	'PHP',
	'Python',
	'Rust',
	'Go',
	'React',
	'Vue',
	'Node.js',
	'Docker',
	'Kubernetes',
	'AWS',
);
?>

<section class="project-hero" aria-labelledby="project-title" style="background-image: url(<?php echo esc_url( get_the_post_thumbnail_url( null, 'devengine-hero' ) ); ?>);">
	<div class="project-hero__overlay">
		<?php devengine_breadcrumbs(); ?>

		<h1 id="project-title"><?php the_title(); ?></h1>

		<?php if ( ! empty( $project_status ) ) : ?>
			<span class="badge badge--status badge--<?php echo esc_attr( $project_status ); ?>">
				<?php echo esc_html( ucfirst( $project_status ) ); ?>
			</span>
		<?php endif; ?>

		<?php if ( ! empty( $project_tech_stack ) ) : ?>
			<div class="project-hero__tech">
				<?php
				foreach ( $project_tech_stack as $tech ) {
					$tech = sanitize_text_field( $tech );
					if ( in_array( $tech, $allowed_technologies, true ) ) {
						$tech_slug = strtolower( str_replace( array( ' ', '.' ), array( '-', '' ), $tech ) );
						printf(
							'<span class="badge badge--tech badge--%s">%s</span> ',
							esc_attr( $tech_slug ),
							esc_html( $tech )
						);
					}
				}
				?>
			</div>
		<?php endif; ?>
	</div>
</section>

<div class="project-content-grid container">
	<div class="project-content-grid__main">
		<div class="prose">
			<?php the_content(); ?>
		</div>
	</div>

	<aside class="project-sidebar" aria-label="<?php esc_attr_e( 'Project Details', 'devengine' ); ?>">
		<?php if ( ! empty( $project_url ) || ! empty( $project_github_url ) ) : ?>
			<div class="card">
				<h3 class="card__title"><?php esc_html_e( 'Project Links', 'devengine' ); ?></h3>
				<div class="card__body">
					<?php if ( ! empty( $project_url ) ) : ?>
						<a href="<?php echo esc_url( $project_url ); ?>" class="btn btn--primary" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr( sprintf( __( 'View live demo of %s', 'devengine' ), get_the_title() ) ); ?>">
							<?php esc_html_e( 'Live Demo', 'devengine' ); ?>
						</a>
					<?php endif; ?>

					<?php if ( ! empty( $project_github_url ) ) : ?>
						<a href="<?php echo esc_url( $project_github_url ); ?>" class="btn btn--ghost" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr( sprintf( __( 'View %s on GitHub', 'devengine' ), get_the_title() ) ); ?>">
							<?php esc_html_e( 'GitHub', 'devengine' ); ?>
						</a>
					<?php endif; ?>
				</div>
			</div>
		<?php endif; ?>

		<?php if ( ! empty( $project_tech_stack ) ) : ?>
			<div class="card">
				<h3 class="card__title"><?php esc_html_e( 'Tech Stack', 'devengine' ); ?></h3>
				<div class="card__body">
					<?php
					foreach ( $project_tech_stack as $tech ) {
						$tech = sanitize_text_field( $tech );
						if ( in_array( $tech, $allowed_technologies, true ) ) {
							$tech_slug = strtolower( str_replace( array( ' ', '.' ), array( '-', '' ), $tech ) );
							printf(
								'<span class="badge badge--tech badge--%s">%s</span> ',
								esc_attr( $tech_slug ),
								esc_html( $tech )
							);
						}
					}
					?>
				</div>
			</div>
		<?php endif; ?>

		<div class="card">
			<h3 class="card__title"><?php esc_html_e( 'Project Info', 'devengine' ); ?></h3>
			<div class="card__body">
				<?php if ( ! empty( $project_status ) ) : ?>
					<p>
						<strong><?php esc_html_e( 'Status:', 'devengine' ); ?></strong>
						<?php echo esc_html( ucfirst( $project_status ) ); ?>
					</p>
				<?php endif; ?>

				<p>
					<strong><?php esc_html_e( 'Last Updated:', 'devengine' ); ?></strong>
					<?php echo esc_html( get_the_modified_date() ); ?>
				</p>
			</div>
		</div>
	</aside>
</div>

<?php
// Related projects.
$current_terms = wp_get_post_terms( get_the_ID(), 'devengine_tech', array( 'fields' => 'ids' ) );

$related_args = array(
	'post_type'      => 'devengine_project',
	'posts_per_page' => 3,
	'post__not_in'   => array( get_the_ID() ),
);

if ( ! empty( $current_terms ) ) {
	$related_args['tax_query'] = array(
		array(
			'taxonomy' => 'devengine_tech',
			'field'    => 'term_id',
			'terms'    => $current_terms,
		),
	);
}

$related_query = new WP_Query( $related_args );
?>

<?php if ( $related_query->have_posts() ) : ?>
	<section class="related-projects container" aria-labelledby="related-title">
		<h2 id="related-title"><?php esc_html_e( 'More Projects', 'devengine' ); ?></h2>
		<div class="grid grid--3col">
			<?php
			while ( $related_query->have_posts() ) :
				$related_query->the_post();
				?>
				<article class="card card--project">
					<?php if ( has_post_thumbnail() ) : ?>
						<?php the_post_thumbnail( 'devengine-card', array( 'class' => 'card__image' ) ); ?>
					<?php endif; ?>
					<div class="card__body">
						<h3 class="card__title">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h3>
						<?php the_excerpt(); ?>
					</div>
				</article>
			<?php endwhile; ?>
		</div>
	</section>
	<?php
	wp_reset_postdata();
endif;

get_footer();

