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
                        <a href="{{route('obras.show')}}">Obras</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a>Fase da Obra</a>
                    </li>
                </ul>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <h4 class="mt-2 ml-3 card-title">Gerenciar Fases da Obra</h4>
                        @if($errors->all)
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger" role="alert">
                                    {{$error}}
                                </div>
                            @endforeach
                        @endif
                        <ul class="nav nav-tabs mt-3 pl-3" id="fases" role="tablist">
                            @foreach($fase_obra as $fase)
                                <li class="nav-item">
                                    <a class="nav-link {{$fase->fase()->id == $fase_obra_ativa->fase?"active":""}}"
                                       id="fase{{$fase->id}}-tab" data-toggle="tab" href="#fase{{$fase->fase()->id}}"
                                       role="tab"
                                       aria-controls="fase{{$fase->fase()->id}}"
                                       aria-selected="{{$fase->fase()->id == $fase_obra_ativa->fase?"true":"false"}}">{{$fase->fase()->nome}}</a>
                                </li>
                            @endforeach
                        </ul>
                        <div class="tab-content" id="fases">
                            @foreach($fase_obra as $fase)
                                <div
                                    class="tab-pane fade {{$fase->fase()->id == $fase_obra_ativa->fase?"show active":""}}"
                                    id="fase{{$fase->fase()->id}}" role="tabpanel" data-fase="{{$fase->id}}"
                                    aria-labelledby="fase{{$fase->fase()->id}}-tab">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="data_inicial_prevista_fase">Previsão de inicio</label>
                                                    <input type="date" class="form-control data_inicial_prevista_fase"
                                                           name="data_inicial_prevista_fase"
                                                           value="{{$fase->inicio_previsto}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="data_final_prevista_fase">Previsão de
                                                        finalização</label>
                                                    <input type="date" class="form-control data_final_prevista_fase"
                                                           name="data_final_prevista_fase"
                                                           value="{{$fase->final_previsto}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="data_inicial_fase">Fase iniciada em</label>
                                                    <input type="date" class="form-control data_inicial_fase"
                                                           name="data_inicial_fase"
                                                           value="{{$fase->inicio}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="data_final_fase">Fase finalizada em</label>
                                                    <input type="date" class="form-control data_final_fase"
                                                           name="data_final_fase"
                                                           value="{{$fase->final}}">
                                                </div>
                                            </div>
                                            <div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="exampleFormControlFile1">Imagens da fase</label>
                                                            <form id="formfase{{$fase->id}}" enctype="multipart/form-data" method="POST">
                                                                @csrf
                                                                <input type="file" name="arquivos[]"
                                                                       multiple="multiple" data-id_form="formfase{{$fase->id}}"
                                                                       class="form-control-file envia_fotos">
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group list_images p-2">
                                                            @foreach(\App\Models\FaseObraImagem::where('fase_obra', $fase->id)->where('status_db', 1)->get() as $images)
                                                                <div class="images-list">
                                                                    <img
                                                                        src="{{env('APP_URL')}}/storage/{{$images->path}}"
                                                                        class="img-thumbnail rounded float-left imagem_fase m-1"
                                                                        style="width:150px!important" alt="..."
                                                                        data-imagem="{{env('APP_URL')}}/storage/{{$images->path}}">
                                                                </div>
                                                                <div class="images_opx" style="display: none">

                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-action">
                                                    <button type="button" class="btn btn-success salva_fase">Salvar
                                                    </button>
                                                    <a href="{{route('obras.show')}}"
                                                       class="btn btn-danger">Cancelar</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('css')
        <style>
            .nav-tabs .nav-link {
                color: #6c7378;
            }
            .images-list {
                display: inline-table;
            }
            .imagem_fase{
                cursor: pointer;
            }
        </style>
    @endpush
    @push('scripts')
        <script>
            var mostra_opx = false;
            $('.envia_fotos').change(function () {
                var data = new FormData(document.getElementById($(this).data('id_form')));
                // for(i = 0; i < $(this).get(0).files.length; i++){
                //     data.append('arquivos['+i+']', $(this).get(0).files[i]);
                //     console.log($(this).get(0).files[i]);
                // }
                data.append('_token', "{{csrf_token()}}");
                data.append('fase_obra', $(this).parents('.tab-pane').data('fase'));
                $.ajax({
                    url: "{{route('obras.fase.upload', ['obra'=>$obra->id])}}",
                    processData: false,
                    contentType: false,
                    dataType: "JSON",
                    enctype: 'multipart/form-data',
                    type: "POST",
                    data: data
                }).done(function (data) {
                    if(data.status){
                        for(i = 0; i < data.images.length; i++){
                            $('.tab-pane.show.active').find('div.list_images').append('<div class="images-list"><img src="{{env('APP_URL')}}/storage/'+data.images[i]+'"'+
                            'class="img-thumbnail rounded float-left imagem_fase m-1"'+
                            'style="width:150px!important" alt="..."'+
                            'data-imagem="{{env('APP_URL')}}/storage/'+data.images[i]+'"></div>');
                        }
                        $('.imagem_fase').click(function (){
                            imagem = $(this).data('imagem');
                            Swal.fire({
                                imageUrl: imagem,
                                showCloseButton: true,
                                showConfirmButton: false
                            });
                        });
                    }else{
                    }
                });
            });
            $('.salva_fase').click(function () {
                var fase = $(this).parents('.tab-pane');
                var data_inicial_prevista_fase = fase.find('.data_inicial_prevista_fase').val();
                var data_final_prevista_fase = fase.find('.data_final_prevista_fase').val();
                var data_inicial_fase = fase.find('.data_inicial_fase').val();
                var data_final_fase = fase.find('.data_final_fase').val();
                $.ajax({
                    url: "{{route('obras.fase.update', ['obra'=>$obra->id])}}",
                    dataType: "JSON",
                    type: "POST",
                    data: {
                        _token: "{{csrf_token()}}",
                        _method: "PUT",
                        inicio_previsto: data_inicial_prevista_fase,
                        final_previsto: data_final_prevista_fase,
                        inicio: data_inicial_fase,
                        final: data_final_fase,
                        id_fase: fase.data('fase')

                    }
                }).done(function (data) {
                    if (data.status) {
                        swal.fire({
                            title: "Sucesso",
                            icon: "success",
                            text: data.message,
                            showCloseButton: true,
                            showConfirmButton: false,
                            timer: 2000
                        });
                    } else {
                        swal.fire({
                            title: "Falha",
                            icon: "warning",
                            text: data.message,
                            showCloseButton: true,
                            showConfirmButton: false,
                            timer: 2000
                        }).then(function () {
                            window.location.reload();
                        });
                    }
                });
            });
            $('.imagem_fase').click(function (){
                imagem = $(this).data('imagem');
                Swal.fire({
                    imageUrl: imagem,
                    showCloseButton: true,
                    showConfirmButton: false
                });
            });
            $('.imagem_fase').hover(function (){
                mostra_opx = !mostra_opx;
                if(mostra_opx){
                    console.log("Teste");
                }else{
                    console.log("Teste2");
                }
            });
        </script>
    @endpush
@endsection
