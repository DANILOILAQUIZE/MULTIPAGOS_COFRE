<?php
include "../../../backend/classes/class.repositorio.php";
session_start();
$repositorio = new Repositorio;
$conec = $repositorio->connectDB();
date_default_timezone_set('America/Guayaquil');

$slopciones = $_POST['slopciones'];
$Tipo = '';
if ($slopciones == 1) {
    $txtvalor_recibido = $_POST['txtvalor_recibido'];
    $txtdescripcion = $_POST['txtdescripcion'];
    $slncuenta_recibido = 0;
    $txtconprobante_recibdo = 0;
    $slgasto_recibido = $_POST['slgasto_recibido'];

    $idusuario = $_SESSION['idUsuario'];
    $fecha_actual = date('Y-m-d');
    $hora = date('H:i:s');
    $Tipo = "Efectivo";

    // if (is_array($slncuenta_recibido)) {
    //     $slncuenta_str = implode(',', $slncuenta_recibido);
    // } else {
    //     $slncuenta_str = $slncuenta_recibido;
    // }

    if (is_array($slgasto_recibido)) {
        $slgasto_str = implode(',', $slgasto_recibido);
    } else {
        $slgasto_str = $slgasto_recibido;
    }


    $sql_insertar = "INSERT INTO transferencia_recibidas(Valor,Descripcion,N_Cuenta,N_Comprobante,IdUsuario,Fecha,Hora,Estado,Concepto_Gasto,Tipo_Ingreso)
VALUES('$txtvalor_recibido','$txtdescripcion','$slncuenta_recibido','$txtconprobante_recibdo','$idusuario','$fecha_actual','$hora','0','$slgasto_str','$Tipo')";
    $result_insertar = $conec->query($sql_insertar);
    echo json_encode(["success" => "Transferencia Recibida Registrado exitosamente"]);
} else if ($slopciones == 2) {
    $txtvalor_recibido1 = $_POST['txtvalor_recibido1'];
    $txtdescripcion1 = $_POST['txtdescripcion1'];
    $slgasto_recibido1 = $_POST['slgasto_recibido1'];
    $slncuenta_recibido1 = $_POST['slncuenta_recibido1'];
    $txtconprobante_recibdo1 = $_POST['txtconprobante_recibdo1'];

    $Tipo = "Transferencia";
    $idusuario = $_SESSION['idUsuario'];
    $fecha_actual = date('Y-m-d');
    $hora = date('H:i:s');
    $Tipo = "Transferencia";

    if (is_array($slncuenta_recibido1)) {
        $slncuenta_str = implode(',', $slncuenta_recibido1);
    } else {
        $slncuenta_str = $slncuenta_recibido1;
    }

    if (is_array($slgasto_recibido1)) {
        $slgasto_str = implode(',', $slgasto_recibido1);
    } else {
        $slgasto_str = $slgasto_recibido;
    }


    $sql_insertar = "INSERT INTO transferencia_recibidas(Valor,Descripcion,N_Cuenta,N_Comprobante,IdUsuario,Fecha,Hora,Estado,Concepto_Gasto,Tipo_Ingreso)
VALUES('$txtvalor_recibido1','$txtdescripcion1','$slncuenta_str','$txtconprobante_recibdo1','$idusuario','$fecha_actual','$hora','0','$slgasto_str','$Tipo')";
    $result_insertar = $conec->query($sql_insertar);
    echo json_encode(["success" => "Transferencia Recibida Registrado exitosamente"]);
}
