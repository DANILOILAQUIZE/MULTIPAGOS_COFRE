<?php
include "../../../backend/classes/class.repositorio.php";
session_start();
$repositorio = new Repositorio;
$conec = $repositorio->connectDB();
date_default_timezone_set('America/Guayaquil');

$idProd = $_POST['idProd'];
$txtProductoE = strtoupper($_POST['txtProductoE']);
$txtcomBancoE = $_POST['txtcomBancoE'];
$txtsubtotalE = $_POST['txtsubtotalE'];
$txtivaE = $_POST['txtivaE'];
$txtcomlocalE = $_POST['txtcomlocalE'];
$slcategoriaE = $_POST['slcategoriaE'];
$slEstado_E = $_POST['slEstado_E'];

if (is_array($slcategoriaE)) {
    $slcat_str = implode(',', $slcategoriaE);
} else {
    $slcat_str = $slcategoriaE;
}


$update = "UPDATE productos SET Producto = '$txtProductoE',Com_Banco='$txtcomBancoE',Sub_total='$txtsubtotalE',Iva='$txtivaE',Com_local='$txtcomlocalE',Categoria='$slcat_str',Estado='$slEstado_E' WHERE Id = '$idProd'   ";
$result_datos = $conec->query($update);
echo json_encode(["success" => "Se Actualizo El Producto " . $txtProductoE]);
