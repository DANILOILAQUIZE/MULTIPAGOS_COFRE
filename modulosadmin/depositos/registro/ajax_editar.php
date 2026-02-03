<?php
include "../../../backend/classes/class.repositorio.php";
session_start();
$repositorio = new Repositorio;
$conec = $repositorio->connectDB();
date_default_timezone_set('America/Guayaquil');

$txtidefectivo = $_POST['txtidefectivo'];
$txtvalor_E = $_POST['txtvalor_E'];
$txtn_dep_E = $_POST['txtn_dep_E'];
$slncuenta_E = $_POST['slncuenta_E'];
$slbanco_E = $_POST['slbanco_E'];
$txtncaja_E = $_POST['txtncaja_E'];
$slestado_efectivo = $_POST['slestado_efectivo'];

if (is_array($slncuenta_E)) {
    $slncuenta_str = implode(',', $slncuenta_E);
} else {
    $slncuenta_str = $slncuenta_E;
}




$update = "UPDATE dep_trans_banco SET Valor = '$txtvalor_E',N_Dep='$txtn_dep_E',N_Cuenta='$slncuenta_str',Banco='$slbanco_E',N_caja='$txtncaja_E',Estado='$slestado_efectivo' WHERE Id = '$txtidefectivo'";
$result_datos = $conec->query($update);
echo json_encode(["success" => "Se actualizo el deposito"]);
