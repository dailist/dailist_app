import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Init visitor chart (admin) — import Chart.js dynamically and initialize when DOM ready
import Chart from 'chart.js/auto';

document.addEventListener('DOMContentLoaded', () => {
	try {
		const el = document.getElementById('visitorChart');
		if (!el) return;

		const labels = JSON.parse(el.getAttribute('data-labels') || '[]');
		const values = JSON.parse(el.getAttribute('data-values') || '[]');

		// ensure numeric values
		const numericValues = values.map(v => Number(v) || 0);
		const initialMax = numericValues.length ? Math.max(...numericValues) : 0;
		const yTicks = { precision: 0 };
		if (initialMax <= 10) {
			yTicks.stepSize = 1;
		}

		const ctx = el.getContext && el.getContext('2d') ? el.getContext('2d') : el;
		// destroy previous chart if exists
		if (ctx && ctx._visitorChart instanceof Chart) {
			try { ctx._visitorChart.destroy(); } catch(e) { /* ignore */ }
		}

		ctx._visitorChart = new Chart(ctx, {
			type: 'line',
			data: {
				labels: labels,
				datasets: [{
					label: 'Visitors',
					data: numericValues,
					fill: true,
					backgroundColor: 'rgba(99,102,241,0.08)',
					borderColor: 'rgba(99,102,241,1)',
					tension: 0.25,
					pointRadius: 3,
				}]
			},
			options: {
				responsive: true,
				scales: {
					y: {
						beginAtZero: true,
						max: initialMax > 0 ? initialMax : undefined,
						ticks: yTicks
					}
				}
			}
		});

		// Polling: refresh chart data every 30 seconds
		const refreshChartData = async () => {
			try {
				// request unique visitors by IP by default (shows number of unique visitors)
				const res = await fetch('/admin/visits-data?metric=unique_ip', { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
				if (!res.ok) return;
				const json = await res.json();
				const newLabels = json.labels || [];
				const newData = (json.data || []).map(v => Number(v) || 0);
				ctx._visitorChart.data.labels = newLabels;
				ctx._visitorChart.data.datasets[0].data = newData;
				// adjust Y axis to actual data maximum and integer ticks
				const newMax = newData.length ? Math.max(...newData) : 0;
				ctx._visitorChart.options.scales.y.max = newMax > 0 ? newMax : undefined;
				if (!ctx._visitorChart.options.scales.y.ticks) ctx._visitorChart.options.scales.y.ticks = {};
				ctx._visitorChart.options.scales.y.ticks.precision = 0;
				if (newMax <= 10) {
					ctx._visitorChart.options.scales.y.ticks.stepSize = 1;
				} else {
					delete ctx._visitorChart.options.scales.y.ticks.stepSize;
				}
				ctx._visitorChart.update();
			} catch (e) {
				console.error('Failed to refresh visitor chart', e);
			}
		};

		// start polling after a short delay (initial refresh after 5s, then every 5s)
		setTimeout(() => {
			refreshChartData();
			setInterval(refreshChartData, 5_000);
		}, 5_000);
	} catch (err) {
		console.error('Visitor chart init error:', err);
	}
});
