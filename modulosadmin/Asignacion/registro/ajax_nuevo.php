<?php
include "../../../backend/classes/class.repositorio.php";
session_start();
$repositorio = new Repositorio;
$conec = $repositorio->connectDB();
date_default_timezone_set('America/Guayaquil');

$slcaja = $_POST['slcaja'];
$slplataforma = $_POST['slplataforma'];

if (is_array($slcaja)) {
    $slcajas_str = implode(',', $slcaja);
} else {
    $slcajas_str = $slcaja;
}


if (is_array($slplataforma)) {
    $slplataforma_str = implode(',', $slplataforma);
} else {
    $slplataforma_str = $slplataforma;
}

$Buscar = "SELECT * FROM asignacion_cajas WHERE IdCaja = '$slcajas_str' AND Estado = '0' ";
$result_Buscar =  $conec->query($Buscar);
if (mysqli_fetch_row($result_Buscar)) {
    echo json_encode(["su" => "Ya se encuentra esta caja registrada "]);
} else {
    //Sirve para ingresar usuario nuevo
    $sql_insertar = "INSERT INTO asignacion_cajas(IdCaja,IdPlataforma,Estado)VALUES('$slcajas_str','$slplataforma_str','0')";
    $result_insertar = $conec->query($sql_insertar);
    echo json_encode(["success" => "Se asigno la caja y sus plataformas "]);
}
