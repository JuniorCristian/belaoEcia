@php
    $seo['title'] = 'Fases';
    $MODULO = 'fases';
    $func = 'listar';
@endphp
@extends('layouts.app')
@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Fases</h4>
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
                        <a href="{{route('fases.index')}}">Fases</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex">
                            <h4 class="card-title">Ver Fases</h4>
                            <a class="add_novo bg-primary text-white font-weight-bold p-2" href="{{route('fases.criar')}}"><i class="fa fa-plus-circle"></i> Nova</a>
                        </div>
                        <div class="card-body">
                            @include('layouts.messages')
                            <div class="table-responsive">
                                <table id="datatable" class="display table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Descrição</th>
                                        <th>Tipo de Obra</th>
                                        <th>Status</th>
                                        <th>Ações</th>
                                    </tr>
                                    </thead>
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
                url: '{{route('fases.datatable')}}',
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
                {data: 'descricao', name: 'descricao'},
                {data: 'tipo', name: 'tipo'},
                {data: 'status', name: 'status'},
                {data: 'acoes', name: 'acoes'}
            ],
            "drawCallback":function (){
                deleta();
            }
        });
        function deleta() {
            $('.deleta').click(function () {
                id = $(this).data('id');
                Swal.fire({
                    title: "Tem certeza que deseja deletar essa fase?",
                    text: "Uma vez deletada você irá perder todos os dados dela",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete.isConfirmed) {
                            var form = $('<form action="fases/delete/'+ id +'" method="post">' +
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
