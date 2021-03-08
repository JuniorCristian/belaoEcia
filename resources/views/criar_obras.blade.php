<?php
$seo['title'] = 'Obras';
$MODULO = 'obras';
$func = 'criar';
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
            <form method="post" action="{{route('obras.store')}}" class="needs-validation" novalidate>
                @csrf
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
                                                       class="form-control money"
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
                                                           class="form-control money"
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
                                                   name="data_inicio_prevista" required>
                                            <div class="invalid-feedback">
                                                Por favor informe uma data de inicio para a obra
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="data_final">Data de final prevista</label>
                                            <input type="date" class="form-control" id="data_final_prevista"
                                                   name="data_final_prevista" required>
                                            <div class="invalid-feedback">
                                                Por favor informe uma data de fim para a obra
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="cep">CEP</label>
                                            <input type="text" class="form-control" id="cep" name="cep"
                                                   placeholder="Insira o CEP" required>
                                            <div class="invalid-feedback">
                                                Por favor informe o CEP da a obra
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="rua">Rua</label>
                                            <input type="text" class="form-control" id="rua" name="rua"
                                                   placeholder="Insira a rua" required>
                                            <div class="invalid-feedback">
                                                Por favor informe a rua da a obra
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="numero">Número</label>
                                            <input type="text" class="form-control" id="numero" name="numero"
                                                   placeholder="Insira o número">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="complemento">Complemento</label>
                                            <input type="text" class="form-control" id="complemento"
                                                   name="complemento" placeholder="Insira o complemento">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="bairro">Bairro</label>
                                            <input type="text" class="form-control" id="bairro" name="bairro"
                                                   placeholder="Insira o bairro" required>
                                            <div class="invalid-feedback">
                                                Por favor informe o bairro da a obra
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="cep">Cidade</label>
                                            <input type="text" class="form-control" id="cidade" name="cidade"
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
                                                    <option value="{{$cliente->id}}">{{$cliente->nome}}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                Por favor informe o cliente da a obra
                                            </div>
                                        </div>
                                        <a class="novo_cliente">Criar novo cliente</a>
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
    @push('scripts')
        <script>
            $('.novo_cliente').click(function () {
                Swal.fire({
                    title: "Cadastras novo Cliente",
                    html: '<div class="card-body">'+
                    '            <div class="row">'+
                    '               <div class="col-md-6 col-lg-4">'+
                    '                   <div class="form-group">'+
                    '                       <label for="nome">Nome</label>'+
                    '                       <input type="text" id="nome" name="nome" class="form-control"'+
                    '                           placeholder="Insira o nome do cliente">'+
                    '                   </div>'+
                    '               </div>'+
                    '               <div class="col-md-6 col-lg-4">'+
                    '                   <div class="form-group">'+
                    '                       <label for="telefone">Telefone</label>'+
                    '                       <input type="text" id="telefone" name="telefone" class="telefone form-control"'+
                    '                           placeholder="Insira o telefone do cliente">'+
                    '                   </div>'+
                    '               </div>'+
                    '               <div class="col-md-6 col-lg-4">'+
                    '                   <div class="form-group">'+
                    '                       <label for="documento">CPF/CNPJ</label>'+
                    '                       <input type="text" id="documento" name="doc_identificacao"'+
                    '                           class="form-control doc_identificacao" placeholder="Insira o CPF/CNPF do cliente">'+
                    '                   </div>'+
                    '               </div>'+
                    '               <div class="col-md-6 col-lg-4">'+
                    '                   <div class="form-group">'+
                    '                       <label for="cep">CEP</label>'+
                    '                       <input type="text" class="form-control cep" id="cep" name="cep"'+
                    '                           placeholder="Insira o CEP">'+
                    '                   </div>'+
                    '               </div>'+
                    '               <div class="col-md-6 col-lg-4">'+
                    '                   <div class="form-group">'+
                    '                       <label for="rua">Rua</label>'+
                    '                       <input type="text" class="form-control" id="rua" name="rua"'+
                    '                           placeholder="Insira a rua">'+
                    '                   </div>'+
                    '               </div>'+
                    '               <div class="col-md-6 col-lg-4">'+
                    '                   <div class="form-group">'+
                    '                       <label for="numero">Número</label>'+
                    '                       <input type="text" class="form-control" id="numero" name="numero"'+
                    '                           placeholder="Insira o número">'+
                    '                   </div>'+
                    '               </div>'+
                    '               <div class="col-md-6 col-lg-4">'+
                    '                   <div class="form-group">'+
                    '                       <label for="complemento">Complemento</label>'+
                    '                       <input type="text" class="form-control" id="complemento" name="complemento"'+
                    '                           placeholder="Insira a complemento">'+
                    '                   </div>'+
                    '               </div>'+
                    '               <div class="col-md-6 col-lg-4">'+
                    '                   <div class="form-group">'+
                    '                       <label for="bairro">Bairro</label>'+
                    '                       <input type="text" class="form-control" id="bairro" name="bairro"'+
                    '                           placeholder="Insira o bairro">'+
                    '                   </div>'+
                    '               </div>'+
                    '               <div class="col-md-6 col-lg-4">'+
                    '                   <div class="form-group">'+
                    '                       <label for="cep">Cidade</label>'+
                    '                       <input type="text" class="form-control" id="cidade" name="cidade"'+
                    '                           placeholder="Insira a cidade">'+
                    '                   </div>'+
                    '               </div>'+
                    '               <div class="col-md-6 col-lg-4">'+
                    '                   <div class="form-group">'+
                    '                       <label for="uf">Estado</label>'+
                    '                       <select class="form-control" id="uf" name="uf">'+
                    '                           <option>Selecione um estado</option>'+
                    '                           <option value="AC">Acre</option>'+
                    '                           <option value="AL">Alagoas</option>'+
                    '                           <option value="AP">Amapá</option>'+
                    '                           <option value="AM">Amazonas</option>'+
                    '                           <option value="BA">Bahia</option>'+
                    '                           <option value="CE">Ceará</option>'+
                    '                           <option value="DF">Distrito Federal</option>'+
                    '                           <option value="ES">Espírito Santo</option>'+
                    '                           <option value="GO">Goiás</option>'+
                    '                           <option value="MA">Maranhão</option>'+
                    '                           <option value="MT">Mato Grosso</option>'+
                    '                           <option value="MS">Mato Grosso do Sul</option>'+
                    '                           <option value="MG">Minas Gerais</option>'+
                    '                           <option value="PA">Pará</option>'+
                    '                           <option value="PB">Paraíba</option>'+
                    '                           <option value="PR">Paraná</option>'+
                    '                           <option value="PE">Pernambuco</option>'+
                    '                           <option value="PI">Piauí</option>'+
                    '                           <option value="RJ">Rio de Janeiro</option>'+
                    '                           <option value="RN">Rio Grande do Norte</option>'+
                    '                           <option value="RS">Rio Grande do Sul</option>'+
                    '                           <option value="RO">Rondônia</option>'+
                    '                           <option value="RR">Roraima</option>'+
                    '                           <option value="SC">Santa Catarina</option>'+
                    '                           <option value="SP">São Paulo</option>'+
                    '                           <option value="SE">Sergipe</option>'+
                    '                           <option value="TO">Tocantins</option>'+
                    '                       </select>'+
                    '                   </div>'+
                    '               </div>'+
                    '           </div>'+
                    '           <div class="card-action">'+
                    '               <button type="submit" class="btn btn-success">Salvar</button>'+
                    '               <a href="{{route('clientes.show')}}" class="btn btn-danger">Cancelar</a>'+
                    '           </div>'+
                    '       </div>'
                });
            });
        </script>
    @endpush
@endsection
