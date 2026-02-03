<?php
session_start();
if (isset($_SESSION['idUsuario'])) {
    $path_so = "";
    $projectName = $_SESSION["projectName"];
    $pathRaiz = $_SESSION["pathRaiz"];
    $path_so = "../../Cabezera.php";
    $pathCompleto = $pathRaiz . $projectName;
    include "../../backend/classes/class.repositorio.php";
    $repositorio = new Repositorio;
    $conec = $repositorio->connectDB();
    $idUser = $_SESSION['idUsuario'];
    $link = $_SERVER["REQUEST_URI"];
    $paths = $_SESSION['paths'];
    //var_dump($paths);
    $vista = false;
    $contadorVistas = 0;
    $contadorVistasAux = 0;
    $footer = $pathCompleto . "frontend/aMenus/footer.php";
    for ($contadorVistas = 0; $contadorVistas < count($paths); $contadorVistas++) {
        $vista = strpos($link, $paths[$contadorVistas]["pathVista"]);
        if ($vista !== false) {
            $vista = true;
            $pathActual = $paths[$contadorVistas]["pathVista"];
            $tituloActual = $paths[$contadorVistas]["vistasIdVistas"];
            $contadorVistasAux = $contadorVistas;
            break;
        }
    }
    if ($vista !== false) {

        $sql_sucursales = "SELECT * FROM sucursales WHERE Estado = '0'";
        $result = $conec->query($sql_sucursales);

        $NombreUsuario = $_SESSION['Usuario'];
        $Typeusuario = $_SESSION['type'];



        // Lista para recibidos
        $sql_recibido = "SELECT MIN(Id) AS Id, Nombre_plataforma FROM plataforma_usuario WHERE Estado = '0' GROUP BY Nombre_plataforma ORDER BY `Id` ASC";
        $resultresibido = $conec->query($sql_recibido);

        $sql_recibido1 = "SELECT MIN(Id) AS Id, Nombre_plataforma FROM plataforma_usuario WHERE Estado = '0' GROUP BY Nombre_plataforma ORDER BY `Id` ASC";
        $resultresibido1 = $conec->query($sql_recibido1);

        $sql_recibido_E = "SELECT MIN(Id) AS Id, Nombre_plataforma FROM plataforma_usuario WHERE Estado = '0' GROUP BY Nombre_plataforma ORDER BY `Id` ASC ";
        $resultresibido_E = $conec->query($sql_recibido_E);

        $sql_recibido_E1 = "SELECT MIN(Id) AS Id, Nombre_plataforma FROM plataforma_usuario WHERE Estado = '0' GROUP BY Nombre_plataforma ORDER BY `Id` ASC ";
        $resultresibido_E1 = $conec->query($sql_recibido_E1);

        $sql_Gasto = "SELECT Id,Nombre FROM concepto_gasto WHERE Estado = '0' ";
        $resulgasto = $conec->query($sql_Gasto);

        $sql_Gasto1 = "SELECT Id,Nombre FROM concepto_gasto WHERE Estado = '0' ";
        $resulgasto1 = $conec->query($sql_Gasto1);

        $sql_Gasto_E = "SELECT Id,Nombre FROM concepto_gasto WHERE Estado = '0' ";
        $resulgasto_E = $conec->query($sql_Gasto_E);

        $sql_Gasto_E1 = "SELECT Id,Nombre FROM concepto_gasto WHERE Estado = '0' ";
        $resulgasto_E1 = $conec->query($sql_Gasto_E1);






?>

        <!DOCTYPE html>
        <html lang="es">

        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="icon" type="image/png" href="../../img/multipagos.jpg" />
            <title>Depositos - Tranferencia en Banco</title>

            <!-- Google Font: Source Sans Pro -->
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
            <!-- Font Awesome -->
            <link rel="stylesheet" href="../../frontend/plugins/fontawesome-free/css/all.min.css">
            <!-- DataTables -->
            <link rel="stylesheet" href="../../frontend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
            <link rel="stylesheet" href="../../frontend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
            <link rel="stylesheet" href="../../frontend/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
            <!-- overlayScrollbars -->
            <link rel="stylesheet" href="../../frontend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
            <!-- Theme style -->
            <link rel="stylesheet" href="../../frontend/dist/css/adminlte.min.css">
            <!-- select2 -->
            <link rel="stylesheet" href="../../frontend/plugins/select2/css/select2.min.css">
            <link rel="stylesheet" href="../../frontend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
            <link rel="stylesheet" href="../../css/loader_div.css">
        </head>

        <body class="hold-transition sidebar-collapse sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
            <div class="wrapper">
                <div id="loader_div" style="display: none;">
                    <div class="rueda">
                        <img src="../../img/multipagos.jpg" alt="Logo">
                    </div>
                    <div class="cargando">Cargando...</div>
                </div>
                <?php include $path_so; ?>

                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <section class="content-header">
                        <div class="container-fluid">
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <h1>DETALLE DE PAGO / GASTOS / SALIDAS</h1>
                                </div>
                                <div class="col-sm-6">
                                    <ol class="breadcrumb float-sm-right">
                                        <li class="breadcrumb-item active">
                                            <p style="font-size: 25px;"><b>USUARIO :</b> <?= strtoupper($NombreUsuario) ?></p>
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div><!-- /.container-fluid -->
                    </section>
                    <!-- /.modal -->
                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="col-12">
                                                <div id="recibidas">
                                                    <br>
                                                    <label style="display: block; text-align: center; font-size: 25px;">DETALLE DE PAGO / GASTOS / SALIDAS</label>
                                                    <br>
                                                    <?php
                                                    if ($Typeusuario != 4) {
                                                    ?>
                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_recibido">
                                                            <i class="fa fa-book"></i> Nuevo Ingreso
                                                        </button>
                                                        <hr>
                                                        <table class="table table-bordered table-hover" id="tbl_lista_recibido" style="width: 100%;" cellspacing="0">
                                                            <thead>
                                                                <tr>
                                                                    <th>Valor</th>
                                                                    <th>Descripcion</th>
                                                                    <th>Concepto Gasto</th>
                                                                    <th>N.- Cuenta</th>
                                                                    <th>N.- Comprobante</th>
                                                                    <th>Usuario</th>
                                                                    <th>Estado</th>
                                                                    <th>Tipo Ingreso</th>
                                                                    <th>Opciones</th>
                                                                </tr>
                                                            </thead>

                                                        </table>
                                                    <?php
                                                    } else {
                                                    ?>

                                                        <table class="table table-bordered table-hover" id="tbl_lista_recibido" style="width: 100%;" cellspacing="0">
                                                            <thead>
                                                                <tr>
                                                                    <th>Valor</th>
                                                                    <th>Descripcion</th>
                                                                    <th>Concepto Gasto</th>
                                                                    <th>N.- Cuenta</th>
                                                                    <th>N.- Comprobante</th>
                                                                    <th>Usuario</th>
                                                                    <th>Estado</th>
                                                                    <th>Tipo Ingreso</th>
                                                                    <th>Opciones</th>
                                                                </tr>
                                                            </thead>

                                                        </table>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <!-- MODAL RECIBIDOOOOOO  -->
            <div class="modal fade" id="modal_recibido" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
                data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-lg">
                    <form id="ing_recibido">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">PAGOS REALIZADOS</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-3 col-sm-3">
                                        <label>Seleccione Una Opcion</label>
                                        <select id="slopciones" class="form-control">
                                            <option value="0">Seleccione</option>
                                            <option value="1">Efectivo</option>
                                            <option value="2">Trasferencia</option>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div id="idefectivo" style="display: none;">
                                    <div class="row">
                                        <div class="col-3 col-sm-3">
                                            <label>Valor</label>
                                            <input type="text" id="txtvalor_recibido" class="form-control" placeholder="Ingrese el valor">
                                        </div>
                                        <div class="col-4 col-sm-4">
                                            <label>Descripcion</label>
                                            <textarea id="txtdescripcion" cols="20" rows="5"></textarea>
                                        </div>
                                        <div class="col-5 col-sm-5">
                                            <label>Concepto Gastos</label>
                                            <select id="slgasto_recibido" class="select2" data-dropdown-css-class="select2-purple" style="width: 100%;" multiple>
                                                <?php
                                                while ($row_gasto = $resulgasto->fetch_assoc()) {
                                                ?>
                                                    <option value="<?= $row_gasto['Id'] ?>"><?= $row_gasto['Nombre'] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-6 col-sm-6" style="display: none;">
                                            <label>N.- Cuenta</label>
                                            <select id="slncuenta_recibido" class="select2" data-dropdown-css-class="select2-purple" style="width: 100%;" multiple>
                                                <?php
                                                while ($row_recibido = $resultresibido->fetch_assoc()) {
                                                ?>
                                                    <option value="<?= $row_recibido['Id'] ?>"><?= $row_recibido['Nombre_plataforma'] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="col-5 col-sm-5" style="display: none;">
                                            <label>N.- Comprobante</label>
                                            <input type="text" id="txtconprobante_recibdo" class="form-control" placeholder="Ingrese el numero de comprobante">
                                        </div>

                                    </div>
                                </div>
                                <div id="idTransferencia" style="display: none;">
                                    <div class="row">
                                        <div class="col-3 col-sm-3">
                                            <label>Valor</label>
                                            <input type="text" id="txtvalor_recibido1" class="form-control" placeholder="Ingrese el valor">
                                        </div>
                                        <div class="col-4 col-sm-4">
                                            <label>Descripcion</label>
                                            <textarea id="txtdescripcion1" cols="20" rows="5"></textarea>
                                        </div>
                                        <div class="col-5 col-sm-5">
                                            <label>Concepto Gastos</label>
                                            <select id="slgasto_recibido1" class="select2" data-dropdown-css-class="select2-purple" style="width: 100%;" multiple>
                                                <?php
                                                while ($row_gasto1 = $resulgasto1->fetch_assoc()) {
                                                ?>
                                                    <option value="<?= $row_gasto1['Id'] ?>"><?= $row_gasto1['Nombre'] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-6 col-sm-6">
                                            <label>N.- Cuenta</label>
                                            <select id="slncuenta_recibido1" class="select2" data-dropdown-css-class="select2-purple" style="width: 100%;" multiple>
                                                <?php
                                                while ($row_recibido1 = $resultresibido1->fetch_assoc()) {
                                                ?>
                                                    <option value="<?= $row_recibido1['Id'] ?>"><?= $row_recibido1['Nombre_plataforma'] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="col-5 col-sm-5">
                                            <label>N.- Comprobante</label>
                                            <input type="text" id="txtconprobante_recibdo1" class="form-control" placeholder="Ingrese el numero de comprobante">
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- MODAL RECIBIDOOOOOO EDITAR  -->
            <div class="modal fade" id="modal_recibido_E" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
                data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-lg">
                    <form id="edit_recibido">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">EDITAR PAGOS REALIZADOS</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" id="txtTipo">
                                <div id="idefectivo_E">
                                    <div class="row">
                                        <div class="col-3 col-sm-3">
                                            <label>Valor</label>
                                            <input type="hidden" id="txtidrecibodo">

                                            <input type="text" id="txtvalor_recibido_E" class="form-control" placeholder="Ingrese el valor">
                                        </div>
                                        <div class="col-4 col-sm-4">
                                            <label>Descripcion</label>
                                            <textarea id="txtdescripcion_E" cols="20" rows="5"></textarea>
                                        </div>
                                        <div class="col-5 col-sm-5">
                                            <label>Concepto Gastos</label>
                                            <select id="slgasto_recibido_E" class="select2" data-dropdown-css-class="select2-purple" style="width: 100%;" multiple>
                                                <?php
                                                while ($row_gasto_E = $resulgasto_E->fetch_assoc()) {
                                                ?>
                                                    <option value="<?= $row_gasto_E['Id'] ?>"><?= $row_gasto_E['Nombre'] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="col-3 col-sm-3">
                                            <label>Estado</label>
                                            <select id="slEstado_recibido_E" class="form-control">
                                                <option value="0">Activo</option>
                                                <option value="1">Inactivo</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div id="idtransferencia_E">
                                    <div class="row">
                                        <div class="col-3 col-sm-3">
                                            <label>Valor</label>
                                            <input type="hidden" id="txtidrecibodo1">
                                            <input type="text" id="txtvalor_recibido_E1" class="form-control" placeholder="Ingrese el valor">
                                        </div>
                                        <div class="col-4 col-sm-4">
                                            <label>Descripcion</label>
                                            <textarea id="txtdescripcion_E1" cols="20" rows="5"></textarea>
                                        </div>
                                        <div class="col-5 col-sm-5">
                                            <label>Concepto Gastos</label>
                                            <select id="slgasto_recibido_E1" class="select2" data-dropdown-css-class="select2-purple" style="width: 100%;" multiple>
                                                <?php
                                                while ($row_gasto_E1 = $resulgasto_E1->fetch_assoc()) {
                                                ?>
                                                    <option value="<?= $row_gasto_E1['Id'] ?>"><?= $row_gasto_E1['Nombre'] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-6 col-sm-6">
                                            <label>N.- Cuenta</label>
                                            <select id="slncuenta_recibido_E1" class="select2" data-dropdown-css-class="select2-purple" style="width: 100%;" multiple>
                                                <?php
                                                while ($row_recibido_E1 = $resultresibido_E1->fetch_assoc()) {
                                                ?>
                                                    <option value="<?= $row_recibido_E1['Id'] ?>"><?= $row_recibido_E1['Nombre_plataforma'] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-5 col-sm-5">
                                            <label>N.- Comprobante</label>
                                            <input type="text" id="txtconprobante_recibdo_E1" class="form-control" placeholder="Ingrese el numero de comprobante">
                                        </div>
                                        <div class="col-3 col-sm-3">
                                            <label>Estado</label>
                                            <select id="slEstado_recibido_E1" class="form-control">
                                                <option value="0">Activo</option>
                                                <option value="1">Inactivo</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Editar</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
            <?php include $footer; ?>
            <!-- ./wrapper -->

            <!-- jQuery -->
            <script src="../../frontend/plugins/jquery/jquery.min.js"></script>
            <!-- Bootstrap 4 -->
            <script src="../../frontend/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
            <!-- overlayScrollbars -->
            <script src="../../frontend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
            <!-- DataTables  & Plugins -->
            <script src="../../frontend/plugins/datatables/jquery.dataTables.min.js"></script>
            <script src="../../frontend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
            <script src="../../frontend/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
            <script src="../../frontend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
            <script src="../../frontend/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
            <script src="../../frontend/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
            <script src="../../frontend/plugins/jszip/jszip.min.js"></script>
            <script src="../../frontend/plugins/pdfmake/pdfmake.min.js"></script>
            <script src="../../frontend/plugins/pdfmake/vfs_fonts.js"></script>
            <script src="../../frontend/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
            <script src="../../frontend/plugins/datatables-buttons/js/buttons.print.min.js"></script>
            <script src="../../frontend/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
            <!-- AdminLTE App -->
            <script src="../../frontend/dist/js/adminlte.min.js"></script>
            <!-- AdminLTE for demo purposes -->
            <script src="../../frontend/dist/js/demo.js"></script>
            <!-- select2 -->
            <script src="../../frontend/plugins/select2/js/select2.full.min.js"></script>
            <!-- PAGE PLUGINS -->
            <!-- jQuery Mapael -->
            <script src="../../frontend/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
            <script src="../../frontend/plugins/raphael/raphael.min.js"></script>
            <script src="../../frontend/plugins/jquery-mapael/jquery.mapael.min.js"></script>
            <script src="../../frontend/plugins/jquery-mapael/maps/usa_states.min.js"></script>
            <!-- ChartJS -->
            <script src="../../frontend/plugins/chart.js/Chart.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

            <script>
                // 
                $(document).ready(function() {
                    listar_recibidos();

                    $('#modal_recibido').on('shown.bs.modal', function() {
                        if (!$.fn.select2) {
                            console.error('Select2 not loaded');
                            return;
                        }

                        if (!$('#slncuenta_recibido').hasClass('select2-hidden-accessible')) {
                            $('#slncuenta_recibido').select2({
                                dropdownParent: $('#modal_recibido'),
                                maximumSelectionLength: 1,
                                allowClear: true,
                                width: '100%',
                                theme: "classic"
                            });
                        }

                        if (!$('#slgasto_recibido').hasClass('select2-hidden-accessible')) {
                            $('#slgasto_recibido').select2({
                                dropdownParent: $('#modal_recibido'),
                                maximumSelectionLength: 1,
                                allowClear: true,
                                width: '100%',
                                theme: "classic"
                            });
                        }

                        if (!$('#slncuenta_recibido1').hasClass('select2-hidden-accessible')) {
                            $('#slncuenta_recibido1').select2({
                                dropdownParent: $('#modal_recibido'),
                                maximumSelectionLength: 1,
                                allowClear: true,
                                width: '100%',
                                theme: "classic"
                            });
                        }

                        if (!$('#slgasto_recibido1').hasClass('select2-hidden-accessible')) {
                            $('#slgasto_recibido1').select2({
                                dropdownParent: $('#modal_recibido'),
                                maximumSelectionLength: 1,
                                allowClear: true,
                                width: '100%',
                                theme: "classic"
                            });
                        }
                    });


                    $('#modal_recibido_E').on('shown.bs.modal', function() {
                        if (!$.fn.select2) {
                            console.error('Select2 not loaded');
                            return;
                        }

                        if (!$('#slgasto_recibido_E').hasClass('select2-hidden-accessible')) {
                            $('#slgasto_recibido_E').select2({
                                dropdownParent: $('#modal_recibido_E'),
                                maximumSelectionLength: 1,
                                allowClear: true,
                                width: '100%',
                                theme: "classic"
                            });
                        }

                        if (!$('#slncuenta_recibido_E').hasClass('select2-hidden-accessible')) {
                            $('#slncuenta_recibido_E').select2({
                                dropdownParent: $('#modal_recibido_E'),
                                maximumSelectionLength: 1,
                                allowClear: true,
                                width: '100%',
                                theme: "classic"
                            });
                        }
                    });

                    $('#modal_recibido_E').on('shown.bs.modal', function() {
                        if (!$.fn.select2) {
                            console.error('Select2 not loaded');
                            return;
                        }

                        if (!$('#slgasto_recibido_E1').hasClass('select2-hidden-accessible')) {
                            $('#slgasto_recibido_E1').select2({
                                dropdownParent: $('#modal_recibido_E'),
                                maximumSelectionLength: 1,
                                allowClear: true,
                                width: '100%',
                                theme: "classic"
                            });
                        }

                        if (!$('#slncuenta_recibido_E1').hasClass('select2-hidden-accessible')) {
                            $('#slncuenta_recibido_E1').select2({
                                dropdownParent: $('#modal_recibido_E'),
                                maximumSelectionLength: 1,
                                allowClear: true,
                                width: '100%',
                                theme: "classic"
                            });
                        }
                    });




                    $("#edit_recibido").submit(function(e) {
                        e.preventDefault();
                        //uno
                        var txtidrecibodo = $("#txtidrecibodo").val();
                        var txtvalor_recibido_E = $("#txtvalor_recibido_E").val();
                        var txtdescripcion_E = $("#txtdescripcion_E").val();
                        var slgasto_recibido_E = $("#slgasto_recibido_E").val();
                        var slEstado_recibido_E = $("#slEstado_recibido_E").val();
                        //dos
                        var txtidrecibodo1 = $("#txtidrecibodo1").val();
                        var txtvalor_recibido_E1 = $("#txtvalor_recibido_E1").val();
                        var txtdescripcion_E1 = $("#txtdescripcion_E1").val();
                        var slgasto_recibido_E1 = $("#slgasto_recibido_E1").val();
                        var slncuenta_recibido_E1 = $("#slncuenta_recibido_E1").val();
                        var slEstado_recibido_E1 = $("#slEstado_recibido_E1").val();
                        var txtconprobante_recibdo_E1 = $("#txtconprobante_recibdo_E1").val();
                        var txtTipo = $("#txtTipo").val();
                        $("#loader_div").show();
                        if (txtTipo == 'Efectivo') {
                            $.ajax({
                                type: "POST",
                                dataType: "json",
                                url: 'recibidos/ajax_editar.php',
                                data: {
                                    txtidrecibodo: txtidrecibodo,
                                    txtvalor_recibido_E: txtvalor_recibido_E,
                                    txtdescripcion_E: txtdescripcion_E,
                                    slgasto_recibido_E: slgasto_recibido_E,
                                    slEstado_recibido_E: slEstado_recibido_E,
                                    txtTipo: txtTipo
                                },
                                success: function(data) {
                                    if (data.success) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: data.success,
                                            showConfirmButton: false,
                                            timer: 2000
                                        })
                                        listar_recibidos();
                                        $("#modal_recibido_E").modal('hide');
                                        $("#loader_div").hide();
                                    }

                                },
                                error: function(jqXHR, exception) {
                                    console.log(jqXHR.responseText);
                                },
                            });
                        } else if (txtTipo == 'Transferencia') {
                            $.ajax({
                                type: "POST",
                                dataType: "json",
                                url: 'recibidos/ajax_editar.php',
                                data: {
                                    txtidrecibodo1: txtidrecibodo1,
                                    txtvalor_recibido_E1: txtvalor_recibido_E1,
                                    txtdescripcion_E1: txtdescripcion_E1,
                                    slgasto_recibido_E1: slgasto_recibido_E1,
                                    slncuenta_recibido_E1: slncuenta_recibido_E1,
                                    slEstado_recibido_E1: slEstado_recibido_E1,
                                    txtTipo: txtTipo,
                                    txtconprobante_recibdo_E1: txtconprobante_recibdo_E1
                                },
                                success: function(data) {
                                    if (data.success) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: data.success,
                                            showConfirmButton: false,
                                            timer: 2000
                                        })
                                        listar_recibidos();
                                        $("#modal_recibido_E").modal('hide');
                                        $("#loader_div").hide();
                                    }

                                },
                                error: function(jqXHR, exception) {
                                    console.log(jqXHR.responseText);
                                },
                            });
                        }
                    });



                    $("#ing_recibido").submit(function(e) {
                        e.preventDefault();

                        var txtvalor_recibido = $("#txtvalor_recibido").val();
                        var txtdescripcion = $("#txtdescripcion").val();
                        var slgasto_recibido = $("#slgasto_recibido").val();
                        var slncuenta_recibido = $("#slncuenta_recibido").val();
                        var txtconprobante_recibdo = $("#txtconprobante_recibdo").val();

                        var txtvalor_recibido1 = $("#txtvalor_recibido1").val();
                        var txtdescripcion1 = $("#txtdescripcion1").val();
                        var slgasto_recibido1 = $("#slgasto_recibido1").val();
                        var slncuenta_recibido1 = $("#slncuenta_recibido1").val();
                        var txtconprobante_recibdo1 = $("#txtconprobante_recibdo1").val();

                        var slopciones = $("#slopciones").val();
                        if (slopciones == 1) {
                            if (txtvalor_recibido == '') {
                                Swal.fire({
                                    icon: 'warning',
                                    title: "Ingrese el Valor",
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                            } else if (txtdescripcion == '') {
                                Swal.fire({
                                    icon: 'warning',
                                    title: "Ingrese la Descripcion",
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                            } else if (slgasto_recibido == '') {
                                Swal.fire({
                                    icon: 'warning',
                                    title: "Seleccione el Gasto",
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                            } else {
                                $("#loader_div").show();
                                $.ajax({
                                    type: "POST",
                                    dataType: "json",
                                    url: 'recibidos/ajax_nuevo.php',
                                    data: {
                                        txtvalor_recibido: txtvalor_recibido,
                                        txtdescripcion: txtdescripcion,
                                        slncuenta_recibido: slncuenta_recibido,
                                        txtconprobante_recibdo: txtconprobante_recibdo,
                                        slgasto_recibido: slgasto_recibido,
                                        slopciones: slopciones
                                    },
                                    success: function(data) {
                                        if (data.success) {
                                            Swal.fire({
                                                icon: 'success',
                                                title: data.success,
                                                showConfirmButton: false,
                                                timer: 2000
                                            })
                                            listar_recibidos();
                                            $("#txtvalor_recibido").val('');
                                            $("#txtdescripcion").val('');
                                            $("#txtconprobante_recibdo").val('');
                                            $("#loader_div").hide();
                                        }

                                    },
                                    error: function(jqXHR, exception) {
                                        console.log(jqXHR.responseText);
                                    },
                                });
                            }

                        } else if (slopciones == 2) {
                            if (txtvalor_recibido1 == '') {
                                Swal.fire({
                                    icon: 'warning',
                                    title: "Ingrese el Valor",
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                            } else if (txtdescripcion1 == '') {
                                Swal.fire({
                                    icon: 'warning',
                                    title: "Ingrese la Descripcion",
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                            } else if (slgasto_recibido1 == '') {
                                Swal.fire({
                                    icon: 'warning',
                                    title: "Seleccione el Gasto",
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                            } else if (slncuenta_recibido1 == '') {
                                Swal.fire({
                                    icon: 'warning',
                                    title: "Seleccione la Cuenta",
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                            } else if (txtconprobante_recibdo1 == '') {
                                Swal.fire({
                                    icon: 'warning',
                                    title: "Ingrese el Numero de Cuenta",
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                            } else {
                                $("#loader_div").show();
                                $.ajax({
                                    type: "POST",
                                    dataType: "json",
                                    url: 'recibidos/ajax_nuevo.php',
                                    data: {
                                        txtvalor_recibido1: txtvalor_recibido1,
                                        txtdescripcion1: txtdescripcion1,
                                        slgasto_recibido1: slgasto_recibido1,
                                        slncuenta_recibido1: slncuenta_recibido1,
                                        txtconprobante_recibdo1: txtconprobante_recibdo1,

                                        slopciones: slopciones
                                    },
                                    success: function(data) {
                                        if (data.success) {
                                            Swal.fire({
                                                icon: 'success',
                                                title: data.success,
                                                showConfirmButton: false,
                                                timer: 2000
                                            })
                                            listar_recibidos();
                                            $("#txtvalor_recibido1").val('');
                                            $("#txtdescripcion1").val('');
                                            $("#txtconprobante_recibdo1").val('');
                                            $("#loader_div").hide();
                                        }

                                    },
                                    error: function(jqXHR, exception) {
                                        console.log(jqXHR.responseText);
                                    },
                                });
                            }
                        }


                    });
                    document.getElementById("txtvalor_recibido").addEventListener("input", function() {
                        this.value = this.value
                            .replace(/[^0-9.]/g, '')
                            .replace(/(\..*?)\..*/g, '$1');
                    });
                });



                function listar_recibidos() {
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: 'recibidos/ajax_listar.php',
                        data: {},
                        success: function(data) {
                            console.log(data);
                            cargar_lista_recibidos(data);
                        },
                        error: function(jqXHR, exception) {
                            console.log(jqXHR.responseText);
                        },
                    });
                }







                function cargar_lista_recibidos(data) {
                    var table = $('#tbl_lista_recibido').DataTable();
                    table.destroy();
                    table.clear();
                    $('#tbl_lista_recibido').dataTable({
                        "order": [
                            [1, 'DESC']
                        ],
                        "language": {
                            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                        },

                        scrollY: '300px',
                        "scrollX": true,
                        scrollCollapse: true,
                        "bInfo": true,
                        paging: false,
                        deferRender: false,
                        data: data,
                        dom: 'Bfrtip',
                        searching: true,
                        buttons: [],
                        columns: [{
                                "data": "Valor"
                            },
                            {
                                "data": "Descripcion"
                            },
                            {
                                "data": "Gasto"
                            },

                            {
                                "data": "Nombre_plataforma"
                            },
                            {
                                "data": "N_Comprobante"
                            },


                            {
                                "data": "Usuario"
                            },


                            {
                                render: function(data, type, full, meta) {
                                    if (full.Estado === '1') {
                                        var Estado_carnet = '<span id="spEstado" class="btn btn-danger">Inactivo</span>'
                                    } else if (full.Estado === '0') {
                                        var Estado_carnet = '<span id="spEstado" class="btn btn-success">Activo</span>'
                                    }
                                    return Estado_carnet
                                }
                            },
                            {
                                "data": "Tipo"
                            },
                            {
                                render: function(data, type, full, meta) {
                                    var typeUsuario = <?= json_encode($_SESSION['type']) ?>;
                                    let estado = '';
                                    if (typeUsuario === '1' || typeUsuario === '2') {
                                        estado = `
                                            <button class="btn btn-sm btn-icon btn-pure btn-default on-default eliminar" title="Eliminar">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </button>
                                            <button class="btn btn-sm btn-icon btn-pure btn-default on-default editar" title="Editar">
                                                <i class="fa fa-pen" aria-hidden="true"></i>
                                            </button>`;
                                    } else if (typeUsuario === '4') {
                                        estado = `
                                            <button class="btn btn-sm btn-icon btn-pure btn-default on-default editar" title="Editar">
                                                <i class="fa fa-pen" aria-hidden="true"></i>
                                            </button>`;
                                    } else if (typeUsuario === '3') {
                                        estado = ``;
                                    }
                                    return estado;
                                }
                            }

                        ]
                    });
                    $('#tbl_lista_recibido tbody').on('click', 'button.eliminar', function() {
                        event.preventDefault();
                        var table = $('#tbl_lista_recibido').DataTable();
                        var data = table.row($(this).parents('tr')).data();
                        var estado = $(this).parents("tr").find('#spEstado');
                        var idBancoEliminar = data.Id;
                        console.log(idBancoEliminar);
                        Swal.fire({
                            title: "Estas Seguro ?",
                            text: "De eliminar esta Transferencia Recibida !",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Aceptar!"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $("#loader_div").show();
                                $.ajax({
                                    type: "POST",
                                    dataType: "json",
                                    url: 'recibidos/ajax_eliminar.php',
                                    data: {
                                        idBancoEliminar: idBancoEliminar
                                    },
                                    success: function(data) {
                                        if (data.success) {
                                            Swal.fire({
                                                icon: 'success',
                                                title: data.success,
                                                showConfirmButton: false,
                                                timer: 2000
                                            })
                                            listar_recibidos();
                                            $("#loader_div").hide();
                                        }
                                    },
                                    error: function(jqXHR, exception) {
                                        console.log(jqXHR.responseText);
                                    },
                                });
                            }
                        });
                    });
                    $('#tbl_lista_recibido tbody').on('click', 'button.editar', function() {
                        event.preventDefault();
                        var table = $('#tbl_lista_recibido').DataTable();
                        var data = table.row($(this).parents('tr')).data();
                        var estado = $(this).parents("tr").find('#spEstado');
                        console.log(data);
                        if (data.Tipo == 'Efectivo') {
                            $("#modal_recibido_E").modal('show');
                            $("#idefectivo_E").show();
                            $("#idtransferencia_E").hide();
                            txtidrecibodo = $("#txtidrecibodo").val(data.Id);
                            txtvalor_recibido_E = $("#txtvalor_recibido_E").val(data.Valor);
                            txtdescripcion_E = $("#txtdescripcion_E").val(data.Descripcion);
                            let selected = data.IdGasto.split(',');
                            $("#slgasto_recibido_E").val(selected).trigger("change");
                            slEstado_recibido_E = $("#slEstado_recibido_E").val(data.Estado);
                            txtTipo = $("#txtTipo").val(data.Tipo);

                        } else if (data.Tipo == 'Transferencia') {
                            $("#modal_recibido_E").modal('show');
                            $("#idtransferencia_E").show();
                            $("#idefectivo_E").hide();
                            txtidrecibodo1 = $("#txtidrecibodo1").val(data.Id);
                            txtvalor_recibido_E1 = $("#txtvalor_recibido_E1").val(data.Valor);
                            txtdescripcion_E1 = $("#txtdescripcion_E1").val(data.Descripcion);
                            let selected = data.IdGasto.split(',');
                            $("#slgasto_recibido_E1").val(selected).trigger("change");
                            slEstado_recibido_E1 = $("#slEstado_recibido_E1").val(data.Estado);
                            let selected1 = data.IdPlataforma.split(',');
                            $("#slncuenta_recibido_E1").val(selected1).trigger("change");
                            txtconprobante_recibdo_E1 = $("#txtconprobante_recibdo_E1").val(data.N_Comprobante);
                            txtTipo = $("#txtTipo").val(data.Tipo);
                        }
                    });
                }


                $('#sl_opciones').on('change', function() {
                    setTimeout(function() {
                        $('#tbl_lista_recibido').DataTable().columns.adjust().responsive.recalc();
                    }, 100);
                });
                $('#slopciones').on('change', function() {
                    var idOpciones = $(this).val();
                    if (idOpciones == 0) {
                        $("#idefectivo").hide();
                        $("#idTransferencia").hide();
                    } else if (idOpciones == 1) {
                        $("#idefectivo").show();
                        $("#idTransferencia").hide();
                    } else if (idOpciones == 2) {
                        $("#idefectivo").hide();
                        $("#idTransferencia").show();
                    }
                });
            </script>

        </body>

        </html>
<?php
    } else {
        header("location:/" . $projectName . "error.php");
    }
} else {
    header("location:/" . $projectName . "index.php");
}
?>
