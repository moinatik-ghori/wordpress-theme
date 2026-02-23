/**
 * Customizer Preview JavaScript
 *
 * Live preview updates for theme customizer settings.
 *
 * @package DevEngine_Premium
 * @since 1.0.0
 */

(function( $ ) {
	'use strict';

	wp.customize.bind( 'ready', function() {
		// Color settings preview.
		wp.customize( 'devengine_color_primary', function( setting ) {
			setting.bind( function( value ) {
				document.documentElement.style.setProperty( '--color-devengine-teal', value );
			} );
		} );

		wp.customize( 'devengine_color_background', function( setting ) {
			setting.bind( function( value ) {
				document.documentElement.style.setProperty( '--color-devengine-slate', value );
			} );
		} );

		wp.customize( 'devengine_color_surface', function( setting ) {
			setting.bind( function( value ) {
				document.documentElement.style.setProperty( '--color-surface', value );
			} );
		} );

		wp.customize( 'devengine_color_text', function( setting ) {
			setting.bind( function( value ) {
				document.documentElement.style.setProperty( '--color-devengine-white', value );
			} );
		} );

		wp.customize( 'devengine_color_muted', function( setting ) {
			setting.bind( function( value ) {
				document.documentElement.style.setProperty( '--color-devengine-muted', value );
			} );
		} );

		// Typography settings preview.
		wp.customize( 'devengine_font_body', function( setting ) {
			setting.bind( function( value ) {
				document.documentElement.style.setProperty( '--font-body', value );
			} );
		} );

		wp.customize( 'devengine_font_heading', function( setting ) {
			setting.bind( function( value ) {
				document.documentElement.style.setProperty( '--font-heading', value );
			} );
		} );

		wp.customize( 'devengine_font_mono', function( setting ) {
			setting.bind( function( value ) {
				document.documentElement.style.setProperty( '--font-mono', value );
			} );
		} );

		wp.customize( 'devengine_font_size_base', function( setting ) {
			setting.bind( function( value ) {
				document.documentElement.style.setProperty( '--font-size-base', value + 'px' );
			} );
		} );

		// Header settings preview.
		wp.customize( 'devengine_header_sticky', function( setting ) {
			setting.bind( function( value ) {
				var header = document.querySelector( '.site-header' );
				if ( header ) {
					if ( value ) {
						header.classList.add( 'is-sticky' );
					} else {
						header.classList.remove( 'is-sticky' );
					}
				}
			} );
		} );

		wp.customize( 'devengine_header_blur', function( setting ) {
			setting.bind( function( value ) {
				var header = document.querySelector( '.site-header' );
				if ( header ) {
					if ( value ) {
						header.classList.add( 'has-blur' );
					} else {
						header.classList.remove( 'has-blur' );
					}
				}
			} );
		} );

		wp.customize( 'devengine_header_logo_height', function( setting ) {
			setting.bind( function( value ) {
				document.documentElement.style.setProperty( '--logo-height', value + 'px' );
			} );
		} );

		wp.customize( 'devengine_header_cta_text', function( setting ) {
			setting.bind( function( value ) {
				var ctaButton = document.querySelector( '.header-cta' );
				if ( ctaButton ) {
					ctaButton.textContent = value;
				}
			} );
		} );

		wp.customize( 'devengine_header_cta_url', function( setting ) {
			setting.bind( function( value ) {
				var ctaButton = document.querySelector( '.header-cta' );
				if ( ctaButton ) {
					ctaButton.setAttribute( 'href', value );
				}
			} );
		} );

		// Dark mode settings preview.
		wp.customize( 'devengine_dark_mode_default', function( setting ) {
			setting.bind( function( value ) {
				var root = document.documentElement;
				root.classList.remove( 'theme-dark', 'theme-light' );
				if ( 'system' !== value ) {
					root.classList.add( 'theme-' + value );
				}
			} );
		} );

		wp.customize( 'devengine_dark_mode_toggle', function( setting ) {
			setting.bind( function( value ) {
				var toggle = document.querySelector( '.dark-mode-toggle' );
				if ( toggle ) {
					toggle.style.display = value ? 'block' : 'none';
				}
			} );
		} );
	} );

})( jQuery );

