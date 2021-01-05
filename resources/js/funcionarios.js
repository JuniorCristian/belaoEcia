$(document).ready( function () {
    for($i = 0; $i <= $('#valorDatatable').val(); $i++){
        $('#datatable'+$i).DataTable({
            responsive: true,
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.10.22/i18n/Portuguese-Brasil.json'
            }
        });
    }
    $('#valorDatatable').remove();
} );
$('.deleta').click(function (){
    id = $(this).data('id');
    url = $(this).data('rota');
    token = $(this).data('csrf');
    swal({
        title: "Tem certeza que deseja deletar esse funcionario?",
        text: "Uma vez deletada você irá perder todos os dados dele",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                var form = $('<form action="' + url + '" method="post">' +
                    '<input type="hiden" name="_token" value="' + token + '" />' +
                    '<input type="hiden" name="_method" value="delete" />' +
                    '<input type="hiden" name="funcionario" value="' + id + '" />' +
                    '</form>');
                $('body').append(form);
                form.submit();
            }
        });
});
