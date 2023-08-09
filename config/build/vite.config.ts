import {defineConfig} from 'vite';
import manifestSRI from 'vite-plugin-manifest-sri';
import viteRestart from 'vite-plugin-restart';
import {viteStaticCopy} from 'vite-plugin-static-copy';
import autoprefixer from 'autoprefixer';
import tailwindcss from 'tailwindcss';
import okLab from '@csstools/postcss-oklab-function';
import type {Plugin} from 'postcss';
import tailwindConfig from './tailwind.config.js';

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
				cp: 'src/scripts/cp.ts',
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
					src: 'src/public/favicon/favicon.ico',
					dest: '..',
				},
			],
		}),
	],
	server: {
		origin: 'https://boilerplate.local:3000',
		host: '0.0.0.0',
		port: 3000,
	},
	css: {
		postcss: {
			plugins: [tailwindcss(tailwindConfig) as Plugin, autoprefixer(), okLab()],
		},
	},
	resolve: {
		alias: {
			'@scripts': '/src/scripts', // eslint-disable-line @typescript-eslint/naming-convention
			'@styles': '/src/styles', // eslint-disable-line @typescript-eslint/naming-convention
			'@fonts': '/src/fonts', // eslint-disable-line @typescript-eslint/naming-convention
		},
	},
	publicDir: 'src/public',
}));
