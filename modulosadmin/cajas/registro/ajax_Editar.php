<?php
include "../../../backend/classes/class.repositorio.php";
session_start();
$repositorio = new Repositorio;
$conec = $repositorio->connectDB();
date_default_timezone_set('America/Guayaquil');

$Idcaja_E = $_POST['IdCaja_E_E'];
$caja_E = ucwords(strtolower($_POST['caja_E']));
$slsucursal_E = $_POST['slsucursal_E'];

if (is_array($slsucursal_E)) {
    $slsuc_str = implode(',', $slsucursal_E);
} else {
    $slsuc_str = $slsucursal_E;
}


$update = "UPDATE cajas SET Nombre = '$caja_E',IdSucursal='$slsuc_str' WHERE Id = '$Idcaja_E'   ";
$result_datos = $conec->query($update);
echo json_encode(["success" => "Se Actualizo  la Caja " . $caja_E]);
