const { defineConfig } = require('@vue/cli-service')
module.exports = defineConfig({
    baseUrl: '/',
    publicPath: '/',
    transpileDependencies: true,
    configureWebpack: {
        devtool: 'source-map',
    }
})
