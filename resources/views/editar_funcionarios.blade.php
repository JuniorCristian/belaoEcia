<?php
$seo['title'] = 'Funcionários';
$MODULO = 'funcionaios';
$func = 'listar';
?>
@extends('layouts.app')
@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Funcionários</h4>
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
                        <a href="{{route('funcionarios.show')}}">Funcionários</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('funcionarios.edit', ['funcionario'=>$funcionario->id])}}">Editar
                            Funcionário</a>
                    </li>
                </ul>
            </div>
            <form method="post" action="{{route('funcionarios.update', ['funcionario', $funcionario->id])}}">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Editar Funcionário</div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="nome">Nome</label>
                                            <input value="{{$funcionario->nome}}" type="text" id="nome" name="nome"
                                                   class="form-control"
                                                   placeholder="Insina o nome do funcionário">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="cpf">CPF</label>
                                            <input value="{{$funcionario->cpf}}" type="text" id="cpf" name="cpf"
                                                   class="form-control doc_identificacao"
                                                   placeholder="Insina o CPF do funcionário">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="telefone">Telefone</label>
                                            <input value="{{$funcionario->telefone}}" type="text" id="telefone"
                                                   name="telefone" class="form-control telefone"
                                                   placeholder="Insina o telefone do funcionário">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="salario">Salario por dia</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">R$</span>
                                                </div>
                                                <input value="{{$funcionario->salario_dia}}" type="number" num
                                                       id="salario_dia" name="salario_dia" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="funcao">Função</label>
                                        <select class="form-control" id="funcao" name="funcao">
                                            <option
                                                {{($funcionario->funcao=="Pedreiro")?"selected":""}} value="Pedreiro">
                                                Pedreiro
                                            </option>
                                            <option
                                                {{($funcionario->funcao=="Assistente de pedreiro")?"selected":""}} value="Assistente de pedreiro">
                                                Assistente de pedreiro
                                            </option>
                                            <option
                                                {{($funcionario->funcao=="Oreia seca")?"selected":""}} value="Oreia seca">
                                                Oreia Seca
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="card-action">
                                    <button type="submit" class="btn btn-success">Salvar</button>
                                    <a href="{{route('funcionarios.show')}}" class="btn btn-danger">Cancelar</a>
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
