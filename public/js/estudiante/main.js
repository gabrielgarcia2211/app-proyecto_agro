$("#cargaHojaVida").prop("disabled", true);

//Servicio 1
function cargaHoja() {
    $(document).on('change','input[type="file"]',function(){
        // this.files[0].size recupera el tamaño del archivo
        // alert(this.files[0].size);

        var fileName = this.files[0].name;
        var fileSize = this.files[0].size;
        var res = fileName.substring(0, 30);
        $('.nameArchivo').text(res);
        // recuperamos la extensión del archivo
        var ext = fileName.split('.').pop();
        console.log(fileName);

        // Convertimos en minúscula porque
        // la extensión del archivo puede estar en mayúscula
        ext = ext.toLowerCase();

        // console.log(ext);
        switch (ext) {
            case 'pdf':
                $('.respuesta').text("Cargado Correctamente");
                $('#alert').hide();
                $('#alert2').show();
                $("#cargaHojaVida").prop("disabled", false);
                break;;
            default:
                $('.respuesta').text("error de extension, " + ext + "  "  + "Por favor seleccione un archivo .pdf");
                $('#alert2').hide();
                $('#alert').show();
                this.value = ''; // reset del valor
                this.files[0].name = '';
                $("#cargaHojaVida").prop("disabled", true);
        }

    });
}

function enviarHoja(){
    var parametros = new FormData($("#formu-hoja")[0]);
    var url   = $("#formu-hoja").attr('action');
    $.ajax({
        type: "POST",
        url: url,
        data: parametros,
        contentType: false,
        processData: false,
        beforeSend : function(){
            Swal.fire({
                title: 'Cargando',
                text: 'Subiendo archvio...',
                imageUrl: 'https://img.webme.com/pic/a/andwas/cargando5.gif',
                imageWidth: 200,
                imageHeight: 180,
                imageAlt: 'Subiendo archvio',
                showCancelButton: false,
                showConfirmButton: false
            })
        },
        success: function (data) {
            $("#listCodigos").val('');
            lista = [];
            $("#formularioTesis")[0].reset();
            $("#codigoEstudianteT").val("");
            swal.close()
            Swal.fire(
                'Tesis agregada',
                'Operacion exitosa',
                'success'
            )
            location.reload();
        },
        error: function (r) {
            alert(r);
            swal.close()
        },
        complete: function(){
            swal.close()
            $("#carga2").hide();
        }
    });
}

function autorizar(data){
    event.preventDefault();
    var text ="";
    var comunicado ="";
    if(data==0){
        text ='Desea otorgar permiso de visualizacion?';
        comunicado = 'Si, Autorizar!';
    }else{
        text ='Desea denegar permiso de visualizacion?';
        comunicado = 'Si, Denegar!';
    }
    Swal.fire({
        title: text,
        text: "Accion",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: comunicado
    }).then((result) => {
        if (result.isConfirmed) {
            var formulario = document.getElementById("formu-auto");
            formulario.submit();
            return true;
        }
    })
}

function info(e){
    e.preventDefault();
    Swal.fire(
        'Carga de Hoja de Vida',
        'Si se encuentra una hoja de vida previamente cargada en el sistema esta se actualizara al momento de subir un nuevo doumento'
    )
}

function Capempresa(){
    $("#empresa").val($("#exampleFormControlSelect2").val());
}
