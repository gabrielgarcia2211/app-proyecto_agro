
@extends('layouts.estudiante')

@section('contentEstudiante')

    @include('dashboard.estudiante.nav.nav')
    <!-- Page content -->

    <div class="container-fluid mt--6" id="contenedor">

        <div class="card">
            <div class="card-header bg-transparent">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="text-uppercase text-muted ls-1 mb-1">Lista</h6>
                        <h5 class="h3 mb-0">Lista de Todas las Oferta</h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div style="border-top: 3px solid #3c8dbc; background-color: white; padding-bottom: 10px;">
                    <div class="contenido_lista_eventos" style="margin-top: 10px;">
                    </div>
                </div>
                @if(isset($data))
                    <?php $cont=0 ?>

                    @for($m = 0; $m < count($data) / 3; $m++)
                        <div class="row">
                            @for ($j = $cont; $j <  count($data) ; $j++)
                                <?php $cont++ ?>
                                <div class="col-3">
                                    <div class="card" style="width: 18rem;padding: 10px">
                                        <div class="card-body">
                                            <h5 class="card-title">{{$data[$j]->empleo}}</h5>
                                            <p class="card-text"><h7 style="color: blue">Jornada:</h7> {{$data[$j]->jornada}}</p>
                                            <p  class="card-text"><h7 style="color: blue">Salario::</h7> {{$data[$j]->salario}}</p>
                                            <p class="card-text"><h7 style="color: blue">Telefono:</h7> {{$data[$j]->telefono}}</p>
                                            <p class="card-text"><h7 style="color: blue">Descripcion:</h7> {{$data[$j]->descripcion}}</p>
                                            <p class="card-text"><h7 style="color: blue">Requerimientos:</h7> {{$data[$j]->requerimientos}}</p>
                                        </div>
                                    </div>
                                </div>


                                @if (($cont % 4) == 0)
                                    @break
                                @endif
                            @endfor
                        </div>
                    @endfor
                @endif

            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="{{asset('js/estudiante/main.js')}}"></script>
@endsection

