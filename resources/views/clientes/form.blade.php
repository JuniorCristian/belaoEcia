<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">{{$page}}</div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" id="nome" name="nome" class="form-control"
                                   placeholder="Insira o nome do cliente">
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="telefone">Telefone</label>
                            <input type="text" id="telefone" name="telefone" class="telefone form-control"
                                   placeholder="Insira o telefone do cliente">
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="documento">CPF/CNPJ</label>
                            <input type="text" id="documento" name="doc_identificacao"
                                   class="form-control doc_identificacao" placeholder="Insira o CPF/CNPF do cliente">
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="cep">CEP</label>
                            <input type="text" class="form-control cep" id="cep" name="cep"
                                   placeholder="Insira o CEP">
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="rua">Rua</label>
                            <input type="text" class="form-control" id="rua" name="rua"
                                   placeholder="Insira a rua">
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="numero">Número</label>
                            <input type="text" class="form-control" id="numero" name="numero"
                                   placeholder="Insira o número">
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="complemento">Complemento</label>
                            <input type="text" class="form-control" id="complemento" name="complemento"
                                   placeholder="Insira a complemento">
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="bairro">Bairro</label>
                            <input type="text" class="form-control" id="bairro" name="bairro"
                                   placeholder="Insira o bairro">
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="cep">Cidade</label>
                            <input type="text" class="form-control" id="cidade" name="cidade"
                                   placeholder="Insira a cidade">
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="uf">Estado</label>
                            <select class="form-control" id="uf" name="uf">
                                <option>Selecione um estado</option>
                                <option value="AC">Acre</option>
                                <option value="AL">Alagoas</option>
                                <option value="AP">Amapá</option>
                                <option value="AM">Amazonas</option>
                                <option value="BA">Bahia</option>
                                <option value="CE">Ceará</option>
                                <option value="DF">Distrito Federal</option>
                                <option value="ES">Espírito Santo</option>
                                <option value="GO">Goiás</option>
                                <option value="MA">Maranhão</option>
                                <option value="MT">Mato Grosso</option>
                                <option value="MS">Mato Grosso do Sul</option>
                                <option value="MG">Minas Gerais</option>
                                <option value="PA">Pará</option>
                                <option value="PB">Paraíba</option>
                                <option value="PR">Paraná</option>
                                <option value="PE">Pernambuco</option>
                                <option value="PI">Piauí</option>
                                <option value="RJ">Rio de Janeiro</option>
                                <option value="RN">Rio Grande do Norte</option>
                                <option value="RS">Rio Grande do Sul</option>
                                <option value="RO">Rondônia</option>
                                <option value="RR">Roraima</option>
                                <option value="SC">Santa Catarina</option>
                                <option value="SP">São Paulo</option>
                                <option value="SE">Sergipe</option>
                                <option value="TO">Tocantins</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-action">
                    <button type="submit" class="btn btn-success">Salvar</button>
                    <a href="{{route('clientes.show')}}" class="btn btn-danger">Cancelar</a>
                </div>
            </div>
        </div>
    </div>
</div>
