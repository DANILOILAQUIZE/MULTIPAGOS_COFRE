<?php
include "../../../backend/classes/class.repositorio.php";
session_start();
$repositorio = new Repositorio;
$conec = $repositorio->connectDB();
date_default_timezone_set('America/Guayaquil');
$tipos = "SELECT
    p.Id,
    p.Plataforma,
    p.Usuario,
    p.Nombre_plataforma,
    CASE WHEN p.Banco = 0 THEN '' ELSE b.Nombre
END AS Nombre_Banco,
CASE WHEN p.Banco = 0 THEN '' ELSE b.Id
END AS IdBanco
FROM
    plataforma_usuario p
LEFT JOIN tipo_banco b ON
    p.Banco = b.Id
WHERE
    p.Estado = '0' ";
$result_Buscar_tipo =  $conec->query($tipos);
while ($fila = mysqli_fetch_array($result_Buscar_tipo)) {
    $return_arr[] = array(
        "Id" => $fila['Id'],
        "Plataforma" => $fila['Plataforma'],
        "Usuario" => $fila['Usuario'],
        "Nombre_plataforma" => $fila['Nombre_plataforma'],
        "Nombre_Banco" => $fila['Nombre_Banco'],
        "IdBanco" => $fila['IdBanco']
    );
}
if (isset($return_arr)) {
    echo json_encode($return_arr);
} else {
    echo json_encode(["message" => "Sin Datos"]);
}
