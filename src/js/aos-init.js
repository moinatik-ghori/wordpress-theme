/**
 * AOS (Animate On Scroll) Initialization Module
 *
 * Thin wrapper around AOS.js library with reduced motion support.
 *
 * @package DevEngine_Premium
 * @since 1.0.0
 */

/**
 * Refresh AOS animations.
 * Useful for dynamic content that loads after page load.
 */
export function refreshAOS() {
	if ( typeof window.AOS !== 'undefined' ) {
		window.AOS.refresh();
	}
}

/**
 * Initialize AOS animations.
 */
export function initAOS() {
	// Check if AOS is available.
	if ( typeof window.AOS === 'undefined' ) {
		return;
	}

	// Check reduced motion.
	if ( window.DevEngine?.reducedMotion ) {
		window.AOS.init( { disable: true } );
		return;
	}

	// Initialize AOS with custom settings.
	window.AOS.init( {
		duration: 600,
		easing: 'ease-out-cubic',
		once: true,
		offset: 80,
		delay: 0,
	} );

	// Refresh on theme change (layout may shift).
	document.addEventListener( 'devengine:themechange', refreshAOS );
}

