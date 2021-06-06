<?php
$seo['title'] = 'Materiais da Obra';
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
                        <a>Materias da Obra</a>
                    </li>
                </ul>
            </div>
            <form method="post" action="{{route('obras.materiais.create', ["obra"=>$obra->id])}}" class="needs-validation" novalidate>
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Gerenciar Materiais</div>
                            </div>
                            <div class="card-body">
                                @include('layouts.messages')
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="material">Material</label>
                                            <select name="material" id="material" required class="form-control">
                                                @foreach($materiais as $key=>$material)
                                                    <option value="{{$key}}">{{$material}}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                Por favor selecione o material
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="data_compra">Data da compra</label>
                                            <input type="date" id="data_compra" name="data_compra" required value="{{date('Y-m-d')}}"
                                                   max="{{date('Y-m-d')}}"
                                                   class="form-control">
                                            <div class="invalid-feedback">
                                                Por favor escilha a data da compra
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="Quantidade">Quantidade</label>
                                            <input type="text" id="quantidade" name="quantidade" required min="1"
                                                   placeholder="Insira a quantidade comprada (Unidade, Kg, M² ou M³)"
                                                   class="form-control num">
                                            <div class="invalid-feedback">
                                                Por favor insira a quantidade
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="loja">Loja</label>
                                            <select name="loja" id="loja" required class="form-control">
                                                <option value="">Selecione um material antes</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Por favor selecione a loja
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="preco">Preço unitário</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">R$</span>
                                                </div>
                                                <input type="text" num id="preco" name="preco"
                                                       value=""
                                                       class="form-control money"
                                                       aria-label="Amount (to the nearest dollar)" required>
                                                <div class="invalid-feedback">
                                                    Por favor o preço do material
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="fase">Fase</label>
                                            <select name="fase" id="fase" required class="form-control">
                                                @foreach($fase_obra as $key=>$fase)
                                                    <option value="{{$key}}">{{$fase}}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                Por favor selecione a fase
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <button type="submit" class="btn btn-success ml-4 pl-3 pr-3 adicionar_material">Adicionar</button>
                                    <a href="{{route('obras.show')}}" class="btn btn-danger ml-2 pl-3 pr-3">Voltar</a>
                                </div>
                                <div class="row bg-primary mt-3 ml-3 mr-3">
                                    <div
                                        class="p-3 col-md-3 text-white font-weight-bold border-bottom border-top border-right border-left">
                                        Material
                                    </div>
                                    <div
                                        class="p-3 col-md-2 text-white font-weight-bold border-bottom border-top border-right">
                                        Data da compra
                                    </div>
                                    <div
                                        class="p-3 col-md-1 text-white font-weight-bold border-bottom border-top border-right">
                                        Quantidade
                                    </div>
                                    <div
                                        class="p-3 col-md-2 text-white font-weight-bold border-bottom border-top border-right">
                                        Loja
                                    </div>
                                    <div class="col-md-3 d-flex p-0">
                                        <div
                                            class="p-3 col-md-5 m-0 text-white font-weight-bold border-bottom border-top border-right">
                                            Preço Unitário
                                        </div>
                                        <div
                                            class="p-3 col-md-7 text-white font-weight-bold border-bottom border-top border-right">
                                            Fase
                                        </div>
                                    </div>
                                    <div
                                        class="p-3 col-md-1 text-white font-weight-bold border-bottom border-top border-right">
                                        Ações
                                    </div>
                                </div>
                                @php($total_gasto = 0)
                                @foreach($materiais_obra as $material_obra)
                                    @php($total_gasto += $material_obra->qtd*$material_obra->preco_unitario)
                                    <div class="row ml-3 mr-3 linha_material">
                                        <div class="p-3 col-md-3 border-bottom border-top border-right border-left">
                                            {{$material_obra->material_nome}}
                                        </div>
                                        <div
                                            class="p-3 col-md-2 border-bottom border-top border-right">{{\Carbon\Carbon::createFromFormat('Y-m-d', $material_obra->data_compra)->format('d/m/Y')}}</div>
                                        <div
                                            class="p-3 col-md-1 border-bottom border-top border-right">{{$material_obra->qtd}}</div>
                                        <div
                                            class="p-3 col-md-2 border-bottom border-top border-right">{{$material_obra->loja_nome}}</div>
                                        <div class="col-md-3 d-flex p-0">
                                            <div class="p-3 col-md-5 border-bottom border-top border-right">
                                                R$ {{number_format($material_obra->preco_unitario, 2, ',', '.')}}</div>
                                            <div class="p-3 col-md-7 border-bottom border-top border-right">{{$material_obra->fase_nome}}</div>
                                        </div>
                                        <div class="p-3 col-md-1 border-bottom border-top border-right">
                                            <div class='botoes-datatable ml-1'>
                                                <a class="excluir-datatable text-white deleta_material" data-id_material="{{$material_obra->id}}"><i class="fa fa-trash"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="total_gasto mt-3 ml-3 font-weight-bold">
                                    <p>
                                        <input type="hidden" class="total_preco"
                                               value="{{number_format($total_gasto, 2, ',', '.')}}">
                                        Total gasto: <label
                                            class="text-primary font-weight-bold total_preco_label">R$ {{number_format($total_gasto, 2, ',', '.')}}</label>
                                    </p>
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
            $('.num').mask("#.##0,00", {reverse: true});
            $('#material').change(function () {
                $.ajax({
                    url: "/obras/materiais/loja/" + $(this).val(),
                    headers: {
                        'X-CSRF-TOKEN': "{{csrf_token()}}"
                    },
                    type: "POST",
                    dataType: "JSON"
                }).done(function (data) {
                    if (data.status) {
                        $('#loja').html(data.lojas);
                    }
                });
            });
            $('#loja').change(function () {
                $.ajax({
                    url: "/obras/materiais/loja/preco/" + $(this).val(),
                    headers: {
                        'X-CSRF-TOKEN': "{{csrf_token()}}"
                    },
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        material: $('#material').val(),
                        loja: $('#loja').val(),
                        data: $('#data_compra').val(),
                    }
                }).done(function (data) {
                    if (data.status) {
                        $('#preco').val(data.preco);
                    }
                });
            });
            $('.deleta_material').click(function () {
                var id = $(this).data('id_material');
                const deletaMaterial = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success ml-2',
                        cancelButton: 'btn btn-error',
                    },
                    buttonsStyling: false
                });
                deletaMaterial.fire({
                    title: "Tem certeza que deseja deletar esse material?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete.isConfirmed) {
                        var form = $('<form action="{{route('obras.materiais.delete', ['obra'=>$obra->id])}}" method="post">' +
                            '<input type="hidden" name="_token" value="{{csrf_token()}}" />' +
                            '<input type="hidden" name="_method" value="delete" />' +
                            '<input type="hidden" name="materiaisObraFase" value="'+id+'" />' +
                            '</form>');
                        $('body').append(form);
                        form.submit();
                    }
                });;
            });
        </script>
    @endpush
@endsection
