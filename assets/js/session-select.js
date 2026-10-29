(function () {
	'use strict';

	function clp( n ) {
		try {
			return new Intl.NumberFormat( 'es-CL', { style: 'currency', currency: 'CLP', maximumFractionDigits: 0 } ).format( n );
		} catch ( e ) {
			return '$' + Math.round( n ).toLocaleString( 'es-CL' );
		}
	}

	function paint( root, pill ) {
		var now = parseFloat( pill.dataset.now );
		var reg = parseFloat( pill.dataset.reg );
		var ses = parseInt( pill.dataset.ses, 10 );
		var elNow = root.querySelector( '.ks-sel__now' );
		var elWas = root.querySelector( '.ks-sel__was' );
		var elOff = root.querySelector( '.ks-sel__off' );
		var elUnit = root.querySelector( '.ks-sel__unit' );
		var elUnitB = root.querySelector( '.ks-sel__unit b' );
		var cta = root.querySelector( '.ks-sel__cta' );

		if ( elNow ) { elNow.textContent = clp( now ); }

		if ( reg > now ) {
			if ( elWas ) { elWas.textContent = clp( reg ); elWas.hidden = false; }
			if ( elOff ) { elOff.textContent = Math.round( ( 1 - now / reg ) * 100 ) + '% OFF'; elOff.hidden = false; }
		} else {
			if ( elWas ) { elWas.hidden = true; }
			if ( elOff ) { elOff.hidden = true; }
		}

		var pid = root.getAttribute( 'data-ks-sel' );
		var imgBadge = pid ? document.querySelector( '[data-ks-offbadge="' + pid + '"]' ) : null;
		if ( imgBadge ) {
			if ( reg > now ) { imgBadge.textContent = '-' + Math.round( ( 1 - now / reg ) * 100 ) + '%'; imgBadge.hidden = false; }
			else { imgBadge.hidden = true; }
		}

		if ( elUnit && elUnitB ) {
			if ( ses > 0 ) { elUnitB.textContent = clp( now / ses ); elUnit.hidden = false; }
			else { elUnit.hidden = true; }
		}

		if ( cta ) {
			var base = cta.dataset.base || 'Agregar';
			cta.textContent = base + ' — ' + clp( now );
			if ( pill.dataset.href ) { cta.setAttribute( 'href', pill.dataset.href ); }
		}
	}

	function init( ctx ) {
		( ctx || document ).querySelectorAll( '.ks-sel' ).forEach( function ( root ) {
			if ( root.dataset.ksReady ) { return; }
			root.dataset.ksReady = '1';
			var sel = root.querySelector( '.ks-sel__pill[aria-pressed="true"]' ) || root.querySelector( '.ks-sel__pill' );
			if ( sel ) { paint( root, sel ); }
		} );
	}

	document.addEventListener( 'click', function ( e ) {
		var pill = e.target.closest( '.ks-sel__pill' );
		if ( ! pill ) { return; }
		var root = pill.closest( '.ks-sel' );
		if ( ! root ) { return; }
		root.querySelectorAll( '.ks-sel__pill' ).forEach( function ( b ) {
			b.setAttribute( 'aria-pressed', b === pill ? 'true' : 'false' );
		} );
		paint( root, pill );
	} );

	if ( document.readyState !== 'loading' ) { init(); }
	else { document.addEventListener( 'DOMContentLoaded', function () { init(); } ); }

	// El bloque Product Collection puede re-renderizar (filtros / paginacion).
	document.body.addEventListener( 'wc-blocks_product_list_rendered', function () { init(); } );
	if ( window.MutationObserver ) {
		var mo = new MutationObserver( function ( muts ) {
			for ( var i = 0; i < muts.length; i++ ) {
				if ( muts[ i ].addedNodes && muts[ i ].addedNodes.length ) { init(); return; }
			}
		} );
		mo.observe( document.body, { childList: true, subtree: true } );
	}
})();


/* Paginacion: mantener "Pagina X de Y" sincronizada aunque la navegacion sea
   client-side (el bloque re-renderiza el grid sin recargar la pagina). */
(function () {
	'use strict';
	function num( el ) { return parseInt( ( el.textContent || '' ).replace( /\D/g, '' ), 10 ); }
	function syncOne( nav ) {
		var cap = nav.previousElementSibling;
		if ( ! cap || ! cap.classList || ! cap.classList.contains( 'ks-pg-caption' ) ) { return; }
		var cur = nav.querySelector( '.page-numbers.current' );
		var current = cur ? num( cur ) : 1;
		var nums = [].map.call( nav.querySelectorAll( '.page-numbers' ), num ).filter( function ( n ) { return ! isNaN( n ); } );
		var total = nums.length ? Math.max.apply( null, nums ) : current;
		if ( ! current || ! total ) { return; }
		var state = current + '/' + total;
		if ( cap.dataset.ksState === state ) { return; }
		cap.dataset.ksState = state;
		cap.innerHTML = 'P\u00e1gina <b>' + current + '</b> de <b>' + total + '</b>';
	}
	function syncAll() { document.querySelectorAll( '.wp-block-query-pagination' ).forEach( syncOne ); }
	if ( document.readyState !== 'loading' ) { syncAll(); }
	else { document.addEventListener( 'DOMContentLoaded', syncAll ); }
	if ( window.MutationObserver ) {
		new MutationObserver( function () { syncAll(); } ).observe( document.body, { childList: true, subtree: true } );
	}
})();

