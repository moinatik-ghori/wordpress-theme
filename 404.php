<?php
/**
 * 404 Error Template
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
?>

<section class="error-404 container" aria-labelledby="error-title">
	<span aria-hidden="true" class="error-404__code">404</span>

	<h1 id="error-title" class="error-404__title"><?php esc_html_e( 'Page Not Found', 'devengine' ); ?></h1>

	<p class="error-404__message">
		<?php esc_html_e( 'The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'devengine' ); ?>
	</p>

	<?php get_search_form(); ?>

	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--primary">
		<?php esc_html_e( 'Return Home', 'devengine' ); ?>
	</a>

	<div class="error-404__suggestions">
		<div class="error-404__suggestions-column">
			<h2><?php esc_html_e( 'Recent Posts', 'devengine' ); ?></h2>
			<ul>
				<?php
				$recent_posts = new WP_Query(
					array(
						'post_type'      => 'post',
						'posts_per_page' => 3,
					)
				);

				if ( $recent_posts->have_posts() ) :
					while ( $recent_posts->have_posts() ) :
						$recent_posts->the_post();
						?>
						<li>
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</li>
						<?php
					endwhile;
					wp_reset_postdata();
				endif;
				?>
			</ul>
		</div>

		<div class="error-404__suggestions-column">
			<h2><?php esc_html_e( 'Recent Projects', 'devengine' ); ?></h2>
			<ul>
				<?php
				$recent_projects = new WP_Query(
					array(
						'post_type'      => 'devengine_project',
						'posts_per_page' => 3,
					)
				);

				if ( $recent_projects->have_posts() ) :
					while ( $recent_projects->have_posts() ) :
						$recent_projects->the_post();
						?>
						<li>
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</li>
						<?php
					endwhile;
					wp_reset_postdata();
				endif;
				?>
			</ul>
		</div>
	</div>
</section>

<?php
get_footer();

