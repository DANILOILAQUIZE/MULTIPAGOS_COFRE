<?php
include "../../../backend/classes/class.repositorio.php";
session_start();
$repositorio = new Repositorio;
$conec = $repositorio->connectDB();
date_default_timezone_set('America/Guayaquil');

$selectedValues = $_POST['selectedValues'];
$rowId = $_POST['rowId'];
$txtUsuarioEdit = $_SESSION['idUsuario'];


if (is_array($selectedValues)) {
    $sltipo_str = implode(',', $selectedValues);
} else {
    $sltipo_str = $selectedValues;
}


$update = "UPDATE tbl_ingreso_transacciones SET Tipo = '$sltipo_str' WHERE Id = '$rowId' ";
$result_datos = $conec->query($update);
echo json_encode(["success" => "Se Actualizo  la transaccion exitosamente"]);
