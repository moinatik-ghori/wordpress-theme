module.exports = {
	proxy: 'http://localhost/your-wordpress-site', // Change to your local WordPress URL
	files: [
		'**/*.php',
		'dist/**/*.css',
		'dist/**/*.js',
	],
	watchOptions: {
		ignoreInitial: true,
	},
	open: false,
	notify: false,
};

