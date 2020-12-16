@extends('layouts.director')


@section('content')


    <!-- Sidenav -->
    <!-- Main content -->
    @include('dashboard.director.nav.nav')


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
                                            @if($data[$j]->envio==1)
                                            <p  class="card-text"><span style="color:blue; font-family: Nunito, sans-serif">Destinatario: </span> Egresados</p>
                                            @elseif($data[$j]->envio==0)
                                            <p  class="card-text"><span style="color:blue; font-family: Nunito, sans-serif">Destinatario: </span> Estudiantes</p>
                                            @else
                                            <p  class="card-text"><span style="color:blue; font-family: Nunito, sans-serif">Destinatario: </span> Egresados/Estudiantes</p>
                                            @endif
                                            <form id="formu-noticia" action="{{route('admin.noticia.eliminar', [$data[$j]->id])}}"  method="POST" onsubmit="return eliminarNoticia()">
                                                @csrf
                                                <button class="btn btn-danger" >Eliminar</button>
                                            </form>
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
    <script src="{{asset('js/director/main.js')}}"></script>
@endsection
