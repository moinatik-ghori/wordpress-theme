import { defineConfig } from 'vite';
import { resolve } from 'path';

export default defineConfig({
	build: {
		outDir: 'dist',
		emptyOutDir: true,
		manifest: true,
		rollupOptions: {
			input: {
				'main': resolve(__dirname, 'src/scss/main.scss'),
				'editor-style': resolve(__dirname, 'src/scss/editor-style.scss'),
				'theme-core': resolve(__dirname, 'src/js/theme-core.js'),
				'blocks': resolve(__dirname, 'src/js/blocks.js'),
				'github-api': resolve(__dirname, 'src/js/github-api.js'),
			},
			output: {
				entryFileNames: 'js/[name].js',
				chunkFileNames: 'js/[name]-[hash].js',
				assetFileNames: (assetInfo) => {
					if (assetInfo.name.endsWith('.css')) {
						return 'css/[name][extname]';
					}
					return 'assets/[name]-[hash][extname]';
				},
			},
		},
	},
	css: {
		preprocessorOptions: {
			scss: {
				additionalData: `@use "src/scss/abstracts/variables" as *;`,
			},
		},
	},
	server: {
		port: 3000,
		strictPort: false,
	},
});

