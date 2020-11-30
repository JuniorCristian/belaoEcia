<?php
    setlocale(LC_TIME, 'pt_BR.utf8');



    if(!empty($MODULO) && file_exists($MODULO.'.php')){
        $endereco = $MODULO;
    }else{
        $endereco = 'home';
    }

    $seo = array();
    $seo['imagem'] = "images/logo.png";
    $seo['url'] = "";

    include 'includes/head.blade.php';
    include (file_exists('seo/'.$endereco.'_seo.php') ? 'seo/'.$endereco.'_seo.php' : 'seo/home_seo.php');
?>
