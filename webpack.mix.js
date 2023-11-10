let mix = require('laravel-mix');



// your Wordpress theme name here
// var themename = "";

// const themePath = 'wp-content/themes/' + themename + '';
// const resources = themePath + '/assets/src';

mix.setPublicPath(`assets/dist/`);

mix.sass(`assets/src/scss/styles.scss`, `dist/css`).sourceMaps();
mix.sass(`assets/src/scss/login-styles.scss`, `dist/css`).sourceMaps();
mix.sass(`assets/src/scss/critical.scss`, `dist/css`).sourceMaps();

mix.js('assets/src/js/scripts.js', 'assets/dist/js/scripts.js').vue();

mix.copy('assets/src/img/', 'assets/dist/img/');

mix.browserSync({
	proxy: 'https://baseinstall:8890/', // Your local url, should match what you have in wp-config
	files: [`**/*.php`, `assets/src/js/**/*.js`, `assets/src/scss/**/*.scss`],
});

// ## One off compilation
// npx mix

// ## Watch command for active development
// npx mix watch
