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
                            <label for="tipo">Unidade</label>
                            <select name="unidade" id="unidade" class="form-control">
                                <option {{($material->unidade == 1?"selected":"")}} value="1">Kilograma</option>
                                <option {{($material->unidade == 2?"selected":"")}} value="2">Metros quadrados</option>
                                <option {{($material->unidade == 3?"selected":"")}} value="3">Metros cúbicos</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="descricao">Descrição</label>
                            <textarea name="descricao" id="descricao" cols="30" rows="10" class="form-control">{{$material->descricao}}</textarea>
                        </div>
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
