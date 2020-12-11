<?php
$seo['title'] = 'Home';
$MODULO = '';
$func = '';
?>
@extends('layouts.app')
@section('content')
    <div class="content">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">Belão&CIA Manegement System</h2>
                        <h5 class="text-white op-7 mb-2">O sistema de gerenciamento de obra da empresa
                            Belão&CIA</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-inner mt--5">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Obras Ativas</h4>
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
                                    $obra->gastos = 0;
                                    $salarios = $obra->faltas()->where('obra', '=', $obra->id)->get();
                                    foreach ($salarios as $salario) {
                                        $funcionarios = $salario->funcionario()->get();
                                        foreach ($funcionarios as $funcionario) {
                                            if ($salario->meio_dia) {
                                                $obra->gastos += $funcionario->salario_dia / 2;
                                            } else {
                                                $obra->gastos += $funcionario->salario_dia;
                                            }
                                        }

                                    }
                                    ?>
                                    <tr>
                                        <td class="dtr-control sorting_1">{{$obra->cliente()->first()->nome}}</td>
                                        <td>R${{number_format($obra->orcamento, 2, ',', '.')}}</td>
                                        <td>R${{number_format($obra->gastos, 2, ',', '.')}}</td>
                                        <td>Rua {{$obra->rua}}, {{$obra->numero}} {{$obra->cidade}}
                                            -{{$obra->uf}}</td>
                                        <td>{{$obra->data_start}}</td>
                                        <td><a class=""
                                               href="{{route('obras.edit', ['obra'=>$obra->id])}}"><i
                                                    class="fa fa-edit"></i></a></td>
                                        <td><a data-id="{{$obra->id}}" class="conclui" data-csrf="{{csrf_token()}}"
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
@endsection
