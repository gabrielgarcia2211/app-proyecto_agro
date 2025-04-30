
//Adicionales y detalles
function capturarDinero(event){
    $("#salario").on({
        "focus": function (event) {
            $(event.target).select();
        },
        "keyup": function (event) {
            $(event.target).val(function (index, value ) {
                return value.replace(/\D/g, "")
                    .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                    .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
            });
        }
    });
}


function onTimeChange() {
    var inputEle =  document.getElementById('horaInicio');
    var timeSplit = inputEle.value.split(':'),
        hours,
        minutes,
        meridian;
    hours = timeSplit[0];
    minutes = timeSplit[1];
    if (hours > 12) {
        meridian = 'PM';
        hours -= 12;
    } else if (hours < 12) {
        meridian = 'AM';
        if (hours == 0) {
            hours = 12;
        }
    } else {
        meridian = 'PM';
    }
    horaInicioT = hours + ':' + minutes + ' ' + meridian;
}

function onTimeChange2() {
    var inputEle2 = document.getElementById('horaFin');
    var timeSplit = inputEle2.value.split(':'),
        hours,
        minutes,
        meridian;
    hours = timeSplit[0];
    minutes = timeSplit[1];
    if (hours > 12) {
        meridian = 'PM';
        hours -= 12;
    } else if (hours < 12) {
        meridian = 'AM';
        if (hours == 0) {
            hours = 12;
        }
    } else {
        meridian = 'PM';
    }
    horaFinT = hours + ':' + minutes + ' ' + meridian;
}

//Servicio 4

function eliminarOferta(){
    event.preventDefault();
    Swal.fire({
        title: 'Desea eliminar la oferta?',
        text: "Esta operacion es irreversible",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Eliminar!'
    }).then((result) => {
        if (result.isConfirmed) {
            var formulario = document.getElementById("formu-oferta");
            formulario.submit();
            return true;
        }
    })


}


