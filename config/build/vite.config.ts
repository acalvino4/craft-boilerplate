import {defineConfig} from 'vite';
import manifestSRI from 'vite-plugin-manifest-sri';
import viteRestart from 'vite-plugin-restart';
import {viteStaticCopy} from 'vite-plugin-static-copy';
import postcssConfig from './postcss.config.js';

export default defineConfig(({command}) => ({
	base: command === 'serve' ? '' : '/dist/',
	build: {
		reportCompressedSize: false,
		emptyOutDir: true,
		manifest: true,
		outDir: 'web/dist/',
		rollupOptions: {
			input: {
				app: 'src/scripts/index.ts',
			},
			output: {
				sourcemap: true,
			},
		},
	},
	plugins: [
		viteRestart({
			reload: ['templates/**/*'],
		}),
		manifestSRI(),
		viteStaticCopy({
			targets: [
				{
					src: 'src/favicon/*',
					dest: 'favicon/',
				},
				{
					src: 'src/favicon/favicon.ico',
					dest: '..',
				},
			],
		}),
	],
	server: {
		host: '0.0.0.0',
		port: 3000,
	},
	css: {
		postcss: postcssConfig,
	},
	resolve: {
		alias: {
			'@scripts': '/src/scripts', // eslint-disable-line @typescript-eslint/naming-convention
			'@styles': '/src/styles', // eslint-disable-line @typescript-eslint/naming-convention
			'@fonts': '/src/fonts', // eslint-disable-line @typescript-eslint/naming-convention
		},
	},
}));
