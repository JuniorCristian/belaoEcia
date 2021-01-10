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
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('obras.criar')}}">Nova Obra</a>
                    </li>
                </ul>
            </div>
            <form method="post" action="{{route('obras.update', ['obra'=>$obra->id])}}">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Nova Obra</div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="orcamento">Orçamento da obra</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">R$</span>
                                                </div>
                                                <input type="text" num id="orcamento" name="orcamento"
                                                       value="{{$obra->orcamento}}"
                                                       class="form-control"
                                                       aria-label="Amount (to the nearest dollar)" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">,00</span>
                                                </div>
                                            </div>
                                            <div class="invalid-feedback">
                                                Por favor informe um orçamento para a obra
                                            </div>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" id="mostra_orc_material"
                                                       name="has_orcamento_materiais"
                                                       {{($obra->has_orcamento_material)?'checked':''}}
                                                       type="checkbox" value="">
                                                <span class="form-check-sign">Orçameto dos materias</span>
                                            </label>
                                            <div class="form-group orc_material">
                                                <label for="orcamento">Orçamento dos materiais</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">R$</span>
                                                    </div>
                                                    <input type="number" num id="orcamento_materias"
                                                           name="orcamento_materias"
                                                           value="{{$obra->orcamento_material}}"
                                                           class="form-control"
                                                           aria-label="Amount (to the nearest dollar)">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">,00</span>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">
                                                    Por favor informe um orçamento de material para a obra
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="data_inicio">Data de inicio prevista</label>
                                            <input type="date" class="form-control" id="data_inicio_prevista"
                                                   value="{{date('Y-m-d', strtotime($obra->data_inicio_prevista))}}"
                                                   name="data_inicio_prevista" required>
                                            <div class="invalid-feedback">
                                                Por favor informe uma data de inicio para a obra
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="data_final">Data de final prevista</label>
                                            <input type="date" class="form-control" id="data_final_prevista"
                                                   value="{{date('Y-m-d', strtotime($obra->data_final_prevista))}}"
                                                   name="data_final_prevista" required>
                                            <div class="invalid-feedback">
                                                Por favor informe uma data de fim para a obra
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="data_inicio">Data iniciada</label>
                                            <input type="date"
                                                   value="{{($obra->data_inicio != null)?date('Y-m-d', strtotime($obra->data_inicio)):''}}"
                                                   class="form-control" id="data_inicio"
                                                   name="data_inicio">
                                        </div>
                                        <div class="form-group">
                                            <label for="data_final">Data finalizada</label>
                                            <input type="date"
                                                   value="{{($obra->data_final != null)?date('Y-m-d', strtotime($obra->data_final)):''}}"
                                                   class="form-control" id="data_final"
                                                   name="data_final">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="cep">CEP</label>
                                            <input type="text" value="{{$obra->cep}}" class="form-control" id="cep"
                                                   name="cep"
                                                   placeholder="Insira o CEP" required>
                                            <div class="invalid-feedback">
                                                Por favor informe o CEP da a obra
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="rua">Rua</label>
                                            <input type="text" value="{{$obra->rua}}" class="form-control" id="rua"
                                                   name="rua"
                                                   placeholder="Insira a rua" required>
                                            <div class="invalid-feedback">
                                                Por favor informe a rua da a obra
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="numero">Número</label>
                                            <input type="text" value="{{$obra->numero}}" class="form-control"
                                                   id="numero" name="numero"
                                                   placeholder="Insira o número">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="complemento">Complemento</label>
                                            <input type="text" value="{{$obra->complemento}}" class="form-control"
                                                   id="complemento"
                                                   name="complemento" placeholder="Insira o complemento">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="bairro">Bairro</label>
                                            <input type="text" value="{{$obra->bairro}}" class="form-control"
                                                   id="bairro" name="bairro"
                                                   placeholder="Insira o bairro" required>
                                            <div class="invalid-feedback">
                                                Por favor informe o bairro da a obra
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="cep">Cidade</label>
                                            <input type="text" value="{{$obra->cidade}}" class="form-control"
                                                   id="cidade" name="cidade"
                                                   placeholder="Insira a cidade" required>
                                            <div class="invalid-feedback">
                                                Por favor informe a cidade da a obra
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="uf">Estado</label>
                                            <select class="form-control" id="uf" name="uf" required>
                                                <option value="">Selecione um estado</option>
                                                <option {{($obra->uf == "AC")?"selected":""}} value="AC">Acre</option>
                                                <option {{($obra->uf == "AL")?"selected":""}} value="AL">Alagoas
                                                </option>
                                                <option {{($obra->uf == "AP")?"selected":""}} value="AP">Amapá</option>
                                                <option {{($obra->uf == "AM")?"selected":""}} value="AM">Amazonas
                                                </option>
                                                <option {{($obra->uf == "BA")?"selected":""}} value="BA">Bahia</option>
                                                <option {{($obra->uf == "CE")?"selected":""}} value="CE">Ceará</option>
                                                <option {{($obra->uf == "DF")?"selected":""}} value="DF">Distrito
                                                    Federal
                                                </option>
                                                <option {{($obra->uf == "ES")?"selected":""}} value="ES">Espírito
                                                    Santo
                                                </option>
                                                <option {{($obra->uf == "GO")?"selected":""}} value="GO">Goiás</option>
                                                <option {{($obra->uf == "MA")?"selected":""}} value="MA">Maranhão
                                                </option>
                                                <option {{($obra->uf == "MT")?"selected":""}} value="MT">Mato Grosso
                                                </option>
                                                <option {{($obra->uf == "MS")?"selected":""}} value="MS">Mato Grosso do
                                                    Sul
                                                </option>
                                                <option {{($obra->uf == "MG")?"selected":""}} value="MG">Minas Gerais
                                                </option>
                                                <option {{($obra->uf == "PA")?"selected":""}} value="PA">Pará</option>
                                                <option {{($obra->uf == "PB")?"selected":""}} value="PB">Paraíba
                                                </option>
                                                <option {{($obra->uf == "PR")?"selected":""}} value="PR">Paraná</option>
                                                <option {{($obra->uf == "PE")?"selected":""}} value="PE">Pernambuco
                                                </option>
                                                <option {{($obra->uf == "PI")?"selected":""}} value="PI">Piauí</option>
                                                <option {{($obra->uf == "RJ")?"selected":""}} value="RJ">Rio de
                                                    Janeiro
                                                </option>
                                                <option {{($obra->uf == "RN")?"selected":""}} value="RN">Rio Grande do
                                                    Norte
                                                </option>
                                                <option {{($obra->uf == "RS")?"selected":""}} value="RS">Rio Grande do
                                                    Sul
                                                </option>
                                                <option {{($obra->uf == "RO")?"selected":""}} value="RO">Rondônia
                                                </option>
                                                <option {{($obra->uf == "RR")?"selected":""}} value="RR">Roraima
                                                </option>
                                                <option {{($obra->uf == "SC")?"selected":""}} value="SC">Santa
                                                    Catarina
                                                </option>
                                                <option {{($obra->uf == "SP")?"selected":""}} value="SP">São Paulo
                                                </option>
                                                <option {{($obra->uf == "SE")?"selected":""}} value="SE">Sergipe
                                                </option>
                                                <option {{($obra->uf == "TO")?"selected":""}} value="TO">Tocantins
                                                </option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Por favor informe o estado da a obra
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-lg-4">
                                        <div class="funcionarios">
                                            <label for="funcionario">Funcionários</label><br>
                                            @foreach($funcionarios as $key=>$funcionario)
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input"
                                                               name="funcionario{{$funcionario->id}}"
                                                               @foreach($obra->funcionario as $f)
                                                               @if($funcionario->id == $f->id)
                                                               checked
                                                               @endif
                                                               @endforeach
                                                               type="checkbox">
                                                        <span class="form-check-sign">{{$funcionario->nome}}</span>
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                        <a href="{{route('funcionarios.criar')}}">Criar novo funcionário</a>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="cliente">Cliente</label>
                                            <select class="form-control" id="cliente" name="cliente" required>
                                                <option>Selecione um cliente</option>
                                                @foreach($clientes as $cliente)
                                                    <option {{($cliente->id == $obra->cliente) ? 'selected' : ''}} value="{{$cliente->id}}">{{$cliente->nome}}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                Por favor informe o cliente da a obra
                                            </div>
                                        </div>
                                        <a href="{{route('clientes.criar')}}">Criar novo cliente</a>
                                    </div>
                                </div>
                                <div class="card-action">
                                    <button type="submit" class="btn btn-success">Salvar</button>
                                    <a href="{{route('obras.show')}}" class="btn btn-danger">Cancelar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
