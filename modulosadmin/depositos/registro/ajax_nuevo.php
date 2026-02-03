<?php
include "../../../backend/classes/class.repositorio.php";
session_start();
$repositorio = new Repositorio;
$conec = $repositorio->connectDB();
date_default_timezone_set('America/Guayaquil');

$txtvalor = $_POST['txtvalor'];
$txtn_dep = $_POST['txtn_dep'];
$slncuenta = $_POST['slncuenta'];
$slbanco = $_POST['slbanco'];
$txtncaja = $_POST['txtncaja'];
$idusuario = $_SESSION['idUsuario'];
$fecha_actual = date('Y-m-d');
$hora = date('H:i:s');


if (is_array($slncuenta)) {
    $slncuenta_str = implode(',', $slncuenta);
} else {
    $slncuenta_str = $slncuenta;
}




$sql_ultimo = "SELECT Numero FROM dep_trans_banco WHERE Id = (SELECT MAX(Id) FROM dep_trans_banco)";
$result_ultimo = $conec->query($sql_ultimo);
$ultimo = 1;
if ($fila = $result_ultimo->fetch_assoc()) {
    if (!empty($fila['Numero'])) {
        $ultimo = $fila['Numero'] + 1;
    }
}
$automatico = str_pad($ultimo, 4, '0', STR_PAD_LEFT);

$sql_insertar = "INSERT INTO dep_trans_banco(Numero,Valor,N_Dep,N_Cuenta,Banco,N_caja,IdUsuario,Fecha,Hora,Estado)
VALUES('$automatico','$txtvalor','$txtn_dep','$slncuenta_str','$slbanco','$txtncaja','$idusuario','$fecha_actual','$hora','0')";
$result_insertar = $conec->query($sql_insertar);
echo json_encode(["success" => "Deposito en efectivo Registrado exitosamente"]);
