<?php
$seo['title'] = 'Funcionários';
$MODULO = 'funcionarios';
$func = 'criar';
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
                        <a href="{{route('funcionarios.criar')}}">Novo Funcionário</a>
                    </li>
                </ul>
            </div>
            <form method="post" action="{{route('funcionarios.store')}}">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Novo Funcionário</div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="nome">Nome</label>
                                            <input type="text" id="nome" name="nome" class="form-control"
                                                   placeholder="Insina o nome do funcionário">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="cpf">CPF</label>
                                            <input type="text" id="cpf" name="cpf" class="form-control"
                                                   placeholder="Insina o CPF do funcionário">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="telefone">Telefone</label>
                                            <input type="text" id="telefone" name="telefone" class="form-control"
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
                                                <input type="number" num id="salario_dia" name="salario_dia"
                                                       class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="funcao">Função</label>
                                        <select class="form-control" id="funcao" name="funcao">
                                            <option value="">--Selecione uma opção--</option>
                                            <option value="pedreiro">Pedreiro</option>
                                            <option value="assistente de pedreiro">Assistente de pedreiro
                                            </option>
                                            <option value="oreia seca">Oreia Seca</option>
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
    </div>
@endsection
