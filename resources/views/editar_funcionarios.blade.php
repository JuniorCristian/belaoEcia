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
$seo['title'] = "Funcionarios | Belão&CIA Manegement System";
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
    $MODULO = 'funcionarios';
    $func = 'listar';
    include("includes/sidebar.blade.php")?>

    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">
                    <h4 class="page-title">Funcionários</h4>
                    <ul class="breadcrumbs">
                        <li class="nav-home">
                            <a href="{{route('home')}}">
                                <i class="flaticon-home"></i>
                            </a>
                        </li>
                        <li class="separator">
                            <i class="flaticon-right-arrow"></i>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('funcionarios.show')}}">Funcionários</a>
                        </li>
                        <li class="separator">
                            <i class="flaticon-right-arrow"></i>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('funcionarios.edit', ['funcionario'=>$funcionario->id])}}">Editar Funcionário</a>
                        </li>
                    </ul>
                </div>
                <form method="post" action="{{route('funcionarios.update', ['funcionario', $funcionario->id])}}">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Editar Funcionário</div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label for="nome">Nome</label>
                                                <input value="{{$funcionario->nome}}" type="text" id="nome" name="nome" class="form-control"
                                                       placeholder="Insina o nome do funcionário">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label for="cpf">CPF</label>
                                                <input value="{{$funcionario->cpf}}" type="text" id="cpf" name="cpf" class="form-control"
                                                       placeholder="Insina o CPF do funcionário">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label for="telefone">Telefone</label>
                                                <input value="{{$funcionario->telefone}}" type="text" id="telefone" name="telefone" class="form-control"
                                                       placeholder="Insina o telefone do funcionário">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label for="salario">Salario por dia</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">R$</span>
                                                    </div>
                                                    <input value="{{$funcionario->salario_dia}}" type="number" num id="salario_dia" name="salario_dia" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="funcao">Função</label>
                                            <select class="form-control" id="funcao" name="funcao">
                                                <option {{($funcionario->funcao=="Pedreiro")?"selected":""}} value="Pedreiro">Pedreiro</option>
                                                <option {{($funcionario->funcao=="Assistente de pedreiro")?"selected":""}} value="Assistente de pedreiro">Assistente de pedreiro</option>
                                                <option {{($funcionario->funcao=="Oreia seca")?"selected":""}} value="Oreia seca">Oreia Seca</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="card-action">
                                        <button type="submit" class="btn btn-success">Salvar</button>
                                        <a href="{{route('funcionarios.show')}}" class="btn btn-danger">Cancelar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Custom template | don't include it in your project! -->
            <div class="custom-template">
                <div class="title">Configurações</div>
                <div class="custom-content">
                    <div class="switcher">
                        <div class="switch-block">
                            <h4>Logo Header</h4>
                            <div class="btnSwitch">
                                <button type="button" class="{{(Auth::user()->cor_header == 'dark')?'selected':''}} changeLogoHeaderColor" data-color="dark"></button>
                                <button type="button" class="{{(Auth::user()->cor_header == 'blue')?'selected':''}} changeLogoHeaderColor" data-color="blue"></button>
                                <button type="button" class="{{(Auth::user()->cor_header == 'purple')?'selected':''}} changeLogoHeaderColor" data-color="purple"></button>
                                <button type="button" class="{{(Auth::user()->cor_header == 'light-blue')?'selected':''}} changeLogoHeaderColor" data-color="light-blue"></button>
                                <button type="button" class="{{(Auth::user()->cor_header == 'green')?'selected':''}} changeLogoHeaderColor" data-color="green"></button>
                                <button type="button" class="{{(Auth::user()->cor_header == 'orange')?'selected':''}} changeLogoHeaderColor" data-color="orange"></button>
                                <button type="button" class="{{(Auth::user()->cor_header == 'red')?'selected':''}} changeLogoHeaderColor" data-color="red"></button>
                                <button type="button" class="{{(Auth::user()->cor_header == 'white')?'selected':''}} changeLogoHeaderColor" data-color="white"></button>
                                <br/>
                                <button type="button" class="{{(Auth::user()->cor_header == 'dark2')?'selected':''}} changeLogoHeaderColor" data-color="dark2"></button>
                                <button type="button" class="{{(Auth::user()->cor_header == 'blue2')?'selected':''}} changeLogoHeaderColor" data-color="blue2"></button>
                                <button type="button" class="{{(Auth::user()->cor_header == 'purple2')?'selected':''}} changeLogoHeaderColor" data-color="purple2"></button>
                                <button type="button" class="{{(Auth::user()->cor_header == 'light-blue2')?'selected':''}} changeLogoHeaderColor" data-color="light-blue2"></button>
                                <button type="button" class="{{(Auth::user()->cor_header == 'green2')?'selected':''}} changeLogoHeaderColor" data-color="green2"></button>
                                <button type="button" class="{{(Auth::user()->cor_header == 'orange2')?'selected':''}} changeLogoHeaderColor" data-color="orange2"></button>
                                <button type="button" class="{{(Auth::user()->cor_header == 'red2')?'selected':''}} changeLogoHeaderColor" data-color="red2"></button>
                            </div>
                        </div>
                        <div class="switch-block">
                            <h4>Navbar Header</h4>
                            <div class="btnSwitch">
                                <button type="button"  class="{{(Auth::user()->cor_navbar == 'dark')?'selected':''}} changeTopBarColor" data-color="dark"></button>
                                <button type="button"  class="{{(Auth::user()->cor_navbar == 'blue')?'selected':''}} changeTopBarColor" data-color="blue"></button>
                                <button type="button"  class="{{(Auth::user()->cor_navbar == 'purple')?'selected':''}} changeTopBarColor" data-color="purple"></button>
                                <button type="button"  class="{{(Auth::user()->cor_navbar == 'light-blue')?'selected':''}} changeTopBarColor" data-color="light-blue"></button>
                                <button type="button"  class="{{(Auth::user()->cor_navbar == 'green')?'selected':''}} changeTopBarColor" data-color="green"></button>
                                <button type="button"  class="{{(Auth::user()->cor_navbar == 'orange')?'selected':''}} changeTopBarColor" data-color="orange"></button>
                                <button type="button"  class="{{(Auth::user()->cor_navbar == 'red')?'selected':''}} changeTopBarColor" data-color="red"></button>
                                <button type="button"  class="{{(Auth::user()->cor_navbar == 'white')?'selected':''}} changeTopBarColor" data-color="white"></button>
                                <br/>
                                <button type="button" class="{{(Auth::user()->cor_navbar == 'dark2')?'selected':''}} changeTopBarColor" data-color="dark2"></button>
                                <button type="button" class="{{(Auth::user()->cor_navbar == 'blue2')?'selected':''}} changeTopBarColor" data-color="blue2"></button>
                                <button type="button" class="{{(Auth::user()->cor_navbar == 'purple2')?'selected':''}} changeTopBarColor" data-color="purple2"></button>
                                <button type="button" class="{{(Auth::user()->cor_navbar == 'light-blue2')?'selected':''}} changeTopBarColor" data-color="light-blue2"></button>
                                <button type="button" class="{{(Auth::user()->cor_navbar == 'green2')?'selected':''}} changeTopBarColor" data-color="green2"></button>
                                <button type="button" class="{{(Auth::user()->cor_navbar == 'orange2')?'selected':''}} changeTopBarColor" data-color="orange2"></button>
                                <button type="button" class="{{(Auth::user()->cor_navbar == 'red2')?'selected':''}} changeTopBarColor" data-color="red2"></button>
                            </div>
                        </div>
                        <div class="switch-block">
                            <h4>Sidebar</h4>
                            <div class="btnSwitch">
                                <button type="button" class="{{(Auth::user()->cor_sidebar == 'white')?'selected':''}} changeSideBarColor" data-color="white"></button>
                                <button type="button" class="{{(Auth::user()->cor_sidebar == 'dark')?'selected':''}} changeSideBarColor" data-color="dark"></button>
                                <button type="button" class="{{(Auth::user()->cor_sidebar == 'dark2')?'selected':''}} changeSideBarColor" data-color="dark2"></button>
                            </div>
                        </div>
                        <div class="switch-block">
                            <h4>Background</h4>
                            <div class="btnSwitch">
                                <button type="button" class="{{(Auth::user()->cor_background == 'bg2')?'selected':''}} changeBackgroundColor" data-color="bg2"></button>
                                <button type="button" class="{{(Auth::user()->cor_background == 'bg1')?'selected':''}} changeBackgroundColor" data-color="bg1"></button>
                                <button type="button" class="{{(Auth::user()->cor_background == 'bg3')?'selected':''}} changeBackgroundColor" data-color="bg3"></button>
                                <button type="button" class="{{(Auth::user()->cor_background == 'dark')?'selected':''}} changeBackgroundColor" data-color="dark"></button>
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
        <script src="{{route('home')}}/js/funcionarios.js"></script>
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
