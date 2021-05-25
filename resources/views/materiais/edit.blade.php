@php
    $seo['title'] = 'Materiais';
    $MODULO = 'materiais';
    $func = 'listar';
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
                        <a>Editar Material</a>
                    </li>
                </ul>
            </div>
            <form method="post" action="{{route('materiais.update', ['material'=>$material->id])}}">
                @csrf
                @method('put')
                @include('materiais.form', ['page'=>'Editar'])
            </form>
        </div>
    </div>
@endsection
