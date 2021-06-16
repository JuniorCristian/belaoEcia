<?php
$seo['title'] = 'Orçamento Obra';
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
            @foreach($valores['preco_total'] as $key=>$preco_total)
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{\App\Models\Loja::where('id', $key)->first()->nome}}</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="datatable_loja_{{$key}}"
                                           class="display table table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th>Material</th>
                                            <th>Total usado</th>
                                            <th>Total gasto</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($preco_total as $nome_material=>$preco_material)
                                            @if($nome_material !== "total")
                                                <tr>
                                                    <td>{{\App\Models\Material::where('id', $preco_material['id_material'])->first()->nome}}</td>
                                                    <td>{{$preco_material['quantidade']}} {{$preco_material['unidade']}}</td>
                                                    <td>R${{number_format($preco_material['preco'], 2, ',', '.')}}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                            <td><span class="total_preco">Total: <span class="text-primary font-weight-bold">R$ {{number_format($preco_total['total'], 2, ',', '.')}}</span></span></td>
                                            <td></td>
                                            <td></td>
                                        </tfoot>
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
        @foreach($valores['preco_total'] as $key=>$preco_total)
        var dataTables{{$key}} = $('#datatable_loja_{{$key}}').DataTable({
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
        });
        @endforeach
    </script>
@endpush
