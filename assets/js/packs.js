/* Kinesilk — Packs del inicio: el filtro carga los servicios en el mismo lugar.
   Ctrl/⌘-clic o clic central abren la página de la categoría (son enlaces reales). */
(function () {
	'use strict';
	var cache = {};

	document.addEventListener('click', function (e) {
		var a = e.target.closest('[data-ks-packs] [data-cat]');
		if (!a || !window.ksPacks || e.metaKey || e.ctrlKey || e.shiftKey || e.button !== 0) return;
		e.preventDefault();
		var ui = a.closest('[data-ks-packs]');
		var grid = ui.querySelector('.ks-pgrid');
		var more = ui.querySelector('.ks-packs__link');
		var cat = a.getAttribute('data-cat');

		ui.querySelectorAll('[data-cat]').forEach(function (el) { el.removeAttribute('aria-current'); });
		a.setAttribute('aria-current', 'true');
		grid.setAttribute('aria-busy', 'true');

		var p = cache[cat] || (cache[cat] = fetch(ksPacks.endpoint + '?cat=' + encodeURIComponent(cat)).then(function (r) {
			if (!r.ok) throw new Error(r.status);
			return r.json();
		}));
		p.then(function (d) {
			grid.innerHTML = d.html;
			more.href = d.link;
			more.textContent = d.label;
		}).catch(function () {
			delete cache[cat];
			window.location.href = a.href;
		}).finally(function () {
			grid.removeAttribute('aria-busy');
		});
	});
})();
