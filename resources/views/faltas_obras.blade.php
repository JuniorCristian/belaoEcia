<?php
$seo['title'] = 'Obras';
$MODULO = 'obras';
$func = 'gerenciar';
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
                        <a href="{{route('obras.faltas', ['obra'=>$obra->id])}}">Registrar faltas</a>
                    </li>
                </ul>
            </div>
            <form method="post" action="{{route('obras.registrarFaltas', ['obra'=>$obra->id])}}">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Faltas</div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach($funcionarios as $funcionario)
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label for="">{{$funcionario->nome}}</label>
                                                <div class="input-group mb-3">
                                                    <div class="">
                                                        <label class="form-check-label">
                                                            <input class="falta"
                                                                   name="falta{{$funcionario->id}}"
                                                                   type="checkbox" value="">
                                                            <span class="form-check-sign">Faltou</span>
                                                        </label>
                                                    </div>
                                                    <br>
                                                    <div class="">
                                                        <label class="form-check-label">
                                                            <input class="meio_dia"
                                                                   name="meio_dia{{$funcionario->id}}"
                                                                   type="checkbox" value="">
                                                            <span class="form-check-sign">Meio dia trabalhado</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="col-md-10 col-lg-5">
                                        <div class="card-action">
                                            <button type="submit" class="btn btn-success">Salvar</button>
                                            <a href="{{route('obras.show')}}" class="btn btn-danger">Cancelar</a>
                                        </div>
                                    </div>
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
