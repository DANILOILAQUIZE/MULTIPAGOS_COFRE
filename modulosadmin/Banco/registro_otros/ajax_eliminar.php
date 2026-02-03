<?php
include "../../../backend/classes/class.repositorio.php";
session_start();
$repositorio = new Repositorio;
$conec = $repositorio->connectDB();
date_default_timezone_set('America/Guayaquil');
$idOtroEliminar = $_POST['idOtroEliminar'];

$update = "UPDATE otros_ingresos SET Estado = '1' WHERE Id = '$idOtroEliminar'";
$result=  $conec->query($update);

echo json_encode(["success" => "Otro Ingreso se elimino Exitosamente "]);
