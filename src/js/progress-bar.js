/**
 * Reading Progress Bar Module
 *
 * Displays a fixed progress bar at the top of the viewport
 * indicating reading progress through the page.
 *
 * @package DevEngine_Premium
 * @since 1.0.0
 */

/**
 * Initialize reading progress bar.
 */
export function initProgressBar() {
	// Check if element exists, create if not.
	let progressBar = document.querySelector( '.reading-progress' );

	if ( ! progressBar ) {
		progressBar = document.createElement( 'div' );
		progressBar.className = 'reading-progress';
		progressBar.setAttribute( 'role', 'progressbar' );
		progressBar.setAttribute( 'aria-valuenow', '0' );
		progressBar.setAttribute( 'aria-valuemin', '0' );
		progressBar.setAttribute( 'aria-valuemax', '100' );
		progressBar.setAttribute( 'aria-label', 'Reading progress' );
		progressBar.style.cssText =
			'position: fixed; top: 0; left: 0; width: 100%; height: 3px; background-color: rgba(255, 255, 255, 0.1); z-index: 300; pointer-events: none;';
		document.body.prepend( progressBar );
	}

	// Create inner bar element.
	let bar = progressBar.querySelector( '.reading-progress__bar' );
	if ( ! bar ) {
		bar = document.createElement( 'div' );
		bar.className = 'reading-progress__bar';
		bar.style.cssText =
			'height: 100%; width: 0%; background: linear-gradient(90deg, var(--color-devengine-teal) 0%, lighten(var(--color-devengine-teal), 10%) 100%); transform-origin: left; will-change: transform;';
		progressBar.appendChild( bar );
	}

	// Check reduced motion.
	const reducedMotion = window.DevEngine?.reducedMotion || false;
	if ( reducedMotion ) {
		progressBar.classList.add( 'no-transition' );
	}

	// RAF scroll pattern to prevent layout thrashing.
	let ticking = false;
	let lastProgress = 0;

	/**
	 * Update progress bar using transform for GPU acceleration.
	 * Using transform: scaleX() instead of width for better performance
	 * as transforms are GPU-accelerated and don't trigger layout reflow.
	 *
	 * @param {number} progress Progress percentage (0-100).
	 */
	function updateBar( progress ) {
		// Clamp progress between 0 and 100.
		const clampedProgress = Math.min( Math.max( progress, 0 ), 100 );

		// Update transform for GPU acceleration.
		bar.style.transform = `scaleX(${ clampedProgress / 100 })`;

		// Update ARIA attribute.
		progressBar.setAttribute( 'aria-valuenow', Math.round( clampedProgress ) );

		// Dispatch completion event.
		if ( clampedProgress >= 100 && lastProgress < 100 ) {
			const event = new CustomEvent( 'devengine:readcomplete', {
				detail: { progress: clampedProgress },
			} );
			document.dispatchEvent( event );
		}

		lastProgress = clampedProgress;
		ticking = false;
	}

	/**
	 * Calculate and update progress on scroll.
	 */
	function onScroll() {
		if ( ! ticking ) {
			window.requestAnimationFrame( () => {
				const scrollHeight =
					document.documentElement.scrollHeight -
					window.innerHeight;
				const scrollTop = window.scrollY;
				const progress = scrollHeight > 0
					? ( scrollTop / scrollHeight ) * 100
					: 0;

				updateBar( progress );
			} );

			ticking = true;
		}
	}

	// Initial calculation.
	onScroll();

	// Listen for scroll events.
	window.addEventListener( 'scroll', onScroll, { passive: true } );

	// Recalculate on resize.
	window.addEventListener( 'resize', onScroll, { passive: true } );
}

