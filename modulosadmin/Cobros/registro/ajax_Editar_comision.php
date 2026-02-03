<?php
include "../../../backend/classes/class.repositorio.php";
session_start();
$repositorio = new Repositorio;
$conec = $repositorio->connectDB();
date_default_timezone_set('America/Guayaquil');

$valor = $_POST['valor'];
$rowId = $_POST['rowId'];
$txtUsuarioEdit = $_SESSION['idUsuario'];


$update = "UPDATE tbl_ingreso_transacciones SET Dif_com_bamco = '$valor' WHERE Id = '$rowId' ";
$result_datos = $conec->query($update);
echo json_encode(["success" => "Se Actualizo la comision del banco exitosamente"]);
