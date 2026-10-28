(function () {
	var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
	var scenes = document.querySelectorAll('.ks-aniv__scene');
	if (!scenes.length) return;

	if (!reduce) {
		var i = 0;
		setInterval(function () {
			scenes[i].classList.remove('is-active');
			i = (i + 1) % scenes.length;
			scenes[i].classList.add('is-active');
		}, 4600);
	}

	if (!reduce && window.confetti) {
		var canvas = document.getElementById('ks-aniv-fx');
		var stageEl = document.querySelector('.ks-aniv');
		if (canvas && stageEl) {
			var sizeFx = function () {
				canvas.width = stageEl.clientWidth || window.innerWidth;
				canvas.height = stageEl.clientHeight || window.innerHeight;
			};
			sizeFx();
			window.addEventListener('resize', sizeFx);
			var fx = confetti.create(canvas, { resize: false, useWorker: false });
			var party = ['#FEA4A4', '#87E9CE', '#FFBDBE', '#BADEDA', '#F07E7E'];

			var burstAt = function (x, y, big) {
				fx({ particleCount: big ? 95 : 65, startVelocity: big ? 23 : 18, spread: 360, ticks: 220, gravity: 0.5, decay: 0.93, scalar: big ? 1.1 : 0.9, origin: { x: x, y: y }, colors: party });
				fx({ particleCount: 20, startVelocity: 10, spread: 360, ticks: 170, gravity: 0.45, scalar: 0.7, origin: { x: x, y: y }, colors: party });
			};

			var seq = [
				{ t: 400, x: 0.50, y: 0.30, big: true },
				{ t: 1500, x: 0.12, y: 0.32 },
				{ t: 2600, x: 0.88, y: 0.30 },
				{ t: 3800, x: 0.28, y: 0.22 },
				{ t: 5000, x: 0.72, y: 0.24 },
				{ t: 6200, x: 0.10, y: 0.46 },
				{ t: 7400, x: 0.90, y: 0.44 },
				{ t: 8800, x: 0.50, y: 0.26, big: true }
			];
			seq.forEach(function (s) { setTimeout(function () { burstAt(s.x, s.y, s.big); }, s.t); });
		}
	}

	if (!reduce && window.tsParticles) {
		tsParticles.load({
			id: "ks-aniv-particles",
			options: {
				fullScreen: { enable: false },
				fpsLimit: 60,
				particles: {
					number: { value: 160, density: { enable: true, area: 800 } },
					color: { value: ["#FEA4A4", "#87E9CE", "#FFBDBE", "#BADEDA"] },
					shape: { type: ["circle", "star"], options: { star: { sides: 5 } } },
					opacity: { value: { min: 0.15, max: 0.85 }, animation: { enable: true, speed: 1.4, sync: false } },
					size: { value: { min: 0.5, max: 3 }, animation: { enable: true, speed: 3, sync: false, startValue: "random" } },
					move: { enable: true, speed: 0.6, direction: "top", random: true, straight: false, outModes: { default: "out" } },
					shadow: { enable: true, color: "#FEA4A4", blur: 3 },
					twinkle: { particles: { enable: true, frequency: 0.06, opacity: 1 } }
				},
				detectRetina: true
			}
		});
	}
})();
