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
$seo['title'] = "Obras | Belão&CIA Manegement System";
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
                urls: ['{{route('home')}}/css/fonts.min.css']
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
    $MODULO = 'obras';
    $func = 'criar';
    include("includes/sidebar.blade.php")?>

    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">
                    <h4 class="page-title">Obras</h4>
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
                            <a href="{{route('home')}}">Obras</a>
                        </li>
                        <li class="separator">
                            <i class="flaticon-right-arrow"></i>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('obras.criar')}}">Nova Obra</a>
                        </li>
                    </ul>
                </div>
                <form method="post" action="{{route('obras.update', ['obra'=>$obra->id])}}">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Nova Obra</div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label for="orcamento">Orçamento da obra</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">R$</span>
                                                    </div>
                                                    <input type="number" num id="orcamento" name="orcamento"
                                                           class="form-control"
                                                           value="{{$obra->orcamento}}"
                                                           aria-label="Amount (to the nearest dollar)">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">,00</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="">
                                                <label class="form-check-label">
                                                    <input class="" id="mostra_orc_material"
                                                           name="has_orcamento_materiais"
                                                           {{($obra->has_orcamento_material)?'checked':''}}
                                                           type="checkbox">
                                                    <span class="form-check-sign">Orçameto dos materias</span>
                                                </label>
                                                <div class="form-group orc_material">
                                                    <label for="orcamento">Orçamento dos materiais</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">R$</span>
                                                        </div>
                                                        <input type="number" num id="orcamento_materias"
                                                               name="orcamento_materias"
                                                               value="{{$obra->orcamento_material}}"
                                                               class="form-control"
                                                               aria-label="Amount (to the nearest dollar)">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">,00</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label for="data_inicio">Data de inicio prevista</label>
                                                <input type="date" value="{{date('Y-m-d', strtotime($obra->data_inicio_prevista))}}" class="form-control" id="data_inicio_prevista"
                                                       name="data_inicio_prevista">
                                            </div>
                                            <div class="form-group">
                                                <label for="data_final">Data de final prevista</label>
                                                <input type="date" value="{{date('Y-m-d', strtotime($obra->data_final_prevista))}}" class="form-control" id="data_final_prevista"
                                                       name="data_final_prevista">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label for="data_inicio">Data de iniciada</label>
                                                <input type="date" value="{{($obra->data_inicio != null)?date('Y-m-d', strtotime($obra->data_inicio)):''}}" class="form-control" id="data_inicio"
                                                       name="data_inicio">
                                            </div>
                                            <div class="form-group">
                                                <label for="data_final">Data de finalizada</label>
                                                <input type="date" value="{{($obra->data_final != null)?date('Y-m-d', strtotime($obra->data_final)):''}}" class="form-control" id="data_final"
                                                       name="data_final">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label for="cep">CEP</label>
                                                <input type="text" value="{{$obra->cep}}" class="form-control" id="cep" name="cep">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label for="rua">Rua</label>
                                                <input type="text" value="{{$obra->rua}}" class="form-control" id="rua" name="rua">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label for="numero">Número</label>
                                                <input type="text" value="{{$obra->numero}}" class="form-control" id="numero" name="numero">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label for="complemento">Complemento</label>
                                                <input type="text" value="{{$obra->complemento}}" class="form-control" id="complemento"
                                                       name="complemento">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label for="bairro">Bairro</label>
                                                <input type="text" value="{{$obra->bairro}}" class="form-control" id="bairro" name="bairro">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label for="cep">Cidade</label>
                                                <input type="text" value="{{$obra->cidade}}" class="form-control" id="cidade" name="cidade">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label for="uf">Estado</label>
                                                <select class="form-control" id="uf" name="uf">
                                                    <option>Selecione um estado</option>
                                                    <option {{($obra->uf == 'AC')?'selected':''}} value="AC">Acre</option>
                                                    <option {{($obra->uf == 'AL')?'selected':''}} value="AL">Alagoas</option>
                                                    <option {{($obra->uf == 'AP')?'selected':''}} value="AP">Amapá</option>
                                                    <option {{($obra->uf == 'AM')?'selected':''}} value="AM">Amazonas</option>
                                                    <option {{($obra->uf == 'BA')?'selected':''}} value="BA">Bahia</option>
                                                    <option {{($obra->uf == 'CE')?'selected':''}} value="CE">Ceará</option>
                                                    <option {{($obra->uf == 'DF')?'selected':''}} value="DF">Distrito Federal</option>
                                                    <option {{($obra->uf == 'ES')?'selected':''}} value="ES">Espírito Santo</option>
                                                    <option {{($obra->uf == 'GO')?'selected':''}} value="GO">Goiás</option>
                                                    <option {{($obra->uf == 'MA')?'selected':''}} value="MA">Maranhão</option>
                                                    <option {{($obra->uf == 'MT')?'selected':''}} value="MT">Mato Grosso</option>
                                                    <option {{($obra->uf == 'MS')?'selected':''}} value="MS">Mato Grosso do Sul</option>
                                                    <option {{($obra->uf == 'MG')?'selected':''}} value="MG">Minas Gerais</option>
                                                    <option {{($obra->uf == 'PA')?'selected':''}} value="PA">Pará</option>
                                                    <option {{($obra->uf == 'PB')?'selected':''}} value="PB">Paraíba</option>
                                                    <option {{($obra->uf == 'PR')?'selected':''}} value="PR">Paraná</option>
                                                    <option {{($obra->uf == 'PE')?'selected':''}} value="PE">Pernambuco</option>
                                                    <option {{($obra->uf == 'PI')?'selected':''}} value="PI">Piauí</option>
                                                    <option {{($obra->uf == 'RJ')?'selected':''}} value="RJ">Rio de Janeiro</option>
                                                    <option {{($obra->uf == 'RN')?'selected':''}} value="RN">Rio Grande do Norte</option>
                                                    <option {{($obra->uf == 'RS')?'selected':''}} value="RS">Rio Grande do Sul</option>
                                                    <option {{($obra->uf == 'RO')?'selected':''}} value="RO">Rondônia</option>
                                                    <option {{($obra->uf == 'RR')?'selected':''}} value="RR">Roraima</option>
                                                    <option {{($obra->uf == 'SC')?'selected':''}} value="SC">Santa Catarina</option>
                                                    <option {{($obra->uf == 'SP')?'selected':''}} value="SP">São Paulo</option>
                                                    <option {{($obra->uf == 'SE')?'selected':''}} value="SE">Sergipe</option>
                                                    <option {{($obra->uf == 'TO')?'selected':''}} value="TO">Tocantins</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-lg-4">
                                            <div class="">
                                                <label for="funcionario">Funcionários</label><br>
                                                @foreach($funcionarios as $funcionario)
                                                    <label class="form-check-label">
                                                        <input class="" name="funcionario{{$funcionario->id}}"
                                                               @foreach($obra->funcionario as $f)
                                                               @if($funcionario->id == $f->id)
                                                               checked
                                                               @endif
                                                               @endforeach
                                                               type="checkbox">
                                                        <span class="form-check-sign">{{$funcionario->nome}}</span>
                                                    </label>
                                                @endforeach
                                            </div>
                                            <a href="{{route('funcionarios.criar')}}">Criar novo funcionário</a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label for="cliente">Cliente</label>
                                                <select class="form-control" id="cliente" name="cliente">
                                                    <option>Selecione um cliente</option>
                                                    @foreach($clientes as $cliente)
                                                        <option
                                                            <?php echo ($cliente->id == $obra->cliente) ? 'selected' : ''?> value="{{$cliente->id}}">{{$cliente->nome}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <a href="{{route('clientes.criar')}}">Criar novo cliente</a>
                                        </div>
                                    </div>
                                    <div class="card-action">
                                        <button type="submit" class="btn btn-success">Salvar</button>
                                        <a href="{{route('obras.show')}}" class="btn btn-danger">Cancelar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
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
<script src="{{route('home')}}/js/obras.js"></script>
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
