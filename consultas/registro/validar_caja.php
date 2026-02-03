<?php
include "../../backend/classes/class.repositorio.php";
session_start();
$repositorio = new Repositorio;
$conec = $repositorio->connectDB();
date_default_timezone_set('America/Guayaquil');
$sucursalSeleccionada = $_POST['sucursalSeleccionada'];
$cajaSeleccionada = $_POST['cajaSeleccionada'];
$fechaActual = date('Y-m-d');
$nom_usuario = $_SESSION['Usuario'];

if (is_array($sucursalSeleccionada)) {
    $idsuc = implode(',', $sucursalSeleccionada);
} else {
    $idsuc = $sucursalSeleccionada;
}

if (is_array($cajaSeleccionada)) {
    $idcaja = implode(',', $cajaSeleccionada);
} else {
    $idcaja = $cajaSeleccionada;
}

$Buscar = "SELECT * FROM registro_caja WHERE IdSucursal = '$idsuc' AND IdCaja = '$idcaja' AND Fecha = '$fechaActual'  ";
$result_Buscar =  $conec->query($Buscar);
if (mysqli_fetch_row($result_Buscar)) {
    echo json_encode(["su" => "Esta Sucursal y esta caja ya se encuentra ocupado"]);
}else{
    echo json_encode(["success" => "Realize el conteo de Monedas"]);
}

