<?php
include "../../../backend/classes/class.repositorio.php";
session_start();
$repositorio = new Repositorio;
$conec = $repositorio->connectDB();
date_default_timezone_set('America/Guayaquil');

$txtidrecibodo = $_POST['txtidrecibodo'];
$txtvalor_recibido_E = $_POST['txtvalor_recibido_E'];
$txtdescripcion_E = $_POST['txtdescripcion_E'];
$slncuenta_recibido_E = $_POST['slncuenta_recibido_E'];
$txtconprobante_recibdo_E = $_POST['txtconprobante_recibdo_E'];
$slEstado_recibido_E = $_POST['slEstado_recibido_E'];


$update = "UPDATE transferencia_recibidas SET Valor = '$txtvalor_recibido_E',Descripcion='$txtdescripcion_E',N_Cuenta='$slncuenta_recibido_E',N_Comprobante='$txtconprobante_recibdo_E',Estado='$slEstado_recibido_E' WHERE Id = '$txtidrecibodo'";
$result_datos = $conec->query($update);
echo json_encode(["success" => "Se actualizo La transferencia Recibida"]);
