<?php
$seo['title'] = 'Obras';
$MODULO = 'obras';
$func = 'listar';
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
                    </ul>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Ver Obras</h4>
                            </div>
                            @if($errors->all)
                                @foreach($errors->all() as $error)
                                    <div class="alert alert-danger" role="alert">
                                        {{$error}}
                                    </div>
                                @endforeach
                            @endif
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="datatable" class="display table table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th>Cliente</th>
                                            <th>Orçamento</th>
                                            <th>Endereço</th>
                                            <th>Data Inicial</th>
                                            <th>Data Final</th>
                                            <th>Status</th>
                                            <th>Editar</th>
                                            <th>Excluir</th>
                                            <th>Gastos</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($obras as $obra)
                                            <?php
                                            if ($obra->data_inicio == null) {
                                                $obra->data_start = date('d/m/Y', strtotime($obra->data_inicio_prevista));
                                            } else {
                                                $obra->data_start = date('d/m/Y', strtotime($obra->data_inicio));
                                            }
                                            if ($obra->data_final == null) {
                                                $obra->data_end = date('d/m/Y', strtotime($obra->data_final_prevista));
                                            } else {
                                                $obra->data_end = date('d/m/Y', strtotime($obra->data_final));
                                            }
                                            if($obra->data_inicio == null && $obra->data_final == null){
                                                $obra->status_obra = 'Inativa';
                                            }elseif($obra->data_inicio != null && $obra->data_final == null){
                                                $obra->status_obra = 'Em andamento';
                                            }elseif($obra->data_inicio != null && $obra->data_final != null){
                                                $obra->status_obra = 'Concluida';
                                            }
                                            ?>
                                            <tr>
                                                <td>{{$obra->cliente()->first()->nome}}</td>
                                                <td>R$ {{$obra->orcamento}},00</td>
                                                <td>Rua {{$obra->rua}}, {{$obra->numero}} {{$obra->cidade}}
                                                    -{{$obra->uf}}</td>
                                                <td>{{$obra->data_start}}</td>
                                                <td>{{$obra->data_end}}</td>
                                                <td>{{$obra->status_obra}}</td>
                                                <td><a class="edit" href="{{route('obras.edit', ['obra'=>$obra->id])}}"><i
                                                            class="fa fa-edit"></i></a></td>
                                                <td><a data-csrf="{{csrf_token()}}" data-rota="{{route('obras.delete', ['obra'=>$obra->id])}}" data-id="{{$obra->id}}" class="deleta"><i class="fa fa-trash"></i></a></td>
                                                <td><a href="{{route('obras.relatorio', ['obra'=>$obra->id])}}"><i class="fa fa-chart-bar"></i></a></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
