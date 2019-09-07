const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .styles([
	    'resources/css/admin/materialize.min.css',
	    'resources/css/admin/custom.css'
	], 'public/css/admin/styles.css')
	.scripts([
		'resources/js/jquery-3.4.1.min.js',
	    'resources/js/admin/materialize.min.js',
	    'resources/js/admin/custom.js'
	], 'public/js/admin/scripts.js');
