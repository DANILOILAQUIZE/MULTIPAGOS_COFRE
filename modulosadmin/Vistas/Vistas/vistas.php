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
?>

        <!DOCTYPE html>
        <html lang="es">

        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="icon" type="image/png" href="../../../img/multipagos.jpg" />
            <title>Administración Vistas</title>

            <!-- Google Font: Source Sans Pro -->
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
            <!-- Font Awesome -->
            <link rel="stylesheet" href="../../../frontend/plugins/fontawesome-free/css/all.min.css">
            <!-- DataTables -->
            <link rel="stylesheet" href="../../../frontend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
            <link rel="stylesheet" href="../../../frontend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
            <link rel="stylesheet" href="../../../frontend/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
            <!-- overlayScrollbars -->
            <link rel="stylesheet" href="../../../frontend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
            <!-- Theme style -->
            <link rel="stylesheet" href="../../../frontend/dist/css/adminlte.min.css">
            <!-- select2 -->
            <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

        </head>

        <body class="hold-transition sidebar-collapse sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
            <div class="wrapper">

                <?php include $path_so; ?>

                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <section class="content-header">
                        <div class="container-fluid">
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <h1>Administración Vistas</h1>
                                </div>
                                <div class="col-sm-6">
                                    <ol class="breadcrumb float-sm-right">
                                        <li class="breadcrumb-item"><a href="../../../menu.php">Home</a></li>
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

                    <div id="modalVistas" class="modal" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="tituloModal"></h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="nomVista">Nombre Vista</label>
                                            <input class="form-control" id="nomVista" type="text">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="tipoVista">Tipo Vista</label>
                                            <select class="form-control" id="tipoVista" onchange="valTipoVista();">
                                                <option value="1">Principal</option>
                                                <option value="2">Secundaria</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 form-group" id="divPathVista">
                                            <label for="pathVista">Path</label>
                                            <input class="form-control" id="pathVista" placeholder="/modulosadmin/modulo/vista/nombreVista.php">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <label for="descripcionVista">Descripción</label>
                                            <textarea class="form-control" id="descripcionVista"></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 form-group" id="divTitulo">
                                            <label for="tituloVista">Modulo</label>
                                            <select class="form-control" id="tituloVista">
                                                <option value="0">-</option>
                                                <?php
                                                foreach ($repositorio->getArrayTablaDB('idVistasTitulos,Titulo', 'vistas_titulos', 'Titulo') as $items) {
                                                    echo "<option value='{$items['idVistasTitulos']}'>{$items['Titulo']}</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="iconoVista">Icono Vista</label>
                                            <input type="text" class="form-control" id="iconoVista">
                                        </div>
                                    </div>
                                    <div class="row" id="divVistaPrincipal">
                                        <div class="col-md-12 form-group">
                                            <label for="vistaPrincipal">Vista Principal</label>
                                            <select class="form-control" id="vistaPrincipal">
                                                <option value="0">-</option>
                                                <?php
                                                foreach ($repositorio->getArrayTablaDB('idVistas,nombreVista', 'vistas WHERE tipoVista = 1', 'nombreVista') as $items) {
                                                    echo "<option value='{$items['idVistas']}'>{$items['nombreVista']}</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" id="idVista" value="">
                                    <button type="button" class="btn btn-primary" onclick="addEditVista();"><i class="fa fa-save"> </i> Guardar</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="modalAsignacion" class="modal" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">ASIGNACION DE VISTAS</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <label for="modalPerfil">Perfil</label>
                                            <select class="form-control" id="modalPerfil">
                                                <?php echo $perfiles; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <label for="selecVista">Vista</label>
                                            <select class="form-control" id="selecVista" onchange="getSubvistas();">
                                                <option value="0">-</option>
                                                <?php
                                                foreach ($repositorio->getArrayTablaDB('idVistas,nombreVista', 'vistas WHERE tipoVista = 1', 'idVistas') as $items) {
                                                    echo "<option value='{$items['idVistas']}'>{$items['nombreVista']}</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <label for="selecSubvista">Subvistas</label>
                                            <select class="form-control" id="selecSubvista" multiple="multiple" style="width: 100%;">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" onclick="addDelAsignacion(0);"> <i class="fa fa-arrow-right"></i> Asignar</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.modal -->


                    <!-- Main content -->
                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <!-- /.col encabezado-->
                                <div class="col-12">
                                    <div class="card">
                                        <!--div class="card-header">
                  buttons
                </div-->
                                        <!-- /.Tabs -->
                                        <div class="card-body">
                                            <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="modulos-tab" data-toggle="tab" href="#modulos" role="tab" aria-controls="modulos" aria-selected="true"><i class="fa fa-server" aria-hidden="true"></i> MODULOS</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="vista-tab" data-toggle="tab" href="#vista" role="tab" aria-controls="vista" aria-selected="true"><i class="fa fa-desktop" aria-hidden="true"></i> VISTAS</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="asignarVista-tab" data-toggle="tab" href="#asignarVista" role="tab" aria-controls="asignarVista" aria-selected="false"><i class="fa fa-cogs" aria-hidden="true"></i> ASIGNACION VISTAS</a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="modulos" role="tabpanel" aria-labelledby="modulos-tab">
                                                    <div class="card dashboard_graph">
                                                        <div class="card-body">
                                                            <div class="white-box" style="width:100%">
                                                                <div class="table-responsive">
                                                                    <div class="x_content">
                                                                        <table id='tableModulos' class='table table-bordered table-hover' width='100%'>
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>MODULO</th>
                                                                                    <th></th>
                                                                                </tr>
                                                                            </thead>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="vista" role="tabpanel" aria-labelledby="vista-tab">
                                                    <div class="card dashboard_graph">
                                                        <div class="card-body">
                                                            <div class="white-box" style="width:100%">
                                                                <div class="table-responsive">
                                                                    <div class="x_content">
                                                                        <table id='tableVistas' class='table table-bordered table-hover' width='100%'>
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>ID VISTA</th>
                                                                                    <th>NOMBRE</th>
                                                                                    <th>PATH</th>
                                                                                    <th>DESCRIPCION</th>
                                                                                    <th>TIPO</th>
                                                                                    <th>ICONO</th>
                                                                                    <th>VISTA</th>
                                                                                    <th>MODULO</th>
                                                                                    <th></th>
                                                                                </tr>
                                                                            </thead>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="asignarVista" role="tabpanel" aria-labelledby="asignarVista-tab">
                                                    <div class="card dashboard_graph">
                                                        <div class="card-body">
                                                            <div class="white-box" style="width:100%">
                                                                <div class="row">
                                                                    <div class="col-md-5">
                                                                        <label for="tipoUsuario">Perfil</label>
                                                                        <select id="tipoUsuario" class="form-control" onchange="getVistasAsignadas();">
                                                                            <option value="0">Todos</option>
                                                                            <?php echo $perfiles; ?>
                                                                        </select>
                                                                    </div>
                                                                </div><br>
                                                                <div class="table-responsive">
                                                                    <div class="x_content">
                                                                        <table id='tableAsignacion' class='table table-bordered table-hover' width='100%'>
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>ID PERFIL</th>
                                                                                    <th>PERFIL</th>
                                                                                    <th>VISTA</th>
                                                                                    <th>SUBVISTA</th>
                                                                                    <th></th>
                                                                                </tr>
                                                                            </thead>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.Tabs F -->

                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- /.content -->

                </div>
                <!-- /.content-wrapper -->
            </div>
            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
            <?php include $footer; ?>
            <!-- ./wrapper -->

            <!-- jQuery -->
            <script src="../../../frontend/plugins/jquery/jquery.min.js"></script>
            <!-- Bootstrap 4 -->
            <script src="../../../frontend/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
            <!-- overlayScrollbars -->
            <script src="../../../frontend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
            <!-- DataTables  & Plugins -->
            <script src="../../../frontend/plugins/datatables/jquery.dataTables.min.js"></script>
            <script src="../../../frontend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
            <script src="../../../frontend/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
            <script src="../../../frontend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
            <script src="../../../frontend/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
            <script src="../../../frontend/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
            <script src="../../../frontend/plugins/jszip/jszip.min.js"></script>
            <script src="../../../frontend/plugins/pdfmake/pdfmake.min.js"></script>
            <script src="../../../frontend/plugins/pdfmake/vfs_fonts.js"></script>
            <script src="../../../frontend/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
            <script src="../../../frontend/plugins/datatables-buttons/js/buttons.print.min.js"></script>
            <script src="../../../frontend/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
            <!-- AdminLTE App -->
            <script src="../../../frontend/dist/js/adminlte.min.js"></script>
            <!-- AdminLTE for demo purposes -->
            <script src="../../../frontend/dist/js/demo.js"></script>
            <!-- select2 -->
            <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
            <!-- PAGE PLUGINS -->
            <!-- jQuery Mapael -->
            <script src="../../../frontend/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
            <script src="../../../frontend/plugins/raphael/raphael.min.js"></script>
            <script src="../../../frontend/plugins/jquery-mapael/jquery.mapael.min.js"></script>
            <script src="../../../frontend/plugins/jquery-mapael/maps/usa_states.min.js"></script>
            <!-- ChartJS -->
            <script src="../../../frontend/plugins/chart.js/Chart.min.js"></script>

            <script>
                getVistas();
                valTipoVista();
                getVistasAsignadas();
                getModulos();

                $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                    $($.fn.dataTable.tables(true)).DataTable()
                        .columns.adjust();
                });

                function getVistas() {
                    $.ajax({
                        type: "POST",
                        url: "Vistas/ajax.getVistas.php",
                        success: function(data) {
                            var dTable = $('#tableVistas').DataTable();
                            dTable.destroy();
                            dTable.clear();
                            $('#tableVistas').DataTable({
                                deferRender: true,
                                data: data,
                                columns: [{
                                        "data": "idVistas"
                                    },
                                    {
                                        "data": "nombreVista"
                                    },
                                    {
                                        "data": "pathVista"
                                    },
                                    {
                                        "data": "descripcionVista"
                                    },
                                    {
                                        "data": "nomTipoVista"
                                    },
                                    {
                                        "data": "iconoVista"
                                    },
                                    {
                                        "data": "vistasIdVistas"
                                    },
                                    {
                                        "data": "Titulo"
                                    },
                                    {
                                        render: function(data, type, full, meta) {
                                            return `
                    <a href='#' class='btn btn-sm btn-icon btn-pure btn-default on-default edit-row' data-toggle='tooltip' title='Modificar' onclick='modalVistas(` + full.idVistas + `);'><i class='fa fa-edit' aria-hidden='true'></i></a>`;
                                        }
                                    },
                                ],
                                dom: 'Bfrtip',
                                buttons: ['copy', 'excel', {
                                    text: 'Agregar Vista',
                                    action: function(e, dt, node, config) {
                                        modalVistas(0);
                                    }
                                }],
                                scrollX: true,
                                scrollY: "400px",
                                scrollCollapse: true,
                                paging: false,
                                language: {
                                    "url": "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                                }
                            });
                        },
                        dataType: 'json'
                    });
                }

                function valTipoVista() {
                    var vistaPrincipal = document.getElementById('divVistaPrincipal');
                    var dit = document.getElementById('divTitulo');
                    var path = document.getElementById('divPathVista');
                    if (document.getElementById('tipoVista').value == '2') {
                        vistaPrincipal.style.display = '';
                        dit.style.display = 'none';
                        document.getElementById('tituloVista').value = '0';
                        path.style.display = '';
                    } else {
                        vistaPrincipal.style.display = 'none';
                        dit.style.display = '';
                        path.style.display = 'none';
                        document.getElementById('pathVista').value = '';
                        document.getElementById('vistaPrincipal').value = '0';
                    }
                }

                function modalVistas(id) {
                    $('#modalVistas').modal('show');
                    if (id == 0) {
                        $('#tituloModal').html("AGREGAR NUEVA VISTA");
                        $("#idVista").val(0);
                        $('#nomVista').val('');
                        $('#tipoVista').val('1');
                        $('#pathVista').val('');
                        $('#descripcionVista').val('');
                        $('#iconoVista').val('');
                        valTipoVista();
                    } else {
                        $('#tituloModal').html('MODIFICAR VISTA');
                        $.ajax({
                            type: "POST",
                            url: "Vistas/ajax.getVistas.php",
                            data: {
                                'id': id
                            },
                            success: function(data) {
                                $("#idVista").val(id);
                                $('#nomVista').val(data[0].nombreVista);
                                $('#tipoVista').val(data[0].tipoVista);
                                $('#pathVista').val(data[0].pathVista);
                                $('#descripcionVista').val(data[0].descripcionVista);
                                $('#iconoVista').val(data[0].iconoVista);
                                $('#vistaPrincipal').val(data[0].vistasIdVistas);
                                $("#tituloVista").val(data[0].tituloVista);
                                valTipoVista();
                            },
                            dataType: 'json'
                        });
                    }
                }

                function getSubvistas() {
                    var vp = document.getElementById('selecVista').value;
                    if (vp != '0') {
                        $.ajax({
                            type: "POST",
                            url: "Vistas/ajax.getSubvistas.php",
                            data: {
                                'vp': vp
                            },
                            success: function(data) {
                                document.getElementById('selecSubvista').innerHTML = data;
                                $('#selecSubvista').select2();
                            },
                            dataType: 'html'
                        });
                    } else {
                        document.getElementById('selecSubvista').innerHTML = '';
                    }
                }

                function addEditVista() {
                    var tipo = $('#tipoVista').val();
                    var nombre = $('#nomVista').val();
                    var icono = $('#iconoVista').val();
                    var path = $('#pathVista').val();
                    var vistaPrincipal = $('#vistaPrincipal').val();
                    if (nombre == '' || icono == '' || (tipo == 2 && (path == '' || vistaPrincipal == '0'))) {
                        alert('INGRESE TODA LA INFORMACION');
                    } else {
                        $.ajax({
                            type: "POST",
                            url: "Vistas/ajax.addEditVista.php",
                            data: {
                                'idVista': $("#idVista").val(),
                                'nomVista': nombre,
                                'tipoVista': tipo,
                                'iconoVista': icono,
                                'pathVista': path,
                                'vistaPrincipal': vistaPrincipal,
                                'descripcionVista': $('#descripcionVista').val(),
                                'titulo': $('#tituloVista').val()
                            },
                            success: function(data) {
                                if (data == '') {
                                    location.reload();
                                } else {
                                    alert(data);
                                }
                            },
                            dataType: 'html'
                        });
                    }
                }

                function getVistasAsignadas() {
                    $.ajax({
                        type: "POST",
                        url: "Vistas/ajax.getVistasAsignadas.php",
                        data: {
                            "perfil": document.getElementById('tipoUsuario').value
                        },
                        success: function(data) {
                            var dTable = $('#tableAsignacion').DataTable();
                            dTable.destroy();
                            dTable.clear();
                            $('#tableAsignacion').DataTable({
                                deferRender: true,
                                data: data,
                                columns: [{
                                        "data": "idPerfil"
                                    },
                                    {
                                        "data": "Tipo"
                                    },
                                    {
                                        "data": "Principal"
                                    },
                                    {
                                        "data": "nombreVista"
                                    },
                                    {
                                        render: function(data, type, full, meta) {
                                            return "<a href='#' class='btn btn-sm btn-icon btn-pure btn-default on-default edit-row' data-toggle='tooltip' title='Eliminar' onclick='addDelAsignacion(" + full.idAsignacionVistasPerfil + "," + full.tipoVista + ");'><i class='fa fa-trash' aria-hidden='true'></i></a>";
                                        }
                                    },
                                ],
                                dom: 'Bfrtip',
                                buttons: ['copy', 'excel', {
                                    text: 'Nueva Asignación',
                                    action: function(e, dt, node, config) {
                                        $('#modalAsignacion').modal('show');
                                        document.getElementById('selecVista').value = '0';
                                        getSubvistas();
                                    }
                                }],
                                scrollX: true,
                                scrollY: "400px",
                                scrollCollapse: true,
                                paging: false,
                                language: {
                                    "url": "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                                }
                            });
                        },
                        dataType: 'json'
                    });
                }

                function addDelAsignacion(idAsignacion, tipoVista = 0) {
                    var x = 1,
                        perfil = 0,
                        vista = 0,
                        subvistas = [];
                    if (idAsignacion == 0) {
                        const selected = document.querySelectorAll('#selecSubvista option:checked');
                        subvistas = Array.from(selected).map(el => el.value);
                        vista = document.getElementById('selecVista').value;
                        perfil = document.getElementById('modalPerfil').value;
                        if (subvistas.length == 0 || vista == '0') {
                            x = 0
                        }
                    }
                    if (x == 1) {
                        $.ajax({
                            type: "POST",
                            url: "Vistas/ajax.addDelAsignacion.php",
                            data: {
                                'idAsignacion': idAsignacion,
                                'tipoVista': tipoVista,
                                'vista': vista,
                                'subvistas': subvistas,
                                'perfil': perfil
                            },
                            success: function(data) {
                                $('#modalAsignacion').modal('hide');
                                getVistasAsignadas();
                            },
                            dataType: 'html'
                        });
                    } else {
                        alert('INGRESE TODA LA INFORMACION');
                    }
                }

                function getModulos() {
                    $.ajax({
                        type: "POST",
                        url: "Vistas/ajax.getModulos.php",
                        success: function(data) {
                            var dTable = $('#tableModulos').DataTable();
                            dTable.destroy();
                            dTable.clear();
                            $('#tableModulos').DataTable({
                                deferRender: true,
                                data: data,
                                columns: [{
                                        "data": "Titulo"
                                    },
                                    {
                                        render: function(data, type, full, meta) {
                                            return `
                    <a href='#' class='btn btn-sm btn-icon btn-pure btn-default on-default edit-row' data-toggle='tooltip' title='Modificar' onclick='modalModulos(` + full.idVistasTitulos + `);'><i class='fa fa-edit' aria-hidden='true'></i></a>`;
                                        }
                                    },
                                ],
                                dom: 'Bfrtip',
                                buttons: ['copy', 'excel', {
                                    text: 'Agregar Modulo',
                                    action: function(e, dt, node, config) {
                                        modalModulos(0);
                                    }
                                }],
                                scrollX: true,
                                scrollY: "400px",
                                scrollCollapse: true,
                                paging: false,
                                language: {
                                    "url": "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                                }
                            });
                        },
                        dataType: 'json'
                    });
                }

                function modalModulos(id) {
                    $('#modalModulos').modal('show');
                    $('#nomModulo').val('');
                    $("#idModulo").val(id);
                    if (id == 0) {
                        $('#titleModal').html("AGREGAR NUEVO MODULO");
                    } else {
                        $('#titleModal').html('MODIFICAR MODULO');
                        $.ajax({
                            type: "POST",
                            url: "Vistas/ajax.getModulos.php",
                            data: {
                                'id': id
                            },
                            success: function(data) {
                                $('#nomModulo').val(data[0].Titulo);
                            },
                            dataType: 'json'
                        });
                    }
                }

                function addEditModulo() {
                    var nombre = $('#nomModulo').val();
                    if (nombre == '') {
                        alert('INGRESE TODA LA INFORMACION');
                    } else {
                        $.ajax({
                            type: "POST",
                            url: "Vistas/ajax.addEditModulo.php",
                            data: {
                                'idModulo': $("#idModulo").val(),
                                'nomModulo': nombre
                            },
                            success: function(data) {
                                if (data == '') {
                                    location.reload();
                                } else {
                                    alert(data);
                                }
                            },
                            dataType: 'html'
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
