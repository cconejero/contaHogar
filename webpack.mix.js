// webpack.mix.js

let mix = require("laravel-mix");
require('laravel-mix-workbox');

mix.js("resources/js/app.js", "public/js")
    .extract()
    .vue({
        globalVueStyles: "resources/assets/css/variables.scss",
    })
    .disableNotifications()
    .postCss("resources/css/app.css", "public/css", [])
    .generateSW({
        maximumFileSizeToCacheInBytes: 3000000
    })
    .version();
