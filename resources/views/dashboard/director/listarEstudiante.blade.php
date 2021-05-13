
@extends('layouts.director')


@section('content')


    <!-- Sidenav -->
    <!-- Main content -->
    @include('dashboard.director.nav.nav')
    <div class="container-fluid mt--6" id="contenedor">
        <div class="container" id="contenedor">
            <div style="height:50px">
                <div class="card">
                    <form id="form-lista" action="{{ route('admin.estudiante') }}"  method="POST" >
                        @csrf
                        <div class="card-header bg-transparent">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="text-uppercase text-muted ls-1 mb-1">Listas</h6>
                                    <h5 class="h3 mb-0">Lista de todos los estudiantes registrados</h5>
                                    <h3 style="margint-top:25px">Desea listar por..</h3>
                                    <button  onclick="cargarLista(0)" id="estudiante" type="submit" class="btn btn-success">Estudiantes</button>
                                    <button onclick="cargarLista(1)" type="submit" class="btn btn-danger">Egresados</button>
                                    <img id="carga" style="display: none" src="{{asset('/img/carga.gif')}}" alt="Funny image">
                                </div>
                            </div>
                        </div>
                    </form>

                    <form id="form-reportePorcentaje" action="{{ route('admin.reporte.porcentaje') }}" method="POST"  onsubmit="return generarReportePorcentaje()">
                        @csrf
                        <div class="card-header bg-transparent">
                            <div class="row align-items-center">
                                <div class="col">
                                <h5 class="h3 mb-0">Proximos a presentar pruebas pro</h5>
                                <button style="background: #1d68a7" type="submit" class="btn btn-danger">Reporte de Aprobacion</button>
                                </div>
                            </div>
                        </div>

                    </form>


                    <div class="card-body">
                        <p class="lead">

                        <h3>Estudiantes/Egresado</h3>
                        <form id="form-busqueda" action="{{ route('admin.estudiante.buscar') }}"  method="POST" >
                            @csrf
                            <input style="display: inline-block" class="form-control col-md-3 light-table-filter" data-table="order-table" type="number" id="buscador" placeholder="Bucar por codigo.." onkeyup="capturar()">
                            <span id="resultadoBuscador" style="color:red;font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif; margin-left: 8px;padding: 10px; display: none"></span>
                            <hr>
                        </form>
                        <!-- -->

                        <div class="container">

                            <table class="table table-responsive order-table">
                                <thead>
                                <tr>
                                    <th>Codigo</th>
                                    <th>Documento</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Celular</th>
                                    <th>Correo Institucional</th>
                                    <th>Fecha Ingreso</th>
                                    <th>Fecha Egreso</th>
                                    <th>Promedio</th>
                                    <th>Prueba Saber Pro</th>
                                    <th>Prueba Saber 11</th>
                                    <th>Porcentaje Aprobacion Pro</th>
                                </tr>
                                </thead>
                                <tbody id="estudiantesCarga">

                                </tbody>
                            </table>
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
