
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
                    <h5 class="h3 mb-0">Actualizar Evento</h5>
                </div>
            </div>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.evento.actualizar', [$flight['id']]) }}" method="POST" id="form-evento-actu">
                @csrf
            <div class="row" style="border-top: 3px solid #3c8dbc; background-color: white; padding-bottom: 10px;">
                <div class="col-lg-8">
                    <br>

                        <div class="form-group">
                            <label for="correo">Titulo</label>
                            <input type="text" class="form-control" class="tituloAc" name="titulo" value="{{(isset($flight)) ? $flight['titulo'] : ""}}" required>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="correo">Direccion</label>
                                    <input type="text" class="form-control" name="direccion" value="{{(isset($flight)) ? $flight['direccion'] : ""}}" required>
                                </div>
                                <div class="col-lg-6">
                                    <label for="correo">Ciudad</label>
                                    <input type="text" class="form-control" name="ciudad" value="{{(isset($flight)) ? $flight['ciudad'] : ""}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="date">Fecha</label>
                                    <input type="date"  min=" <?php $hoy=date("Y-m-d"); echo $hoy;?>" class="form-control" name="fecha" value="{{(isset($flight)) ? $flight['fecha'] : ""}}" required>
                                </div>
                                <div class="col-lg-6">
                                    <label for="correo">Hora</label>
                                    <input type="time" class="form-control" name="hora" value="{{(isset($flight)) ? $flight['hora'] : ""}}" required>
                                    <span>Formato : hora:minutos (am/pm)</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="correo">Ponente/Responsable</label>
                            <input type="text" class="form-control" name="responsable" value="{{(isset($flight)) ? $flight['responsable'] : ""}}" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Resumen</label>
                            <textarea name="descripcion" class="form-control" id="exampleFormControlTextarea1Ac" rows="3" style="resize: none; height: 300px;"  required>{{(isset($flight)) ? $flight['descripcion'] : ""}}</textarea>
                        </div>
                        <div style="padding-top: 25px;">
                            <button type="submit" id="enviarCo" class="btn btn-primary" style="background-color: #dd4b39; border-color: #dd4b39;" >Actualizar</button>
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
                                        <input class="form-check-input" type="radio" name="envioAc" id="gridRadios1" value="2" checked>
                                        <label class="form-check-label" for="gridRadios1">
                                            Todos
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="envioAc" id="gridRadios2" value="1">
                                        <label class="form-check-label" for="gridRadios2">
                                            Egresados
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="envioAc" id="gridRadios3" value="0">
                                        <label class="form-check-label" for="gridRadios3">
                                            Estudiantes activos
                                        </label>
                                    </div>
                                </b>
                            </p>
                        </div>
                    </div>
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
