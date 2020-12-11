const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
    .styles('resources/css/all.css', 'public/css/all.min.css')
    .styles('resources/css/demo.css', 'public/css/demo.min.css')
    .styles('resources/css/bootstrap.css', 'public/css/bootstrap.min.css')
    .styles('resources/css/style.css', 'public/css/style.min.css')
    .styles('resources/css/fonts.css', 'public/css/fonts.min.css')
    .styles('resources/datatables/datatables.css', 'public/datatables/datatables.min.css')
    .sass('resources/fonts/flaticon/_flaticon.scss', 'public/fonts/flaticon/flaticon.min.css')
    .sass('resources/sass/atlantis.scss', 'public/css/atlantis.min.css')
    .scripts('resources/js/plugin/webfont/webfont.js', 'public/js/plugin/webfont/webfont.min.js')
    .scripts('resources/js/core/jquery.3.2.1.js', 'public/js/core/jquery.3.2.1.min.js')
    .scripts('resources/js/core/popper.js', 'public/js/core/popper.min.js')
    .scripts('resources/js/core/bootstrap.js', 'public/js/core/bootstrap.min.js')
    .scripts('resources/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.js', 'public/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js')
    .scripts('resources/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.js', 'public/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js')
    .scripts('resources/js/plugin/jquery-scrollbar/jquery.scrollbar.js', 'public/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')
    .scripts('resources/js/plugin/chart.js/chart.js', 'public/js/plugin/chart.js/chart.min.js')
    .scripts('resources/js/plugin/jquery.sparkline/jquery.sparkline.js', 'public/js/plugin/jquery.sparkline/jquery.sparkline.min.js')
    .scripts('resources/js/plugin/chart-circle/circles.js', 'public/js/plugin/chart-circle/circles.min.js')
    .scripts('resources/datatables/datatables.js', 'public/datatables/datatables.min.js')
    .scripts('resources/js/plugin/bootstrap-notify/bootstrap-notify.js', 'public/js/plugin/bootstrap-notify/bootstrap-notify.min.js')
    .scripts('resources/js/plugin/sweetalert/sweetalert.js', 'public/js/plugin/sweetalert/sweetalert.min.js')
    .scripts('resources/js/atlantis.js', 'public/js/atlantis.min.js')
    .scripts('resources/js/script.js', 'public/js/script.min.js')
    .scripts('resources/js/obras.js', 'public/js/obras.min.min.js')
    .scripts('resources/js/clientes.js', 'public/js/clientes.min.js')
    .scripts('resources/js/login.js', 'public/js/login.min.js')
    .scripts('resources/js/funcionarios.js', 'public/js/funcionarios.min.js');
