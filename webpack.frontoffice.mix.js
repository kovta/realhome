const mix = require('laravel-mix'); //  Laravel mix

//  This extension support multi mix configration
//  without overwriting the mix-manifest.json file:
require('laravel-mix-merge-manifest');

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

//  frontoffice:
mix.js('resources/js/frontoffice/frontoffice.js', 'public/js/frontoffice/frontoffice.js').vue()
    .extract(['lodash',
            'jquery',
            'popper.js',
            'bootstrap',
            'bootstrap-datepicker',
            'bootstrap-select',
            'axios'])
    .sass('resources/sass/frontoffice/frontoffice.scss', 'public/css/frontoffice/frontoffice.css')
    .version()
    // .mergeManifest()

//  Homex megfelelő helyre pakolása
mix.copy('resources/js/frontoffice/homex', 'public/vendor/homex');

//  A tinymce skin-ek elérése, sajnos csak így megy:
//  Hogy miért, az itt van leírva: https://www.tiny.cloud/docs-4x/advanced/usage-with-module-loaders/#webpackfile-loader
//mix.copy('node_modules/tinymce/skins', 'public/js/skins');
//  A tinymce saját fordítások végleges helyre másolása:
//  TODO: alábbit erre próbálom cserélni: npm tinymce-i18n
//mix.copy('resources/js/lang/tinymce', 'public/js/lang/tinymce');
//  képek
mix.copy('resources/images', 'public/images');
mix.copy('resources/svg', 'public/svg');
//  special print css
mix.sass('resources/sass/global/printable/default-print.scss', 'public/css/global/printable/default-print.css');
mix.sass('resources/sass/global/printable/datapage-routes.scss', 'public/css/global/printable/datapage-routes.css');
mix.sass('resources/sass/global/printable/datapage-real-estates.scss', 'public/css/global/printable/datapage-real-estates.css');
