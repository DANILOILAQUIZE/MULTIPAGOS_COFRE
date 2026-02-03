<?php
include "../../../backend/classes/class.repositorio.php";
session_start();
$repositorio = new Repositorio;
$conec = $repositorio->connectDB();
date_default_timezone_set('America/Guayaquil');

$txtvalor = $_POST['txtvalor_enviado'];
$slncuenta = $_POST['slncuenta_enviado'];
$slbanco = $_POST['slbanco_enviado'];
$txtncaja = $_POST['txtncaja_enviado'];
$slncuenta_enviado_Destino = $_POST['slncuenta_enviado_Destino'];
$slbancodestino_enviado = $_POST['slbancodestino_enviado'];
$txtcomprobante = $_POST['txtcomprobante'];
$idusuario = $_SESSION['idUsuario'];
$fecha_actual = date('Y-m-d');
$hora = date('H:i:s');



if (is_array($slncuenta)) {
    $slncuenta_str = implode(',', $slncuenta);
} else {
    $slncuenta_str = $slncuenta;
}



if (is_array($slncuenta_enviado_Destino)) {
    $slncuenta_enviado_Destino_str = implode(',', $slncuenta_enviado_Destino);
} else {
    $slncuenta_enviado_Destino_str = $slncuenta_enviado_Destino;
}


$sql_ultimo = "SELECT Numero FROM transferencia_enviado WHERE Id = (SELECT MAX(Id) FROM transferencia_enviado)";
$result_ultimo = $conec->query($sql_ultimo);
$ultimo = 1;
if ($fila = $result_ultimo->fetch_assoc()) {
    if (!empty($fila['Numero'])) {
        $ultimo = $fila['Numero'] + 1;
    }
}
$automatico = str_pad($ultimo, 4, '0', STR_PAD_LEFT);

$sql_insertar = "INSERT INTO transferencia_enviado(Numero,Valor,N_Cuenta,Banco,N_caja,Cuenta_destino,IdUsuario,Fecha,Hora,Estado,Banco_destino,Comprobante)
VALUES('$automatico','$txtvalor','$slncuenta_str','$slbanco','$txtncaja','$slncuenta_enviado_Destino_str','$idusuario','$fecha_actual','$hora','0','$slbancodestino_enviado','$txtcomprobante')";
$result_insertar = $conec->query($sql_insertar);
echo json_encode(["success" => "Deposito en efectivo Registrado exitosamente"]);
