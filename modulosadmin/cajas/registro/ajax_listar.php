<?php
include "../../../backend/classes/class.repositorio.php";
session_start();
$repositorio = new Repositorio;
$conec = $repositorio->connectDB();
date_default_timezone_set('America/Guayaquil');
$tipos = "SELECT (c.Id)AS Id , (c.Nombre) AS Nombre , (s.Nombre)AS sucursal , (c.IdSucursal)AS IdSucursal FROM cajas c INNER JOIN sucursales s ON c.IdSucursal = s.Id WHERE c.Estado = '0' ";
$result_Buscar_tipo =  $conec->query($tipos);
while ($fila = mysqli_fetch_array($result_Buscar_tipo)) {
    $return_arr[] = array(
        "Id" => $fila['Id'],
        "Nombre" => $fila['Nombre'],
        "sucursal" => $fila['sucursal'],
        "IdSucursal"=> $fila['IdSucursal']
    );
}
if (isset($return_arr)) {
    echo json_encode($return_arr);
} else {
    echo json_encode(["message" => "Sin Datos"]);
}
