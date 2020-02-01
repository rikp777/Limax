const mix = require('laravel-mix');
mix.options({
    hmrOptions: {
        host: '127.0.0.1',
        port: 8081
    }
});

if (process.env.NODE_ENV === 'production') {
    mix.sass('resources/assets/sass/app.scss', 'public/css')
        .js('resources/js/app.js', 'public/js');
}else{
    mix.js('resources/js/app.js', 'public/js')
        .sass('resources/assets/sass/app.scss', 'public/css')
}

