// webpack.mix.js

let mix = require("laravel-mix");
require("laravel-mix-workbox");
require('laravel-mix-compress');

mix.js("resources/js/app.js", "public/js")
    .extract()
    .vue({ version: 3 })
    .disableNotifications()
    .sourceMaps()
    .postCss("resources/css/app.css", "public/css", [])
    .generateSW({
        maximumFileSizeToCacheInBytes: 5000000,
    })
    .compress()
    .version();
