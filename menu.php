<?php // 

?>

<!DOCTYPE html>
<html lang="es">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>ESCRITORIO PRETEC</title>
        <!-- plugins:css -->
        <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
        <link rel="stylesheet" href="vendors/base/vendor.bundle.base.css">
        <link rel="stylesheet" href="css/alertify/alertify.min.css">
        <!-- endinject -->
        <!-- plugin css for this page -->
        <!-- End plugin css for this page -->
        <!-- inject:css -->
        <link rel="stylesheet" href="css/style.css">
        <!-- endinject -->
        <link rel="shortcut icon" href="images/favicon.png" />
    </head>
    <body>
        <div class="container-scroller">
            <!-- partial:partials/_navbar.html -->
            <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
                <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                    <a class="navbar-brand brand-logo mr-5" href="index.html">PRETEC</a>
                    <a class="navbar-brand brand-logo-mini" href="index.html"><img src="images/logo-mini.svg" alt="logo"/></a>
                </div>
                <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                        <span class="ti-view-list"></span>
                    </button>

                    <ul class="navbar-nav navbar-nav-right">
                        <li class="nav-item dropdown mr-1">
                            <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center" id="messageDropdown" href="#" data-toggle="dropdown">
                                <i class="ti-email mx-0"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="messageDropdown">
                                <p class="mb-0 font-weight-normal float-left dropdown-header">Messages</p>
                                <a class="dropdown-item">
                                    <div class="item-thumbnail">
                                        <img src="images/faces/face4.jpg" alt="image" class="profile-pic">
                                    </div>
                                    <div class="item-content flex-grow">
                                        <h6 class="ellipsis font-weight-normal">David Grey
                                        </h6>
                                        <p class="font-weight-light small-text text-muted mb-0">
                                            The meeting is cancelled
                                        </p>
                                    </div>
                                </a>
                                <a class="dropdown-item">
                                    <div class="item-thumbnail">
                                        <img src="images/faces/face2.jpg" alt="image" class="profile-pic">
                                    </div>
                                    <div class="item-content flex-grow">
                                        <h6 class="ellipsis font-weight-normal">Tim Cook
                                        </h6>
                                        <p class="font-weight-light small-text text-muted mb-0">
                                            New product launch
                                        </p>
                                    </div>
                                </a>
                                <a class="dropdown-item">
                                    <div class="item-thumbnail">
                                        <img src="images/faces/face3.jpg" alt="image" class="profile-pic">
                                    </div>
                                    <div class="item-content flex-grow">
                                        <h6 class="ellipsis font-weight-normal"> Johnson
                                        </h6>
                                        <p class="font-weight-light small-text text-muted mb-0">
                                            Upcoming board meeting
                                        </p>
                                    </div>
                                </a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                                <i class="ti-bell mx-0"></i>
                                <span class="count"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="notificationDropdown">
                                <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
                                <a class="dropdown-item">
                                    <div class="item-thumbnail">
                                        <div class="item-icon bg-success">
                                            <i class="ti-info-alt mx-0"></i>
                                        </div>
                                    </div>
                                    <div class="item-content">
                                        <h6 class="font-weight-normal">Application Error</h6>
                                        <p class="font-weight-light small-text mb-0 text-muted">
                                            Just now
                                        </p>
                                    </div>
                                </a>
                                <a class="dropdown-item">
                                    <div class="item-thumbnail">
                                        <div class="item-icon bg-warning">
                                            <i class="ti-settings mx-0"></i>
                                        </div>
                                    </div>
                                    <div class="item-content">
                                        <h6 class="font-weight-normal">Settings</h6>
                                        <p class="font-weight-light small-text mb-0 text-muted">
                                            Private message
                                        </p>
                                    </div>
                                </a>
                                <a class="dropdown-item">
                                    <div class="item-thumbnail">
                                        <div class="item-icon bg-info">
                                            <i class="ti-user mx-0"></i>
                                        </div>
                                    </div>
                                    <div class="item-content">
                                        <h6 class="font-weight-normal">New user registration</h6>
                                        <p class="font-weight-light small-text mb-0 text-muted">
                                            2 days ago
                                        </p>
                                    </div>
                                </a>
                            </div>
                        </li>
                        <li class="nav-item nav-profile dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                                <img src="images/faces/face28.jpg" alt="profile"/>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                                <a class="dropdown-item">
                                    <i class="ti-settings text-primary"></i>
                                    Configuraciones
                                </a>
                                <a class="dropdown-item" href="controladores/cerrarSesion.php">
                                    <i class="ti-power-off text-primary"></i>
                                    Cerrar session
                                </a>
                            </div>
                        </li>
                    </ul>
                    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                        <span class="ti-view-list"></span>
                    </button>
                </div>
            </nav>
            <!-- partial -->
            <div class="container-fluid page-body-wrapper">
                <!-- partial:partials/_sidebar.html -->

                <nav class="sidebar sidebar-offcanvas" id="sidebar">

                    <ul class="nav">
                        <li style="text-align: center;"> 
                            <div class="title"><?php echo $usuario_activo->getNombre(); ?></div>
                            <div class="title"><?php echo $usuario_activo->getNombre_sucursal(); ?></div>
                            <div class="title"><?php echo $usuario_activo->getRol(); ?></div>
                        </li>
                        <!--                                 <li class="nav-item">
                                                            <a class="nav-link" href="index.html">
                                                              <i class="ti-shield menu-icon"></i>
                                                              <span class="menu-title">Es</span>
                                                            </a>
                                                          </li>-->

                        <?php
                        if ($usuario_activo->getRol() == 'ADMINISTRADOR') {
                            ?>

                            <li class="nav-item">
                                <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                                    <i class="ti-settings menu-icon"></i>
                                    <span class="menu-title">Referenciales</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="collapse" id="ui-basic">

                                    <ul class="nav flex-column sub-menu">
                                        <span class="menu-title">Personales</span>
                                        <li class="nav-item"> <a class="nav-link" href="#" onclick="mostrarPersonal(); return false;" >Datos personales</a></li>
                                        <li class="nav-item"> <a class="nav-link" href="#" onclick="mostrarEmpleado(); return false;">Empleado</a></li>
                                        <span class="menu-title">Sectores</span>
                                        <li class="nav-item" > <a class="nav-link" href="#" onclick="mostrarDepartamento(); return false;">Departamento</a></li>
                                        <li class="nav-item"> <a class="nav-link" href="#" onclick="mostrarCargo()">Cargo</a></li>
                                        <li class="nav-item"> <a class="nav-link" href="#" onclick="mostrarSucursal(); return false;">Sucursal</a></li>
                                        <span class="menu-title">Adicionales</span>
                                        <li class="nav-item"> <a class="nav-link" href="#" onclick="mostrarMotivoSancion(); return false;">Motivo Sanción</a></li>
                                        
                                        <li class="nav-item"> <a class="nav-link" href="#" onclick="mostrarJustificacionPermiso(); return false;">Motivo Permiso</a></li>
                                        <li class="nav-item"> <a class="nav-link" href="#" onclick="mostrarMotivoDescuento(); return false;">Motivo Descuento</a></li>
                                        <li class="nav-item"> <a class="nav-link" href="#" onclick="mostrarConcepto(); return false;">Concepto</a></li>
                                    </ul>
                                </div>
                            </li>
                            <?php
                        }
                        ?>
                        <?php
                        if ($usuario_activo->getRol() == 'RECURSOS HUMANOS' ||
                                $usuario_activo->getRol() == 'ADMINISTRADOR') {
                            ?>

                            <li class="nav-item">
                                <a class="nav-link" data-toggle="collapse" href="#ui-basic2" aria-expanded="false" aria-controls="ui-basic2">
                                    <i class="ti-user menu-icon"></i>
                                    <span class="menu-title">Personal</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="collapse" id="ui-basic2">

                                    <ul class="nav flex-column sub-menu">

                                        <li class="nav-item"> <a class="nav-link" href="#" onclick="mostrarPerfil(); return false;">Perfil de cargo</a></li>
                                        <li class="nav-item"> <a class="nav-link" href="#" onclick="mostrarCurriculum(); return false;">Curriculum</a></li>
                                        
                                        <li class="nav-item"> <a class="nav-link" href="#" onclick="mostrarContrato(); return false;" >Contrato</a></li>
                                        <li class="nav-item"> <a class="nav-link" href="#" onclick="mostrarAsistencia(); return false;" >Asistencia</a></li>
                                        <li class="nav-item"> <a class="nav-link" href="#" onclick="mostrarDesvinculacion(); return false;" >Desvinculación</a></li>

                                    </ul>
                                </div>
                            </li>

                            <?php
                        }
                        ?>


                        <?php
                        if ($usuario_activo->getRol() == 'RECURSOS HUMANOS' ||
                                $usuario_activo->getRol() == 'ADMINISTRADOR') {
                            ?>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="collapse" href="#ui-basic3" aria-expanded="false" aria-controls="ui-basic3">
                                    <i class="ti-alert menu-icon"></i>
                                    <span class="menu-title">Permisos y descuentos</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="collapse" id="ui-basic3">

                                    <ul class="nav flex-column sub-menu">

                                        <li class="nav-item"> <a class="nav-link" href="#" onclick="mostrarPermiso(); return false;">Permisos</a></li>
                                        <li class="nav-item"> <a class="nav-link" href="#" onclick="mostrarSancion(); return false;">Sanciones</a></li>
                                        <li class="nav-item"> <a class="nav-link" href="#" onclick="mostrarDescuento(); return false;">Descuento</a></li>
                                        <li class="nav-item"> <a class="nav-link" href="#" onclick="mostrarBonificacion(); return false;">Bonificación Familiar</a></li>
                                        <li class="nav-item"> <a class="nav-link" href="#" onclick="mostrarIngresos(); return false;">Ingresos Extras</a></li>
                                        <li class="nav-item"> <a class="nav-link" href="#" onclick="mostrarVacaciones(); return false;">Vacaciones</a></li>

                                    </ul>
                                </div>
                            </li>
                            <?php
                        }
                        ?>

                        <?php
                        if ($usuario_activo->getRol() == 'INFORMES' ||
                                $usuario_activo->getRol() == 'ADMINISTRADOR' ||
                                $usuario_activo->getRol() == 'RECURSOS HUMANOS') {
                            ?>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="collapse" href="#ui-basic4" aria-expanded="false" aria-controls="ui-basic4">
                                    <i class="ti-agenda menu-icon"></i>
                                    <span class="menu-title">Planillas</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="collapse" id="ui-basic4">

                                    <ul class="nav flex-column sub-menu">

                                        <li class="nav-item"> <a class="nav-link" href="#" onclick="mostrarIPS(); return false;">Planilla IPS</a></li>
                                        <li class="nav-item"> <a class="nav-link" href="#" onclick="mostrarMinisterio(); return false;">Planilla Min. Jus. y Trabajo</a></li>
                                        <li class="nav-item"> <a class="nav-link" href="#" onclick="mostrarSalario(); return false;">Liquidación de salario</a></li>
                                        <li class="nav-item"> <a class="nav-link" href="#" onclick="mostrarAguinaldo(); return false;">Aguinaldos</a></li>

                                    </ul>
                                </div>
                            </li>

                            <?php
                        }
                        ?>
                        <?php
                        if ($usuario_activo->getRol() == 'INFORMES' ||
                                $usuario_activo->getRol() == 'ADMINISTRADOR') {
                            ?>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="collapse" href="#ui-basic5" aria-expanded="false" aria-controls="ui-basic5">
                                    <i class="ti-info menu-icon"></i>
                                    <span class="menu-title">Informes</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="collapse" id="ui-basic5">

                                    <ul class="nav flex-column sub-menu">

                                        <li class="nav-item"> <a class="nav-link" href="#" onclick="mostrarInformesReferenciales(); return false;">Referenciales</a></li>
                                        <li class="nav-item"> <a class="nav-link" href="#" onclick="mostrarInformesMovimiento(); return false;">Movimiento de RRHH</a></li>


                                    </ul>
                                </div>
                            </li>
                            <?php
                        }
                        ?>


                    </ul>
                </nav>
                <!-- partial -->
                <div class="main-panel">
                    <div class="content-wrapper" id="contenido-page">

                    </div>
                    <!-- content-wrapper ends -->
                    <!-- partial:partials/_footer.html -->
                    <footer class="footer">
                        <div class="d-sm-flex justify-content-center justify-content-sm-between">
                            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © Pretec</span>

                        </div>
                    </footer>
                    <!-- partial -->
                </div>
                <!-- main-panel ends -->
            </div>
            <!-- page-body-wrapper ends -->
        </div>
        <!-- container-scroller -->

        <!-- plugins:js -->
        <script src="vendors/base/vendor.bundle.base.js"></script>
        <!-- endinject -->
        <!-- Plugin js for this page-->
        <script src="vendors/chart.js/Chart.min.js"></script>
        <!-- End plugin js for this page-->
        <!-- inject:js -->
        <script src="js/off-canvas.js"></script>
        <script src="js/hoverable-collapse.js"></script>
        <script src="js/template.js"></script>
        <script src="js/todolist.js"></script>
        <script src="js/alertify/alertify.min.js"></script>
        <!-- endinject -->
        <!-- Custom js for this page-->
        <script src="js/dashboard.js"></script>
        <script src="vistas/util.js"></script>
        <script src="vistas/departamento.js"></script>
        <script src="vistas/personal.js"></script>
        <script src="vistas/cargo.js"></script>
        <script src="vistas/sucursal.js"></script>
        <script src="vistas/motivoSancion.js"></script>
        <script src="vistas/justificacion_permiso.js"></script>
        <script src="vistas/impresion_referenciales.js"></script>
        <script src="vistas/informes.js"></script>
        <script src="vistas/curriculum.js"></script>
        <script src="vistas/empeado.js"></script>
        <script src="vistas/contrato.js"></script>
        <script src="vistas/asistencia.js"></script>
        <script src="vistas/permiso.js"></script>
        <script src="vistas/sancion.js"></script>
        <script src="vistas/motivo_descuento.js"></script>
        <script src="vistas/descuento.js"></script>
        <script src="vistas/ips.js"></script>
        <script src="vistas/ministerio.js"></script>
        <script src="vistas/salario.js"></script>
        <script src="vistas/aguinaldo.js"></script>
        <script src="vistas/bonificacion.js"></script>
        <script src="vistas/concepto.js"></script>
        <script src="vistas/ingresos.js"></script>
        <script src="vistas/vacaciones.js"></script>
        <script src="vistas/moment.js"></script>
        <script src="vistas/desvinculacion.js"></script>
        <script src="vistas/perfil.js"></script>

        <!-- End custom js for this page-->
    </body>

</html>

