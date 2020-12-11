<!DOCTYPE html><?php
if (!isset($_SESSION)) {
    session_start();
}
setlocale(LC_TIME, 'pt_BR.utf8');

$seo = array();
$seo['imagem'] = "images/logo.png";
$seo['url'] = "";

$head['author'] = 'Cristian Robert Belão de Meira Junior';
$head['copyright'] = '';
include('seo/login_seo.php');
?>
    <!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <title>{{$seo['title']}} | {{env('APP_NAME')}}</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport'/>
    <link rel="icon" href="{{env('APP_URL')}}/storage/icon.ico" type="image/x-icon"/>

    <!-- Fonts and icons -->
    <script src="{{route('home')}}resources/js/plugin/webfont/webfont.js"></script>
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
    <link rel="stylesheet" href="{{env("APP_URL")}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{env("APP_URL")}}/css/atlantis.min.css">

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="{{env("APP_URL")}}/css/demo.css">
    <link rel="stylesheet" href="{{env("APP_URL")}}/css/all.css">
    <link rel="stylesheet" href="{{env("APP_URL")}}/css/style.css">
    <link rel="stylesheet" type="text/css" href="{{env("APP_URL")}}/datatables/datatables.min.css"/>
</head>
<body>
<div class="container">

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <!-- Scripts -->
        @routes
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
