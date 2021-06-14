<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Agenda Citas</title>
    <link rel="shortcut icon" href="<?php echo constant('URL')?>public/img/logoufps.png" />

    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">


    <link href='<?php echo constant('URL')?>public/css/calender/fullcalendar.min.css' rel='stylesheet' />
    <link rel="stylesheet" type="text/css" href="<?php echo constant('URL')?>public/css/calender/bootstrap-clockpicker.css"/>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <script src='<?php echo constant('URL')?>public/js/calender/moment.min.js'></script>
    <script src='<?php echo constant('URL')?>public/js/calender/jquery.min.js'></script>
    <script src='<?php echo constant('URL')?>public/js/calender/fullcalendar.min.js'></script>
    <script src="<?php echo constant('URL')?>public/js/calender/bootstrap-clockpicker.js"></script>
    <script src='<?php echo constant('URL')?>public/js/calender/es.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>



    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>


    <!-- jQuery and JS bundle w/ Popper.js -->

    <!-- Custom styles for this template -->
    <link href="<?php echo constant('URL')?>public/css/dashboard/dashboard.css" rel="stylesheet">

    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
    <link href="<?php echo constant('URL')?>public/assets/css/style.css" rel="stylesheet">



</head>

<body class="skin-default-dark fixed-layout">
<!-- ============================================================== -->
<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
<div class="preloader">
    <div class="loader">
        <div class="loader__figure"></div>
        <p class="loader__label">Elegant admin</p>
    </div>
</div>

