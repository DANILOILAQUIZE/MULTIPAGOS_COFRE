<?php
include "../../../backend/classes/class.repositorio.php";
include_once "../../../backend/libraries/PHPXLSXWriter/xlsxwriter.class.php";
ini_set('display_errors', 0);
ini_set('log_errors', 1);
error_reporting(E_ALL & ~E_NOTICE);

$filename = 'Reportes Trabajadores.xlsx';
header('Content-disposition: attachment; filename="' . XLSXWriter::sanitize_filename($filename) . '"');
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate');
header('Pragma: public');
$repositorio = new Repositorio;
$conec = $repositorio->connectDB();
date_default_timezone_set('America/Guayaquil');
$fechaActual = date('Y-m-d');
$Id_Usuario = $_SESSION['idUsuario'];
$header = array("string", "string", "string", "string", "string", "string", "string", "string", "string", "string");
$sheet_name = 'Hoja1';
$writer = new XLSXWriter();
$writer->writeSheetHeader($sheet_name, $header, $suppress_header_row = true);
$writer->writeSheetRow(
    $sheet_name,
    array('REPORTE TRABAJADORES ACTIVOS'),
    array('font-style' => 'bold', 'halign' => 'center')
);


$sql_otros = "SELECT * FROM otros_ingresos WHERE Estado = '0'";
$result_otros = $conec->query($sql_otros);
$otros_array = [];

while ($fila_otros = mysqli_fetch_array($result_otros)) {
    $otros = $fila_otros['Nombre'];
    if (!in_array($otros, $otros_array)) {
        $otros_array[] = $otros;
    }
}

$header = array('Apellidos', 'Nombres', 'Fecha Nacimiento', 'Fecha Entrada', 'Cuenta Num', 'Tipo Cuenta', 'Banco o Coac', 'Usuario Ingreso', 'Sueldo');
$header = array_merge($header, $otros_array);
$writer->writeSheetRow(
    $sheet_name,
    $header,
    array('font-style' => 'bold', 'halign' => 'center', 'fill' => '#eee', 'border' => 'left,right,top,bottom')
);

foreach ($datos as $dato) {
    $row = array_merge($dato, $otros_array);

    $writer->writeSheetRow(
        $sheet_name,
        $row,
        array('halign' => 'center', 'border' => 'left,right,top,bottom')
    );
}

$tipos = "SELECT 
(g.Cod_usuario)AS IdUsuario,
(d.Apellido)AS Apellidos,
(d.Nombre)AS Nombre,
(d.Fecha_Nacimiento)AS FN,
(d.Fecha_Entrada)AS FE,
(d.Sueldo)AS Sueldo,
GROUP_CONCAT(o.Nombre SEPARATOR '\<br>\<br>') AS Otros,
(d.cuentanum)AS NC,
(tc.Nombre)AS TCuenta,
(b.Nombre)AS Banco,
(g.Usuario)AS Usuario,
(tipo_u.Tipo)AS Tipo_Usuario,
GROUP_CONCAT(o.Id SEPARATOR ',') AS IdOtros,
(tc.Id)AS IdTipoCuenta,
(b.Id)AS IdBanco,
(g.Estado)AS Estado
FROM datos_usuarios d
INNER JOIN gen_usuarios g ON d.IdUsuario = g.Cod_usuario
INNER JOIN otros_ingresos o ON FIND_IN_SET(o.Id, d.Otros)
INNER JOIN tipo_cuenta tc ON d.Tipo_cuenta = tc.Id
INNER JOIN tipo_banco b ON d.BancoCoac = b.Id
INNER JOIN tipo_usuario tipo_u ON g.Tipo_usuario = tipo_u.Id
WHERE g.Estado = '0'
GROUP BY g.Cod_usuario";
$result_Buscar_tipo =  $conec->query($tipos);
while ($fila = mysqli_fetch_array($result_Buscar_tipo)) {
    $writer->writeSheetRow(
        $sheet_name,
        array($fila['Apellidos'], $fila['Nombre'], $fila['FN'], $fila['FE'], $fila['NC'], $fila['TCuenta'], $fila['Banco'], $fila['Usuario'], number_format(round($fila['Sueldo'], 2), 2, '.', ',')),
        array('fill' => $background)
    );
}


$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 0, $end_row = 0, $end_col = 9);
$writer->writeToStdOut();
exit(0);
