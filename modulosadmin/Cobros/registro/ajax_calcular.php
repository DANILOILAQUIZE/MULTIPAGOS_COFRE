<?php
include "../../../backend/classes/class.repositorio.php";
session_start();
$repositorio = new Repositorio;
$conec = $repositorio->connectDB();
date_default_timezone_set('America/Guayaquil');

$IdProd = $_POST['IdProd'];
$valor = $_POST['valor'] ?? null;

if (is_array($IdProd)) {
    $slprod_str = implode(',', $IdProd);
} else {
    $slprod_str = $IdProd;
}

if (trim($valor) === '') {
    $valor = 0.00;
    $return_arr[] = array(
        "Total" => number_format($valor, 2, '.', '')
    );
    echo json_encode($return_arr);
    return;
} else {
    $sql = "SELECT SUM(Com_Banco+Com_local)AS Total FROM productos WHERE Id = '$slprod_str'";
    $resul = $conec->query($sql);
    while ($fila = mysqli_fetch_array($resul)) {
        $localTotal = $valor + $fila['Total'];
        $return_arr[] = array(
            "Total" => $localTotal
        );
    }
    if (isset($return_arr)) {
        echo json_encode($return_arr);
    } else {
        echo json_encode(["message" => "Sin Datos"]);
    }
}
