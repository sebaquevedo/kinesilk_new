/* Kinesilk — mini carrito desplegable + "Finalizar compra" visible solo con productos */
(function () {
	'use strict';

	function root() { return document.querySelector('.ks-mc'); }

	function setOpen(open) {
		var mc = root();
		if (!mc) return;
		var btn = mc.querySelector('.ks-mc__toggle');
		var panel = mc.querySelector('.ks-mc__panel');
		btn.setAttribute('aria-expanded', open ? 'true' : 'false');
		panel.hidden = !open;
		mc.classList.toggle('is-open', open);
	}

	function syncCount() {
		var el = document.querySelector('.ks-mc__count');
		var n = el ? parseInt(el.getAttribute('data-count') || '0', 10) : 0;
		document.body.classList.toggle('ks-has-cart', n > 0);
		var btn = document.querySelector('.ks-mc__toggle');
		if (btn) btn.setAttribute('aria-label', 'Carrito: ' + n + (n === 1 ? ' producto' : ' productos'));
	}

	document.addEventListener('click', function (e) {
		var mc = root();
		if (!mc) return;
		if (e.target.closest('.ks-mc__toggle')) {
			e.preventDefault();
			setOpen(mc.querySelector('.ks-mc__panel').hidden);
		} else if (!e.target.closest('.ks-mc__panel')) {
			setOpen(false);
		}
	});

	document.addEventListener('keydown', function (e) {
		if (e.key === 'Escape' && root() && root().classList.contains('is-open')) {
			setOpen(false);
			root().querySelector('.ks-mc__toggle').focus();
		}
	});

	// Botones de producto basados en bloques (Store API): pedir fragmentos actualizados.
	document.body.addEventListener('wc-blocks_added_to_cart', function () {
		if (window.jQuery) window.jQuery(document.body).trigger('wc_fragment_refresh');
	});

	if (window.jQuery) {
		window.jQuery(document.body).on('wc_fragments_loaded wc_fragments_refreshed added_to_cart removed_from_cart', syncCount);
	}
	document.addEventListener('DOMContentLoaded', syncCount);
})();
