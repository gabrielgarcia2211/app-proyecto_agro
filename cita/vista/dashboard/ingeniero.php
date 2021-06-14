<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
          content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 4 admin, bootstrap 4, css3 dashboard, bootstrap 4 dashboard, AdminWrap lite admin bootstrap 4 dashboard, frontend, responsive bootstrap 4 admin template, Elegant admin lite design, Elegant admin lite dashboard bootstrap 4 dashboard template">
    <meta name="description"
          content="Elegant Admin Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
    <title>Agendar Citas</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/elegant-admin-lite/" />
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo constant('URL')?>public/assets/images/logoufps.png">
    <!-- This page CSS -->
    <!-- chartist CSS -->
    <link href="<?php echo constant('URL')?>public/assets/node_modules/morrisjs/morris.css" rel="stylesheet">
    <!--c3 plugins CSS -->
    <link href="<?php echo constant('URL')?>public/assets/node_modules/c3-master/c3.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo constant('URL')?>public/assets/css/style.css" rel="stylesheet">
    <!-- Dashboard 1 Page CSS -->
    <link href="<?php echo constant('URL')?>public/assets/css/pages/dashboard1.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
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
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
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
    <!-- ============================================================== -->
    <!-- End Topbar header -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
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
    <!-- ============================================================== -->
    <!-- End Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-themecolor" style="margin-top: 5%">CALENDARIO</h4>
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
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col" style="background-color: #3581B8;">Titulo</th>
                                    <th scope="col" style="background-color: #3581B8;">Descripcion</th>
                                    <th scope="col" style="background-color: #3581B8;">Comienzo</th>
                                    <th scope="col" style="background-color: #3581B8;">Fin</th>
                                    <th scope="col" style="background-color: #3581B8;">Codigo Estudiante</th>
                                    <th scope="col" style="background-color: #3581B8;">Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php for ($m = 0; $m < count($this->list); $m++) : ?>
                                    <tr>
                                        <?php $NuevaFecha = strtotime('2 hour', strtotime($this->list[$m]['start']));?>
                                        <?php $NuevaFecha =  date ( 'Y-m-d H:i:s' , $NuevaFecha);?>
                                        <th scope="row"><?php echo $this->list[$m]['title'];?></th>
                                        <td><?php echo $this->list[$m]['descripcion'];?></td>
                                        <td><?php echo $this->list[$m]['start'];?></td>
                                        <td><?php echo $NuevaFecha;?></td>
                                        <td><?php echo $this->list[$m]['codigo'];?></td>
                                        <td>
                                            <button onclick="return eliminarCita('<?php echo $this->list[$m]['id'];?>')" class="btn btn-danger">Cancelar</button>
                                        </td>
                                    </tr>
                                <?php endfor; ?>
                                </tbody>
                            </table>
                            <button onclick="viewAgenda()" type="button" class="btn btn-info" style="margin-top: 2%">Ver Citas</button></a>
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
<!-- ============================================================== -->
<!-- ============================================================== -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src='<?php echo constant('URL')?>public/js/dashboard/ingeniero.js'></script>
<!-- ============================================================== -->
<script src="<?php echo constant('URL')?>public/assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
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
<!-- Chart JS -->
<script src="<?php echo constant('URL')?>public/assets/js/dashboard1.js"></script>
</body>

</html>