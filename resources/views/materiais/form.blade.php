<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">{{$page}} Material</div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input value="{{$material->nome}}" type="text" required id="nome" name="nome"
                                   class="form-control"
                                   placeholder="Insira o nome da Material">
                            <div class="invalid-feedback">
                                Por favor preencha o nome do material
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nome">Marca</label>
                            <input value="{{$material->marca}}" type="text" required id="marca" name="marca"
                                   class="form-control"
                                   placeholder="Insira a marca da Material">
                            <div class="invalid-feedback">
                                Por favor preencha a marca do material
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="unidade">Unidade</label>
                            <select name="unidade" id="unidade" required class="form-control">
                                <option {{($material->unidade == 1?"selected":"")}} value="1">Kilograma</option>
                                <option {{($material->unidade == 2?"selected":"")}} value="2">Metros quadrados</option>
                                <option {{($material->unidade == 3?"selected":"")}} value="3">Metros cúbicos</option>
                                <option {{($material->unidade == 4?"selected":"")}} value="3">Unidade</option>
                            </select>
                            <div class="invalid-feedback">
                                Por favor preencha a unidade do material
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nome">SKU</label>
                            <input value="{{$material->sku}}" type="text" required id="sku" name="sku"
                                   class="form-control"
                                   placeholder="Insira o SKU da Material">
                            <div class="invalid-feedback">
                                Por favor preencha o SKU do material
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="mpn">MPN</label>
                            <input value="{{$material->mpn}}" type="text" required id="mpn" name="mpn"
                                   class="form-control"
                                   placeholder="Insira o MPN da Material">
                            <div class="invalid-feedback">
                                Por favor preencha o MPN do material
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="descricao">Descrição</label>
                            <textarea name="descricao" id="descricao" required cols="30" rows="10"
                                      class="form-control">{{$material->descricao}}</textarea>
                            <div class="invalid-feedback">
                                Por favor preencha a descrição do material
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row border m-2 mb-5 pb-3 lista_precos">
                    <div class="card-header col-md-12">
                        <div class="card-title">Lista de preços</div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="preco">Preço</label>
                            <input value="" type="text" id="preco" name="preco"
                                   class="form-control money"
                                   placeholder="Insira o preço do material">
                            <div class="invalid-feedback">
                                Por favor preencha o preço do material
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="data">Data</label>
                            <input value="{{date("Y-m-d")}}" type="date" id="data" name="data"
                                   class="form-control"
                                   placeholder="Insira a data">
                            <div class="invalid-feedback">
                                Por favor preencha a data que o material estava esse preço
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="loja">Loja</label>
                            <select name="loja" id="loja" class="form-control">
                                @foreach($lojas as $key=>$loja)
                                    <option value="{{$key}}">{{$loja}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Por favor preencha a loja que o material estava esse preço
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 mt-3">
                        <button type="button" class="btn btn-primary adicionar_preco" style="margin-top: 25px;">
                            Adicionar
                        </button>
                    </div>
                    <div class="col-md-12 ml-1 mr-1 d-flex">
                        <div class="col-md-3 p-2 bg-primary border-right">
                            <p class="text-white font-weight-bold">Preço</p>
                        </div>
                        <div class="col-md-4 p-2 bg-primary border-right">
                            <p class="text-white font-weight-bold">Data</p>
                        </div>
                        <div class="col-md-4 p-2 bg-primary border-right">
                            <p class="text-white font-weight-bold">Loja</p>
                        </div>
                        <div class="col-md-1 p-2 bg-primary">
                            <p class="text-white font-weight-bold">Ações</p>
                        </div>
                    </div>
                    @foreach($lista_materiais as $lista_material)
                        <div class="col-md-12 ml-1 mr-1 d-flex precos">
                            <div class="col-md-3 p-3 border-bottom border-right border-left">
                                <input type="hidden" name="preco[]" value="{{number_format($lista_material->preco, 2, ',', '.')}}">
                                <p class="font-weight-bold">
                                    R$ {{number_format($lista_material->preco, 2, ',', '.')}}</p>
                            </div>
                            <div class="col-md-4 p-3 border-bottom border-right">
                                <input type="hidden" name="data[]" value="{{\Carbon\Carbon::createFromFormat('Y-m-d', $lista_material->data)->format('Y-m-d')}}">
                                <p class="font-weight-bold">{{\Carbon\Carbon::createFromFormat('Y-m-d', $lista_material->data)->format('d/m/Y')}}</p>
                            </div>
                            <div class="col-md-4 p-3 border-bottom border-right">
                                <input type="hidden" name="loja[]" value="{{$lista_material->loja}}">
                                <p class="font-weight-bold">{{$lista_material->loja()->nome}}</p>
                            </div>
                            <div class="col-md-1 p-3 border-bottom border-right p-3 pl-4">
                                <div class='botoes-datatable'>
                                    <a class="editar-datatable text-white edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a class="excluir-datatable text-white deleta">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="card-action">
                    <button type="submit" class="btn btn-success">Salvar</button>
                    <a href="{{route('funcionarios.show')}}" class="btn btn-danger">Cancelar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@push('css')
    <style>
        .editing{
            color: red;
        }
    </style>
@endpush
@push('scripts')
    <script>
        $('.adicionar_preco').click(function (e) {
            validaCampo($('#preco'));
            validaCampo($('#data'));
            validaCampo($('#loja'));
            if ($('#preco').val() == "" || $('#data').val() == "" || $('#loja').val() == "") {
                return;
            }
            var preco = $('#preco').val();
            var data = $('#data').val();
            var loja = $('#loja').val();
            var loja_nome = $('#loja').find(":selected").text();

            linha =
                '<div class="col-md-12 ml-1 mr-1 d-flex precos">' +
                '    <div class="col-md-3 p-3 border-bottom border-right border-left">' +
                '        <input type="hidden" name="preco[]" value="' + preco + '">' +
                '            <p class="font-weight-bold">' +
                '                R$ ' + preco + '</p>' +
                '    </div>' +
                '    <div class="col-md-4 p-3 border-bottom border-right">' +
                '        <input type="hidden" name="data[]" value="' + data + '">' +
                '            <p class="font-weight-bold">' + data.replace(/(\d*)-(\d*)-(\d*).*/, '$3-$2-$1').replaceAll('-', '/')        + '</p>' +
                '    </div>' +
                '    <div class="col-md-4 p-3 border-bottom border-right">' +
                '        <input type="hidden" name="loja[]" value="' + loja + '">' +
                '            <p class="font-weight-bold">' + loja_nome + '</p>' +
                '    </div>' +
                '    <div class="col-md-1 p-3 border-bottom border-right p-3 pl-4">' +
                '        <div class="botoes-datatable">' +
                '            <a class="editar-datatable text-white edit">' +
                '                <i class="fa fa-edit"></i>' +
                '            </a>' +
                '            <a class="excluir-datatable text-white deleta">' +
                '                <i class="fa fa-trash"></i>' +
                '            </a>' +
                '        </div>' +
                '    </div>' +
                '</div>';

            $('.precos').each(function (index){
                if($(this).hasClass('editing')){
                    if(Date.parse($(this).find('input[name^=data]').val()) != Date.parse(data)){
                        $('.precos').each(function (index){
                                if(Date.parse($(this).find('input[name^=data]').val()) > Date.parse(data)){
                                    $(linha).insertBefore(this);
                                    return false;
                                }else if(index+1 == $('.precos').length){
                                    $(linha).insertAfter(this);
                                    return false;
                                }
                        });
                    }else{
                        $(linha).insertBefore(this);
                    }
                    return false;
                }else{
                    if(Date.parse($(this).find('input[name^=data]').val()) > Date.parse(data)){
                        $(linha).insertBefore(this);
                        return false;
                    }else if(index+1 == $('.precos').length){
                        $(linha).insertAfter(this);
                        return false;
                    }
                }
            });
            $('.editing').remove();
            data = new Date();
            $('#preco').val('');
            $('#data').val(data.getFullYear()+'-'+((data.getMonth()+1)<10?"0"+(data.getMonth()+1):(data.getMonth()+1))+'-'+data.getDate());
            $('#loja').val('');
            $('.deleta').off('click');
            $('.edit').off('click');
            deletaPreco();
            editaPreco();
        });
        deletaPreco();
        editaPreco();


        $('#preco').keyup(function () {
                validaCampo($('#preco'));
            }
        );
        $('#data').keyup(function () {
                validaCampo($('#data'));
            }
        );
        $('#loja').change(function () {
                validaCampo($('#loja'));
            }
        );

        function deletaPreco(){
            $('.deleta').click(function (){
                linha = $(this).parents('.precos');
                const deletapreco = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success mr-2',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                });
                deletapreco.fire({
                    title:'Confirma a exclusão desse preço?',
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Confirmar',
                }).then((result)=>{
                    if(result.isConfirmed){
                        linha.remove();
                    }
                });
            });
        }

        function editaPreco(){
            $('.edit').click(function (){
                linha = $(this).parents('.precos');
                data = new Date();
                $('#preco').val('');
                $('#data').val(data.getFullYear()+'-'+((data.getMonth()+1)<10?"0"+(data.getMonth()+1):(data.getMonth()+1))+'-'+data.getDate());
                $('#loja').val('');
                if(!linha.hasClass('editing')) {
                    $('.editing').removeClass('editing');
                    linha.addClass('editing');
                    data = new Date();
                    $('#preco').val(linha.find('input[name^=preco]').val());
                    $('#data').val(linha.find('input[name^=data]').val());
                    $('#loja').val(linha.find('input[name^=loja]').val());
                }else{
                    $('.editing').removeClass('editing');
                }
            });
        }

        function validaCampo(campo) {
            if (campo.val() == "") {
                campo.css('border-color', '#dc3545');
                campo.parent().find('.invalid-feedback').show();
            } else {
                campo.css('border-color', '#ebedf2');
                campo.parent().find('.invalid-feedback').hide();
            }
        }
    </script>
@endpush
