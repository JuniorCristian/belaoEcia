<?php
$seo['title'] = 'Clientes';
$MODULO = 'clientes';
$func = 'listar';
?>
@extends('layouts.app')
@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Clientes</h4>
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
                        <a href="{{route('clientes.show')}}">Clientes</a>
                    </li>
                </ul>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex">
                            <h4 class="card-title">Ver Clientes</h4>
                            <a class="add_novo bg-primary text-white font-weight-bold p-2" href="{{route('clientes.criar')}}"><i class="fa fa-plus-circle"></i> Novo</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable" class="display table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Telefone</th>
                                        <th>CPF/CNPJ</th>
                                        <th>Endereço da Obra</th>
                                        <th>Endereço</th>
                                        <th>Editar</th>
                                        <th>Excluir</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($clientes as $cliente)
                                        <?php $obra = $cliente->obras()->orderBy('created_at', 'DESC')->first();
                                        ?>
                                        <tr>
                                            <td>{{$cliente->nome}}</td>
                                            <td>{{$cliente->telefone}}</td>
                                            <td>{{$cliente->doc_identificacao}}</td>
                                            @if($obra != null)
                                                <td>Rua {{$obra->rua}}, {{$obra->numero}} {{$obra->cidade}}
                                                    -{{$obra->uf}}</td>
                                            @else
                                                <td>Sem obra cadastrada</td>
                                            @endif
                                            <td>Rua {{$cliente->rua}}, {{$cliente->numero}} {{$cliente->cidade}}
                                                -{{$cliente->uf}}</td>
                                            <td><a class="edit"
                                                   href="{{route('clientes.edit', ['cliente'=>$cliente->id])}}"><i
                                                        class="fa fa-edit"></i></a></td>
                                            <td><a data-csrf="{{csrf_token()}}"
                                                   data-rota="{{route('clientes.delete', ['cliente'=>$cliente->id])}}"
                                                   data-id="{{$cliente->id}}" class="deleta"><i class="fa fa-trash"></i></a>
                                            </td>
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
    @push('css')
        <style>
            .add_novo {
                margin-left: 88% !important;
            }
        </style>
    @endpush
@endsection
