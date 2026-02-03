<?php
include "../../../backend/classes/class.repositorio.php";
session_start();
$repositorio = new Repositorio;
$conec = $repositorio->connectDB();
date_default_timezone_set('America/Guayaquil');

$idcajas_E = $_POST['idcajas_E'];
$slcaja_E = $_POST['slcaja_E'];
$slplataforma_E = $_POST['slplataforma_E'];
$slEstado_E = $_POST['slEstado_E'];

if (is_array($slcaja_E)) {
    $slcajas_str = implode(',', $slcaja_E);
} else {
    $slcajas_str = $slcaja_E;
}


if (is_array($slplataforma_E)) {
    $slplataforma_str = implode(',', $slplataforma_E);
} else {
    $slplataforma_str = $slplataforma_E;
}



$update = "UPDATE asignacion_cajas SET IdCaja = '$slcajas_str',IdPlataforma='$slplataforma_str',Estado='$slEstado_E' WHERE Id = '$idcajas_E'   ";
$result_datos = $conec->query($update);
echo json_encode(["success" => "Se Actualizo  la Caja y sus plataformas"]);
