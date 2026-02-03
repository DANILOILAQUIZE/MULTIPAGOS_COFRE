<?php
include "../../../backend/classes/class.repositorio.php";
session_start();
$repositorio = new Repositorio;
$conec = $repositorio->connectDB();
date_default_timezone_set('America/Guayaquil');
$idsucuralEliminar = $_POST['idsucuralEliminar'];

$update = "UPDATE sucursales SET Estado = '1' WHERE Id = '$idsucuralEliminar'";
$result=  $conec->query($update);

echo json_encode(["success" => "Sucursal Eliminado Exitosamente "]);
