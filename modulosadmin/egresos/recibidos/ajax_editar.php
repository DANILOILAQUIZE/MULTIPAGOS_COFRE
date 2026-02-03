<?php
include "../../../backend/classes/class.repositorio.php";
session_start();
$repositorio = new Repositorio;
$conec = $repositorio->connectDB();
date_default_timezone_set('America/Guayaquil');
$txtTipo = $_POST['txtTipo'];
if ($txtTipo == 'Efectivo') {
    $txtidrecibodo = $_POST['txtidrecibodo'];
    $txtvalor_recibido_E = $_POST['txtvalor_recibido_E'];
    $txtdescripcion_E = $_POST['txtdescripcion_E'];
    $slgasto_recibido_E = $_POST['slgasto_recibido_E'];
    $slEstado_recibido_E = $_POST['slEstado_recibido_E'];

    // if (is_array($slncuenta_recibido_E)) {
    //     $slncuenta_str = implode(',', $slncuenta_recibido_E);
    // } else {
    //     $slncuenta_str = $slncuenta_recibido_E;
    // }

    if (is_array($slgasto_recibido_E)) {
        $slgasto_str = implode(',', $slgasto_recibido_E);
    } else {
        $slgasto_str = $slgasto_recibido_E;
    }

    $update = "UPDATE transferencia_recibidas SET Valor = '$txtvalor_recibido_E',Descripcion='$txtdescripcion_E',Estado='$slEstado_recibido_E',Concepto_Gasto='$slgasto_str' WHERE Id = '$txtidrecibodo'";
    $result_datos = $conec->query($update);
    echo json_encode(["success" => "Se actualizo La transferencia Recibida"]);
} else if ($txtTipo == 'Transferencia') {
    $txtidrecibodo1 = $_POST['txtidrecibodo1'];
    $txtvalor_recibido_E1 = $_POST['txtvalor_recibido_E1'];
    $txtdescripcion_E1 = $_POST['txtdescripcion_E1'];
    $slgasto_recibido_E1 = $_POST['slgasto_recibido_E1'];
    $slncuenta_recibido_E1 = $_POST['slncuenta_recibido_E1'];
    $slEstado_recibido_E1 = $_POST['slEstado_recibido_E1'];
    $txtconprobante_recibdo_E1 = $_POST['txtconprobante_recibdo_E1'];

    if (is_array($slncuenta_recibido_E1)) {
        $slncuenta_str = implode(',', $slncuenta_recibido_E1);
    } else {
        $slncuenta_str = $slncuenta_recibido_E1;
    }

    if (is_array($slgasto_recibido_E1)) {
        $slgasto_str = implode(',', $slgasto_recibido_E1);
    } else {
        $slgasto_str = $slgasto_recibido_E1;
    }

    $update = "UPDATE transferencia_recibidas SET Valor = '$txtvalor_recibido_E1',Descripcion='$txtdescripcion_E1',N_Cuenta='$slncuenta_str',N_Comprobante='$txtconprobante_recibdo_E1',Estado='$slEstado_recibido_E1',Concepto_Gasto='$slgasto_str' WHERE Id = '$txtidrecibodo1'";
    $result_datos = $conec->query($update);
    echo json_encode(["success" => "Se actualizo La transferencia Recibida"]);
}
