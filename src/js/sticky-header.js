/**
 * Sticky Header Module
 *
 * Handles sticky header behavior with scroll detection
 * and hide/show on scroll direction.
 *
 * @package DevEngine_Premium
 * @since 1.0.0
 */

/**
 * Initialize sticky header.
 */
export function initStickyHeader() {
	const header = document.querySelector( '.site-header' );
	if ( ! header ) {
		return;
	}

	// Check if sticky is enabled via data attribute.
	if ( header.dataset.sticky === 'false' ) {
		return;
	}

	// Create sentinel element for IntersectionObserver.
	let sentinel = document.getElementById( 'header-sentinel' );
	if ( ! sentinel ) {
		sentinel = document.createElement( 'div' );
		sentinel.id = 'header-sentinel';
		sentinel.style.cssText =
			'position: absolute; top: 0; left: 0; width: 100%; height: 1px; pointer-events: none;';
		header.insertAdjacentElement( 'afterend', sentinel );
	}

	let isScrolled = false;
	let lastScrollY = window.scrollY;
	let ticking = false;

	/**
	 * Update header state.
	 *
	 * @param {boolean} scrolled Whether header is scrolled.
	 */
	function updateHeaderState( scrolled ) {
		if ( scrolled === isScrolled ) {
			return;
		}

		isScrolled = scrolled;

		if ( scrolled ) {
			header.classList.add( 'site-header--scrolled' );
		} else {
			header.classList.remove( 'site-header--scrolled' );
		}

		// Dispatch state change event.
		const event = new CustomEvent( 'devengine:headerstate', {
			detail: { scrolled },
		} );
		document.dispatchEvent( event );
	}

	/**
	 * Handle scroll direction for hide/show.
	 */
	function handleScrollDirection() {
		if ( ! ticking ) {
			window.requestAnimationFrame( () => {
				const currentScrollY = window.scrollY;
				const scrollDelta = currentScrollY - lastScrollY;

				// Check if dropdown is open.
				const hasOpenDropdown = document.querySelector(
					'.nav__dropdown--open'
				);

				// Hide on scroll down (never if dropdown is open).
				if (
					scrollDelta > 0 &&
					currentScrollY > 200 &&
					! hasOpenDropdown
				) {
					header.classList.add( 'site-header--hidden' );
				} else if ( scrollDelta < 0 ) {
					// Show on scroll up.
					header.classList.remove( 'site-header--hidden' );
				}

				lastScrollY = currentScrollY;
				ticking = false;
			} );

			ticking = true;
		}
	}

	// IntersectionObserver for scroll detection.
	const observer = new IntersectionObserver(
		( entries ) => {
			entries.forEach( ( entry ) => {
				// When sentinel leaves viewport, header is scrolled.
				updateHeaderState( ! entry.isIntersecting );
			} );
		},
		{
			root: null,
			rootMargin: '0px',
			threshold: 0,
		}
	);

	observer.observe( sentinel );

	// Scroll direction detection.
	window.addEventListener( 'scroll', handleScrollDirection, {
		passive: true,
	} );
}

