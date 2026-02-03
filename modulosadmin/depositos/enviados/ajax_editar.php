<?php
include "../../../backend/classes/class.repositorio.php";
session_start();
$repositorio = new Repositorio;
$conec = $repositorio->connectDB();
date_default_timezone_set('America/Guayaquil');

$txtidenviadoss = $_POST['txtidenviadoss'];
$txtvalor_enviado_E = $_POST['txtvalor_enviado_E'];
$slncuenta_enviado_E = $_POST['slncuenta_enviado_E'];
$slbanco_enviado_E = $_POST['slbanco_enviado_E'];
$txtncaja_enviado_E = $_POST['txtncaja_enviado_E'];
$slncuenta_enviado_Destino_E = $_POST['slncuenta_enviado_Destino_E'];
$slEstado_enviado_E = $_POST['slEstado_enviado_E'];
$slbancoDestino_enviado_E = $_POST['slbancoDestino_enviado_E'];
$txtcomprobante_E = $_POST['txtcomprobante_E'];


if (is_array($slncuenta_enviado_E)) {
    $slncuenta_str = implode(',', $slncuenta_enviado_E);
} else {
    $slncuenta_str = $slncuenta_enviado_E;
}



if (is_array($slncuenta_enviado_Destino_E)) {
    $slncuenta_enviado_Destino_str = implode(',', $slncuenta_enviado_Destino_E);
} else {
    $slncuenta_enviado_Destino_str = $slncuenta_enviado_Destino_E;
}

$update = "UPDATE transferencia_enviado SET Valor = '$txtvalor_enviado_E',N_Cuenta='$slncuenta_str',Banco='$slbanco_enviado_E',N_caja='$txtncaja_enviado_E',Cuenta_destino='$slncuenta_enviado_Destino_str',Estado='$slEstado_enviado_E',Banco_destino='$slbancoDestino_enviado_E',Comprobante='$txtcomprobante_E' WHERE Id = '$txtidenviadoss'";
$result_datos = $conec->query($update);
echo json_encode(["success" => "Se actualizo La transferencia"]);
