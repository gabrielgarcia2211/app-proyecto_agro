@extends('layouts.empresa')

@section('contentEmpresa')

    @include('dashboard.empresa.nav.nav')
    <!-- Page content -->
    <div class="container-fluid mt--6" id="contenedor">
        <div class="card">
            <div class="card-header bg-transparent">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="text-uppercase text-muted ls-1 mb-1">Hojas de Vida</h6>
                        <h5 class="h3 mb-0">Hoja de Vida de Egresados</h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="box box-primary cajaO" style="border-top: 3px solid #3c8dbc; background-color: white; padding-bottom: 10px;">


                    <div class="contenido_lista_empresa" style="border-top: 3px solid #3c8dbc; background-color: white; padding-bottom: 10px; padding-top:10px;">

                        <div class="row">
                            <div class="col">
                                <div class="table-responsive">
                                    <table class="table  table-striped">
                                        <thead class="" style="background: #8bb6ff;color: black">
                                        <tr>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Apellido</th>
                                            <th scope="col">Celular</th>
                                            <th scope="col">Correo</th>
                                            <th scope="col">Direccion</th>
                                            <th scope="col">Documento</th>
                                            <th colspan=2 scope="col" style="text-align: center">Hoja de Vida</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(isset($data))
                                            @foreach($data as $d)
                                                <tr>
                                                    <td>{{$d->nombres}}</td>
                                                    <td>{{$d->apellidos}}</td>
                                                    <td>{{$d->celular}}</td>
                                                    <td>{{$d->correo}}</td>
                                                    <td>{{$d->direccion}}</td>
                                                    <td>{{$d->documento}}</td>
                                                    <td style="text-align: center" > <a href="{{$ruta[$d->archivo]}}" target="_blank" type="button" class="btn btn-success">Ver Documento</a></td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>





                </div>
            </div>
        </div>
    </div>

@endsection
