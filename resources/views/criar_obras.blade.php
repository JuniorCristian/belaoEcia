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
            <form method="post" action="{{route('obras.store')}}">
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
                                                <input type="number" num id="orcamento" name="orcamento"
                                                       class="form-control"
                                                       aria-label="Amount (to the nearest dollar)">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">,00</span>
                                                </div>
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
                                            <input type="date" class="form-control" id="data_inicio_prevista"
                                                   name="data_inicio_prevista">
                                        </div>
                                        <div class="form-group">
                                            <label for="data_final">Data de final prevista</label>
                                            <input type="date" class="form-control" id="data_final_prevista"
                                                   name="data_final_prevista">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="cep">CEP</label>
                                            <input type="text" class="form-control" id="cep" name="cep"
                                                   placeholder="Insira o CEP">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="rua">Rua</label>
                                            <input type="text" class="form-control" id="rua" name="rua"
                                                   placeholder="Insira a rua">
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
                                                   placeholder="Insira o bairro">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="cep">Cidade</label>
                                            <input type="text" class="form-control" id="cidade" name="cidade"
                                                   placeholder="Insira a cidade">
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
                                            @foreach($funcionarios as $key=>$funcionario)
                                                <label class="form-check-label">
                                                    <input class="" name="funcionario{{$funcionario->id}}"
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
                                                    <option value="{{$cliente->id}}">{{$cliente->nome}}</option>
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

        <!-- Custom template | don't include it in your project! -->
        <div class="custom-template">
            <div class="title">Configurações</div>
            <div class="custom-content">
                <div class="switcher">
                    <div class="switch-block">
                        <h4>Logo Header</h4>
                        <div class="btnSwitch">
                            <button type="button"
                                    class="{{(Auth::user()->cor_header == 'dark')?'selected':''}} changeLogoHeaderColor"
                                    data-color="dark"></button>
                            <button type="button"
                                    class="{{(Auth::user()->cor_header == 'blue')?'selected':''}} changeLogoHeaderColor"
                                    data-color="blue"></button>
                            <button type="button"
                                    class="{{(Auth::user()->cor_header == 'purple')?'selected':''}} changeLogoHeaderColor"
                                    data-color="purple"></button>
                            <button type="button"
                                    class="{{(Auth::user()->cor_header == 'light-blue')?'selected':''}} changeLogoHeaderColor"
                                    data-color="light-blue"></button>
                            <button type="button"
                                    class="{{(Auth::user()->cor_header == 'green')?'selected':''}} changeLogoHeaderColor"
                                    data-color="green"></button>
                            <button type="button"
                                    class="{{(Auth::user()->cor_header == 'orange')?'selected':''}} changeLogoHeaderColor"
                                    data-color="orange"></button>
                            <button type="button"
                                    class="{{(Auth::user()->cor_header == 'red')?'selected':''}} changeLogoHeaderColor"
                                    data-color="red"></button>
                            <button type="button"
                                    class="{{(Auth::user()->cor_header == 'white')?'selected':''}} changeLogoHeaderColor"
                                    data-color="white"></button>
                            <br/>
                            <button type="button"
                                    class="{{(Auth::user()->cor_header == 'dark2')?'selected':''}} changeLogoHeaderColor"
                                    data-color="dark2"></button>
                            <button type="button"
                                    class="{{(Auth::user()->cor_header == 'blue2')?'selected':''}} changeLogoHeaderColor"
                                    data-color="blue2"></button>
                            <button type="button"
                                    class="{{(Auth::user()->cor_header == 'purple2')?'selected':''}} changeLogoHeaderColor"
                                    data-color="purple2"></button>
                            <button type="button"
                                    class="{{(Auth::user()->cor_header == 'light-blue2')?'selected':''}} changeLogoHeaderColor"
                                    data-color="light-blue2"></button>
                            <button type="button"
                                    class="{{(Auth::user()->cor_header == 'green2')?'selected':''}} changeLogoHeaderColor"
                                    data-color="green2"></button>
                            <button type="button"
                                    class="{{(Auth::user()->cor_header == 'orange2')?'selected':''}} changeLogoHeaderColor"
                                    data-color="orange2"></button>
                            <button type="button"
                                    class="{{(Auth::user()->cor_header == 'red2')?'selected':''}} changeLogoHeaderColor"
                                    data-color="red2"></button>
                        </div>
                    </div>
                    <div class="switch-block">
                        <h4>Navbar Header</h4>
                        <div class="btnSwitch">
                            <button type="button"
                                    class="{{(Auth::user()->cor_navbar == 'dark')?'selected':''}} changeTopBarColor"
                                    data-color="dark"></button>
                            <button type="button"
                                    class="{{(Auth::user()->cor_navbar == 'blue')?'selected':''}} changeTopBarColor"
                                    data-color="blue"></button>
                            <button type="button"
                                    class="{{(Auth::user()->cor_navbar == 'purple')?'selected':''}} changeTopBarColor"
                                    data-color="purple"></button>
                            <button type="button"
                                    class="{{(Auth::user()->cor_navbar == 'light-blue')?'selected':''}} changeTopBarColor"
                                    data-color="light-blue"></button>
                            <button type="button"
                                    class="{{(Auth::user()->cor_navbar == 'green')?'selected':''}} changeTopBarColor"
                                    data-color="green"></button>
                            <button type="button"
                                    class="{{(Auth::user()->cor_navbar == 'orange')?'selected':''}} changeTopBarColor"
                                    data-color="orange"></button>
                            <button type="button"
                                    class="{{(Auth::user()->cor_navbar == 'red')?'selected':''}} changeTopBarColor"
                                    data-color="red"></button>
                            <button type="button"
                                    class="{{(Auth::user()->cor_navbar == 'white')?'selected':''}} changeTopBarColor"
                                    data-color="white"></button>
                            <br/>
                            <button type="button"
                                    class="{{(Auth::user()->cor_navbar == 'dark2')?'selected':''}} changeTopBarColor"
                                    data-color="dark2"></button>
                            <button type="button"
                                    class="{{(Auth::user()->cor_navbar == 'blue2')?'selected':''}} changeTopBarColor"
                                    data-color="blue2"></button>
                            <button type="button"
                                    class="{{(Auth::user()->cor_navbar == 'purple2')?'selected':''}} changeTopBarColor"
                                    data-color="purple2"></button>
                            <button type="button"
                                    class="{{(Auth::user()->cor_navbar == 'light-blue2')?'selected':''}} changeTopBarColor"
                                    data-color="light-blue2"></button>
                            <button type="button"
                                    class="{{(Auth::user()->cor_navbar == 'green2')?'selected':''}} changeTopBarColor"
                                    data-color="green2"></button>
                            <button type="button"
                                    class="{{(Auth::user()->cor_navbar == 'orange2')?'selected':''}} changeTopBarColor"
                                    data-color="orange2"></button>
                            <button type="button"
                                    class="{{(Auth::user()->cor_navbar == 'red2')?'selected':''}} changeTopBarColor"
                                    data-color="red2"></button>
                        </div>
                    </div>
                    <div class="switch-block">
                        <h4>Sidebar</h4>
                        <div class="btnSwitch">
                            <button type="button"
                                    class="{{(Auth::user()->cor_sidebar == 'white')?'selected':''}} changeSideBarColor"
                                    data-color="white"></button>
                            <button type="button"
                                    class="{{(Auth::user()->cor_sidebar == 'dark')?'selected':''}} changeSideBarColor"
                                    data-color="dark"></button>
                            <button type="button"
                                    class="{{(Auth::user()->cor_sidebar == 'dark2')?'selected':''}} changeSideBarColor"
                                    data-color="dark2"></button>
                        </div>
                    </div>
                    <div class="switch-block">
                        <h4>Background</h4>
                        <div class="btnSwitch">
                            <button type="button"
                                    class="{{(Auth::user()->cor_background == 'bg2')?'selected':''}} changeBackgroundColor"
                                    data-color="bg2"></button>
                            <button type="button"
                                    class="{{(Auth::user()->cor_background == 'bg1')?'selected':''}} changeBackgroundColor"
                                    data-color="bg1"></button>
                            <button type="button"
                                    class="{{(Auth::user()->cor_background == 'bg3')?'selected':''}} changeBackgroundColor"
                                    data-color="bg3"></button>
                            <button type="button"
                                    class="{{(Auth::user()->cor_background == 'dark')?'selected':''}} changeBackgroundColor"
                                    data-color="dark"></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="custom-toggle">
                <i class="flaticon-settings"></i>
            </div>
        </div>
        <!-- End Custom template -->
    </div>
@endsection
