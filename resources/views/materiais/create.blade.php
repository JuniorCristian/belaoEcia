@php
    $seo['title'] = 'Materiais';
    $MODULO = 'materiais';
    $func = 'criar';
@endphp
@extends('layouts.app')
@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Materiais</h4>
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
                        <a href="{{route('materiais.index')}}">Materiais</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a>Novo Material</a>
                    </li>
                </ul>
            </div>
            <form method="post" action="{{route('materiais.store')}}">
                @csrf
                @include('materiais.form', ['page'=>'Criar'])
            </form>
        </div>
    </div>
@endsection
