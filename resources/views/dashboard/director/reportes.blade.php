
@extends('layouts.director')


@section('content')


    <!-- Sidenav -->
    <!-- Main content -->
    @include('dashboard.director.nav.nav')

    <!-- Page content -->
    <div class="container-fluid mt--6" id="contenedor">

    <div class="card">
        <div class="card-header bg-transparent">
            <div class="row align-items-center">
                <div class="col">
                    <h6 class="text-uppercase text-muted ls-1 mb-1">Reportes</h6>
                    <h5 class="h3 mb-0">Generar Reporte</h5>
                </div>
            </div>
        </div>
        <form id="form-reporte" action="{{ route('admin.reporte') }}" method="POST"  onsubmit="return generarReporte()">
            @csrf
        <div class="card-body">
            <div class="box box-primary" style="border-top: 3px solid #3c8dbc; background-color: white; padding-bottom: 10px;">
                <br>
                <input style="display: inline-block;margin-bottom: 20px" class="form-control col-md-3 light-table-filter" data-table="order-table" type="number" id="buscadorReporte" placeholder="Bucar por codigo.." onchange="capturarReporte()"> <a onclick="infoReporte(event)" href=""><i class="fas fa-question"></i></a>
                <br>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label  for="exampleFormControlSelect1" >Seleccionar Estudiante</label>
                        <select class="form-control" id="SeReporte" name="estudiante">
                            <option>Alumno</option>
                            <option>Egresado</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label id="id1" for="exampleFormControlSelect2" id="StReporte">Seleccionar Tipo de reporte</label>
                        <select  class="form-control" id="exampleFormControlSelect2" name="reporte">
                            <option >Datos Personal</option>
                            <option >Notas pruebas Saber Pro</option>
                            <option >Notas pruebas Saber 11</option>
                            <option >Promedio Pruebas</option>
                        </select>
                    </div>
                </div>
                <div style="margin-top:20px; margin-bottom:30px">
                    <button class="btn btn-primary" style="background-color: #dd4b39; border-color: #dd4b39; color: white">Generar</button>
                </div>

                <div id="C2" style="margin: auto;">
                    <canvas id="popChart"  width="400" height="200" ></canvas>
                </div>

            </div>
        </div>
        </form>
    </div>
</div>


@endsection

@section('script')
    <script src="{{asset('js/director/main.js')}}"></script>
@endsection
