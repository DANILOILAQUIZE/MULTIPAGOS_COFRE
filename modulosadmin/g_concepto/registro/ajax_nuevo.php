<?php
include "../../../backend/classes/class.repositorio.php";
session_start();
$repositorio = new Repositorio;
$conec = $repositorio->connectDB();
date_default_timezone_set('America/Guayaquil');

$gasto = ucwords(strtolower($_POST['gasto']));

//Este codigo sirve para buscar si ya existe el usuario
$Buscar = "SELECT * FROM concepto_gasto WHERE Nombre = '$gasto' and Estado = '0' ";
$result_Buscar =  $conec->query($Buscar);
if (mysqli_fetch_row($result_Buscar)) {
    echo json_encode(["su" => "Ya se encuentra el Gasto registrado con este nombre : " . $gasto ]);
} else {
    //Sirve para ingresar usuario nuevo
    $sql_insertar = "INSERT INTO concepto_gasto(Nombre,Estado)VALUES('$gasto','0')";
    $result_insertar = $conec->query($sql_insertar);
    echo json_encode(["success" => "Se creo el Gasto :  " . $gasto ]);
}
