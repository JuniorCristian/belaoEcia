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
                            <div class="card-title">Filtrar</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group">
                                    <label for="data_inicio">Data de início</label>
                                    <input type="date" class="form-control" id="data_inicio"
                                           name="data_inicio">
                                </div>
                                <div class="form-group">
                                    <label for="data_inicio">Data final</label>
                                    <input type="date" class="form-control" id="data_final"
                                           name="data_final">
                                </div>
                                <div class="align-items-xl-end">
                                    <div class="card-body">
                                        <button class="btn btn-primary">Filtrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Obra de {{$obra->cliente()->first()->nome}}</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable"
                                       class="display table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>Nome funcionário</th>
                                        <th>Número de Faltas</th>
                                        <th>Meios dias</th>
                                        <th>Salário do mês</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($funcionarios as $funcionario)
                                        @foreach($salarios as $salario)
                                            @if($salario->funcionario == $funcionario->id)
                                                <?php
                                                $funcionario->num_faltas = 0;
                                                $funcionario->meio_dia = 0;
                                                if ($salario->falta) {
                                                    $funcionario->num_faltas += 1;
                                                } elseif ($salario->meio_dia) {
                                                    $funcionario->meio_dia += 1;
                                                    $obra->salario_total += $funcionario->salario_dia / 2;
                                                } else {
                                                    $obra->salario_total += $funcionario->salario_dia;
                                                }
                                                $funcionario->salario += $salario->valor;
                                                ?>
                                            @endif
                                        @endforeach
                                        <tr>
                                            <td>{{$funcionario->nome}}</td>
                                            <td>{{$funcionario->num_faltas}}</td>
                                            <td>{{$funcionario->meio_dia}}</td>
                                            <td>R${{number_format($funcionario->salario, 2, ',', '.')}}</td>
                                        </tr>

                                    @endforeach
                                    </tbody>
                                    <thead>
                                    <tr>
                                        <th>Total do mês</th>
                                        <td>R$ {{number_format($obra->salario_total, 2, ',', '.')}}</td>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @foreach($funcionarios as $key=>$funcionario)
                <?php $funcionario->salario = 0.00;?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{$funcionario->nome}}</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="datatable{{$key}}"
                                           class="display table table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th>Data</th>
                                            <th>Falta</th>
                                            <th>Salário no dia</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($salarios as $salario)
                                            @if($salario->funcionario == $funcionario->id)
                                                <?php
                                                $salario->data = date('d/m/Y', strtotime($salario->created_at));
                                                if ($salario->falta) {
                                                    $salario->status_salario_dia = 'Faltou';
                                                } elseif ($salario->meio_dia) {
                                                    $salario->status_salario_dia = 'Meio Dia';
                                                } else {
                                                    $salario->status_salario_dia = 'Dia completo';
                                                }
                                                $funcionario->salario += $salario->valor;
                                                ?>
                                                <tr>
                                                    <td>{{$salario->data}}</td>
                                                    <td>{{$salario->status_salario_dia}}</td>
                                                    <td>R${{number_format($salario->valor, 2, ',', '.')}}</td>
                                                </tr>
                                        @endif
                                        @endforeach
                                        </tbody>
                                        <thead>
                                        <tr>
                                            <th>Total Obra</th>
                                            <td>R$ {{number_format($funcionario->salario, 2, ',', '.')}}</td>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <input type="hidden" value="{{$key}}" id="valorDatatable">
    <script>
        import Input from "@/../../public/js/Jetstream/Input";
        import Button from "../../public/js/Jetstream/Button";

        export default {
            components: {Button, Input}
        }
    </script>
@endsection
