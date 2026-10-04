/**
 * Kinesilk — Servicios y páginas de categoría:
 *  - Buscador para filtrar la lista de categorías (instantáneo).
 *  - Panel de filtros colapsable en mobile (los productos quedan primero).
 *  - En la página de categoría: muestra algunas categorías + "Ver todas".
 *
 * Nota: el click en una categoría navega a su archivo (el servidor muestra
 * los productos, incluidas las subcategorías). No se hace filtrado
 * client-side porque la grilla pagina y los productos viven en subcategorías.
 */
( function () {
	'use strict';

	function addSearch( list, placeholder ) {
		var input = document.createElement( 'input' );
		input.type = 'search';
		input.className = 'ks-catsearch__input';
		input.placeholder = placeholder;
		input.setAttribute( 'aria-label', placeholder );
		list.parentNode.insertBefore( input, list );
		return input;
	}

	function listItems( list ) {
		return Array.prototype.slice.call(
			list.querySelectorAll( '.wc-block-product-categories-list-item' )
		);
	}

	function buildSidebar() {
		var sidebar = document.querySelector( '.ks-shop-sidebar' );
		if ( ! sidebar ) {
			return;
		}
		var list = sidebar.querySelector( '.wc-block-product-categories-list' );
		if ( ! list || list.dataset.ksReady ) {
			return;
		}
		list.dataset.ksReady = '1';

		var items = listItems( list );
		var search = addSearch( list, 'Buscar categoría\u2026' );
		search.addEventListener( 'input', function () {
			var q = search.value.trim().toLowerCase();
			items.forEach( function ( li ) {
				li.style.display = ( ! q || li.textContent.toLowerCase().indexOf( q ) !== -1 ) ? '' : 'none';
			} );
		} );
	}

	function buildTaxonomyCats() {
		var nav = document.querySelector( '.ks-cats' );
		if ( ! nav ) {
			return;
		}
		var list = nav.querySelector( '.wc-block-product-categories-list' );
		if ( ! list || list.dataset.ksReady ) {
			return;
		}
		list.dataset.ksReady = '1';

		var items = listItems( list );
		var isMobile = window.matchMedia( '(max-width: 781px)' ).matches;
		var LIMIT = isMobile ? 0 : 6;
		var expanded = false;

		var label = document.createElement( 'p' );
		label.className = 'ks-group-label';
		label.textContent = 'Todas las categorías';
		list.parentNode.insertBefore( label, list );

		var search = addSearch( list, 'Buscar categoría\u2026' );

		function isCurrent( li ) {
			return li.classList.contains( 'is-current' ) || !! li.querySelector( '[aria-current]' );
		}

		function collapse( on ) {
			items.forEach( function ( li, i ) {
				if ( on && i >= LIMIT && ( isMobile || ! isCurrent( li ) ) ) {
					li.classList.add( 'ks-cat-hidden' );
				} else {
					li.classList.remove( 'ks-cat-hidden' );
				}
			} );
		}

		var toggle = document.createElement( 'button' );
		toggle.type = 'button';
		toggle.className = 'ks-cats-toggle';
		toggle.textContent = 'Ver todas las categorías';

		if ( items.length > LIMIT ) {
			nav.appendChild( toggle );
			collapse( true );
			toggle.addEventListener( 'click', function () {
				expanded = ! expanded;
				collapse( ! expanded );
				toggle.textContent = expanded ? 'Ver menos' : 'Ver todas las categorías';
			} );
		}

		search.addEventListener( 'input', function () {
			var q = search.value.trim().toLowerCase();
			if ( q ) {
				toggle.style.display = 'none';
				items.forEach( function ( li ) {
					li.classList.remove( 'ks-cat-hidden' );
					li.style.display = li.textContent.toLowerCase().indexOf( q ) !== -1 ? '' : 'none';
				} );
			} else {
				toggle.style.display = '';
				items.forEach( function ( li ) { li.style.display = ''; } );
				collapse( ! expanded );
			}
		} );
	}

	function buildMobileToggle() {
		var layout = document.querySelector( '.ks-shop-layout' );
		var sidebar = document.querySelector( '.ks-shop-sidebar' );
		if ( ! layout || ! sidebar || layout.dataset.ksToggle ) {
			return;
		}
		layout.dataset.ksToggle = '1';

		var btn = document.createElement( 'button' );
		btn.type = 'button';
		btn.className = 'ks-filter-toggle';
		btn.setAttribute( 'aria-expanded', 'false' );
		btn.innerHTML = '<span class="ks-filter-toggle__icon" aria-hidden="true"></span><span>Filtrar y ordenar</span>';
		layout.parentNode.insertBefore( btn, layout );

		btn.addEventListener( 'click', function () {
			var open = sidebar.classList.toggle( 'is-open' );
			btn.classList.toggle( 'is-open', open );
			btn.setAttribute( 'aria-expanded', open ? 'true' : 'false' );
		} );
	}

	function init() {
		buildSidebar();
		buildMobileToggle();
		buildTaxonomyCats();
	}

	if ( document.readyState !== 'loading' ) {
		init();
	} else {
		document.addEventListener( 'DOMContentLoaded', init );
	}
}() );
