<?php
include "../../../backend/classes/class.repositorio.php";
session_start();
$repositorio = new Repositorio;
$conec = $repositorio->connectDB();
date_default_timezone_set('America/Guayaquil');
$idusuario = $_SESSION['idUsuario'];
$Typeusuario = $_SESSION['type'];
if ($Typeusuario == '1' || $Typeusuario == '2' || $Typeusuario == '4') {
    $sql_listar = "SELECT
    d.Id,
    d.Valor,
    d.Descripcion,
    p1.Nombre_plataforma,
    (p1.Id) AS IdPlataforma,
    d.N_Comprobante,
    g.Usuario,
    (d.IdUsuario) AS IdUsuario,
    d.Estado
FROM
    transferencia_recibidas d
INNER JOIN plataforma_usuario p1 ON
    d.N_Cuenta = p1.Id 
INNER JOIN gen_usuarios g ON
    d.IdUsuario = g.Cod_usuario;";
    $resul =  $conec->query($sql_listar);
    while ($fila = mysqli_fetch_array($resul)) {
        $return_arr[] = array(
            "Id" => $fila['Id'],
            "Valor" => $fila['Valor'],
            "Descripcion"=> $fila['Descripcion'],
            "Nombre_plataforma" => $fila['Nombre_plataforma'],
            "N_Comprobante" => $fila['N_Comprobante'],
            "Usuario" => $fila['Usuario'],
            "IdUsuario" => $fila['IdUsuario'],
            "Estado" => $fila['Estado'],
            "IdPlataforma" => $fila['IdPlataforma'],
        );
    }
    if (isset($return_arr)) {
        echo json_encode($return_arr);
    } else {
        echo json_encode(["message" => "Sin Datos"]);
    }
} else if ($Typeusuario == '3') {
    $sql_listar = "SELECT
    d.Id,
    d.Valor,
    d.Descripcion,
    p1.Nombre_plataforma,
    (p1.Id) AS IdPlataforma,
    d.N_Comprobante,
    g.Usuario,
    (d.IdUsuario) AS IdUsuario,
    d.Estado
FROM
    transferencia_recibidas d
INNER JOIN plataforma_usuario p1 ON
    d.N_Cuenta = p1.Id 
INNER JOIN gen_usuarios g ON
    d.IdUsuario = g.Cod_usuario
WHERE d.IdUsuario = '$idusuario' ";
    $resul =  $conec->query($sql_listar);
    while ($fila = mysqli_fetch_array($resul)) {
        $return_arr[] = array(
            "Id" => $fila['Id'],
            "Valor" => $fila['Valor'],
            "Descripcion"=> $fila['Descripcion'],
            "Nombre_plataforma" => $fila['Nombre_plataforma'],
            "N_Comprobante" => $fila['N_Comprobante'],
            "Usuario" => $fila['Usuario'],
            "IdUsuario" => $fila['IdUsuario'],
            "Estado" => $fila['Estado'],
            "IdPlataforma" => $fila['IdPlataforma'],
        );
    }
    if (isset($return_arr)) {
        echo json_encode($return_arr);
    } else {
        echo json_encode(["message" => "Sin Datos"]);
    }
}
