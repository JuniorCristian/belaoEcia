$(document).ready(function () {
    function limpa_formulário_cep() {
        // Limpa valores do formulário de cep.
        $("#rua").val("");
        $("#bairro").val("");
        $("#cidade").val("");
        $("#uf option:first").attr('selected','selected');
    }

    $("#cep").blur(function() {

        var cep = $(this).val().replace(/\D/g, '');

        if (cep != "") {

            var validacep = /^[0-9]{8}$/;

            if(validacep.test(cep)) {

                $("#rua").val("...");
                $("#bairro").val("...");
                $("#cidade").val("...");

                $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                    if (!("erro" in dados)) {
                        $("#rua").val(dados.logradouro);
                        $("#bairro").val(dados.bairro);
                        $("#cidade").val(dados.localidade);
                        $("#uf").val(dados.uf);
                    } //end if.
                    else {
                        limpa_formulário_cep();
                        swal("CEP não encontrado.")
                            .then(() => {
                                $('#cep').focus();
                            });
                    }
                });
            }
            else {
                limpa_formulário_cep();
                swal("Formato de CEP inválido.")
                    .then(() => {
                        $('#cep').focus();
                    });
            }
        }
        else {
            limpa_formulário_cep();
        }
    });
});
(function () {
    'use strict'

    var forms = document.querySelectorAll('.needs-validation')

    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
})()
var options = {
    onKeyPress: function (cpf, ev, el, op) {
        var masks = ['000.000.000-000', '00.000.000/0000-00'];
        $('.doc_identificacao').mask((cpf.length > 14) ? masks[1] : masks[0], op);
    }
};
var SPMaskBehavior = function (val) {
        return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
    },
    spOptions = {
        onKeyPress: function (val, e, field, options) {
            field.mask(SPMaskBehavior.apply({}, arguments), options);
        }
    };
$('.date').mask('00/00/0000');
$('#cep').mask('00.000-000');
$('.money').mask('000.000.000.000.000,00', {reverse: true});
$('.doc_identificacao').length > 11 ? $('.doc_identificacao').mask('00.000.000/0000-00', options) : $('.doc_identificacao').mask('000.000.000-00#', options);
$('.telefone').mask(SPMaskBehavior, spOptions);
