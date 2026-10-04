/**
 * Kinesilk — Selector de cantidad con botones +/- (reemplaza las flechas
 * nativas del input numérico). Aplica en producto simple, agrupado y carrito.
 */
( function () {
	'use strict';

	function enhance( qty ) {
		if ( qty.classList.contains( 'ks-qty' ) ) {
			return;
		}
		var input = qty.querySelector( 'input.qty, input[type="number"]' );
		if ( ! input ) {
			return;
		}
		qty.classList.add( 'ks-qty' );

		var min = parseFloat( input.getAttribute( 'min' ) );
		if ( isNaN( min ) ) {
			min = 0;
		}
		var step = parseFloat( input.getAttribute( 'step' ) );
		if ( isNaN( step ) || step <= 0 ) {
			step = 1;
		}

		var minus = document.createElement( 'button' );
		minus.type = 'button';
		minus.className = 'ks-qty__btn ks-qty__btn--minus';
		minus.setAttribute( 'aria-label', 'Disminuir cantidad' );
		minus.innerHTML = '<span aria-hidden="true">−</span>';

		var plus = document.createElement( 'button' );
		plus.type = 'button';
		plus.className = 'ks-qty__btn ks-qty__btn--plus';
		plus.setAttribute( 'aria-label', 'Aumentar cantidad' );
		plus.innerHTML = '<span aria-hidden="true">+</span>';

		function current() {
			var v = parseFloat( input.value );
			return isNaN( v ) ? 0 : v;
		}

		function cap( v ) {
			var max = parseFloat( input.getAttribute( 'max' ) );
			if ( ! isNaN( max ) && max >= 0 ) {
				v = Math.min( v, max );
			}
			return Math.max( min, v );
		}

		function setValue( v ) {
			input.value = cap( v );
			input.dispatchEvent( new Event( 'input', { bubbles: true } ) );
			input.dispatchEvent( new Event( 'change', { bubbles: true } ) );
		}

		minus.addEventListener( 'click', function () {
			setValue( current() - step );
		} );
		plus.addEventListener( 'click', function () {
			setValue( current() + step );
		} );

		input.parentNode.insertBefore( minus, input );
		input.parentNode.insertBefore( plus, input.nextSibling );
	}

	function run( root ) {
		var scope = root && root.querySelectorAll ? root : document;
		var nodes = scope.querySelectorAll( '.quantity' );
		for ( var i = 0; i < nodes.length; i++ ) {
			enhance( nodes[ i ] );
		}
	}

	if ( document.readyState !== 'loading' ) {
		run();
	} else {
		document.addEventListener( 'DOMContentLoaded', function () {
			run();
		} );
	}

	// Re-aplica tras recargas AJAX de WooCommerce (carrito, fragmentos).
	if ( window.jQuery ) {
		window.jQuery( document.body ).on(
			'updated_wc_div updated_cart_totals wc_fragments_refreshed wc_fragments_loaded',
			function () {
				run();
			}
		);
	}
}() );
