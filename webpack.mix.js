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
   .sass('resources/sass/app.scss', 'public/css');

// mix.webpackConfig({
//     const VueLoaderPlugin = require('vue-loader/lib/plugin'),
//
//     module.exports = {
//         module: {
//             rules: [
//                 // ... other rules
//                 {
//                     test: /\.vue$/,
//                     loader: 'vue-loader'
//                 }
//             ]
//         },
//         plugins: [
//             // make sure to include the plugin!
//             new VueLoaderPlugin()
//         ]
//     }
// });
