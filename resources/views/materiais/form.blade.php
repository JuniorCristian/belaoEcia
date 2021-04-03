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
                            <label for="tipo">Tipo</label>
                            <select name="tipo" id="tipo" class="form-control">
                                <option {{($material->tipo == 1?"selected":"")}} value="1">Obra</option>
                                <option {{($material->tipo == 2?"selected":"")}} value="2">Reforma</option>
                                <option {{($material->tipo == 3?"selected":"")}} value="3">Ambos</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option {{($material->status == 1?"selected":"")}} value="1">Ativo</option>
                                <option {{($material->status == 0?"selected":"")}} value="0">Inativo</option>
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
