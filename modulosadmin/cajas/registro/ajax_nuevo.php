<?php
include "../../../backend/classes/class.repositorio.php";
session_start();
$repositorio = new Repositorio;
$conec = $repositorio->connectDB();
date_default_timezone_set('America/Guayaquil');

$txtcaja = ucwords(strtolower($_POST['txtcaja']));
$slsucursal = $_POST['slsucursal'];

if (is_array($slsucursal)) {
    $slsuc_str = implode(',', $slsucursal);
} else {
    $slsuc_str = $slsucursal;
}


//Este codigo sirve para buscar si ya existe el usuario
$Buscar = "SELECT * FROM cajas WHERE Nombre = '$txtcaja' and Estado = '0' ";
$result_Buscar =  $conec->query($Buscar);
if (mysqli_fetch_row($result_Buscar)) {
    echo json_encode(["su" => "Ya se encuentra la caja registrado con este nombre : " . $txtcaja ]);
} else {
    //Sirve para ingresar usuario nuevo
    $sql_insertar = "INSERT INTO cajas(Nombre,Estado,IdSucursal)VALUES('$txtcaja','0','$slsuc_str')";
    $result_insertar = $conec->query($sql_insertar);
    echo json_encode(["success" => "Se creo la Caja :  " . $txtcaja ]);
}
