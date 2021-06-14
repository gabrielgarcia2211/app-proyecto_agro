const URLD = "http://agendacitas.ingsw.ingsistemasufps.co/";
//const URLD = "http://localhost/cita/";


//Para escribir solo letras
function soloLetras(e) {
    var key = e.keyCode || e.which,
        tecla = String.fromCharCode(key).toLowerCase(),
        letras = " áéíóúabcdefghijklmnñopqrstuvwxyz",
        especiales = [8, 37, 39, 46],
        tecla_especial = false;
    for (var i in especiales) {if (key == especiales[i]) {tecla_especial = true;break;}}
    if (letras.indexOf(tecla) == -1 && !tecla_especial) {return false;}
}

//Para escribir solo numeros
$(".input-number").keydown(function (e) {
    if((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105) && event.keyCode !==190  && event.keyCode !==110 && event.keyCode !==8 && event.keyCode !==9  ){
        return false;
    }
});


function guardarIngeniero(){
    event.preventDefault();

    var nombre = $("#nombre").val();
    var apellido = $("#apellido").val();
    var cedula = $("#cedula").val();
    var codigo = $("#codigo").val();
    var correo_institucional = $("#correo_institucional").val();
    var correo_personal = $("#correo_personal").val();
    var telefono =$("#telefono").val();
    var contraseña = $("#contraseña").val();




    if(nombre=="" || apellido=="" || cedula=="" || codigo=="" || correo_institucional=="" || correo_personal=="" || telefono=="" || contraseña==""){
        $('#contError').text("Por favor, Introduce todos los valores");
        $('.alert').show();
        return;
    }
    $('#alert').hide();


    httpRequest(URLD + "adminControl/addIngeniero/" + nombre + "/" + apellido + "/" + cedula + "/" + codigo + "/" + correo_institucional + "/" +  correo_personal + "/"  + telefono + "/"  + contraseña, function () {
        var resp = this.responseText;
        if(resp){
            Swal.fire({
                title: 'Exito!',
                text: 'Ingeniero Agregado!',
                icon: 'success',
                confirmButtonText: 'OK'
            })
        }else{
            $('#contError').text("Codigo ya registrado!");
            $('.alert').show();
        }
        $('#alert').hide();
        location.reload();



    });
}

function eliminarIngeniero(id){
    event.preventDefault();
    Swal.fire({
        title: 'Desea eliminar el usuario?',
        text: "Esta operacion es irreversible",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Eliminar!'
    }).then((result) => {
        if (result.isConfirmed) {
            httpRequest(URLD + "adminControl/deleteIngeniero/" + id , function () {
                location.reload();
                alert(this.responseText);
            });
            return true;
        }
    })

}

function guardarServicio(){
    event.preventDefault();

    var nombre = $("#nombreS").val();

    if(nombre==""){
        $('#contError').text("Por favor, Introduce todos los valores");
        $('.alert').show();
        return;
    }
    $('#alert').hide();


    httpRequest(URLD + "adminControl/addServicio/" + nombre , function () {
        var resp = this.responseText;
        if(resp==1){
            Swal.fire({
                title: 'Exito!',
                text: 'Servicio Agregado!',
                icon: 'success',
                confirmButtonText: 'OK'
            })
        }else{
            $('#contError').text("Codigo ya registrado!");
            $('.alert').show();
        }
        $('#alert').hide();
       location.reload();



    });
}

function eliminarServicio(id){
    event.preventDefault();
    Swal.fire({
        title: 'Desea eliminar el servicio?',
        text: "Esta operacion es irreversible",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Eliminar!'
    }).then((result) => {
        if (result.isConfirmed) {
            httpRequest(URLD + "adminControl/deleteServicio/" + id , function () {
                location.reload();
            });
            return true;
        }
    })

}

function vincular(){
    event.preventDefault();
    var servicio = $("#idServicio").val();
    var ing = $("#codigoIng").val();

    Swal.fire({
        title: 'Desea relacionar el ingeniero con el servicio?',
        text: "Se añadira un nuevo vinculo",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#71C090',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Vincular!'
    }).then((result) => {
        if (result.isConfirmed) {
            httpRequest(URLD + "adminControl/addVinculo/" + servicio  + "/"  + ing, function () {
               location.reload();
                //alert(this.responseText)
            });
            return true;
        }
    })


}

function eliminarVinculo(id){
    event.preventDefault();
    Swal.fire({
        title: 'Desea eliminar la relacion?',
        text: "Esta operacion es irreversible",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Eliminar!'
    }).then((result) => {
        if (result.isConfirmed) {
            httpRequest(URLD + "adminControl/deleteVinculo/" + id , function () {
                location.reload();
            });
            return true;
        }
    })
}

function httpRequest(url, callback){
    const http = new XMLHttpRequest();
    http.open("GET", url);
    http.send();
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            callback.apply(http);
        }
    }
}