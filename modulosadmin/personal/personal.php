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
        $perfiles = '';
        foreach ($repositorio->getArrayTablaDB('Id,Tipo', 'tipo_usuario', 'Tipo') as $items) {
            $perfiles .= "<option value='{$items['Id']}'>{$items['Tipo']}</option>";
        }

        $sql_tipoUsuario = "SELECT * FROM tipo_usuario WHERE NOT Tipo = 'Master' ";
        $result = $conec->query($sql_tipoUsuario);

        $sql_tipoUsuario_E = "SELECT * FROM tipo_usuario WHERE NOT Tipo = 'Master' ";
        $result_E = $conec->query($sql_tipoUsuario_E);

        $sql_otros = "SELECT * FROM otros_ingresos";
        $result_otros = $conec->query($sql_otros);
        $sql_tipo_cuenta = "SELECT * FROM tipo_cuenta";
        $result1 = $conec->query($sql_tipo_cuenta);
        $sql_Banco = "SELECT * FROM tipo_banco";
        $resultBanco = $conec->query($sql_Banco);

        $sql_otrosE = "SELECT * FROM otros_ingresos";
        $result_otrosE = $conec->query($sql_otrosE);

        $sql_tipo_cuentaE = "SELECT * FROM tipo_cuenta";
        $result1E = $conec->query($sql_tipo_cuentaE);

        $sql_BancoE = "SELECT * FROM tipo_banco";
        $resultBancoE = $conec->query($sql_BancoE);



