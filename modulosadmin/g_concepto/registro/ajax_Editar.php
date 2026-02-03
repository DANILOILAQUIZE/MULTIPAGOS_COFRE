<?php
include "../../../backend/classes/class.repositorio.php";
session_start();
$repositorio = new Repositorio;
$conec = $repositorio->connectDB();
date_default_timezone_set('America/Guayaquil');

$Idgasto_E = $_POST['Idgasto_E'];
$gasto_E = ucwords(strtolower($_POST['gasto_E']));
$slEstado_E = $_POST['slEstado_E'];

$update = "UPDATE concepto_gasto SET Nombre = '$gasto_E',Estado = '$slEstado_E' WHERE Id = '$Idgasto_E'   ";
$result_datos = $conec->query($update);
echo json_encode(["success" => "Se Actualizo  el Gasto  " . $gasto_E]);
