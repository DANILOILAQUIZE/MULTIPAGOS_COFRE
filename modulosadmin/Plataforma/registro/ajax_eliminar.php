<?php
include "../../../backend/classes/class.repositorio.php";
session_start();
$repositorio = new Repositorio;
$conec = $repositorio->connectDB();
date_default_timezone_set('America/Guayaquil');
$idcajaEliminar = $_POST['idcajaEliminar'];

$update = "UPDATE plataforma_usuario SET Estado = '1' WHERE Id = '$idcajaEliminar'";
$result=  $conec->query($update);

echo json_encode(["success" => "Plataforma Eliminado Exitosamente "]);
