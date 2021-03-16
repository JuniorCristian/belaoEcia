<?php
$seo['title'] = 'Lojas';
$MODULO = 'lojas';
$func = 'editar';
?>
@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Lojas</h4>
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
                        <a href="{{route('lojas.index')}}">Lojas</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a>Editar Loja</a>
                    </li>
                </ul>
            </div>
            <form method="post" action="{{route('lojas.update', ['loja'=>$loja->id])}}" class="needs-validation" novalidate>
                @csrf
                @method('put')
                @include('lojas.form', ['page'=>'Editar Loja'])
            </form>
        </div>
    </div>
@endsection
