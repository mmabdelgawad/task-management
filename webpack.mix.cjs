const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .vue()
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);

mix.options({
    hmrOptions: {
        host: 'localhost',
        port: '80'
    }
})

if (mix.inProduction()) {
    mix.version();
}
