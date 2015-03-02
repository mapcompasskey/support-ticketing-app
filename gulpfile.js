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

    // if running "glup --production"
    var inProduction = elixir.config.production;

    // If not production, just update SASS files
    if ( ! inProduction)
    {
        // compile SASS
        // resources/assets/sass/app.scss -> public/css/app.css
        mix.compass('app.scss', 'public/css', {
            sass: 'resources/assets/sass',
            style: 'expanded'
        });
    }

    // Else, combine and minify all CSS and JS files
    else
    {
        // Compile SASS
        // resources/assets/sass/app.scss -> resources/css/app.css
        //*this appears to be adding 'css/app.css' to the root directory
        mix.compass('app.scss', 'resources/css', {
            sass: 'resources/assets/sass',
            style: 'compressed'
        });

        // Combine stylesheets
        // resources/css/[...] -> public/css/app.min.css
        mix.styles([
            '../../public/css/fonts/glyphicons.css',
            '../../public/css/fonts/roboto.css',
            '../../public/css/libs/select2.min.css',
            'app.css'
        ], 'public/css/app.min.css');

        // Combine javascript files
        // public/js/[...] -> public/js/app.min.js
        mix.scripts([
            'libs/jquery.min.js',
            'libs/select2.min.js',
            'app.js'
        ], 'public/js/app.min.js', 'public/js');
    }

});
