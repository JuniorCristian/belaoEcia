$(document).ready( function () {
    $("#mostra_orc_material").ready(function (){
        if(this.checked){
            $(".orc_material").show();
            $("#orcamento_materias").attr("required", "");
        }else{
            $(".orc_material").hide();
            $("#orcamento_materias").removeAttr("required");
        }
    })
} );
const modalAddItem = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-success mr-1',
        cancelButton: 'btn btn-danger'
    },
    buttonsStyling: false
});
$('.novo_funcionario').click(function (){
    modalAddItem.fire({
        title: "Cadastrar novo Funcionário",
        confirmButtonText: 'Salvar',
        cancelButtonText: 'Cancelar',
        showCloseButton: true,
        showCancelButton: true,
        html: '<div class="row">'+
            '    <div class="col-md-6 col-lg-4">'+
            '        <div class="form-group">'+
            '            <label for="nome">Nome</label>'+
            '           <input type="text" id="nome" name="nome"'+
            '                  class="form-control"'+
            '                   placeholder="Insina o nome do funcionário">'+
            '        </div>'+
            '    </div>'+
            '    <div class="col-md-6 col-lg-4">'+
            '        <div class="form-group">'+
            '            <label for="cpf">CPF</label>'+
            '           <input type="text" id="cpf" name="cpf"'+
            '                  class="form-control doc_identificacao"'+
            '                   placeholder="Insina o CPF do funcionário">'+
            '        </div>'+
            '    </div>'+
            '    <div class="col-md-6 col-lg-4">'+
            '        <div class="form-group">'+
            '            <label for="telefone">Telefone</label>'+
            '           <input type="text" id="telefone"'+
            '                  name="telefone" class="form-control telefone"'+
            '                   placeholder="Insina o telefone do funcionário">'+
            '        </div>'+
            '    </div>'+
            '    <div class="col-md-6 col-lg-4">'+
            '        <div class="form-group">'+
            '            <label for="salario">Salario por dia</label>'+
            '            <div class="input-group mb-3">'+
            '                <div class="input-group-prepend">'+
            '                    <span class="input-group-text">R$</span>'+
            '                </div>'+
            '               <input'+
            '                       id="salario_dia" name="salario_dia" class="form-control money">'+
            '            </div>'+
            '        </div>'+
            '    </div>'+
            '    <div class="col-md-6 col-lg-4">'+
            '         <div class="form-group">'+
            '             <label for="funcao">Função</label>'+
            '             <select class="form-control" id="funcao" name="funcao">'+
            '                <option'+
            '                     value="Pedreiro">'+
            '                     Pedreiro'+
            '                 </option>'+
            '                <option'+
            '                    value="Assistente de pedreiro">'+
            '                     Assistente de pedreiro'+
            '                 </option>'+
            '                <option'+
            '                     value="Oreia seca">'+
            '                     Oreia Seca'+
            '                 </option>'+
            '             </select>'+
            '         </div>'+
            '     </div>'+
            '</div>'
    });
    mask();
});
$('.novo_cliente').click(function () {
    modalAddItem.fire({
        title: "Cadastrar novo Cliente",
        confirmButtonText: 'Salvar',
        cancelButtonText: 'Cancelar',
        showCloseButton: true,
        showCancelButton: true,
        html: '<div class="card-body">'+
            '            <div class="row">'+
            '               <div class="col-md-6 col-lg-4">'+
            '                   <div class="form-group">'+
            '                       <label for="nome">Nome</label>'+
            '                       <input type="text" id="nome" name="nome" class="form-control"'+
            '                           placeholder="Insira o nome do cliente">'+
            '                   </div>'+
            '               </div>'+
            '               <div class="col-md-6 col-lg-4">'+
            '                   <div class="form-group">'+
            '                       <label for="telefone">Telefone</label>'+
            '                       <input type="text" id="telefone" name="telefone" class="telefone form-control"'+
            '                           placeholder="Insira o telefone do cliente">'+
            '                   </div>'+
            '               </div>'+
            '               <div class="col-md-6 col-lg-4">'+
            '                   <div class="form-group">'+
            '                       <label for="documento">CPF/CNPJ</label>'+
            '                       <input type="text" id="documento" name="doc_identificacao"'+
            '                           class="form-control doc_identificacao" placeholder="Insira o CPF/CNPF do cliente">'+
            '                   </div>'+
            '               </div>'+
            '               <div class="col-md-6 col-lg-4">'+
            '                   <div class="form-group">'+
            '                       <label for="cep">CEP</label>'+
            '                       <input type="text" class="form-control cep" id="cep" name="cep"'+
            '                           placeholder="Insira o CEP">'+
            '                   </div>'+
            '               </div>'+
            '               <div class="col-md-6 col-lg-4">'+
            '                   <div class="form-group">'+
            '                       <label for="rua">Rua</label>'+
            '                       <input type="text" class="form-control" id="rua" name="rua"'+
            '                           placeholder="Insira a rua">'+
            '                   </div>'+
            '               </div>'+
            '               <div class="col-md-6 col-lg-4">'+
            '                   <div class="form-group">'+
            '                       <label for="numero">Número</label>'+
            '                       <input type="text" class="form-control" id="numero" name="numero"'+
            '                           placeholder="Insira o número">'+
            '                   </div>'+
            '               </div>'+
            '               <div class="col-md-6 col-lg-4">'+
            '                   <div class="form-group">'+
            '                       <label for="complemento">Complemento</label>'+
            '                       <input type="text" class="form-control" id="complemento" name="complemento"'+
            '                           placeholder="Insira a complemento">'+
            '                   </div>'+
            '               </div>'+
            '               <div class="col-md-6 col-lg-4">'+
            '                   <div class="form-group">'+
            '                       <label for="bairro">Bairro</label>'+
            '                       <input type="text" class="form-control" id="bairro" name="bairro"'+
            '                           placeholder="Insira o bairro">'+
            '                   </div>'+
            '               </div>'+
            '               <div class="col-md-6 col-lg-4">'+
            '                   <div class="form-group">'+
            '                       <label for="cep">Cidade</label>'+
            '                       <input type="text" class="form-control" id="cidade" name="cidade"'+
            '                           placeholder="Insira a cidade">'+
            '                   </div>'+
            '               </div>'+
            '               <div class="col-md-6 col-lg-4">'+
            '                   <div class="form-group">'+
            '                       <label for="uf">Estado</label>'+
            '                       <select class="form-control" id="uf" name="uf">'+
            '                           <option>Selecione um estado</option>'+
            '                           <option value="AC">Acre</option>'+
            '                           <option value="AL">Alagoas</option>'+
            '                           <option value="AP">Amapá</option>'+
            '                           <option value="AM">Amazonas</option>'+
            '                           <option value="BA">Bahia</option>'+
            '                           <option value="CE">Ceará</option>'+
            '                           <option value="DF">Distrito Federal</option>'+
            '                           <option value="ES">Espírito Santo</option>'+
            '                           <option value="GO">Goiás</option>'+
            '                           <option value="MA">Maranhão</option>'+
            '                           <option value="MT">Mato Grosso</option>'+
            '                           <option value="MS">Mato Grosso do Sul</option>'+
            '                           <option value="MG">Minas Gerais</option>'+
            '                           <option value="PA">Pará</option>'+
            '                           <option value="PB">Paraíba</option>'+
            '                           <option value="PR">Paraná</option>'+
            '                           <option value="PE">Pernambuco</option>'+
            '                           <option value="PI">Piauí</option>'+
            '                           <option value="RJ">Rio de Janeiro</option>'+
            '                           <option value="RN">Rio Grande do Norte</option>'+
            '                           <option value="RS">Rio Grande do Sul</option>'+
            '                           <option value="RO">Rondônia</option>'+
            '                           <option value="RR">Roraima</option>'+
            '                           <option value="SC">Santa Catarina</option>'+
            '                           <option value="SP">São Paulo</option>'+
            '                           <option value="SE">Sergipe</option>'+
            '                           <option value="TO">Tocantins</option>'+
            '                       </select>'+
            '                   </div>'+
            '               </div>'+
            '           </div>'+
            '       </div>'
    });
    mask();
});
$("#mostra_orc_material").click(function (){

    if(this.checked){
        $(".orc_material").show();
        $("#orcamento_materias").attr("required", "");
    }else{
        $(".orc_material").hide();
        $("#orcamento_materias").removeAttr("required");
    }
});
$('.deleta').click(function (){
    id = $(this).data('id');
    url = $(this).data('rota');
    token = $(this).data('csrf');
    swal({
        title: "Tem certeza que deseja deletar essa obra?",
        text: "Uma vez deletada você irá perder todos os dados dela",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                var form = $('<form action="' + url + '" method="post">' +
                    '<input type="hiden" name="_token" value="' + token + '" />' +
                    '<input type="hiden" name="_method" value="delete" />' +
                    '<input type="hiden" name="obra" value="' + id + '" />' +
                    '</form>');
                $('body').append(form);
                form.submit();
            }
        });
});
$('.conclui').click(function (){
    id = $(this).data('id');
    url = $(this).data('rota');
    token = $(this).data('csrf');
    swal({
        title: "Tem certeza que deseja concluir essa obra?",
        text: "Para reativar essa obra você vai ter que editar a obra e apagar a a data final",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                var form = $('<form action="' + url + '" method="post">' +
                    '<input type="hiden" name="_token" value="' + token + '" />' +
                    '<input type="hiden" name="_method" value="put" />' +
                    '<input type="hiden" name="obra" value="' + id + '" />' +
                    '</form>');
                $('body').append(form);
                form.submit();
            }
        });
});
$('.falta').click(function (){
    if($(this).prop("checked")){
        $(this).parent().parent().parent().find('.meio_dia').prop("checked", false);
    }
});
$('.meio_dia').click(function (){
    if($(this).prop("checked")){
        $(this).parent().parent().parent().find('.falta').prop("checked", false);
    }
});
