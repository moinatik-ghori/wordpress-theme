<?php
/**
 * Page Template
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

<?php
while ( have_posts() ) :
	the_post();
	?>
	<article <?php post_class( 'page-content container' ); ?>>
		<?php devengine_breadcrumbs(); ?>

		<?php the_title( '<h1 class="page-content__title">', '</h1>' ); ?>

		<?php if ( has_post_thumbnail() ) : ?>
			<figure class="page-content__hero">
				<?php the_post_thumbnail( 'devengine-hero' ); ?>
			</figure>
		<?php endif; ?>

		<div class="prose">
			<?php
			the_content();

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'devengine' ),
					'after'  => '</div>',
				)
			);
			?>
		</div>
	</article>
	<?php
	// Note: comments_template() can be added here if page comments are enabled.
endwhile;
?>

<?php
get_footer();

