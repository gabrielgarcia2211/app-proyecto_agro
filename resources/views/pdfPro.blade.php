<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
    <title>Pdf</title>

</head>
<body>
<img src="{{asset('img/agro.png')}}" width="60" height="60" alt="" style="display: inline-block"> <h4 style="display: inline-block;margin-left: 2%">Ingenieria Agroindustrial</h4>
    @if(!empty($ingreso))
    <p style="padding: 10px;color: blue">Informacion de Estudiantes Proximos a Presentar Pruebas Pro</p>
    <div class="table-responsive">
        <table class="table table-striped table-responsive-sm">
            <thead>
            <tr>
                <th scope="col" style="text-align: center">Codigo</th>
                <th scope="col" style="text-align: center">Documento</th>
                <th scope="col" style="text-align: center">Nombre</th>
                <th scope="col" style="text-align: center">Apellido</th>
                <th scope="col" style="text-align: center">Correo Institucional</th>

            </tr>
            </thead>
            <tbody>
            @foreach($ingreso as $data)
                <tr>
                    <td style="text-align: center">{{$data["codigo"]}}</td>
                    <td style="text-align: center">{{$data["documento"]}}</td>
                    <td style="text-align: center">{{$data["nombres"]}}</td>
                    <td style="text-align: center">{{$data["apellidos"]}}</td>
                    <td style="text-align: center">{{$data["email"]}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @endif








<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>
</html>
