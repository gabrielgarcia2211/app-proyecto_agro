

var lista = [];
let templateCodigos = '';
var correo=false;
var fechaReporte = false;
var fechaReporteCodigo = false;
$("#guardaExcel").prop("disabled", true);
$("#cargaArchivoT").prop("disabled", true);
$("#cargaArchivoE").prop("disabled", true);
$("#crearEvento").prop("disabled", true);
$("#actualizarE").hide();



//Adiciones y detalles
$('.nav-item .nav-link').on('click', function() {
   $(".nav-item .nav-link").removeClass('active');
   $(this).addClass('active');
});

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

//Para escribir solo email
$('.input-email').keyup(function(){
    if($(".input-email").val().indexOf('@', 0) == -1 || $(".input-email").val().indexOf('.', 0) == -1) {
        $("#correoV").show();
        correo = false;
        return false;
    }
    correo = true;
    $("#correoV").hide();
});


//servico 2
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
                $('.respuesta').text("error de extension, " + ext + "  " + "Por favor seleccione un archivo .xlsx");
                $('#alert2').hide();
                $('#alert').show();
                $("#guardaExcel").prop("disabled", true);
                this.value = ''; // reset del valor
                this.files[0].name = '';
        }

    });
}

function info(e){
    e.preventDefault();
    Swal.fire(
        'Carga de datos',
        'La carga de datos se realiza siempre y cuando toda la informacion este bien regitrada, por ' +
        'otro lado si deseas agregar un nuevo registro este documento NO debe traer registros anteriormente guardados',
        'question'
    )
}

//servicio 3

$(".buscarCodigo").click(function(e){
    e.preventDefault();
    var form  = $(this).parents('form');
    var url   = form.attr('action');
    var parametros = new FormData($("#form-buscarCodigo")[0]);
    var codigo = $("#dataCodigo").val();
    if(codigo==""){
        $("#actualizarE").show();
        $(".respuestaACtu").text("Por favor introduzca el codigo");
        return;
    }
    $.ajax({
        method:"POST",
        url: url,
        data: parametros,
        contentType: false,
        processData: false,
        success:  function (response) {
            if(response!=0){
                let tasks = JSON.parse(response);
                $("#nombre").val(tasks[0].nombres);
                $("#apellido").val(tasks[0].apellidos);
                $("#codigo").val(tasks[0].codigo);
                $("#fechai").val(tasks[0].fechaIngreso);
                $("#codigo11").val(tasks[0].idSaber11);
                $("#codigoPro").val(tasks[0].idSaberPro);
                $("#promedio").val(tasks[0].promedio);
                $("#semestre").val(tasks[0].semestreCursado);
                $("#materias").val(tasks[0].materiasAprobadas);
                $("#actualizarE").hide();
            }else{
                $("#form-datosCarga")[0].reset();
                $("#actualizarE").show();
                $(".respuestaACtu").text("Codigo no registrado.");
            }

        }
    });
});

$(".buscarCodigoEgreso").click(function(e){
    e.preventDefault();
    var form  = $(this).parents('form');
    var url   = form.attr('action');
    var parametros = new FormData($("#form-buscarCodigoEgreso")[0]);
    var codigo = $("#busquedaCodigoF").val();
    if(codigo==""){
        $("#alertCodigo").show();
        $("#respuestaCarga").text("Por favor introduzca el codigo");
        return;
    }
    $.ajax({
        method:"POST",
        url: url,
        data: parametros,
        contentType: false,
        processData: false,
        success:  function (response) {
            if(response!=0){
                let tasks = JSON.parse(response);
                $("#codigoF").val(tasks[0].codigo);
                $("#fechaeF").val(tasks[0].fechaEgreso);
                $("#nombreF").val(tasks[0].nombres);
                $("#fechaiF").val(tasks[0].fechaIngreso);
                $("#alertCodigo").hide();

            }else{
                $("#form-buscarCodigoEgreso")[0].reset();
                $("#alertCodigo").show();
                $("#respuestaCarga").text("Codigo no registrado.");
            }

        }
    });
});

//Servico 4


