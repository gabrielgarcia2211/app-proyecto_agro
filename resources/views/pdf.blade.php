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
    @if(!empty($dataEstudiante))
    <p style="padding: 10px;color: blue">Informacion Personal Estudiantil</p>
    <div class="table-responsive">
        <table class="table table-striped table-responsive-sm">
            <thead>
            <tr>
                <th scope="col" style="text-align: center">Codigo</th>
                <th scope="col" style="text-align: center">Nombre</th>
                <th scope="col" style="text-align: center">Correo</th>
                <th scope="col" style="text-align: center">Documento</th>
                <th scope="col" style="text-align: center">Direccion</th>
            </tr>
            </thead>
            <tbody>
            @foreach($dataEstudiante as $data)
                <tr>
                    <th style="width: 40px">{{$data->codigo}}</th>
                    <td style="font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif;text-align: center">{{$data->nombres}}</td>
                    <td style="width: 40px">{{$data->correo}}</td>
                    <td style="text-align: center">{{$data->documento}}</td>
                    <td>{{$data->direccion}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @endif
    @if(!empty($dataPruebasPro))
        <p style="padding: 10px;color: blue">Informacion Pruebas Saber Pro</p>
        <div class="table-responsive">
            <table class="table table-striped table-responsive-sm">
                <thead>
                <tr>
                    <th scope="col" style="text-align: center">Codigo</th>
                    <th scope="col" style="text-align: center">Lectura Critica</th>
                    <th scope="col" style="text-align: center">Razonamierto Cuantitativo</th>
                    <th scope="col" style="text-align: center">Competencias Ciudadanas</th>
                    <th scope="col" style="text-align: center">Comunicacion Escrita</th>
                    <th scope="col" style="text-align: center">Ingles</th>
                </tr>
                </thead>
                <tbody>
                @foreach($dataPruebasPro as $data)
                    <tr>
                        <th style="text-align: center">{{$data->codigo}}</th>
                        <td style="text-align: center">{{$data->lectura_critica}}</td>
                        <td style="text-align: center">{{$data->razonamiento_cuantitativo}}</td>
                        <td style="text-align: center">{{$data->competencias_ciudadana}}</td>
                        <td style="text-align: center">{{$data->comunicacion_escrita}}</td>
                        <td style="text-align: center">{{$data->ingles}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
    @if(!empty($dataPruebas11))
        <p style="padding: 10px;color: blue;margin-top: 4%">Informacion Pruebas Saber 11-ICFES</p>
        <div class="table-responsive">
            <table class="table table-striped table-responsive-sm">
                <thead>
                <tr>
                    <th scope="col" style="text-align: center">Codigo</th>
                    <th scope="col" style="text-align: center">Lectura Critica</th>
                    <th scope="col" style="text-align: center">Matematicas</th>
                    <th scope="col" style="text-align: center">Sociales Ciudadanas</th>
                    <th scope="col" style="text-align: center">Naturales</th>
                    <th scope="col" style="text-align: center">Ingles</th>
                </tr>
                </thead>
                <tbody>
                @foreach($dataPruebas11 as $data)
                    <tr>
                        <th style="text-align: center">{{$data->codigo}}</th>
                        <td style="text-align: center">{{$data->lectura_critica}}</td>
                        <td style="text-align: center">{{$data->matematicas}}</td>
                        <td style="text-align: center">{{$data->sociales_ciudadanas}}</td>
                        <td style="text-align: center">{{$data->naturales}}</td>
                        <td style="text-align: center">{{$data->ingles}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
    @if(!empty($dataGrafica))

        <div class="container-fluid" style="margin-top: 5%;margin-left: -2%">
            <table class="table table-striped table-responsive-sm">
                <tbody>
                <tr>
                    <td  style="width: 50%;">
                        <div class="card" style="width: 90%;">
                            <div class="card-body">
                                <h5 class="card-title">Resultado Saber Pro</h5>
                                <p class="card-text"><img src="https://quickchart.io/chart?c={type:'bar',data:{labels:['lectura','Razonamiento', 'Competencia Ciudadanas','Comunicacion', 'Ingles'], datasets:[{label:'Saber Pro',data:[{{$dataGrafica[0]->lectura_critica}},{{$dataGrafica[0]->razonamiento}},{{$dataGrafica[0]->competencias_ciudadana}},{{$dataGrafica[0]->comunicacion_escrita}},{{$dataGrafica[0]->ingles}}]}]}}" style="width: 100%"></p>
                            </div>
                        </div>
                    </td>
                    <td  style="width: 50%;">
                        <div class="card" style="width: 90%;">
                            <div class="card-body">
                                <h5 class="card-title">Resultado Saber 11</h5>
                                <p class="card-text"><img src="https://quickchart.io/chart?c={type:'bar',data:{labels:['lectura','Matematicas', 'Sociales Ciudadanas','Naturales', 'Ingles'], datasets:[{label:'Saber 11',data:[{{$dataGrafica[0]->lectura}},{{$dataGrafica[0]->matematicas}},{{$dataGrafica[0]->sociales_ciudadanas}},{{$dataGrafica[0]->naturales}},{{$dataGrafica[0]->ingle}}]}]}}" style="width: 100%"></p>
                            </div>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
            <table class="table table-responsive-sm" style="padding: 20px">
                <tbody>
                <tr>
                    <td  style="width: 50%;">
                        <div class="card" style="width: 100%;">
                            <div class="card-body">
                                <h5 class="card-title">Promedio Comparativo</h5>
                                <p class="card-text"><img src="https://quickchart.io/chart?c={type:'radar',data:{labels:['lectura','Matematicas', 'Sociales Ciudadanas','Ingles'], datasets:[{label:'Saber Pro',data:[{{$dataGrafica[0]->lectura_critica}},{{$dataGrafica[0]->razonamiento}},{{$dataGrafica[0]->competencias_ciudadana}},{{$dataGrafica[0]->ingles}}]},{label:'Saber 11',data:[{{$dataGrafica[0]->lectura}},{{$dataGrafica[0]->matematicas}},{{$dataGrafica[0]->sociales_ciudadanas}},{{$dataGrafica[0]->ingle}}]}]}}" style="width: 95%"></p>
                            </div>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    @endif







<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>
</html>
