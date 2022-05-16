const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        require("tailwindcss"),
    ]);
mix.copyDirectory('node_modules/tinymce/icons', 'public/vendors/plugins/tinymce/icons');
mix.copyDirectory('node_modules/tinymce/plugins', 'public/vendors/plugins/tinymce/plugins');
mix.copyDirectory('node_modules/tinymce/skins', 'public/vendors/plugins/tinymce/skins');
mix.copyDirectory('node_modules/tinymce/themes', 'public/vendors/plugins/tinymce/themes');
mix.copy('node_modules/tinymce/tinymce.js', 'public/vendors/plugins/tinymce/tinymce.js');
mix.copy('node_modules/tinymce/tinymce.min.js', 'public/vendors/plugins/tinymce/tinymce.min.js');