function cargarLista(tipo){
    let porcentaje;
    event.preventDefault();
    $('#buscador').val("");
    $("#resultadoBuscador").hide();
    var url   = $("#form-lista").attr('action');
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url,
        data: { search:tipo },
        type: 'POST',
        beforeSend : function(){
            $("#carga").show();
        },
        success:function(response) {

                let tasks = JSON.parse(response);
                let template = '';
                tasks.forEach(ta => {

                    if(ta.porcentajeaprobado>10){
                        porcentaje = `<td style="background: #34ce57; color: white">${ta.porcentajeaprobado + " %"}</td>`;
                    }else{
                        porcentaje = `<td>${ta.porcentajeaprobado+ " %"}</td>`;
                    }



                    template += `<tr>
                <td >${ta.codigo}</td>
                <td >${ta.documento}</td>
                <td >${ta.nombre}</td>
                <td >${ta.apellido}</td>
                <td >${ta.celular}</td>
                <td >${ta.email}</td>
                <td >${ta.fechaIngreso}</td>
                <td >${ta.fechaEgreso}</td>
                <td >${ta.promedio}</td>
                <td >${ta.fecha_pro}</td>
                <td >${ta.fecha_11}</td>` +
                    porcentaje +
                `</tr>`
                });
                $('tbody').html(template);
                $("#carga").hide();

        },error:function(response) {
            $("#carga").hide();
            $("#resultadoBuscador").show();
            $("#resultadoBuscador").text("No hay informacion relacionada");
        }
    });
};

function capturar() {
    let busca = $('#buscador').val();
    var url   = $("#form-busqueda").attr('action');
    if ($('#buscador').val() != "") {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            data: { search:busca },
            type: 'POST',
            beforeSend : function(){

            },
            success:function(response) {
                if (response != 0) {
                    let tasks = JSON.parse(response);
                    let template = '';
                    tasks.forEach(ta => {
                        template += `<tr>
                    <td >${ta.codigoEstudiante}</td>
                    <td >${ta.documento}</td>
                    <td >${ta.nombres}</td>
                    <td >${ta.apellidos}</td>
                    <td >${ta.celular}</td>
                    <td >${ta.correoInstitucional}</td>
                    <td >${ta.fechaIngreso}</td>
                    <td >${ta.fechaEgreso}</td>
                    <td >${ta.promedio}</td>
                    </tr>`
                    });
                    $('tbody').html(template);
                } else {
                    $("#carga").hide();
                    $("#resultadoBuscador").show();
                    $("#resultadoBuscador").text("No se encontro ningun informacion relacionada");

                }
            }
        });
    }
}

function generarReportePorcentaje() {
    Swal.fire({
        title: 'Generando reporte',
        text: 'Por favor espere un momento..',
        imageUrl: 'https://img.webme.com/pic/a/andwas/cargando5.gif',
        imageWidth: 200,
        imageHeight: 180,
        imageAlt: 'Por favor espere un momento...',
        showCancelButton: false,
        showConfirmButton: false
    })
    event.preventDefault();
    var formulario = document.getElementById("form-reportePorcentaje");
    formulario.submit();
    return true;


}


//Servicio 5

function explodeCodigo(e){
    e.preventDefault();
    var validacion = 0;
    var url   = $("#form-codigoTesis").attr('action');
    var codigo = $("#codigoEstudianteT").val();
    if(codigo==""){
        $(".verificarC").text("Por favor introduzca el codigo");
        return;
    }
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url,
        data: { codigo:codigo },
        type: 'POST',
        beforeSend : function(){
            $("#carga").show();
        },
        success:function(response) {
            $("#carga").hide();
            if(response==0){
                $(".verificarC").text("Codigo no registrado")
            }else if(response==1){
                $(".verificarC").text("El codigo tiene aignada una tesis")
            }else{
                let tasks = JSON.parse(response);
                $('#tblUsuario tr').each(function () {
                    var pk = $(this).find("td").eq(0).html();
                    if (pk == tasks[0].codigo) {
                        validacion = 1;
                    }
                    return;
                });
                if (validacion == 0) {
                    tasks.forEach(ta => {
                        lista.push(ta.codigo);
                        templateCodigos += `<tr id="${ta.codigo}">
                      <td >${ta.codigo}</td>
                      <td >${ta.nombre}</td>
                      <td >${ta.apellido}</td>
                      <td><a href="#" onclick="return removerCodigo(${ta.codigo})" class="btn btn-primary btn-lg active" role="button" aria-pressed="true"
                      style="background-color: #dd4b39; border-color: #dd4b39;">Remover</a></td>
                      </tr>`
                    });
                    $('#agregar').html(templateCodigos);
                    $(".verificarC").text("");
                }
            }
        }
    });
}

function removerCodigo(cod) {
    removeItemFromArr(lista, cod);
    $("#" + cod).remove();
    templateCodigos = "";
    return false;
}

function removeItemFromArr(arr, item) {
    var i = arr.indexOf(item);
    if (i !== -1) {
        arr.splice(i, 1);
    }
}

