<?php
include "../../../backend/classes/class.repositorio.php";
session_start();
$repositorio = new Repositorio;
$conec = $repositorio->connectDB();
date_default_timezone_set('America/Guayaquil');

$txtvalor_recibido = $_POST['txtvalor_recibido'];
$txtdescripcion = $_POST['txtdescripcion'];
$slncuenta_recibido = $_POST['slncuenta_recibido'];
$txtconprobante_recibdo = $_POST['txtconprobante_recibdo'];

$idusuario = $_SESSION['idUsuario'];
$fecha_actual = date('Y-m-d');
$hora = date('H:i:s');


$sql_insertar = "INSERT INTO transferencia_recibidas(Valor,Descripcion,N_Cuenta,N_Comprobante,IdUsuario,Fecha,Hora,Estado)
VALUES('$txtvalor_recibido','$txtdescripcion','$slncuenta_recibido','$txtconprobante_recibdo','$idusuario','$fecha_actual','$hora','0')";
$result_insertar = $conec->query($sql_insertar);
echo json_encode(["success" => "Transferencia Recibida Registrado exitosamente"]);
