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

        $categoria = "SELECT Id, UPPER(Nombre) AS Nombre FROM categorias WHERE Estado = '0' ";
        $result_Cat = $conec->query($categoria);
        $categoria1 = "SELECT Id, UPPER(Nombre) AS Nombre FROM categorias WHERE Estado = '0' ";
        $result_Cat1 = $conec->query($categoria1);

?>

        <!DOCTYPE html>
        <html lang="es">

        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="icon" type="image/png" href="../../img/multipagos.jpg" />
            <title>Productos</title>

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
                                    <h1>Ingreso Productos</h1>
                                </div>
                                <div class="col-sm-6">
                                    <ol class="breadcrumb float-sm-right">
                                        <li class="breadcrumb-item"><a href="../../menu.php">Home</a></li>
                                        <li class="breadcrumb-item active">Productos</li>
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
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_producto">
                                                <i class="fa fa-book"></i> Nuevo Ingreso
                                            </button>
                                            <hr>
                                            <table class="table table-bordered table-hover" id="tbl_lista_productos" style="width: 100%;" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>Producto</th>
                                                        <th>Comision Banco</th>
                                                        <th>SubTotal</th>
                                                        <th>Iva</th>
                                                        <th>Comision Local</th>
                                                        <th>Grupo / Categorias</th>
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
            <div class="modal fade" id="modal_producto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
                data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-lg">
                    <form id="ing_producto">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Ingreso Producto</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-4 col-sm-4">
                                        <label>Producto</label>
                                        <input type="text" class="form-control" id="txtProducto" placeholder="Producto">
                                    </div>
                                    <div class="col-3 col-sm-3">
                                        <label>Comision Banco</label>
                                        <input type="text" id="txtcomBanco" class="form-control" placeholder="ejem(0.59)">
                                    </div>
                                    <div class="col-3 col-sm-3">
                                        <label>Sub Total</label>
                                        <input type="text" id="txtsubtotal" class="form-control" placeholder="ejem(0.86956)">
                                    </div>
                                    <div class="col-3 col-sm-3">
                                        <label>Iva</label>
                                        <input type="text" id="txtiva" class="form-control" placeholder="ejem(0.13)">
                                    </div>
                                    <div class="col-3 col-sm-3">
                                        <label>Comision Local</label>
                                        <input type="text" id="txtcomlocal" class="form-control" placeholder="ejem(1)">
                                    </div>
                                    <div class="col-4 col-sm-4">
                                        <label>Categoria</label>
                                        <select id="slcategoria" class="select2" data-dropdown-css-class="select2-purple" style="width: 100%;" multiple>
                                            <?php while ($filacat = $result_Cat->fetch_assoc()) { ?>
                                                <option value="<?= $filacat['Id'] ?>"><?= $filacat['Nombre'] ?></option>
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


            <!-- Modal de editar-->
            <div class="modal fade" id="modal_productoE" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
                data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-lg">
                    <form id="edit_producto">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Editar Producto</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-5 col-sm-5">
                                        <label>Producto</label>
                                        <input type="hidden" id="idProd">
                                        <input type="text" class="form-control" id="txtProductoE" placeholder="Producto">
                                    </div>
                                    <div class="col-3 col-sm-3">
                                        <label>Comision Banco</label>
                                        <input type="text" id="txtcomBancoE" class="form-control" placeholder="ejem(0.59)">
                                    </div>
                                    <div class="col-3 col-sm-3">
                                        <label>Sub Total</label>
                                        <input type="text" id="txtsubtotalE" class="form-control" placeholder="ejem(0.86956)">
                                    </div>
                                    <div class="col-3 col-sm-3">
                                        <label>Iva</label>
                                        <input type="text" id="txtivaE" class="form-control" placeholder="ejem(0.13)">
                                    </div>
                                    <div class="col-3 col-sm-3">
                                        <label>Comision Local</label>
                                        <input type="text" id="txtcomlocalE" class="form-control" placeholder="ejem(1)">
                                    </div>
                                    <div class="col-4 col-sm-4">
                                        <label>Categoria</label>
                                        <select id="slcategoriaE" class="select2" data-dropdown-css-class="select2-purple" style="width: 100%;" multiple>
                                            <?php while ($filacat1 = $result_Cat1->fetch_assoc()) { ?>
                                                <option value="<?= $filacat1['Id'] ?>"><?= $filacat1['Nombre'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-4 col-sm-4 col-md-4 col-lg-4">
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
                    listar_Productos();
                    const $comBanco = document.getElementById('txtcomBanco');
                    $comBanco.addEventListener('input', () => {
                        let v = $comBanco.value.replace(/[^0-9.]/g, '');
                        v = v.replace(/(\.\d*)\./g, '$1');
                        v = v.replace(/^(\d+)(\.\d{0,2})?.*$/, '$1$2');
                        $comBanco.value = v;
                    });
                    const $subtotal = document.getElementById('txtsubtotal');
                    $subtotal.addEventListener('input', () => {
                        let v = $subtotal.value.replace(/[^0-9.]/g, '');
                        v = v.replace(/(\.\d*)\./g, '$1');
                        v = v.replace(/^(\d+)(\.\d{0,5})?.*$/, '$1$2');
                        $subtotal.value = v;
                    });
                    const $iva = document.getElementById('txtiva');
                    $iva.addEventListener('input', () => {
                        let v = $iva.value.replace(/[^0-9.]/g, '');
                        v = v.replace(/(\.\d*)\./g, '$1');
                        v = v.replace(/^(\d+)(\.\d{0,2})?.*$/, '$1$2');
                        $iva.value = v;
                    });
                    const $comlocal = document.getElementById('txtcomlocal');
                    $comlocal.addEventListener('input', () => {
                        let v = $comlocal.value.replace(/[^0-9.]/g, '');
                        v = v.replace(/(\.\d*)\./g, '$1');
                        v = v.replace(/^(\d+)(\.\d{0,2})?.*$/, '$1$2');
                        $comlocal.value = v;
                    });

                    if (!$('#slcategoriaE').hasClass('select2-hidden-accessible')) {
                        $('#slcategoriaE').select2({
                            dropdownParent: $('#modal_productoE'),
                            maximumSelectionLength: 1,
                            allowClear: true,
                            width: '100%',
                            theme: "classic"
                        });
                    }

                    if (!$('#slcategoria').hasClass('select2-hidden-accessible')) {
                        $('#slcategoria').select2({
                            dropdownParent: $('#modal_producto'),
                            maximumSelectionLength: 1,
                            allowClear: true,
                            width: '100%',
                            theme: "classic"
                        });
                    }
                    $("#edit_producto").submit(function(e) {
                        e.preventDefault();
                        var idProd = $("#idProd").val();
                        var txtProductoE = $("#txtProductoE").val();
                        var txtcomBancoE = $("#txtcomBancoE").val();
                        var txtsubtotalE = $("#txtsubtotalE").val();
                        var txtivaE = $("#txtivaE").val();
                        var txtcomlocalE = $("#txtcomlocalE").val();
                        var slcategoriaE = $("#slcategoriaE").val();
                        var slEstado_E = $("#slEstado_E").val();
                        if (txtProductoE == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Ingrese el nombre del producto",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (txtcomBancoE == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Ingrese la comision del Banco",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (txtsubtotalE == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Ingrese el SubTotal",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (txtivaE == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Ingrese el Iva",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (txtcomlocalE == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Ingrese La comision del Local",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (slcategoriaE == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Seleccione La categoria",
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
                                    idProd: idProd,
                                    txtProductoE: txtProductoE,
                                    txtcomBancoE: txtcomBancoE,
                                    txtsubtotalE: txtsubtotalE,
                                    txtivaE: txtivaE,
                                    txtcomlocalE: txtcomlocalE,
                                    slcategoriaE: slcategoriaE,
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
                                        $("#modal_productoE").modal('hide');
                                        listar_Productos();
                                        $("#loader_div").hide();
                                    }
                                },
                                error: function(jqXHR, exception) {
                                    console.log(jqXHR.responseText);
                                },
                            });
                        }
                    });
                    $("#ing_producto").submit(function(e) {
                        e.preventDefault();
                        var txtProducto = $("#txtProducto").val();
                        var txtcomBanco = $("#txtcomBanco").val();
                        var txtsubtotal = $("#txtsubtotal").val();
                        var txtiva = $("#txtiva").val();
                        var txtcomlocal = $("#txtcomlocal").val();
                        var slcategoria = $("#slcategoria").val();
                        if (txtProducto == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Ingrese el nombre del producto",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (txtcomBanco == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Ingrese la comision del Banco",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (txtsubtotal == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Ingrese el SubTotal",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (txtiva == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Ingrese el Iva",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (txtcomlocal == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Ingrese La comision del Local",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (slcategoria == '') {
                            Swal.fire({
                                icon: 'warning',
                                title: "Seleccione La categoria",
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
                                    txtProducto: txtProducto,
                                    txtcomBanco: txtcomBanco,
                                    txtsubtotal: txtsubtotal,
                                    txtiva: txtiva,
                                    txtcomlocal: txtcomlocal,
                                    slcategoria: slcategoria
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
                                        //$("#modal_caja").modal('hide');
                                        listar_Productos();
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

                function listar_Productos() {
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: 'registro/ajax_listar.php',
                        data: {},
                        success: function(data) {
                            cargar_lista_productos(data);
                        },
                        error: function(jqXHR, exception) {
                            console.log(jqXHR.responseText);
                        },
                    });
                }

                function cargar_lista_productos(data) {
                    var table = $('#tbl_lista_productos').DataTable();
                    table.destroy();
                    table.clear();
                    $('#tbl_lista_productos').dataTable({
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
                                "data": "Producto"
                            },
                            {
                                "data": "Com_Banco"
                            },
                            {
                                "data": "Sub_total"
                            },
                            {
                                "data": "Iva"
                            },
                            {
                                "data": "Com_local"
                            },
                            {
                                "data": "Categorias"
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
                    $('#tbl_lista_productos tbody').on('click', 'button.eliminar', function() {
                        event.preventDefault();
                        var table = $('#tbl_lista_productos').DataTable();
                        var data = table.row($(this).parents('tr')).data();
                        var estado = $(this).parents("tr").find('#spEstado');
                        var idProdEliminar = data.Id;
                        Swal.fire({
                            title: "Estas Seguro ?",
                            text: "De eliminar este Producto !",
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
                                        idProdEliminar: idProdEliminar
                                    },
                                    success: function(data) {
                                        if (data.success) {
                                            Swal.fire({
                                                icon: 'success',
                                                title: data.success,
                                                showConfirmButton: false,
                                                timer: 2000
                                            })
                                            listar_Productos();
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
                    $('#tbl_lista_productos tbody').on('click', 'button.editar', function() {
                        event.preventDefault();
                        var table = $('#tbl_lista_productos').DataTable();
                        var data = table.row($(this).parents('tr')).data();
                        var estado = $(this).parents("tr").find('#spEstado');
                        console.log(data);
                        $("#modal_productoE").modal('show');
                        idProd = $("#idProd").val(data.Id);
                        txtProductoE = $("#txtProductoE").val(data.Producto);
                        txtcomBancoE = $("#txtcomBancoE").val(data.Com_Banco);
                        txtsubtotalE = $("#txtsubtotalE").val(data.Sub_total);
                        txtivaE = $("#txtivaE").val(data.Iva);
                        txtcomlocalE = $("#txtcomlocalE").val(data.Com_local);
                        let selected_cat = data.IdCat.split(',');
                        $("#slcategoriaE").val(selected_cat).trigger("change");
                        slEstado_E = $("#slEstado_E").val(data.Estado);


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
