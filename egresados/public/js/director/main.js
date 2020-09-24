


//SERVICIO CARGA DE EXCEL Y ENVIO DE DATOS (2)
$("#guardaExcel").prop("disabled", true);


/*$(document).ready(function(){


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#guardaExcel").click(function(e){
        e.preventDefault();
        var parametros = new FormData($(".formularioCompleto")[0]);
        var form  = $(this).parents('form');
        var url   = form.attr('action');
        $.ajax({
            method:"POST",
            url: url,
            data: parametros,
            contentType: false,
            processData: false,
            success:  function (response) {


            }
        });
    });


});
*/

function validarExtension() {
    $(document).on('change', 'input[type="file"]', function () {
        var fileName = this.files[0].name;
        var fileSize = this.files[0].size;
        var res = fileName.substring(0, 30);
        $('.nameArchivo').text(res);
        // recuperamos la extensión del archivo
        var ext = fileName.split('.').pop();
        console.log(fileName);
        ext = ext.toLowerCase();
        switch (ext) {
            case 'xlsx':
            case 'xls':
                $('.respCarga').text("Cargado Correctamente");
                $('#alert').hide();
                $('#alert2').show();
                $("#guardaExcel").prop("disabled", false);
                break;
            default:
                $('.respuesta').text("error de extension, " + ext + "  " + "Por favor seleccione un archivo .xls/xlsx");
                $('#alert2').hide();
                $('#alert').show();
                $("#guardaExcel").prop("disabled", true);
                this.value = ''; // reset del valor
                this.files[0].name = '';
        }

    });
}




function  beta(){
    alert("aaa");
}
