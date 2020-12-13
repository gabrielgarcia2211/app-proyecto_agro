@extends('layouts.estudiante')

@section('contentEstudiante')

    @include('dashboard.estudiante.nav.nav')
        <!-- Page content -->
        <div class="container-fluid mt--6" id="contenedor">


            <div class="row">
                <div class="col-7">
                    <div class="card">
                        <div class="card-header bg-transparent">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="text-uppercase text-muted ls-1 mb-1">Visualizar</h6>
                                    <h5 class="h3 mb-0">Visualizacion de datos</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h1>Perfil del Estudiante</h1>
                            <div class="box box-primary" style="border-top: 3px solid #3c8dbc; background-color: white;">
                                <form>
                                    <div class="form-group">
                                        <label for="nombre">Nombres</label>
                                        <input type="text" class="form-control" id="nombre" value="{{$dataEstudiante[0]->nombres}}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="apellido">Apellidos</label>
                                        <input type="text" class="form-control" id="apellido" value="{{$dataEstudiante[0]->apellidos}}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="telefono">Telefono</label>
                                        <input type="number" class="form-control" id="telefono" value="{{$dataEstudiante[0]->telefono}}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="direccion">Direccion</label>
                                        <input type="text" class="form-control" id="direccion" value="{{$dataEstudiante[0]->direccion}}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="fechai">Fecha de Ingreso</label>
                                        <input type="text" class="form-control" id="fechai" value="{{$dataEstudiante[0]->fechaingreso}}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="fechae">Fecha de Egreso</label>
                                        <input type="text" class="form-control" id="fechae" value="{{isset($dataEstudiante[0]->fechaengreso)?$dataEstudiante[0]->fechaEngreso:"No asiganda"}}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="correoi">Correo Institucional</label>
                                        <input type="email" class="form-control" id="correoi" value="{{$dataEstudiante[0]->email}}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="correop">Correo Personal</label>
                                        <input type="email" class="form-control" id="correop" value="{{$dataEstudiante[0]->correo}}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="empresa">Nit Empresa Actual</label>
                                        <input type="text" class="form-control" id="empresa" value="{{isset($empresa[0]->nitemprea)?$empresa[0]->nitemprea:""}}" readonly>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-5">
                    <div class="card">
                        <div class="card-header bg-transparent">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="text-uppercase text-muted ls-1 mb-1">Visualizar</h6>
                                    <h5 class="h3 mb-0">Visualizacion de datos</h5>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">

                            <div style="text-align: center;">
                                <img src="{{asset('img/user.png')}}" alt="..." class="rounded-circle" style="background-color: grey;">
                            </div>
                            <br>
                            <div style="border-top: 3px solid #3c8dbc; background-color: white;">
                                <h4 style="padding-left: 10px;">Seleccionar Hoja de Vida</h4>



                                <form action="{{route('estudiante.hoja')}}" id="formu-hoja" class="formularioEstudiante" method="POST" enctype="multipart/form-data">
                                   @csrf
                                    <div class="form-group" style="display: none">
                                        <label for="nombre">Codigo</label>
                                        <input type="text" class="form-control" name="codigo" value="" readonly>
                                    </div>
                                    <div class="input-group mb-3" style="padding-left: 10px; padding-right: 10px; padding-bottom: 10px;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupFileAddon01">Cargar</span>
                                        </div>
                                        <div class="custom-file">
                                            <input  onchange="cargaHoja()" type="file" style="display:none" name="archivo" id="hojaVida" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                            <label class="custom-file-label" for="hojaVida">
                                                <p class="nameArchivo">...</p>
                                            </label>
                                        </div><a style="margin-top:2%;margin-left: 2%" onclick="info(event)" href=""><i class="fas fa-question"></i></a>
                                    </div>
                                    <button type="submit"  id="cargaHojaVida" class="btn btn-primary" style="background-color: #dd4b39; border-color: #dd4b39;">Cargar</button>
                                    <div style="display:none; text-align:center; padding:10px ; margin-top:15px" id="alert" class="alert alert-danger" role="alert">
                                        <p class="respuesta" id="respuesta"></p>
                                    </div>
                                    <div style="display:none; text-align:center; padding:10px ; margin-top:15px" id="alert2" class="alert alert-success" role="alert">
                                        Cargado Correctamente
                                    </div>


                                </form>

                            </div>
                            <br>
                            <div id="hojav" style="border-top: 3px solid #3c8dbc; background-color: white;">
                                <div class="form-group">
                                    <h4 class="control-label" style="padding-left: 10px;">Visualizar Hoja de Vida</h4>
                                    <div class="embed-responsive embed-responsive-16by9" id="pdf">
                                        @if(!empty($viewTesis))
                                        <iframe class="embed-responsive-item" src="{{$viewTesis[$name['archivo']]}}" allowfullscreen></iframe>
                                        @endif
                                    </div>
                                </div>

                                <form action="{{route('estudiante.autorizar')}}" id="formu-auto"  method="POST" onchange="return autorizar({{$name['autorizar']}})" >
                                        @csrf
                                    @if(empty($name))
                                    <div class="form-group form-check">
                                        <label class="form-check-label" for="exampleCheckPermiso">Acepto (Mi hoja de vida estará visible a las empresas)</label>
                                    </div>
                                    @elseif($name['autorizar']==1)
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheckPermiso" checked>
                                            <label class="form-check-label" for="exampleCheckPermiso">Acepto (Mi hoja de vida estará visible a las empresas)</label>
                                        </div>
                                    @elseif($name['autorizar']==0)
                                            <div class="form-group form-check">
                                                <input type="checkbox" class="form-check-input" id="exampleCheckPermiso" >
                                                <label class="form-check-label" for="exampleCheckPermiso">Acepto (Mi hoja de vida estará visible a las empresas)</label>
                                            </div>
                                    @endif
                                </form>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <br>
        </div>

@endsection

@section('script')
    <script src="{{asset('js/estudiante/main.js')}}"></script>
@endsection
