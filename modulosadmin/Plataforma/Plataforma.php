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

        $sql_banco = "SELECT Id,Nombre FROM tipo_banco WHERE Estado = '0'";
        $result_banco = $conec->query($sql_banco);

        $sql_banco_E = "SELECT Id,Nombre FROM tipo_banco WHERE Estado = '0'";
        $result_banco_E = $conec->query($sql_banco_E);
?>

        <!DOCTYPE html>
        <html lang="es">

        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="icon" type="image/png" href="../../img/multipagos.jpg" />
            <title>Plataforma Usuario</title>

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
                                    <h1>Plataforma Usuario</h1>
                                </div>
                                <div class="col-sm-6">
                                    <ol class="breadcrumb float-sm-right">
                                        <li class="breadcrumb-item"><a href="../../menu.php">Home</a></li>
                                        <li class="breadcrumb-item active">Plataforma Usuario</li>
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
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_caja">
                                                <i class="fa fa-book"></i> Nuevo Ingreso
                                            </button>
                                            <hr>
                                            <table class="table table-bordered table-hover" id="tbl_lista_plataforma" style="width: 100%;" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>Nombre Plataforma</th>
                                                        <th>Plataforma</th>
                                                        <th>Usuario</th>
                                                        <th>Banco</th>
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

            <!-- MODAL INGRESO-->
            <div class="modal fade" id="modal_caja" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
                data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-lg">
                    <form id="ing_caja">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Ingreso Plataforma Usuario</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-6 col-sm-3">
                                        <label>Nombre Plataforma</label>
                                        <input type="text" id="txtNombreplataforma" class="form-control" placeholder="Zona Pago">
                                    </div>
                                    <div class="col-6 col-sm-3">
                                        <label>Plataforma</label>
                                        <input type="text" id="txtplataforma" class="form-control" placeholder="ZN">
                                    </div>
                                    <div class="col-6 col-sm-3">
                                        <label>Usuario</label>
                                        <input type="text" id="txtusuario" class="form-control" placeholder="edcofre">
                                    </div>
                                    <div class="col-6 col-sm-3">
                                        <label>Banco</label>
                                        <select id="slnBanco" class="select2" data-dropdown-css-class="select2-purple" style="width: 100%;" multiple>
                                            <?php
                                            while ($row_B = $result_banco->fetch_assoc()) {
                                            ?>
                                                <option value="<?= $row_B['Id'] ?>"><?= $row_B['Nombre'] ?></option>
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
                        </div>
                    </form>
                </div>
            </div>

            <!-- Modal de editar-->
            <div class="modal fade" id="modal_caja_E" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
                data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-lg">
                    <form id="Edit_caja">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Editar Plataforma Usuario</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-6 col-sm-3">
                                        <label>Nombre Plataforma</label>
                                        <input type="text" id="txtNombreplataforma_E" class="form-control" placeholder="Zona Pago">
                                    </div>
                                    <div class="col-6 col-sm-3">
                                        <label>Plataforma</label>
                                        <input type="hidden" id="Idplataforma_E_E">
                                        <input type="text" id="txtplataforma_E" class="form-control" placeholder="ejem(ZN)">
                                    </div>
                                    <div class="col-6 col-sm-3">
                                        <label>Usuario</label>
                                        <input type="text" id="txtusuario_E" class="form-control" placeholder="edcofre">
                                    </div>
                                    <div class="col-4 col-sm-4">
                                        <label>Banco</label>
                                        <select id="slnBanco_E" class="select2" data-dropdown-css-class="select2-purple" style="width: 100%;" multiple>
                                            <?php
                                            while ($row_B_E = $result_banco_E->fetch_assoc()) {
                                            ?>
                                                <option value="<?= $row_B_E['Id'] ?>"><?= $row_B_E['Nombre'] ?></option>
                                            <?php
                                            }
                                            ?>
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
                    listar_Plataforma();

                    if (!$('#slnBanco').hasClass('select2-hidden-accessible')) {
                        $('#slnBanco').select2({
                            dropdownParent: $('#modal_caja'),
                            maximumSelectionLength: 1,
                            allowClear: true,
                            width: '100%',
                            theme: "classic"
                        });
                    }

                     if (!$('#slnBanco_E').hasClass('select2-hidden-accessible')) {
                        $('#slnBanco_E').select2({
                            dropdownParent: $('#modal_caja_E'),
                            maximumSelectionLength: 1,
                            allowClear: true,
                            width: '100%',
                            theme: "classic"
                        });
                    }


                    $("#Edit_caja").submit(function(e) {
                        e.preventDefault();
                        var Idplataforma_E_E = $("#Idplataforma_E_E").val();
                        var txtplataforma_E = $("#txtplataforma_E").val();
                        var txtusuario_E = $("#txtusuario_E").val();
                        var txtNombreplataforma_E = $("#txtNombreplataforma_E").val();
                        var slnBanco_E = $("#slnBanco_E").val();
                        if (txtNombreplataforma_E == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Ingrese el Nombre de la plataforma",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (txtplataforma_E == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Ingrese la plataforma",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (txtusuario_E == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Ingrese el Nombre de usuario",
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
                                    Idplataforma_E_E: Idplataforma_E_E,
                                    txtplataforma_E: txtplataforma_E,
                                    txtusuario_E: txtusuario_E,
                                    txtNombreplataforma_E: txtNombreplataforma_E,
                                    slnBanco_E: slnBanco_E
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
                                        $("#modal_caja_E").modal('hide');
                                        listar_Plataforma();
                                        $("#loader_div").hide();
                                    }
                                },
                                error: function(jqXHR, exception) {
                                    console.log(jqXHR.responseText);
                                },
                            });
                        }
                    });
                    $("#ing_caja").submit(function(e) {
                        e.preventDefault();
                        var txtplataforma = $("#txtplataforma").val();
                        var txtusuario = $("#txtusuario").val();
                        var txtNombreplataforma = $("#txtNombreplataforma").val();
                        var slnBanco = $("#slnBanco").val();
                        if (txtNombreplataforma == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Ingrese el nombre de la Plataforma",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (txtplataforma == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Ingrese la Plataforma",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (txtusuario == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Ingrese el nombre de usuario",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (slnBanco == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Seleccione el Banco",
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
                                    txtplataforma: txtplataforma,
                                    txtusuario: txtusuario,
                                    txtNombreplataforma: txtNombreplataforma,
                                    slnBanco: slnBanco
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
                                        $("#modal_caja").modal('hide');
                                        listar_Plataforma();
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

                function listar_Plataforma() {
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: 'registro/ajax_listar.php',
                        data: {},
                        success: function(data) {
                            cargar_lista_plataforma(data);
                        },
                        error: function(jqXHR, exception) {
                            console.log(jqXHR.responseText);
                        },
                    });
                }

                function cargar_lista_plataforma(data) {
                    var table = $('#tbl_lista_plataforma').DataTable();
                    table.destroy();
                    table.clear();
                    $('#tbl_lista_plataforma').dataTable({
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
                        buttons: ['excel'],
                        columns: [{
                                "data": "Nombre_plataforma"
                            }, {
                                "data": "Plataforma"
                            },
                            {
                                "data": "Usuario"
                            },
                            {
                                "data": "Nombre_Banco"
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
                    $('#tbl_lista_plataforma tbody').on('click', 'button.eliminar', function() {
                        event.preventDefault();
                        var table = $('#tbl_lista_plataforma').DataTable();
                        var data = table.row($(this).parents('tr')).data();
                        var estado = $(this).parents("tr").find('#spEstado');
                        var idcajaEliminar = data.Id;
                        Swal.fire({
                            title: "Estas Seguro ?",
                            text: "De eliminar esta Plataforma !",
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
                                            listar_Plataforma();
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
                    $('#tbl_lista_plataforma tbody').on('click', 'button.editar', function() {
                        event.preventDefault();
                        var table = $('#tbl_lista_plataforma').DataTable();
                        var data = table.row($(this).parents('tr')).data();
                        var estado = $(this).parents("tr").find('#spEstado');
                        console.log(data);
                        $("#modal_caja_E").modal('show');
                        txtplataforma_E = $("#txtplataforma_E").val(data.Plataforma);
                        txtusuario_E = $("#txtusuario_E").val(data.Usuario);
                        Idplataforma_E_E = $("#Idplataforma_E_E").val(data.Id);
                        txtNombreplataforma_E = $("#txtNombreplataforma_E").val(data.Nombre_plataforma);
                        let selected_banco = data.IdBanco.split(',');
                        $("#slnBanco_E").val(selected_banco).trigger("change");

                    });
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
