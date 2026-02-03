<?php
include "../../../backend/classes/class.repositorio.php";
session_start();
$repositorio = new Repositorio;
$conec = $repositorio->connectDB();
date_default_timezone_set('America/Guayaquil');

$IdBancoCoac_E = $_POST['IdBancoCoac_E'];
$BancoCoac_E = ucwords(strtolower($_POST['BancoCoac_E']));

$update = "UPDATE tipo_banco SET Nombre = '$BancoCoac_E' WHERE Id = '$IdBancoCoac_E'   ";
$result_datos = $conec->query($update);
echo json_encode(["success" => "Se Actualizo  el Banco o Coac " . $BancoCoac_E]);
