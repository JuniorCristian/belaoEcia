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
                                                            <form id="formfase{{$fase->id}}"
                                                                  enctype="multipart/form-data" method="POST">
                                                                @csrf
                                                                <input type="file" name="arquivos[]"
                                                                       multiple="multiple"
                                                                       data-id_form="formfase{{$fase->id}}"
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
                                                                        src="{{env('APP_URL')}}/storage/{{$images->thumb_path}}"
                                                                        class="img-thumbnail rounded float-left imagem_fase"
                                                                        style="width:150px!important" alt="..."
                                                                        data-imagem="{{env('APP_URL')}}/storage/{{$images->path}}"
                                                                        data-fase_imagem="{{$images->id}}"
                                                                        data-descricao="{{$images->descricao}}">
                                                                    <div class="images_opx" style="display: none">
                                                                        <div class="fundo"></div>
                                                                        <div class="acoes_image">
                                                                            <a class="delete_img"><i class="fa fa-trash"></i></a>
                                                                            <a class="edit_img"><i class="fa fa-edit"></i></a>
                                                                            <a class="show_img"><i class="fa fa-eye"></i></a>
                                                                        </div>
                                                                    </div>
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
                height: 150px;
                width: 150px;
                margin-right: 8px;
            }

            .acoes_image {
                position: relative;
                top: -54%;
                left: 18%;
            }

            .acoes_image a{
                font-size: 14px;
                border-radius: 50%;
                color: white!important;
                margin-right: 4px;
            }

            .delete_img {
                background-color: #e74c3c;
                padding: 4px 6px;
            }

            .delete_img:hover {
                background-color: #bb3a2f;
            }

            .edit_img {
                background-color: #f1c40f;
                padding: 4px 5px;
            }

            .edit_img:hover {
                background-color: #c9a40d;
            }

            .show_img {
                background-color: #2ecc71;
                padding: 4px 5px;
            }

            .show_img:hover {
                background-color: #239353;
            }

            .imagem_fase {
                cursor: pointer;
            }

            .images_opx {
                width: 150px;
                height: 150px;
                position: absolute;
            }
            .fundo {
                width: 100%;
                height: 100%;
                background: black;
                opacity: 0.5;
            }
        </style>
    @endpush
    @push('scripts')
        <script>
            var mostra_opx = false;
            carregafuncoes();
            $('.envia_fotos').change(function () {
                var data = new FormData(document.getElementById($(this).data('id_form')));
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
                    if (data.status) {
                        for (i = 0; i < data.images.length; i++) {
                            $('.tab-pane.show.active').find('div.list_images').append(
                                '<div class="images-list">'+
                                '    <img'+
                                '        src="{{env('APP_URL')}}/storage/' + data.thumbs[i] + '"'+
                                '       class="img-thumbnail rounded float-left imagem_fase"'+
                                '       style="width:150px!important" alt="..."'+
                                '        data-imagem="{{env('APP_URL')}}/storage/' + data.images[i] + '"'+
                                '        data-fase_imagem="' + data.fase_id[i] + '"'+
                                '        data-descricao="">'+
                                '        <div class="images_opx" style="display: none">'+
                                '            <div class="fundo"></div>'+
                                '            <div class="acoes_image">'+
                                '                <a class="delete_img"><i class="fa fa-trash"></i></a>'+
                                '                <a class="edit_img"><i class="fa fa-edit"></i></a>'+
                                '                <a class="show_img"><i class="fa fa-eye"></i></a>'+
                                '            </div>'+
                                '        </div>'+
                                '</div>');
                        }
                        removeFuncoes();
                        carregafuncoes();
                    } else {
                        swal.fire({
                            title: "Falha",
                            icon: "warning",
                            text: data.message,
                            showCloseButton: true,
                            showConfirmButton: false,
                            timer: 2000
                        });
                    }
                });
            });
            function removeFuncoes(){
                $('.salva_fase').off('click');
                $('.show_img').off('click');
                $('.edit_img').off('click');
                $('.delete_img').off('click');
                $('.images-list').off('mouseover');
                $('.images-list').off('mouseout');
            }
            function carregafuncoes() {
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
                $('.show_img').click(function () {
                    var imagem = $(this).parents('.images-list').find('.imagem_fase').data('imagem');
                    Swal.fire({
                        imageUrl: imagem,
                        showCloseButton: true,
                        showConfirmButton: false
                    });
                });
                $('.edit_img').click(function () {
                    var image = $(this).parents('.images-list').find('.imagem_fase');
                    const edit_image_text = Swal.mixin({
                        customClass: {
                            cancelButton: 'btn btn-danger',
                            confirmButton: 'btn btn-success mr-2'
                        },
                        buttonsStyling: false
                    })
                    edit_image_text.fire({
                        title: 'Descrição da imagem',
                        text: 'Coloque uma descrição para a imagem para que o cliente saiba o que foi feito',
                        input: 'textarea',
                        inputAttributes: {
                            autocapitalize: 'off'
                        },
                        inputValue: image.data('descricao'),
                        showCloseButton: true,
                        showCancelButton: true,
                        confirmButtonText: 'Salvar',
                        cancelButtonText: 'Cancelar',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "{{route('obras.fase.edit')}}",
                                dataType: "JSON",
                                type: "POST",
                                data: {
                                    _token: "{{csrf_token()}}",
                                    _method: "PUT",
                                    id_fase_imagem: image.data('fase_imagem'),
                                    descricao: $('.swal2-textarea').val()
                                }
                            }).done(function (data) {
                                if (data.status) {
                                    image.data('descricao', data.descricao);
                                    console.log(image.data('imagem'));
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
                        }
                    });
                });
                $('.delete_img').click(function (){
                    var image = $(this).parents('.images-list').find('.imagem_fase');
                    const delete_image_text = Swal.mixin({
                        customClass: {
                            cancelButton: 'btn btn-danger',
                            confirmButton: 'btn btn-success mr-2'
                        },
                        buttonsStyling: false
                    })
                    delete_image_text.fire({
                        title: 'Confirma a exclusão da imagem!',
                        text: 'Se você deletar essa imagem, ela não ficar mais acessivel',
                        icon: 'warning',
                        showCloseButton: true,
                        showCancelButton: true,
                        confirmButtonText: 'Confimar',
                        cancelButtonText: 'Cancelar',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "{{route('obras.fase.delete')}}",
                                dataType: "JSON",
                                type: "POST",
                                data: {
                                    _token: "{{csrf_token()}}",
                                    _method: "DELETE",
                                    id_fase_imagem: image.data('fase_imagem')
                                }
                            }).done(function (data) {
                                if (data.status) {
                                    image.parent().remove();
                                    console.log(image.data('imagem'));
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
                        }
                    });
                });
                $('.images-list').mouseover(function (e) {
                        $(this).find('.images_opx').show();
                });
                $('.images-list').mouseout(function (e) {
                        $(this).find('.images_opx').hide();
                });
            }
        </script>
    @endpush
@endsection
