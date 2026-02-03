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

        $sql_caja = "SELECT Id,Nombre FROM cajas WHERE Estado = '0' ";
        $resultcaja = $conec->query($sql_caja);

        $sql_plataforma = "SELECT Id,Plataforma,Usuario FROM plataforma_usuario WHERE Estado = '0' ";
        $resultplataforma = $conec->query($sql_plataforma);

        $sql_caja_E = "SELECT Id,Nombre FROM cajas WHERE Estado = '0' ";
        $resultcaja_E = $conec->query($sql_caja_E);

        $sql_plataforma_E = "SELECT Id,Plataforma,Usuario FROM plataforma_usuario WHERE Estado = '0' ";
        $resultplataforma_E = $conec->query($sql_plataforma_E);

?>

        <!DOCTYPE html>
        <html lang="es">

        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="icon" type="image/png" href="../../img/multipagos.jpg" />
            <title>Asignacion Cajas</title>

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
                                    <h1>Asignacion Cajas</h1>
                                </div>
                                <div class="col-sm-6">
                                    <ol class="breadcrumb float-sm-right">
                                        <li class="breadcrumb-item"><a href="../../menu.php">Home</a></li>
                                        <li class="breadcrumb-item active">Asignacion Cajas</li>
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
                                            <table class="table table-bordered table-hover" id="tbl_lista_caja" style="width: 100%;" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>Caja</th>
                                                        <th>Plataforma</th>
                                                        <th>Usuario</th>
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


            <!-- MODAL INGRESO-->
            <div class="modal fade" id="modal_caja" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
                data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog">
                    <form id="ing_caja">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Asignacion Caja</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-6 col-sm-6">
                                        <label>Caja</label>
                                        <select id="slcaja" class="select2" data-dropdown-css-class="select2-purple" style="width: 100%;" multiple>
                                            <?php while ($filacaja = $resultcaja->fetch_assoc()) { ?>
                                                <option value="<?= $filacaja['Id'] ?>"><?= $filacaja['Nombre'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-6 col-sm-6">
                                        <label>Plataforma</label>
                                        <select id="slplataforma" class="select2" data-dropdown-css-class="select2-purple" style="width: 100%;" multiple>
                                            <option value="todos">Todos</option>
                                            <?php while ($filaplataforma = $resultplataforma->fetch_assoc()) { ?>
                                                <option value="<?= $filaplataforma['Id'] ?>">
                                                    <?= $filaplataforma['Plataforma'] . ' - ' . $filaplataforma['Usuario'] ?>
                                                </option>
                                            <?php } ?>
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

            <!-- EDITAR -->
            <div class="modal fade" id="modal_caja_E" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
                data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog">
                    <form id="Edit_caja">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Editar Asignacion Caja</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-6 col-sm-6">
                                        <label>Caja</label>
                                        <input type="hidden" id="idcajas_E">
                                        <select id="slcaja_E" class="select2" data-dropdown-css-class="select2-purple" style="width: 100%;" multiple>
                                            <?php while ($filacaja_E = $resultcaja_E->fetch_assoc()) { ?>
                                                <option value="<?= $filacaja_E['Id'] ?>"><?= $filacaja_E['Nombre'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-6 col-sm-6">
                                        <label>Plataforma</label>
                                        <select id="slplataforma_E" class="select2" data-dropdown-css-class="select2-purple" style="width: 100%;" multiple>
                                            <option value="todos">Todos</option>
                                            <?php while ($filaplataforma_E = $resultplataforma_E->fetch_assoc()) { ?>
                                                <option value="<?= $filaplataforma_E['Id'] ?>">
                                                    <?= $filaplataforma_E['Plataforma'] . ' - ' . $filaplataforma_E['Usuario'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>

                                    </div>
                                    <div class="col-6 col-sm-6">
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
                    listar_caja();
                    $("#Edit_caja").submit(function(e) {
                        e.preventDefault();
                        var idcajas_E = $("#idcajas_E").val();
                        var slcaja_E = $("#slcaja_E").val();
                        var slplataforma_E = $("#slplataforma_E").val();
                        var slEstado_E = $("#slEstado_E").val();

                        if (slcaja_E == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Seleccione una caja",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (slplataforma_E == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Seleccione una o varias Plataformas",
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
                                    idcajas_E: idcajas_E,
                                    slcaja_E: slcaja_E,
                                    slplataforma_E: slplataforma_E,
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
                                        $("#modal_caja_E").modal('hide');
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

                    if (!$('#slcaja').hasClass('select2-hidden-accessible')) {
                        $('#slcaja').select2({
                            dropdownParent: $('#modal_caja'),
                            maximumSelectionLength: 1,
                            allowClear: true,
                            width: '100%',
                            theme: "classic"
                        });
                    }
                    if (!$('#slplataforma').hasClass('select2-hidden-accessible')) {
                        $('#slplataforma').select2({
                            dropdownParent: $('#modal_caja'),
                            allowClear: true,
                            width: '100%',
                            theme: "classic"
                        });
                    }


                    if (!$('#slcaja_E').hasClass('select2-hidden-accessible')) {
                        $('#slcaja_E').select2({
                            dropdownParent: $('#modal_caja_E'),
                            maximumSelectionLength: 1,
                            allowClear: true,
                            width: '100%',
                            theme: "classic"
                        });
                    }
                    if (!$('#slplataforma_E').hasClass('select2-hidden-accessible')) {
                        $('#slplataforma_E').select2({
                            dropdownParent: $('#modal_caja_E'),
                            allowClear: true,
                            width: '100%',
                            theme: "classic"
                        });
                    }
                    $('#slcaja_E').prop('disabled', true);

                    $('#slplataforma').on('change', function() {
                        const selectedValues = $(this).val();
                        if (selectedValues && selectedValues.includes('todos')) {
                            const allOptions = [];
                            $('#slplataforma option').each(function() {
                                if ($(this).val() !== 'todos') {
                                    allOptions.push($(this).val());
                                }
                            });
                            $('#slplataforma').val(allOptions).trigger('change');
                        }
                    });

                    $('#slplataforma_E').on('change', function() {
                        const selectedValues = $(this).val();
                        if (selectedValues && selectedValues.includes('todos')) {
                            const allOptions = [];
                            $('#slplataforma_E option').each(function() {
                                if ($(this).val() !== 'todos') {
                                    allOptions.push($(this).val());
                                }
                            });
                            $('#slplataforma_E').val(allOptions).trigger('change');
                        }
                    });

                    $("#ing_caja").submit(function(e) {
                        e.preventDefault();
                        var slcaja = $("#slcaja").val();
                        var slplataforma = $("#slplataforma").val();
                        if (slcaja == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Seleccione una Caja",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (slplataforma == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Seleccione una o varias Plataformas",
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
                                    slcaja: slcaja,
                                    slplataforma: slplataforma
                                },
                                success: function(data) {
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

                function listar_caja() {
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
                    var table = $('#tbl_lista_caja').DataTable();
                    table.destroy();
                    table.clear();
                    $('#tbl_lista_caja').dataTable({
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
                                "data": "NomCajas"
                            },

                            {
                                "data": "Plataformas"
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
                                    var estado = `<button class=\"btn btn-sm btn-icon btn-pure btn-default on-default eliminar" title="Eliminar"><i class="fa fa-trash" aria-hidden="true"></i></button> 
                                    <button class=\"btn btn-sm btn-icon btn-pure btn-default on-default editar" title="Editar"><i class="fa fa-pen" aria-hidden="true"></i></button>`

                                    return estado
                                }
                            },

                        ]
                    });
                    $('#tbl_lista_caja tbody').on('click', 'button.eliminar', function() {
                        event.preventDefault();
                        var table = $('#tbl_lista_caja').DataTable();
                        var data = table.row($(this).parents('tr')).data();
                        var estado = $(this).parents("tr").find('#spEstado');
                        var idcajaEliminar = data.IdAsignacion;
                        Swal.fire({
                            title: "Estas Seguro ?",
                            text: "De eliminar esta caja y sus Plataformas !",
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
                        $("#modal_caja_E").modal('show');

                        let selected_caja = data.IdCajas.split(',');
                        $("#slcaja_E").val(selected_caja).trigger("change");

                        let selected_plataforma = data.IdPlataformas.split(',');
                        $("#slplataforma_E").val(selected_plataforma).trigger("change");
                        slEstado_E = $("#slEstado_E").val(data.Estado);
                        idcajas_E = $("#idcajas_E").val(data.IdAsignacion);
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
