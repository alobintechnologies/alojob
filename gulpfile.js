var elixir = require('laravel-elixir');

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

elixir(function(mix) {
    mix.sass('app.scss')
        .version('public/css/app.css');

    mix.scripts([
      'jquery.js',
      'jquery-ui.min.js',
      'bootstrap.min.js',
      'summernote.min.js',
      'dropzone.js',
      'dmuploader.min.js',
      'alo-framework.js',
      // clients module
      'clients/client-service.js',
      // projects module
      'projects/project-service.js',
      'projects/project-controller.js',
      // comments module
      'comments/comment-service.js',
      'comments/comment-controller.js',
      // tickets module
      'tickets/ticket-controller.js',
      // quotes module
      'quotes/quote-controller.js'
    ], 'public/js/app.js');
});
