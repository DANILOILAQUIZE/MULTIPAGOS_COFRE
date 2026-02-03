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
  include "backend/classes/class.repositorio.php";
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
  $idVista = $paths[$contadorVistas]["idVistas"];
  $seccion = "1";


  if ($vista !== false) {
?>

    <?php if ($tipo_usuario == 1): ?>
      <!-- GERENTE GENERAL -->
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
                  <div class="col-sm-6">
                    <h1 class="m-0">Multipagos Cofre</h1>
                  </div><!-- /.col -->
                  <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="#">Home</a></li>
                      <li class="breadcrumb-item active">Dashboard</li>
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

        <?php elseif ($tipo_usuario == 2): ?>
          <!-- ADMINISTRADORESW -->
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

              <?php include "Cabezera.php"; ?>

              <!-- Content Wrapper. Contains page content -->
              <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                  <div class="container-fluid">
                    <div class="row mb-2">
                      <div class="col-sm-6">
                        <h1 class="m-0">Multipagos Cofre</h1>
                      </div><!-- /.col -->
                      <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="#">Home</a></li>
                          <li class="breadcrumb-item active">Dashboard</li>
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


            <?php elseif ($tipo_usuario == 3): ?>
              <!-- <h1>Trabajadores</h1> -->
              <?php
              $sql_sucursales = "SELECT * FROM sucursales WHERE Estado = '0'";
              $result = $conec->query($sql_sucursales);
              $sql_caja = "SELECT * FROM cajas WHERE Estado = '0'";
              $result_caja = $conec->query($sql_caja);
              $NombreUsuario = $_SESSION['Usuario'];


              ?>
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
                <style>
                  body {
                    margin: 0;
                    padding: 0;
                    background-image: url('img/madera.jpg');
                    /* Reemplaza con la URL o ruta de tu imagen */
                    background-size: cover;
                    /* Hace que la imagen cubra toda la pantalla */
                    background-repeat: no-repeat;
                    background-position: center center;
                    height: 100vh;
                    /* Altura igual al 100% de la pantalla */
                    color: white;
                    /* Color de texto para que se vea encima del fondo */
                    font-family: Arial, sans-serif;
                  }

                  /* Cambia el color del texto del dropdown */
                  .select2-container--classic .select2-results__option {
                    color: black;
                  }

                  /* Cambia el color del texto del campo seleccionado */
                  .select2-container--classic .select2-selection--single .select2-selection__rendered {
                    color: black;
                  }
                </style>

              </head>

              <body>
                <div id="loader_div" class="loader_div"></div>
                <div class="wrapper">


                  <form id="form_ing">
                    <div id="Vista_uno">
                      <div style="text-align: center; font-size: 25px; text-transform: uppercase; background-color: #e74c3c; color: white; padding: 20px; border-radius: 10px; font-weight: bold;"><b>Hola <?= $NombreUsuario ?> a que sucursal y caja deseas ingresar</b></div>
                      <hr><br>
                      <div class="container">
                        <div class="row">
                          <div class="col-sm-6">
                            <div class="card">
                              <div class="card-body">
                                <h5 class="card-title" style="color: #000;">SELECCIONE LA SUCURSAL</h5><br>
                                <hr>
                                <select id="sl_sucursal" class="select2" data-dropdown-css-class="select2-purple" style="width: 100%;" multiple>
                                  <?php while ($fila = $result->fetch_assoc()) { ?>
                                    <option value="<?= $fila['Id'] ?>"><?= $fila['Nombre'] ?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="card">
                              <div class="card-body">
                                <h5 class="card-title" style="color: #000;">SELECCIONE LA CAJA</h5><br>
                                <hr>
                                <select id="sl_caja" class="select2" data-dropdown-css-class="select2-purple" style="width: 100%;" multiple onchange="obtenerValor()">
                                  <?php while ($fila_caja = $result_caja->fetch_assoc()) { ?>
                                    <option value="<?= $fila_caja['Id'] ?>"><?= $fila_caja['Nombre'] ?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!--  -->

                    <div id="Vista_dos" style="display: none;">
                      <input type="hidden" id="idtextosucursal">
                      <div style="text-align: center; font-size: 15px; text-transform: uppercase; background-color: #e74c3c; color: white; padding: 20px; border-radius: 10px; font-weight: bold;"><b>Hola <span style="color: #000; font-size: 20px;"><?= $NombreUsuario ?> </span>te encuentras en <span id="issuc" style="color: #000; font-size: 20px;"></span> en la <span id="iscaja" style="color: #000; font-size: 20px;"></span> y estos son tus usuarios <span id="isusuarios" style="color: #000; font-size: 20px;"></span> </b></div>
                      <hr>

                      <div class="container">

                        <div class="row">
                          <div class="col-sm-12">
                            <div class="card">
                              <div class="card-body">
                                <div style="display: flex; align-items: center; justify-content: space-between;">
                                  <h5 class="card-title" style="color: #000; margin: 0;">
                                    CONTEO DE MONEDAS CIERRE DE CAJA ANTERIOR
                                    <b><span id="idsaldoA" style="font-size: 25px;">0.00</span></b>
                                    CONTEO ACTUAL
                                    <b><span id="idconteo" style="font-size: 25px;">0</span></b>

                                  </h5>

                                  <button type="submit" class="btn btn-success">Guardar Conteo</button>

                                </div>
                              </div>
                            </div>
                          </div>

                        </div>
                        <div class="row">


                          <div class="col-sm-3">
                            <div class="card">
                              <div class="card-body" style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
                                <p class="card-title" style="color: #000; font-weight: bold;">
                                  BILLETE DE 20
                                </p>

                                <div>
                                  <img src="billetes/b_20.jpg" width="100" height="100" class="img-fluid" alt="Billete de 20">
                                </div>
                                <hr>
                                <input type="text" class="form-control moneda" id="b_20" value="0">
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-3">
                            <div class="card">
                              <div class="card-body" style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
                                <p class="card-title" style="color: #000; font-weight: bold;">
                                  BILLETE DE 10
                                </p>

                                <div>
                                  <img src="billetes/b_10.jpg" width="100" height="100" class="img-fluid" alt="Billete de 10">
                                </div>
                                <hr>
                                <input type="text" class="form-control moneda" id="b_10" value="0">
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-3">
                            <div class="card">
                              <div class="card-body" style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
                                <p class="card-title" style="color: #000; font-weight: bold;">
                                  BILLETE DE 5
                                </p>

                                <div>
                                  <img src="billetes/b_5.jpg" width="100" height="100" class="img-fluid" alt="Billete de 5">
                                </div>
                                <hr>
                                <input type="text" class="form-control moneda" id="b_5" value="0">
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-3">
                            <div class="card">
                              <div class="card-body" style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
                                <p class="card-title" style="color: #000; font-weight: bold;">
                                  BILLETE DE 2
                                </p>

                                <div>
                                  <img src="billetes/b_2.jpg" width="100" height="100" class="img-fluid" alt="Billete de 2">
                                </div>
                                <hr>
                                <input type="text" class="form-control moneda" id="b_2" value="0">
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-3">
                            <div class="card">
                              <div class="card-body" style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
                                <p class="card-title" style="color: #000; font-weight: bold;">
                                  BILLETE DE 1
                                </p>

                                <div>
                                  <img src="billetes/b_1.jpg" width="100" height="100" class="img-fluid" alt="Billete de 1">
                                </div>
                                <hr>
                                <input type="text" class="form-control moneda" id="b_1" value="0">
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-3">
                            <div class="card">
                              <div class="card-body" style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
                                <p class="card-title" style="color: #000; font-weight: bold;">
                                  MONEDA DE 1
                                </p>

                                <div>
                                  <img src="billetes/m_1..png" width="100" height="100" class="img-fluid" alt="Moneda de 1">
                                </div>
                                <hr>
                                <input type="text" class="form-control moneda" id="m_1" value="0">
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-3">
                            <div class="card">
                              <div class="card-body" style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
                                <p class="card-title" style="color: #000; font-weight: bold;">
                                  MONEDA DE 0.50
                                </p>

                                <div>
                                  <img src="billetes/m_50.jpg" width="100" height="100" class="img-fluid" alt="Moneda de 60">
                                </div>
                                <hr>
                                <input type="text" class="form-control moneda" id="m_050" value="0">
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-3">
                            <div class="card">
                              <div class="card-body" style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
                                <p class="card-title" style="color: #000; font-weight: bold;">
                                  MONEDA DE 0.25
                                </p>

                                <div>
                                  <img src="billetes/m_025.jpg" width="100" height="100" class="img-fluid" alt="Moneda de 25">
                                </div>
                                <hr>
                                <input type="text" class="form-control moneda" id="m_025" value="0">
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-3">
                            <div class="card">
                              <div class="card-body" style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
                                <p class="card-title" style="color: #000; font-weight: bold;">
                                  MONEDA DE 0.10
                                </p>

                                <div>
                                  <img src="billetes/m_010.jpg" width="100" height="100" class="img-fluid" alt="Moneda de 10">
                                </div>
                                <hr>
                                <input type="text" class="form-control moneda" id="m_010" value="0">
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-3">
                            <div class="card">
                              <div class="card-body" style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
                                <p class="card-title" style="color: #000; font-weight: bold;">
                                  MONEDA DE 0.05
                                </p>

                                <div>
                                  <img src="billetes/m_005.jpg" width="100" height="100" class="img-fluid" alt="Moneda de 5">
                                </div>
                                <hr>
                                <input type="text" class="form-control moneda" id="m_005" value="0">
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-3">
                            <div class="card">
                              <div class="card-body" style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
                                <p class="card-title" style="color: #000; font-weight: bold;">
                                  MONEDA DE 0.01
                                </p>

                                <div>
                                  <img src="billetes/m_001.jpg" width="100" height="100" class="img-fluid" alt="Moneda de 1">
                                </div>
                                <hr>
                                <input type="text" class="form-control moneda" id="m_001" value="0">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>

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
                    $(document).ready(function() { //idTextoCaja

                      $('#sl_sucursal').on('change', function() {
                        var textosSeleccionados = [];
                        var idsSeleccionados = [];

                        $(this).find('option:selected').each(function() {
                          idsSeleccionados.push($(this).val()); // ID
                          textosSeleccionados.push($(this).text()); // Nombre
                        });

                        // Mostrar solo los nombres separados por coma 
                        $('#issuc').html(textosSeleccionados.join(', '));
                        $('#idtextosucursal').val(idsSeleccionados.join(','));

                      });

                      // $("#idTextoCaja").val(ids.join(','));
                      $('#sl_caja').on('change', function() {
                        var ids = $(this).find('option:selected').map(function() {
                          return $(this).val();

                        }).get();

                        // Capturar todos los nombres (texto visible)
                        var nombres = $(this).find('option:selected').map(function() {
                          return $(this).text();
                        }).get();
                        $('#iscaja').html(nombres.join(', '));

                        $.ajax({
                          type: "POST",
                          dataType: "json",
                          url: 'consultas/registro/ajax_usuarios_cajas.php',
                          data: {
                            ids: ids
                          },
                          success: function(data) {
                            for (var i = 0; i < data.length; i++) {
                              $("#isusuarios").text(data[i]["Plataformas"]);
                            }
                          },
                          error: function(jqXHR, exception) {
                            console.log(jqXHR.responseText);
                          },
                        });

                      });

                      //onchange
                      $('#sl_sucursal').on('change', function() {
                        var sucursales = $(this).val(); // Obtiene array de sucursales seleccionadas

                        $.ajax({
                          url: 'consultas/registro/get_cajas.php',
                          type: 'POST',
                          data: {
                            sucursales: sucursales
                          },
                          success: function(data) {
                            console.log(data);
                            $('#sl_caja').html(data); // Inserta nuevas opciones
                            $('#sl_caja').trigger('change'); // Refresca Select2 si estás usándolo
                          }
                        });
                      });





                      $("#form_ing").submit(function(e) {
                        e.preventDefault();
                        Swal.fire({
                          title: "¿Está seguro de guardar el conteo de Monedas?",
                          text: "De guardar el conteo de Monedas!",
                          icon: "warning",
                          html: `
                          <label for="fecha_apertura">Fecha de apertura:</label><br>
                          <input type="date" id="fecha_apertura" class="swal2-input" style="width: 70%; margin-top: 10px;">
                        `,
                          showCancelButton: true,
                          confirmButtonColor: "#3085d6",
                          cancelButtonColor: "#d33",
                          confirmButtonText: "Aceptar!",
                          didOpen: () => {
                            // Asignar fecha actual al input
                            const today = new Date().toISOString().split('T')[0];
                            document.getElementById('fecha_apertura').value = today;
                          },
                          preConfirm: () => {
                            const fecha = document.getElementById('fecha_apertura').value;
                            if (!fecha) {
                              Swal.showValidationMessage('Por favor seleccione una fecha');
                            }
                            return fecha;
                          }
                        }).then((result) => {
                          if (result.isConfirmed) {
                            const fechaApertura = result.value;
                            var b_20 = $("#b_20").val();
                            var b_10 = $("#b_10").val();
                            var b_5 = $("#b_5").val();
                            var b_2 = $("#b_2").val();
                            var b_1 = $("#b_1").val();
                            var m_1 = $("#m_1").val();
                            var m_050 = $("#m_050").val();
                            var m_025 = $("#m_025").val();
                            var m_010 = $("#m_010").val();
                            var m_005 = $("#m_005").val();
                            var m_001 = $("#m_001").val();
                            var idtextosucursal = $("#idtextosucursal").val();
                            var sl_caja = $("#sl_caja").val();
                            $.ajax({
                              type: "POST",
                              dataType: "json",
                              url: 'consultas/registro/apertura/ajax_apertura.php',
                              data: {
                                fechaApertura: fechaApertura,
                                b_20: b_20,
                                b_10: b_10,
                                b_5: b_5,
                                b_2: b_2,
                                b_1: b_1,
                                m_1: m_1,
                                m_050: m_050,
                                m_025: m_025,
                                m_010: m_010,
                                m_005: m_005,
                                m_001: m_001,
                                idtextosucursal: idtextosucursal,
                                sl_caja: sl_caja
                              },
                              success: function(data) {
                                if (data.success) {
                                  Swal.fire({
                                    icon: 'success',
                                    title: data.success,
                                    showConfirmButton: false,
                                    timer: 3000
                                  });
                                  setTimeout(function() {
                                    window.location.href = "trabajadores.php"
                                  }, 2000);
                                } else if (data.su) {
                                  Swal.fire({
                                    icon: 'warning',
                                    title: data.su,
                                    showConfirmButton: false,
                                    timer: 3000
                                  });
                                  setTimeout(function() {
                                    window.location.href = "trabajadores.php"
                                  }, 3000);
                                }
                              },
                              error: function(jqXHR, exception) {
                                console.log(jqXHR.responseText);
                              },
                            });

                          }
                        });
                      });



                      document.getElementById("b_20").addEventListener("input", function() {
                        this.value = this.value.replace(/\D/g, '');
                      });
                      document.getElementById("b_10").addEventListener("input", function() {
                        this.value = this.value.replace(/\D/g, '');
                      });
                      document.getElementById("b_5").addEventListener("input", function() {
                        this.value = this.value.replace(/\D/g, '');
                      });
                      document.getElementById("b_2").addEventListener("input", function() {
                        this.value = this.value.replace(/\D/g, '');
                      });
                      document.getElementById("b_1").addEventListener("input", function() {
                        this.value = this.value.replace(/\D/g, '');
                      });
                      document.getElementById("m_1").addEventListener("input", function() {
                        this.value = this.value.replace(/\D/g, '');
                      });
                      document.getElementById("m_050").addEventListener("input", function() {
                        this.value = this.value.replace(/\D/g, '');
                      });
                      document.getElementById("m_025").addEventListener("input", function() {
                        this.value = this.value.replace(/\D/g, '');
                      });
                      document.getElementById("m_010").addEventListener("input", function() {
                        this.value = this.value.replace(/\D/g, '');
                      });
                      document.getElementById("m_005").addEventListener("input", function() {
                        this.value = this.value.replace(/\D/g, '');
                      });
                      document.getElementById("m_001").addEventListener("input", function() {
                        this.value = this.value.replace(/\D/g, '');
                      });
                      var isChanging = false;
                      if (!$('#sl_sucursal').hasClass('select2-hidden-accessible')) {
                        $('#sl_sucursal').select2({
                          maximumSelectionLength: 1,
                          allowClear: true,
                          width: '100%',
                          theme: "classic"
                        });
                      }
                      if (!$('#sl_caja').hasClass('select2-hidden-accessible')) {
                        $('#sl_caja').select2({
                          maximumSelectionLength: 1,
                          allowClear: true,
                          width: '100%',
                          theme: "classic"
                        });
                      }

                      $('#sl_sucursal').on('change', function() {
                        if (!isChanging) {
                          isChanging = true;
                          if ($('#sl_sucursal').val() === null || $('#sl_sucursal').val().length === 0) {
                            $('#sl_caja').val(null).trigger('change');
                          }
                          isChanging = false;
                        }
                      });

                      $('#sl_caja').on('change', function() {
                        if (!isChanging) {
                          isChanging = true;
                          isChanging = false;
                        }
                      });


                    });

                    function obtenerValor() {
                      var sucursalSeleccionada = $('#sl_sucursal').val();
                      var cajaSeleccionada = $('#sl_caja').val();
                      if (cajaSeleccionada == '') {

                      } else {
                        $.ajax({
                          type: "POST",
                          dataType: "json",
                          url: 'consultas/registro/validar_caja.php',
                          data: {
                            sucursalSeleccionada: sucursalSeleccionada,
                            cajaSeleccionada: cajaSeleccionada
                          },
                          success: function(data) {
                            if (data.su) {
                              Swal.fire({
                                icon: 'warning',
                                title: data.su,
                                showConfirmButton: false,
                                timer: 3000
                              })
                            } else if (data.success) {
                              Swal.fire({
                                icon: 'success',
                                title: data.success,
                                showConfirmButton: false,
                                timer: 3000
                              })
                              $("#Vista_uno").hide();
                              $("#Vista_dos").show();
                            }

                          },
                          error: function(jqXHR, exception) {
                            console.log(jqXHR.responseText);
                          },
                        });
                      }

                    }
                    // FUNCIONES PARA QUE ME SUME LOS IMPUTS
                    const inputs = document.querySelectorAll('.moneda');
                    const totalSpan = document.getElementById('idconteo');

                    const valoresMoneda = {
                      b_20: 20,
                      b_10: 10,
                      b_5: 5,
                      b_2: 2,
                      b_1: 1,
                      m_1: 1,
                      m_050: 0.50,
                      m_025: 0.25,
                      m_010: 0.10,
                      m_005: 0.05,
                      m_001: 0.01
                    };

                    function actualizarSuma() {
                      let suma = 0;

                      inputs.forEach(input => {
                        const id = input.id;
                        const cantidad = parseFloat(input.value);
                        const valorMoneda = valoresMoneda[id] || 0;

                        if (!isNaN(cantidad)) {
                          suma += cantidad * valorMoneda;
                        }
                      });

                      totalSpan.textContent = suma.toFixed(2);
                    }

                    // Validación para evitar avanzar si un campo está vacío
                    inputs.forEach(input => {
                      input.addEventListener('input', actualizarSuma);

                      input.addEventListener('keydown', function(e) {
                        if ((e.key === 'Tab' || e.key === 'Enter') && input.value.trim() === '') {
                          e.preventDefault(); // evita avanzar al siguiente input
                          Swal.fire({
                            icon: 'warning',
                            title: "Por favor no se acepta campos vacios, completa este campo antes de continuar o dejalo en cero.",
                            showConfirmButton: false,
                            timer: 4000
                          });
                          input.focus(); // vuelve el foco al input actual
                        }
                      });
                    });

                    // Inicializar suma al cargar
                    actualizarSuma();

                    // Al cargar la página
                    window.addEventListener('DOMContentLoaded', function() {
                      // Obtener fecha actual en formato YYYY-MM-DD
                      const today = new Date().toISOString().split('T')[0];
                      // Establecer valor al input
                      document.getElementById('fecha_apertura').value = today;
                    });
                  </script>

                <?php elseif ($tipo_usuario == 4): ?>

                  <!-- SUPERVISORES  -->
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
                              <div class="col-sm-6">
                                <h1 class="m-0">Multipagos Cofre</h1>
                              </div><!-- /.col -->
                              <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                                  <li class="breadcrumb-item active">SUPERVISOR</li>
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
                header("location:/error.php");
              }
            } else {
              header("location:/index.php");
            }
                ?>
