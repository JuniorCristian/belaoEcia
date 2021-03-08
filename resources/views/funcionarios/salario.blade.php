<?php
$seo['title'] = 'Funcionários';
$MODULO = 'funcionarios';
$func = 'listar';
?>
@extends('layouts.app')
@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Funcionários</h4>
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
                        <a href="{{route('funcionarios.show')}}">Funcionários</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('funcionarios.salario', ['funcionario'=>$funcionario->id])}}">Salário
                            Funcionário</a>
                    </li>
                </ul>
            </div>
            @foreach($obras as $key=>$obra)
                <?php $obra->salario = 0.00;?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Obra de {{$obra->cliente()->first()->nome}}</h4>
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
                                            @if($salario->obra == $obra->id)
                                                <?php
                                                $salario->data = date('d/m/Y', strtotime($salario->created_at));
                                                if ($salario->falta) {
                                                    $salario->status_salario_dia = 'Faltou';
                                                    $salario->salario_dia = 0.00;
                                                } elseif ($salario->meio_dia) {
                                                    $salario->status_salario_dia = 'Meio Dia';
                                                    $salario->salario_dia = $funcionario->salario_dia / 2;
                                                    $obra->salario += $funcionario->salario_dia / 2;
                                                } else {
                                                    $salario->status_salario_dia = 'Dia completo';
                                                    $salario->salario_dia = $funcionario->salario_dia;
                                                    $obra->salario += $funcionario->salario_dia;
                                                }
                                                ?>
                                                <tr>
                                                    <td>{{$salario->data}}</td>
                                                    <td>{{$salario->status_salario_dia}}</td>
                                                    <td>R${{number_format($salario->salario_dia, 2, ',', '.')}}</td>
                                                </tr>
                                        @endif
                                        @endforeach
                                        <thead>
                                        <tr>
                                            <th>Total Obra</th>
                                            <td></td>
                                            <td>R$ {{number_format($obra->salario, 2, ',', '.')}}</td>
                                        </tr>
                                        </thead>
                                        </tbody>
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
@endsection
