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

        // Lista para efectivo
        $sql_plataforma = "SELECT MIN(Id) AS Id, Nombre_plataforma FROM plataforma_usuario WHERE Estado = '0' GROUP BY Nombre_plataforma ORDER BY `Id` ASC ";
        $resultPlata = $conec->query($sql_plataforma);

        $sql_banco = "SELECT Id,Nombre FROM tipo_banco WHERE Estado = '0' ";
        $resultBanco = $conec->query($sql_banco);

        $sql_plataforma_E = "SELECT MIN(Id) AS Id, Nombre_plataforma FROM plataforma_usuario WHERE Estado = '0' GROUP BY Nombre_plataforma ORDER BY `Id` ASC ";
        $resultPlata_E = $conec->query($sql_plataforma_E);

        $sql_banco_E = "SELECT Id,Nombre FROM tipo_banco WHERE Estado = '0' ";
        $resultBanco_E = $conec->query($sql_banco_E);

        //Lista para enviados
        $sql_enviados = "SELECT MIN(Id) AS Id, Nombre_plataforma FROM plataforma_usuario WHERE Estado = '0' GROUP BY Nombre_plataforma ORDER BY `Id` ASC ";
        $resultenviados = $conec->query($sql_enviados);

        $sql_enviados1 = "SELECT MIN(Id) AS Id, Nombre_plataforma FROM plataforma_usuario WHERE Estado = '0' GROUP BY Nombre_plataforma ORDER BY `Id` ASC ";
        $resultenviados1 = $conec->query($sql_enviados1);

        $sql_banco_enviados = "SELECT Id,Nombre FROM tipo_banco WHERE Estado = '0' ";
        $resultBanco_enviados = $conec->query($sql_banco_enviados);

        $sql_enviados_E = "SELECT MIN(Id) AS Id, Nombre_plataforma FROM plataforma_usuario WHERE Estado = '0' GROUP BY Nombre_plataforma ORDER BY `Id` ASC ";
        $resultenviados_E = $conec->query($sql_enviados_E);

        $sql_enviados1_E = "SELECT MIN(Id) AS Id, Nombre_plataforma FROM plataforma_usuario WHERE Estado = '0' GROUP BY Nombre_plataforma ORDER BY `Id` ASC ";
        $resultenviados1_E = $conec->query($sql_enviados1_E);

        $sql_banco_enviados_E = "SELECT Id,Nombre FROM tipo_banco WHERE Estado = '0' ";
        $resultBanco_enviados_E = $conec->query($sql_banco_enviados_E);

        // Lista para recibidos
        $sql_recibido = "SELECT Id,Nombre_plataforma FROM plataforma_usuario WHERE Estado = '0' ";
        $resultresibido = $conec->query($sql_recibido);

        $sql_recibido_E = "SELECT Id,Nombre_plataforma FROM plataforma_usuario WHERE Estado = '0' ";
        $resultresibido_E = $conec->query($sql_recibido_E);



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
                                    <h1>Depositos - Tranferencia en Banco</h1>
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
                                            <div class="row">
                                                <div class="col-3">
                                                    <label>Seleccione el metodo de deposito / tranferecia</label>
                                                    <select id="sl_option" class="form-control">
                                                        <option value="0">Seleccione</option>
                                                        <option value="1">Efectivo</option>
                                                        <option value="2">Tranferencia</option>
                                                    </select>
                                                </div>
                                                <div class="col-3">
                                                    <div id="idTranferecia" style="display: none;">
                                                        <label>Opciones</label>
                                                        <select id="sl_opciones" class="form-control">
                                                            <option value="0">Seleccione</option>
                                                            <option value="1">Enviadas - compra cupos</option>
                                                            <!-- <option value="2">Recibidas - Pago Matricula</option> -->
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="col-12">

                                                <div id="idefectivo" style="display: none;">

                                                    <?php
                                                    if ($Typeusuario != 4) {
                                                    ?>
                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_efectivo">
                                                            <i class="fa fa-book"></i> Nuevo Ingreso
                                                        </button>
                                                        <hr>
                                                        <table class="table table-bordered table-hover" id="tbl_lista_Banco" style="width: 100%;" cellspacing="0">
                                                            <thead>
                                                                <tr>
                                                                    <th>Numero</th>
                                                                    <th>Valor</th>
                                                                    <th>N.- Dep</th>
                                                                    <th>N.- Cuenta</th>
                                                                    <th>Banco</th>
                                                                    <th>N.- Caja</th>
                                                                    <th>Usuario</th>
                                                                    <th>Estado</th>
                                                                    <th>Opciones</th>
                                                                </tr>
                                                            </thead>

                                                        </table>
                                                    <?php
                                                    } else {
                                                    ?>

                                                        <table class="table table-bordered table-hover" id="tbl_lista_Banco" style="width: 100%;" cellspacing="0">
                                                            <thead>
                                                                <tr>
                                                                    <th>Numero</th>
                                                                    <th>Valor</th>
                                                                    <th>N.- Dep</th>
                                                                    <th>N.- Cuenta</th>
                                                                    <th>Banco</th>
                                                                    <th>N.- Caja</th>
                                                                    <th>Usuario</th>
                                                                    <th>Estado</th>
                                                                    <th>Opciones</th>
                                                                </tr>
                                                            </thead>

                                                        </table>
                                                    <?php
                                                    }
                                                    ?>

                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div id="idenviadas" style="display: none;">
                                                    <br>
                                                    <?php
                                                    if ($Typeusuario != 4) {
                                                    ?>
                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_enviado">
                                                            <i class="fa fa-book"></i> Nuevo Ingreso
                                                        </button>
                                                        <hr>
                                                        <table class="table table-bordered table-hover" id="tbl_lista_enviado" style="width: 100%;" cellspacing="0">
                                                            <thead>
                                                                <tr>
                                                                    <th>Numero</th>
                                                                    <th>Valor</th>
                                                                    <th>N.- Cuenta</th>
                                                                    <th>Banco</th>
                                                                    <th>N.- Caja</th>
                                                                    <th>Cuenta Destino</th>
                                                                    <th>Banco Destino</th>
                                                                    <th>Numero Comprobante</th>
                                                                    <th>Usuario</th>
                                                                    <th>Estado</th>
                                                                    <th>Opciones</th>
                                                                </tr>
                                                            </thead>

                                                        </table>
                                                    <?php
                                                    } else {
                                                    ?>

                                                        <table class="table table-bordered table-hover" id="tbl_lista_enviado" style="width: 100%;" cellspacing="0">
                                                            <thead>
                                                                <tr>
                                                                    <th>Numero</th>
                                                                    <th>Valor</th>
                                                                    <th>N.- Cuenta</th>
                                                                    <th>Banco</th>
                                                                    <th>N.- Caja</th>
                                                                    <th>Cuenta Destino</th>
                                                                    <th>Banco Destino</th>
                                                                    <th>Numero Comprobante</th>
                                                                    <th>Usuario</th>
                                                                    <th>Estado</th>
                                                                    <th>Opciones</th>
                                                                </tr>
                                                            </thead>

                                                        </table>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div id="recibidas" style="display: none;">
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
                                                                    <th>N.- Cuenta</th>
                                                                    <th>N.- Comprobante</th>
                                                                    <th>Usuario</th>
                                                                    <th>Estado</th>
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
                                                                    <th>N.- Cuenta</th>
                                                                    <th>N.- Comprobante</th>
                                                                    <th>Usuario</th>
                                                                    <th>Estado</th>
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
                                <h5 class="modal-title" id="exampleModalLabel">INGRESO RECIBIDOS</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-3 col-sm-3">
                                        <label>Valor</label>
                                        <input type="text" id="txtvalor_recibido" class="form-control" placeholder="Ingrese el valor">
                                    </div>
                                    <div class="col-3 col-sm-3">
                                        <label>Descripcion</label>
                                        <textarea id="txtdescripcion" cols="20" rows="5"></textarea>
                                    </div>
                                    <div class="col-3 col-sm-3">
                                        <label>N.- Cuenta</label>
                                        <select id="slncuenta_recibido" class="form-control">
                                            <?php
                                            while ($row_recibido = $resultresibido->fetch_assoc()) {
                                            ?>
                                                <option value="<?= $row_recibido['Id'] ?>"><?= $row_recibido['Nombre_plataforma'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-5 col-sm-5">
                                        <label>N.- Comprobante</label>
                                        <input type="text" id="txtconprobante_recibdo" class="form-control" placeholder="Ingrese el numero de comprobante">
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
                                <h5 class="modal-title" id="exampleModalLabel">EDITAR RECIBIDOS</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-3 col-sm-3">
                                        <label>Valor</label>
                                        <input type="hidden" id="txtidrecibodo">
                                        <input type="text" id="txtvalor_recibido_E" class="form-control" placeholder="Ingrese el valor">
                                    </div>
                                    <div class="col-3 col-sm-3">
                                        <label>Descripcion</label>
                                        <textarea id="txtdescripcion_E" cols="20" rows="5"></textarea>
                                    </div>
                                    <div class="col-3 col-sm-3">
                                        <label>N.- Cuenta</label>
                                        <select id="slncuenta_recibido_E" class="form-control">
                                            <?php
                                            while ($row_recibido_E = $resultresibido_E->fetch_assoc()) {
                                            ?>
                                                <option value="<?= $row_recibido_E['Id'] ?>"><?= $row_recibido_E['Nombre_plataforma'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-5 col-sm-5">
                                        <label>N.- Comprobante</label>
                                        <input type="text" id="txtconprobante_recibdo_E" class="form-control" placeholder="Ingrese el numero de comprobante">
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
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Editar</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


            <!-- MODAL ENVIADOOOOOO  -->
            <div class="modal fade" id="modal_enviado" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
                data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-lg">
                    <form id="ing_enviado">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">INGRESO ENVIADOS - COMPRAS CUPOS</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-3 col-sm-3">
                                        <label>Valor</label>
                                        <input type="text" id="txtvalor_enviado" class="form-control" placeholder="Ingrese el valor">
                                    </div>
                                    <div class="col-3 col-sm-3">
                                        <label>N.- Cuenta</label>
                                        <select id="slncuenta_enviado" class="select2" data-dropdown-css-class="select2-purple" style="width: 100%;" multiple>
                                            <option value="0">Seleccione</option>
                                            <?php
                                            while ($row_Enviado = $resultenviados->fetch_assoc()) {
                                            ?>
                                                <option value="<?= $row_Enviado['Id'] ?>"><?= $row_Enviado['Nombre_plataforma'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-3 col-sm-3">
                                        <label>Banco</label>
                                        <select id="slbanco_enviado" class="form-control"></select>
                                    </div>
                                    <div class="col-4 col-sm-4">
                                        <label>N.- Caja</label>
                                        <input type="text" id="txtncaja_enviado" class="form-control" placeholder="Ingrese el numero de caja">
                                    </div>
                                    <div class="col-3 col-sm-3">
                                        <label>Cuenta Destino</label>
                                        <select id="slncuenta_enviado_Destino" class="select2" data-dropdown-css-class="select2-purple" style="width: 100%;" multiple>
                                            <option value="">Seleccione</option>
                                            <?php
                                            while ($row_Enviado1 = $resultenviados1->fetch_assoc()) {
                                            ?>
                                                <option value="<?= $row_Enviado1['Id'] ?>"><?= $row_Enviado1['Nombre_plataforma'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-3 col-sm-3">
                                        <label>Banco Destino</label>
                                        <select id="slbancodestino_enviado" class="form-control"></select>
                                    </div>
                                    <div class="col-4 col-sm-4">
                                        <label>N. Comprobante</label>
                                        <input type="text" id="txtcomprobante" class="form-control" placeholder="Numero de comprobante">
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
            <!-- MODAL ENVIADOOOOOO EDITAR -->
            <div class="modal fade" id="modal_enviado_E" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
                data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-lg">
                    <form id="edit_enviado">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">EDITAR ENVIADOS - COMPRAS CUPOS</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-3 col-sm-3">
                                        <label>Valor</label>
                                        <input type="hidden" id="txtidenviadoss">
                                        <input type="text" id="txtvalor_enviado_E" class="form-control" placeholder="Ingrese el valor">
                                    </div>
                                    <div class="col-3 col-sm-3">
                                        <label>N.- Cuenta</label>
                                        <select id="slncuenta_enviado_E" class="select2" data-dropdown-css-class="select2-purple" style="width: 100%;" multiple>
                                            <option value="">Seleccione</option>
                                            <?php
                                            while ($row_Enviado_E = $resultenviados_E->fetch_assoc()) {
                                            ?>
                                                <option value="<?= $row_Enviado_E['Id'] ?>"><?= $row_Enviado_E['Nombre_plataforma'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-3 col-sm-3">
                                        <label>Banco</label>
                                        <select id="slbanco_enviado_E" class="form-control"></select>
                                    </div>
                                    <div class="col-3 col-sm-3">
                                        <label>N.- Caja</label>
                                        <input type="text" id="txtncaja_enviado_E" class="form-control" placeholder="Ingrese el numero de caja">
                                    </div>
                                    <div class="col-3 col-sm-3">
                                        <label>Cuenta Destino</label>
                                        <select id="slncuenta_enviado_Destino_E" class="select2" data-dropdown-css-class="select2-purple" style="width: 100%;" multiple>
                                            <option value="">Seleccione</option>
                                            <?php
                                            while ($row_Enviado1_E = $resultenviados1_E->fetch_assoc()) {
                                            ?>
                                                <option value="<?= $row_Enviado1_E['Id'] ?>"><?= $row_Enviado1_E['Nombre_plataforma'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-3 col-sm-3">
                                        <label>Banco Destino</label>
                                        <select id="slbancoDestino_enviado_E" class="form-control"></select>
                                    </div>
                                    <div class="col-4 col-sm-4">
                                        <label>N. Comprobante</label>
                                        <input type="text" id="txtcomprobante_E" class="form-control" placeholder="Numero de comprobante">
                                    </div>
                                    <div class="col-3 col-sm-3">
                                        <label>Estado</label>
                                        <select id="slEstado_enviado_E" class="form-control">
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
                        </div>
                    </form>
                </div>
            </div>

            <!-- MODAL EFECTIVO -->
            <div class="modal fade" id="modal_efectivo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
                data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-lg">
                    <form id="ing_efectivo">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">INGRESO EN EFECTIVO</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-3 col-sm-3">
                                        <label>Valor</label>
                                        <input type="text" id="txtvalor" class="form-control" placeholder="Ingrese el valor">
                                    </div>
                                    <div class="col-3 col-sm-3">
                                        <label>N.- Dep</label>
                                        <input type="text" id="txtn_dep" class="form-control" placeholder="Ingrese el Deposito">
                                    </div>
                                    <div class="col-3 col-sm-3">
                                        <label>N.- Cuenta</label>
                                        <select id="slncuenta" class="select2" data-dropdown-css-class="select2-purple" style="width: 100%;" multiple>
                                            <option value="0">Seleccione</option>
                                            <?php
                                            while ($row_E = $resultPlata->fetch_assoc()) {
                                            ?>
                                                <option value="<?= $row_E['Id'] ?>"><?= $row_E['Nombre_plataforma'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-3 col-sm-3">
                                        <label>Banco</label>
                                        <select id="slbanco" class="form-control"></select>
                                    </div>
                                    <div class="col-4 col-sm-4">
                                        <label>N.- Caja</label>
                                        <input type="text" id="txtncaja" class="form-control" placeholder="Ingrese el numero de caja">
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

            <!-- MODAL EFECTIVO EDITAR -->
            <div class="modal fade" id="modal_efectivo_E" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
                data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-lg">
                    <form id="edit_efectivo">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">EDITAR EN EFECTIVO</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-3 col-sm-3">
                                        <label>Valor</label>
                                        <input type="hidden" id="txtidefectivo">
                                        <input type="text" id="txtvalor_E" class="form-control" placeholder="Ingrese el valor">
                                    </div>
                                    <div class="col-3 col-sm-3">
                                        <label>N.- Dep</label>
                                        <input type="text" id="txtn_dep_E" class="form-control" placeholder="Ingrese el Deposito">
                                    </div>
                                    <div class="col-3 col-sm-3">
                                        <label>N.- Cuenta</label>
                                        <select id="slncuenta_E" class="select2" data-dropdown-css-class="select2-purple" style="width: 100%;" multiple>
                                            <option value="">Seleccione</option>
                                            <?php
                                            while ($row_E_E = $resultPlata_E->fetch_assoc()) {
                                            ?>
                                                <option value="<?= $row_E_E['Id'] ?>"><?= $row_E_E['Nombre_plataforma'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-3 col-sm-3">
                                        <label>Banco</label>
                                        <select id="slbanco_E" class="form-control"></select>
                                    </div>
                                    <div class="col-4 col-sm-4">
                                        <label>N.- Caja</label>
                                        <input type="text" id="txtncaja_E" class="form-control" placeholder="Ingrese el numero de caja">
                                    </div>
                                    <div class="col-4 col-sm-4">
                                        <label>Estado</label>
                                        <select id="slestado_efectivo" class="form-control">
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
                $(document).ready(function() {
                    listar_depositos();
                    listar_enviados();
                    listar_recibidos();

                    $('#modal_efectivo').on('shown.bs.modal', function() {
                        if (!$.fn.select2) {
                            console.error('Select2 not loaded');
                            return;
                        }

                        if (!$('#slncuenta').hasClass('select2-hidden-accessible')) {
                            $('#slncuenta').select2({
                                dropdownParent: $('#modal_efectivo'),
                                maximumSelectionLength: 1,
                                allowClear: true,
                                width: '100%',
                                theme: "classic"
                            });
                        }
                    });


                    $('#modal_efectivo_E').on('shown.bs.modal', function() {
                        if (!$.fn.select2) {
                            console.error('Select2 not loaded');
                            return;
                        }

                        if (!$('#slncuenta_E').hasClass('select2-hidden-accessible')) {
                            $('#slncuenta_E').select2({
                                dropdownParent: $('#modal_efectivo_E'),
                                maximumSelectionLength: 1,
                                allowClear: true,
                                width: '100%',
                                theme: "classic"
                            });
                        }
                    });



                    $('#modal_enviado_E').on('shown.bs.modal', function() {
                        if (!$.fn.select2) {
                            console.error('Select2 not loaded');
                            return;
                        }

                        if (!$('#slncuenta_enviado_E').hasClass('select2-hidden-accessible')) {
                            $('#slncuenta_enviado_E').select2({
                                dropdownParent: $('#modal_enviado_E'),
                                maximumSelectionLength: 1,
                                allowClear: true,
                                width: '100%',
                                theme: "classic"
                            });
                        }

                        if (!$('#slncuenta_enviado_Destino_E').hasClass('select2-hidden-accessible')) {
                            $('#slncuenta_enviado_Destino_E').select2({
                                dropdownParent: $('#modal_enviado_E'),
                                maximumSelectionLength: 1,
                                allowClear: true,
                                width: '100%',
                                theme: "classic"
                            });
                        }
                    });
                    $('#modal_enviado').on('shown.bs.modal', function() {
                        if (!$.fn.select2) {
                            console.error('Select2 not loaded');
                            return;
                        }

                        if (!$('#slncuenta_enviado').hasClass('select2-hidden-accessible')) {
                            $('#slncuenta_enviado').select2({
                                dropdownParent: $('#modal_enviado'),
                                maximumSelectionLength: 1,
                                allowClear: true,
                                width: '100%',
                                theme: "classic"
                            });
                        }

                        if (!$('#slncuenta_enviado_Destino').hasClass('select2-hidden-accessible')) {
                            $('#slncuenta_enviado_Destino').select2({
                                dropdownParent: $('#modal_enviado'),
                                maximumSelectionLength: 1,
                                allowClear: true,
                                width: '100%',
                                theme: "classic"
                            });
                        }
                    });





                    $("#edit_recibido").submit(function(e) {
                        e.preventDefault();
                        var txtidrecibodo = $("#txtidrecibodo").val();
                        var txtvalor_recibido_E = $("#txtvalor_recibido_E").val();
                        var txtdescripcion_E = $("#txtdescripcion_E").val();
                        var slncuenta_recibido_E = $("#slncuenta_recibido_E").val();
                        var txtconprobante_recibdo_E = $("#txtconprobante_recibdo_E").val();
                        var slEstado_recibido_E = $("#slEstado_recibido_E").val();
                        if (txtvalor_recibido_E == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Ingrese el Valor",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (txtdescripcion_E == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Ingrese la Descripcion",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (txtconprobante_recibdo_E == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Ingrese el comprobante",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (slEstado_recibido_E == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Seleccione el Estado",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else {
                            $("#loader_div").show();
                            $.ajax({
                                type: "POST",
                                dataType: "json",
                                url: 'recibidos/ajax_editar.php',
                                data: {
                                    txtidrecibodo: txtidrecibodo,
                                    txtvalor_recibido_E: txtvalor_recibido_E,
                                    txtdescripcion_E: txtdescripcion_E,
                                    slncuenta_recibido_E: slncuenta_recibido_E,
                                    txtconprobante_recibdo_E: txtconprobante_recibdo_E,
                                    slEstado_recibido_E: slEstado_recibido_E
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
                        var slncuenta_recibido = $("#slncuenta_recibido").val();
                        var txtconprobante_recibdo = $("#txtconprobante_recibdo").val();
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
                                title: "Ingrese la descripcion",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (slncuenta_recibido == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Seleccione la Cuenta ",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (txtconprobante_recibdo == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Ingrese el N.- comprobante",
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

                    });



                    $("#edit_enviado").submit(function(e) {
                        e.preventDefault();
                        var txtidenviadoss = $("#txtidenviadoss").val();
                        var txtvalor_enviado_E = $("#txtvalor_enviado_E").val();
                        var slncuenta_enviado_E = $("#slncuenta_enviado_E").val();
                        var slbanco_enviado_E = $("#slbanco_enviado_E").val();
                        var txtncaja_enviado_E = $("#txtncaja_enviado_E").val();
                        var slncuenta_enviado_Destino_E = $("#slncuenta_enviado_Destino_E").val();
                        var slEstado_enviado_E = $("#slEstado_enviado_E").val();
                        var slbancoDestino_enviado_E = $("#slbancoDestino_enviado_E").val();
                        var txtcomprobante_E = $("#txtcomprobante_E").val();
                        if (txtvalor_enviado_E == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Ingrese el Valor",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (slncuenta_enviado_E == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Seleccione el  N.- Cuenta ",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (slbanco_enviado_E == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Seleccione el Banco ",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (txtncaja_enviado_E == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Ingrese el N.- Caja",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (slncuenta_enviado_Destino_E == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Seleccione La cuenta Destino ",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (slbancoDestino_enviado_E == 0) {
                            Swal.fire({
                                icon: 'warning',
                                title: "Seleccione el Banco ",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (slbancoDestino_enviado_E == 'N') {
                            Swal.fire({
                                icon: 'warning',
                                title: "No hay bancos disponibles",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (txtcomprobante_E == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Ingrese el Numero de Comprobante ",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (slEstado_enviado_E == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Seleccione el Estado ",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else {
                            $("#loader_div").show();
                            $.ajax({
                                type: "POST",
                                dataType: "json",
                                url: 'enviados/ajax_editar.php',
                                data: {
                                    txtidenviadoss: txtidenviadoss,
                                    txtvalor_enviado_E: txtvalor_enviado_E,
                                    slncuenta_enviado_E: slncuenta_enviado_E,
                                    slbanco_enviado_E: slbanco_enviado_E,
                                    txtncaja_enviado_E: txtncaja_enviado_E,
                                    slncuenta_enviado_Destino_E: slncuenta_enviado_Destino_E,
                                    slEstado_enviado_E: slEstado_enviado_E,
                                    slbancoDestino_enviado_E: slbancoDestino_enviado_E,
                                    txtcomprobante_E: txtcomprobante_E
                                },
                                success: function(data) {
                                    if (data.success) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: data.success,
                                            showConfirmButton: false,
                                            timer: 2000
                                        })
                                        listar_enviados();
                                        $("#modal_enviado_E").modal('hide');
                                        $("#loader_div").hide();
                                    }

                                },
                                error: function(jqXHR, exception) {
                                    console.log(jqXHR.responseText);
                                },
                            });
                        }

                    });


                    $("#ing_enviado").submit(function(e) {
                        e.preventDefault();
                        var txtvalor_enviado = $("#txtvalor_enviado").val();
                        var slncuenta_enviado = $("#slncuenta_enviado").val();
                        var slbanco_enviado = $("#slbanco_enviado").val();
                        var txtncaja_enviado = $("#txtncaja_enviado").val();
                        var slncuenta_enviado_Destino = $("#slncuenta_enviado_Destino").val();
                        var slbancodestino_enviado = $("#slbancodestino_enviado").val();
                        var txtcomprobante = $("#txtcomprobante").val();
                        if (txtvalor_enviado == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Ingrese el Valor",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (slncuenta_enviado == 0) {
                            Swal.fire({
                                icon: 'warning',
                                title: "Seleccione la cuenta",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (slbanco_enviado == 0) {
                            Swal.fire({
                                icon: 'warning',
                                title: "Seleccione el Banco ",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (slbanco_enviado == 'N') {
                            Swal.fire({
                                icon: 'warning',
                                title: "No hay bancos disponibles",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (txtncaja_enviado == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Ingrese el N.- Caja",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (slncuenta_enviado_Destino == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Seleccione la cuenta Destino",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (slbancodestino_enviado == 0) {
                            Swal.fire({
                                icon: 'warning',
                                title: "Seleccione el Banco",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (slbancodestino_enviado == 'N') {
                            Swal.fire({
                                icon: 'warning',
                                title: "No hay bancos disponibles",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (txtcomprobante == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Ingrese el Numero de Comprobante",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else {
                            $("#loader_div").show();
                            $.ajax({
                                type: "POST",
                                dataType: "json",
                                url: 'enviados/ajax_nuevo.php',
                                data: {
                                    txtvalor_enviado: txtvalor_enviado,
                                    slncuenta_enviado: slncuenta_enviado,
                                    slbanco_enviado: slbanco_enviado,
                                    txtncaja_enviado: txtncaja_enviado,
                                    slncuenta_enviado_Destino: slncuenta_enviado_Destino,
                                    slbancodestino_enviado: slbancodestino_enviado,
                                    txtcomprobante: txtcomprobante
                                },
                                success: function(data) {
                                    if (data.success) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: data.success,
                                            showConfirmButton: false,
                                            timer: 2000
                                        })
                                        listar_enviados();
                                        $("#txtvalor_enviado").val('');
                                        $("#txtncaja_enviado").val('');
                                        $("#loader_div").hide();
                                    }

                                },
                                error: function(jqXHR, exception) {
                                    console.log(jqXHR.responseText);
                                },
                            });
                        }

                    });


                    $("#edit_efectivo").submit(function(e) {
                        e.preventDefault();
                        var txtidefectivo = $("#txtidefectivo").val();
                        var txtvalor_E = $("#txtvalor_E").val();
                        var txtn_dep_E = $("#txtn_dep_E").val();
                        var slncuenta_E = $("#slncuenta_E").val();
                        var slbanco_E = $("#slbanco_E").val();
                        var txtncaja_E = $("#txtncaja_E").val();
                        var slestado_efectivo = $("#slestado_efectivo").val();
                        if (txtvalor_E == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Ingrese el Valor",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (txtn_dep_E == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Ingrese el Valor N.- Dep",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (slncuenta_E == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Seleccione el  N.- Cuenta ",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (slbanco_E == 0) {
                            Swal.fire({
                                icon: 'warning',
                                title: "Seleccione el Banco ",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (slbanco_E == 'N') {
                            Swal.fire({
                                icon: 'warning',
                                title: "No hay bancos disponibles",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (txtncaja_E == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Ingrese el N.- Caja",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else {
                            $("#loader_div").show();
                            $.ajax({
                                type: "POST",
                                dataType: "json",
                                url: 'registro/ajax_editar.php',
                                data: {
                                    txtidefectivo: txtidefectivo,
                                    txtvalor_E: txtvalor_E,
                                    txtn_dep_E: txtn_dep_E,
                                    slncuenta_E: slncuenta_E,
                                    slbanco_E: slbanco_E,
                                    txtncaja_E: txtncaja_E,
                                    slestado_efectivo: slestado_efectivo
                                },
                                success: function(data) {
                                    if (data.success) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: data.success,
                                            showConfirmButton: false,
                                            timer: 2000
                                        })
                                        listar_depositos();
                                        $("#modal_efectivo_E").modal('hide');
                                        $("#loader_div").hide();
                                    }

                                },
                                error: function(jqXHR, exception) {
                                    console.log(jqXHR.responseText);
                                },
                            });
                        }

                    });


                    $("#ing_efectivo").submit(function(e) {
                        e.preventDefault();
                        var txtvalor = $("#txtvalor").val();
                        var txtn_dep = $("#txtn_dep").val();
                        var slncuenta = $("#slncuenta").val();
                        var slbanco = $("#slbanco").val();
                        var txtncaja = $("#txtncaja").val();
                        if (txtvalor == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Ingrese el Valor",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (txtn_dep == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Ingrese el Valor N.- Dep",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (slncuenta == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Seleccione el  N.- Cuenta ",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (slbanco == 0) {
                            Swal.fire({
                                icon: 'warning',
                                title: "Seleccione el Banco ",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (slbanco == 'N') {
                            Swal.fire({
                                icon: 'warning',
                                title: "No hay bancos disponibles",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (txtncaja == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Ingrese el N.- Caja",
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
                                    txtvalor: txtvalor,
                                    txtn_dep: txtn_dep,
                                    slncuenta: slncuenta,
                                    slbanco: slbanco,
                                    txtncaja: txtncaja
                                },
                                success: function(data) {
                                    if (data.success) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: data.success,
                                            showConfirmButton: false,
                                            timer: 2000
                                        })
                                        listar_depositos();
                                        $("#txtvalor").val('');
                                        $("#txtn_dep").val('');
                                        $("#txtncaja").val('');
                                        $("#loader_div").hide();
                                    }

                                },
                                error: function(jqXHR, exception) {
                                    console.log(jqXHR.responseText);
                                },
                            });
                        }

                    });
                    document.getElementById("txtvalor_enviado_E").addEventListener("input", function() {
                        this.value = this.value
                            .replace(/[^0-9.]/g, '')
                            .replace(/(\..*?)\..*/g, '$1');
                    });

                    document.getElementById("txtvalor_enviado").addEventListener("input", function() {
                        this.value = this.value
                            .replace(/[^0-9.]/g, '')
                            .replace(/(\..*?)\..*/g, '$1');
                    });

                    document.getElementById("txtvalor_recibido").addEventListener("input", function() {
                        this.value = this.value
                            .replace(/[^0-9.]/g, '')
                            .replace(/(\..*?)\..*/g, '$1');
                    });

                    document.getElementById("txtvalor").addEventListener("input", function() {
                        this.value = this.value
                            .replace(/[^0-9.]/g, '')
                            .replace(/(\..*?)\..*/g, '$1');
                    });
                    document.getElementById("txtn_dep").addEventListener("input", function() {
                        this.value = this.value.replace(/\D/g, '');
                    });

                    document.getElementById("txtvalor_E").addEventListener("input", function() {
                        this.value = this.value
                            .replace(/[^0-9.]/g, '')
                            .replace(/(\..*?)\..*/g, '$1');
                    });
                    document.getElementById("txtn_dep_E").addEventListener("input", function() {
                        this.value = this.value.replace(/\D/g, '');
                    });
                    $('#sl_option').on('change', function() {
                        var Idopcion = $(this).val();
                        if (Idopcion == 0) {
                            $("#idefectivo").hide();
                            $("#idTranferecia").hide();
                            $("#idenviadas").hide();
                            $("#recibidas").hide();

                        } else if (Idopcion == 1) {
                            $("#idefectivo").show();
                            $("#idTranferecia").hide();
                            $("#idenviadas").hide();
                            $("#recibidas").hide();

                        } else if (Idopcion == 2) {
                            $("#idefectivo").hide();
                            $("#idTranferecia").show();
                            $("#idenviadas").hide();
                            $("#recibidas").hide();

                        }
                    });

                    $('#sl_opciones').on('change', function() {
                        var Idopciones = $(this).val();
                        if (Idopciones == 0) {
                            $("#idenviadas").hide();
                            $("#recibidas").hide();
                        } else if (Idopciones == 1) {
                            $("#idenviadas").show();
                            $("#recibidas").hide();
                        } else if (Idopciones == 2) {
                            $("#idenviadas").hide();
                            $("#recibidas").show();

                        }
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



                function listar_enviados() {
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: 'enviados/ajax_listar.php',
                        data: {},
                        success: function(data) {
                            cargar_lista_enviados(data);
                        },
                        error: function(jqXHR, exception) {
                            console.log(jqXHR.responseText);
                        },
                    });
                }


                function listar_depositos() {
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: 'registro/ajax_listar.php',
                        data: {},
                        success: function(data) {
                            cargar_lista_Banco(data);
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
                        $("#modal_recibido_E").modal('show');
                        txtidrecibodo = $("#txtidrecibodo").val(data.Id);
                        txtvalor_recibido_E = $("#txtvalor_recibido_E").val(data.Valor);
                        txtdescripcion_E = $("#txtdescripcion_E").val(data.Descripcion);
                        slncuenta_recibido_E = $("#slncuenta_recibido_E").val(data.IdPlataforma);
                        txtconprobante_recibdo_E = $("#txtconprobante_recibdo_E").val(data.N_Comprobante);
                        slEstado_recibido_E = $("#slEstado_recibido_E").val(data.Estado);
                    });
                }





                function cargar_lista_enviados(data) {
                    var table = $('#tbl_lista_enviado').DataTable();
                    table.destroy();
                    table.clear();
                    $('#tbl_lista_enviado').dataTable({
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
                                "data": "Numero"
                            },
                            {
                                "data": "Valor"
                            },

                            {
                                "data": "Nombre_plataforma"
                            },
                            {
                                "data": "Nombre"
                            },
                            {
                                "data": "N_caja"
                            },
                            {
                                "data": "PlataformaDestino"
                            },
                            {
                                "data": "BancoDestino"
                            },
                            {
                                "data": "Comprobante"
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
                    $('#tbl_lista_enviado tbody').on('click', 'button.eliminar', function() {
                        event.preventDefault();
                        var table = $('#tbl_lista_enviado').DataTable();
                        var data = table.row($(this).parents('tr')).data();
                        var estado = $(this).parents("tr").find('#spEstado');
                        var idBancoEliminar = data.Id;
                        console.log(idBancoEliminar);
                        Swal.fire({
                            title: "Estas Seguro ?",
                            text: "De eliminar esta Transferencia !",
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
                                    url: 'enviados/ajax_eliminar.php',
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
                                            listar_enviados();
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
                    $('#tbl_lista_enviado tbody').on('click', 'button.editar', function() {
                        event.preventDefault();
                        var table = $('#tbl_lista_enviado').DataTable();
                        var data = table.row($(this).parents('tr')).data();
                        var estado = $(this).parents("tr").find('#spEstado');
                        $("#modal_enviado_E").modal('show');
                        txtidenviadoss = $("#txtidenviadoss").val(data.Id);
                        txtvalor_enviado_E = $("#txtvalor_enviado_E").val(data.Valor);
                        //slncuenta_enviado_E = $("#slncuenta_enviado_E").val(data.IdPlataforma);
                        slbanco_enviado_E = $("#slbanco_enviado_E").val(data.IdBanco);
                        txtncaja_enviado_E = $("#txtncaja_enviado_E").val(data.N_caja);
                        //slncuenta_enviado_Destino_E = $("#slncuenta_enviado_Destino_E").val(data.IdPlataforma2);
                        slEstado_enviado_E = $("#slEstado_enviado_E").val(data.Estado);
                        txtcomprobante_E = $("#txtcomprobante_E").val(data.Comprobante);
                    });
                }


                function cargar_lista_Banco(data) {
                    var table = $('#tbl_lista_Banco').DataTable();
                    table.destroy();
                    table.clear();
                    $('#tbl_lista_Banco').dataTable({
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
                                "data": "Numero"
                            },
                            {
                                "data": "Valor"
                            },
                            {
                                "data": "N_Dep"
                            },
                            {
                                "data": "Nombre_plataforma"
                            },
                            {
                                "data": "Nombre"
                            },
                            {
                                "data": "N_caja"
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
                    $('#tbl_lista_Banco tbody').on('click', 'button.eliminar', function() {
                        event.preventDefault();
                        var table = $('#tbl_lista_Banco').DataTable();
                        var data = table.row($(this).parents('tr')).data();
                        var estado = $(this).parents("tr").find('#spEstado');
                        var idBancoEliminar = data.Id;
                        console.log(idBancoEliminar);
                        Swal.fire({
                            title: "Estas Seguro ?",
                            text: "De eliminar este Deposito !",
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
                                            listar_depositos();
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
                    $('#tbl_lista_Banco tbody').on('click', 'button.editar', function() {
                        event.preventDefault();
                        var table = $('#tbl_lista_Banco').DataTable();
                        var data = table.row($(this).parents('tr')).data();
                        var estado = $(this).parents("tr").find('#spEstado');
                        $("#modal_efectivo_E").modal('show');
                        txtidefectivo = $("#txtidefectivo").val(data.Id);
                        txtvalor_E = $("#txtvalor_E").val(data.Valor);
                        txtn_dep_E = $("#txtn_dep_E").val(data.N_Dep);
                        //slncuenta_E = $("#slncuenta_E").val(data.IdPlataforma);
                        slbanco_E = $("#slbanco_E").val(data.IdBanco);
                        txtncaja_E = $("#txtncaja_E").val(data.N_caja);
                        slestado_efectivo = $("#slestado_efectivo").val(data.Estado);

                    });
                }
                $('#sl_option').on('change', function() {
                    setTimeout(function() {
                        $('#tbl_lista_Banco').DataTable().columns.adjust().responsive.recalc();
                    }, 100);
                });

                $('#sl_opciones').on('change', function() {
                    setTimeout(function() {
                        $('#tbl_lista_enviado').DataTable().columns.adjust().responsive.recalc();
                    }, 100);
                });

                $('#sl_opciones').on('change', function() {
                    setTimeout(function() {
                        $('#tbl_lista_recibido').DataTable().columns.adjust().responsive.recalc();
                    }, 100);
                });


                // CAARGAR EN EFECTIVO LOS BANCOS
                $('#slncuenta').on('change', function() {
                    var idPlataforma = $(this).val();

                    // Validación por si no selecciona nada
                    if (idPlataforma == "0") {
                        $('#slbanco').html('<option value="0">Seleccione un banco</option>');
                        return;
                    }

                    $.ajax({
                        url: 'registro/get_bancos.php',
                        type: 'POST',
                        data: {
                            idPlataforma: idPlataforma
                        },
                        success: function(data) {
                            console.log(data);
                            $('#slbanco').html(data);
                        }
                    });
                });

                // CAARGAR EN EFECTIVO LOS BANCOS AL EDITAR
                $('#slncuenta_E').on('change', function() {
                    var idPlataforma = $(this).val();

                    // Validación por si no selecciona nada
                    if (idPlataforma == "0") {
                        $('#slbanco_E').html('<option value="0">Seleccione un banco</option>');
                        return;
                    }

                    $.ajax({
                        url: 'registro/get_bancos_Editar.php',
                        type: 'POST',
                        data: {
                            idPlataforma: idPlataforma
                        },
                        success: function(data) {
                            console.log(data);
                            $('#slbanco_E').html(data);
                        }
                    });
                });

                //onche slncuenta_enviado
                $('#slncuenta_enviado').on('change', function() {
                    var idPlataforma = $(this).val();

                    // Validación por si no selecciona nada
                    if (idPlataforma == "0") {
                        $('#slbanco_enviado').html('<option value="0">Seleccione un banco</option>');
                        return;
                    }

                    $.ajax({
                        url: 'enviados/get_bancos.php',
                        type: 'POST',
                        data: {
                            idPlataforma: idPlataforma
                        },
                        success: function(data) {
                            console.log(data);
                            $('#slbanco_enviado').html(data);
                        }
                    });
                });

                $('#slncuenta_enviado_Destino').on('change', function() {
                    var idPlataforma = $(this).val();

                    // Validación por si no selecciona nada
                    if (idPlataforma == "0") {
                        $('#slbancodestino_enviado').html('<option value="0">Seleccione un banco</option>');
                        return;
                    }

                    $.ajax({
                        url: 'enviados/get_bancosDestino.php',
                        type: 'POST',
                        data: {
                            idPlataforma: idPlataforma
                        },
                        success: function(data) {
                            console.log(data);
                            $('#slbancodestino_enviado').html(data);
                        }
                    });
                });

                $('#slncuenta_enviado_E').on('change', function() {
                    var idPlataforma = $(this).val();

                    // Validación por si no selecciona nada
                    if (idPlataforma == "0") {
                        $('#slbanco_enviado_E').html('<option value="0">Seleccione un banco</option>');
                        return;
                    }

                    $.ajax({
                        url: 'enviados/get_bancos_Editar.php',
                        type: 'POST',
                        data: {
                            idPlataforma: idPlataforma
                        },
                        success: function(data) {
                            console.log(data);
                            $('#slbanco_enviado_E').html(data);
                        }
                    });
                });



                $('#slncuenta_enviado_Destino_E').on('change', function() {
                    var idPlataforma = $(this).val();

                    // Validación por si no selecciona nada
                    if (idPlataforma == "0") {
                        $('#slbancoDestino_enviado_E').html('<option value="0">Seleccione un banco</option>');
                        return;
                    }

                    $.ajax({
                        url: 'enviados/get_bancosDestino_Editar.php',
                        type: 'POST',
                        data: {
                            idPlataforma: idPlataforma
                        },
                        success: function(data) {
                            console.log(data);
                            $('#slbancoDestino_enviado_E').html(data);
                        }
                    });
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
