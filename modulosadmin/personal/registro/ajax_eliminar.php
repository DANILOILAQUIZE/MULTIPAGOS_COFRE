<?php
include "../../../backend/classes/class.repositorio.php";
session_start();
$repositorio = new Repositorio;
$conec = $repositorio->connectDB();
date_default_timezone_set('America/Guayaquil');
$idUsuarioEliminar = $_POST['idUsuarioEliminar'];

$update = "UPDATE gen_usuarios SET Estado = '1' WHERE Cod_usuario = '$idUsuarioEliminar'";
$result=  $conec->query($update);

echo json_encode(["success" => "Usuario Eliminado Exitosamente "]);
