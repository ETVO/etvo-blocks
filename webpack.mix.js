// webpack.mix.js

let mix = require('laravel-mix');

mix.disableSuccessNotifications();

// Compile
mix.js('src/js/main.js', 'js')
.sass('src/scss/bootstrap.scss', 'css')
.sass('src/scss/main.scss', 'css')
.setPublicPath('assets');