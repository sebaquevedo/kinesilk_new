/**
 * Kinesilk — Micro-animación al agregar al carrito:
 * late el ícono del carrito cuando cambia el contador y da feedback en el botón.
 */
( function () {
	'use strict';

	function bumpCart() {
		var cart = document.querySelector( '.ks-mc__toggle' );
		if ( ! cart ) {
			return;
		}
		cart.classList.remove( 'ks-mc--bump' );
		// reinicia la animación
		void cart.offsetWidth;
		cart.classList.add( 'ks-mc--bump' );
	}

	function watchCount() {
		var count = document.querySelector( '.ks-mc__count' );
		if ( ! count ) {
			return;
		}
		var last = parseInt( count.getAttribute( 'data-count' ) || count.textContent || '0', 10 ) || 0;
		var obs = new MutationObserver( function () {
			var now = parseInt( count.getAttribute( 'data-count' ) || count.textContent || '0', 10 ) || 0;
			if ( now > last ) {
				bumpCart();
			}
			last = now;
		} );
		obs.observe( count, { attributes: true, childList: true, characterData: true, subtree: true } );
	}

	function buttonFeedback() {
		if ( ! window.jQuery ) {
			return;
		}
		window.jQuery( document.body ).on( 'added_to_cart', function ( e, fragments, hash, $button ) {
			bumpCart();
			if ( ! $button || ! $button.length ) {
				return;
			}
			var b = $button[ 0 ];
			if ( b.dataset.ksBusy ) {
				return;
			}
			b.dataset.ksBusy = '1';
			var prev = b.textContent;
			b.classList.add( 'ks-added' );
			b.textContent = '¡Agregado! ✓';
			setTimeout( function () {
				b.textContent = prev;
				b.classList.remove( 'ks-added' );
				delete b.dataset.ksBusy;
			}, 1400 );
		} );
	}

	function init() {
		watchCount();
		buttonFeedback();
	}

	if ( document.readyState !== 'loading' ) {
		init();
	} else {
		document.addEventListener( 'DOMContentLoaded', init );
	}
}() );
