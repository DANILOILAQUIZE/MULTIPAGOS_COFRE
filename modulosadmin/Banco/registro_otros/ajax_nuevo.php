<?php
include "../../../backend/classes/class.repositorio.php";
session_start();
$repositorio = new Repositorio;
$conec = $repositorio->connectDB();
date_default_timezone_set('America/Guayaquil');

$otros = ucwords(strtolower($_POST['otros']));

//Este codigo sirve para buscar si ya existe el usuario
$Buscar = "SELECT * FROM otros_ingresos WHERE Nombre = '$otros' and Estado = '0' ";
$result_Buscar =  $conec->query($Buscar);
if (mysqli_fetch_row($result_Buscar)) {
    echo json_encode(["su" => "Ya se encuentra con este nombre Registrado : " . $otros ]);
} else {
    //Sirve para ingresar usuario nuevo
    $sql_insertar = "INSERT INTO otros_ingresos(Nombre,Estado)VALUES('$otros','0')";
    $result_insertar = $conec->query($sql_insertar);
    echo json_encode(["success" => "Se creo Otro Ingreso como :   " . $otros ]);
}
