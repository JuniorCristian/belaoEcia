<?php
$seo['title'] = 'Obras';
$MODULO = 'obras';
$func = 'listar';
?>
@extends('layout.app')
@section('content')

    <div class="main-panel">
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
                                                    <input type="number" num id="orcamento" name="orcamento"
                                                           class="form-control"
                                                           value="{{$obra->orcamento}}"
                                                           aria-label="Amount (to the nearest dollar)">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">,00</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="">
                                                <label class="form-check-label">
                                                    <input class="" id="mostra_orc_material"
                                                           name="has_orcamento_materiais"
                                                           {{($obra->has_orcamento_material)?'checked':''}}
                                                           type="checkbox">
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
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label for="data_inicio">Data de inicio prevista</label>
                                                <input type="date"
                                                       value="{{date('Y-m-d', strtotime($obra->data_inicio_prevista))}}"
                                                       class="form-control" id="data_inicio_prevista"
                                                       name="data_inicio_prevista">
                                            </div>
                                            <div class="form-group">
                                                <label for="data_final">Data de final prevista</label>
                                                <input type="date"
                                                       value="{{date('Y-m-d', strtotime($obra->data_final_prevista))}}"
                                                       class="form-control" id="data_final_prevista"
                                                       name="data_final_prevista">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label for="data_inicio">Data de iniciada</label>
                                                <input type="date"
                                                       value="{{($obra->data_inicio != null)?date('Y-m-d', strtotime($obra->data_inicio)):''}}"
                                                       class="form-control" id="data_inicio"
                                                       name="data_inicio">
                                            </div>
                                            <div class="form-group">
                                                <label for="data_final">Data de finalizada</label>
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
                                                       name="cep" placeholder="Insira o CEP">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label for="rua">Rua</label>
                                                <input type="text" value="{{$obra->rua}}" class="form-control" id="rua"
                                                       name="rua" placeholder="Insira a rua">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label for="numero">Número</label>
                                                <input type="text" value="{{$obra->numero}}" class="form-control"
                                                       id="numero" name="numero" placeholder="Insira o número">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label for="complemento">Complemento</label>
                                                <input type="text" value="{{$obra->complemento}}" class="form-control"
                                                       id="complemento" placeholder="Insira o complemento"
                                                       name="complemento">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label for="bairro">Bairro</label>
                                                <input type="text" value="{{$obra->bairro}}" class="form-control"
                                                       id="bairro" name="bairro" placeholder="Insira o bairro">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label for="cep">Cidade</label>
                                                <input type="text" value="{{$obra->cidade}}" class="form-control"
                                                       id="cidade" name="cidade" placeholder="Insira a cidade">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label for="uf">Estado</label>
                                                <select class="form-control" id="uf" name="uf">
                                                    <option>Selecione um estado</option>
                                                    <option value="AC">Acre</option>
                                                    <option value="AL">Alagoas</option>
                                                    <option value="AP">Amapá</option>
                                                    <option value="AM">Amazonas</option>
                                                    <option value="BA">Bahia</option>
                                                    <option value="CE">Ceará</option>
                                                    <option value="DF">Distrito Federal</option>
                                                    <option value="ES">Espírito Santo</option>
                                                    <option value="GO">Goiás</option>
                                                    <option value="MA">Maranhão</option>
                                                    <option value="MT">Mato Grosso</option>
                                                    <option value="MS">Mato Grosso do Sul</option>
                                                    <option value="MG">Minas Gerais</option>
                                                    <option value="PA">Pará</option>
                                                    <option value="PB">Paraíba</option>
                                                    <option value="PR">Paraná</option>
                                                    <option value="PE">Pernambuco</option>
                                                    <option value="PI">Piauí</option>
                                                    <option value="RJ">Rio de Janeiro</option>
                                                    <option value="RN">Rio Grande do Norte</option>
                                                    <option value="RS">Rio Grande do Sul</option>
                                                    <option value="RO">Rondônia</option>
                                                    <option value="RR">Roraima</option>
                                                    <option value="SC">Santa Catarina</option>
                                                    <option value="SP">São Paulo</option>
                                                    <option value="SE">Sergipe</option>
                                                    <option value="TO">Tocantins</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-lg-4">
                                            <div class="">
                                                <label for="funcionario">Funcionários</label><br>
                                                @foreach($funcionarios as $funcionario)
                                                    <label class="form-check-label">
                                                        <input class="" name="funcionario{{$funcionario->id}}"
                                                               @foreach($obra->funcionario as $f)
                                                               @if($funcionario->id == $f->id)
                                                               checked
                                                               @endif
                                                               @endforeach
                                                               type="checkbox">
                                                        <span class="form-check-sign">{{$funcionario->nome}}</span>
                                                    </label>
                                                @endforeach
                                            </div>
                                            <a href="{{route('funcionarios.criar')}}">Criar novo funcionário</a>
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label for="cliente">Cliente</label>
                                                <select class="form-control" id="cliente" name="cliente">
                                                    <option>Selecione um cliente</option>
                                                    @foreach($clientes as $cliente)
                                                        <option
                                                            <?php echo ($cliente->id == $obra->cliente) ? 'selected' : ''?> value="{{$cliente->id}}">{{$cliente->nome}}</option>
                                                    @endforeach
                                                </select>
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
    </div>
@endsection
