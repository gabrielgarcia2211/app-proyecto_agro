@extends('layouts.director')


    @section('content')


    <!-- Sidenav -->
    <!-- Main content -->
    @include('dashboard.director.nav.nav')





    <!-- Page content -->

    <div class="container-fluid mt--6" id="contenedor">

        <div id="container">
            <div class="row">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="mb-0">Estudiantes sin tesis</h3>
                                </div>
                                <div class="col text-right">
                                    <i class="fas fa-user-friends"></i>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive" style="margin-bottom:20px;padding-left:20px">
                            <!-- Projects table -->
                            <table  class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Apellidos</th>
                                    <th scope="col">N° Documento</th>
                                </tr>
                                </thead>
                                <tbody>


                                    @if(!empty($dataEstudiante))
                                    @foreach($dataEstudiante as $estudiante)
                                    <tr>
                                         <th scope="col">{{$estudiante->nombres}}</th>
                                        <th scope="col">{{$estudiante->apellidos}}</th>
                                        <th scope="col">{{$estudiante->documento}}</th>
                                    </tr>
                                    @endforeach
                                    @endif


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="card">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="mb-0">Mision<i class="fab fa-monero"></i></h3>
                                </div>
                                <div class="col text-right">

                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Projects table -->
                            <p>
                                <strong>
                                    El Ingeniero Agroindustrial de la Universidad Francisco de Paula Santander
                                    está comprometido con el mejoramiento continuo y la calidad de los procesos
                                    académicos administrativos, cuyo propósito fundamental es la formación
                                    integral de Ingenieros Agroindustriales, involucrados en la solución de
                                    problemas del entorno, en busca del desarrollo sostenible de la región,
                                    el mejoramiento continuo y la calidad en los procesos de docencia,
                                    investigación y extensión.
                                </strong>
                            </p>

                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="card">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="mb-0">Vision <i class="fas fa-angle-double-right"></i> </h3>

                                </div>
                                <div class="col text-right">

                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Projects table -->
                            <p>
                                <strong>
                                    El Programa de Ingeniería Agroindustrial de la Universidad Francisco
                                    de Paula Santander para el año 2019, será reconocido a nivel nacional
                                    por la alta calidad, competitividad, pertinencia, generación de conocimiento,
                                    transferencia de ciencia y tecnología y por la formación de profesionales
                                    con sentido de responsabilidad social, que facilitaran la transformación
                                    de la comunidad desde el ámbito local hacia lo global.
                                </strong>
                            </p>

                        </div>
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



