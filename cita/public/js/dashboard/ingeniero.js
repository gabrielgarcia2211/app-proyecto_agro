const URLD = "http://agendacitas.ingsw.ingsistemasufps.co/";
//const URLD = "http://localhost/cita/";
var ID;
var tomarHora = "";
this.calender();


$('.clockpicker').clockpicker();

function calender(){
    $('#CalendarioWeb').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay,listWeek'
        },
        events:URLD + "ingenieroControl/getCita/",
        eventClick:function(calEvent,jsEvent,view){
            ID = calEvent.id;
            $("#tituloEvento").html(calEvent.title);
            //inputs
            $("#titulo").val(calEvent.title);
            FechaHora = calEvent.start._i.split(" ");
            $("#fecha").val(FechaHora[0]);
            FechaDisponible = $("#fecha").val();
            $("#hora").val(FechaHora[1]);
            $("#descripcion").val(calEvent.descripcion);
            $("#color").val(calEvent.color);
            $("#agregar").css("display", "none");
            $("#editar").css("display", "block");
            $("#eliminar").css("display", "block");
            normal();
            $("#modalEventos").modal();

        },
        navLinks: true,
        editable: false,
        eventLimit: true
    });
}

function editarCita(){
    var titulo = $("#titulo").val();
    var fechaInicio = $("#fecha").val();
    var hora = tomarHora;
    var descripcion = $("#descripcion").val();

    //var servicio = $("#exampleFormControlSelect1").val();

    if(titulo=="" || fechaInicio=="" || hora=="" || descripcion==""){
        $('#contError').text("Por favor, Introduce todos los valores");
        $('.alert').show();
        return;
    }
    $('#alert').hide();


    //concatenar inicio de cita
    var inicio = fechaInicio + " " +  hora;

    httpRequest(URLD + "ingenieroControl/editCita/" + ID + "/" +  inicio , function () {
        $('#CalendarioWeb').fullCalendar('refetchEvents');
        $("#modalEventos").modal('toggle');
        var resp = this.responseText;
        Swal.fire({
            title: 'Exito!',
            text: 'Cita reprogramada',
            icon: 'success',
            confirmButtonText: 'OK'
        })
        location.reload();

      //  alert(this.responseText);


    });
}

function getHorario(){
    httpRequest(URLD + "ingenieroControl/getHorario/" + FechaDisponible , function () {
        let tasks = JSON.parse(this.responseText);
        let template = '';

        for (var i = 0;i<4 ;i++){
            if(tasks[i]!=0){
                par = tasks[i].substr(0,2);
                template +=`<tr style="padding: 4px;margin-right: 10px">
             <td id="${par}" onclick="return llenarHora(this.id)" type="button" class="btn btn-info" >${tasks[i]}</td>
             </tr>`
            }
        }
        $('.contenedor').html(template);

    });


}

function normal(){
    let template = '';
    template += `<div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-clock"></i></span>
   </div>
   <button onclick="getHorario()" type="button" class="btn btn-primary form-control" id="hora">Horario Disponibles</button>`
    $('.contenedor').html(template);
}

function viewAgenda(){
    window.location.href = URLD + "ingenieroControl/render/agendaIng";
}


function llenarHora(id){


    $("#" + id).hide();
    tomarHora = id + ":00" + ":00";
}

function info(e){
    e.preventDefault();
    Swal.fire(
        'Carga de citas',
        'El calendario dispone la funcionalidad de aplazar citas, avisando al estudiante algun cambio'

    )
}

function eliminarCita(id){
    event.preventDefault();
    Swal.fire({
        title: 'Desea eliminar la cita?',
        text: "Esta operacion es irreversible",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Eliminar!'
    }).then((result) => {
        if (result.isConfirmed) {
            httpRequest(URLD + "ingenieroControl/deleteCita/" + id , function () {
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