<div id="main-wrapper">
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <header class="topbar">
        <nav class="navbar top-navbar navbar-expand-md navbar-dark" style="background-color: #dd4b39;">
            <!-- ============================================================== -->
            <!-- Logo -->
            <!-- ============================================================== -->
            <div class="navbar-header">
                <a class="navbar-brand" href="../render/ingeniero">
                    <!-- Logo icon --><b>
                        <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                        <!-- Dark Logo icon -->
                        <img src="<?php echo constant('URL')?>public/assets/images/logo.png" class="img-fluid" style="padding: 20px" />
                        <!-- Light Logo icon -->
                    </b>
                    <!--End Logo icon -->
                </a>
            </div>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <div class="navbar-collapse">
                <!-- ============================================================== -->
                <!-- toggle and nav items -->
                <!-- ============================================================== -->
                <ul class="navbar-nav mr-auto">
                </ul>
                <ul class="navbar-nav my-lg-0">
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="../../loginControl/cerrarSesionEstudiante"> <img src="<?php echo constant('URL')?>public/assets/images/Logout.png" alt="user" class="img-fluid" width="30" style="background-color: white; border-radius: 10px;">
                        </a>
                    </li>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                </ul>
            </div>
        </nav>
    </header>

    <aside class="left-sidebar" style="background-color: #dd4b39;">
        <div class="d-flex no-block nav-text-box align-items-center">
            <a class="waves-effect waves-dark ml-auto hidden-sm-down" href="javascript:void(0)"
               style="color: white;"><i class="ti-menu"></i></a>
            <a class="nav-toggler waves-effect waves-dark ml-auto hidden-sm-up" href="javascript:void(0)"><i
                        class="ti-menu ti-close"></i></a>
        </div>
        <!-- Sidebar scroll-->
        <div class="scroll-sidebar">
            <!-- Sidebar navigation-->
            <nav class="sidebar-nav">
                <ul id="sidebarnav">
                    <li> <a class="waves-effect waves-dark" href="<?php echo constant('URL') ?>ingenieroControl/render/ingeniero" aria-expanded="false"
                            style="color: white;"><i class="fa fa-home"></i><span
                                    class="hide-menu">Inicio</span></a></li>
                    <li> <a class="waves-effect waves-dark" href="<?php echo constant('URL') ?>ingenieroControl/render/agendaIng" aria-expanded="false" style="color: white;"><i
                                    class="fa fa-calendar"></i><span class="hide-menu">Cita</span></a></li>
                </ul>
            </nav>
            <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
    </aside>

    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid" style="padding: 20px">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-themecolor" style="margin-top: 8%">CALENDARIO</h4>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- News -->
            <!-- ============================================================== -->
            <div class="row">
                <!-- column -->
                <div class="col-12">
                    <div class="card" style="padding: 20px; border-radius: 7px;-webkit-box-shadow: 3px 3px 5px 0px rgba(0,0,0,0.75);-moz-box-shadow: 3px 3px 5px 0px rgba(0,0,0,0.75);box-shadow: 3px 3px 5px 0px rgba(0,0,0,0.75);">

                        <div class="card-body">
                            <div class="d-flex">
                                <div>
                                    <h5 class="card-title">PENDIENTES</h5>
                                </div>
                            </div>
                        </div>


                        <div class="card-header bg-transparent">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="text-uppercase text-muted ls-1 mb-1">Cita</h6>
                                    <h5 class="h3 mb-0">Agendar Cita</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="CalendarioWeb"></div>
                        </div>



                        <!-- Modal (editar, eliminar)-->
                        <div class="modal fade" id="modalEventos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="tituloEvento"></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div id="descripcionEvento">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col">
                                                        <form>
                                                            <div class="form-group">
                                                                <label for="fecha">Fecha</label>
                                                                <input class="form-control" type="text" name="fecha" id="fecha" disabled>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="titulo">Titulo</label>
                                                                <input class="form-control" type="text" name="titulo" id="titulo" disabled>
                                                            </div>
                                                            <div class="input-group clockpicker contenedor" data-autoclose="true"  style="margin-top: 2%">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                                                </div>
                                                                <button onclick="getHorario()" type="button" class="btn btn-primary form-control" id="hora">Horario Disponibles</button>
                                                            </div>
                                                            <div class="form-group" style="margin-top: 2%">
                                                                <label for="descripcion">Descripcion</label>
                                                                <textarea class="form-control" id="descripcion" rows="2 disabled"></textarea>
                                                            </div>
                                                            <div class="form-group" style="width: 30%;display: none ">
                                                                <label for="color">Color</label>
                                                                <input class="form-control" type="text"  name="color" id="color"  value="#8080ff" disabled>
                                                            </div>
                                                            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none">
                                                                <strong id="contError"></strong>
                                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button onclick="editarCita()" type="button" class="btn btn-success" data-dismiss="modal" id="editar">Editar Horario</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cerrar">Cerrar</button>
                                    </div>
                                </div>
                            </div>

                        </div>


                    </div>
                </div>
            </div>

        </div>


        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- footer -->
    <!-- ============================================================== -->
    <footer class="footer">
        © 2020 Copyright: Universidad Francisco de Paula Santander</a>
    </footer>
    <!-- ============================================================== -->
    <!-- End footer -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Wrapper -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src='<?php echo constant('URL')?>public/js/dashboard/ingeniero.js'></script>
<!-- ============================================================== -->
<!-- Bootstrap popper Core JavaScript -->
<script src="<?php echo constant('URL')?>public/assets/node_modules/popper/popper.min.js"></script>
<script src="<?php echo constant('URL')?>public/assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="<?php echo constant('URL')?>public/assets/js/perfect-scrollbar.jquery.min.js"></script>
<!--Wave Effects -->
<script src="<?php echo constant('URL')?>public/assets/js/waves.js"></script>
<!--Menu sidebar -->
<script src="<?php echo constant('URL')?>public/assets/js/sidebarmenu.js"></script>
<!--Custom JavaScript -->
<script src="<?php echo constant('URL')?>public/assets/js/custom.min.js"></script>
<!-- ============================================================== -->
<!-- This page plugins -->
<!-- ============================================================== -->
<!--morris JavaScript -->
<script src="<?php echo constant('URL')?>public/assets/node_modules/raphael/raphael-min.js"></script>
<script src="<?php echo constant('URL')?>public/assets/node_modules/morrisjs/morris.min.js"></script>
<script src="<?php echo constant('URL')?>public/assets/node_modules/jquery-sparkline/jquery.sparkline.min.js"></script>
<!--c3 JavaScript -->
<script src="<?php echo constant('URL')?>public/assets/node_modules/d3/d3.min.js"></script>
<script src="<?php echo constant('URL')?>public/assets/node_modules/c3-master/c3.min.js"></script>

</body>

</html>

</div>





