<?php
include "../../../backend/classes/class.repositorio.php";
session_start();
$repositorio = new Repositorio;
$conec = $repositorio->connectDB();
date_default_timezone_set('America/Guayaquil');

$Idplataforma_E_E = $_POST['Idplataforma_E_E'];
$txtplataforma_E = $_POST['txtplataforma_E'];
$txtusuario_E = $_POST['txtusuario_E'];
$txtNombreplataforma_E = $_POST['txtNombreplataforma_E'];
$slnBanco_E = $_POST['slnBanco_E'];

if (is_array($slnBanco_E)) {
    $slbanco_str = implode(',', $slnBanco_E);
} else {
    $slbanco_str = $slnBanco_E;
}

$update = "UPDATE plataforma_usuario SET Plataforma = '$txtplataforma_E',Usuario='$txtusuario_E',Nombre_plataforma='$txtNombreplataforma_E',Banco = '$slbanco_str' WHERE Id = '$Idplataforma_E_E'   ";
$result_datos = $conec->query($update);
echo json_encode(["success" => "Se Actualizo  la Plataforma " . $txtplataforma_E]);
