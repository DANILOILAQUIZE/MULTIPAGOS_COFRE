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
    d.Numero,
    d.Valor,
    d.N_Dep,
    p.Nombre_plataforma,
    (p.Id)AS IdPlataforma,
    t.Nombre,
    (t.Id)AS IdBanco,
    d.N_caja,
    g.Usuario,
    (d.IdUsuario)AS IdUsuario,
    d.Estado
FROM
    dep_trans_banco d
INNER JOIN plataforma_usuario p ON
    d.N_Cuenta = p.Id
INNER JOIN tipo_banco t ON
    d.Banco = t.Id
INNER JOIN gen_usuarios g ON
    d.IdUsuario = g.Cod_usuario  ";
    $resul =  $conec->query($sql_listar);
    while ($fila = mysqli_fetch_array($resul)) {
        $return_arr[] = array(
            "Id" => $fila['Id'],
            "Numero" => $fila['Numero'],
            "Valor" => $fila['Valor'],
            "N_Dep" => $fila['N_Dep'],
            "Nombre_plataforma" => $fila['Nombre_plataforma'],
            "Nombre" => $fila['Nombre'],
            "N_caja" => $fila['N_caja'],
            "Usuario" => $fila['Usuario'],
            "IdUsuario" => $fila['Id'],
            "Estado" => $fila['Estado'],
            "IdPlataforma" => $fila['IdPlataforma'],
            "IdBanco" => $fila['IdBanco']
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
    d.Numero,
    d.Valor,
    d.N_Dep,
    p.Nombre_plataforma,
    (p.Id)AS IdPlataforma,
    t.Nombre,
    (t.Id)AS IdBanco,
    d.N_caja,
    g.Usuario,
    (d.IdUsuario)AS IdUsuario,
    d.Estado
FROM
    dep_trans_banco d
INNER JOIN plataforma_usuario p ON
    d.N_Cuenta = p.Id
INNER JOIN tipo_banco t ON
    d.Banco = t.Id
INNER JOIN gen_usuarios g ON
    d.IdUsuario = g.Cod_usuario
WHERE d.IdUsuario = '$idusuario' ";
    $resul =  $conec->query($sql_listar);
    while ($fila = mysqli_fetch_array($resul)) {
        $return_arr[] = array(
            "Id" => $fila['Id'],
            "Numero" => $fila['Numero'],
            "Valor" => $fila['Valor'],
            "N_Dep" => $fila['N_Dep'],
            "Nombre_plataforma" => $fila['Nombre_plataforma'],
            "Nombre" => $fila['Nombre'],
            "N_caja" => $fila['N_caja'],
            "Usuario" => $fila['Usuario'],
            "IdUsuario" => $fila['Id'],
            "Estado" => $fila['Estado'],
            "IdPlataforma" => $fila['IdPlataforma'],
            "IdBanco" => $fila['IdBanco']
        );
    }
    if (isset($return_arr)) {
        echo json_encode($return_arr);
    } else {
        echo json_encode(["message" => "Sin Datos"]);
    }
}
