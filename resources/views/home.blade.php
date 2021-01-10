<?php
$seo['title'] = 'Home';
$MODULO = 'home';
$func = '';
?>
@extends('layouts.app')
@section('content')
    <div class="content">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">{{env('APP_NAME')}}</h2>
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
