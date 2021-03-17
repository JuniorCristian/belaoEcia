@php
    $seo['title'] = 'Fases';
    $MODULO = 'fases';
    $func = 'listar';
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
                        <a>Editar Fase</a>
                    </li>
                </ul>
            </div>
            <form method="post" action="{{route('fases.update', ['fase'=>$fase->id])}}">
                @csrf
                @method('put')
                @include('fases.form', ['page'=>'Editar'])
            </form>
        </div>
    </div>
@endsection
