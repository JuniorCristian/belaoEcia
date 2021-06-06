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
                        <div class="card-header d-flex">
                            <h4 class="card-title">Ver Funcionários</h4>
                            <a class="add_novo bg-primary text-white font-weight-bold p-2" href="{{route('funcionarios.criar')}}"><i class="fa fa-plus-circle"></i> Novo</a>
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
@push('css')
    <style>
        .add_novo {
            margin-left: 86% !important;
        }
    </style>
@endpush
@push('scripts')
    <script>
        function reload() {
            dataTables.draw();
        }

        var dataTables = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.10.22/i18n/Portuguese-Brasil.json'
            },

            "pageLength": 100,
            fixedHeader: {
                header: true,
                footer: true
            },

            "ajax": {
                url: '{{route('funcionarios.datatable')}}',
                dataType: 'JSON',
                type: 'POST',
                beforeSend: function (xhr) {
                    xhr.setRequestHeader('Authorization');
                },
                data: function (d) {
                    d._token = "{{csrf_token()}}"
                },
            },
            columns: [
                {data: 'nome', name: 'nome'},
                {data: 'funcao', name: 'funcao'},
                {data: 'cpf', name: 'cpf'},
                {data: 'salario', name: 'salario'},
                {data: 'obras', name: 'obras'},
                {data: 'editar', name: 'editar'},
                {data: 'excluir', name: 'excluir'},
                {data: 'salarios', name: 'salarios'},
            ],
        });
    </script>
@endpush
