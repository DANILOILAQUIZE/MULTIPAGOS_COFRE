<?php
include "../../../backend/classes/class.repositorio.php";
session_start();
$repositorio = new Repositorio;
$conec = $repositorio->connectDB();
date_default_timezone_set('America/Guayaquil');

$txtplataforma = $_POST['txtplataforma'];
$txtusuario = $_POST['txtusuario'];
$txtNombreplataforma = $_POST['txtNombreplataforma'];
$slnBanco = $_POST['slnBanco'];

if (is_array($slnBanco)) {
    $slbanco_str = implode(',', $slnBanco);
} else {
    $slbanco_str = $slnBanco;
}

//Este codigo sirve para buscar si ya existe el usuario
// $Buscar = "SELECT * FROM plataforma_usuario WHERE Usuario = '$txtusuario' and Estado = '0' ";
// $result_Buscar =  $conec->query($Buscar);
// if (mysqli_fetch_row($result_Buscar)) {
//     echo json_encode(["su" => "Ya se encuentra la Plataforma registrado con este USUARIO : " . $txtusuario]);
// } else {
    //Sirve para ingresar usuario nuevo
    $sql_insertar = "INSERT INTO plataforma_usuario(Plataforma,Usuario,Estado,Nombre_plataforma,Banco)VALUES('$txtplataforma','$txtusuario','0','$txtNombreplataforma','$slbanco_str')";
    $result_insertar = $conec->query($sql_insertar);
    echo json_encode(["success" => "Se creo la Plaforma :  " . $txtplataforma]);
//}
