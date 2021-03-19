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
                        <a href="{{route('obras.show')}}">Obras</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a>Fase da Obra</a>
                    </li>
                </ul>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Gerenciar Fase {{$fase_obra->nome}} da Obra</h4>
                        </div>
                        @if($errors->all)
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger" role="alert">
                                    {{$error}}
                                </div>
                            @endforeach
                        @endif
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="data_inicial_prevista_fase">Previsão de inicio</label>
                                        <input type="date" class="form-control" value="{{$fase_obra->inicio_previsto}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="data_final_prevista_fase">Previsão de finalização</label>
                                        <input type="date" class="form-control" value="{{$fase_obra->final_previsto}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="data_inicial_fase">Fase iniciada em</label>
                                        <input type="date" class="form-control" value="{{$fase_obra->inicio}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="data_final_fase">Fase finalizada em</label>
                                        <input type="date" class="form-control" value="{{$fase_obra->final}}">
                                    </div>
                                </div>
                                <div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleFormControlFile1">Imagens da fase</label>
                                                <input type="file" class="form-control-file"
                                                       id="exampleFormControlFile1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                @for($i = 0; $i < 15; $i++)
                                                    <img src="{{env('APP_URL')}}/storage/examples/example1-300x300.jpg"
                                                         class="img-thumbnail rounded float-left imagem_fase"
                                                         style="width:150px!important" alt="..."
                                                         data-imagem="{{env('APP_URL')}}/storage/examples/example1.jpeg">
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-action">
                                        <button type="submit" class="btn btn-success">Salvar</button>
                                        <a href="{{route('obras.show')}}" class="btn btn-danger">Cancelar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
