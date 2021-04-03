<?php
$seo['title'] = 'Lojas';
$MODULO = 'lojas';
$func = 'listar';
?>
@extends('layouts.app')
@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Lojas</h4>
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
                        <a>Lojas</a>
                    </li>
                </ul>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Ver Lojas</h4>
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
                                        <th>Nome</th>
                                        <th>Endereço</th>
                                        <th>Status</th>
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
                    url: '{{route('lojas.datatable')}}',
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
                    {data: 'endereco', name: 'endereco'},
                    {data: 'status', name: 'status'},
                    {data: 'acoes', name: 'acoes'},
                ],
            });
        </script>
    @endpush
@endsection