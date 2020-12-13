
@extends('layouts.director')


@section('content')


    <!-- Sidenav -->
    <!-- Main content -->
    @include('dashboard.director.nav.nav')


<div class="container-fluid mt--6" id="contenedor">
    <h1>Seguimiento y Control</h1>
    <div class="card">
        <div class="card-header bg-transparent">
            <div class="row align-items-center">
                <div class="col">
                    <h6 class="text-uppercase text-muted ls-1 mb-1">Eventos</h6>
                    <h5 class="h3 mb-0">Creacion de Eventos</h5>
                </div>
            </div>
        </div>

        <div class="card-body">

            <form action="{{ route('admin.evento') }}" method="POST"  enctype="multipart/form-data">
                @csrf
                <div class="row" style="border-top: 3px solid #3c8dbc; background-color: white; padding-bottom: 10px;">
                    <div class="col-lg-8">
                        <br>

                            <div class="form-group">
                                <label for="correo">Titulo</label>
                                <input type="text"  class="form-control {{ $errors->has('titulo') ? ' is-invalid' : '' }}" value="{{ old('titulo') }}" id="titulo" name="titulo" required>
                                @if ($errors->has('titulo'))
                                    <span style="margin-bottom:18px" class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('titulo') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="correo">Direccion</label>
                                        <input type="text" class="form-control {{ $errors->has('direccion') ? ' is-invalid' : '' }}" value="{{ old('direccion') }}"  id="direccion" name="direccion" required>
                                        @if ($errors->has('direccion'))
                                            <span style="margin-bottom:18px" class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('direccion') }}</strong>
                                             </span>
                                        @endif
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="correo">Ciudad</label>
                                        <input type="text"  class="form-control {{ $errors->has('ciudad') ? ' is-invalid' : '' }}" value="{{ old('ciudad') }}"  id="ciudad" name="ciudad" required>
                                        @if ($errors->has('ciudad'))
                                            <span style="margin-bottom:18px" class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('ciudad') }}</strong>
                                             </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="fecha">Fecha</label>
                                        <input type="date"  min=" <?php $hoy=date("Y-m-d"); echo $hoy;?>"  class="form-control {{ $errors->has('fecha') ? ' is-invalid' : '' }}" value="{{ old('fecha') }}"  id="fecha"  name="fecha" required>
                                        @if ($errors->has('fecha'))
                                            <span style="margin-bottom:18px" class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('fecha') }}</strong>
                                             </span>
                                        @endif
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="hora">Hora</label>
                                        <input type="time"  class="form-control {{ $errors->has('hora') ? ' is-invalid' : '' }}" value="{{ old('hora') }}"  id="hora" name="hora" required>
                                        <span>Formato : hora:minutos (am/pm)</span>
                                        @if ($errors->has('hora'))
                                            <span style="margin-bottom:18px" class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('hora') }}</strong>
                                             </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="correo">Ponente/Responsable</label>
                                <input type="text"  class="form-control {{ $errors->has('responsable') ? ' is-invalid' : '' }}" value="{{ old('responsable') }}"  id="responsable" name="responsable" required>
                                @if ($errors->has('responsable'))
                                    <span style="margin-bottom:18px" class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('responsable') }}</strong>
                                             </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Resumen</label>
                                <textarea id="descripcion"  class="form-control {{ $errors->has('descripcion') ? ' is-invalid' : '' }}" value="{{ old('descripcion') }}"  id="exampleFormControlTextarea1" rows="3" style="resize: none; height: 300px;" name="descripcion" required></textarea>
                                @if ($errors->has('descripcion'))
                                    <span style="margin-bottom:18px" class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('descripcion') }}</strong>
                                             </span>
                                @endif
                            </div>
                            <div style="padding-top: 25px;">
                                <button type="submit" id="crearEvento" class="btn btn-primary" style="background-color: #dd4b39; border-color: #dd4b39;">Crear Evento</button>
                            </div>




                    </div>
                    <div class="col-lg-4" style="border-radius:5%;border-color: red;">
                        <div class="card border-danger mb-3" style="max-width: 18rem;">
                            <br>
                            <div class="card-header" style=" border-style: solid;">Envío</div>
                            <div class="card-body text-danger" style=" border-style: solid;">
                                <h5 class="card-title">A quienes se dirigen ... </h5>
                                <p class="card-text">
                                    <b>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="envio" id="gridRadios1" value="2" checked>
                                            <label class="form-check-label" for="gridRadios1">
                                                Todos
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="envio" id="gridRadios2" value="1">
                                            <label class="form-check-label" for="gridRadios2">
                                                Egresados
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="envio" id="gridRadios3" value="0">
                                            <label class="form-check-label" for="gridRadios3">
                                                Estudiantes activos
                                            </label>
                                        </div>
                                    </b>
                                </p>
                            </div>
                        </div>

                            <div class="input-group">
                                <legend>Subir Imagen</legend>
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupFileAddon01">Cargar</span>
                                </div>
                                <div class="custom-file">
                                    <input id="foto" name="foto" style="display:none" onchange="fileValidation(foto)" type="file" class="custom-file-input" id="inputGroupFile01"
                                           aria-describedby="inputGroupFileAddon01">
                                    <label name="foto" class="custom-file-label" for="foto">Buscar Imagen</label>
                                </div>
                            </div>


                        <div style="text-align:center; width:100%;height:50%; display:block; border: 1px solid #ddd;border-radius: 4px;padding: 5px ;margin-top:20px; color:red" id="imagePreview"></div>
                    </div>
                </div>
            </form>



        </div>
    </div>
</div>

@endsection

@section('script')
    <script src="{{asset('js/director/main.js')}}"></script>
@endsection
