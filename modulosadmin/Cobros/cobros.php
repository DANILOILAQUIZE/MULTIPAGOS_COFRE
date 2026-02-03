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
        $sqlcaja = "SELECT IdCaja FROM conteo_monedas WHERE Estado_caja = '0' and IdUsuario = '$idUser'";
        $result1 =  $conec->query($sqlcaja);
        while ($fila = mysqli_fetch_array($result1)) {
            $IdCaja = $fila['IdCaja'];
        }

        $sql = "SELECT
    g.Usuario AS Usuario,
    s.Nombre AS Sucursal,
    ca.Nombre AS Caja,
    (
        c.B_100 * 100 + c.B_50 * 50 + c.B_20 * 20 + c.B_10 * 10 + c.B_5 * 5 + c.B_2 * 2 + c.B_1 * 1 + c.M_1 * 1 + c.M_050 * 0.50 + c.M_025 * 0.25 + c.M_010 * 0.10 + c.M_005 * 0.05 + c.M_001 * 0.01
    ) AS Total_general,
    (SELECT GROUP_CONCAT(p.Plataforma SEPARATOR ',') AS Plataformas FROM asignacion_cajas a INNER JOIN plataforma_usuario p ON FIND_IN_SET(p.Id, a.IdPlataforma) WHERE a.IdCaja = '$IdCaja' AND a.Estado = '0')AS Usuarios
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
        $result =  $conec->query($sql);
        while ($fila = mysqli_fetch_array($result)) {
            $usuario = $fila['Usuario'];
            $sucursal = $fila['Sucursal'];
            $Caja = $fila['Caja'];
            $Total_general = $fila['Total_general'];
            $platadormas = $fila['Usuarios'];
        }

        //Consultas
        $sql_Plataforma1 = "SELECT MIN(Id) AS Id, Plataforma FROM plataforma_usuario WHERE Estado = '0' GROUP BY Plataforma ORDER BY `Id` ASC ";
        $result_plataforma1 =  $conec->query($sql_Plataforma1);

        // $sql_productos = "SELECT Id,Producto FROM productos WHERE Estado = '0'";
        // $result_productos =  $conec->query($sql_productos);

        $optionsPlataforma = "";
        $sql_Plataforma = "SELECT MIN(Id) AS Id, Plataforma FROM plataforma_usuario WHERE Estado = '0' GROUP BY Plataforma ORDER BY `Id` ASC ";
        $result_plataforma =  $conec->query($sql_Plataforma);
        while ($filaPla = $result_plataforma->fetch_assoc()) {
            $optionsPlataforma .= '<option value="' . $filaPla['Id'] . '">' . $filaPla['Plataforma'] . '</option>';
        }

        $optionsProducto = "";
        $sql_productos = "SELECT Id,Producto FROM productos WHERE Estado = '0'";
        $result_productos =  $conec->query($sql_productos);
        while ($filaPro = $result_productos->fetch_assoc()) {
            $optionsProducto .= '<option value="' . $filaPro['Id'] . '">' . $filaPro['Producto'] . '</option>';
        }

