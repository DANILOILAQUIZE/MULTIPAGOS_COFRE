<?php
include "../../../backend/classes/class.repositorio.php";
session_start();
$repositorio = new Repositorio;
$conec = $repositorio->connectDB();
date_default_timezone_set('America/Guayaquil');
$idBancoEliminar = $_POST['idBancoEliminar'];

$update = "UPDATE dep_trans_banco SET Estado = '1' WHERE Id = '$idBancoEliminar'";
$result=  $conec->query($update);

echo json_encode(["success" => "El deposito se Elimino exitosamente"]);
