var Encore = require('@symfony/webpack-encore');

require('dotenv').config()

var publicPath = process.env.APP_PUBLIC_PATH
if (Encore.isProduction()) {
    publicPath = process.env.APP_PUBLIC_PATH
}


Encore
// directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // public path used by the web server to access the output path
    .setPublicPath(publicPath)
    // only needed for CDN's or sub-directory deploy
    .setManifestKeyPrefix('build/')

    /*
     * ENTRY CONFIG
     *
     * Add 1 entry for each "page" of your app
     * (including one that's included on every page - e.g. "app")
     *
     * Each entry will result in one JavaScript file (e.g. app.js)
     * and one CSS file (e.g. app.css) if you JavaScript imports CSS.
     */
    .addEntry('js/main', './assets/js/main.js')
    .addEntry('js/adminlte', './assets/js/adminlte.js')
    .addEntry('js/charts', './assets/js/charts.js')
    .addEntry('js/app', './assets/js/vue.js')
    .addEntry('js/login', './assets/js/login.js')
    .addEntry('js/functions', './assets/js/functions.js')

    .addStyleEntry('css/main', './assets/css/main.scss')
    .addStyleEntry('css/adminlte', './assets/css/adminlte.scss')
    .addStyleEntry('css/charts', './assets/css/charts.scss')
    .addStyleEntry('css/app', './assets/css/app.scss')
    .addStyleEntry('css/login', './assets/css/login.scss')

    .enableVueLoader()

    // When enabled, Webpack "splits" your files into smaller pieces for greater optimization.
    .splitEntryChunks()

    // will require an extra script tag for runtime.js
    // but, you probably want this, unless you're building a single-page app
    .enableSingleRuntimeChunk()

    /*
     * FEATURE CONFIG
     *
     * Enable & configure other features below. For a full
     * list of features, see:
     * https://symfony.com/doc/current/frontend.html#adding-more-features
     */
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    // enables hashed filenames (e.g. app.abc123.css)
    .enableVersioning(Encore.isProduction())

    // enables Sass/SCSS support
    .enableSassLoader()
    // .enableSassLoader(function (sassOptions) {
    // }, {
    //     resolveUrlLoader: false
    // })

    // uncomment if you use TypeScript
    //.enableTypeScriptLoader()

    // uncomment if you're having problems with a jQuery plugin
    // .autoProvidejQuery()

// uncomment if you use API Platform Admin (composer req api-admin)
//.enableReactPreset()
//.addEntry('admin', './assets/js/admin.js')
;

module.exports = Encore.getWebpackConfig();
