<?php
/**
 * Search Results Template
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

<section class="search-results container" aria-labelledby="search-title">
	<header class="search-results__header">
		<h1 id="search-title">
			<?php
			printf(
				/* translators: %s: Search query */
				esc_html__( 'Search Results for: %s', 'devengine' ),
				'<span class="search-results__term">' . esc_html( get_search_query() ) . '</span>'
			);
			?>
		</h1>

		<?php
		$found_posts = $GLOBALS['wp_query']->found_posts;
		?>
		<p class="search-results__count">
			<?php
			printf(
				/* translators: %d: Number of results */
				esc_html(
					_n(
						'%d result found',
						'%d results found',
						$found_posts,
						'devengine'
					)
				),
				esc_html( $found_posts )
			);
			?>
		</p>

		<?php get_search_form(); ?>
	</header>

	<?php if ( have_posts() ) : ?>
		<?php
		$current_type = '';
		while ( have_posts() ) :
			the_post();

			$post_type = get_post_type();
			if ( $post_type !== $current_type ) {
				$current_type = $post_type;
				$type_label = get_post_type_object( $post_type )->labels->name;
				?>
				<h2 class="search-results__type-heading"><?php echo esc_html( $type_label ); ?></h2>
				<?php
			}

			get_template_part( 'parts/content', 'search' );
		endwhile;
		?>

		<?php
		the_posts_pagination(
			array(
				'mid_size'  => 2,
				'prev_text' => '<span class="screen-reader-text">' . esc_html__( 'Previous page', 'devengine' ) . '</span><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 18l-6-6 6-6"/></svg>',
				'next_text' => '<span class="screen-reader-text">' . esc_html__( 'Next page', 'devengine' ) . '</span><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg>',
			)
		);
		?>
	<?php else : ?>
		<?php get_template_part( 'parts/content', 'none' ); ?>
	<?php endif; ?>
</section>

<?php
get_footer();

