<?php
include "../../../backend/classes/class.repositorio.php";
session_start();
$repositorio = new Repositorio;
$conec = $repositorio->connectDB();
date_default_timezone_set('America/Guayaquil');

$IdSucursals_E = $_POST['IdSucursals_E'];
$sucursal_E = ucwords(strtolower($_POST['sucursal_E']));

$update = "UPDATE sucursales SET Nombre = '$sucursal_E' WHERE Id = '$IdSucursals_E'   ";
$result_datos = $conec->query($update);
echo json_encode(["success" => "Se Actualizo  la sucursal " . $sucursal_E]);
