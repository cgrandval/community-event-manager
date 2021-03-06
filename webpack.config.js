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
    .addEntry('base', './assets/js/base.js')
    .addEntry('edit_sponsorship_level_benefit', './assets/js/sponsorshipLevelBenefit/edit.js')
    .addEntry("add_slot", "./assets/js/schedule/slot/add_slot.js")
    .addEntry("edit_slot", "./assets/js/schedule/slot/edit_slot.js")
    .addEntry('contact_edit', './assets/js/contact/edit.js')
    .addEntry("duplicate_day", "./assets/js/schedule/day/duplicate_day.js")
    .addEntry("add_day", "./assets/js/schedule/day/add_day.js")
    .addEntry("add_event", "./assets/js/event/add_event.js")
    .addEntry("upload_organisation", "./assets/js/organisation/upload_organisation.js")

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

    // uncomment if you use TypeScript
    //.enableTypeScriptLoader()

    // uncomment if you're having problems with a jQuery plugin
    .autoProvidejQuery()
;

module.exports = Encore.getWebpackConfig();
