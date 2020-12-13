
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
                        <h6 class="text-uppercase text-muted ls-1 mb-1">Empresa</h6>
                        <h5 class="h3 mb-0">Agregar Empresa</h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="box box-primary" style="border-top: 3px solid #3c8dbc; background-color: white; padding-bottom: 10px;">
                    <br>
                    <form id="formularioEmpresa" action="{{ route('admin.empresa.agregar') }}"  method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="">Nit</label>
                                <input  type="number" class="form-control input-number" id="nitEmpresa" name="nitEmpresa" required>
                                <p id="codigoConvenio" style="display:none; color:red">Codigo ya registrado!</p>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Nombre</label>
                                <input onkeypress="return soloLetras(event)"  type="text" class="form-control" id="nombreEmpresa"  name="nombreEmpresa" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="">Correo</label>
                                <input type="email" class="form-control input-email" id="correoEmpresa"  name="correoEmpresa" required>
                                <span id="correoV" style="color:red;display: none">direccion de correo no valida</span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Telefono</label>
                                <input  type="number" class="form-control input-number" id="telefonoEmpresa"  name="telefonoEmpresa" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="">Celular</label>
                                <input type="number" class="form-control input-number" id="celularEmpresa"  name="celularEmpresa" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Direccion</label>
                                <input type="text" class="form-control" id="direccionEmpresa"  name="direccionEmpresa" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="fecha">Fecha</label>
                                    <input type="date" min=" <?php $hoy=date("Y-m-d"); echo $hoy;?>" class="form-control" id="fecha"  name="fecha" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="contraEmpresa">Contraseña</label>
                                <input type="text" class="form-control" id="contraEmpresa"  name="contraEmpresa" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="ciudadEmpresa">Ciudad</label>
                                <input onkeypress="return soloLetras(event)"  type="text" class="form-control" id="ciudadEmpresa" name="ciudadEmpresa" required>
                            </div>
                        </div>
                        <div class="input-group mb-3" style="padding-left: 10px; padding-right: 10px;">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupFileAddon01">Cargar Convenio</span>
                            </div>

                            <div class="custom-file">
                                <input onchange="cargaConvenio()" type="file" style="display:none" class="convenio custom-file-input" id="inputGroupFile012" aria-describedby="inputGroupFileAddon01" name="archivo" required>
                                <label class="custom-file-label" for="inputGroupFile012">
                                    <p class="nameArchivo">...</p>
                                </label>
                            </div>
                        </div>
                        <button type="" onclick="guardarEmpresa(event)" class="btn btn-primary" style="background-color: #dd4b39; border-color: #dd4b39;" id="cargaArchivoE">Agregar</button>
                    </form>

                    <div style="width:80%;margin:auto; display:none; text-align:center; padding:10px " id="alertConvenio" class="alert alert-danger" role="alert">
                        <p class="respuesta" id="respuestaCorreo"></p>
                    </div>
                    <div style="width:80%; margin:auto;display:none;  text-align:center; padding:10px ; " id="alertConvenio2" class="alert alert-success" role="alert">
                        <p class="respuesta" id="respuestaCorreo2"></p>
                    </div>
                </div>
            </div>
        </div>


        @endsection

        @section('script')
            <script src="{{asset('js/director/main.js')}}"></script>
@endsection
