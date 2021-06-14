<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Login</title>
  <link rel="shortcut icon" href="<?php echo constant('URL')?>public/img/logoufps.png" />

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

  <!-- FontAwesome -->
  <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <!-- Custom styles for this template -->
    <link href="<?php echo constant('URL')?>public/css/login/estiloLogin.css" rel="stylesheet">
</head>

<body class="text-center">

  <div class="slider-wrap">
    <div class="single-slide" id="slide-1"></div>
    <div class="single-slide" id="slide-2"></div>
    <div class="single-slide" id="slide-3"></div>
    <!--<div class="single-slide" id="slide-4"></div>
    <div class="single-slide" id="slide-5"></div>
    -->
  </div>

  <div class="login-box-body" id="login">
    <h4>BIENVENIDO</h4>
    <form class="form-signin">
      <img src="<?php echo constant('URL')?>public/img/logoufps.png" alt="..." class="rounded" id="logo">

      <p class="login-box-msg" style="padding-top: 6px;">Ingresa tus datos para iniciar sesión</p>

      <div class="col-auto">
        <label class="sr-only" for="inlineFormInputGroup">Codigo</label>
        <div class="input-group mb-2">
          <div class="input-group-prepend">
            <div class="input-group-text"><i class="fas fa-user"></i></div>
          </div>
          <input type="text" class="form-control" id="inpCodigo" placeholder="Codigo" required autofocus>
        </div>
      </div>

      <div class="col-auto" id="">
        <label class="sr-only" for="inlineFormInputGroup">Documento</label>
        <div class="input-group mb-2">
          <div class="input-group-prepend">
            <div class="input-group-text"><i class="fas fa-user"></i></div>
          </div>
          <input type="password" class="form-control" id="inputDocumento" placeholder="Documento" required>
        </div>
      </div>

      <div class="col-auto">
        <label class="sr-only" for="inlineFormInputGroup">Contraseña</label>
        <div class="input-group mb-2">
          <div class="input-group-prepend">
            <div class="input-group-text"><i class="fas fa-lock"></i></div>
          </div>
          <input type="password" class="form-control" id="inputPassword" placeholder="Contraseña" required>
        </div>
      </div>

      <button onclick="verificarDatos(event)"  class="btn btn-danger btn-block btn-flat">Iniciar Sesión</button>
        <div class="alert alert-danger" role="alert" style="display:none;margin-top:5%">
            <p class="respuesta" ></p>
        </div>

        <a href="<?php echo constant('URL')?>loginControl/render/registro" style="margin-top: 3%;padding: 5px;display: block">¿Registrar?</a>

    </form>

  </div>

  <script src="<?php echo constant('URL')?>public/js/login/login.js"></script>
</body>

</html>