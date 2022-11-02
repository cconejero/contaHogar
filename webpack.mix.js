// webpack.mix.js

let mix = require("laravel-mix");
require("laravel-mix-workbox");
require('laravel-mix-compress');

mix.js("resources/js/app.js", "public/js")
    .vue({ version: 3 })
    .extract()
    .disableNotifications()
    .css("resources/css/app.css", "public/css", [])
    .sourceMaps()
    .generateSW({
        maximumFileSizeToCacheInBytes: 5000000,
    })
    .version();
