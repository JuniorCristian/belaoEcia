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
                            <input value="{{$material->nome}}" type="text" id="nome" name="nome"
                                   class="form-control"
                                   placeholder="Insira o nome da Material">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nome">Marca</label>
                            <input value="{{$material->marca}}" type="text" id="marca" name="marca"
                                   class="form-control"
                                   placeholder="Insira a marca da Material">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="unidade">Unidade</label>
                            <select name="unidade" id="unidade" class="form-control">
                                <option {{($material->unidade == 1?"selected":"")}} value="1">Kilograma</option>
                                <option {{($material->unidade == 2?"selected":"")}} value="2">Metros quadrados</option>
                                <option {{($material->unidade == 3?"selected":"")}} value="3">Metros cúbicos</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nome">SKU</label>
                            <input value="{{$material->sku}}" type="text" id="sku" name="sku"
                                   class="form-control"
                                   placeholder="Insira o SKU da Material">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="mpn">MPN</label>
                            <input value="{{$material->mpn}}" type="text" id="mpn" name="mpn"
                                   class="form-control"
                                   placeholder="Insira o MPN da Material">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="descricao">Descrição</label>
                            <textarea name="descricao" id="descricao" cols="30" rows="10"
                                      class="form-control">{{$material->descricao}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row border m-2">
                    <div class="card-header col-md-12">
                        <div class="card-title">Lista de preços</div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="preco">Preço</label>
                            <input value="" type="text" id="preco" name="preco"
                                   class="form-control money"
                                   placeholder="Insira o preço do material">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="data">Data</label>
                            <input value="{{date("Y-m-d")}}" type="date" id="data" name="data"
                                   class="form-control"
                                   placeholder="Insira a data">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="loja">Loja</label>
                            <select name="loja" id="loja" class="form-control">
                                <option value="1">Balaroti</option>
                                <option value="2">Leroy Merlin</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2 mt-3">
                        <a href="#" class="btn btn-primary" style="margin-top: 25px;">Adicionar</a>
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
                    @for($i = 0; $i < 5; $i++)
                        <div class="col-md-12 ml-1 mr-1 d-flex">
                            <div class="col-md-3 p-3 border-bottom border-right border-left">
                                <p class="font-weight-bold">R$ 27,50</p>
                            </div>
                            <div class="col-md-4 p-3 border-bottom border-right">
                                <p class="font-weight-bold">22/09/2020</p>
                            </div>
                            <div class="col-md-4 p-3 border-bottom border-right">
                                <p class="font-weight-bold">Balaroti</p>
                            </div>
                            <div class="col-md-1 p-3 border-bottom border-right p-3 pl-4">
                                <div class='botoes-datatable'>
                                    <a class="editar-datatable text-white" href="">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a class="excluir-datatable text-white deleta">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endfor
                    <div class="mb-2"></div>
                </div>
                <div class="card-action">
                    <button type="submit" class="btn btn-success">Salvar</button>
                    <a href="{{route('funcionarios.show')}}" class="btn btn-danger">Cancelar</a>
                </div>
            </div>
        </div>
    </div>
</div>
