<?php

use \Illuminate\Support\Facades\Auth;

$head['author'] = 'Cristian Robert Belão de Meira Junior';
$head['copyright'] = '';
?>
    <!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <title>{{$seo['title']}} | {{env("APP_NAME")}}</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport'/>
    <link rel="icon" href="{{env('APP_URL')}}/storage/icon.ico" type="image/x-icon"/>

    <!-- Fonts and icons -->
    <script src="{{url(mix("/js/plugin/webfont/webfont.min.js"))}}"></script>
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
    <link rel="stylesheet" href="{{url(mix("/css/bootstrap.min.css"))}}">
    <link rel="stylesheet" href="{{asset("/css/all.min.css")}}">
    <link rel="stylesheet" href="{{asset("/css/sweetalert2.min.css")}}">
    <link rel="stylesheet" href="{{url(mix("/css/atlantis.min.css"))}}">
    <link rel="stylesheet" href="{{url(mix("/fonts/flaticon/flaticon.min.css"))}}">

    <link rel="stylesheet" href="{{url(mix("/css/style.min.css"))}}">
    <link rel="stylesheet" href="{{url(mix("/css/$MODULO.min.css"))}}">
    <link rel="stylesheet" href="{{url(mix("/datatables/datatables.min.css"))}}">
</head>
<body data-background-color="bg1">
<div class="wrapper">
    <div class="main-header">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="blue">

            <a href="{{route('home')}}" class="logo">
                <img src="{{url('/storage/logo.svg')}}" alt="navbar brand" class="navbar-brand">
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

        <!-- Navbar Header -->
        <nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue">

            <div class="container-fluid">
                <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                    <li class="nav-item toggle-nav-search hidden-caret">
                        <a class="nav-link" data-toggle="collapse" href="#search-nav" role="button"
                           aria-expanded="false" aria-controls="search-nav">
                            <i class="fa fa-search"></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown hidden-caret">
                        <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                            <div class="avatar-sm">
                                <img
                                    src="{{url('/storage/'.Auth::user()->profile_photo_path)}}"
                                    alt="..." class="avatar-img rounded-circle">
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-user animated fadeIn">
                            <div class="dropdown-user-scroll scrollbar-outer">
                                <li>
                                    <div class="user-box">
                                        <div class="avatar-lg"><img
                                                src="{{url('/storage/'.Auth::user()->profile_photo_path)}}"
                                                alt="image profile" class="avatar-img rounded"></div>
                                        <div class="u-text">
                                            <h4>{{Auth::user()->name}}</h4>
                                            <p class="text-muted">{{Auth::user()->email}}</p><a href="profile.html"
                                                                                                class="btn btn-xs btn-secondary btn-sm">Ver
                                                Perfil</a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{route('dashboard.logout')}}">Sair</a>
                                </li>
                            </div>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- End Navbar -->
    </div>
    <!-- Sidebar -->
    <div class="sidebar sidebar-style-2" data-background-color="white">
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
            <div class="sidebar-content">
                <div class="user">
                    <div class="avatar-sm float-left mr-2">
                        <img src="{{env('APP_URL')}}/storage/{{Auth::user()->profile_photo_path}}"
                             alt="..." class="avatar-img rounded-circle">
                    </div>
                    <div class="info">
                        <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
									{{Auth::user()->name}}
									<span class="user-level">Administrador</span>
									<span class="caret"></span>
								</span>
                        </a>
                        <div class="clearfix"></div>

                        <div class="collapse in" id="collapseExample">
                            <ul class="nav">
                                <li>
                                    <a href="#profile">
                                        <span class="link-collapse">Meu perfil</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#edit">
                                        <span class="link-collapse">Editar perfil</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#settings">
                                        <span class="link-collapse">Configurações</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <ul class="nav nav-primary">
                    <li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
                        <h4 class="text-section">Componentes</h4>
                    </li>
                    <li class="nav-item {{$MODULO == "obras" ? "active submenu" : ""}}">
                        <a data-toggle="collapse"
                           href="#obras" {{$MODULO== "obras" ? "class aria-expanded='true'" : ""}}>
                            <i class="fas fa-hammer"></i>
                            <p>&nbsp;&nbsp;Obras</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse {{$MODULO == "obras" ? "show" : ""}}" id="obras">
                            <ul class="nav nav-collapse">
                                <li class="{{$MODULO=="obras" && $func == 'gerenciar' ? "active" : ""}}">
                                    <a href="{{route('obras.ativas')}}">
                                        <span class="sub-item">Obras Ativas</span>
                                    </a>
                                </li>
                                <li class="{{$MODULO=="obras" && $func == 'listar' ? "active" : ""}}">
                                    <a href="{{route('obras.show')}}">
                                        <span class="sub-item">Ver obras</span>
                                    </a>
                                </li>
                                <li class="{{$MODULO=="obras" && $func == 'criar' ? "active" : ""}}">
                                    <a href="{{route('obras.criar')}}">
                                        <span class="sub-item">Criar obras</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item {{$MODULO == "funcionarios" ? "active submenu" : ""}}">
                        <a data-toggle="collapse"
                           href="#funcionarios" {{$MODULO == "funcionarios" ? "class aria-expanded='true'" : ""}}>
                            <i class="fas fa-hard-hat"></i>
                            <p>&nbsp;&nbsp;Funcionários</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse {{$MODULO == "funcionarios" ? "show" : ""}}" id="funcionarios">
                            <ul class="nav nav-collapse">
                                <li class="{{$MODULO=="funcionarios" && $func == 'listar' ? "active" : ""}}">
                                    <a href="{{route('funcionarios.show')}}">
                                        <span class="sub-item">Ver funcionários</span>
                                    </a>
                                </li>
                                <li class="{{$MODULO=="funcionarios" && $func == 'criar' ? "active" : ""}}">
                                    <a href="{{route('funcionarios.criar')}}">
                                        <span class="sub-item">Criar funcionários</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item {{$MODULO == "clientes" ? "active submenu" : ""}}">
                        <a data-toggle="collapse"
                           href="#clientes" {{$MODULO== "clientes" ? "class aria-expanded='true'" : ""}}>
                            <i class="fas fa-user"></i>
                            <p>&nbsp;&nbsp;Clientes</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse {{$MODULO == "clientes" ? "show" : ""}}" id="clientes">
                            <ul class="nav nav-collapse">
                                <li class="{{$MODULO=="clientes" && $func == 'listar' ? "active" : ""}}">
                                    <a href="{{route('clientes.show')}}">
                                        <span class="sub-item">Ver clientes</span>
                                    </a>
                                </li>
                                <li class="{{$MODULO=="clientes" && $func == 'criar' ? "active" : ""}}">
                                    <a href="{{route('clientes.criar')}}">
                                        <span class="sub-item">Criar clientes</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Sidebar -->
    <div class="main-panel">

    @yield('content')
    </div>
