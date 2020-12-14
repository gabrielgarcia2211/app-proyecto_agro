

@extends('layouts.estudiante')

@section('contentEstudiante')

    @include('dashboard.estudiante.nav.nav')
        <!-- Page content -->
            <div class="container-fluid mt--6" id="contenedor">

                <div class="card">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase text-muted ls-1 mb-1">Informacion</h6>
                                <h5 class="h3 mb-0">Mi tesis</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="border-top: 3px solid #3c8dbc; background-color: white; padding-bottom: 10px;">
                            <div class="contenido_lista_eventos" style="margin-top: 10px;">
                            </div>
                        </div>
                        @if(isset($json))
                            <?php $i=0?>
                            <?php $aux = count($json)/2?>
                            @for($m = 0; $m < $aux ; $m++)
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

        @endsection

        @section('script')
            <script src="{{asset('js/estudiante/main.js')}}"></script>
@endsection


