<?php
include "../../../backend/classes/class.repositorio.php";
session_start();
$repositorio = new Repositorio;
$conec = $repositorio->connectDB();
date_default_timezone_set('America/Guayaquil');
$idgastoEliminar = $_POST['idgastoEliminar'];

$update = "UPDATE concepto_gasto SET Estado = '1' WHERE Id = '$idgastoEliminar'";
$result=  $conec->query($update);

echo json_encode(["success" => "Gasto Eliminado Exitosamente "]);
