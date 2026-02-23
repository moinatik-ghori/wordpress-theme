<?php
/**
 * Footer Template
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
?>
</main>

<footer class="site-footer" role="contentinfo">
	<?php if ( is_active_sidebar( 'devengine-footer' ) ) : ?>
		<div class="site-footer__widgets container">
			<div class="grid grid--3col">
				<?php dynamic_sidebar( 'devengine-footer' ); ?>
			</div>
		</div>
	<?php endif; ?>

	<nav class="site-footer__nav" aria-label="<?php esc_attr_e( 'Footer Navigation', 'devengine' ); ?>">
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'footer',
				'menu_class'     => 'nav__list nav__list--footer',
				'container'      => false,
				'depth'          => 1,
				'fallback_cb'    => false,
			)
		);
		?>
	</nav>

	<div class="site-footer__bar container">
		<p class="site-footer__copy">
			© <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>.
			<?php esc_html_e( 'Built with DevEngine Premium.', 'devengine' ); ?>
		</p>

		<button class="btn btn--icon site-footer__back-to-top" aria-label="<?php esc_attr_e( 'Back to top', 'devengine' ); ?>" onclick="window.scrollTo({top:0,behavior:'smooth'})">
			<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
				<path d="M18 15l-6-6-6 6"/>
			</svg>
		</button>
	</div>
</footer>

<?php
/*
 * Theme credit with GPL attribution:
 * DevEngine Premium WordPress Theme, (C) 2024 DevEngine
 * DevEngine Premium is distributed under the terms of the GNU GPL
 */
wp_footer();
?>
</body>
</html>

