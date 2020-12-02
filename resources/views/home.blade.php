<?php
if (!isset($_SESSION)) {
    session_start();
}
setlocale(LC_TIME, 'pt_BR.utf8');

use \Illuminate\Support\Facades\Auth;

$seo = array();
$seo['imagem'] = "images/logo.png";
$seo['url'] = "";

$head['author'] = 'Cristian Robert Belão de Meira Junior';
$head['copyright'] = '';
$seo['title'] = "Home | Belão&CIA Manegement System";
?>
    <!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <title><?php print $seo['title']; ?></title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport'/>
    <link rel="icon" href="{{route('home')}}/img/icon.ico" type="image/x-icon"/>

    <!-- Fonts and icons -->
    <script src="{{route('home')}}/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {"families": ["Lato:300,400,700,900"]},
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"],
                urls: ['assets/css/fonts.min.css']
            },
            active: function () {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{route('home')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{route('home')}}/css/atlantis.min.css">
    <link rel="stylesheet" href="{{route('home')}}/fonts/flaticon/flaticon.css">

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="{{route('home')}}/css/demo.css">
    <link rel="stylesheet" href="{{route('home')}}/css/all.css">
    <link rel="stylesheet" href="{{route('home')}}/css/style.css">
    <link rel="stylesheet" type="text/css" href="{{route('home')}}/datatables/datatables.min.css"/>
    <?php include 'seo/analytics.php'; ?>
</head>
<body data-background-color="{{Auth::user()->cor_background}}">
<div class="wrapper">
    <div class="main-header">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="{{Auth::user()->cor_header}}">

            <a href="{{route('home')}}" class="logo">
                <img src="{{route('home')}}/img/logo.svg" alt="navbar brand" class="navbar-brand">
            </a>
            <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse"
                    data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="icon-menu"></i>
					</span>
            </button>
            <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="icon-menu"></i>
                </button>
            </div>
        </div>
        <!-- End Logo Header -->

        <?php include("includes/navbar.blade.php");?>
    </div>
    <?php
    $MODULO = '';
    $func = '';
    include("includes/sidebar.blade.php")?>


    <div class="main-panel">
        <div class="content">
            <div class="panel-header bg-primary-gradient">
                <div class="page-inner py-5">
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                        <div>
                            <h2 class="text-white pb-2 fw-bold">Belão&CIA Manegement System</h2>
                            <h5 class="text-white op-7 mb-2">O sistema de gerenciamento de obra da empresa
                                Belão&CIA</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-inner mt--5">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Obras Ativas</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="display table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>Cliente</th>
                                    <th>Orçamento</th>
                                    <th>Gastos</th>
                                    <th>Endereço</th>
                                    <th>Data de Inicio</th>
                                    <th>Editar</th>
                                    <th>Concluir</th>
                                    <th>Faltas</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($obras as $obra)
                                    @if($obra->data_inicio != null && $obra->data_final == null)
                                        <?php
                                        if ($obra->data_inicio == null) {
                                            $obra->data_start = date('d/m/Y', strtotime($obra->data_inicio_prevista));
                                        } else {
                                            $obra->data_start = date('d/m/Y', strtotime($obra->data_inicio));
                                        }
                                        $obra->gastos = 0;
                                        $salarios = $obra->faltas()->where('obra', '=', $obra->id)->get();
                                        foreach ($salarios as $salario) {
                                            $funcionarios = $salario->funcionario()->get();
                                            foreach ($funcionarios as $funcionario) {
                                                if ($salario->meio_dia) {
                                                    $obra->gastos += $funcionario->salario_dia / 2;
                                                } else {
                                                    $obra->gastos += $funcionario->salario_dia;
                                                }
                                            }

                                        }
                                        ?>
                                        <tr>
                                            <td>{{$obra->cliente()->first()->nome}}</td>
                                            <td>R${{number_format($obra->orcamento, 2, ',', '.')}}</td>
                                            <td>R${{number_format($obra->gastos, 2, ',', '.')}}</td>
                                            <td>Rua {{$obra->rua}}, {{$obra->numero}} {{$obra->cidade}}
                                                -{{$obra->uf}}</td>
                                            <td>{{$obra->data_start}}</td>
                                            <td><a class=""
                                                   href="{{route('obras.edit', ['obra'=>$obra->id])}}"><i
                                                        class="fa fa-edit"></i></a></td>
                                            <td><a data-id="{{$obra->id}}" class="conclui" data-csrf="{{csrf_token()}}"
                                                   data-rota="{{route('obras.concluir', ['obra'=>$obra->id])}}"><i
                                                        class="fa fa-check"></i></a></td>
                                            <td><a href="{{route('obras.faltas', ['obra'=>$obra->id])}}"><i
                                                        class="fas fa-hard-hat"></i></a></td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom template | don't include it in your project! -->
    <div class="custom-template">
        <div class="title">Configurações</div>
        <div class="custom-content">
            <div class="switcher">
                <div class="switch-block">
                    <h4>Logo Header</h4>
                    <div class="btnSwitch">
                        <button type="button"
                                class="{{(Auth::user()->cor_header == 'dark')?'selected':''}} changeLogoHeaderColor"
                                data-color="dark"></button>
                        <button type="button"
                                class="{{(Auth::user()->cor_header == 'blue')?'selected':''}} changeLogoHeaderColor"
                                data-color="blue"></button>
                        <button type="button"
                                class="{{(Auth::user()->cor_header == 'purple')?'selected':''}} changeLogoHeaderColor"
                                data-color="purple"></button>
                        <button type="button"
                                class="{{(Auth::user()->cor_header == 'light-blue')?'selected':''}} changeLogoHeaderColor"
                                data-color="light-blue"></button>
                        <button type="button"
                                class="{{(Auth::user()->cor_header == 'green')?'selected':''}} changeLogoHeaderColor"
                                data-color="green"></button>
                        <button type="button"
                                class="{{(Auth::user()->cor_header == 'orange')?'selected':''}} changeLogoHeaderColor"
                                data-color="orange"></button>
                        <button type="button"
                                class="{{(Auth::user()->cor_header == 'red')?'selected':''}} changeLogoHeaderColor"
                                data-color="red"></button>
                        <button type="button"
                                class="{{(Auth::user()->cor_header == 'white')?'selected':''}} changeLogoHeaderColor"
                                data-color="white"></button>
                        <br/>
                        <button type="button"
                                class="{{(Auth::user()->cor_header == 'dark2')?'selected':''}} changeLogoHeaderColor"
                                data-color="dark2"></button>
                        <button type="button"
                                class="{{(Auth::user()->cor_header == 'blue2')?'selected':''}} changeLogoHeaderColor"
                                data-color="blue2"></button>
                        <button type="button"
                                class="{{(Auth::user()->cor_header == 'purple2')?'selected':''}} changeLogoHeaderColor"
                                data-color="purple2"></button>
                        <button type="button"
                                class="{{(Auth::user()->cor_header == 'light-blue2')?'selected':''}} changeLogoHeaderColor"
                                data-color="light-blue2"></button>
                        <button type="button"
                                class="{{(Auth::user()->cor_header == 'green2')?'selected':''}} changeLogoHeaderColor"
                                data-color="green2"></button>
                        <button type="button"
                                class="{{(Auth::user()->cor_header == 'orange2')?'selected':''}} changeLogoHeaderColor"
                                data-color="orange2"></button>
                        <button type="button"
                                class="{{(Auth::user()->cor_header == 'red2')?'selected':''}} changeLogoHeaderColor"
                                data-color="red2"></button>
                    </div>
                </div>
                <div class="switch-block">
                    <h4>Navbar Header</h4>
                    <div class="btnSwitch">
                        <button type="button"
                                class="{{(Auth::user()->cor_navbar == 'dark')?'selected':''}} changeTopBarColor"
                                data-color="dark"></button>
                        <button type="button"
                                class="{{(Auth::user()->cor_navbar == 'blue')?'selected':''}} changeTopBarColor"
                                data-color="blue"></button>
                        <button type="button"
                                class="{{(Auth::user()->cor_navbar == 'purple')?'selected':''}} changeTopBarColor"
                                data-color="purple"></button>
                        <button type="button"
                                class="{{(Auth::user()->cor_navbar == 'light-blue')?'selected':''}} changeTopBarColor"
                                data-color="light-blue"></button>
                        <button type="button"
                                class="{{(Auth::user()->cor_navbar == 'green')?'selected':''}} changeTopBarColor"
                                data-color="green"></button>
                        <button type="button"
                                class="{{(Auth::user()->cor_navbar == 'orange')?'selected':''}} changeTopBarColor"
                                data-color="orange"></button>
                        <button type="button"
                                class="{{(Auth::user()->cor_navbar == 'red')?'selected':''}} changeTopBarColor"
                                data-color="red"></button>
                        <button type="button"
                                class="{{(Auth::user()->cor_navbar == 'white')?'selected':''}} changeTopBarColor"
                                data-color="white"></button>
                        <br/>
                        <button type="button"
                                class="{{(Auth::user()->cor_navbar == 'dark2')?'selected':''}} changeTopBarColor"
                                data-color="dark2"></button>
                        <button type="button"
                                class="{{(Auth::user()->cor_navbar == 'blue2')?'selected':''}} changeTopBarColor"
                                data-color="blue2"></button>
                        <button type="button"
                                class="{{(Auth::user()->cor_navbar == 'purple2')?'selected':''}} changeTopBarColor"
                                data-color="purple2"></button>
                        <button type="button"
                                class="{{(Auth::user()->cor_navbar == 'light-blue2')?'selected':''}} changeTopBarColor"
                                data-color="light-blue2"></button>
                        <button type="button"
                                class="{{(Auth::user()->cor_navbar == 'green2')?'selected':''}} changeTopBarColor"
                                data-color="green2"></button>
                        <button type="button"
                                class="{{(Auth::user()->cor_navbar == 'orange2')?'selected':''}} changeTopBarColor"
                                data-color="orange2"></button>
                        <button type="button"
                                class="{{(Auth::user()->cor_navbar == 'red2')?'selected':''}} changeTopBarColor"
                                data-color="red2"></button>
                    </div>
                </div>
                <div class="switch-block">
                    <h4>Sidebar</h4>
                    <div class="btnSwitch">
                        <button type="button"
                                class="{{(Auth::user()->cor_sidebar == 'white')?'selected':''}} changeSideBarColor"
                                data-color="white"></button>
                        <button type="button"
                                class="{{(Auth::user()->cor_sidebar == 'dark')?'selected':''}} changeSideBarColor"
                                data-color="dark"></button>
                        <button type="button"
                                class="{{(Auth::user()->cor_sidebar == 'dark2')?'selected':''}} changeSideBarColor"
                                data-color="dark2"></button>
                    </div>
                </div>
                <div class="switch-block">
                    <h4>Background</h4>
                    <div class="btnSwitch">
                        <button type="button"
                                class="{{(Auth::user()->cor_background == 'bg2')?'selected':''}} changeBackgroundColor"
                                data-color="bg2"></button>
                        <button type="button"
                                class="{{(Auth::user()->cor_background == 'bg1')?'selected':''}} changeBackgroundColor"
                                data-color="bg1"></button>
                        <button type="button"
                                class="{{(Auth::user()->cor_background == 'bg3')?'selected':''}} changeBackgroundColor"
                                data-color="bg3"></button>
                        <button type="button"
                                class="{{(Auth::user()->cor_background == 'dark')?'selected':''}} changeBackgroundColor"
                                data-color="dark"></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="custom-toggle">
            <i class="flaticon-settings"></i>
        </div>
    </div>
    <!-- End Custom template -->
</div>
<!--   Core JS Files   -->
<script src="{{route('home')}}/js/core/jquery.3.2.1.min.js"></script>
<script src="{{route('home')}}/js/all.js"></script>
<script src="{{route('home')}}/js/core/popper.min.js"></script>
<script src="{{route('home')}}/js/core/bootstrap.min.js"></script>
<!-- jQuery UI -->
<script src="{{route('home')}}/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="{{route('home')}}/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

<!-- jQuery Scrollbar -->
<script src="{{route('home')}}/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>


<!-- Chart JS -->
<script src="{{route('home')}}/js/plugin/chart.js/chart.min.js"></script>

<!-- jQuery Sparkline -->
<script src="{{route('home')}}/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

<!-- Chart Circle -->
<script src="{{route('home')}}/js/plugin/chart-circle/circles.min.js"></script>

<!-- Datatables -->
<script src="{{route('home')}}/js/plugin/datatables/datatables.min.js"></script>

<!-- Bootstrap Notify -->
<script src="{{route('home')}}/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

<!-- jQuery Vector Maps -->
<script src="{{route('home')}}/js/plugin/jqvmap/jquery.vmap.min.js"></script>
<script src="{{route('home')}}/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script>

<!-- Sweet Alert -->
<script src="{{route('home')}}/js/plugin/sweetalert/sweetalert.min.js"></script>

<!-- Atlantis JS -->
<script src="{{route('home')}}/js/atlantis.min.js"></script>

<!-- Atlantis DEMO methods, don't include it in your project! -->
<script src="{{route('home')}}/js/setting-demo.js"></script>
<script src="{{route('home')}}/js/demo.js"></script>
<script src="{{route('home')}}/js/home.js"></script>
<script src="{{route('home')}}/js/script.js"></script>
<script src="{{route('home')}}/dataTables/datatables.min.js"></script>
<script>
    Circles.create({
        id: 'circles-1',
        radius: 45,
        value: 60,
        maxValue: 100,
        width: 7,
        text: 5,
        colors: ['#f1f1f1', '#FF9E27'],
        duration: 400,
        wrpClass: 'circles-wrp',
        textClass: 'circles-text',
        styleWrapper: true,
        styleText: true
    })

    Circles.create({
        id: 'circles-2',
        radius: 45,
        value: 70,
        maxValue: 100,
        width: 7,
        text: 36,
        colors: ['#f1f1f1', '#2BB930'],
        duration: 400,
        wrpClass: 'circles-wrp',
        textClass: 'circles-text',
        styleWrapper: true,
        styleText: true
    })

    Circles.create({
        id: 'circles-3',
        radius: 45,
        value: 40,
        maxValue: 100,
        width: 7,
        text: 12,
        colors: ['#f1f1f1', '#F25961'],
        duration: 400,
        wrpClass: 'circles-wrp',
        textClass: 'circles-text',
        styleWrapper: true,
        styleText: true
    })

    var totalIncomeChart = document.getElementById('totalIncomeChart').getContext('2d');

    var mytotalIncomeChart = new Chart(totalIncomeChart, {
        type: 'bar',
        data: {
            labels: ["S", "M", "T", "W", "T", "F", "S", "S", "M", "T"],
            datasets: [{
                label: "Total Income",
                backgroundColor: '#ff9e27',
                borderColor: 'rgb(23, 125, 255)',
                data: [6, 4, 9, 5, 4, 6, 4, 3, 8, 10],
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                display: false,
            },
            scales: {
                yAxes: [{
                    ticks: {
                        display: false //this will remove only the label
                    },
                    gridLines: {
                        drawBorder: false,
                        display: false
                    }
                }],
                xAxes: [{
                    gridLines: {
                        drawBorder: false,
                        display: false
                    }
                }]
            },
        }
    });

    $('#lineChart').sparkline([105, 103, 123, 100, 95, 105, 115], {
        type: 'line',
        height: '70',
        width: '100%',
        lineWidth: '2',
        lineColor: '#ffa534',
        fillColor: 'rgba(255, 165, 52, .14)'
    });
</script>

</body>
</html>
