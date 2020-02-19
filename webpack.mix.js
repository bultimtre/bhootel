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
<<<<<<< HEAD
<<<<<<< HEAD
   .sass('resources/sass/app.scss', 'public/css');

=======
=======
   .copy('resources/images', 'public/images')
>>>>>>> 4e3a7a73bcdc7bd5e0512a10460e14e21c82a5c4
   .sass('resources/sass/app.scss', 'public/css')
   .browserSync({
      proxy: 'localhost:8000',
      open: false,
      notify: false
   });
>>>>>>> 950b94da2e35771fe1109cbb86337a3b0322504a
pluto