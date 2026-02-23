<?php
/**
 * Archive Template
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

/**
 * Filter archive title to remove default prefixes.
 *
 * @param string $title Archive title.
 * @return string Filtered title.
 */
function devengine_archive_title_filter( $title ) {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_author() ) {
		$title = '<span class="vcard">' . get_the_author() . '</span>';
	} elseif ( is_post_type_archive() ) {
		$title = post_type_archive_title( '', false );
	} elseif ( is_tax() ) {
		$title = single_term_title( '', false );
	}
	return $title;
}
add_filter( 'get_the_archive_title', 'devengine_archive_title_filter' );
?>

<header class="archive-header container">
	<?php
	the_archive_title( '<h1 class="archive-title">', '</h1>' );
	the_archive_description( '<div class="archive-description">', '</div>' );
	?>
</header>

<?php
$post_type = get_query_var( 'post_type' );
$grid_class = 'grid--2col';

if ( 'devengine_project' === $post_type ) {
	$grid_class = 'grid--bento';
} elseif ( 'devengine_snippet' === $post_type ) {
	$grid_class = 'grid--2col';
}
?>

<div class="container archive-layout">
	<div class="grid <?php echo esc_attr( $grid_class ); ?>">
		<?php if ( have_posts() ) : ?>
			<?php
			while ( have_posts() ) :
				the_post();

				if ( 'devengine_project' === $post_type ) {
					get_template_part( 'parts/content', 'devengine_project' );
				} elseif ( 'devengine_snippet' === $post_type ) {
					get_template_part( 'parts/content', 'devengine_snippet' );
				} else {
					get_template_part( 'parts/content', 'post' );
				}
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
	</div>
</div>

<?php
get_footer();