</div>


<!--   Core JS Files   -->
<script src="{{url(mix("/js/core/jquery.3.2.1.min.js"))}}"></script>
<script src="{{asset("/js/all.min.js")}}"></script>
<script src="{{url(mix("/js/core/popper.min.js"))}}"></script>
<script src="{{url(mix("/js/core/bootstrap.min.js"))}}"></script>
<!-- jQuery UI -->
<script src="{{url(mix("/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"))}}"></script>
<script src="{{url(mix("/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"))}}"></script>

<!-- jQuery Scrollbar -->
<script src="{{url(mix("/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"))}}"></script>

<!-- Chart JS -->
<script src="{{url(mix("/js/plugin/chart.js/chart.min.js"))}}"></script>

<!-- jQuery Sparkline -->
<script src="{{url(mix("/js/plugin/jquery.sparkline/jquery.sparkline.min.js"))}}"></script>

<!-- Chart Circle -->
<script src="{{url(mix("/js/plugin/chart-circle/circles.min.js"))}}"></script>

<!-- Bootstrap Notify -->
<script src="{{url(mix("/js/plugin/bootstrap-notify/bootstrap-notify.min.js"))}}"></script>

<!-- DataTables -->
<script src="{{url(mix("/datatables/datatables.min.js"))}}"></script>

<!-- Sweet Alert -->
<script src="{{url(mix("/js/plugin/sweetalert/sweetalert.min.js"))}}"></script>

<!-- Sweet Alert 2 -->
<script src="{{asset("/js/plugin/sweetalert2/sweetalert2.min.js")}}"></script>

<!-- Atlantis JS -->
<script src="{{url(mix("/js/atlantis.min.js"))}}"></script>

<!-- JQuery Mask -->
<script src="{{url(mix("/js/plugin/jquery-mask/jquery.mask.min.js"))}}"></script>

<script src="{{url(mix("/js/$MODULO.min.js"))}}"></script>
<script src="{{url(mix("/js/script.min.js"))}}"></script>
@stack('scripts')

</body>
</html>
