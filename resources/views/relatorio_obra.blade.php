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
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" id="a_pagar"
                                               type="checkbox" checked>
                                        <span class="form-check-sign">A pagar</span>
                                    </label>
                                    <label class="form-check-label">
                                        <input class="form-check-input" id="pago"
                                               type="checkbox" checked>
                                        <span class="form-check-sign">Pago</span>
                                    </label>
                                </div>

                                <div class="align-items-xl-end">
                                    <div class="card-body">
                                        <button id="btn-filtrar" class="btn btn-primary btn-filtrar">Filtrar</button>
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
                            <div class="col-lg-12" style="text-align: right;">
                                <button class="btn btn-primary btn-pagar">Pagar todos</button>
                            </div>
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
                                        <th>Pagamento</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Total</th>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td id="total"></td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @foreach($funcionarios as $key=>$funcionario)
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{$funcionario->nome}}</h4>
                                <div class="col-lg-12" style="text-align: right;">
                                    <button data-funcionario="{{$funcionario->id}}" class="btn btn-primary btn-pagar">
                                        Pagar
                                    </button>
                                </div>
                                <input type="hidden" id="idFuncionario{{$key}}" value="{{$funcionario->id}}">
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
                                            <th>Pagamento</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <thead>
                                        <tr>
                                            <th>Total</th>
                                            <th></th>
                                            <th></th>
                                            <td id="total{{$key}}"></td>
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
@endsection

@push("scripts")
    <script>
        function reload() {
            var $data_inicio = $('#data_inicio').val();
            var $data_final = $('#data_final').val();
            dataTables.draw();
            @for($i = 0; $i <= $key; $i++)
            dataTables{{$i}}.draw();
            @endfor
        }

        var dataTables = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            language: {
                "sEmptyTable": "Nenhum registro encontrado",
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                "sInfoThousands": ".",
                "sLengthMenu": "_MENU_ resultados por página",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sZeroRecords": "Nenhum registro encontrado",
                "sSearch": "Pesquisar",
                "oPaginate": {
                    "sNext": "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst": "Primeiro",
                    "sLast": "Último"
                },
                "oAria": {
                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                },
                "select": {
                    "rows": {
                        "_": "Selecionado %d linhas",
                        "0": "Nenhuma linha selecionada",
                        "1": "Selecionado 1 linha"
                    }
                },
                "buttons": {
                    "copy": "Copiar para a área de transferência",
                    "copyTitle": "Cópia bem sucedida",
                    "copySuccess": {
                        "1": "Uma linha copiada com sucesso",
                        "_": "%d linhas copiadas com sucesso"
                    }
                }
            },
            paging: true,
            fixedHeader: {
                header: true,
                footer: true
            },

            "ajax": {
                url: '{{route('obras.dataRelatorio', ['obra'=>$obra->id])}}',
                dataType: 'JSON',
                type: 'POST',
                beforeSend: function (xhr) {
                    xhr.setRequestHeader('Authorization');
                },
                data: function (d) {
                    d.data_inicio = $('#data_inicio').val();
                    d.data_final = $('#data_final').val();
                    d._token = "{{csrf_token()}}";
                    d.a_pagar = $('#a_pagar').prop('checked');
                    d.pago = $('#pago').prop('checked');
                    d.funcionario = $('#idFuncionario{{$i}}').val();
                },
            },
            "drawCallback": function(settings) {
                console.log(settings.json);
                $("#total").html(settings.json.salario_total);
            },
            columns: [
                {data: 'nome', name: 'nome'},
                {data: 'num_faltas', name: 'num_faltas'},
                {data: 'num_meio_dia', name: 'num_meios_dias'},
                {data: 'salario_mes', name: 'salario_mes'},
                {data: 'tempo_pago', name: 'tempo_pago'},
            ],
        });
        @for($i = 0; $i <= $key; $i++)
        var dataTables{{$i}} = $('#datatable{{$i}}').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            language: {
                "sEmptyTable": "Nenhum registro encontrado",
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                "sInfoThousands": ".",
                "sLengthMenu": "_MENU_ resultados por página",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sZeroRecords": "Nenhum registro encontrado",
                "sSearch": "Pesquisar",
                "oPaginate": {
                    "sNext": "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst": "Primeiro",
                    "sLast": "Último"
                },
                "oAria": {
                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                },
                "select": {
                    "rows": {
                        "_": "Selecionado %d linhas",
                        "0": "Nenhuma linha selecionada",
                        "1": "Selecionado 1 linha"
                    }
                },
                "buttons": {
                    "copy": "Copiar para a área de transferência",
                    "copyTitle": "Cópia bem sucedida",
                    "copySuccess": {
                        "1": "Uma linha copiada com sucesso",
                        "_": "%d linhas copiadas com sucesso"
                    }
                }
            },

            "pageLength": 100,
            fixedHeader: {
                header: true,
                footer: true
            },
            $data_inicio: $('#data_inicio').val(),
            $data_final: $('#data_final').val(),
            "ajax": {
                url: '{{route('obras.dataRelatorioFuncionario', ['obra'=>$obra->id])}}',
                dataType: 'JSON',
                type: 'POST',
                beforeSend: function (xhr) {
                    xhr.setRequestHeader('Authorization');
                },
                data: function (d) {
                    d.data_inicio = $('#data_inicio').val();
                    d.data_final = $('#data_final').val();
                    d._token = "{{csrf_token()}}";
                    d.a_pagar = $('#a_pagar').prop('checked');
                    d.pago = $('#pago').prop('checked');
                    d.funcionario = $('#idFuncionario{{$i}}').val();
                },
            },
            "drawCallback": function(settings) {
                $("#total{{$i}}").html(settings.json.salario_total);
            },
            columns: [
                {data: 'data', name: 'data'},
                {data: 'falta', name: 'falta'},
                {data: 'salario_dia', name: 'salario_dia'},
                {data: 'dia_pago', name: 'dia_pago'},
            ],
        });
        @endfor
        $("#btn-filtrar").click(function () {
            reload();
        });
        $(".btn-pagar").click(function () {
            $.post('{{route('funcionarios.pagar', ['obra'=>$obra->id])}}',
                {
                    data_inicio: $('#data_inicio').val(),
                    data_final: $('#data_final').val(),
                    _token: "{{csrf_token()}}",
                    funcionario: $(this).data('funcionario'),
                }
            ).done(function (data) {
                if (data.status) {
                    reload();
                }
            })
            ;
        });
    </script>
@endpush
