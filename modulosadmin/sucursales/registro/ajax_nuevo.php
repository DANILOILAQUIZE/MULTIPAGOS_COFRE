<?php
include "../../../backend/classes/class.repositorio.php";
session_start();
$repositorio = new Repositorio;
$conec = $repositorio->connectDB();
date_default_timezone_set('America/Guayaquil');

$sucural = ucwords(strtolower($_POST['sucural']));

//Este codigo sirve para buscar si ya existe el usuario
$Buscar = "SELECT * FROM sucursales WHERE Nombre = '$sucural' and Estado = '0' ";
$result_Buscar =  $conec->query($Buscar);
if (mysqli_fetch_row($result_Buscar)) {
    echo json_encode(["su" => "Ya se encuentra la sucursal registrado con este nombre : " . $sucural ]);
} else {
    //Sirve para ingresar usuario nuevo
    $sql_insertar = "INSERT INTO sucursales(Nombre,Estado)VALUES('$sucural','0')";
    $result_insertar = $conec->query($sql_insertar);
    echo json_encode(["success" => "Se creo la sucursal :  " . $sucural ]);
}
