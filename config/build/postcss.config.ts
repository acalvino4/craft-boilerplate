import autoprefixer from 'autoprefixer';
import tailwindcss from 'tailwindcss';
import type {ProcessOptions, Plugin} from 'postcss';
import tailwindConfig from './tailwind.config.js';

type PostCssConfig = string | (ProcessOptions & {plugins?: Plugin[]});

const config: PostCssConfig = {
	plugins: [tailwindcss(tailwindConfig) as Plugin, autoprefixer()],
};

export default config;
