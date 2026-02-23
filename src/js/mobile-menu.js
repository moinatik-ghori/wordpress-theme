/**
 * Mobile Menu Module
 *
 * Handles off-canvas mobile navigation with focus trapping
 * and nested dropdown support.
 *
 * @package DevEngine_Premium
 * @since 1.0.0
 */

/**
 * Get all focusable elements within a container.
 *
 * @param {HTMLElement} container Container element.
 * @return {NodeList} Focusable elements.
 */
function getFocusableElements( container ) {
	return container.querySelectorAll(
		'a, button, input, [tabindex]:not([tabindex="-1"])'
	);
}

/**
 * Initialize mobile menu.
 */
export function initMobileMenu() {
	const toggle = document.querySelector( '[data-menu-toggle]' );
	const menu = document.querySelector( '.nav--mobile' );
	const overlay = document.querySelector( '.nav__overlay' );

	if ( ! toggle || ! menu || ! overlay ) {
		return;
	}

	let isOpen = false;
	let focusableElements = [];
	let firstFocusable = null;
	let lastFocusable = null;

	/**
	 * Update focusable elements list.
	 */
	function updateFocusableElements() {
		focusableElements = Array.from( getFocusableElements( menu ) );
		firstFocusable = focusableElements[ 0 ] || null;
		lastFocusable =
			focusableElements[ focusableElements.length - 1 ] || null;
	}

	/**
	 * Open menu.
	 */
	function openMenu() {
		isOpen = true;
		menu.classList.add( 'nav--mobile--open' );
		overlay.classList.add( 'nav__overlay--visible' );
		toggle.setAttribute( 'aria-expanded', 'true' );
		document.body.style.overflow = 'hidden';

		updateFocusableElements();

		// Focus first element.
		if ( firstFocusable ) {
			firstFocusable.focus();
		}
	}

	/**
	 * Close menu.
	 */
	function closeMenu() {
		isOpen = false;
		menu.classList.remove( 'nav--mobile--open' );
		overlay.classList.remove( 'nav__overlay--visible' );
		toggle.setAttribute( 'aria-expanded', 'false' );
		document.body.style.overflow = '';

		// Return focus to toggle button.
		toggle.focus();
	}

	/**
	 * Handle focus trap.
	 *
	 * @param {KeyboardEvent} event Keyboard event.
	 */
	function handleFocusTrap( event ) {
		if ( ! isOpen || event.key !== 'Tab' ) {
			return;
		}

		updateFocusableElements();

		if ( focusableElements.length === 0 ) {
			event.preventDefault();
			return;
		}

		if ( event.shiftKey ) {
			// Shift + Tab: focus previous.
			if ( document.activeElement === firstFocusable ) {
				event.preventDefault();
				lastFocusable?.focus();
			}
		} else {
			// Tab: focus next.
			if ( document.activeElement === lastFocusable ) {
				event.preventDefault();
				firstFocusable?.focus();
			}
		}
	}

	/**
	 * Handle nested dropdown toggle.
	 *
	 * @param {HTMLElement} trigger Trigger element.
	 */
	function toggleDropdown( trigger ) {
		const dropdown = trigger.nextElementSibling;
		if ( ! dropdown || ! dropdown.classList.contains( 'nav__dropdown' ) ) {
			return;
		}

		const isOpen = dropdown.classList.contains( 'nav__dropdown--open' );

		if ( isOpen ) {
			dropdown.classList.remove( 'nav__dropdown--open' );
			dropdown.style.maxHeight = '0px';
			trigger.setAttribute( 'aria-expanded', 'false' );
		} else {
			dropdown.classList.add( 'nav__dropdown--open' );
			dropdown.style.maxHeight = dropdown.scrollHeight + 'px';
			trigger.setAttribute( 'aria-expanded', 'true' );
		}
	}

	// Toggle button click.
	toggle.addEventListener( 'click', () => {
		if ( isOpen ) {
			closeMenu();
		} else {
			openMenu();
		}
	} );

	// Overlay click to close.
	overlay.addEventListener( 'click', closeMenu );

	// Escape key to close.
	document.addEventListener( 'keydown', ( event ) => {
		if ( event.key === 'Escape' && isOpen ) {
			closeMenu();
		}
	} );

	// Focus trap.
	document.addEventListener( 'keydown', handleFocusTrap );

	// Nested dropdown handlers.
	const dropdownTriggers = menu.querySelectorAll( '[data-has-dropdown]' );
	dropdownTriggers.forEach( ( trigger ) => {
		trigger.addEventListener( 'click', ( event ) => {
			event.preventDefault();
			toggleDropdown( trigger );
		} );
	} );

	// Breakpoint awareness: close menu on desktop.
	const desktopQuery = window.matchMedia( '(min-width: 1024px)' );
	function handleBreakpointChange( event ) {
		if ( event.matches && isOpen ) {
			closeMenu();
		}
	}

	if ( desktopQuery.addEventListener ) {
		desktopQuery.addEventListener( 'change', handleBreakpointChange );
	} else {
		// Fallback for older browsers.
		desktopQuery.addListener( handleBreakpointChange );
	}
}

