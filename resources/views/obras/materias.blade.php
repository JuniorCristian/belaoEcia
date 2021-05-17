<?php
$seo['title'] = 'Materiais da Obra';
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
                        <a href="{{route('obras.show')}}">Obras</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a>Materias da Obra</a>
                    </li>
                </ul>
            </div>
            <form method="post" action="{{route('obras.store')}}" class="needs-validation" novalidate>
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Gerenciar Materiais</div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="material">Material</label>
                                            <select name="material" id="material" class="form-control">
                                                <option value="1">Cimento CP II 50 Kg Todas Obras Votoran</option>
                                                <option value="2">Cimento</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="data_compra">Data da compra</label>
                                            <input type="date" value="{{date('Y-m-d')}}" max="{{date('Y-m-d')}}"
                                                   class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="Quantidade">Quantidade</label>
                                            <input type="number" min="1" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="loja">Loja</label>
                                            <select name="loja" id="loja" class="form-control">
                                                <option value="1">Balaroti</option>
                                                <option value="2">Leroy Merlin</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="preco">Preço unitário</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">R$</span>
                                                </div>
                                                <input type="text" num id="preco" name="preco"
                                                       value=""
                                                       class="form-control money"
                                                       aria-label="Amount (to the nearest dollar)" required>
                                            </div>
                                            <div class="invalid-feedback">
                                                Por favor informe um orçamento para a obra
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="fase">Fase</label>
                                            <select name="fase" id="fase" class="form-control">
                                                <option value="1">Fase 1</option>
                                                <option value="2">Fase 2</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row bg-primary mt-3 ml-3 mr-3">
                                    <div
                                        class="p-3 col-md-3 text-white font-weight-bold border-bottom border-top border-right border-left">
                                        Material
                                    </div>
                                    <div
                                        class="p-3 col-md-2 text-white font-weight-bold border-bottom border-top border-right">
                                        Data da compra
                                    </div>
                                    <div
                                        class="p-3 col-md-1 text-white font-weight-bold border-bottom border-top border-right">
                                        Quantidade
                                    </div>
                                    <div
                                        class="p-3 col-md-2 text-white font-weight-bold border-bottom border-top border-right">
                                        Loja
                                    </div>
                                    <div
                                        class="p-3 col-md-1 text-white font-weight-bold border-bottom border-top border-right">
                                        Preço Unitário
                                    </div>
                                    <div
                                        class="p-3 col-md-2 text-white font-weight-bold border-bottom border-top border-right">
                                        Fase
                                    </div>
                                    <div
                                        class="p-3 col-md-1 text-white font-weight-bold border-bottom border-top border-right">
                                        Ações
                                    </div>
                                </div>
                                @for($i = 0; $i < 3; $i++)
                                    <div class="row ml-3 mr-3">
                                        <div class="p-3 col-md-3 border-bottom border-top border-right border-left">
                                            Cimento CP II 50 Kg Todas Obras Votoran
                                        </div>
                                        <div class="p-3 col-md-2 border-bottom border-top border-right">17/05/2021</div>
                                        <div class="p-3 col-md-1 border-bottom border-top border-right">5</div>
                                        <div class="p-3 col-md-2 border-bottom border-top border-right">Balaroti</div>
                                        <div class="p-3 col-md-1 border-bottom border-top border-right">R$ 27,90</div>
                                        <div class="p-3 col-md-2 border-bottom border-top border-right">Fase 1</div>
                                        <div class="p-3 col-md-1 border-bottom border-top border-right">
                                            <div class='botoes-datatable ml-1'>
                                                <a class="editar-datatable text-white"><i class="fa fa-edit"></i></a>
                                                <a class="excluir-datatable text-white"><i class="fa fa-trash"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
