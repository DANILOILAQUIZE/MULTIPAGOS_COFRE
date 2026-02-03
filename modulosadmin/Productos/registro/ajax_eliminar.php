<?php
include "../../../backend/classes/class.repositorio.php";
session_start();
$repositorio = new Repositorio;
$conec = $repositorio->connectDB();
date_default_timezone_set('America/Guayaquil');
$idProdEliminar = $_POST['idProdEliminar'];

$update = "UPDATE productos SET Estado = '1' WHERE Id = '$idProdEliminar'";
$result=  $conec->query($update);

echo json_encode(["success" => "Producto Eliminado Exitosamente "]);
