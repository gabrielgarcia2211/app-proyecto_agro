<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Ingenieria Agroindustrial</title>


    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
            integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
            integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
            crossorigin="anonymous"></script>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link rel="shortcut icon" href="{{ asset('img/agro.png') }}" />

    <link rel="stylesheet" href="{{ asset('css/login/estiloLogin.css') }}">


</head>

<body class="text-center">
<div class="slider-wrap">
    <div class="single-slide" id="slide-1"></div>
    <div class="single-slide" id="slide-2"></div>
    <div class="single-slide" id="slide-3"></div>
    <div class="single-slide" id="slide-4"></div>
    <div class="single-slide" id="slide-5"></div>

</div>

<div style="background: white; width: 400px; position: fixed; border-top: 5px solid #dd4b39;" class="login-box-body">

    <p class="login-box-msg"><h5>Recuperacion de Contraseña</h5>

    <img src="{{ asset('img/agro.png') }}" class="rounded">

    <div id="contenedor">



            <form class="form-signin" method="POST" action="{{ route('password.email') }}">
                @csrf

                <label for="email" class="sr-only">Correo Electronico</label>
                <input type="email" name="email" id="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="correo"  required autofocus>
                @if ($errors->has('email'))
                    <span style="margin-bottom:18px" class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                        </span>
                @endif

                <button  style="margin-top:10px" type="submit" class="btn btn-danger btn-block btn-flat" id="ingresar"> {{ __('Enviar') }}</button>

                @if (session('status'))
                    <div style="margin-top:16px" class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

            </form>
        <div class="row login-link" style="border-top: 3px solid #dd4b39;">
            <div class="col-md-6 col-sm-6 col-xs-6" style="margin-top: 10px;">
                <a  href="{{ route('login') }}"><img src="{{ asset('img/student.png') }}" /></a>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6" style="margin-top: 10px;">
                <a  href="{{ route('login.empresa')}}"><img src="{{ asset('img/empire.png') }}" /></a>
            </div>
        </div>
    </div>
</div>
</body>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

</html>
