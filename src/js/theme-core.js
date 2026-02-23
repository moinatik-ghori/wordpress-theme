/**
 * DevEngine Premium Theme Core
 *
 * Main entry point that initializes all theme modules.
 *
 * @package DevEngine_Premium
 * @since 1.0.0
 */

import { initThemeSwitcher } from './theme-switcher.js';
import { initCursor } from './cursor.js';
import { initProgressBar } from './progress-bar.js';
import { initStickyHeader } from './sticky-header.js';
import { initMobileMenu } from './mobile-menu.js';
import { initAOS } from './aos-init.js';

/**
 * Get current theme from localStorage or system preference.
 *
 * @return {string} Current theme ('dark' or 'light').
 */
function getCurrentTheme() {
	const stored = localStorage.getItem( 'devengine-theme' );
	if ( stored === 'dark' || stored === 'light' ) {
		return stored;
	}
	// System preference or default
	return window.matchMedia( '(prefers-color-scheme: dark)' ).matches
		? 'dark'
		: 'light';
}

/**
 * Check if device is touch-enabled.
 *
 * @return {boolean} True if touch device.
 */
function isTouchDevice() {
	return window.matchMedia( '(hover: none) and (pointer: coarse)' ).matches;
}

/**
 * Check if user prefers reduced motion.
 *
 * @return {boolean} True if reduced motion preferred.
 */
function reducedMotion() {
	return window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;
}

/**
 * Global error handler for development.
 *
 * @param {ErrorEvent} event Error event.
 */
function handleGlobalError( event ) {
	if ( window.location.hostname === 'localhost' ) {
		console.error( 'DevEngine Error:', event.error );
	}
}

/**
 * Initialize all theme modules.
 */
function init() {
	// Initialize theme switcher first (FOUC prevention).
	initThemeSwitcher();

	// Initialize cursor (checks touch device internally).
	if ( document.querySelector( '[data-magnetic]' ) || document.querySelector( 'a, button' ) ) {
		initCursor();
	}

	// Initialize progress bar (checks for element).
	if ( document.querySelector( '.reading-progress' ) ) {
		initProgressBar();
	}

	// Initialize sticky header (checks data attribute).
	if ( document.querySelector( '.site-header' ) ) {
		initStickyHeader();
	}

	// Initialize mobile menu (checks for toggle button).
	if ( document.querySelector( '[data-menu-toggle]' ) ) {
		initMobileMenu();
	}

	// Initialize AOS animations (checks reduced motion internally).
	if ( document.querySelector( '[data-aos]' ) ) {
		initAOS();
	}

	// Dispatch ready event.
	const readyEvent = new CustomEvent( 'devengine:ready', {
		detail: window.DevEngine,
	} );
	document.dispatchEvent( readyEvent );
}

// Export global DevEngine object.
window.DevEngine = {
	version: '1.0.0',
	theme: getCurrentTheme(),
	isTouchDevice: isTouchDevice(),
	reducedMotion: reducedMotion(),
};

// Add global error handler.
window.addEventListener( 'error', handleGlobalError );

// Initialize on DOM ready.
if ( document.readyState === 'loading' ) {
	document.addEventListener( 'DOMContentLoaded', init );
} else {
	init();
}

