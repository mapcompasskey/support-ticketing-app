var elixir = require('laravel-elixir');
require('laravel-elixir-compass');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    // compile SASS
    // resources/assets/sass/app.scss -> resources/css/app.css
    //mix.sass('app.scss', 'resources/css');

    // compile SASS
    mix.compass('app.scss', 'resources/css', {
        sass: 'resources/assets/sass',
        style: 'nested' // nested, compressed, expanded
    });

    // combine stylesheets together into a single file
    // default root: resources/css/
    // default output: public/css/all.css
    mix.styles([
        //'libs/select2.min.css',
        '../../public/css/fonts/glyphicons.css',
        '../../public/css/fonts/roboto.css',
        'app.css'
    ], 'public/css/app.css');

    // combine javascript files into a single file
    // default root: resources/js/
    // default output: public/js/all.js
    mix.scripts([
        'app.js',
        'libs/jquery.min.js',
        //'libs/select2.min.js'
    ], 'public/js/app.js');

});
