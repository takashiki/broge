const { mix } = require('laravel-mix');

mix.config.detectHotReloading();

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');

if (mix.config.inProduction) {
  mix.version();
  mix.disableNotifications();
}
