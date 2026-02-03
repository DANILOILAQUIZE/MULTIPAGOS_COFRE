<?php
include "../../../backend/classes/class.repositorio.php";
session_start();
$repositorio = new Repositorio;
$conec = $repositorio->connectDB();
date_default_timezone_set('America/Guayaquil');
$tipos = "SELECT  
  a.Id AS IdAsignacion,
  c.Nombre AS NomCajas,
  GROUP_CONCAT(p.Plataforma SEPARATOR '\<br>\<br>') AS Plataformas,
  GROUP_CONCAT(p.Id SEPARATOR ',') AS IdPlataformas,
  (a.Estado)AS Estado,
  (c.Id)AS IdCajas,
  GROUP_CONCAT(p.Usuario SEPARATOR '\<br>\<br>') AS Usuario
FROM asignacion_cajas a 
INNER JOIN cajas c ON a.IdCaja = c.Id
INNER JOIN plataforma_usuario p ON FIND_IN_SET(p.Id, a.IdPlataforma)
GROUP BY a.Id";
$result_Buscar_tipo =  $conec->query($tipos);
while ($fila = mysqli_fetch_array($result_Buscar_tipo)) {
    $return_arr[] = array(
        "IdAsignacion" => $fila['IdAsignacion'],
        "NomCajas" => $fila['NomCajas'],
        "Plataformas" => $fila['Plataformas'],
        "Estado" => $fila['Estado'],
        "IdCajas" => $fila['IdCajas'],
        "IdPlataformas" => $fila['IdPlataformas'],
        "Usuario" => $fila['Usuario']
    );
}
if (isset($return_arr)) {
    echo json_encode($return_arr);
} else {
    echo json_encode(["message" => "Sin Datos"]);
}
