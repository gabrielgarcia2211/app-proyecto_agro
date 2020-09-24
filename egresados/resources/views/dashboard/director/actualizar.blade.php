@extends('layouts.director')


@section('content')


    <!-- Sidenav -->
    <!-- Main content -->
    @include('dashboard.director.nav.nav')

    <!-- Page content -->
    <div class="container-fluid mt--6" id="contenedor">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header bg-transparent">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="text-uppercase text-muted ls-1 mb-1">Actualizacion</h6>
                                    <h5 class="h3 mb-0">Actualizar Datos Estudiantes</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <div style="border-top: 3px solid #3c8dbc; background-color: white; padding-bottom: 10px;">
                                    <br>
                                    <h4 style="padding-left: 10px;">Actualizar Estudiante</h4>
                                    <div class="input-group mb-3" style="padding-left: 10px; padding-right: 10px;">
                                        <input type="number" maxlength="7" id="busquedaCodigo" class="form-control"
                                               placeholder="Codigo Estudiante" aria-label="Recipient's username" aria-describedby="button-addon2"
                                               required>
                                        <div class="input-group-append">
                                            <button onclick="" class="btn btn-outline-secondary" type="button" id="button-addon2"
                                                    style="background-color: #dd4b39; border-color: #dd4b39; color: white;">Buscar</button>
                                        </div>
                                    </div>
                                    <div style="width:80%;margin:auto; display:none; text-align:center; padding:10px ; margin-top:15px"
                                         id="actualizarE" class="alert alert-danger" role="alert">
                                        <p class="respuestaACtu" id=""></p>
                                    </div>
                                    <div style="width:80%; margin:auto;display:none;  text-align:center; padding:10px ; margin-top:15px"
                                         id="actualizarE2" class="alert alert-success" role="alert">
                                        Cargado Correctamente
                                    </div>
                                    <form id="fcargaDatos">
                                        <div class="form-group">
                                            <label for="nombre">Nombre</label>
                                            <input type="text" class="form-control" id="nombre" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="apellido">Apellido</label>
                                            <input type="text" class="form-control" id="apellido" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="codigo">Codigo</label>
                                            <input type="text" class="form-control" id="codigo" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="fechai">Fecha Ingreso</label>
                                            <input type="text" class="form-control" id="fechai" readonlyrequired>
                                        </div>
                                        <div class="form-group">
                                            <label for="codigo11">Codigo Saber 11</label>
                                            <input type="text" class="form-control" id="codigo11" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="codigoPro">Codigo Saber Pro</label>
                                            <input type="text" class="form-control" id="codigoPro" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="promedio">Promedio</label>
                                            <input type="text" class="form-control" id="promedio" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="smestre">Semestre Cursado</label>
                                            <input type="text" class="form-control" id="semestre" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="materias">Materias Aprobadas</label>
                                            <input type="text" class="form-control" id="materias" required>
                                        </div>
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                                            <label class="form-check-label" for="exampleCheck1">Acepto</label>
                                        </div>

                                        <div style="width:80%;margin:auto; display:none; text-align:center; padding:10px; margin-bottom:15px"
                                             id="gar" class="alert alert-danger" role="alert">
                                            <p class="respuesta" id="garRespuesta"></p>
                                        </div>
                                        <div
                                            style="width:80%; margin:auto;display:none;  text-align:center; padding:10px ; margin-top:15px; margin-bottom:15px"
                                            id="gar2" class="alert alert-success" role="alert">
                                            Actualizado Correctamente
                                        </div>

                                        <button type="submit" class="btn btn-primary" id="botonActualizar"
                                                style="background-color: #dd4b39; border-color: #dd4b39;"
                                                onclick="">Actualizar </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
           
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header bg-transparent">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="text-uppercase text-muted ls-1 mb-1">Actualizacion</h6>
                                    <h5 class="h3 mb-0">Actualizar Fecha Egreso</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <div style="border-top: 3px solid #3c8dbc; background-color: white; padding-bottom: 10px;">
                                    <br>
                                    <h4 style="padding-left: 10px;">Actualizar Estudiante</h4>
                                    <div class="input-group mb-3" style="padding-left: 10px; padding-right: 10px;">
                                        <input type="number" maxlength="7" id="busquedaCodigoF" class="form-control"
                                               placeholder="Codigo Estudiante" aria-label="Recipient's username" aria-describedby="button-addon2"
                                               required>
                                        <div class="input-group-append">
                                            <button onclick="cargaDatos(event)" class="btn btn-outline-secondary" type="button" id="button-addon2"
                                                    style="background-color: #dd4b39; border-color: #dd4b39; color: white;">Buscar</button>
                                        </div>
                                    </div>

                                    <div style="width:80%;margin:auto; display:none; text-align:center; padding:10px ; margin-top:15px"
                                         id="alertCodigo" class="alert alert-danger" role="alert">
                                        <p class="respuesta" id="respuestaCarga"></p>
                                    </div>
                                    <div style="width:80%; margin:auto;display:none;  text-align:center; padding:10px ; margin-top:15px"
                                         id="alert2Codigo" class="alert alert-success" role="alert">
                                        Cargado Correctamente
                                    </div>


                                    <form id="fcargaDatos">
                                        <div class="form-group">
                                            <label for="nombre">Nombre</label>
                                            <input type="text" class="form-control" id="nombreF" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="codigo">Codigo</label>
                                            <input type="text" class="form-control" id="codigoF" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="fechai">Fecha Ingreso</label>
                                            <input type="text" class="form-control" id="fechaiF" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="fechae">Fecha Egreso</label>
                                            <input type="date" class="form-control" id="fechaeF" required>
                                        </div>
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1F" required>
                                            <label class="form-check-label" for="exampleCheck1F">Acepto</label>
                                        </div>

                                        <div style="width:80%;margin:auto; display:none; text-align:center; padding:10px; margin-bottom:15px"
                                             id="actu1" class="alert alert-danger" role="alert">
                                            <p class="respuesta" id="respuestaActualizar"></p>
                                        </div>
                                        <div
                                            style="width:80%; margin:auto;display:none;  text-align:center; padding:10px ; margin-top:15px; margin-bottom:15px"
                                            id="actu2" class="alert alert-success" role="alert">
                                            Actualizado Correctamente
                                        </div>

                                        <button type="submit" class="btn btn-primary" id="botonActualizar"
                                                style="background-color: #dd4b39; border-color: #dd4b39;"
                                                onclick="return actualizarFecha(event)">Actualizar </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection
