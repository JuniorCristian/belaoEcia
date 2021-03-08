<?php
$seo['title'] = 'Clientes';
$MODULO = 'clientes';
$func = 'criar';
?>
@extends('layouts.app')
@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Clientes</h4>
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
                        <a href="{{route('clientes.show')}}">Clientes</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="">Criar Cliente</a>
                    </li>
                </ul>
            </div>
            <form method="post" action="{{route('clientes.store')}}">
                @csrf

                @include('clientes.form', ['page'=>"Criar Cliente"])

            </form>
        </div>
    </div>
@endsection
