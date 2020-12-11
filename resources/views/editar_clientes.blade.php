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
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('clientes.edit', ['cliente'=>$cliente->id])}}">Editar Cliente</a>
                    </li>
                </ul>
            </div>
            <form method="post" action="{{route('clientes.update', ['cliente'=>$cliente->id])}}">
                @csrf
                @method('put');
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Novo Cliente</div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="nome">Nome</label>
                                            <input value="{{$cliente->nome}}" type="text" id="nome" name="nome"
                                                   class="form-control" placeholder="Insira o nome do cliente">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="telefone">Telefone</label>
                                            <input value="{{$cliente->telefone}}" type="text" id="telefone"
                                                   name="telefone" class="form-control"
                                                   placeholder="Insira o telefone do cliente">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="documento">CPF/CNPJ</label>
                                            <input value="{{$cliente->doc_identificacao}}" type="text" id="documento"
                                                   name="doc_identificacao" class="form-control"
                                                   placeholder="Insira o CPF/CNPF do cliente">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="cep">CEP</label>
                                            <input value="{{$cliente->cep}}" type="text" class="form-control" id="cep"
                                                   name="cep" placeholder="Insira o CEP">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="rua">Rua</label>
                                            <input value="{{$cliente->rua}}" type="text" class="form-control" id="rua"
                                                   name="rua" placeholder="Insira a rua">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="numero">Número</label>
                                            <input value="{{$cliente->numero}}" type="text" class="form-control"
                                                   id="numero" name="numero" placeholder="Insira o número">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="complemento">Complemento</label>
                                            <input value="{{$cliente->complemento}}" type="text" class="form-control"
                                                   id="complemento" name="complemento"
                                                   placeholder="Insira o complemento">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="bairro">Bairro</label>
                                            <input value="{{$cliente->bairro}}" type="text" class="form-control"
                                                   id="bairro" name="bairro" placeholder="Insira o bairro">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="cep">Cidade</label>
                                            <input value="{{$cliente->cidade}}" type="text" class="form-control"
                                                   id="cidade" name="cidade" placeholder="Insira a cidade">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="uf">Estado</label>
                                            <select class="form-control" id="uf" name="uf">
                                                <option>Selecione um estado</option>
                                                <option {{($cliente->uf == 'AC')?'selected':''}} value="AC">Acre
                                                </option>
                                                <option {{($cliente->uf == 'AL')?'selected':''}} value="AL">Alagoas
                                                </option>
                                                <option {{($cliente->uf == 'AP')?'selected':''}} value="AP">Amapá
                                                </option>
                                                <option {{($cliente->uf == 'AM')?'selected':''}} value="AM">Amazonas
                                                </option>
                                                <option {{($cliente->uf == 'BA')?'selected':''}} value="BA">Bahia
                                                </option>
                                                <option {{($cliente->uf == 'CE')?'selected':''}} value="CE">Ceará
                                                </option>
                                                <option {{($cliente->uf == 'DF')?'selected':''}} value="DF">Distrito
                                                    Federal
                                                </option>
                                                <option {{($cliente->uf == 'ES')?'selected':''}} value="ES">Espírito
                                                    Santo
                                                </option>
                                                <option {{($cliente->uf == 'GO')?'selected':''}} value="GO">Goiás
                                                </option>
                                                <option {{($cliente->uf == 'MA')?'selected':''}} value="MA">Maranhão
                                                </option>
                                                <option {{($cliente->uf == 'MT')?'selected':''}} value="MT">Mato
                                                    Grosso
                                                </option>
                                                <option {{($cliente->uf == 'MS')?'selected':''}} value="MS">Mato Grosso
                                                    do Sul
                                                </option>
                                                <option {{($cliente->uf == 'MG')?'selected':''}} value="MG">Minas
                                                    Gerais
                                                </option>
                                                <option {{($cliente->uf == 'PA')?'selected':''}} value="PA">Pará
                                                </option>
                                                <option {{($cliente->uf == 'PB')?'selected':''}} value="PB">Paraíba
                                                </option>
                                                <option {{($cliente->uf == 'PR')?'selected':''}} value="PR">Paraná
                                                </option>
                                                <option {{($cliente->uf == 'PE')?'selected':''}} value="PE">Pernambuco
                                                </option>
                                                <option {{($cliente->uf == 'PI')?'selected':''}} value="PI">Piauí
                                                </option>
                                                <option {{($cliente->uf == 'RJ')?'selected':''}} value="RJ">Rio de
                                                    Janeiro
                                                </option>
                                                <option {{($cliente->uf == 'RN')?'selected':''}} value="RN">Rio Grande
                                                    do Norte
                                                </option>
                                                <option {{($cliente->uf == 'RS')?'selected':''}} value="RS">Rio Grande
                                                    do Sul
                                                </option>
                                                <option {{($cliente->uf == 'RO')?'selected':''}} value="RO">Rondônia
                                                </option>
                                                <option {{($cliente->uf == 'RR')?'selected':''}} value="RR">Roraima
                                                </option>
                                                <option {{($cliente->uf == 'SC')?'selected':''}} value="SC">Santa
                                                    Catarina
                                                </option>
                                                <option {{($cliente->uf == 'SP')?'selected':''}} value="SP">São Paulo
                                                </option>
                                                <option {{($cliente->uf == 'SE')?'selected':''}} value="SE">Sergipe
                                                </option>
                                                <option {{($cliente->uf == 'TO')?'selected':''}} value="TO">Tocantins
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-action">
                                    <button type="submit" class="btn btn-success">Salvar</button>
                                    <a href="{{route('clientes.show')}}" class="btn btn-danger">Cancelar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
