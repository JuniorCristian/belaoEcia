<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Editar Funcionário</div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input value="{{$funcionario->nome}}" type="text" id="nome" name="nome"
                                   class="form-control"
                                   placeholder="Insina o nome do funcionário">
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="cpf">CPF</label>
                            <input value="{{$funcionario->cpf}}" type="text" id="cpf" name="cpf"
                                   class="form-control doc_identificacao"
                                   placeholder="Insina o CPF do funcionário">
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="telefone">Telefone</label>
                            <input value="{{$funcionario->telefone}}" type="text" id="telefone"
                                   name="telefone" class="form-control telefone"
                                   placeholder="Insina o telefone do funcionário">
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="salario">Salario por dia</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">R$</span>
                                </div>
                                <input value="{{$funcionario->salario_dia}}"
                                       id="salario_dia" name="salario_dia" class="form-control money">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="funcao">Função</label>
                            <select class="form-control" id="funcao" name="funcao">
                                <option
                                    {{($funcionario->funcao=="Pedreiro")?"selected":""}} value="Pedreiro">
                                    Pedreiro
                                </option>
                                <option
                                    {{($funcionario->funcao=="Assistente de pedreiro")?"selected":""}} value="Assistente de pedreiro">
                                    Assistente de pedreiro
                                </option>
                                <option
                                    {{($funcionario->funcao=="Oreia seca")?"selected":""}} value="Oreia seca">
                                    Oreia Seca
                                </option>
                            </select>
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


@push('scripts')
    <script>
        $('#cpf').blur(function () {
            if (!valida_cpf_cnpj($(this).val()) && $(this).val().length != 0) {
                Swal.fire({
                    title: 'CPF/CNPJ Invalido, por favor insira outro',
                    showConfirmButton: false,
                    icon: 'error',
                    showCloseButton: true,
                    timer: 3000
                });
                $(this).val("");
                $(this).focus();
            }
        });
    </script>
@endpush
