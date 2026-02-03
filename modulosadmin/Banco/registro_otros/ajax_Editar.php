<?php
include "../../../backend/classes/class.repositorio.php";
session_start();
$repositorio = new Repositorio;
$conec = $repositorio->connectDB();
date_default_timezone_set('America/Guayaquil');

$IdOtros_E = $_POST['IdOtros_E'];
$OtrosIngreso_E = ucwords(strtolower($_POST['OtrosIngreso_E']));

$update = "UPDATE otros_ingresos SET Nombre = '$OtrosIngreso_E' WHERE Id = '$IdOtros_E'   ";
$result_datos = $conec->query($update);
echo json_encode(["success" => "Se Actualizo  el Ingreso " . $OtrosIngreso_E]);
