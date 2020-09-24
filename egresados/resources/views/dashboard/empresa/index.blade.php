@extends('layouts.empresa')

@section('contentEmpresa')

<!-- Sidenav -->
<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header  align-items-center">
            <a class="navbar-brand" href="javascript:void(0)">
                <img src="{{asset('assets/img/ufps/logo-horizontal.jpg')}}" class="navbar-brand-img" alt="">
            </a>
        </div>
        <div class="navbar-inner">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Nav items -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="">
                            <i class="fas fa-list"></i>
                            <span class="nav-link-text">Ofertas Publicadas</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-paste"></i>
                            <span class="nav-link-text">Hoja Vida Egresados</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a  class="nav-link" href="#">
                            <i class="fas fa-paste"></i>
                            <span class="nav-link-text">Hoja Vida Estudiantes</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a  class="nav-link" href="#">
                            <i class="far fa-newspaper"></i>
                            <span class="nav-link-text">Publicar Oferta Laboral</span>
                        </a>
                    </li>
                </ul>
                <!-- Divider -->
                <hr class="my-3">
                <!-- Heading -->
                <h6 class="navbar-heading p-0 text-muted">
                    <span class="docs-normal">Paginas institucionales</span>
                </h6>
                <!-- Navigation -->
                <ul class="navbar-nav mb-md-3">
                    <li class="nav-item">
                        <a class="nav-link" href="https://ww2.ufps.edu.co/" target="_blank">
                            <i class="fas fa-university"></i>
                            <span class="nav-link-text">UFPS</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://divisist2.ufps.edu.co/" target="_blank">
                            <i class="ni ni-palette"></i>
                            <span class="nav-link-text">Divisist 2.0</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://uvirtual.cloud.ufps.edu.co/" target="_blank">
                            <i class="ni ni-ui-04"></i>
                            <span class="nav-link-text">U virtual UFPS</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>



<!-- Main content -->
<div class="main-content" id="panel">
    <!-- Topnav -->
    <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Search form -->
                <!-- Navbar links -->
                <ul class="navbar-nav align-items-center    ml-md-auto ">

                    <li class="nav-item d-xl-none">
                        <!-- Sidenav toggler -->
                        <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="media align-items-center">
                  <span class="avatar avatar-sm rounded-circle">
                    <img alt="Image placeholder" src="{{asset('assets/img/ufps/logo_agroindustrial.png')}}">
                  </span>
                                <div class="media-body  ml-2  d-none d-lg-block">
                                    <span class="mb-0 text-sm  font-weight-bold">Empresa Agroindustrial</span>
                                </div>
                            </div>
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav align-items-center ml-auto ml-md-0 ">

                    <li class="nav-item dropdown">
                        <a class="nav-link" href="{{route('logout')}}" role="button">
                            <i class="ni ni-button-power"></i>
                        </a>
                    </li>

                </ul>

            </div>
        </div>
    </nav>
    <!-- Header -->
    <!-- Header -->
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">{{ "name" }}</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <!-- <a href="#" class="btn btn-sm btn-neutral">New</a>
                        <a href="#" class="btn btn-sm btn-neutral">Filters</a> -->
                    </div>
                </div>
                <!-- Card stats -->
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Fecha</h5>
                                        <span class="h2 font-weight-bold mb-0"><?= date('d/m/y'); ?></span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                            <i class="fas fa-table"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6" id="contenedor">
        <div class="card">
            <div class="card-header bg-transparent">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="text-uppercase text-muted ls-1 mb-1">Ofertas</h6>
                        <h5 class="h3 mb-0">Oferta Publicadas</h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="box box-primary cajaO" style="border-top: 3px solid #3c8dbc; background-color: white; padding-bottom: 10px;">

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

