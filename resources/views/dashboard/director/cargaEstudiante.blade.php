@extends('layouts.director')


@section('content')


    <!-- Sidenav -->
    <!-- Main content -->
    @include('dashboard.director.nav.nav')




    <!-- Page content -->
    <div class="container-fluid mt--6" id="contenedor">

        <div class="container" id="contenedor">
            <h1>Cargar Estudiantes</h1>

            <div class="card">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-uppercase text-muted ls-1 mb-1">Carga de datos</h6>
                            <h5 class="h3 mb-0">Cargar datos de estudiantes</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <div class="container">
                        <div style="border-top: 3px solid #3c8dbc; background-color: white; padding-bottom: 10px;">
                            <br>
                            <h4 style="padding-left: 10px;">Seleccionar Archivo</h4>
                            <form action="{{ route('admin.carga') }}"  method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="input-group mb-3" style="padding-left: 10px; padding-right: 10px;">
                                    <div class="input-group-prepend">
                                        <span onclick=""  class="input-group-text" id="inputGroupFileAddon01">Cargar</span>
                                    </div>
                                    <div class="custom-file">
                                        <input onchange="validarExtension()" type="file" style="display:none" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" name="file" >
                                        <label class="custom-file-label" for="inputGroupFile01">
                                            <p class="nameArchivo">...</p>
                                        </label>
                                    </div>
                                </div>


                                <button onclick="" type="submit" id="guardaExcel" class=" btn btn-primary"  style="display:inline-block; background-color: #dd4b39; border-color: #dd4b39;">Guardar</button>

                                <a href="{{ route('admin.formato') }}" style="display:inline-block; text-decoration: none" type="button" class="btn btn-success">Descargar Formato</a>
                                <a onclick="info(event)" href=""><i class="fas fa-question"></i></a>


                                <div style="display:none; text-align:center; padding:10px ; margin-top:15px" id="alert" class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <p class="respuesta" id="respuesta"></p>
                                </div>
                                <div style="display:none; text-align:center; padding:10px ; margin-top:15px" id="alert2" class="alert alert-success" role="alert">
                                    <p class="respCarga"></p>
                                </div>

                                <div style="padding: 20px; margin-top:20px" class="container">
                                    @if (session()->has('failures'))

                                        <table id="error" class="table table-danger">
                                            <tr>
                                                <th>Fila</th>
                                                <th>Campo</th>
                                                <th>Error</th>
                                                <th>Valor</th>
                                            </tr>
                                            @foreach (session()->get('failures') as $validation)
                                                <tr>
                                                    <td>{{ $validation->row() }}</td>
                                                    <td>{{ $validation->attribute() }}</td>
                                                    <td>
                                                        <ul>
                                                            @foreach ($validation->errors() as $e)
                                                                <li>{{ $e }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </td>
                                                    <td>
                                                        {{ $validation->values()[$validation->attribute()] }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>

                                    @endif
                                </div>


                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>


    <div class="main-footer">

        <footer class="footer pt-0 container main-footer" style="padding-left: 25%">
            <div class="row align-items-center justify-content-lg-between">
                <div class="col-lg-6">
                    <div class="copyright text-center  text-lg-left  text-muted">
                        &copy; 2020 <a href="https://www.creative-tim.com" class="font-weight-bold ml-1" target="_blank">Universidad Francisco de Paula Santander</a>
                    </div>
                </div>

                <div class="col-lg-6">
                    <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                        <li class="nav-item">
                            <a href="" class="nav-link" target="_blank">UFPS Tic's</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link" target="_blank">Sobre
                                nosotros</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link" target="_blank">Paginas</a>
                        </li>

                    </ul>
                </div>
            </div>
        </footer>

    </div>
@endsection

@section('script')
    <script src="{{asset('js/director/main.js')}}"></script>
@endsection
