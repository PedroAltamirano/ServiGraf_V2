const mix = require('laravel-mix');

var webpackConfig = {
   // plugins: [
   //    new CaseSensitivePathsPlugin()
   // ]

   // resolve: {
   //    alias: {
   //    }
   // }
}

mix.webpackConfig(webpackConfig);

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

mix
  .js('resources/js/app.js', 'public/js')
  .js('resources/js/helpers.js', 'public/js')
  .js('resources/js/trumbowyg.js', 'public/js')
  .sass('resources/sass/app.scss', 'public/css')
  .sass('resources/sass/styles.scss', 'public/css')
  .sass('resources/sass/trumbowyg.scss', 'public/css');
