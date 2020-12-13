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

                                    <form id="form-buscarCodigo" action="{{route('admin.codigo')}}" method="post">
                                        @csrf
                                        <div class="input-group mb-3" style="padding-left: 10px; padding-right: 10px;">
                                            <input type="number" name="codigo" maxlength="7" id="dataCodigo" class="form-control"
                                                   placeholder="Codigo Estudiante" aria-label="Recipient's username" aria-describedby="button-addon2"
                                                   >
                                            <div class="input-group-append">
                                                <button onclick="" class="btn btn-outline-secondary buscarCodigo" type="submit" id="button-addon2"
                                                        style="background-color: #dd4b39; border-color: #dd4b39; color: white;">Buscar</button>
                                            </div>
                                        </div>
                                    </form>


                                    <div style="width:80%;margin:auto; display:none; text-align:center; padding:10px ; margin-top:15px"
                                         id="actualizarE" class="alert alert-danger" role="alert">
                                        <p class="respuestaACtu" id=""></p>
                                    </div>
                                    <div style="width:80%; margin:auto;display:none;  text-align:center; padding:10px ; margin-top:15px"
                                         id="actualizarE2" class="alert alert-success" role="alert">
                                        Cargado Correctamente
                                    </div>

                                    <form id="form-datosCarga" action="{{route('admin.actualizar.data')}}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="nombre">Nombre</label>
                                            <input type="text" name="nombre" class="form-control {{ $errors->has('nombre') ? ' is-invalid' : '' }}" value="{{ old('nombre') }}"  id="nombre" required>
                                            @if ($errors->has('nombre'))
                                                <span style="margin-bottom:18px" class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('nombre') }}</strong>
                                                 </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="apellido">Apellido</label>
                                            <input type="text"  name="apellidos" class="form-control {{ $errors->has('apellidos') ? ' is-invalid' : '' }}" value="{{ old('apellidos') }}" id="apellido" required>
                                            @if ($errors->has('apellidos'))
                                                <span style="margin-bottom:18px" class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('apellidos') }}</strong>
                                                 </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="codigo">Codigo</label>
                                            <input type="text" name="codigo" class="form-control {{ $errors->has('codigo') ? ' is-invalid' : '' }}" value="{{ old('codigo') }}" id="codigo" required>
                                            @if ($errors->has('codigo'))
                                                <span style="margin-bottom:18px" class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('codigo') }}</strong>
                                                 </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="fechai">Fecha Ingreso</label>
                                            <input type="text"  name="fechai"class="form-control {{ $errors->has('fechai') ? ' is-invalid' : '' }}" value="{{ old('fechai') }}" id="fechai" readonly required>
                                            @if ($errors->has('fechai'))
                                                <span style="margin-bottom:18px" class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('fechai') }}</strong>
                                                 </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="codigo11">Codigo Saber 11</label>
                                            <input type="text"  name="codigo11"class="form-control {{ $errors->has('codigo11') ? ' is-invalid' : '' }}" value="{{ old('codigo11') }}" id="codigo11" required>
                                            @if ($errors->has('codigo11'))
                                                <span style="margin-bottom:18px" class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('codigo11') }}</strong>
                                                 </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="codigoPro">Codigo Saber Pro</label>
                                            <input type="text"  name="codigoPro" class="form-control {{ $errors->has('codigoPro') ? ' is-invalid' : '' }}" value="{{ old('codigoPro') }}" id="codigoPro" required>
                                            @if ($errors->has('codigoPro'))
                                                <span style="margin-bottom:18px" class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('codigoPro') }}</strong>
                                                 </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="promedio">Promedio</label>
                                            <input type="text"  name="promedio"class="form-control {{ $errors->has('promedio') ? ' is-invalid' : '' }}" value="{{ old('promedio') }}" id="promedio" required>
                                            @if ($errors->has('promedio'))
                                                <span style="margin-bottom:18px" class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('promedio') }}</strong>
                                                 </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="smestre">Semestre Cursado</label>
                                            <input type="text"  name="semestre" class="form-control {{ $errors->has('semestre') ? ' is-invalid' : '' }}" value="{{ old('semestre') }}" id="semestre" required>
                                            @if ($errors->has('semestre'))
                                                <span style="margin-bottom:18px" class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('semestre') }}</strong>
                                                 </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="materias">Materias Aprobadas</label>
                                            <input type="text"  name="materias" class="form-control {{ $errors->has('materias') ? ' is-invalid' : '' }}" value="{{ old('materias') }}" id="materias" required>
                                            @if ($errors->has('materias'))
                                                <span style="margin-bottom:18px" class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('materias') }}</strong>
                                                 </span>
                                            @endif
                                        </div>
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                                            <label class="form-check-label" for="exampleCheck1">Acepto</label>
                                        </div>
                                        <button type="submit" class="btn btn-primary" id=""
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

                                    <form id="form-buscarCodigoEgreso" action="{{route('admin.codigo')}}" method="post">
                                        @csrf
                                        <div class="input-group mb-3" style="padding-left: 10px; padding-right: 10px;">
                                            <input type="number" name="codigoEgre" maxlength="7" id="busquedaCodigoF" class="form-control"
                                                   placeholder="Codigo Estudiante" aria-label="Recipient's username" aria-describedby="button-addon2"
                                                   required>
                                            <div class="input-group-append">
                                                <button onclick="" class="btn btn-outline-secondary buscarCodigoEgreso" type="submit" id="button-addon2"
                                                        style="background-color: #dd4b39; border-color: #dd4b39; color: white;">Buscar</button>
                                            </div>
                                        </div>
                                    </form>

                                    <div style="width:80%;margin:auto; display:none; text-align:center; padding:10px ; margin-top:15px"
                                         id="alertCodigo" class="alert alert-danger" role="alert">
                                        <p class="respuesta" id="respuestaCarga"></p>
                                    </div>
                                    <div style="width:80%; margin:auto;display:none;  text-align:center; padding:10px ; margin-top:15px"
                                         id="alert2Codigo" class="alert alert-success" role="alert">
                                        Cargado Correctamente
                                    </div>


                                    <form  action="{{route('admin.actualizar.egresado')}}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="nombre">Nombre</label>
                                            <input type="text" name="nombreEgresado" id="nombreF"  class="form-control {{ $errors->has('nombreEgresado') ? ' is-invalid' : '' }}" value="{{ old('nombreEgresado') }}" readonly>
                                            @if ($errors->has('nombreEgresado'))
                                                <span style="margin-bottom:18px" class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('nombreEgresado') }}</strong>
                                                 </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="codigo">Codigo</label>
                                            <input type="text" name="codigoEgresado" id="codigoF"  class="form-control {{ $errors->has('codigoEgresado') ? ' is-invalid' : '' }}" value="{{ old('codigoEgresado') }}"readonly>
                                            @if ($errors->has('codigoEgresado'))
                                                <span style="margin-bottom:18px" class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('codigoEgresado') }}</strong>
                                                 </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="fechai">Fecha Ingreso</label>
                                            <input type="text" name="fechaIngreso" id="fechaiF"  class="form-control {{ $errors->has('fechaIngreso') ? ' is-invalid' : '' }}" value="{{ old('fechaIngreso') }}"readonly>
                                            @if ($errors->has('fechaIngreso'))
                                                <span style="margin-bottom:18px" class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('fechaIngreso') }}</strong>
                                                 </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="fechae">Fecha Egreso</label>
                                            <input type="date" name="fechaEgreso" id="fechaeF"  class="form-control {{ $errors->has('fechaEgreso') ? ' is-invalid' : '' }}" value="{{ old('fechaEgreso') }}"required>
                                            @if ($errors->has('fechaEgreso'))
                                                <span style="margin-bottom:18px" class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('fechaEgreso') }}</strong>
                                                 </span>
                                            @endif
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
                                                onclick="">Actualizar </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection
@section('script')
    <script src="{{asset('js/director/main.js')}}"></script>
@endsection