?>

        <!DOCTYPE html>
        <html lang="es">

        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="icon" type="image/png" href="../../img/multipagos.jpg" />
            <title>Venta - Recaudacion</title>

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
            <style>
                .modal-dialog.modal-fullscreen {
                    width: 100vw;
                    max-width: 100vw;
                    height: 100vh;
                    margin: 0;
                    padding: 0;
                    max-height: 100vh;
                }

                #modal_completar_Productos .modal-dialog {
                    max-width: 500px;
                    margin: 1.5rem auto;
                    /* centra horizontal, y margen vertical menor */
                    height: auto;
                    /* deja que el alto sea dinámico */
                }

                #modal_completar_Productos .modal-content {
                    display: flex;
                    flex-direction: column;
                    height: 80vh;
                    /* ocupa hasta 80% alto pantalla */
                    border-radius: 0.3rem;
                }

                #modal_completar_Productos .modal-body {
                    flex-grow: 1;
                    overflow-y: auto;
                    padding: 0.5rem 1rem;
                    max-height: none;
                }

                #modal_completar_Productos .modal-header,
                #modal_completar_Productos .modal-footer {
                    padding: 0.5rem 1rem;
                    flex-shrink: 0;
                }

                .modal-content {
                    height: 100vh;
                    border: 0;
                    border-radius: 0;
                }

                .modal-body {
                    overflow-y: auto;
                    height: calc(100vh - 120px);
                    /* Ajusta según header + footer */
                }

                .btn+.btn {
                    margin-left: 8px;
                    /* o el espacio que quieras */
                }
            </style>
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
                                <div class="col-sm-12">
                                    <?php
                                    if ($_SESSION['type'] == '4') {
                                    ?>
                                        <h1>SUPERVISOR</h1>
                                    <?php
                                    } else {
                                    ?>
                                        <h1><strong>Usuario :</strong> <?= $usuario ?> - <?= $sucursal ?> - <?= $Caja ?> - <strong>Inicia la caja con :</strong> $<?= $Total_general ?> <strong>estos son sus usuarios : </strong> <?= $platadormas ?>
                                        <?php
                                    }
                                        ?>
                                        </h1>
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
                                            <?php
                                            if ($_SESSION['type'] == '4') {
                                            } else {
                                            ?>
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_productos">
                                                    <i class="fa fa-book"></i> Nuevo Ingreso
                                                </button>
                                            <?php
                                            }
                                            ?>

                                            <hr>
                                            <table class="table table-bordered table-hover" id="tbl_lista_ventas" style="width: 100%;" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>N.-</th>
                                                        <th>Fecha</th>
                                                        <th>Descripcion</th>
                                                        <th>Concepto</th>
                                                        <th>Valor</th>
                                                        <th>A cobrar</th>
                                                        <th>Total</th>
                                                        <th>Recibido</th>
                                                        <th>Cambio</th>
                                                        <th>Diferencia Comisiones Banco</th>
                                                        <th>Usuario</th>
                                                        <th>Estado</th>
                                                        <th>Tipo</th>
                                                        <th>Refrencia Proveedor</th>
                                                        <th>Completar</th>
                                                        <th>Imprimir</th>
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
            <!-- MODAL PRODUCTOS -->
            <div class="modal fade" id="modal_productos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
                data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-fullscreen">
                    <form id="ing_Productos">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">
                                    Venta - Recaudacion : <b>Fecha :</b> <span id="FechaActual"><?= date("Y-m-d") ?></span>
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <!-- <div class="col-3">
                                        <button type="button" id="btnAgregarFila" class="btn btn-info">Agregar Fila</button>
                                    </div> -->
                                    <div class="col-12">
                                        <table class="table table-bordered table-hover" id="tbl_lista_ventas_asignar" style="width: 100%;" cellspacing="0">
                                            <thead>
                                                <tr>

                                                    <th>DESCRIPCION</th>
                                                    <th>CONCEPTO</th>
                                                    <th>VALOR</th>
                                                    <th>A COBRAR</th>
                                                    <th>NUEVO /ELIMINAR</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th style="text-align:left">Total</th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th style="text-align:left">Recibido</th>
                                                    <th><input type="text" class="form-control input-recibido" placeholder="$ 0.000"></th>
                                                    <th></th>
                                                </tr>
                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th style="text-align:left">Cambio</th>
                                                    <th><span id="cambio_mostrar">$ 0.00</span></th>
                                                    <th></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                                <button type="button" class="btn btn-success">Cotizar</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- COMPLETAR PERODUCTOS -->
            <div class="modal fade" id="modal_completar_Productos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
                data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog">
                    <form id="Edit_producto">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Completar Productos</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-12 col-sm-12">
                                        <label>Selecciona el Tipo</label>
                                        <input type="hidden" id="txtNumeroEdit">
                                        <input type="hidden" id="txtFechaEdit">
                                        <input type="hidden" id="txtUsuarioEdit">
                                        <select id="sltipo" class="select2" data-dropdown-css-class="select2-purple" style="width: 100%;" multiple>
                                            <?php while ($filaPlata = $result_plataforma1->fetch_assoc()) { ?>
                                                <option value="<?= $filaPlata['Id'] ?>"><?= $filaPlata['Plataforma'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-12 col-sm-12">
                                        <hr>
                                    </div>
                                    <div class="col-12 col-sm-12">
                                    </div>
                                    <div class="col-12 col-sm-12">
                                        <label>Ingrese el numero de Comprobante</label>
                                        <input type="text" id="txtnumerocomprobante" class="form-control" placeholder="ejem(2255555)">
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
                    listar_transacciones();

                    if (!$('#sltipo').hasClass('select2-hidden-accessible')) {
                        $('#sltipo').select2({
                            dropdownParent: $('#modal_completar_Productos'),
                            maximumSelectionLength: 1,
                            allowClear: true,
                            width: '100%',
                            theme: "classic"
                        });
                    }

                    $("#Edit_producto").submit(function(e) {
                        e.preventDefault();
                        var sltipo = $("#sltipo").val();
                        var txtnumerocomprobante = $("#txtnumerocomprobante").val();
                        var txtNumeroEdit = $("#txtNumeroEdit").val();
                        var txtFechaEdit = $("#txtFechaEdit").val();
                        var txtUsuarioEdit = $("#txtUsuarioEdit").val();
                        Swal.fire({
                            title: "Esta Seguro ?",
                            text: "De completar con este tipo y comprobante!",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Aceptar !"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $("#loader_div").show();
                                $.ajax({
                                    type: "POST",
                                    dataType: "json",
                                    url: 'registro/ajax_Editar.php',
                                    data: {
                                        sltipo: sltipo,
                                        txtnumerocomprobante: txtnumerocomprobante,
                                        txtNumeroEdit: txtNumeroEdit,
                                        txtFechaEdit: txtFechaEdit,
                                        txtUsuarioEdit: txtUsuarioEdit
                                    },
                                    success: function(data) {
                                        if (data.success) {
                                            Swal.fire({
                                                icon: 'success',
                                                title: data.success,
                                                showConfirmButton: false,
                                                timer: 2000
                                            })
                                            $("#modal_completar_Productos").modal('hide');
                                            listar_transacciones();
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

                    $("#ing_Productos").submit(function(e) {
                        e.preventDefault();
                        Swal.fire({
                            title: "Esta Seguro ?",
                            text: "De Guardar la Ventas!",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Aceptar!"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                var VRecibido = $(".input-recibido").val();
                                var treceta_tbl_ventas = $('#tbl_lista_ventas_asignar').DataTable();
                                var arraytreceta_tbl_ventas = [];
                                treceta_tbl_ventas.rows().every(function(rowIdx, tableLoop, rowLoop) {
                                    var data = this.data();
                                    var cell = treceta_tbl_ventas.cell({
                                        row: rowIdx,
                                        column: 0
                                    }).node();
                                    var cell1 = treceta_tbl_ventas.cell({
                                        row: rowIdx,
                                        column: 1
                                    }).node();
                                    var cell2 = treceta_tbl_ventas.cell({
                                        row: rowIdx,
                                        column: 2
                                    }).node();
                                    var cell3 = treceta_tbl_ventas.cell({
                                        row: rowIdx,
                                        column: 3
                                    }).node();
                                    arraytreceta_tbl_ventas.push({
                                        "input-descripcion": $('.input-descripcion', cell).val(),
                                        "slproducto_select": $('.slproducto_select', cell1).val(),
                                        "input-valor": $('.input-valor', cell2).val(),
                                        "input-cobrar": $('.input-cobrar', cell3).val(),
                                    });
                                });
                                $.ajax({
                                    type: "POST",
                                    dataType: "json",
                                    url: 'registro/ajax_nuevo.php',
                                    data: {
                                        VRecibido: VRecibido,
                                        arraytreceta_tbl_ventas: arraytreceta_tbl_ventas
                                    },
                                    success: function(data) {
                                        if (data.success) {
                                            Swal.fire({
                                                icon: 'success',
                                                title: data.success,
                                                showConfirmButton: false,
                                                timer: 2000
                                            })

                                            let table = $('#tbl_lista_ventas_asignar').DataTable();
                                            table.clear().draw();

                                            // ✅ OPCIÓN 3: limpiar input recibido y cambio
                                            $('.input-recibido').val('');
                                            $('#cambio_mostrar').text('');

                                            table.row.add([
                                                `<input type="text" class="form-control input-descripcion" placeholder="Descripcion">`,
                                                `<select class="select2 slproducto_select" multiple style="width: 100%;" data-dropdown-css-class="select2-purple">${optionsProducto}</select>`,
                                                `<input type="text" class="form-control input-valor" placeholder="Ingrese el valor">`,
                                                `<div class="div_cobrar"></div><input type="hidden" class="form-control input-cobrar" placeholder="Ingrese el valor" disabled>`,
                                                `<div class="d-flex">
                                                    <button type="button" class="btn btn-info btnAgregarFila"><i class="fa fa-plus"></i></button>
                                                    <button type="button" class="btn btn-danger btnEliminarFila"><i class="fa fa-trash"></i></button>
                                                </div>`
                                            ]).draw(false);

                                            let $newRow = $('#tbl_lista_ventas_asignar tbody tr:last');
                                            $newRow.find('.select2').select2({
                                                dropdownParent: $('#modal_productos'),
                                                maximumSelectionLength: 1,
                                                allowClear: true,
                                                width: '100%',
                                                theme: 'classic'
                                            });
                                            listar_transacciones();
                                        }
                                    },
                                    error: function(jqXHR, exception) {
                                        console.log(jqXHR.responseText);
                                    },
                                });
                            }
                        });
                    });




                    var optionsPlataforma = `<?= $optionsPlataforma ?>`;
                    var optionsProducto = `<?= $optionsProducto ?>`;


                    $(document).on("input", ".input-valor", function() {
                        this.value = this.value
                            .replace(/[^0-9.]/g, '')
                            .replace(/(\..*?)\..*/g, '$1');
                    });

                    $(document).on("input", ".input-recibido", function() {
                        this.value = this.value
                            .replace(/[^0-9.]/g, '')
                            .replace(/(\..*?)\..*/g, '$1');
                    });

                    $('#tbl_lista_ventas_asignar .slproducto_select').select2({
                        dropdownParent: $('#modal_productos'),
                        maximumSelectionLength: 1,
                        allowClear: true,
                        width: '100%',
                        theme: "classic"
                    });


                    function obtenerTotal() {
                        let textoTotal = $('#tbl_lista_ventas_asignar tfoot th').eq(3).text() || '$ 0.00';
                        let numero = textoTotal.replace(/[^\d.-]/g, '');
                        return parseFloat(numero) || 0;
                    }



                    var table = $('#tbl_lista_ventas_asignar').DataTable();
                    table.destroy();
                    table.clear();

                    var table = $('#tbl_lista_ventas_asignar').DataTable({
                        language: {
                            url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                        },
                        scrollCollapse: true,
                        bInfo: true,
                        paging: false,
                        deferRender: false,
                        responsive: true,
                        dom: 'Bfrtip',
                        ordering: false,
                        searching: false,
                        buttons: [],

                        footerCallback: function(row, data, start, end, display) {
                            var api = this.api();
                            var total = 0;

                            // Sumar valores de inputs en la columna 3 ("A COBRAR")
                            api.column(3, {
                                page: 'current'
                            }).nodes().each(function(cell, i) {
                                var val = $(cell).find('input.input-cobrar').val();
                                val = parseFloat(val) || 0;
                                total += val;
                            });

                            // Mostrar total en footer, columna 3
                            $(api.column(3).footer()).html(
                                '$ ' + new Intl.NumberFormat("en-US", {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                }).format(total)
                            );
                        }
                    });

                    table.row.add([
                        `<input type="text" class="form-control input-descripcion" placeholder="Descripcion">`,
                        `<select class="select2 slproducto_select" multiple style="width: 100%;" data-dropdown-css-class="select2-purple">${optionsProducto}</select>`,
                        `<input type="text" class="form-control input-valor" placeholder="Ingrese el valor">`,
                        `<div class="div_cobrar"></div><input type="hidden" class="form-control input-cobrar" placeholder="Ingrese el valor" disabled>`,
                        `<div class="d-flex">
                        <button type="button" class="btn btn-info btnAgregarFila"><i class="fa fa-plus"></i></button>
                        <button type="button" class="btn btn-danger btnEliminarFila"><i class="fa fa-trash"></i></button>
                        </div>`
                    ]).draw(false);

                    let $newRow = $('#tbl_lista_ventas_asignar tbody tr:last');
                    $newRow.find('.select2').select2({
                        dropdownParent: $('#modal_productos'),
                        maximumSelectionLength: 1,
                        allowClear: true,
                        width: '100%',
                        theme: 'classic'
                    });


                    // Agregar fila con botón eliminar dentro
                    $('#tbl_lista_ventas_asignar tbody').on('click', '.btnAgregarFila', function(e) {
                        e.preventDefault();
                        let descripcionActual = $(this).closest('tr').find('.input-descripcion').val() || '';
                        table.row.add([
                            `<input type="text" class="form-control input-descripcion" placeholder="Descripcion" value="${descripcionActual}">`,
                            `<select class="select2 slproducto_select" multiple style="width: 100%;" data-dropdown-css-class="select2-purple">${optionsProducto}</select>`,
                            `<input type="text" class="form-control input-valor" placeholder="Ingrese el valor">`,
                            `<div class="div_cobrar"></div><input type="hidden" class="form-control input-cobrar" placeholder="Ingrese el valor" disabled>`,
                            `<div class="d-flex gap-1">
                                <button type="button" class="btn btn-info btnAgregarFila"><i class="fa fa-plus"></i></button>
                                <button type="button" class="btn btn-danger btnEliminarFila"><i class="fa fa-trash"></i></button>
                            </div>`
                        ]).draw(false);

                        let $newRow = $('#tbl_lista_ventas_asignar tbody tr:last');
                        $newRow.find('.select2').select2({
                            dropdownParent: $('#modal_productos'),
                            maximumSelectionLength: 1,
                            allowClear: true,
                            width: '100%',
                            theme: 'classic'
                        });

                        $newRow.find('.input-descripcion').focus();

                        function focusNext(el) {
                            let $td = el.closest('td');
                            let $next = $td.nextAll('td').find('select, input, button').filter(':visible').first();
                            if ($next.length) $next.focus();
                        }

                        $newRow.find('.slplataforma_select, .slproducto_select').on('select2:select', function() {
                            focusNext($(this));
                        });

                        $newRow.find('.slplataforma_select, .slproducto_select').on('keydown', function(e) {
                            if (e.key === "Tab") {
                                if ($(this).data('select2').isOpen()) {
                                    e.preventDefault();
                                    $(this).select2('close');
                                    focusNext($(this));
                                }
                            }
                        });
                    });

                    function actualizarTotal() {
                        let total = 0;
                        $('#tbl_lista_ventas_asignar tbody .input-cobrar').each(function() {
                            let val = parseFloat($(this).val()) || 0;
                            total += val;
                        });

                        $('#tbl_lista_ventas_asignar tfoot th').eq(3).html(
                            '$ ' + new Intl.NumberFormat("en-US", {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            }).format(total)
                        );

                        // 🔁 Forzar recalcular el cambio
                        $('.input-recibido').trigger('input');
                    }


                    let debounceTimeout;

                    $('#tbl_lista_ventas_asignar tbody').on('input', '.input-valor', function() {
                        let $input = $(this);
                        let valor = $input.val();
                        let $row = $input.closest('tr');
                        let productoSeleccionado = $row.find('.slproducto_select').val();
                        let IdProd = Array.isArray(productoSeleccionado) ? productoSeleccionado[0] : productoSeleccionado;

                        clearTimeout(debounceTimeout);
                        debounceTimeout = setTimeout(function() {
                            if (IdProd) {
                                let focused = document.activeElement;
                                let selectionStart = focused.selectionStart;
                                let selectionEnd = focused.selectionEnd;

                                $.ajax({
                                    type: "POST",
                                    dataType: "json",
                                    url: 'registro/ajax_calcular.php',
                                    data: {
                                        IdProd: IdProd,
                                        valor: valor
                                    },
                                    success: function(data) {
                                        console.log(data);
                                        for (var i = 0; i < data.length; i++) {
                                            $row.find('.input-cobrar').val(data[i]["Total"]);
                                            $row.find('.div_cobrar').text(data[i]["Total"]);
                                        }
                                        actualizarTotal();

                                        if (focused && focused.tagName === "INPUT" && typeof selectionStart === "number") {
                                            focused.focus();
                                            focused.setSelectionRange(selectionStart, selectionEnd);
                                        }
                                    },
                                    error: function(jqXHR, exception) {
                                        console.log(jqXHR.responseText);
                                    },
                                });
                            } else {
                                console.warn("Producto o valor no definido aún.");
                            }
                        }, 400);
                    });



                    $('#tbl_lista_ventas_asignar').on('input', '.input-recibido', function() {
                        let recibidoStr = $(this).val().replace(/[^\d.-]/g, '');
                        let recibido = parseFloat(recibidoStr) || 0;
                        let total = obtenerTotal();
                        let cambio = recibido - total;

                        if (cambio < 0) {
                            $('#cambio_mostrar').css('color', 'red').text('Falta: $' + Math.abs(cambio).toFixed(2));
                        } else {
                            $('#cambio_mostrar').css('color', 'green').text('$ ' + cambio.toFixed(2));
                        }
                    });



                    // Evento delegado para eliminar fila
                    $('#tbl_lista_ventas_asignar tbody').on('click', '.btnEliminarFila', function() {
                        Swal.fire({
                            title: "Esta seguro ?",
                            text: "De eliminar esta Fila !",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Aceptar !"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                table.row($(this).closest('tr')).remove().draw(false);
                                $(".input-recibido").val('');
                                $("#cambio_mostrar").text('');
                            }
                        });

                    });
                });

                $('#tbl_lista_ventas_asignar tbody tr:last .slplataforma_select').select2({
                    dropdownParent: $('#modal_productos'),
                    maximumSelectionLength: 1,
                    allowClear: true,
                    width: '100%',
                    theme: 'classic'
                });

                function listar_transacciones() {
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: 'registro/ajax_listar.php',
                        data: {},
                        success: function(data) {
                            cargar_lista_transaccion(data);
                        },
                        error: function(jqXHR, exception) {
                            console.log(jqXHR.responseText);
                        },
                    });
                }

                function generarOpcionesPlataforma(idSeleccionado) {
                    const idSeleccionadoArray = idSeleccionado ? idSeleccionado.split(',') : [];

                    const opciones = [
                        <?php
                        $sql_Plataforma1 = "SELECT MIN(Id) AS Id, Plataforma FROM plataforma_usuario WHERE Estado = '0' GROUP BY Plataforma ORDER BY `Id` ASC ";
                        $result_plataforma1 =  $conec->query($sql_Plataforma1);
                        while ($filaPlata = $result_plataforma1->fetch_assoc()) {
                            echo '{ id: "' . $filaPlata['Id'] . '", text: "' . $filaPlata['Plataforma'] . '" },';
                        }
                        ?>
                    ];

                    return opciones.map(opt => {
                        const selected = idSeleccionadoArray.includes(opt.id) ? 'selected' : '';
                        return `<option value="${opt.id}" ${selected}>${opt.text}</option>`;
                    }).join('');
                }

                function cargar_lista_transaccion(data) {
                    var table = $('#tbl_lista_ventas').DataTable();
                    table.destroy();
                    table.clear();
                    $('#tbl_lista_ventas').dataTable({

                        "language": {
                            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                        },
                        scrollY: '300px',
                        "scrollX": true,
                        ordering: true,
                        order: [
                            [0, 'desc']
                        ],
                        scrollCollapse: true,
                        "bInfo": true,
                        paging: false,
                        deferRender: false,
                        data: data,
                        dom: 'Bfrtip',
                        searching: true,
                        ordering: false,
                        buttons: [],
                        columns: [{
                                "data": "Numero"
                            },
                            {
                                "data": "Fecha"
                            },
                            {
                                "data": "Descripcion"
                            },

                            {
                                "data": "Producto"
                            },

                            {
                                "data": "Valor"
                            },

                            {
                                "data": "A_Cobrar"
                            },

                            {
                                "data": "TotalAcobrar"
                            },

                            {
                                "data": "Recibido"
                            },

                            {
                                "data": "Cambio"
                            },
                            {
                                render: function(data, type, full, meta) {
                                    var typeUsuario = <?= json_encode($_SESSION['type']) ?>;
                                    // Asegura que el valor sea string seguro
                                    let valor = (full.Dif_com_bamco || '').trim();

                                    if (typeUsuario === '4') {
                                        return `<input 
                                                    type="text" 
                                                    class="form-control txtcom_banco" 
                                                    placeholder="ejem(2255555)" 
                                                    value="${valor.replace(/"/g, '&quot;')}" 
                                                    data-row-id="${full.Id}"
                                                >`;
                                    } else if (typeUsuario === '3') {
                                        if (valor !== '') {
                                            return `<span>${valor}</span>`;
                                        }
                                        return '';
                                    }

                                    return '';
                                }

                            },
                            {
                                "data": "Usuario"
                            },


                            {
                                render: function(data, type, full, meta) {
                                    if (full.Estado === '1') {
                                        var Estado_carnet = '<span id="spEstado" class="btn btn-warning">Reservado</span>'
                                    } else if (full.Estado === '0') {
                                        var Estado_carnet = '<span id="spEstado" class="btn btn-success">Cobrado</span>'
                                    }
                                    return Estado_carnet
                                }
                            },
                            {
                                render: function(data, type, full, meta) {
                                    var typeUsuario = <?= json_encode($_SESSION['type']) ?>;
                                    if (typeUsuario === '4') {

                                        const opciones = generarOpcionesPlataforma(full.IdPlataforma);
                                        return `<select class="select2 sltipo" multiple style="width: 100%;" 
                                            data-dropdown-css-class="select2-purple"
                                            data-row-id="${full.Id}">
                                        ${opciones}
                                    </select>`;

                                    } else {
                                        if (full.IdPlataforma) {
                                            return `<span>${full.Plataforma}</span>`;
                                        }
                                        const opciones = `
                                    <?php
                                    $sql_Plataforma1 = "SELECT MIN(Id) AS Id, Plataforma FROM plataforma_usuario WHERE Estado = '0' GROUP BY Plataforma ORDER BY `Id` ASC ";
                                    $result_plataforma1 =  $conec->query($sql_Plataforma);
                                    while ($filaPlata = $result_plataforma1->fetch_assoc()) {
                                        echo '<option value="' . $filaPlata['Id'] . '">' . $filaPlata['Plataforma'] . '</option>';
                                    }
                                    ?>
                                    `;
                                        return `<select class="select2 sltipo" multiple style="width: 100%;" 
                                            data-dropdown-css-class="select2-purple"
                                            data-row-id="${full.Id}">
                                        ${opciones}
                                    </select>`;
                                    }

                                }
                            },

                            {
                                render: function(data, type, full, meta) {
                                    var typeUsuario = <?= json_encode($_SESSION['type']) ?>;

                                    // Asegura que el valor sea string seguro
                                    let valor = (full.Refe_Proveedor || '').trim();

                                    if (typeUsuario === '4') {
                                        return `<input 
                                                    type="text" 
                                                    class="form-control txtnumerocomprobante" 
                                                    placeholder="ejem(2255555)" 
                                                    value="${valor.replace(/"/g, '&quot;')}" 
                                                    data-row-id="${full.Id}"
                                                >`;
                                    } else if (typeUsuario === '3') {
                                        if (valor !== '') {
                                            return `<span>${valor}</span>`;
                                        }
                                        return '';
                                    }

                                    return '';
                                }

                            },
                            {
                                visible: false,
                                render: function(data, type, full, meta) {
                                    return `<button class="btn btn-sm btn-icon btn-pure btn-default on-default editar" title="Editar">
                                                    <i class="fa fa-pen" aria-hidden="true"></i>
                                                </button>`;
                                }
                            },
                            {
                                render: function(data, type, full, meta) {
                                    return `<button class="btn btn-sm btn-icon btn-pure btn-default on-default imprimir" title="Imprimir">
                                                    <i class="fa fa-print" aria-hidden="true"></i>
                                                </button>`;
                                }
                            }


                        ],
                        createdRow: function(row, data, dataIndex) {
                            // Pintar inicio de grupo (cuando hay número)
                            if (data.Numero !== '') {
                                $(row).css('background-color', '#e6ffe6'); // color celeste suave
                                $(row).css('font-weight', 'bold'); // opcional, texto en negrita
                            }

                            // Pintar penúltima fila si corresponde
                            if (data.ColorFinal === '1') {
                                //$(row).css('background-color', '#e6ffe6'); // color verde claro
                            }
                        },
                        drawCallback: function() {
                            $('.select2').select2({
                                dropdownCssClass: 'select2-purple',
                                width: '100%'
                            });
                        }

                    });  

                      $('#tbl_lista_ventas').on('blur', '.txtcom_banco', function() {
                        const $input = $(this);
                        const valor = $input.val();
                        const rowId = $input.data('row-id');
                        Swal.fire({
                            title: "Esta seguro ?",
                            text: "De guardar con esta Comision del Banco !",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Aceptar !"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    type: "POST",
                                    dataType: "json",
                                    url: 'registro/ajax_Editar_comision.php',
                                    data: {
                                        valor: valor,
                                        rowId: rowId
                                    },
                                    success: function(data) {
                                        console.log(data);
                                        if (data.success) {
                                            Swal.fire({
                                                icon: 'success',
                                                title: data.success,
                                                showConfirmButton: false,
                                                timer: 2000
                                            })
                                            listar_transacciones();
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



                    $('#tbl_lista_ventas').on('blur', '.txtnumerocomprobante', function() {
                        const $input = $(this);
                        const valor = $input.val();
                        const rowId = $input.data('row-id');
                        Swal.fire({
                            title: "Esta seguro ?",
                            text: "De guardar con este tipo de comprobante !",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Aceptar !"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    type: "POST",
                                    dataType: "json",
                                    url: 'registro/ajax_Editar_conprobante.php',
                                    data: {
                                        valor: valor,
                                        rowId: rowId
                                    },
                                    success: function(data) {
                                        console.log(data);
                                        if (data.success) {
                                            Swal.fire({
                                                icon: 'success',
                                                title: data.success,
                                                showConfirmButton: false,
                                                timer: 2000
                                            })
                                            listar_transacciones();
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


                    $('#tbl_lista_ventas').on('change', '.sltipo', function() {
                        const select = $(this);
                        const selectedValues = select.val(); // array de valores seleccionados
                        const rowId = select.data('row-id'); // el Id de la fila

                        Swal.fire({
                            title: "Esta seguro ?",
                            text: "De guardar con este tipo !",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Aceptar !"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    type: "POST",
                                    dataType: "json",
                                    url: 'registro/ajax_Editar.php',
                                    data: {
                                        selectedValues: selectedValues,
                                        rowId: rowId
                                    },
                                    success: function(data) {
                                        console.log(data);
                                        if (data.success) {
                                            Swal.fire({
                                                icon: 'success',
                                                title: data.success,
                                                showConfirmButton: false,
                                                timer: 2000
                                            })
                                            listar_transacciones();
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

                    $('#tbl_lista_ventas tbody').on('click', 'button.editar', function() {
                        event.preventDefault();
                        var table = $('#tbl_lista_ventas').DataTable();
                        var data = table.row($(this).parents('tr')).data();
                        var estado = $(this).parents("tr").find('#spEstado');
                        $("#modal_completar_Productos").modal('show');
                        $("#txtNumeroEdit").val(data.Id);
                        $("#txtFechaEdit").val(data.Fecha);
                        $("#txtUsuarioEdit").val(data.IdUsuario);
                        $("#txtnumerocomprobante").val(data.Refe_Proveedor);
                        let selected1 = data.IdPlataforma.split(',');
                        $("#sltipo").val(selected1).trigger("change");
                    });


                    $('#tbl_lista_caja tbody').on('click', 'button.eliminar', function() {
                        event.preventDefault();
                        var table = $('#tbl_lista_caja').DataTable();
                        var data = table.row($(this).parents('tr')).data();
                        var estado = $(this).parents("tr").find('#spEstado');
                        var idcajaEliminar = data.Id;
                        Swal.fire({
                            title: "Estas Seguro ?",
                            text: "De eliminar esta Caja !",
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
                                        idcajaEliminar: idcajaEliminar
                                    },
                                    success: function(data) {
                                        if (data.success) {
                                            Swal.fire({
                                                icon: 'success',
                                                title: data.success,
                                                showConfirmButton: false,
                                                timer: 2000
                                            })
                                            listar_caja();
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
                    $('#tbl_lista_caja tbody').on('click', 'button.editar', function() {
                        event.preventDefault();
                        var table = $('#tbl_lista_caja').DataTable();
                        var data = table.row($(this).parents('tr')).data();
                        var estado = $(this).parents("tr").find('#spEstado');
                        console.log(data);
                        $("#modal_caja_E").modal('show');
                        caja_E = $("#caja_E").val(data.Nombre);
                        Idcaja_E = $("#IdCaja_E_E").val(data.Id);

                        let selected_sucursal = data.IdSucursal.split(',');
                        $("#slsucursal_E").val(selected_sucursal).trigger("change");


                    });
                }

                $('#modal_productos').on('shown.bs.modal', function() {
                    $('#tbl_lista_ventas_asignar').DataTable().columns.adjust().responsive.recalc();
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
