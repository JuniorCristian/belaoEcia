<?php
$seo['title'] = 'Obras';
$MODULO = 'obras';
$func = 'gerenciar';
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
                        <a href="{{route('obras.faltas', ['obra'=>$obra->id])}}">Registrar faltas</a>
                    </li>
                </ul>
            </div>
            <form method="post" action="{{route('obras.registrarFaltas', ['obra'=>$obra->id])}}">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Faltas</div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach($funcionarios as $funcionario)
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label for="">{{$funcionario->nome}}</label>
                                                <div class="input-group mb-3">
                                                    <div class="">
                                                        <label class="form-check-label">
                                                            <input class="falta"
                                                                   name="falta{{$funcionario->id}}"
                                                                   type="checkbox" value="">
                                                            <span class="form-check-sign">Faltou</span>
                                                        </label>
                                                    </div>
                                                    <br>
                                                    <div class="">
                                                        <label class="form-check-label">
                                                            <input class="meio_dia"
                                                                   name="meio_dia{{$funcionario->id}}"
                                                                   type="checkbox" value="">
                                                            <span class="form-check-sign">Meio dia trabalhado</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="col-md-10 col-lg-5">
                                        <div class="card-action">
                                            <button type="submit" class="btn btn-success">Salvar</button>
                                            <a href="{{route('obras.index')}}" class="btn btn-danger">Cancelar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
