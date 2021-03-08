<?php
if (!isset($_SESSION)) {
    session_start();
}
setlocale(LC_TIME, 'pt_BR.utf8');

$seo = array();
$seo['imagem'] = "images/logo.png";
$seo['url'] = "";

$head['author'] = 'Cristian Robert Belão de Meira Junior';
$head['copyright'] = '';
?>
    <!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <title>Login | {{env('APP_NAME')}}</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport'/>
    <link rel="icon" href="{{asset('storage/icon.ico')}}" type="image/x-icon"/>

    <!-- Fonts and icons -->
    <script src="{{url(mix("/js/plugin/webfont/webfont.min.js"))}}"></script>
    <script>
        WebFont.load({
            google: {"families": ["Lato:300,400,700,900"]},
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"],
                urls: ['css/fonts.min.css']
            },
            active: function () {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{asset("/css/bootstrap.min.css")}}">
    <link rel="stylesheet" href="{{asset("/css/all.min.css")}}">
    <link rel="stylesheet" href="{{asset("/fonts/flaticon/flaticon.min.css")}}">

    <link rel="stylesheet" href="{{asset("/css/style.min.css")}}">
</head>
<body>
<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Bem vindo(a)</h1>
                                </div>
                                <form class="user" method="post" action="{{route('dashboard.login.do')}}">
                                    @csrf

                                    @if($errors->all)
                                        @foreach($errors->all() as $error)
                                            <div class="alert alert-danger" role="alert">
                                                {{$error}}
                                            </div>
                                        @endforeach
                                    @endif
                                    <input type="hidden" name="opt" value="login">
                                    <div class="form-group">
                                        <input type="text" name="email"
                                               class="form-control form-control-user"
                                               id="exampleInputEmail" aria-describedby="emailHelp"
                                               placeholder="E-mail">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="senha"
                                               class="form-control form-control-user"
                                               id="exampleInputPassword" placeholder="Senha">
                                    </div>
                                    <button type="submit"
                                            class="btn btn-primary btn-user btn-block btn-login">
                                        Login
                                    </button>
                                </form>

                                <div class="text-center">
                                    <a class="small" href="">Esqueci a senha</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="{{route('dashboard.cadastro')}}">Criar uma conta</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

<!--   Core JS Files   -->
<script src="{{asset("/js/core/jquery.3.2.1.min.js")}}"></script>
<script src="{{asset("/js/core/popper.min.js")}}"></script>
<script src="{{asset("/js/core/bootstrap.min.js")}}"></script>
<!-- jQuery UI -->
<script src="{{asset("/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js")}}"></script>
<script src="{{asset("/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js")}}"></script>

<!-- jQuery Scrollbar -->
<script src="{{asset("/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js")}}"></script>

<!-- Chart JS -->
<script src="{{asset("/js/plugin/chart.js/chart.min.js")}}"></script>

<!-- jQuery Sparkline -->
<script src="{{asset("/js/plugin/jquery.sparkline/jquery.sparkline.min.js")}}"></script>

<!-- Chart Circle -->
<script src="{{asset("/js/plugin/chart-circle/circles.min.js")}}"></script>

<!-- Bootstrap Notify -->
<script src="{{asset("/js/plugin/bootstrap-notify/bootstrap-notify.min.js")}}"></script>

<!-- Sweet Alert -->
<script src="{{asset("/js/plugin/sweetalert/sweetalert.min.js")}}"></script>

<!-- Atlantis JS -->
<script src="{{asset("/js/atlantis.min.js")}}"></script>

<script src="{{asset("/js/login.min.js")}}"></script>

</body>

</html>
