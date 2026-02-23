<?php
/**
 * Custom Navigation Walker
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
 * Custom navigation walker for dropdown menus.
 *
 * @since 1.0.0
 */
class Nav_Walker extends \Walker_Nav_Menu {

	/**
	 * Depth offset for indentation.
	 *
	 * @since 1.0.0
	 * @var int
	 */
	private int $depth_offset = 0;

	/**
	 * Whether current item has children.
	 *
	 * @since 1.0.0
	 * @var bool
	 */
	private bool $has_children = false;

	/**
	 * Start the list before the elements are added.
	 *
	 * The hidden attribute is toggled by mobile-menu.js for accessibility.
	 *
	 * @since 1.0.0
	 *
	 * @param string   $output Used to append additional content.
	 * @param int      $depth  Depth of menu item.
	 * @param stdClass $args   An object of wp_nav_menu() arguments.
	 */
	public function start_lvl( &$output, $depth = 0, $args = null ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "\n$indent<div class=\"nav__dropdown\" role=\"region\" aria-label=\"" . esc_attr__( 'Submenu', 'devengine' ) . "\" hidden><ul class=\"nav__dropdown-list\">\n";
	}

	/**
	 * End the list of after the elements are added.
	 *
	 * @since 1.0.0
	 *
	 * @param string   $output Used to append additional content.
	 * @param int      $depth  Depth of menu item.
	 * @param stdClass $args   An object of wp_nav_menu() arguments.
	 */
	public function end_lvl( &$output, $depth = 0, $args = null ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "$indent</ul></div>\n";
	}

	/**
	 * Start the element output.
	 *
	 * @since 1.0.0
	 *
	 * @param string   $output Used to append additional content.
	 * @param WP_Post  $item   Menu item data object.
	 * @param int      $depth  Depth of menu item.
	 * @param stdClass $args   An object of wp_nav_menu() arguments.
	 * @param int      $id     Current item ID.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		$indent = ( $depth ) ? str_repeat( $t, $depth ) : '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'nav__item menu-item-' . $item->ID;

		// Check if item has children.
		$this->has_children = in_array( 'menu-item-has-children', $classes, true );

		// Check if current item or ancestor.
		$is_current = in_array( 'current-menu-item', $classes, true );
		$is_ancestor = in_array( 'current-menu-ancestor', $classes, true );

		if ( $is_current ) {
			$classes[] = 'nav__item--current';
		}
		if ( $is_ancestor ) {
			$classes[] = 'nav__item--ancestor';
		}

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		// Add data-has-dropdown if item has children.
		$data_attr = $this->has_children ? ' data-has-dropdown' : '';

		$output .= $indent . '<li' . $id . $class_names . $data_attr . '>';

		$attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';

		// Handle rel attribute: combine xfn with security attributes if needed.
		$rel_parts = array();
		if ( ! empty( $item->xfn ) ) {
			$rel_parts[] = $item->xfn;
		}
		if ( '_blank' === $item->target ) {
			$rel_parts[] = 'noopener';
			$rel_parts[] = 'noreferrer';
		}
		if ( ! empty( $rel_parts ) ) {
			$attributes .= ' rel="' . esc_attr( implode( ' ', $rel_parts ) ) . '"';
		}

		$attributes .= ! empty( $item->url ) ? ' href="' . esc_url( $item->url ) . '"' : '';

		// Add ARIA attributes for dropdowns.
		if ( $this->has_children ) {
			$attributes .= ' aria-haspopup="true" aria-expanded="false"';
		}

		// Add aria-current for current item.
		if ( $is_current ) {
			$attributes .= ' aria-current="page"';
		}

		$item_output = isset( $args->before ) ? $args->before : '';
		$item_output .= '<a class="nav__link' . ( $is_current ? ' nav__link--active' : '' ) . ( $is_ancestor ? ' nav__link--parent-active' : '' ) . '"' . $attributes . '>';

		$item_output .= ( isset( $args->link_before ) ? $args->link_before : '' ) . apply_filters( 'the_title', $item->title, $item->ID ) . ( isset( $args->link_after ) ? $args->link_after : '' );

		// Add chevron for dropdown items.
		if ( $this->has_children ) {
			$item_output .= self::render_chevron_svg();
		}

		$item_output .= '</a>';

		// Add description if available.
		if ( ! empty( $item->description ) ) {
			$item_output .= '<span class="nav__item-description">' . esc_html( $item->description ) . '</span>';
		}

		$item_output .= isset( $args->after ) ? $args->after : '';

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	/**
	 * End the element output.
	 *
	 * @since 1.0.0
	 *
	 * @param string   $output Used to append additional content.
	 * @param WP_Post  $item   Page data object.
	 * @param int      $depth  Depth of page.
	 * @param stdClass $args   An object of wp_nav_menu() arguments.
	 */
	public function end_el( &$output, $item, $depth = 0, $args = null ) {
		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		$output .= "</li>{$n}";
	}

	/**
	 * Render chevron SVG for dropdown indicators.
	 *
	 * @since 1.0.0
	 *
	 * @return string SVG markup.
	 */
	public static function render_chevron_svg(): string {
		return '<svg class="nav__chevron" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true" focusable="false"><path d="M6 9l6 6 6-6"/></svg>';
	}
}
