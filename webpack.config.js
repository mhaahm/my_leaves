var Encore = require('@symfony/webpack-encore');

Encore
    // directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // public path used by the web server to access the output path
    .setPublicPath('/build')
    // only needed for CDN's or sub-directory deploy
    //.setManifestKeyPrefix('build/')

    /*
     * ENTRY CONFIG
     *
     * Add 1 entry for each "page" of your app
     * (including one that's included on every page - e.g. "app")
     *
     * Each entry will result in one JavaScript file (e.g. app.js)
     * and one CSS file (e.g. app.css) if you JavaScript imports CSS.
     */
    .addEntry('app', './assets/js/app.js')

    //.addEntry('page2', './assets/js/page2.js')

     //  add css
    .addEntry('appcss','./assets/css/app.css')
    .addEntry('bootstrap','./assets/css/bootstrap.css')
    .addEntry('themify','./assets/vendors/themify/css/themify-icons.css')
    .addEntry('iCheck','./assets/vendors/iCheck/css/all.css')
    .addEntry('bootstrapvalidator','./assets/vendors/bootstrapvalidator/css/bootstrapValidator.min.css')
    .addEntry('login','./assets/css/login.css')
    .addEntry('swiper','./assets/vendors/swiper/css/swiper.min.css')
    .addEntry('nvd3','./assets/vendors/nvd3/css/nv.d3.min.css')
    .addEntry('lcswitch','./assets/vendors/lcswitch/css/lc_switch.css')
    .addEntry('custom','./assets/css/custom.css')
    .addEntry('skin-default','./assets/css/custom_css/skins/skin-default.css')
    .addEntry('dashboard1','./assets/css/custom_css/dashboard1.css')
    .addEntry('dashboard2','./assets/css/custom_css/dashboard1_timeline.css')
    .addEntry('tabcss','./assets/css/tab.css')
    .addEntry('vendor_sweet_alert2','./assets/vendors/sweetalert2/css/sweetalert2.min.css')
    .addEntry('sweet_alert2','./assets/css/custom_css/sweet_alert2.css')
    .addEntry('toastr','./assets/vendors/toastr/css/toastr.min.css')
    .addEntry('toastr_notificatons','./assets/css/custom_css/toastr_notificatons.css')
    .addEntry('vendor_bootstrap_table','./assets/vendors/bootstrap-table/css/bootstrap-table.min.css')
    .addEntry('custom_bootstrap_table','./assets/css/custom_css/bootstrap_tables.css')
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
    .autoProvideVariables({
        "Routing": "router"
    })
    .addLoader({
        test: /jsrouting-bundle\/Resources\/public\/js\/router.js$/,
        loader: "exports-loader?router=window.Routing"
    })

    let config = Encore.getWebpackConfig();
    config.resolve.alias = {
        'router': __dirname + '/assets/js/router.js'
    };

    // enables Sass/SCSS support
    //.enableSassLoader()

    // uncomment if you use TypeScript
    //.enableTypeScriptLoader()

    // uncomment if you're having problems with a jQuery plugin
    //.autoProvidejQuery()

    // uncomment if you use API Platform Admin (composer req api-admin)
    //.enableReactPreset()
    //.addEntry('admin', './assets/js/admin.js')
;

module.exports = config;
