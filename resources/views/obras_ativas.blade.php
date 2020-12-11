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
                        <a href="{{route('obras.ativas')}}">Obras Ativas</a>
                    </li>
                </ul>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Ver Obras Ativas</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable" class="display table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>Cliente</th>
                                        <th>Orçamento</th>
                                        <th>Gastos</th>
                                        <th>Endereço</th>
                                        <th>Data de Inicio</th>
                                        <th>Editar</th>
                                        <th>Concluir</th>
                                        <th>Faltas</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($obras as $obra)
                                        @if($obra->data_inicio != null && $obra->data_final == null)
                                            <?php
                                            if ($obra->data_inicio == null) {
                                                $obra->data_start = date('d/m/Y', strtotime($obra->data_inicio_prevista));
                                            } else {
                                                $obra->data_start = date('d/m/Y', strtotime($obra->data_inicio));
                                            }
                                            $obra->gastos = 20;
                                            ?>
                                            <tr>
                                                <td>{{$obra->cliente()->first()->nome}}</td>
                                                <td>R$ {{$obra->orcamento}},00</td>
                                                <td>R$ {{$obra->gastos}},00</td>
                                                <td>Rua {{$obra->rua}}, {{$obra->numero}} {{$obra->cidade}}
                                                    -{{$obra->uf}}</td>
                                                <td>{{$obra->data_start}}</td>
                                                <td><a class=""
                                                       href="{{route('obras.edit', ['obra'=>$obra->id])}}"><i
                                                            class="fa fa-edit"></i></a></td>
                                                <td><a data-id="{{$obra->id}}" class="conclui"
                                                       data-csrf="{{csrf_token()}}"
                                                       data-rota="{{route('obras.concluir', ['obra'=>$obra->id])}}"><i
                                                            class="fa fa-check"></i></a></td>
                                                <td><a href="{{route('obras.faltas', ['obra'=>$obra->id])}}"><i
                                                            class="fas fa-hard-hat"></i></a></td>
                                            </tr>
                                        @endif
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
