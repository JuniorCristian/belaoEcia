<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">{{$page}}</div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" name="nome" class="form-control form-text" value="{{$loja->nome}}" placeholder="Insira o nome da loja">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="site">Site</label>
                            <input type="text" name="site" class="form-control form-text" value="{{$loja->site}}" placeholder="Insira o site da loja">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="telefone">Telefone</label>
                            <input type="text" name="telefone" class="form-control form-text telefone" value="{{$loja->telefone}}" placeholder="Insira o telefone da loja">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="descricao">Descriçao</label>
                            <textarea name="descricao" cols="30" rows="10" class="form-control form-text"> {{$loja->descricao}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="cep">CEP</label>
                            <input type="text" value="{{$loja->cep}}" class="form-control cep" id="cep"
                                   name="cep"
                                   placeholder="Insira o CEP" required>
                            <div class="invalid-feedback">
                                Por favor informe o CEP da a loja
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="rua">Rua</label>
                            <input type="text" value="{{$loja->rua}}" class="form-control" id="rua"
                                   name="rua"
                                   placeholder="Insira a rua" required>
                            <div class="invalid-feedback">
                                Por favor informe a rua da a loja
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="numero">Número</label>
                            <input type="text" value="{{$loja->numero}}" class="form-control"
                                   id="numero" name="numero"
                                   placeholder="Insira o número">
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="complemento">Complemento</label>
                            <input type="text" value="{{$loja->complemento}}" class="form-control"
                                   id="complemento"
                                   name="complemento" placeholder="Insira o complemento">
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="bairro">Bairro</label>
                            <input type="text" value="{{$loja->bairro}}" class="form-control"
                                   id="bairro" name="bairro"
                                   placeholder="Insira o bairro" required>
                            <div class="invalid-feedback">
                                Por favor informe o bairro da a loja
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="cep">Cidade</label>
                            <input type="text" value="{{$loja->cidade}}" class="form-control"
                                   id="cidade" name="cidade"
                                   placeholder="Insira a cidade" required>
                            <div class="invalid-feedback">
                                Por favor informe a cidade da a loja
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="uf">Estado</label>
                            <select class="form-control" id="uf" name="uf" required>
                                <option value="">Selecione um estado</option>
                                <option {{($loja->uf == "AC")?"selected":""}} value="AC">Acre</option>
                                <option {{($loja->uf == "AL")?"selected":""}} value="AL">Alagoas
                                </option>
                                <option {{($loja->uf == "AP")?"selected":""}} value="AP">Amapá</option>
                                <option {{($loja->uf == "AM")?"selected":""}} value="AM">Amazonas
                                </option>
                                <option {{($loja->uf == "BA")?"selected":""}} value="BA">Bahia</option>
                                <option {{($loja->uf == "CE")?"selected":""}} value="CE">Ceará</option>
                                <option {{($loja->uf == "DF")?"selected":""}} value="DF">Distrito
                                    Federal
                                </option>
                                <option {{($loja->uf == "ES")?"selected":""}} value="ES">Espírito
                                    Santo
                                </option>
                                <option {{($loja->uf == "GO")?"selected":""}} value="GO">Goiás</option>
                                <option {{($loja->uf == "MA")?"selected":""}} value="MA">Maranhão
                                </option>
                                <option {{($loja->uf == "MT")?"selected":""}} value="MT">Mato Grosso
                                </option>
                                <option {{($loja->uf == "MS")?"selected":""}} value="MS">Mato Grosso do
                                    Sul
                                </option>
                                <option {{($loja->uf == "MG")?"selected":""}} value="MG">Minas Gerais
                                </option>
                                <option {{($loja->uf == "PA")?"selected":""}} value="PA">Pará</option>
                                <option {{($loja->uf == "PB")?"selected":""}} value="PB">Paraíba
                                </option>
                                <option {{($loja->uf == "PR")?"selected":""}} value="PR">Paraná</option>
                                <option {{($loja->uf == "PE")?"selected":""}} value="PE">Pernambuco
                                </option>
                                <option {{($loja->uf == "PI")?"selected":""}} value="PI">Piauí</option>
                                <option {{($loja->uf == "RJ")?"selected":""}} value="RJ">Rio de
                                    Janeiro
                                </option>
                                <option {{($loja->uf == "RN")?"selected":""}} value="RN">Rio Grande do
                                    Norte
                                </option>
                                <option {{($loja->uf == "RS")?"selected":""}} value="RS">Rio Grande do
                                    Sul
                                </option>
                                <option {{($loja->uf == "RO")?"selected":""}} value="RO">Rondônia
                                </option>
                                <option {{($loja->uf == "RR")?"selected":""}} value="RR">Roraima
                                </option>
                                <option {{($loja->uf == "SC")?"selected":""}} value="SC">Santa
                                    Catarina
                                </option>
                                <option {{($loja->uf == "SP")?"selected":""}} value="SP">São Paulo
                                </option>
                                <option {{($loja->uf == "SE")?"selected":""}} value="SE">Sergipe
                                </option>
                                <option {{($loja->uf == "TO")?"selected":""}} value="TO">Tocantins
                                </option>
                            </select>
                            <div class="invalid-feedback">
                                Por favor informe o estado da a loja
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="uf">Status</label>
                            <select class="form-control" id="status" name="status" required>
                                <option {{($loja->status == 1)?"selected":""}} value="1">Ativo</option>
                                <option {{($loja->status == 0)?"selected":""}} value="0">Inativo</option>
                            </select>
                            <div class="invalid-feedback">
                                Por favor informe o estado da a loja
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-action">
                    <button type="submit" class="btn btn-success">Salvar</button>
                    <a href="{{route('lojas.index')}}" class="btn btn-danger">Cancelar</a>
                </div>
            </div>
        </div>
    </div>
</div>
