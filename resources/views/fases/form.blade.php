<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">{{$page}} Fase</div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input value="{{$fase->nome}}" required type="text" id="nome" name="nome"
                                   class="form-control"
                                   {{$edit?"":"disabled"}}
                                   placeholder="Insira o nome da Fase">
                            <div class="invalid-feedback">
                                Por favor preencha o nome da fase
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="tipo">Tipo</label>
                            <select name="tipo" id="tipo" required {{$edit?"":"disabled"}} class="form-control">
                                <option {{($fase->tipo == 1?"selected":"")}} value="1">Obra</option>
                                <option {{($fase->tipo == 2?"selected":"")}} value="2">Reforma</option>
                                <option {{($fase->tipo == 3?"selected":"")}} value="3">Ambos</option>
                            </select>
                            <div class="invalid-feedback">
                                Por favor preencha o tipo da fase
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" required {{$edit?"":"disabled"}} class="form-control">
                                <option {{($fase->status == 1?"selected":"")}} value="1">Ativo</option>
                                <option {{($fase->status == 0?"selected":"")}} value="0">Inativo</option>
                            </select>
                            <div class="invalid-feedback">
                                Por favor preencha o status da fase
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="descricao">Descrição</label>
                            <textarea name="descricao" id="descricao" required {{$edit?"":"disabled"}} cols="30"
                                      rows="10"
                                      class="form-control">{{$fase->descricao}}</textarea>
                            <div class="invalid-feedback">
                                Por favor preencha a descrição da fase
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-action">
                    @if($edit)
                        <button type="submit" class="btn btn-success">Salvar</button>
                        <a href="{{route('fases.index')}}" class="btn btn-danger">Cancelar</a>
                    @else
                        <button type="submit" class="btn btn-primary">Voltar</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
