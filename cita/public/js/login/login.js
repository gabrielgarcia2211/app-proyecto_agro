const URLD = "http://agendacitas.ingsw.ingsistemasufps.co/";
//const URLD = "http://localhost/cita/";


  //METODO PARA LA VERIFICACION DE DATOS
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

function verificarDatos(e){
    e.preventDefault();
    var codigo = $('#inpCodigo').val();
    var documento = $('#inputDocumento').val();
    var contraseña = $('#inputPassword').val();
    if (!verificarVacio([codigo, documento, contraseña])) {
      $('.respuesta').text("Por favor llene todos los campos!");
      $('.alert').show();
      return;
    }
    $('.alert').hide();
    httpRequest(URLD + "loginControl/validarDatos/" + codigo + "/" + documento + "/" + contraseña, function () {
      var tasks = JSON.parse(this.responseText);

        console.log(tasks[0].rol);
        console.log(tasks[1]);

        if(!tasks[1]){
          $('.respuesta').text("Datos incorrectos!");
          $('.alert').show();
        }else{
          if(tasks[0].rol==1){
            window.location.href = URLD + "adminControl/render/";
          }else if(tasks[0].rol==2){
            window.location.href = URLD + "ingenieroControl/render/";
          } else if(tasks[0].rol==3){
            window.location.href = URLD + "estudianteControl/render/";
          }
        }


     /* if(resp==1){
        window.location.href = URLD + "estudianteControl/render/";
      }else{
        $('.respuesta').text("Datos incorrectos!");
        $('.alert').show();
      }*/
    });
   
  
  }

function verificarVacio(param){
    for (let i = 0; i < param.length; i++) {
        if(param[i]==""){
            return false;
        }
    }
    return true;
  }

function registrarEstudiante(){
  event.preventDefault();
  var nombre = $('#nombre').val();
  var apellido = $('#apellido').val();
  var cedula = $('#cedula').val();
  var codigo = $('#codigo').val();
  var email = $('#email').val();
  var correo = $('#correo').val();
  var telefono = $('#telefono').val();
  var password = $('#password').val();

  if (!verificarVacio([nombre, apellido, cedula,codigo, email, correo,telefono, password])) {
    $('.respuesta').text("Por favor llene todos los campos!");
    $('.alert').show();
    return;
  }
  $('.alert').hide();

  httpRequest(URLD + "loginControl/registroData/" + nombre + "/" + apellido + "/" + cedula + "/" + codigo + "/" + email + "/"+ correo + "/" + telefono  + "/" + password, function () {
    var tasks = this.responseText;

    if(tasks==1){
        window.location.href = URLD + "estudianteControl/render/";
    }


  });
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
  

