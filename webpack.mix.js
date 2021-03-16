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
    .styles('resources/css/all.css', 'public/css/all.min.css').version()
    .styles('resources/css/demo.css', 'public/css/demo.min.css').version()
    .styles('resources/css/bootstrap.css', 'public/css/bootstrap.min.css').version()
    .styles('resources/css/style.css', 'public/css/style.min.css').version()
    .styles('resources/css/obra.css', 'public/css/obras.min.css').version()
    .styles('resources/css/home.css', 'public/css/home.min.css').version()
    .styles('node_modules/sweetalert2/dist/sweetalert2.css', 'public/css/sweetalert2.min.css')
    .styles('resources/css/funcionarios.css', 'public/css/funcionarios.min.css').version()
    .styles('resources/css/clientes.css', 'public/css/clientes.min.css').version()
    .styles('resources/css/lojas.css', 'public/css/lojas.min.css').version()
    .styles('resources/css/fonts.css', 'public/css/fonts.min.css').version()
    .styles(['resources/datatables/datatables.css', 'resources/datatables/responsive.datatables.css'], 'public/datatables/datatables.min.css').version()
    .sass('resources/fonts/flaticon/_flaticon.scss', 'public/fonts/flaticon/flaticon.min.css').version()
    .sass('resources/sass/atlantis.scss', 'public/css/atlantis.min.css').version()
    .scripts('resources/js/plugin/webfont/webfont.js', 'public/js/plugin/webfont/webfont.min.js').version()
    .scripts('resources/js/core/jquery.3.2.1.js', 'public/js/core/jquery.3.2.1.min.js').version()
    .scripts('resources/js/core/popper.js', 'public/js/core/popper.min.js').version()
    .scripts('resources/js/core/bootstrap.js', 'public/js/core/bootstrap.min.js').version()
    .scripts('resources/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.js', 'public/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js').version()
    .scripts('resources/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.js', 'public/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js').version()
    .scripts('resources/js/plugin/jquery-scrollbar/jquery.scrollbar.js', 'public/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js').version()
    .scripts('resources/js/plugin/chart.js/chart.js', 'public/js/plugin/chart.js/chart.min.js').version()
    .scripts('resources/js/plugin/jquery.sparkline/jquery.sparkline.js', 'public/js/plugin/jquery.sparkline/jquery.sparkline.min.js').version()
    .scripts('resources/js/plugin/jquery-mask/jquery.mask.js', 'public/js/plugin/jquery-mask/jquery.mask.min.js').version()
    .scripts('resources/js/plugin/chart-circle/circles.js', 'public/js/plugin/chart-circle/circles.min.js').version()
    .scripts(['resources/datatables/datatables.js', 'resources/datatables/datatables.responsive.js'], 'public/datatables/datatables.min.js').version()
    .scripts('resources/js/plugin/bootstrap-notify/bootstrap-notify.js', 'public/js/plugin/bootstrap-notify/bootstrap-notify.min.js').version()
    .scripts('resources/js/plugin/sweetalert/sweetalert.js', 'public/js/plugin/sweetalert/sweetalert.min.js').version()
    .scripts('node_modules/sweetalert2/dist/sweetalert2.all.js', 'public/js/plugin/sweetalert2/sweetalert2.min.js').version()
    .scripts('resources/js/atlantis.js', 'public/js/atlantis.min.js').version()
    .scripts('resources/js/script.js', 'public/js/script.min.js').version()
    .scripts('resources/js/all.js', 'public/js/all.min.js')
    .scripts('resources/js/obras.js', 'public/js/obras.min.js').version()
    .scripts('resources/js/home.js', 'public/js/home.min.js').version()
    .scripts('resources/js/clientes.js', 'public/js/clientes.min.js').version()
    .scripts('resources/js/lojas.js', 'public/js/lojas.min.js').version()
    .scripts('resources/js/login.js', 'public/js/login.min.js').version()
    .scripts('resources/js/funcionarios.js', 'public/js/funcionarios.min.js').version();
