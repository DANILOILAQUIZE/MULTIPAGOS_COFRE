<?php
include "../../../backend/classes/class.repositorio.php";
session_start();
$repositorio = new Repositorio;
$conec = $repositorio->connectDB();
date_default_timezone_set('America/Guayaquil');
$tipos = "SELECT 
(g.Cod_usuario)AS IdUsuario,
(d.Apellido)AS Apellidos,
(d.Nombre)AS Nombre,
(d.Fecha_Nacimiento)AS FN,
(d.Fecha_Entrada)AS FE,
(d.Sueldo)AS Sueldo,
GROUP_CONCAT(o.Nombre SEPARATOR '\<br>\<br>') AS Otros,
(d.cuentanum)AS NC,
(tc.Nombre)AS TCuenta,
(b.Nombre)AS Banco,
(g.Usuario)AS Usuario,
(tipo_u.Tipo)AS Tipo_Usuario,
GROUP_CONCAT(o.Id SEPARATOR ',') AS IdOtros,
(tc.Id)AS IdTipoCuenta,
(b.Id)AS IdBanco,
(g.Estado)AS Estado,
(g.Emails)AS Emails,
(g.Tipo_usuario)AS IdTipo_usuario
FROM datos_usuarios d
INNER JOIN gen_usuarios g ON d.IdUsuario = g.Cod_usuario
INNER JOIN otros_ingresos o ON FIND_IN_SET(o.Id, d.Otros)
INNER JOIN tipo_cuenta tc ON d.Tipo_cuenta = tc.Id
INNER JOIN tipo_banco b ON d.BancoCoac = b.Id
INNER JOIN tipo_usuario tipo_u ON g.Tipo_usuario = tipo_u.Id
WHERE g.Estado = '0'
GROUP BY g.Cod_usuario";
$result_Buscar_tipo =  $conec->query($tipos);
while ($fila = mysqli_fetch_array($result_Buscar_tipo)) {
    $return_arr[] = array(
        "IdUsuario" => $fila['IdUsuario'],
        "Apellidos" => $fila['Apellidos'],
        "Nombre" => $fila['Nombre'],
        "FN" => $fila['FN'],
        "FE" => $fila['FE'],
        "Sueldo" => $fila['Sueldo'],
        "Otros" => $fila['Otros'],
        "NC" => $fila['NC'],
        "TCuenta" => $fila['TCuenta'],
        "Banco" => $fila['Banco'],
        "Usuario" => $fila['Usuario'],
        "Tipo_Usuario" => $fila['Tipo_Usuario'],
        "IdOtros" => $fila['IdOtros'],
        "IdTipoCuenta" => $fila['IdTipoCuenta'],
        "IdBanco" => $fila['IdBanco'],
        "Estado" => $fila['Estado'],
        "Emails" => $fila['Emails'],
        "IdTipo_usuario" => $fila['IdTipo_usuario']
    );
}
if (isset($return_arr)) {
    echo json_encode($return_arr);
} else {
    echo json_encode(["message" => "Sin Datos"]);
}
