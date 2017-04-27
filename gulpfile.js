const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

// elixir(mix => {
//     mix.sass('app.scss')
//        .webpack('app.js');
// });


elixir(mix => {
    mix.sass('resources/assets/sass/app.scss')
        .browserSync({
            proxy: 'http://127.0.0.1:8000'
        });

   mix.scripts([
        'app.js'
    ], 'public/js/app.js')

});
