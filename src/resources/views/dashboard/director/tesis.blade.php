

@extends('layouts.director')


@section('content')


    <!-- Sidenav -->
    <!-- Main content -->
    @include('dashboard.director.nav.nav')
    <div class="container-fluid mt--6" id="contenedor">

    <div class="container" id="contenedor">

    <div class="card">
        <div class="card-header bg-transparent">
            <div class="row align-items-center">
                <div class="col">
                    <h6 class="text-uppercase text-muted ls-1 mb-1">Tesis</h6>
                    <h5 class="h3 mb-0">Subida de tesis de grado</h5>
                </div>
            </div>
        </div>


        <div class="card-body">


            <div style="border-top: 3px solid #3c8dbc; background-color: white; padding-bottom: 10px;">
                <br>
                <h4 style="padding-left: 10px;">Seleccionar Archivo</h4>

                <form id="form-codigoTesis" action="{{route('admin.tesis.estudiante')}}" method="POST">
                    @csrf

                    <label for="codigo">Codigo</label>
                    <div style="width: 100%" class="input-group mb-3">
                        <input name="" maxlength="7"  id="codigoEstudianteT" type="number" class="form-control" aria-label="Recipient's username" aria-describedby="button-addon2" required autofocus>
                        <div class="input-group-append">
                            <button onclick="return explodeCodigo(event)" class="btn btn-outline-secondary" type="button" id="button-addon2" style="background-color: #dd4b39; color: white;">Agregar</button>
                        </div>
                        <div style="padding:10px;width: 5%">
                            <img id="carga" style="display: none" src="{{asset('/img/carga.gif')}}" alt="Funny image">
                        </div>

                    </div>
                </form>

                    <p style="color:red"class="verificarC"></p>



                    <div style="margin-bottom: 20px" class="container">
                        <table class="table" id="tblUsuario">
                            <thead>
                            <tr>
                                <th scope="col">Codigo</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Apellido</th>
                                <th scope="col">Accion</th>
                            </tr>
                            </thead>
                            <tbody id="agregar">
                            </tbody>
                        </table>
                    </div>

                <form id="formularioTesis" action="{{route('admin.tesis.guardar')}}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="form-group">
                        <label for="titulo">Titulo Tesis</label>
                        <input name="titulo" type="text" class="form-control" id="titulo" required>
                    </div>

                    <div class="input-group mb-3" style="padding-left: 10px; padding-right: 10px;">
                        <div class="input-group-prepend">
                            <span  class="input-group-text" id="inputGroupFileAddon01">Cargar</span>
                        </div>
                        <input id="listCodigos" type="text" name="listCodigos" id="" style="display:none">
                        <div class="custom-file">
                            <input name="archivo" onchange="cargaTesis()" style="display:none"type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="inputGroupFile01"><p class="nameArchivoTesis">...</p></label>
                        </div>
                    </div>

                    <button onclick="" type="submit" class="btn btn-primary" id="cargaArchivoT"style="background-color: #dd4b39; border-color: #dd4b39;">Cargar</button> <img id="carga2" style="display: none" src="{{asset('/img/carga.gif')}}" alt="Funny image">
                    <div style="display:none; text-align:center; padding:10px ; margin-top:15px" id="alertTesis" class="alert alert-danger" role="alert">
                        <p class="respuestaTesis" id="respuestaTesis"></p>
                    </div>
                    <div style="display:none; text-align:center; padding:10px ; margin-top:15px" id="alertTesis2" class="alert alert-success" role="alert">
                        <p class="respuestaTesis2"></p>
                    </div>
                </form>
            </div>
            <br>
            @if(isset($json))
                <div style="border-top: 3px solid #3c8dbc; background-color: white; padding-bottom: 10px;">
                    <div class="caja">
                        <?php $i=0?>
                        <?php $aux = count($json)/2?>
                        @for($m = 0; $m < $aux ; $m++)
                                <div style="padding: 20x;margin-top: 19px"class="container">
                                    <div class="row">
                                    @for($j = $i; $j < count($json); $j++)
                                        <?php $i=$i+1?>
                                                <div  style="padding: 10px;box-shadow: 10px 0px 18px -7px rgba(0,0,0,0.75);" class="col-md-6">
                                                    <div style="padding: 10px"class="card" style="width:100%;">
                                                            <div class="card-body">
                                                                <a href="{{$ruta[$json[$j]['archivo']]}}" target="_blank"  class="btn btn-success">Ver <i class="far fa-eye"></i></a>
                                                            </div>
                                                            <ul class="list-group list-group-flush">
                                                                <li class="list-group-item"></li>
                                                                <li class="list-group-item"><span style="color:blue; font-family: Nunito, sans-serif">Titulo: </span>{{$json[$j]['titulo']}}</li>
                                                                <li class="list-group-item"><span style="color:blue; font-family: Nunito, sans-serif">Fecha de subida: </span>{{$json[$j]['fecha']}}</li>
                                                                <ol style="padding: 10px">
                                                                    <span style="color:blue; font-family: Nunito, sans-serif">Codigo de estudiante: </span>
                                                                    @for($f=0; $f < count($json[$j]['estudiantes']) ; $f++)
                                                                        <ul style="padding: 5px">{{$json[$j]['estudiantes'][$f]}}</ul>
                                                                    @endfor

                                                                </ol>

                                                            </ul>
                                                    </div>
                                                </div>
                                                @if(($i % 2) == 0)
                                                    </div>
                                                    @break;
                                                @endif
                                    @endfor
                                </div>
                            @endfor
                    </div>
                </div>
            @endif
                </div>
            </div>
        </div>
    </div>
        @endsection

        @section('script')
            <script src="{{asset('js/director/main.js')}}"></script>
@endsection
