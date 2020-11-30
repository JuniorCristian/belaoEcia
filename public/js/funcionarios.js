$(document).ready( function () {
    $('#datatable').DataTable();
    for($i = 0; $i <= $('#valorDatatable').val(); $i++){
        $('#datatable'+$i).DataTable();
    }
    $('#valorDatatable').remove();
} );
