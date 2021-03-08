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
                                        <th>Ações</th>
                                    </tr>
                                    </thead>
                                    <tbody>
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
                url: '{{route('obras.datatableAtivas')}}',
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
                {data: 'cliente', name: 'cliente'},
                {data: 'orcamento', name: 'orcamento'},
                {data: 'gastos', name: 'gastos'},
                {data: 'endereco', name: 'endereco'},
                {data: 'data_start', name: 'data_start'},
                {data: 'acoes', name: 'acoes'},
            ],
        });
    </script>
@endpush
