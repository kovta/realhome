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

//  admin/backoffice:
//
mix.js('resources/js/backoffice/backoffice.js', 'public/js/backoffice/backoffice.js')
    .vue()
    .extract(['lodash',
            'jquery',
            'popper.js',
            'bootstrap',
            'bootstrap-datepicker',
            'bootstrap-select',
            'axios',
            'datatables.net-dt'
            ])
    .sass('resources/sass/backoffice/backoffice.scss', 'public/css/backoffice/backoffice.css')
    .version()
    // .mergeManifest();

//  A tinymce skin-ek és icon-ok elérése, sajnos csak így megy:
//  Hogy miért, az itt van leírva: https://www.tiny.cloud/docs-4x/advanced/usage-with-module-loaders/#webpackfile-loader
//  Chrome-on teszteld! 404-et a Mozilla FFox nem jelzi ki vmiért..
mix.copy('node_modules/tinymce/skins', 'public/js/backoffice/skins');
mix.copy('node_modules/tinymce/icons', 'public/js/backoffice/icons');
//  A tinymce saját fordítások:
mix.copy('resources/js/lang/tinymce', 'public/lang/tinymce');
//  a datatables fordítások:
mix.copy('resources/js/lang/datatables', 'public/lang/datatables');
//  képek:
mix.copy('resources/images', 'public/images');
mix.copy('resources/svg', 'public/svg');
//  special print css
mix.sass('resources/sass/global/printable/default-print.scss', 'public/css/global/printable/default-print.css');
mix.sass('resources/sass/global/printable/datapage-routes.scss', 'public/css/global/printable/datapage-routes.css');
mix.sass('resources/sass/global/printable/datapage-real-estates.scss', 'public/css/global/printable/datapage-real-estates.css');
