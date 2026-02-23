<?php
/**
 * Breadcrumb Navigation Functions
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
 * Generate breadcrumb navigation.
 *
 * @since 1.0.0
 *
 * @return string Breadcrumb HTML.
 */
function devengine_breadcrumbs(): string {
	// Start breadcrumb output.
	$breadcrumbs = '<nav aria-label="' . esc_attr__( 'Breadcrumb', 'devengine' ) . '" class="breadcrumbs" itemscope itemtype="https://schema.org/BreadcrumbList">';

	$position = 1;

	// Always start with Home.
	$breadcrumbs .= '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
	$breadcrumbs .= '<a itemprop="item" href="' . esc_url( home_url() ) . '">';
	$breadcrumbs .= '<span itemprop="name">' . esc_html__( 'Home', 'devengine' ) . '</span></a>';
	$breadcrumbs .= '<meta itemprop="position" content="' . esc_attr( $position ) . '" />';
	$breadcrumbs .= '</span>';
	++$position;

	// Front page - return early.
	if ( is_front_page() ) {
		$breadcrumbs .= '</nav>';
		/**
		 * Filter breadcrumb output.
		 *
		 * @since 1.0.0
		 *
		 * @param string $breadcrumbs Breadcrumb HTML.
		 */
		return apply_filters( 'devengine_breadcrumbs_output', $breadcrumbs );
	}

	// Blog page.
	if ( is_home() ) {
		$breadcrumbs .= '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
		$breadcrumbs .= '<span itemprop="item"><span itemprop="name">' . esc_html__( 'Blog', 'devengine' ) . '</span></span>';
		$breadcrumbs .= '<meta itemprop="position" content="' . esc_attr( $position ) . '" />';
		$breadcrumbs .= '</span>';
	}

	// Single post.
	if ( is_single() ) {
		$post_type = get_post_type();

		if ( 'devengine_project' === $post_type ) {
			$archive_link = get_post_type_archive_link( 'devengine_project' );
			if ( $archive_link ) {
				$breadcrumbs .= '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
				$breadcrumbs .= '<a itemprop="item" href="' . esc_url( $archive_link ) . '">';
				$breadcrumbs .= '<span itemprop="name">' . esc_html__( 'Projects', 'devengine' ) . '</span></a>';
				$breadcrumbs .= '<meta itemprop="position" content="' . esc_attr( $position ) . '" />';
				$breadcrumbs .= '</span>';
				++$position;
			}
		} elseif ( 'devengine_snippet' === $post_type ) {
			$archive_link = get_post_type_archive_link( 'devengine_snippet' );
			if ( $archive_link ) {
				$breadcrumbs .= '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
				$breadcrumbs .= '<a itemprop="item" href="' . esc_url( $archive_link ) . '">';
				$breadcrumbs .= '<span itemprop="name">' . esc_html__( 'Snippets', 'devengine' ) . '</span></a>';
				$breadcrumbs .= '<meta itemprop="position" content="' . esc_attr( $position ) . '" />';
				$breadcrumbs .= '</span>';
				++$position;
			}
		} elseif ( 'post' === $post_type ) {
			$categories = get_the_category();
			if ( ! empty( $categories ) ) {
				$category = $categories[0];
				$breadcrumbs .= '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
				$breadcrumbs .= '<a itemprop="item" href="' . esc_url( get_category_link( $category->term_id ) ) . '">';
				$breadcrumbs .= '<span itemprop="name">' . esc_html( $category->name ) . '</span></a>';
				$breadcrumbs .= '<meta itemprop="position" content="' . esc_attr( $position ) . '" />';
				$breadcrumbs .= '</span>';
				++$position;
			}
		}

		// Current post title.
		$breadcrumbs .= '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
		$breadcrumbs .= '<span itemprop="item"><span itemprop="name">' . esc_html( get_the_title() ) . '</span></span>';
		$breadcrumbs .= '<meta itemprop="position" content="' . esc_attr( $position ) . '" />';
		$breadcrumbs .= '</span>';
	}

	// Page.
	if ( is_page() ) {
		$post = get_post();
		if ( $post && $post->post_parent ) {
			$ancestors = get_post_ancestors( $post->ID );
			$ancestors = array_reverse( $ancestors );

			foreach ( $ancestors as $ancestor_id ) {
				$breadcrumbs .= '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
				$breadcrumbs .= '<a itemprop="item" href="' . esc_url( get_permalink( $ancestor_id ) ) . '">';
				$breadcrumbs .= '<span itemprop="name">' . esc_html( get_the_title( $ancestor_id ) ) . '</span></a>';
				$breadcrumbs .= '<meta itemprop="position" content="' . esc_attr( $position ) . '" />';
				$breadcrumbs .= '</span>';
				++$position;
			}
		}

		// Current page title.
		$breadcrumbs .= '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
		$breadcrumbs .= '<span itemprop="item"><span itemprop="name">' . esc_html( get_the_title() ) . '</span></span>';
		$breadcrumbs .= '<meta itemprop="position" content="' . esc_attr( $position ) . '" />';
		$breadcrumbs .= '</span>';
	}

	// Category.
	if ( is_category() ) {
		$category = get_queried_object();
		$breadcrumbs .= '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
		$breadcrumbs .= '<span itemprop="item"><span itemprop="name">' . esc_html__( 'Category', 'devengine' ) . ': ' . esc_html( $category->name ) . '</span></span>';
		$breadcrumbs .= '<meta itemprop="position" content="' . esc_attr( $position ) . '" />';
		$breadcrumbs .= '</span>';
	}

	// Tag.
	if ( is_tag() ) {
		$tag = get_queried_object();
		$breadcrumbs .= '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
		$breadcrumbs .= '<span itemprop="item"><span itemprop="name">' . esc_html__( 'Tag', 'devengine' ) . ': ' . esc_html( $tag->name ) . '</span></span>';
		$breadcrumbs .= '<meta itemprop="position" content="' . esc_attr( $position ) . '" />';
		$breadcrumbs .= '</span>';
	}

	// Taxonomy.
	if ( is_tax() ) {
		$term = get_queried_object();
		$taxonomy = get_taxonomy( $term->taxonomy );
		$taxonomy_label = $taxonomy ? $taxonomy->labels->singular_name : esc_html__( 'Term', 'devengine' );

		$breadcrumbs .= '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
		$breadcrumbs .= '<span itemprop="item"><span itemprop="name">' . esc_html( $taxonomy_label ) . ': ' . esc_html( $term->name ) . '</span></span>';
		$breadcrumbs .= '<meta itemprop="position" content="' . esc_attr( $position ) . '" />';
		$breadcrumbs .= '</span>';
	}

	// Archive.
	if ( is_archive() ) {
		if ( is_post_type_archive() ) {
			$post_type = get_queried_object();
			$breadcrumbs .= '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
			$breadcrumbs .= '<span itemprop="item"><span itemprop="name">' . esc_html( post_type_archive_title( '', false ) ) . '</span></span>';
			$breadcrumbs .= '<meta itemprop="position" content="' . esc_attr( $position ) . '" />';
			$breadcrumbs .= '</span>';
		} elseif ( is_date() ) {
			$year = get_the_date( 'Y' );
			$breadcrumbs .= '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
			$breadcrumbs .= '<span itemprop="item"><span itemprop="name">' . esc_html( $year ) . '</span></span>';
			$breadcrumbs .= '<meta itemprop="position" content="' . esc_attr( $position ) . '" />';
			$breadcrumbs .= '</span>';
			++$position;

			if ( is_month() ) {
				$month = get_the_date( 'F' );
				$breadcrumbs .= '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
				$breadcrumbs .= '<span itemprop="item"><span itemprop="name">' . esc_html( $month ) . '</span></span>';
				$breadcrumbs .= '<meta itemprop="position" content="' . esc_attr( $position ) . '" />';
				$breadcrumbs .= '</span>';
				++$position;
			}

			if ( is_day() ) {
				$day = get_the_date( 'j' );
				$breadcrumbs .= '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
				$breadcrumbs .= '<span itemprop="item"><span itemprop="name">' . esc_html( $day ) . '</span></span>';
				$breadcrumbs .= '<meta itemprop="position" content="' . esc_attr( $position ) . '" />';
				$breadcrumbs .= '</span>';
			}
		} elseif ( is_author() ) {
			$author = get_queried_object();
			$breadcrumbs .= '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
			$breadcrumbs .= '<span itemprop="item"><span itemprop="name">' . esc_html__( 'Author', 'devengine' ) . ': ' . esc_html( $author->display_name ) . '</span></span>';
			$breadcrumbs .= '<meta itemprop="position" content="' . esc_attr( $position ) . '" />';
			$breadcrumbs .= '</span>';
		}
	}

	// Search.
	if ( is_search() ) {
		$breadcrumbs .= '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
		$breadcrumbs .= '<span itemprop="item"><span itemprop="name">' . esc_html__( 'Search Results for:', 'devengine' ) . ' ' . esc_html( get_search_query() ) . '</span></span>';
		$breadcrumbs .= '<meta itemprop="position" content="' . esc_attr( $position ) . '" />';
		$breadcrumbs .= '</span>';
	}

	// 404.
	if ( is_404() ) {
		$breadcrumbs .= '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
		$breadcrumbs .= '<span itemprop="item"><span itemprop="name">' . esc_html__( '404 — Page Not Found', 'devengine' ) . '</span></span>';
		$breadcrumbs .= '<meta itemprop="position" content="' . esc_attr( $position ) . '" />';
		$breadcrumbs .= '</span>';
	}

	$breadcrumbs .= '</nav>';

	/**
	 * Filter breadcrumb output.
	 *
	 * @since 1.0.0
	 *
	 * @param string $breadcrumbs Breadcrumb HTML.
	 */
	return apply_filters( 'devengine_breadcrumbs_output', $breadcrumbs );
}

