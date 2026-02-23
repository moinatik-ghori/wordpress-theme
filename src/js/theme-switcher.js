/**
 * Theme Switcher Module
 *
 * Handles dark/light theme switching with FOUC prevention.
 *
 * @package DevEngine_Premium
 * @since 1.0.0
 */

// SVG icons for theme toggle button.
const SUN_ICON = '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="5"/><path d="M12 1v2m0 18v2M4.22 4.22l1.42 1.42m13.12 13.12l1.42 1.42M1 12h2m18 0h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"/></svg>';
const MOON_ICON = '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>';

/**
 * Get the currently active resolved theme.
 *
 * @return {string} Active theme ('dark' or 'light').
 */
export function getActiveTheme() {
	const root = document.documentElement;
	if ( root.classList.contains( 'theme-dark' ) ) {
		return 'dark';
	}
	if ( root.classList.contains( 'theme-light' ) ) {
		return 'light';
	}
	// Fallback to system preference.
	return window.matchMedia( '(prefers-color-scheme: dark)' ).matches
		? 'dark'
		: 'light';
}

/**
 * Set theme programmatically.
 *
 * @param {string} theme Theme to set ('dark', 'light', or 'system').
 */
export function setTheme( theme ) {
	if ( ! [ 'dark', 'light', 'system' ].includes( theme ) ) {
		return;
	}

	const root = document.documentElement;
	root.classList.remove( 'theme-dark', 'theme-light' );

	if ( theme === 'system' ) {
		localStorage.removeItem( 'devengine-theme' );
		const isDark = window.matchMedia(
			'(prefers-color-scheme: dark)'
		).matches;
		root.classList.add( isDark ? 'theme-dark' : 'theme-light' );
	} else {
		localStorage.setItem( 'devengine-theme', theme );
		root.classList.add( `theme-${ theme }` );
	}

	// Update toggle button if it exists.
	const toggle = document.querySelector( '[data-theme-toggle]' );
	if ( toggle ) {
		updateToggleButton( toggle );
	}

	// Dispatch theme change event.
	const event = new CustomEvent( 'devengine:themechange', {
		detail: { theme: getActiveTheme() },
	} );
	document.dispatchEvent( event );
}

/**
 * Update toggle button state and icon.
 *
 * @param {HTMLElement} button Toggle button element.
 */
function updateToggleButton( button ) {
	const currentTheme = getActiveTheme();
	const isDark = currentTheme === 'dark';

	button.setAttribute( 'aria-label', isDark ? 'Switch to light mode' : 'Switch to dark mode' );
	button.setAttribute( 'aria-pressed', isDark.toString() );
	button.innerHTML = isDark ? SUN_ICON : MOON_ICON;
}

/**
 * Handle system theme preference change.
 *
 * @param {MediaQueryListEvent} event Media query change event.
 */
function handleSystemThemeChange( event ) {
	const stored = localStorage.getItem( 'devengine-theme' );
	// Only apply system change if user hasn't set explicit preference.
	if ( stored !== 'dark' && stored !== 'light' ) {
		const root = document.documentElement;
		root.classList.remove( 'theme-dark', 'theme-light' );
		root.classList.add( event.matches ? 'theme-dark' : 'theme-light' );

		const changeEvent = new CustomEvent( 'devengine:themechange', {
			detail: { theme: event.matches ? 'dark' : 'light' },
		} );
		document.dispatchEvent( changeEvent );
	}
}

/**
 * Initialize theme switcher.
 */
export function initThemeSwitcher() {
	const root = document.documentElement;

	// FOUC Prevention: Apply theme immediately.
	const stored = localStorage.getItem( 'devengine-theme' );
	let activeTheme;

	if ( stored === 'dark' || stored === 'light' ) {
		activeTheme = stored;
	} else {
		// System preference.
		activeTheme = window.matchMedia( '(prefers-color-scheme: dark)' )
			.matches
			? 'dark'
			: 'light';
	}

	root.classList.add( `theme-${ activeTheme }` );

	// Bind toggle button.
	const toggle = document.querySelector( '[data-theme-toggle]' );
	if ( toggle ) {
		updateToggleButton( toggle );

		toggle.addEventListener( 'click', () => {
			const currentTheme = getActiveTheme();
			const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
			setTheme( newTheme );
		} );
	}

	// Watch system theme changes.
	const systemThemeQuery = window.matchMedia(
		'(prefers-color-scheme: dark)'
	);
	if ( systemThemeQuery.addEventListener ) {
		systemThemeQuery.addEventListener( 'change', handleSystemThemeChange );
	} else {
		// Fallback for older browsers.
		systemThemeQuery.addListener( handleSystemThemeChange );
	}
}

