const path = require('path');
const mix = require('laravel-mix');
const WebpackObfuscator = require('webpack-obfuscator');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
  .setPublicPath('public')
  .js(['resources/js/app.js', 'resources/js/load-image.js'], 'public/js')
  .js('resources/js/charts.js', 'public/js')
  .js('resources/js/active-menu-link.js', 'public/js')
  .js('resources/js/typeit.js', 'public/js')
  .js('resources/js/carousel.js', 'public/js')
  .postCss('resources/css/app.css', 'public/css')
  .sass('resources/sass/app.scss', 'public/css')
  .alias({ '@': path.resolve('resources/js') })
  .webpackConfig({
    plugins: [
      new WebpackObfuscator(
        {
          rotateStringArray: true,
        },
        ['excluded_bundle_name.js']
      ),
    ],
  })
  .version()
  .browserSync('http://0.0.0.0:8000')
  .disableNotifications();
