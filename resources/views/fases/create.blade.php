@php
    $seo['title'] = 'Fases';
    $MODULO = 'fases';
    $func = 'criar';
@endphp
@extends('layouts.app')
@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Fases</h4>
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
                        <a href="{{route('fases.index')}}">Fases</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a>Nova Fase</a>
                    </li>
                </ul>
            </div>
            <form method="post" action="{{route('fases.store')}}">
                @csrf
                @include('fases.form', ['page'=>'Criar'])
            </form>
        </div>
    </div>
@endsection
