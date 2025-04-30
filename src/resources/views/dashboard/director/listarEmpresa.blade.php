
@extends('layouts.director')


@section('content')


    <!-- Sidenav -->
    <!-- Main content -->
    @include('dashboard.director.nav.nav')
    <div class="container-fluid mt--6" id="contenedor">



        <div class="container" >
            <div style="height:50px"></div>
            <div class="card">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-uppercase text-muted ls-1 mb-1">Listas</h6>
                            <h5 class="h3 mb-0">Lista de Todas las Empresas</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="contenido_lista_empresa" style="border-top: 3px solid #3c8dbc; background-color: white; padding-bottom: 10px; padding-top:10px;">

                        <div class="row">
                           <div class="col">
                               <div class="table-responsive">
                               <table class="table  table-striped">
                                   <thead class="" style="background: #8bb6ff;color: black">
                                   <tr>
                                       <th scope="col">Nit</th>
                                       <th scope="col">Nombre</th>
                                       <th scope="col">Celular</th>
                                       <th scope="col">Telefono</th>
                                       <th scope="col">Direccion</th>
                                       <th scope="col">Ciudad</th>
                                       <th scope="col">Correo</th>
                                       <th colspan=2 scope="col" style="text-align: center">Convenio</th>
                                   </tr>
                                   </thead>
                                   <tbody>
                                   @if(isset($data))
                                       @foreach($data as $d)
                                           <tr>
                                               <td>{{$d->codigo}}</td>
                                               <td>{{$d->nombre}}</td>
                                               <td>{{$d->celular}}</td>
                                               <td>{{$d->telefono}}</td>
                                               <td>{{$d->direccion}}</td>
                                               <td>{{$d->ciudad}}</td>
                                               <td>{{$d->email}}</td>
                                               <td> <a href="{{$ruta[$d->convenio]}}" target="_blank" type="button" class="btn btn-success">Ver Documento</a></td>
                                               <td>
                                                   <form id="formuConvenio" action="{{route('admin.empresa.eliminar', [$d->codigo, $d->convenio])}}" method="POST" onsubmit="return eliminarConvenio();">
                                                       @csrf
                                                       <button class="btn btn-danger" style="width: 100%">Eliminar</button>
                                                   </form>
                                               </td>
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

        @endsection

        @section('script')
            <script src="{{asset('js/director/main.js')}}"></script>
@endsection
