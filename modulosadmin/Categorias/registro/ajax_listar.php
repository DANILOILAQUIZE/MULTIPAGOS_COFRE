<?php
include "../../../backend/classes/class.repositorio.php";
session_start();
$repositorio = new Repositorio;
$conec = $repositorio->connectDB();
date_default_timezone_set('America/Guayaquil');
$tipos = "SELECT
    Id,
    Nombre,
    Estado
FROM
    categorias";
$result_Buscar_tipo =  $conec->query($tipos);
while ($fila = mysqli_fetch_array($result_Buscar_tipo)) {
    $return_arr[] = array(
        "Id" => $fila['Id'],
        "Nombre" => $fila['Nombre'],
        "Estado"=> $fila['Estado']
    );
}
if (isset($return_arr)) {
    echo json_encode($return_arr);
} else {
    echo json_encode(["message" => "Sin Datos"]);
}
