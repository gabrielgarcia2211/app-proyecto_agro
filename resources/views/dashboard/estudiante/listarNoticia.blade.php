@extends('layouts.estudiante')

@section('contentEstudiante')

    @include('dashboard.estudiante.nav.nav')


    <div class="container-fluid mt--6" id="contenedor">

        <div class="card">
            <div class="card-header bg-transparent">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="text-uppercase text-muted ls-1 mb-1">Lista</h6>
                        <h5 class="h3 mb-0">Lista de Todas las Noticias</h5>
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
                                            <h5 class="card-title">{{$data[$j]->titulo}}</h5>
                                            <p class="card-text"><span style="color:blue; font-family: Nunito, sans-serif">Autor: </span> {{$data[$j]->autor}}</p>
                                            <p  class="card-text"><span style="color:blue; font-family: Nunito, sans-serif">Noticia: </span> {{$data[$j]->noticia}}</p>
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
            <a class="btn" href="https://danielcaos.foroactivo.com/" target="_blank" style="background: #73a6c0;color: white">
                Nuestro Foro
            </a>
        </div>
    </div>

@endsection

@section('script')
    <script src="{{asset('js/estudiante/main.js')}}"></script>
@endsection
