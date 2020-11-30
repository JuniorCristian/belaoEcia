<?php
if(!isset($_SESSION)){
    session_start();
}
include 'includes/topo.blade.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title><?php print $seo['title']; ?></title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="{{route('home')}}/img/icon.ico" type="image/x-icon"/>

    <!-- Fonts and icons -->
    <script src="{{route('home')}}resources/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {"families":["Lato:300,400,700,900"]},
            custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['assets/css/fonts.min.css']},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{route('home')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{route('home')}}/css/atlantis.min.css">

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="{{route('home')}}/css/demo.css">
    <link rel="stylesheet" href="{{route('home')}}/css/all.css">
    <link rel="stylesheet" href="{{route('home')}}/css/style.css">
    <link rel="stylesheet" type="text/css" href="{{route('home')}}/datatables/datatables.min.css"/>
    <?php include 'seo/analytics.php'; ?>
</head>
<body>

<!---->
<!--<!DOCTYPE html>-->
<!--<html lang="zxx">-->
<!--<head>-->
<!--  <meta charset="utf-8" />-->
<!--  <meta name="viewport" content="width=device-width, initial-scale=1">-->
<!--  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">-->
<!--  <title>--><?php //print $seo['title']; ?><!--</title>-->
<!--  <meta name="author" content="--><?php //print $head['author']; ?><!--" />-->
<!--  <meta name="description" content="--><?php //print $seo['description']; ?><!--" />-->
<!--  <meta name="keywords" content="--><?php //print $seo['keywords']; ?><!--" />-->
<!--  <meta name="copyright" content="--><?php //print $head['copyright']; ?><!--" />-->
<!--  <meta name="title" content="--><?php //print $seo['title']; ?><!--" />-->
<!--  <meta name="robots" content="index,follow" />-->
<!--  <base href="--><?php //print ENDERECO; ?><!--" property="og:title" />  -->
<!--  <meta property="og:type" content="article">-->
<!--  <meta property="og:url" content="--><?php //echo ENDERECO.$_REQUEST['p']; ?><!--"/>    -->
<!--  <meta property="og:title" content="--><?php //print $seo['title']; ?><!--"/>-->
<!--  <meta property="og:image" content="--><?php //print ENDERECO; ?><!----><?php //echo !empty($seo['imagem']) ? $seo['imagem'] : "images/assets/bg-logo.png"?><!--"/>    -->
<!--  <meta property="og:description" content="--><?php //echo ((isset($seo['resumo']))? $seo['resumo']:$seo['description']) ?><!--" /> -->
<!--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">-->
<!--    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900" rel="stylesheet">-->
<!--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css">-->
<!--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">-->
<!--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">-->
<!--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">-->
<!--    <link rel="stylesheet" href="css/responsive.css">-->
<!--  <link type="text/css" rel="stylesheet" href="--><?//=ENDERECO?><!--css/fonts.css" />-->
<!--  <link rel="stylesheet" href="--><?//=ENDERECO?><!--css/font-awesome.min.css">-->
<!--  <link type="text/css" rel="stylesheet" href="--><?//=ENDERECO?><!--css/--><?php //echo $endereco ?><!--.css" />-->
<!--  <link type="text/css" rel="stylesheet" href="--><?//=ENDERECO?><!--css/style.css" />-->
<!--  <link rel="stylesheet" type="text/css" href="css/slick.min.css">-->
<!--    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css">-->
<!---->
<!--  <link rel="apple-touch-icon" sizes="57x57" href="--><?//=ENDERECO?><!--images/favicon/apple-icon-57x57.png">-->
<!--  <link rel="apple-touch-icon" sizes="60x60" href="--><?//=ENDERECO?><!--images/favicon/apple-icon-60x60.png">-->
<!--  <link rel="apple-touch-icon" sizes="72x72" href="--><?//=ENDERECO?><!--images/favicon/apple-icon-72x72.png">-->
<!--  <link rel="apple-touch-icon" sizes="76x76" href="--><?//=ENDERECO?><!--images/favicon/apple-icon-76x76.png">-->
<!--  <link rel="apple-touch-icon" sizes="114x114" href="--><?//=ENDERECO?><!--images/favicon/apple-icon-114x114.png">-->
<!--  <link rel="apple-touch-icon" sizes="120x120" href="--><?//=ENDERECO?><!--images/favicon/apple-icon-120x120.png">-->
<!--  <link rel="apple-touch-icon" sizes="144x144" href="--><?//=ENDERECO?><!--images/favicon/apple-icon-144x144.png">-->
<!--  <link rel="apple-touch-icon" sizes="152x152" href="--><?//=ENDERECO?><!--images/favicon/apple-icon-152x152.png">-->
<!--  <link rel="apple-touch-icon" sizes="180x180" href="--><?//=ENDERECO?><!--images/favicon/apple-icon-180x180.png">-->
<!--  <link rel="icon" type="image/png" sizes="192x192"  href="--><?//=ENDERECO?><!--images/favicon/android-icon-192x192.png">-->
<!--  <link rel="icon" type="image/png" sizes="32x32" href="--><?//=ENDERECO?><!--images/favicon/favicon-32x32.png">-->
<!--  <link rel="icon" type="image/png" sizes="96x96" href="--><?//=ENDERECO?><!--images/favicon/favicon-96x96.png">-->
<!--  <link rel="icon" type="image/png" sizes="16x16" href="--><?//=ENDERECO?><!--images/favicon/favicon-16x16.png">-->
<!--  <link rel="manifest" href="--><?//=ENDERECO?><!--images/favicon/manifest.json">-->
<!--  <meta name="msapplication-TileColor" content="#ffffff">-->
<!--  <meta name="msapplication-TileImage" content="--><?//=ENDERECO?><!--images/favicon/ms-icon-144x144.png">-->
<!--  <meta name="theme-color" content="#ffffff">-->
<!---->
<!---->
<?php //include 'seo/analytics.php'; ?>
<!---->
<!--</head>-->
<!--<body>-->
