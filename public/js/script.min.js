$(document).ready(function () {
    $('#datatable').DataTable({
        responsive: true
    });
});
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
$('.cep').mask('00.000-000');
$('.money').mask('000.000.000.000.000,00', {reverse: true});
$('.doc_identificacao').length > 11 ? $('.doc_identificacao').mask('00.000.000/0000-00', options) : $('.doc_identificacao').mask('000.000.000-00#', options);
$('.telefone').mask(SPMaskBehavior, spOptions);