function cargaTesis() {
    $(document).on('change', 'input[type="file"]', function () {
        var fileName = this.files[0].name;
        var res = fileName.substring(0, 30);
        $('.nameArchivoTesis').text(res);
        extTesis = fileName.split('.').pop();
        extTesis = extTesis.toLowerCase();
        switch (extTesis) {
            case 'pdf':
                $('.respuestaTesis2').text("Cargado Correctamente");
                $('#alertTesis').hide();
                $('#alertTesis2').show();
                $("#cargaArchivoT").prop("disabled", false);
                break;
            default:
                $('.respuestaTesis').text("error de extension, " + extTesis + "  " + "Por favor seleccione un archivo .pdf");
                $('#alertTesis2').hide();
                $('#alertTesis').show();
                this.value = '';
                this.files[0].name = '';
                $("#cargaArchivoT").prop("disabled", true);
        }
    });
}

$("#cargaArchivoT").click(function(e){
    e.preventDefault();
    var titulo = $('#titulo').val();
    gropu = $('#inputGroupFile01').val();
    if (lista.length === 0) {
        $('#alertTesis2').hide();
        $('#alertTesis').show();
        $('#respuestaTesis').text("Por favor, Agregue los codigos correspondientes a la tabla.");
        return;
    }
    if (titulo == "") {
        $('#alertTesis2').hide();
        $('#alertTesis').show();
        $('#respuestaTesis').text("Por favor, Digite el nombre de la tesis antes de cargar.");
        return;
    }
    if (extTesis != "pdf" || gropu == "") {
        $('#alertTesis2').hide();
        $('#alertTesis').show();
        $('#respuestaTesis').text("error de extension, " + extTesis + "  " + "Por favor seleccione un archivo .pdf");
        return;
    }
    $('#alertTesis').hide();
    $('#alertTesis2').hide();
    enviarTesis(event);
    return false;
});

