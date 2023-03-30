import type {Alpine as AlpineType} from 'alpinejs';
import Alpine from 'alpinejs';
import ui from '@alpinejs/ui';
import focus from '@alpinejs/focus';
import '@styles/index.css';

// Accept HMR as per: https://vitejs.dev/guide/api-hmr.html
if (import.meta.hot) {
	import.meta.hot.accept(() => {
		console.log('HMR');
	});
}

declare global {
	// eslint-disable-next-line @typescript-eslint/naming-convention, no-var
	var Alpine: AlpineType;
}

Alpine.plugin(ui);
Alpine.plugin(focus);

window.Alpine = Alpine;
Alpine.start();
