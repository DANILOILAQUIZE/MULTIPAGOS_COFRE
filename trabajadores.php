<?php
session_start();
$CodIdUsu = $_SESSION['idUsuario'];
if (isset($_SESSION['idUsuario'])) {
    $path_so = "";
    $projectName = $_SESSION["projectName"];
    $pathRaiz = $_SESSION["pathRaiz"];
    $favicon = "/" . $projectName . "favicon.ico";
    $path_so = $pathRaiz . $projectName . "Cabezera.php";
    $pathCompleto = $pathRaiz . $projectName;
    include "../../backend/classes/class.repositorio.php";
    $repositorio = new Repositorio;
    $conec = $repositorio->connectDB();
    $idUser = $_SESSION['idUsuario'];
    $link = $_SERVER["REQUEST_URI"];
    $paths = $_SESSION['paths'];
    $tipo_usuario = $_SESSION['type'];

    $vista = false;
    $contadorVistas = 0;
    $contadorVistasAux = 0;

    for ($contadorVistas = 0; $contadorVistas < count($paths); $contadorVistas++) {
        $vista = strpos($link, $paths[$contadorVistas]["pathVista"]);
        if ($vista !== false) {
            $vista = true;
            $contadorVistasAux = $contadorVistas;
            break;
        }
    }
    $idUsuario = $_SESSION['idUsuario'];
    $seccion = "1";

    $sql_usuario = "SELECT
    g.Usuario AS Usuario,
    s.Nombre AS Sucursal,
    ca.Nombre AS Caja,
    c.B_100,
    c.B_100 * 100 AS Total_B100,
    c.B_50,
    c.B_50 * 50 AS Total_B50,
    c.B_20,
    c.B_20 * 20 AS Total_B20,
    c.B_10,
    c.B_10 * 10 AS Total_B10,
    c.B_5,
    c.B_5 * 5 AS Total_B5,
    c.B_2,
    c.B_2 * 2 AS Total_B2,
    c.B_1,
    c.B_1 * 1 AS Total_B1,
    c.M_1,
    c.M_1 * 1 AS Total_M_1,
    c.M_050,
    c.M_050 * 0.50 AS Total_M050,
    c.M_025,
    c.M_025 * 0.25 AS Total_M025,
    c.M_010,
    c.M_010 * 0.10 AS Total_M010,
    c.M_005,
    c.M_005 * 0.05 AS Total_M005,
    c.M_001,
    c.M_001 * 0.01 AS Total_M001,
    (
        c.B_100 * 100 + c.B_50 * 50 + c.B_20 * 20 + c.B_10 * 10 + c.B_5 * 5 + c.B_2 * 2 + c.B_1 * 1 + c.M_1 * 1 + c.M_050 * 0.50 + c.M_025 * 0.25 + c.M_010 * 0.10 + c.M_005 * 0.05 + c.M_001 * 0.01
    ) AS Total_general
FROM
    conteo_monedas c
INNER JOIN gen_usuarios g ON
    c.IdUsuario = g.Cod_usuario
INNER JOIN sucursales s ON
    c.IdSucursal = s.Id
INNER JOIN cajas ca ON
    c.IdCaja = ca.Id
WHERE
    c.IdUsuario = '$idUser' AND Estado_caja = '0'";
    $result =  $conec->query($sql_usuario);
    while ($fila = mysqli_fetch_array($result)) {
        $usuario = $fila['Usuario'];
        $sucursal = $fila['Sucursal'];
        $Caja = $fila['Caja'];
        $Total_general = $fila['Total_general'];
    }


?>
    <?php
    if ($tipo_usuario == 3): ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="icon" type="image/png" href="img/multipagos.jpg" />
            <title>Menu Principal | Dashboard </title>

            <!-- Google Font: Source Sans Pro -->
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
            <!-- Font Awesome Icons -->
            <link rel="stylesheet" href="frontend/plugins/fontawesome-free/css/all.min.css">
            <!-- overlayScrollbars -->
            <link rel="stylesheet" href="frontend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
            <!-- Theme style -->
            <link rel="stylesheet" href="frontend/dist/css/adminlte.min.css">

            <!-- DataTables -->
            <link rel="stylesheet" href="frontend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
            <link rel="stylesheet" href="frontend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
            <link rel="stylesheet" href="frontend/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
            <link rel="stylesheet" href="frontend/plugins/datatables-fixedcolumns/css/fixedColumns.bootstrap4.min.css">

            <link rel="stylesheet" href="frontend/plugins/select2/css/select2.min.css">
            <link rel="stylesheet" href="frontend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">


        </head>

        <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
            <div id="loader_div" class="loader_div"></div>
            <div class="wrapper">

                <?php include $path_so; ?>

                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <div class="content-header">
                        <div class="container-fluid">
                            <div class="row mb-2">
                                <div class="col-sm-4">
                                    <h1 class="m-0">Multipagos Cofre</h1>
                                </div><!-- /.col -->
                                <div class="col-sm-8">
                                    <ol class="breadcrumb float-sm-right">
                                        <li class="breadcrumb-item active" style="font-size: 25px;"><b>Usuario : </b> <?=$usuario?>  - <?=$sucursal?> - <?=$Caja?> saldo actual <b><?=$Total_general?></b></li>
                                    </ol>
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                        </div><!-- /.container-fluid -->
                    </div>
                    <!-- /.content-header -->

                    <!-- Main content -->
                    <section class="content">
                        <div class="container-fluid">
                            <!-- Info boxes -->
                            <div class="row">

                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="info-box mb-3">
                                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text">Trabajadores Registrados</span>
                                            <span class="info-box-number" id="Num_trabajador"></span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>



                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="info-box">
                                        <button class="info-box-icon btn btn-info" data-toggle="modal" data-target="#modalVentas"><i class="fas fa-wallet"></i></button>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Reporte Vendedores</span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>



                                <!-- /.col -->
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="info-box mb-3">
                                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text"><a href="consultas/informe_procesos.php">Procesos vs Vendidos</a></span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <!-- /.col -->

                                <!-- fix for small devices only -->
                                <div class="clearfix hidden-md-up"></div>

                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="info-box mb-3">
                                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text"><a href="consultas/informe_afecciones.php">Afecciones Nacional</a></span>

                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <!-- /.col -->

                                <!-- /.col -->
                            </div>
                            <!-- /.row -->


                            <!-- /.row -->
                        </div>
                        <!--/. container-fluid -->
                    </section>
                    <!-- /.content -->
                </div>
                <!-- /.content-wrapper -->


                <!-- Control Sidebar -->
                <aside class="control-sidebar control-sidebar-dark">
                    <!-- Control sidebar content goes here -->
                </aside>
                <!-- /.control-sidebar -->

                <!-- Main Footer -->

                <!-- ./wrapper -->

                <!-- REQUIRED SCRIPTS -->
                <!-- jQuery -->
                <script src="frontend/plugins/jquery/jquery.min.js"></script>
                <!-- Bootstrap -->
                <script src="frontend/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

                <!-- overlayScrollbars -->
                <script src="frontend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
                <!-- AdminLTE App -->
                <script src="frontend/dist/js/adminlte.js"></script>

                <script src="frontend/plugins/select2/js/select2.full.min.js"></script>
                <!-- PAGE PLUGINS -->
                <!-- jQuery Mapael -->
                <script src="frontend/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
                <script src="frontend/plugins/raphael/raphael.min.js"></script>
                <script src="frontend/plugins/jquery-mapael/jquery.mapael.min.js"></script>
                <script src="frontend/plugins/jquery-mapael/maps/usa_states.min.js"></script>
                <!-- ChartJS -->
                <script src="frontend/plugins/chart.js/Chart.min.js"></script>

                <!-- DataTables  & Plugins -->
                <script src="frontend/plugins/datatables/jquery.dataTables.min.js"></script>
                <script src="frontend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
                <script src="frontend/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
                <script src="frontend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
                <script src="frontend/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
                <script src="frontend/plugins/datatables-fixedcolumns/js/dataTables.fixedColumns.min.js"></script>
                <script src="frontend/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
                <script src="frontend/plugins/jszip/jszip.min.js"></script>
                <script src="frontend/plugins/pdfmake/pdfmake.min.js"></script>
                <script src="frontend/plugins/pdfmake/vfs_fonts.js"></script>
                <script src="frontend/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
                <script src="frontend/plugins/datatables-buttons/js/buttons.print.min.js"></script>
                <script src="frontend/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>


                <script src="https://code.highcharts.com/highcharts.js"></script>
                <script src="https://code.highcharts.com/highcharts-more.js"></script>
                <script src="https://code.highcharts.com/modules/solid-gauge.js"></script>
                <script src="https://code.highcharts.com/modules/exporting.js"></script>
                <script src="https://code.highcharts.com/modules/export-data.js"></script>
                <script src="https://code.highcharts.com/modules/accessibility.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



                <script src="consultas/Gauge.js"></script>

                <!-- AdminLTE for demo purposes -->
                <script src="frontend/dist/js/demo.js"></script>
                <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
                <script src="frontend/dist/js/pages/dashboard2.js"></script>

                <script>
                    listar_trabajdores();

                    function listar_trabajdores() {
                        $.ajax({
                            type: "POST",
                            dataType: "json",
                            url: 'consultas/registro/ajax_listar_trabajadores.php',
                            data: {},
                            success: function(data) {
                                for (var i = 0; i < data.length; i++) {
                                    $("#Num_trabajador").text("Registrados : " + data[i]["Total_usuarios"]);
                                }
                            },
                            error: function(jqXHR, exception) {
                                console.log(jqXHR.responseText);
                            },
                        });
                    }
                </script>


            <?php endif; ?>



        <?php


    } else {
        header("location:/index.php");
    }
        ?>
