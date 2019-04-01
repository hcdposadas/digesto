var Encore = require('@symfony/webpack-encore');
const CopyWebpackPlugin = require('copy-webpack-plugin');
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
    .addEntry('js/datatables', './assets/js/datatables.js')
    .addEntry('js/web', './assets/js/web.js')

    .addStyleEntry('css/main', './assets/css/main.scss')
    .addStyleEntry('css/adminlte', './assets/css/adminlte.scss')
    .addStyleEntry('css/charts', './assets/css/charts.scss')
    .addStyleEntry('css/app', './assets/css/app.scss')
    .addStyleEntry('css/login', './assets/css/login.scss')
    .addStyleEntry('css/datatables', './assets/css/datatables.scss')
    .addStyleEntry('css/web', './assets/css/web.scss')

    // imgs
    .addPlugin(new CopyWebpackPlugin([
        // copies to {output}/static
        { from: './assets/images', to: 'images' }
    ]))

    .copyFiles([
        {from: './node_modules/ckeditor/', to: 'ckeditor/[path][name].[ext]', pattern: /\.(js|css)$/, includeSubdirectories: false},
        {from: './node_modules/ckeditor/adapters', to: 'ckeditor/adapters/[path][name].[ext]'},
        {from: './node_modules/ckeditor/lang', to: 'ckeditor/lang/[path][name].[ext]'},
        {from: './node_modules/ckeditor/plugins', to: 'ckeditor/plugins/[path][name].[ext]'},
        {from: './node_modules/ckeditor/skins', to: 'ckeditor/skins/[path][name].[ext]'}
    ])

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
