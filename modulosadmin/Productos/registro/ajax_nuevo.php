<?php
include "../../../backend/classes/class.repositorio.php";
session_start();
$repositorio = new Repositorio;
$conec = $repositorio->connectDB();
date_default_timezone_set('America/Guayaquil');

$txtProducto = strtoupper($_POST['txtProducto']);
$txtcomBanco = $_POST['txtcomBanco'];
$txtsubtotal = $_POST['txtsubtotal'];
$txtiva = $_POST['txtiva'];
$txtcomlocal = $_POST['txtcomlocal'];
$slcategoria = $_POST['slcategoria'];

if (is_array($slcategoria)) {
    $slcategoria_str = implode(',', $slcategoria);
} else {
    $slcategoria_str = $slcategoria;
}

//Este codigo sirve para buscar si ya existe el usuario
$Buscar = "SELECT * FROM productos WHERE Producto = '$txtProducto' and Estado = '0' ";
$result_Buscar =  $conec->query($Buscar);
if (mysqli_fetch_row($result_Buscar)) {
    echo json_encode(["su" => "Ya se encuentra este producto registrado con este nombre : " . $txtProducto ]);
} else {
    //Sirve para ingresar usuario nuevo
    $sql_insertar = "INSERT INTO productos(Producto,Com_Banco,Sub_total,Iva,Com_local,Categoria,Estado)
    VALUES('$txtProducto','$txtcomBanco','$txtsubtotal','$txtiva','$txtcomlocal','$slcategoria_str','0')";
    $result_insertar = $conec->query($sql_insertar);
    echo json_encode(["success" => "Se creo el producto :  " . $txtProducto ]);
}
