(function () {
	'use strict';

	var form = document.querySelector('.ks-shop-search');
	if (!form) { return; }
	var input = form.querySelector('.ks-shop-search__input');
	var main = document.querySelector('.ks-shop-main');
	if (!input || !main) { return; }

	var base = form.getAttribute('action') || window.location.pathname;
	var timer;
	var ctrl;

	function run() {
		var q = input.value.trim();
		var url = base + (q ? ('?buscar=' + encodeURIComponent(q)) : '');

		if (ctrl) { try { ctrl.abort(); } catch (e) {} }
		ctrl = ('AbortController' in window) ? new AbortController() : null;

		main.classList.add('is-loading');

		fetch(url, { signal: ctrl ? ctrl.signal : undefined, credentials: 'same-origin' })
			.then(function (r) { return r.text(); })
			.then(function (html) {
				var doc = new DOMParser().parseFromString(html, 'text/html');
				var fresh = doc.querySelector('.ks-shop-main');
				if (fresh) { main.innerHTML = fresh.innerHTML; }
				main.classList.remove('is-loading');
				try { window.history.replaceState({}, '', url); } catch (e) {}
			})
			.catch(function (e) {
				if (!e || e.name !== 'AbortError') { main.classList.remove('is-loading'); }
			});
	}

	form.addEventListener('submit', function (e) { e.preventDefault(); clearTimeout(timer); run(); });
	input.addEventListener('input', function () { clearTimeout(timer); timer = setTimeout(run, 350); });
})();
