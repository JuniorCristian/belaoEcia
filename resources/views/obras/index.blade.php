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
                        <a>Obras</a>
                    </li>
                </ul>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex">
                            <h4 class="card-title">Ver Obras</h4>
                            <a class="add_novo bg-primary text-white font-weight-bold p-2"
                               href="{{route('obras.criar')}}"><i class="fa fa-plus-circle"></i> Nova</a>
                        </div>
                        @include('layouts.messages')
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
    @push('css')
        <style>
            .add_novo {
                margin-left: 89% !important;
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
                initComplete: function () {
                },
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.10.22/i18n/Portuguese-Brasil.json'
                },

                "pageLength": 100,
                fixedHeader: {
                    header: true,
                    footer: true
                },

                "ajax": {
                    url: '{{route('obras.datatable')}}',
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
                    {data: 'endereco', name: 'endereco'},
                    {data: 'data_inicial', name: 'data_inicial'},
                    {data: 'data_final', name: 'data_final'},
                    {data: 'status', name: 'status'},
                    {data: 'acoes', name: 'acoes'},
                ],
                "drawCallback":function (){
                    deleta();
                }
            });
            function deleta() {
                $('.deleta').off('click');
                $('.deleta').click(function () {
                    id = $(this).data('id');
                    Swal.fire({
                        title: "Tem certeza que deseja deletar essa obra?",
                        text: "Uma vez deletada você irá perder todos os dados dela",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                        .then((willDelete) => {
                            if (willDelete.isConfirmed) {
                                var form = $('<form action="obras/delete/'+ id +'" method="post">' +
                                    '<input type="hiden" name="_token" value="{{csrf_token()}}" />' +
                                    '<input type="hiden" name="_method" value="delete" />' +
                                    '<input type="hiden" name="obra" value="' + id + '" />' +
                                    '</form>');
                                $('body').append(form);
                                form.submit();
                            }
                        });
                });
            }
        </script>
    @endpush
@endsection
