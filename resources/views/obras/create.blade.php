<?php
$seo['title'] = 'Obras';
$MODULO = 'obras';
$func = 'criar';
?>
@extends('layouts.app')
@section('content')
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
            <form method="post" action="{{route('obras.store')}}" class="needs-validation" novalidate>
                @csrf
                @include('obras.form', ['page'=>'Criar Obra'])
            </form>
        </div>
    </div>
@endsection
