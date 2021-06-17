

@extends('layouts.estudiante')

@section('contentEstudiante')

    @include('dashboard.estudiante.nav.nav')
        <!-- Page content -->
            <div class="container-fluid mt--6" id="contenedor">

                <div class="card">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase text-muted ls-1 mb-1">Detalle Noticias</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="box box-primary" style="border-top: 3px solid #3c8dbc; background-color: white; padding-bottom: 10px;">
                            <br>
                            <div class="card" style="width: 100%">
                                <div class="card-body">
                                    <h5 class="card-title">{{$noticia->titulo}}</h5>
                                    <h6 class="card-subtitle mb-2 text-muted"><span>{{$noticia->autor}} . añade...</span></h6>
                                    <p class="card-text" style="text-align: justify">{{$noticia->noticia}}</p>
                                    <a href="{{route('estudiante.noticia')}}" class="card-link">Volver</a>
                                    <a class="btn" href="https://danielcaos.foroactivo.com/" target="_blank" style="background: #73a6c0;color: white;float: right">
                                        Añadir al Foro
                                    </a>
                                </div>
                            </div>

                        </div>
                </div>
            </div>

        @endsection

        @section('script')
            <script src="{{asset('js/estudiante/main.js')}}"></script>
@endsection


