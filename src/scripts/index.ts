import type {Alpine} from 'alpinejs';
import alpine from 'alpinejs';
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
	// eslint-disable-next-line no-var
	var alpine: Alpine;
}
type AlpineCallback = (alpine: Alpine) => void;

alpine.plugin(ui as AlpineCallback);
alpine.plugin(focus as AlpineCallback);

window.alpine = alpine;
alpine.start();
