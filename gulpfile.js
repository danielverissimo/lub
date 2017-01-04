const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');


/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

elixir((mix) => {
    mix.sass('app.scss').webpack('app.js');
    mix.version(['css/app.css', 'js/app.js']);
    mix.copy('resources/assets/sass/fontawesome/fonts', 'public/build/fonts');
    mix.copy('resources/assets/css/ns-default.css', 'public/build/css');
    mix.copy('resources/assets/css/ns-style-growl.css', 'public/build/css');
    mix.copy('resources/assets/css/ns-style-theme.css', 'public/build/css');
    mix.copy('resources/assets/css/bootstrap-datepicker.min.css', 'public/build/css');
    mix.copy('node_modules/bootstrap-sass/assets/fonts/bootstrap/','public/build/fonts/bootstrap');
});