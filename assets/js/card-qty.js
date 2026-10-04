/**
 * Kinesilk — En la tarjeta de producto, cuando el producto ya está en el
 * carrito muestra un selector +/- para ajustar la cantidad (Store API).
 * Robusto ante el re-render del bloque: oculta el botón con una clase en el
 * card (CSS !important) y pone el stepper fuera del subárbol del bloque.
 */
( function () {
	'use strict';

	var BASE = '/wp-json/wc/store/v1';
	var nonce = null;
	var cards = [];

	function getCart() {
		return fetch( BASE + '/cart', {
			headers: { Accept: 'application/json' },
			credentials: 'include'
		} ).then( function ( r ) {
			nonce = r.headers.get( 'Nonce' ) || nonce;
			return r.json();
		} );
	}

	function write( path, body ) {
		return fetch( BASE + path, {
			method: 'POST',
			credentials: 'include',
			headers: {
				'Content-Type': 'application/json',
				Accept: 'application/json',
				Nonce: nonce || ''
			},
			body: JSON.stringify( body )
		} ).then( function ( r ) {
			nonce = r.headers.get( 'Nonce' ) || nonce;
			return r.json();
		} );
	}

	function refreshFragments() {
		if ( window.jQuery ) {
			window.jQuery( document.body ).trigger( 'wc_fragment_refresh' );
		}
	}

	function collect() {
		cards = [];
		var nodes = document.querySelectorAll( '.wc-block-product, .ks-pcard' );
		Array.prototype.forEach.call( nodes, function ( el ) {
			var btn = el.querySelector( '.add_to_cart_button' );
			if ( ! btn ) {
				return;
			}
			var id = parseInt( btn.getAttribute( 'data-product_id' ) || '', 10 );
			if ( ! id ) {
				var m = ( el.className || '' ).match( /post-(\d+)/ );
				if ( m ) {
					id = parseInt( m[ 1 ], 10 );
				}
			}
			if ( ! id ) {
				return;
			}
			cards.push( { id: id, el: el, button: btn, key: null, qty: 0, busy: false, stepper: null } );
		} );
	}

	function buildStepper( entry ) {
		var wrapper = entry.button.closest( '.wc-block-components-product-button, .wp-block-button' ) || entry.button;
		var stepper = document.createElement( 'div' );
		stepper.className = 'ks-cardqty';
		stepper.innerHTML =
			'<button type="button" class="ks-cardqty__btn ks-cardqty__minus" aria-label="Quitar uno">\u2212</button>' +
			'<span class="ks-cardqty__n" aria-live="polite"></span>' +
			'<button type="button" class="ks-cardqty__btn ks-cardqty__plus" aria-label="Agregar uno">+</button>';
		wrapper.parentNode.insertBefore( stepper, wrapper.nextSibling );
		stepper.querySelector( '.ks-cardqty__minus' ).addEventListener( 'click', function () {
			change( entry, entry.qty - 1 );
		} );
		stepper.querySelector( '.ks-cardqty__plus' ).addEventListener( 'click', function () {
			change( entry, entry.qty + 1 );
		} );
		entry.stepper = stepper;
		return stepper;
	}

	function render( entry ) {
		if ( entry.qty > 0 ) {
			entry.el.classList.add( 'ks-incart' );
			var stepper = entry.stepper || buildStepper( entry );
			stepper.querySelector( '.ks-cardqty__n' ).textContent = entry.qty;
			stepper.style.display = '';
		} else {
			entry.el.classList.remove( 'ks-incart' );
			if ( entry.stepper ) {
				entry.stepper.style.display = 'none';
			}
		}
	}

	function change( entry, newQty ) {
		if ( entry.busy ) {
			return;
		}
		entry.busy = true;
		var req;
		if ( newQty <= 0 && entry.key ) {
			req = write( '/cart/remove-item', { key: entry.key } );
		} else if ( entry.key ) {
			req = write( '/cart/update-item', { key: entry.key, quantity: newQty } );
		} else {
			req = write( '/cart/add-item', { id: entry.id, quantity: newQty } );
		}
		req.then( function ( cart ) {
			applyCart( cart );
			refreshFragments();
		} ).catch( function () {} ).then( function () {
			entry.busy = false;
		} );
	}

	function applyCart( cart ) {
		var byId = {};
		var items = ( cart && cart.items ) ? cart.items : [];
		items.forEach( function ( it ) {
			byId[ it.id ] = { key: it.key, qty: it.quantity };
		} );
		cards.forEach( function ( entry ) {
			var c = byId[ entry.id ];
			entry.qty = c ? c.qty : 0;
			entry.key = c ? c.key : null;
			render( entry );
		} );
	}

	function init() {
		collect();
		if ( ! cards.length ) {
			return;
		}
		getCart().then( applyCart );

		cards.forEach( function ( entry ) {
			entry.button.addEventListener( 'click', function () {
				setTimeout( function () {
					getCart().then( applyCart );
				}, 1200 );
			} );
		} );

		if ( window.jQuery ) {
			window.jQuery( document.body ).on(
				'added_to_cart wc_fragments_refreshed wc_fragments_loaded',
				function () {
					getCart().then( applyCart );
				}
			);
		}
	}

	if ( document.readyState !== 'loading' ) {
		init();
	} else {
		document.addEventListener( 'DOMContentLoaded', init );
	}
}() );
