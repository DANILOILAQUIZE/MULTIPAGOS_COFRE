<?php
include "../../../backend/classes/class.repositorio.php";
session_start();
$repositorio = new Repositorio;
$conec = $repositorio->connectDB();
date_default_timezone_set('America/Guayaquil');

$BancoCoac = ucwords(strtolower($_POST['BancoCoac']));

//Este codigo sirve para buscar si ya existe el usuario
$Buscar = "SELECT * FROM tipo_banco WHERE Nombre = '$BancoCoac' and Estado = '0' ";
$result_Buscar =  $conec->query($Buscar);
if (mysqli_fetch_row($result_Buscar)) {
    echo json_encode(["su" => "Ya se encuentra con este nombre Registrado : " . $BancoCoac ]);
} else {
    //Sirve para ingresar usuario nuevo
    $sql_insertar = "INSERT INTO tipo_banco(Nombre,Estado)VALUES('$BancoCoac','0')";
    $result_insertar = $conec->query($sql_insertar);
    echo json_encode(["success" => "Se creo el banco o cooperativa  " . $BancoCoac ]);
}
