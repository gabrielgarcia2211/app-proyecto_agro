
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
                    <h6 class="text-uppercase text-muted ls-1 mb-1">Encuesta</h6>
                    <h5 class="h3 mb-0">Envíar Formulario</h5>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{route('admin.encuesta')}}" method="POST" id="form-encuesta">
                @csrf
                    <div class="row" style="border-top: 3px solid #3c8dbc; background-color: white; padding-bottom: 10px;">
                        <div class="col-lg-8">
                            <br>

                                <div class="form-group">
                                <label for="correo">Asunto</label>
                                <input type="text" class="form-control" id="asunto" name="asunto" required>
                            </div>
                                <div class="form-group">
                                    <label for="correo">Url Formulario</label>
                                    <input type="url" class="form-control" id="url" name="url" required>
                                </div>
                                <div class="form-group">
                                    <label for="cuerpo">Mensaje</label>
                                    <textarea id="cuerpo" class="form-control" name="cuerpo" rows="3" style="resize: none; height: 300px;"></textarea>
                                </div>
                                <button type="submit"  id="enviarCo" class="btn btn-primary" style="background-color: #dd4b39; border-color: #dd4b39;">Enviar</button>


                        </div>
                         <div class="col-lg-4" style="border-radius:5%;border-color: red;">
                        <div class="card border-danger mb-3" style="max-width: 18rem;">
                            <br>
                            <div class="card-header">Envío</div>
                            <div class="card-body text-danger">
                                <h5 class="card-title">A quienes se dirigen ... </h5>
                                <p class="card-text">
                                    <b>
                                        <!--<div class="form-check">
                                            <input class="form-check-input" type="radio" name="envio" id="gridRadios1" value="0" checked>
                                            <label class="form-check-label" for="gridRadios1">
                                                Todos
                                            </label>
                                        </div>-->
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="envio" id="gridRadios2" value="1" checked>
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
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
    <script src="{{asset('js/director/main.js')}}"></script>
@endsection
