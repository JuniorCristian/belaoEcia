$(document).ready( function () {
    for($i = 0; $i <= $('#valorDatatable').val(); $i++){
        $('#datatable'+$i).DataTable({
            responsive: true
        });
    }
    $('#valorDatatable').remove();
    $("#mostra_orc_material").ready(function (){
        if(this.checked){
            $(".orc_material").show();
        }else{
            $(".orc_material").hide();
        }
    })
} );
$("#mostra_orc_material").click(function (){

    if(this.checked){
        $(".orc_material").show();
    }else{
        $(".orc_material").hide();
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
