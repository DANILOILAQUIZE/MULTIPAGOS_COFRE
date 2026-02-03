<?php
include "../../backend/classes/class.repositorio.php";
session_start();
$repositorio = new Repositorio;
$conec = $repositorio->connectDB();
date_default_timezone_set('America/Guayaquil');
$tipos = "SELECT 
COUNT(d.IdUsuario)AS Total_usuarios
FROM datos_usuarios d
INNER JOIN gen_usuarios g ON d.IdUsuario = g.Cod_usuario
INNER JOIN otros_ingresos o ON FIND_IN_SET(o.Id, d.Otros)
INNER JOIN tipo_cuenta tc ON d.Tipo_cuenta = tc.Id
INNER JOIN tipo_banco b ON d.BancoCoac = b.Id
INNER JOIN tipo_usuario tipo_u ON g.Tipo_usuario = tipo_u.Id
WHERE NOT g.Tipo_usuario = '1' and  g.Estado = '0';";
$result_Buscar_tipo =  $conec->query($tipos);
while ($fila = mysqli_fetch_array($result_Buscar_tipo)) {
    $return_arr[] = array(
        "Total_usuarios" => $fila['Total_usuarios']
    );
}
if (isset($return_arr)) {
    echo json_encode($return_arr);
} else {
    echo json_encode(["message" => "Sin Datos"]);
}
