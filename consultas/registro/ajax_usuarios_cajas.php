<?php
include "../../backend/classes/class.repositorio.php";
session_start();
$repositorio = new Repositorio;
$conec = $repositorio->connectDB();
date_default_timezone_set('America/Guayaquil');
$ids = $_POST['ids'];

if (is_array($ids)) {
    $slidplata_str = implode(',', $ids);
} else {
    $slidplata_str = $ids;
}

$sql = "SELECT
    GROUP_CONCAT(p.Plataforma SEPARATOR ',') AS Plataformas
FROM
    asignacion_cajas a
INNER JOIN plataforma_usuario p ON
    FIND_IN_SET(p.Id, a.IdPlataforma)
WHERE
    a.IdCaja = '$slidplata_str' AND a.Estado = '0'";

$result_Buscar_tipo =  $conec->query($sql);
while ($fila = mysqli_fetch_array($result_Buscar_tipo)) {
    $return_arr[] = array(
        "Plataformas" => $fila['Plataformas']
    );
}
if (isset($return_arr)) {
    echo json_encode($return_arr);
} else {
    echo json_encode(["message" => "Sin Datos"]);
}

