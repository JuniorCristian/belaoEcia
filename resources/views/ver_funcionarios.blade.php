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
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Ver Funcionários</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable" class="display table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Função</th>
                                        <th>CPF</th>
                                        <th>Salário por dia</th>
                                        <th>Obras</th>
                                        <th>Editar</th>
                                        <th>Excluir</th>
                                        <th>Salários</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($funcionarios as $funcionario)
                                        <?php
                                        $num_obras = count($funcionario->obras()->get());
                                        ?>
                                        <tr>
                                            <td>{{$funcionario->nome}}</td>
                                            <td>{{$funcionario->funcao}}</td>
                                            <td>{{$funcionario->cpf}}</td>
                                            <td>R$ {{number_format($funcionario->salario_dia, 2, ',', '.')}}</td>
                                            <td>{{$num_obras}}</td>
                                            <td>
                                                <a href="{{route('funcionarios.edit', ['funcionario'=>$funcionario->id])}}"><i
                                                        class="fa fa-edit"></i></a></td>
                                            <td><a data-csrf="{{csrf_token()}}"
                                                   data-rota="{{route('funcionarios.delete', ['funcionario'=>$funcionario->id])}}"
                                                   data-id="{{$funcionario->id}}" class="deleta"><i
                                                        class="fa fa-trash"></i></a></td>
                                            <td>
                                                <a href="{{route('funcionarios.salario', ['funcionario'=>$funcionario->id])}}"><i
                                                        class="fa fa-money-bill-wave"></i></a></td>
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
