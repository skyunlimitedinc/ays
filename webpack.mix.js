let mix = require("laravel-mix");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

/*
mix.autoload({
  retinajs: "retinajs"
});
*/

mix
  .js("resources/js/app.js", "public/js")
  .extract(["retinajs"])
  .sass("resources/sass/app.scss", "public/css")
  .browserSync("acs.test");

if (!mix.inProduction()) {
  mix
    .webpackConfig({
      devtool: "source-map"
    })
    .sourceMaps();
}