?>

        <!DOCTYPE html>
        <html lang="es">

        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="icon" type="image/png" href="../../img/multipagos.jpg" />
            <title>Ingreso Personal</title>

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
                                    <h1>Personal Administrativos</h1>
                                </div>
                                <div class="col-sm-6">
                                    <ol class="breadcrumb float-sm-right">
                                        <li class="breadcrumb-item"><a href="../../menu.php">Home</a></li>
                                        <li class="breadcrumb-item active">Administración Vistas</li>
                                    </ol>
                                </div>
                            </div>
                        </div><!-- /.container-fluid -->
                    </section>

                    <!-- /.modal -->
                    <div id="modalModulos" class="modal" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="titleModal"></h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <label for="nomModulo">Nombre Modulo</label>
                                            <input class="form-control" id="nomModulo" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" id="idModulo" value="">
                                    <button type="button" class="btn btn-primary" onclick="addEditModulo();"><i class="fa fa-save"> </i> Guardar</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                                <i class="fa fa-book"></i> Nuevo Ingreso
                                            </button>
                                            <hr>
                                            <div class="row">
                                                <div class="col-3">
                                                    <label>Filtrar Activos - Inactivos</label>
                                                    <select id="slestado" class="form-control" onchange="obtenerValor()">
                                                        <option value="v">Seleccione</option>
                                                        <option value="T">Todo</option>
                                                        <option value="0">Activo</option>
                                                        <option value="1">Inactivo</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <hr>
                                            <form action="registro/excel_personal.php" method="post">
                                                <div class="row">
                                                    <div class="col-md-2 form-group">
                                                        <br>
                                                        <input type="submit" class="btn btn-primary" value="Generar Excel">
                                                    </div>
                                                </div>
                                            </form>
                                            <table class="table table-bordered table-hover" id="tbl_lista_usuarios" style="width: 100%;" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>Apellidos</th>
                                                        <th>Nombres</th>
                                                        <th>Fecha Nacimiento</th>
                                                        <th>Fecha Entrada</th>
                                                        <th>Sueldo</th>
                                                        <th>Otros</th>
                                                        <th>Cuenta Num</th>
                                                        <th>Tipo Cuenta</th>
                                                        <th>Banco o Coac</th>
                                                        <th>Usuario Ingreso</th>
                                                        <th>Tipo Usuario</th>
                                                        <th>Estado</th>
                                                        <th>Opciones</th>
                                                    </tr>
                                                </thead>

                                            </table>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- /.content -->

                </div>
                <!-- /.content-wrapper -->
            </div>

            <!-- MODAL INGRESO -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
                data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form id="form_guardar">

                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-12 col-sm-6 col-md-4 col-lg-12">
                                        <label style="text-align: center; font-size: 25px;">DATOS DE PERSONALES </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                        <label>Apellidos</label>
                                        <input type="text" class="form-control" placeholder="Ejm: Iza" id="txtapellido">
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                        <label>Nombres</label>
                                        <input type="text" class="form-control" placeholder="Ejm: Jessica" id="txtnombre">
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                        <label>Fecha Nacimiento</label>
                                        <input type="date" class="form-control" id="txtfechaN">
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                        <label>Fecha Entrada</label>
                                        <input type="date" class="form-control" id="txtFechaEntrada">
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                        <label>Sueldo</label>
                                        <input type="text" class="form-control" id="txtSueldo" placeholder="Ejm: 450.00">
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-4 col-lg-5">
                                        <label>Otros</label>
                                        <select id="slotros" class="select2" data-dropdown-css-class="select2-purple" style="width: 100%;" multiple>
                                            <?php while ($fila = $result_otros->fetch_assoc()) { ?>
                                                <option value="<?= $fila['Id'] ?>"><?= $fila['Nombre'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                        <label>Cuenta num</label>
                                        <input type="text" class="form-control" id="txtcuenta" placeholder="Ejm: 22578545">
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                        <label>Tipo cuenta</label>
                                        <select id="sltipocuenta" class="form-control">
                                            <?php while ($fila1 = $result1->fetch_assoc()) { ?>
                                                <option value="<?= $fila1['Id'] ?>"><?= $fila1['Nombre'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-4 col-lg-5">
                                        <label>Banco o Coac</label>
                                        <select id="slBanco" class="select2" data-dropdown-css-class="select2-purple" style="width: 100%;" multiple>
                                            <?php while ($filaBanco = $resultBanco->fetch_assoc()) { ?>
                                                <option value="<?= $filaBanco['Id'] ?>"><?= $filaBanco['Nombre'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-6 col-md-4 col-lg-12">
                                        <label style="text-align: center; font-size: 25px;">DATOS DE ACCESO</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-6 col-md-4 col-lg-6">
                                        <label>Nombre del Usuario</label>
                                        <input type="text" class="form-control" placeholder="Ejm: Jessica" id="txtnom" oninput="validarNombre(this)">
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-4 col-lg-6">
                                        <label>Correo Electronico</label>
                                        <input type="text" class="form-control" placeholder="juan@gmail.com" id="txtemail" onblur="validarEmail(this)">
                                        <span id="msg-email" style="color: red; font-size: 14px;"></span>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-4 col-lg-6">
                                        <label>Contraseña</label>
                                        <input type="text" class="form-control" placeholder="12345" id="txtcontrasena">
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-4 col-lg-6">
                                        <label>Tipo Usuario</label>
                                        <select id="sltusu" class="form-control">
                                            <option value="0">Seleccione</option>
                                            <?php
                                            while ($row = $result->fetch_assoc()) {
                                            ?>
                                                <option value="<?= $row['Id'] ?>"><?= $row['Tipo'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal de editar -->
            <div class="modal fade" id="modal_editar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
                data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form id="form_editar">

                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-12 col-sm-6 col-md-4 col-lg-12">
                                        <label style="text-align: center; font-size: 25px;">EDITAR DATOS DE PERSONALES </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                        <input type="hidden" id="idusuariosE">
                                        <label>Apellidos</label>
                                        <input type="text" class="form-control" placeholder="Ejm: Iza" id="txtapellidoE">
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                        <label>Nombres</label>
                                        <input type="text" class="form-control" placeholder="Ejm: Jessica" id="txtnombreE">
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                        <label>Fecha Nacimiento</label>
                                        <input type="date" class="form-control" id="txtfechaNE">
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                        <label>Fecha Entrada</label>
                                        <input type="date" class="form-control" id="txtFechaEntradaE">
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                        <label>Sueldo</label>
                                        <input type="text" class="form-control" id="txtSueldoE" placeholder="Ejm: 450.00">
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-4 col-lg-5">
                                        <label>Otros</label>
                                        <select id="slotrosE" class="select2" data-dropdown-css-class="select2-purple" style="width: 100%;" multiple>
                                            <?php while ($filaE = $result_otrosE->fetch_assoc()) { ?>
                                                <option value="<?= $filaE['Id'] ?>"><?= $filaE['Nombre'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                        <label>Cuenta num</label>
                                        <input type="text" class="form-control" id="txtcuentaE" placeholder="Ejm: 22578545">
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                        <label>Tipo cuenta</label>
                                        <select id="sltipocuentaE" class="form-control">
                                            <?php while ($fila1E = $result1E->fetch_assoc()) { ?>
                                                <option value="<?= $fila1E['Id'] ?>"><?= $fila1E['Nombre'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-4 col-lg-5">
                                        <label>Banco o Coac</label>
                                        <select id="slBancoE" class="select2" data-dropdown-css-class="select2-purple" style="width: 100%;" multiple>
                                            <?php while ($filaBancoE = $resultBancoE->fetch_assoc()) { ?>
                                                <option value="<?= $filaBancoE['Id'] ?>"><?= $filaBancoE['Nombre'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-6 col-md-4 col-lg-12">
                                        <label style="text-align: center; font-size: 25px;">DATOS DE ACCESO</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-6 col-md-4 col-lg-6">
                                        <label>Nombre del Usuario</label>
                                        <input type="text" class="form-control" placeholder="Ejm: Jessica" id="txtnom_E" oninput="validarNombre(this)">
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-4 col-lg-6">
                                        <label>Correo Electronico</label>
                                        <input type="text" class="form-control" placeholder="juan@gmail.com" id="txtemail_E" onblur="validarEmail(this)">
                                        <span id="msg-email" style="color: red; font-size: 14px;"></span>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-4 col-lg-6">
                                        <label>Tipo Usuario</label>
                                        <select id="sltusu_E" class="form-control">
                                            <option value="0">Seleccione</option>
                                            <?php
                                            while ($row_E = $result_E->fetch_assoc()) {
                                            ?>
                                                <option value="<?= $row_E['Id'] ?>"><?= $row_E['Tipo'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-4 col-lg-6">
                                        <label>Estado</label>
                                        <select id="slEstado_E" class="form-control">
                                            <option value="0">Activo</option>
                                            <option value="1">Inactivo</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Editar</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                            </div>
                        </form>
                    </div>
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
                $(document).ready(function() {
                    listar_usuarios();
                    document.getElementById("txtapellido").addEventListener("input", function(e) {
                        this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s'-]/g, '');
                    });
                    document.getElementById("txtnombre").addEventListener("input", function(e) {
                        this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s'-]/g, '');
                    });

                    document.getElementById("txtSueldo").addEventListener("input", function() {
                        this.value = this.value
                            .replace(/[^0-9.]/g, '')
                            .replace(/(\..*?)\..*/g, '$1');
                    });

                    document.getElementById("txtcuenta").addEventListener("input", function() {
                        this.value = this.value.replace(/\D/g, '');
                    });


                    document.getElementById("txtapellidoE").addEventListener("input", function(e) {
                        this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s'-]/g, '');
                    });
                    document.getElementById("txtnombreE").addEventListener("input", function(e) {
                        this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s'-]/g, '');
                    });

                    document.getElementById("txtSueldoE").addEventListener("input", function() {
                        this.value = this.value
                            .replace(/[^0-9.]/g, '')
                            .replace(/(\..*?)\..*/g, '$1');
                    });

                    document.getElementById("txtcuentaE").addEventListener("input", function() {
                        this.value = this.value.replace(/\D/g, '');
                    });

                    $('#exampleModal').on('shown.bs.modal', function() {
                        if (!$.fn.select2) {
                            console.error('Select2 not loaded');
                            return;
                        }
                        if (!$('#slotros').hasClass('select2-hidden-accessible')) {
                            $('#slotros').select2({
                                dropdownParent: $('#exampleModal'),
                                allowClear: true,
                                width: '100%',
                                theme: "classic"
                            });
                        }
                        if (!$('#slBanco').hasClass('select2-hidden-accessible')) {
                            $('#slBanco').select2({
                                dropdownParent: $('#exampleModal'),
                                maximumSelectionLength: 1,
                                allowClear: true,
                                width: '100%',
                                theme: "classic"
                            });
                        }
                    });

                    $('#modal_editar').on('shown.bs.modal', function() {
                        if (!$.fn.select2) {
                            console.error('Select2 not loaded');
                            return;
                        }
                        if (!$('#slotrosE').hasClass('select2-hidden-accessible')) {
                            $('#slotrosE').select2({
                                dropdownParent: $('#modal_editar'),
                                allowClear: true,
                                width: '100%',
                                theme: "classic"
                            });
                        }
                        if (!$('#slBancoE').hasClass('select2-hidden-accessible')) {
                            $('#slBancoE').select2({
                                dropdownParent: $('#modal_editar'),
                                maximumSelectionLength: 1,
                                allowClear: true,
                                width: '100%',
                                theme: "classic"
                            });
                        }
                    });



                    $("#form_editar").submit(function(e) {
                        e.preventDefault();
                        var idusuariosE = $("#idusuariosE").val();
                        var txtapellidoE = $("#txtapellidoE").val();
                        var txtnombreE = $("#txtnombreE").val();
                        var txtfechaNE = $("#txtfechaNE").val();
                        var txtFechaEntradaE = $("#txtFechaEntradaE").val();
                        var txtSueldoE = $("#txtSueldoE").val();
                        var slotrosE = $("#slotrosE").val();
                        var txtcuentaE = $("#txtcuentaE").val();
                        var sltipocuentaE = $("#sltipocuentaE").val();
                        var slBancoE = $("#slBancoE").val();

                        var txtnom_E = $("#txtnom_E").val();
                        var txtemail_E = $("#txtemail_E").val();
                        var sltusu_E = $("#sltusu_E").val();
                        var slEstado_E = $("#slEstado_E").val();

                        if (txtapellidoE == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Ingrese los Apellidos ",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (txtnombreE == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Ingrese los Nombres ",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (txtfechaNE == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Seleccione la Fecha de Nacimiento",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (txtFechaEntradaE == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Seleccione la Fecha de Entrada ",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (txtSueldoE == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Ingrese el sueldo",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (slotrosE == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Seleccione el Campo OTROS",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (txtcuentaE == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Ingrese el numero de cuenta ",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (slBancoE == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Seleccione el Banco o Coac",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else {
                            $("#loader_div").show();
                            $.ajax({
                                type: "POST",
                                dataType: "json",
                                url: 'registro/ajax_Editar.php',
                                data: {
                                    idusuariosE: idusuariosE,
                                    txtapellidoE: txtapellidoE,
                                    txtnombreE: txtnombreE,
                                    txtfechaNE: txtfechaNE,
                                    txtFechaEntradaE: txtFechaEntradaE,
                                    txtSueldoE: txtSueldoE,
                                    slotrosE: slotrosE,
                                    txtcuentaE: txtcuentaE,
                                    sltipocuentaE: sltipocuentaE,
                                    slBancoE: slBancoE,
                                    txtnom_E: txtnom_E,
                                    txtemail_E: txtemail_E,
                                    sltusu_E: sltusu_E,
                                    slEstado_E: slEstado_E
                                },
                                success: function(data) {
                                    console.log(data);
                                    if (data.su) {
                                        Swal.fire({
                                            icon: 'warning',
                                            title: data.su,
                                            showConfirmButton: false,
                                            timer: 2000
                                        })
                                        $("#loader_div").hide();
                                    } else if (data.success) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: data.success,
                                            showConfirmButton: false,
                                            timer: 2000
                                        })
                                        $("#modal_editar").modal('hide');
                                        listar_usuarios();
                                        $("#loader_div").hide();
                                    }
                                },
                                error: function(jqXHR, exception) {
                                    console.log(jqXHR.responseText);
                                },
                            });
                        }
                    });

                    $("#form_guardar").submit(function(e) {
                        e.preventDefault();
                        var txtnom = $("#txtnom").val();
                        var txtemail = $("#txtemail").val();
                        var txtcontrasena = $("#txtcontrasena").val();
                        var sltusu = $("#sltusu").val();
                        var txtapellido = $("#txtapellido").val();
                        var txtnombre = $("#txtnombre").val();
                        var txtfechaN = $("#txtfechaN").val();
                        var txtFechaEntrada = $("#txtFechaEntrada").val();
                        var txtSueldo = $("#txtSueldo").val();
                        var slotros = $("#slotros").val();
                        var txtcuenta = $("#txtcuenta").val();
                        var sltipocuenta = $("#sltipocuenta").val();
                        var slBanco = $("#slBanco").val();
                        if (txtapellido == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Ingrese los Apellidos ",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (txtnombre == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Ingrese los Nombres ",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (txtfechaN == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Seleccione la Fecha de Nacimiento",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (txtFechaEntrada == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Seleccione la Fecha de Entrada ",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (txtSueldo == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Ingrese el sueldo",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (slotros == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Seleccione el Campo OTROS",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (txtcuenta == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Ingrese el numero de cuenta ",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (slBanco == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Seleccione el Banco o Coac",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (txtnom == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Ingrese el Nombre de Usuario",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (txtemail == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Ingrese un Correo electronico",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (txtcontrasena == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Ingrese una Contraseña",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (sltusu == 0) {
                            Swal.fire({
                                icon: 'warning',
                                title: "Seleccione el Tipo de Usuario",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else {
                            $("#loader_div").show();
                            $.ajax({
                                type: "POST",
                                dataType: "json",
                                url: 'registro/ajax_nuevo.php',
                                data: {
                                    txtapellido: txtapellido,
                                    txtnombre: txtnombre,
                                    txtfechaN: txtfechaN,
                                    txtFechaEntrada: txtFechaEntrada,
                                    txtSueldo: txtSueldo,
                                    slotros: slotros,
                                    txtcuenta: txtcuenta,
                                    sltipocuenta: sltipocuenta,
                                    slBanco: slBanco,
                                    txtnom: txtnom,
                                    txtemail: txtemail,
                                    txtcontrasena: txtcontrasena,
                                    sltusu: sltusu
                                },
                                success: function(data) {
                                    console.log(data);
                                    if (data.su) {
                                        Swal.fire({
                                            icon: 'warning',
                                            title: data.su,
                                            showConfirmButton: false,
                                            timer: 2000
                                        })
                                        $("#loader_div").hide();
                                    } else if (data.success) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: data.success,
                                            showConfirmButton: false,
                                            timer: 2000
                                        })
                                        $("#exampleModal").modal('hide');
                                        listar_usuarios();
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

                function listar_usuarios() {
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: 'registro/ajax_listar.php',
                        data: {},
                        success: function(data) {
                            cargar_lista_personal(data);
                        },
                        error: function(jqXHR, exception) {
                            console.log(jqXHR.responseText);
                        },
                    });
                }

                function cargar_lista_personal(data) {
                    var table = $('#tbl_lista_usuarios').DataTable();
                    table.destroy();
                    table.clear();
                    $('#tbl_lista_usuarios').dataTable({
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
                                "data": "Apellidos"
                            },

                            {
                                "data": "Nombre"
                            },
                            {
                                "data": "FN"
                            },
                            {
                                "data": "FE"
                            },
                            {
                                "data": "Sueldo"
                            },
                            {
                                "data": "Otros"
                            },
                            {
                                "data": "NC"
                            },
                            {
                                "data": "TCuenta"
                            },
                            {
                                "data": "Banco"
                            },
                            {
                                "data": "Usuario"
                            },
                            {
                                "data": "Tipo_Usuario"
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
                                render: function(data, type, full, meta) {
                                    var estado = `<button class=\"btn btn-sm btn-icon btn-pure btn-default on-default eliminar" title="Eliminar"><i class="fa fa-trash" aria-hidden="true"></i></button> 
                                    <button class=\"btn btn-sm btn-icon btn-pure btn-default on-default editar" title="Editar"><i class="fa fa-pen" aria-hidden="true"></i></button>`

                                    return estado
                                }
                            },

                        ]
                    });
                    $('#tbl_lista_usuarios tbody').on('click', 'button.eliminar', function() {
                        event.preventDefault();
                        var table = $('#tbl_lista_usuarios').DataTable();
                        var data = table.row($(this).parents('tr')).data();
                        var estado = $(this).parents("tr").find('#spEstado');
                        var idUsuarioEliminar = data.IdUsuario;
                        Swal.fire({
                            title: "Estas Seguro ?",
                            text: "De eliminar este usuario !",
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
                                    url: 'registro/ajax_eliminar.php',
                                    data: {
                                        idUsuarioEliminar: idUsuarioEliminar
                                    },
                                    success: function(data) {
                                        if (data.success) {
                                            Swal.fire({
                                                icon: 'success',
                                                title: data.success,
                                                showConfirmButton: false,
                                                timer: 2000
                                            })
                                            listar_usuarios();
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
                    $('#tbl_lista_usuarios tbody').on('click', 'button.editar', function() {
                        event.preventDefault();
                        var table = $('#tbl_lista_usuarios').DataTable();
                        var data = table.row($(this).parents('tr')).data();
                        var estado = $(this).parents("tr").find('#spEstado');
                        $("#modal_editar").modal('show');
                        txtapellidoE = $("#txtapellidoE").val(data.Apellidos);
                        txtnombreE = $("#txtnombreE").val(data.Nombre);
                        txtfechaNE = $("#txtfechaNE").val(data.FN);
                        txtFechaEntradaE = $("#txtFechaEntradaE").val(data.FE);
                        txtSueldoE = $("#txtSueldoE").val(data.Sueldo);
                        let selected = data.IdOtros.split(',');
                        $("#slotrosE").val(selected).trigger("change");
                        txtcuentaE = $("#txtcuentaE").val(data.NC);
                        sltipocuentaE = $("#sltipocuentaE").val(data.IdTipoCuenta);
                        let selected1 = data.IdBanco.split(',');
                        $("#slBancoE").val(selected1).trigger("change");
                        idusuariosE = $("#idusuariosE").val(data.IdUsuario);
                        txtnom_E = $("#txtnom_E").val(data.Usuario);
                        txtemail_E = $("#txtemail_E").val(data.Emails);
                        sltusu_E = $("#sltusu_E").val(data.IdTipo_usuario);
                        slEstado_E = $("#slEstado_E").val(data.Estado);
                    });
                }

                function validarEmail(input) {
                    const correo = input.value.trim();
                    const mensaje = document.getElementById("msg-email");
                    // Expresión regular para validar correos electrónicos
                    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (correo === "") {
                        mensaje.textContent = "El campo está vacío.";
                    } else if (!regex.test(correo)) {
                        mensaje.textContent = "Correo inválido. Ej: juan@gmail.com";
                    } else {
                        mensaje.textContent = "";
                    }
                }

                function validarNombre(input) {
                    input.value = input.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ'-]/g, '');
                }

                function obtenerValor() {
                    const select = document.getElementById("slestado");
                    const valorSeleccionado = select.value;
                    if (valorSeleccionado == 'v') {} else {
                        $.ajax({
                            type: "POST",
                            dataType: "json",
                            url: 'registro/ajax_filtrar.php',
                            data: {
                                valorSeleccionado: valorSeleccionado
                            },
                            success: function(data) {

                                cargar_lista_personal(data)
                            },
                            error: function(jqXHR, exception) {
                                console.log(jqXHR.responseText);
                            },
                        });
                    }

                }
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
