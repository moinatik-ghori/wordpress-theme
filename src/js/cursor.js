/**
 * Magnetic Cursor Module
 *
 * Custom cursor with magnetic hover effects.
 * Disabled on touch devices and respects reduced motion.
 *
 * @package DevEngine_Premium
 * @since 1.0.0
 */

// Lerp factor for smooth cursor ring animation.
const LERP_FACTOR = 0.15;

// Maximum magnetic pull distance in pixels.
const MAX_PULL_DISTANCE = 8;

/**
 * Create cursor elements if they don't exist.
 *
 * @return {Object} Cursor elements object.
 */
function createCursorElements() {
	let dot = document.querySelector( '.cursor__dot' );
	let ring = document.querySelector( '.cursor__ring' );

	if ( ! dot ) {
		dot = document.createElement( 'div' );
		dot.className = 'cursor__dot';
		dot.style.cssText =
			'position: fixed; width: 4px; height: 4px; background-color: var(--color-devengine-teal); border-radius: 50%; pointer-events: none; z-index: 500; transform: translate(-50%, -50%); will-change: transform;';
		document.body.appendChild( dot );
	}

	if ( ! ring ) {
		ring = document.createElement( 'div' );
		ring.className = 'cursor__ring';
		ring.style.cssText =
			'position: fixed; width: 24px; height: 24px; border: 2px solid var(--color-devengine-teal); border-radius: 50%; pointer-events: none; z-index: 500; transform: translate(-50%, -50%); will-change: transform;';
		document.body.appendChild( ring );
	}

	return { dot, ring };
}

/**
 * Initialize magnetic cursor.
 */
export function initCursor() {
	// Check touch device.
	if ( window.DevEngine?.isTouchDevice ) {
		// Hide cursor elements if they exist.
		const existing = document.querySelectorAll( '.cursor__dot, .cursor__ring' );
		existing.forEach( ( el ) => {
			el.style.display = 'none';
		} );
		return;
	}

	// Check reduced motion.
	const reducedMotion = window.DevEngine?.reducedMotion || false;

	// Create cursor elements.
	const { dot, ring } = createCursorElements();

	// Hide native cursor.
	document.body.style.cursor = 'none';

	// Mouse position tracking.
	let mouseX = 0;
	let mouseY = 0;
	let ringX = 0;
	let ringY = 0;
	let isVisible = false;

	// Magnetic elements.
	const magneticElements = document.querySelectorAll(
		'a, button, [data-magnetic]'
	);

	/**
	 * Update cursor position using requestAnimationFrame.
	 */
	function updateCursor() {
		if ( ! isVisible ) {
			return;
		}

		// Update dot position instantly.
		dot.style.transform = `translate(${ mouseX }px, ${ mouseY }px)`;

		// Apply lerp to ring for smooth trailing effect.
		if ( ! reducedMotion ) {
			ringX += ( mouseX - ringX ) * LERP_FACTOR;
			ringY += ( mouseY - ringY ) * LERP_FACTOR;
			ring.style.transform = `translate(${ ringX }px, ${ ringY }px)`;
		} else {
			// Static position for reduced motion.
			ring.style.transform = `translate(${ mouseX }px, ${ mouseY }px)`;
		}

		requestAnimationFrame( updateCursor );
	}

	/**
	 * Handle mouse move.
	 *
	 * @param {MouseEvent} event Mouse event.
	 */
	function handleMouseMove( event ) {
		mouseX = event.clientX;
		mouseY = event.clientY;

		if ( ! isVisible ) {
			isVisible = true;
			dot.style.opacity = '1';
			ring.style.opacity = '1';
			updateCursor();
		}
	}

	/**
	 * Handle mouse enter on magnetic element.
	 *
	 * @param {HTMLElement} element Magnetic element.
	 */
	function handleMagneticEnter( element ) {
		dot.classList.add( 'cursor--hovering' );
		ring.classList.add( 'cursor--hovering' );

		// Store original transform.
		if ( ! element.dataset.originalTransform ) {
			element.dataset.originalTransform = element.style.transform || '';
		}
	}

	/**
	 * Handle mouse move over magnetic element.
	 *
	 * @param {MouseEvent} event Mouse event.
	 * @param {HTMLElement} element Magnetic element.
	 */
	function handleMagneticMove( event, element ) {
		if ( reducedMotion ) {
			return;
		}

		const rect = element.getBoundingClientRect();
		const centerX = rect.left + rect.width / 2;
		const centerY = rect.top + rect.height / 2;

		const offsetX = event.clientX - centerX;
		const offsetY = event.clientY - centerY;

		const pullX = Math.min( Math.abs( offsetX ), MAX_PULL_DISTANCE ) *
			Math.sign( offsetX );
		const pullY = Math.min( Math.abs( offsetY ), MAX_PULL_DISTANCE ) *
			Math.sign( offsetY );

		element.style.transform = `translate(${ pullX }px, ${ pullY }px)`;
		element.style.transition = 'none';
	}

	/**
	 * Handle mouse leave on magnetic element.
	 *
	 * @param {HTMLElement} element Magnetic element.
	 */
	function handleMagneticLeave( element ) {
		dot.classList.remove( 'cursor--hovering' );
		ring.classList.remove( 'cursor--hovering' );

		// Reset transform with transition.
		element.style.transition = 'transform 0.3s ease';
		element.style.transform =
			element.dataset.originalTransform || '';
	}

	// Mouse tracking.
	document.addEventListener( 'mousemove', handleMouseMove );

	// Show/hide cursor on document enter/leave.
	document.addEventListener( 'mouseenter', () => {
		isVisible = true;
		dot.style.opacity = '1';
		ring.style.opacity = '1';
	} );

	document.addEventListener( 'mouseleave', () => {
		isVisible = false;
		dot.style.opacity = '0';
		ring.style.opacity = '0';
	} );

	// Magnetic effects.
	magneticElements.forEach( ( element ) => {
		element.addEventListener( 'mouseenter', () =>
			handleMagneticEnter( element )
		);
		element.addEventListener( 'mousemove', ( event ) =>
			handleMagneticMove( event, element )
		);
		element.addEventListener( 'mouseleave', () =>
			handleMagneticLeave( element )
		);
	} );
}

