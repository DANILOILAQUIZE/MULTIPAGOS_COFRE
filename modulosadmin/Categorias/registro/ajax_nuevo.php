<?php
include "../../../backend/classes/class.repositorio.php";
session_start();
$repositorio = new Repositorio;
$conec = $repositorio->connectDB();
date_default_timezone_set('America/Guayaquil');

$txtcategoria = ucwords(strtolower($_POST['txtcategoria']));

//Este codigo sirve para buscar si ya existe el usuario
$Buscar = "SELECT * FROM categorias WHERE Nombre = '$txtcategoria' and Estado = '0' ";
$result_Buscar =  $conec->query($Buscar);
if (mysqli_fetch_row($result_Buscar)) {
    echo json_encode(["su" => "Ya se encuentra la Categoria registrado con este nombre : " . $txtcategoria ]);
} else {
    //Sirve para ingresar usuario nuevo
    $sql_insertar = "INSERT INTO categorias(Nombre,Estado)VALUES('$txtcategoria','0')";
    $result_insertar = $conec->query($sql_insertar);
    echo json_encode(["success" => "Se creo la Categoria :  " . $txtcategoria ]);
}