function enviarTesis(e) {
    e.preventDefault();
    var consta = "";
    var url   = $("#formularioTesis").attr('action');
    for (let index = 0; index < lista.length; index++) {
        const element = lista[index];
        if (consta == "") {
            consta = element;
        } else {
            consta = consta + "-" + element;
        }
    }
    $("#listCodigos").val(consta);
    var parametros = new FormData($("#formularioTesis")[0]);
    $.ajax({
        type: "POST",
        url: url,
        data: parametros,
        contentType: false,
        processData: false,
        beforeSend : function(){
            $("#carga2").show();
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
            /*$("#listCodigos").val('');
            lista = [];
            $("#formularioTesis")[0].reset();
            $("#codigoEstudianteT").val("");

            Swal.fire(
                'Tesis agregada',
                'Operacion exitosa',
                'success'
            )
            location.reload();*/
            swal.close()
            console.log(data);
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


//Servicio 7

function getPrueba(){
    var busquedaCodigo = $('#buscarPrueba').val();
    var url   = $("#form-prueba").attr('action');
    if (busquedaCodigo == "" || parseInt(busquedaCodigo, 10) < 1) {
        $('#alert').show();
        $('#cargaPrueba').text("Por favor, Introduzca el codigo del estudiante.");
        $('#C1').hide();
        $('#C2').hide();
        $('#C3').hide();
        return;
    }
    $('#alert').hide();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url,
        data: { search:busquedaCodigo },
        type: 'POST',
        beforeSend : function(){
            $("#carga3").show();
        },
        success:function(response) {
            if(response!=0){
                task = JSON.parse(response);
                $('#C1').show();
                $('#C2').show();
                $('#C3').show();
                $("#name").val(task[0].nombre);
                $("#apellido").val(task[0].apellido);
                showPro(task[0].lectura_critica, task[0].razonamiento_cuantitativo, task[0].competencias_ciudadana, task[0].comunicacion_escrita, task[0].ingles);
                show11(task[0].p11, task[0].p12, task[0].p13, task[0].p14, task[0].p15);
                comparacionPruebas(task[0].lectura_critica,task[0].p11, task[0].razonamiento_cuantitativo,task[0].p12,task[0].competencias_ciudadana, task[0].p13,task[0].ingles, task[0].p15 )
            }else{
                $('#alert').show();
                $('#cargaPrueba').text("Codigo no registrado");
            }

            $("#carga3").hide();

        }

    });
}

function showPro(lectura, razon, natu, compet, ingles) {

    var ctx = document.getElementById('myChartPro');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Lectura ', 'Razonamiento ', 'Competencia ', 'Comunicacion ', 'Ingles'],
            datasets: [{
                label: 'Resultados Saber Pro',
                data: [lectura, razon, natu, compet, ingles],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
}

function show11(lectura, razon, compet, natu, ingles) {

    var ctx = document.getElementById('myChart11');

    Chart.defaults.global.defaultFontSize = 16;
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Lectura', 'Razonamiento', 'Sociales', 'Naturales', 'Ingles'],
            datasets: [{
                label: 'Resultados Icfes',
                data: [lectura, razon, compet, natu, ingles],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
}

function comparacionPruebas(lectu1, lectu2, razo1, razo2, compe1, compe2, ingles1, ingles2) {
    var densityCanvas = document.getElementById("myChart");

    Chart.defaults.global.defaultFontFamily = "Lato";
    Chart.defaults.global.defaultFontSize = 18;

    var saberPro = {
        label: 'Resultados Pruebas SaberPro',
        data: [lectu1, razo1, compe1, ingles1],
        backgroundColor: 'rgba(0, 99, 132, 0.6)',
        borderWidth: 0,
        yAxisID: "y-axis-density"
    };

    var saber11 = {
        label: 'Resultados Pruebas Saber11',
        data: [lectu2, razo2, compe2, ingles2],
        backgroundColor: 'rgba(99, 132, 0, 0.6)',
        borderWidth: 0,
        yAxisID: "y-axis-gravity"
    };

    var planetData = {
        labels: ["Lectura", "Razonamiento", "Competencia", "Ingles"],
        datasets: [saberPro, saber11]
    };

    var chartOptions = {
        scales: {
            xAxes: [{
                barPercentage: 1,
                categoryPercentage: 0.6
            }],
            yAxes: [{
                id: "y-axis-density"
            }, {
                id: "y-axis-gravity"
            }]
        }
    };

    var barChart = new Chart(densityCanvas, {
        type: 'bar',
        data: planetData,
        options: chartOptions
    });
}


//Servicio 8

function generarReporte() {
    Swal.fire({
        title: 'Generando reporte',
        text: 'Por favor espere un momento..',
        imageUrl: 'https://img.webme.com/pic/a/andwas/cargando5.gif',
        imageWidth: 200,
        imageHeight: 180,
        imageAlt: 'Por favor espere un momento...',
        showCancelButton: false,
        showConfirmButton: false
    })
    event.preventDefault();
    var formulario = document.getElementById("form-reporte");
    formulario.submit();
    return true;


}


function capturarReporte() {
    const values = $('#startReporteCodigo').val();
    //const reporteFecha = $('#fechaReporte').val();

    if (values.length > 0){
        $("#especifico").hide();
        $("#SeReporte").prop("disabled", true);
        $("#fechaReporte").prop("disabled", true);
        $("#startReporteFecha").prop("disabled", true);

    }else{
        $("#especifico").show();
        $("#SeReporte").prop("disabled", false);
        $("#startReporteFecha").prop("disabled", false);
        $("#fechaReporte").prop("disabled", false);
    }

}

function busquedaReporte(){

    document.getElementById("fechaReporte").checked = true;
    $("#startReporteCodigo").prop("disabled", true);
    $("#especifico").hide();
    $("#personal").hide();

}

function busquedaReporteCheck(){
    var checkBox = document.getElementById("fechaReporte");
    $('input[type=date]').val('');
    if(checkBox.checked != true){
        $("#startReporteCodigo").prop("disabled", false);
        $("#especifico").show();
        $("#personal").show();
    }else{
        $("#startReporteCodigo").prop("disabled", true);
        $("#especifico").hide();
        $("#personal").hide();
    }


}


//Servicio 9

function guardarEmpresa(e){
    e.preventDefault();
    var nit = $("#nitEmpresa").val();
    var nombre = $("#nombreEmpresa").val();
    var correoM = $("#correoEmpresa").val();
    var telefono = $("#telefonoEmpresa").val();
    var celular = $("#celularEmpresa").val();
    var direccion = $("#direccionEmpresa").val();
    var fecha = $("#fecha").val();
    var contraseña = $("#contraEmpresa").val();
    var ciudad = $("#ciudadEmpresa").val();
    if(nit=="" || nombre=="" || correoM=="" || telefono=="" || celular=="" || direccion=="" || fecha=="" || contraseña=="" || ciudad=="" ) {
        $("#alertConvenio").show();
        $("#alertConvenio2").hide();
        $("#respuestaCorreo").text("Por favor complete todos los campos");
        return;
    }
    if(!correo){
        $("#alertConvenio").show();
        $("#alertConvenio2").hide();
        $("#respuestaCorreo").text("Por ingrese una direccion de correo valida");
        return;
    }
    $("#alertConvenio").hide();
    var parametros = new FormData($("#formularioEmpresa")[0]);
    var url   = $("#formularioEmpresa").attr('action');
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
            swal.close()
            if(data==0){
                $("#alertConvenio").show();
                $("#alertConvenio2").hide();
                $("#respuestaCorreo").text("Campo nit empresa, ya se encuentra registrado!");
            }else if(data==2){
                $("#alertConvenio").show();
                $("#alertConvenio2").hide();
                $("#respuestaCorreo").text("Campo correo empresa, ya se encuentra registrado!");
            }else{
                $("#formularioEmpresa")[0].reset();
                Swal.fire(
                    'Convenio agregado',
                    'Operacion exitosa',
                    'success'
                )
                location.reload();
            }
        },
        error: function (r) {
            swal.close()
            alert(r);
        },
    });
}

function cargaConvenio(){
    $(document).on('change', 'input[type="file"]', function () {
        var fileName = this.files[0].name;
        var res = fileName.substring(0, 30);
        $('.nameArchivo').text(res);
        extConvenio = fileName.split('.').pop();
        console.log(fileName);
        extConvenio = extConvenio.toLowerCase();
        switch (extConvenio) {
            case 'pdf':
                $('#alertConvenio').hide();
                $('#alertConvenio2').show();
                $('#respuestaCorreo2').text("Cargado Correctamente");
                $("#cargaArchivoE").prop("disabled", false);
                break;
            default:
                $('#respuestaCorreo').text("error de extension, " + extConvenio + "  " + "Por favor seleccione un archivo .pdf");
                $('#alertConvenio2').hide();
                $('#alertConvenio').show();
                $("#cargaArchivoE").prop("disabled", true);
                this.value = '';
                this.files[0].name = '';
        }
    });
}

//Servicio 10

function eliminarConvenio(){
    event.preventDefault();
    Swal.fire({
        title: 'Desea eliminar la empresa?',
        text: "Esta operacion es irreversible",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Eliminar!'
    }).then((result) => {
        if (result.isConfirmed) {
            var formulario = document.getElementById("formuConvenio");
            formulario.submit();
            return true;
        }
    })

}

function enviarSeguimiento(){
    event.preventDefault();
    Swal.fire({
        title: 'Confirmar envio de correos?',
        text: "Esta operacion es irreversible",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#ff0000',
        confirmButtonText: 'Si, Enviar!'
    }).then((result) => {
        if (result.isConfirmed) {
            $("#enviarCo").css("display","none");
            var formulario = document.getElementById("formuCorreoB");
            formulario.submit();
            return true;
        }
    })

}


//Servicio 12

function fileValidation(param) {
    var fileInput = param;
    var filePath = fileInput.value;
    var allowedExtensions = /(.jpg|.jpeg|.png|.gif)$/i;
    if (!allowedExtensions.exec(filePath)) {
        document.getElementById('imagePreview').innerHTML = 'Por favor seleccione un archivo con alguna de las siguientes opciones .jpeg/.jpg/.png/.gif.';
        fileInput.value = '';
        $("#crearEvento").prop("disabled", true);
        return false;
    } else {
        //Image preview
        if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('imagePreview').innerHTML = '<img style="width:100%;height:100% " src="' + e.target.result + '"/>';
            };
            reader.readAsDataURL(fileInput.files[0]);
            $("#crearEvento").prop("disabled", false);
        }
    }
}

function eliminarEvento(){
    event.preventDefault();
    Swal.fire({
        title: 'Desea eliminar el evento?',
        text: "Esta operacion es irreversible",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Eliminar!'
    }).then((result) => {
        if (result.isConfirmed) {
            var formulario = document.getElementById("formu-evento");
            formulario.submit();
            return true;
        }
    })


}

function viewImg(img){
    event.preventDefault();
    Swal.fire({
        title: 'Vista de la imagen',
        imageUrl: img,
        imageWidth: 600,
        imageHeight: 250,
        imageAlt: 'cargando...',
    })

}


//Servicio 14

function enviarNoticia(){
    event.preventDefault();
    Swal.fire({
        title: 'Confirmar envio de noticia?',
        text: "Esta operacion es irreversible",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#ff0000',
        confirmButtonText: 'Si, Enviar!'
    }).then((result) => {
        if (result.isConfirmed) {
            var formulario = document.getElementById("formuNoticia");
            formulario.submit();
            return true;
        }
    })

}


//Servicio 15


function eliminarNoticia(){
    event.preventDefault();
    Swal.fire({
        title: 'Desea eliminar la noticia?',
        text: "Esta operacion es irreversible",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Eliminar!'
    }).then((result) => {
        if (result.isConfirmed) {
            var formulario = document.getElementById("formu-noticia");
            formulario.submit();
            return true;
        }
    })


}
